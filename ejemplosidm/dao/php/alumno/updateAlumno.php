<?php
include '../factory.php';
include 'alumnoDao.php';
try{
    #verificar si vienen losparametros requeridos
    try{
        if (empty($_POST["id"])) {
            throw new Exception("Falta id");
        }
        if (empty($_POST["matricula"])) {
            throw new Exception("Falta matricula");
        }
        if (empty($_POST["nombre"])) {
            throw new Exception("Falta nombre");
        }
        if (empty($_POST["carrera"])) {
            throw new Exception("Falta carrera");
        }
    }catch(Exception $Exception){
        http_response_code(400);
        exit ("Error al recibir datos".$Exception);
    }
    $id=$_POST["id"];
    $alumno=[
        "matricula"=> $_POST["matricula"],
        "nombre"=> $_POST["nombre"],
        "carrera"=> $_POST["carrera"]
    ];
    $db=getDbController();
    $AlumnoDAO = new AlumnoDAO($db);
    $respuesta = $AlumnoDAO->update($id, $alumno);
    // print_r ($respuesta);
    if($respuesta["sucess"]){
        http_response_code(200);
        echo json_encode("dato actualizado correctamente");
     }else{
        http_response_code(400);
        echo $respuesta["message"];
     }

}catch(PDOException $Exception){
    http_response_code(400);
    echo "error" . $Exception;
}
?>