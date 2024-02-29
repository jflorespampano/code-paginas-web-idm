<?php
include 'vars.php';
class DataBaseSqLite{
    protected $conexion=null;
    static string $db = "sqlite:./alumnos.sqlite3";
    function __construct(){
        $this->conexion=null;
    }
    function open(){
        $this->conexion = new PDO(DataBaseSQLite::$db);
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $this->conexion;
    }
    function close(){
        $this->conexion=null;
        return;
    }
}
//
class DataBaseMysql{
    protected string $db;
    protected string $host;
    protected string $cadcon;
    protected string $user;
    protected string $pass;
    protected $conexion=null;
    function __construct()
    {
        $this->conexion=null;
        $this->host = "localhost";
        $this->db = "facultad";
        $this->user = "root";
        $this->pass = "";
        $this->cadcon = "mysql:host=$this->host;dbname=$this->db;charset=utf8";
    }
    function open()
    {
        try {
            //intenta la conexión
            $this->conexion = new PDO($this->cadcon, $this->user, $this->pass);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conexion;
        } catch (PDOException $e) {
            //atrapa el error
            throw new Exception("Falla al obtener un manejador de BD (MySql): ");
        }
    }

    function close(){
        $this->conexion=null;
        return;
    }
}

function getDbController(){
    global $db_server, $db_file_sqlie;
    if($db_server=="sqlite"){
        $db=new DataBaseSqLite();
        return($db);
    }else if($db_server=="mysql"){
        $db=new DataBaseMysql();
        return($db);
    }else{
        return null;
    }
}
?>