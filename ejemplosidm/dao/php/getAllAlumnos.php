<?php
// include 'vars.php';
include 'factory.php';
include 'dao.php';
try{
   $db=getDbController();
   $AlumnoDAO = new AlumnoDAO($db);
   $alumno = $AlumnoDAO->getAll();
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
