<?php
include 'vars.php';

#verificar si vienen losparametros requeridos
if (empty($_POST["matricula"])) {
    http_response_code(400);
	exit("Falta umatricula"); #Terminar el script definitivamente
}

if (empty($_POST["nombre"])) {
    http_response_code(400);
	exit("falta nombre"); #Terminar el script definitivamente
}
if (empty($_POST["carrera"])) {
    http_response_code(400);
	exit("falta carrera"); #Terminar el script definitivamente
}
//
$conex = new PDO("sqlite:" . $nombre_fichero);
$conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$alumno=[
    "matricula"=> $_POST["matricula"],
    "nombre"=> $_POST["nombre"],
    "carrera"=> $_POST["carrera"]
];
try{
    # preparando la cosnaulta
    $sentencia = $conex->prepare("insert into alumnos(matricula,nombre,carrera) values(:matricula, :nombre, :carrera);");
    $resultado = $sentencia->execute($alumno);
    http_response_code(200);
    echo "datos insertados";

}catch(PDOException $exc){
    http_response_code(400);
    echo "Lo siento, ocurrió un error:".$exc->getMessage();

}

?>