<?php 
header("Content-Type: text/html;charset=utf-8");

if(! empty($_GET)){
    //se enviaron parametros por el método _GET
    $movimiento=(isset($_GET["movimiento"])?$_GET["movimiento"]:"ninguno");
    $id=(isset($_GET["id"])?$_GET["id"]:"");
    $nombre=(isset($_GET["nombre"])?$_GET["nombre"]:"");
    $apellido=(isset($_GET["apellido"])?$_GET["apellido"]:"");
    $edad=(isset($_GET["edad"])?$_GET["edad"]:"No se recibiom edad");
    http_response_code(200);
    echo $movimiento.",".$id.",".$nombre.",".$apellido.",".$edad;
}else{
    http_response_code(400);
    echo "sin datos recibidos";
}
exit();
?>
