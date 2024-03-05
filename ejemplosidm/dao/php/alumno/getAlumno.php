<?php
// include 'vars.php';
include '../factory.php';
include 'alumnoDao.php';

#https://mcazorla.gitbooks.io/programacion-en-el-servidor/content/patrones_de_diseno_en_php_i/dao_data_access_object.html

try{
   //$db = new PDO('mysql:host=localhost;dbname=uazon;', $user, $pwd);
   try{
      if ( !isset ( $_GET['id'] ) ){
         throw new Exception("No has especificado un identificador de libro");
      }
   }catch(Exception $Exception){
      http_response_code(400);
      exit ("Error al recibir datos: ".$Exception);
  }
   $id = $_GET['id'];
   //pasamos la conexi&oacute;n de la base de datos al DAO
   $db=getDbController();
   $AlumnoDAO = new AlumnoDAO($db);
   $alumno = $AlumnoDAO->get($id);
   // print_r ($alumno);
   if($alumno["sucess"]){
      http_response_code(200);
      echo json_encode($alumno["data"]);
   }else{
      http_response_code(400);
      echo $alumno["message"];
   }
}catch(PDOException $Exception){
   http_response_code(400);
   echo "error" . $Exception;
}
