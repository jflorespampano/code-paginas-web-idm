<?php
#ref: https://parzibyte.me/blog/2018/09/17/php-sqlite3-pdo-crud-ejemplos/
try{
    $conex = new PDO("sqlite:" . __DIR__ . "/alumnos.s3db");
    $conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conex->prepare('SELECT * FROM alumnos;');
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //cerrar la bd
    $stmt=null;
    $conex=null;
    http_response_code(200);
    echo json_encode($data);
}catch(PDOException $exc){
    http_response_code(400);
	echo "Error al abrir la base de datos----->".$exc->getMessage();
}


?>