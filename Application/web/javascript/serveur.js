const Fs = require('fs');
const Throttle = require('throttle');
const ini = require('ini');
const bdd = require('mysql');
const connect = require('connect');
const app = connect();
const http = require('http').createServer(app);
const { PassThrough } = require('stream');

let readable;
const config = ini.parse(Fs.readFileSync('../../src/conf/conf.ini', 'utf-8'));
const conn = bdd.createConnection({
    database: config.database,
    host: config.host,
    user: config.username,
    password: config.password
});

conn.connect(function(err) {
    if (err) throw err;
    console.log("Base de donné OK!");
});
let musique;
//const bitRate = ffprobeSync('led-zeppelin-stairway-to-heaven.mp3').format.bit_rate;
let throttle;
const writables = [];

function nextSong() {
    let sql = "SELECT * FROM constitutionfile where ordre = (SELECT min(ordre) FROM constitutionfile)";
    conn.query(sql, function(err, rows, fields) {
        if (err) throw err;
        if(rows[0] == undefined) { //Pas de musique dans la file...
            let id = Math.floor(Math.random() * Math.floor(3) + 1);
            sql = "INSERT INTO `constitutionfile` (`ordre`, `IDMusique`, `IDFile`) VALUES (NULL, " + id + ", '1')";

            conn.query(sql, function (err, rows, fields) {
                if (err) throw err;
                nextSong()
            });
        }else{
            musique = rows[0].IDMusique;
            sql = "SELECT * FROM Musique WHERE IDMusique ="+musique;
            //ajout de la musique dans l historique
            let historique = "INSERT INTO historique (ordre,IDMusique) VALUES (NULL,"+musique+")"
            conn.query(historique,function (err,rows,fields){
                if(err) throw err;
            })
            conn.query(sql, function(err, rows, fields) {
                if(err) throw err;
                musique = rows[0];
                console.log(musique.lien);
                setTimeout(jouerMusique, 5000);
            });
        }

    });

}

function Supprimer_NextSong() {
    let sql = "DELETE FROM constitutionfile WHERE ordre = (SELECT min(ordre) from constitutionfile)";

    conn.query(sql, function(err, results) {
        if (err) throw err;
        console.log("Suppression réussie");
    });
    setTimeout(nextSong, 2000);
}


function makeResponse() {
    const ResponseSink = new PassThrough();
    writables.push(ResponseSink);
    return ResponseSink;
}

function jouerMusique() {
    throttle = new Throttle(musique.bitsrate / 8);
    readable = Fs.createReadStream('./../../'+musique.lien);
    readable.pipe(throttle).on('data', (chunk) => {
        for (const writable of writables) {
            writable.write(chunk);
        }
    }).on('end', () => {
        Supprimer_NextSong();
    });
}

app.use('/stream', function(req, res) {
    const songresponse = makeResponse();
    res.writeHead(200, {'Content-Type': 'audio/mpeg',
        'Transfer-Encoding': 'chunked'
    });
    songresponse.pipe(res);
});

http.listen(3000);


nextSong();
