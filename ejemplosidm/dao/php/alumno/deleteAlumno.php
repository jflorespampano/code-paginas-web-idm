<?php
include '../factory.php';
include 'alumnoDao.php';
try{
    #verificar si vienen losparametros requeridos
    try{
        if (empty($_POST["id"])) {
            throw new Exception("Falta id");
        }
    }catch(Exception $Exception){
        http_response_code(400);
        exit ("Error al recibir id: ".$Exception);
    }
    $id=$_POST["id"];
    $db=getDbController();
    $AlumnoDAO = new AlumnoDAO($db);
    $respuesta = $AlumnoDAO->delete($id);
    // print_r ($respuesta);
    if($respuesta["sucess"]){
        http_response_code(200);
        echo json_encode("dato elimindo correctamente");
     }else{
        http_response_code(400);
        echo $respuesta["message"];
     }

}catch(PDOException $Exception){
    http_response_code(400);
    echo "error" . $Exception;
}
?>