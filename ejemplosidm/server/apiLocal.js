const { createReadStream } = require ('fs')
const http = require('http');

const alumnos = [
    { 'id': '01', 'nombre': 'ana', 'estado': 'egresado', 'carrera': 'ico' },
    { 'id': '02', 'nombre': 'bety', 'estado': 'activo', 'carrera': 'isc' },
    { 'id': '03', 'nombre': 'rosa', 'estado': 'egresado', 'carrera': 'ico' },
    { 'id': '04', 'nombre': 'juan', 'estado': 'activo', 'carrera': 'ico' },
    { 'id': '05', 'nombre': 'luis', 'estado': 'egresado', 'carrera': 'ico' },
    { 'id': '06', 'nombre': 'paco', 'estado': 'baja', 'carrera': 'idm' },
    { 'id': '07', 'nombre': 'liz', 'estado': 'egresado', 'carrera': 'ico' },
    { 'id': '08', 'nombre': 'hugo', 'estado': 'baja', 'carrera': 'idm' },
    { 'id': '09', 'nombre': 'tito', 'estado': 'egresado', 'carrera': 'ico' },
    { 'id': '10', 'nombre': 'jose', 'estado': 'activo', 'carrera': 'isc' },
    { 'id': '11', 'nombre': 'paco', 'estado': 'baja', 'carrera': 'idm' },
    { 'id': '12', 'nombre': 'liz', 'estado': 'egresado', 'carrera': 'ico' },
    { 'id': '13', 'nombre': 'hugo', 'estado': 'baja', 'carrera': 'idm' },
    { 'id': '14', 'nombre': 'tito', 'estado': 'egresado', 'carrera': 'isc' },
    { 'id': '15', 'nombre': 'jose', 'estado': 'activo', 'carrera': 'isc' }
];

http.createServer((req, res) => {
    if (req.url == '/') {
        res.writeHead(200, { 'Content-Type': 'text/html' });
        createReadStream('menu2.html').pipe(res)

    } else if (req.url == '/activo') {
        activos(res);
    } else if (req.url == '/ico') {
        ico(res);
    } else {
        res.writeHead(404, { 'Content-Type': 'text/plain' });
        res.end('no se encontro la ruta');
    }
}).listen(3000);
console.log('servidor corriendo en 3000:...');

function activos(res) {
    let respuesta = alumnos.filter((x) => {
        return x.estado == 'activo';
    });
    res.writeHead(200, { 'Content-Type': 'text/json' });
    res.end(JSON.stringify(respuesta));
}
function ico(res) {
    let respuesta = alumnos.filter((x) => {
        return x.carrera == 'ico';
    });
    res.writeHead(200, { 'Content-Type': 'text/json' });
    res.end(JSON.stringify(respuesta));
}