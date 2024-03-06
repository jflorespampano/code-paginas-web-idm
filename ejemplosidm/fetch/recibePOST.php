<?php 
header("Content-Type: text/html;charset=utf-8");
if(! empty($_POST)){
    //se enviarion parametros por el método _POST
    $movimiento=(isset($_POST["movimiento"])?$_POST["movimiento"]:"ninguno");
    $id=(isset($_POST["id"])?$_POST["id"]:"");
    $nombre=(isset($_POST["nombre"])?$_POST["nombre"]:"");
    $apellido=(isset($_POST["apellido"])?$_POST["apellido"]:"");
    $edad=(isset($_POST["edad"])?$_POST["edad"]:0);
    http_response_code(200);
    echo "recibi post:".$movimiento.",".$id.",".$nombre.",".$apellido.",".$edad;
}else{
    http_response_code(400);
    echo "No hay parametros";
}
?>
