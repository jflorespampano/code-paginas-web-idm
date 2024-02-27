<?php
include 'vars.php';
$conex = new PDO("sqlite:" . $nombre_fichero);
$conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conex->prepare('SELECT * FROM alumnos;');
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
//cerrar la bd
$stmt=null;
$conex=null;
//responder
http_response_code(200);
echo json_encode($data);

?>