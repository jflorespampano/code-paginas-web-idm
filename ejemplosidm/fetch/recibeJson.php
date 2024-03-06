<?php 
    //espera un json de la forma: {"id":"33","nombre":"juan","apellido":"perez","edad":"4"}
    header("Content-Type: text/html;charset=utf-8");
    $json_str = file_get_contents('php://input'); //obtener parametros de entrda 
    if(strlen($json_str)>0){
        echo "se recibio un json longitud:".strlen($json_str)." : ".$json_str;
        $array = json_decode($json_str);
        http_response_code(200);
        echo ", se recibió el nombre: ".$array->nombre;
        //var_dump($json_str);
    }else{
        http_response_code(400);
        echo "No se recibieron datos";
    }
    exit();
?>
