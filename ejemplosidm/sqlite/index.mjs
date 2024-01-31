import sqlite3 from 'sqlite3'
import { open } from 'sqlite'
import { createReadStream } from 'fs'
let http;
try {
    http = await import('node:http');
    console.log('http cargado');
} catch (err) {
    console.error('https support is disabled!');
}

//para depuracion
sqlite3.verbose();

/***
 * obtiene todos los datos de los post
 * @param {function}  callback función a la que se envia la respuesta
 */
async function getAll(callback) {
    // open the database
    const db = await open({
        filename: 'posts.sqlite3',
        driver: sqlite3.Database
    });
    const result = await db.all('SELECT * FROM posts');
    db.close();
    // console.log("en muestra: ", result);
    callback(result);

}

/***
 * inserta un post
 * @ {object} datos del post con objeto
 * @param {function}  callback función a la que se envia la respuesta
 */
async function insert({ id, userId, title, body }, callback) {
    try {
        const db = await open({
            filename: 'posts.sqlite3',
            driver: sqlite3.Database
        });
        const sql = `INSERT INTO posts(userId,title,body) VALUES (${userId},'${title}','${body}')`;
        const result = await db.run(sql);
        console.log('resultado:', result);
        db.close();
        callback({ id: id, userId: userId, title: 'titulo ok', body: 'boy ok' });
    } catch (error) {
        callback({ error: 'error en la insercion de datos' });
    }
}

/***
 * inserta un post
 * @ {object} datos del post con objeto
 * @param {function}  callback función a la que se envia la respuesta
 */
async function update({ id, userId, title, body }, callback) {
    try {
        const db = await open({
            filename: 'posts.sqlite3',
            driver: sqlite3.Database
        });
        const sql = `
            update posts set userId=${userId} ,title='${title}' ,body='${body}' 
            where id=${id};
        `;
        const result = await db.run(sql);
        console.log('resultado:', result);
        db.close();
        callback({ id: id, userId: userId, title: 'titulo ok', body: 'boy ok' });
    } catch (error) {
        callback({ error: 'error en la actualizacion de datos' +error});
    }
}

http.createServer((req, res) => {
    if (req.url == '/') {
        //si el request viene de http://localhost:3000/
        res.writeHead(200, { 'Content-Type': 'text/html' })
        // leemos el fichero index.html y su contenido lo redirigimos a la respuesta
        createReadStream('index.html').pipe(res)
    } else if (req.url == '/todos') {
        //http://localhost:3000/todos
        res.writeHead(200, { 'Content-Type': 'text/json' });
        getAll(function (result) {
            //enviamos a response los datos en formato json
            res.end(JSON.stringify(result));
        });
    } else if (req.url == '/inserta') {
        //http://localhost:3000/inserta
        if (req.method == 'POST') {
            //leemos la información del body que trae el request
            //el objeto request implementa la interfaz ReadableStream
            //podemos tomar los datos del body que viene en el requests
            //escuchando los eventos on y end del stream
            //cada evento on trae un pedazo del flujo de entrada
            //el evento end indica el final del flujo de entrada
            //por tanto debemos tomar todos los pedazos y al final
            //podemos usar el body ya.
            let body = '';
            req.on('data', chunk => {
                body += chunk;
            });

            req.on('end', () => {
                res.writeHead(200, { 'Content-Type': 'text/html' });
                //construimos una direccion url en string, solamente para
                //agregarle el body que bajo en formato: id=1&userId=1&title=luisito&body=rosales
                //de esta forma podemos usar la función searchParam para tomar los datos
                //la parte de la url: http://localhost:3000? no la usaremos, la ponemos solo para 
                //tener una direccion valida y poder usar el serachParam
                const miurl = new URL('http://localhost:3000?' + body);
                let post = {};
                post.id = miurl.searchParams.get('id');
                post.userId = miurl.searchParams.get('userId');
                post.title = miurl.searchParams.get('title');
                post.body = miurl.searchParams.get('body');
                insert(post, function (resultado) {
                    res.end(JSON.stringify(resultado));
                })
            })
        }
    } else if (req.url == '/actualiza') {
        if (req.method == 'POST') {
            let body = '';
            req.on('data', chunk => {
                body += chunk;
            });
            req.on('end', () => {
                res.writeHead(200, { 'Content-Type': 'text/html' });
                const miurl = new URL('http://localhost:3000?' + body);
                let post = {};
                post.id = miurl.searchParams.get('id');
                post.userId = miurl.searchParams.get('userId');
                post.title = miurl.searchParams.get('title');
                post.body = miurl.searchParams.get('body');
                update(post, function (resultado) {
                    res.end(JSON.stringify(resultado));
                })
            })
        }

    } else {
        res.writeHead(404, { 'Content-Type': 'text/plain' });
        res.end('no se encontro la ruta');
    }
}).listen(3000);
console.log('servidor corriendo en 3000:...');
