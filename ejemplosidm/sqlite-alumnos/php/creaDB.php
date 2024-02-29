<?php
$DatosCarreras = [
    0 => [
        "nombre" => "ico",
        "alias" => "Ingenieria en computacion"
    ],
    1 => [
        "nombre" => "isc",
        "alias" => "Ingenieria en sistemas computacionales"
    ],
    2 => [
        "nombre" => "idm",
        "alias" => "Ingenieria en diseño multimedia"
    ],
    3 => [
        "nombre" => "itcc",
        "alias" => "Ingenieria en tecnologias de comuto y comunicaciones"
    ]
];

$DatosAlumnos = [
    0 => [
        "matricula" => "231100",
        "nombre" => "Juan Penas",
        "carrera" => "idm"
    ],
    1 => [
        "matricula" => "231240",
        "nombre" => "Jose Arias",
        "carrera" => "idm"
    ],
    2 => [
        "matricula" => "243356",
        "nombre" => "Rosa Uc",
        "carrera" => "isc"
    ],
    3 => [
        "matricula" => "234423",
        "nombre" => "Rosa Pat",
        "carrera" => "isc"
    ]
];
/**
 * Abre una base de datos de SQLite
 * @return object apuntador al manejadro de la BD
 */
function abrirDB()
{
    $archivo="./alumnos2.sqlite3";
    if(file_exists($archivo)){
        echo "la base de datos ya existe";
        return null;
    }else{
        $baseDeDatos = new PDO("sqlite:" . $archivo);
        $baseDeDatos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $baseDeDatos;
    }
}

/**
 * crea la tabla partes si no existe
 * @param object $baseDeDatos manejador de base de datos de sqlite
 */
function crearTablaCarreras($baseDeDatos)
{
    $definicionTabla = "create table if not exists carreras(
        id integer primary key autoincrement,
        nombre varchar(50),
        alias varchar(10)
    );";

    $resultado = $baseDeDatos->exec($definicionTabla);
    return $resultado;
}
/**
 * crea la tabla alumnos si no existe
 * @param object $baseDeDatos manejador de base de datos de sqlite
 */
function crearTablaAlumnos($baseDeDatos)
{
    $definicionTabla = "create table if not exists alumnos(
        id integer primary key autoincrement,
        matricula varchar(20),
        nombre varchar(30),
        carrera integer
    );";

    $resultado = $baseDeDatos->exec($definicionTabla);
    return $resultado;
}

/**
 * Inserta un datos recibe un arreglo de esta forma:
 * $datosParte=[
 *	"nombre" => "",
 *	"alias" => ""
 *];
 *@param array $tipoParte array
 *@param object $baseDeDatos apuntador al manejador de base de datos
 *@return boolean sucess o fail
 */
function insertaCarrera($baseDeDatos, $carrera)
{
    $query="insert into carreras(nombre, alias) VALUES(:nombre, :alias);";
    $sentencia = $baseDeDatos->prepare($query);
    $resultado = $sentencia->execute($carrera);
    if ($resultado === true) {
        http_response_code(200);
        return true;
    } else {
        http_response_code(400);
        return false;
    }
}
/**
 * Inserta un datos recibe un arreglo de esta forma:
 * $datosParte=[
 *	"id" => 0,
 *	"matrucula" => "9878777",
 *	"nombre" => "juan",
 *	"carrera" => "isc",
 *];
 *@param array $alumno array
 *@param object $baseDeDatos apuntador al manejador de base de datos
 *@return boolean sucess o fail
 */
function insertaAlumno($baseDeDatos, $alumno)
{
    $query="insert into alumnos(matricula, nombre, carrera) VALUES(:matricula, :nombre, :carrera);";
    $sentencia = $baseDeDatos->prepare($query);
    $resultado = $sentencia->execute($alumno);
    if ($resultado === true) {
        http_response_code(200);
        return true;
    } else {
        http_response_code(400);
        return false;
    }
}

/**
 * Inserta un conjunto de registros de ejemplo
 * @param object $baseDeDatos manejador de la bd 
 * @param array $DatosPartes arreglo asociativo con la lista de datos a insertar
 */
function insertaDatosCarreras($baseDeDatos, $DatosCarreras)
{
    //insertar datos de ejeplo
    $carrera = [
        "nombre" => "",
        "alias" => ""
    ];
    foreach ($DatosCarreras as $valor) {
        $carrera["nombre"] = $valor["nombre"];
        $carrera["alias"] = $valor["alias"];
        insertaCarrera($baseDeDatos, $carrera);
    }
}

/**
 * Inserta un conjunto de registros de ejemplo
 * @param object $baseDeDatos manejador de la bd 
 * @param array $DatosAlumnos arreglo asociativo con la lista de datos a insertar
 */
function insertaDatosAlumnos($baseDeDatos, $DatosAlumnos)
{
    //insertar datos de ejemplo
    $alumno = [
        "matricula" => "",
        "nombre" => "",
        "carrera" => ""
    ];
    foreach ($DatosAlumnos as $valor) {
        $alumno["matricula"] = $valor["matricula"];
        $alumno["nombre"] = $valor["nombre"];
        $alumno["carrera"] = $valor["carrera"];
        insertaAlumno($baseDeDatos, $alumno);
    }
}

$db = abrirDB();
if ($db) {
    try{
        crearTablaCarreras($db);
        insertaDatosCarreras($db, $DatosCarreras);
        crearTablaAlumnos($db);
        insertaDatosAlumnos($db, $DatosAlumnos);
        http_response_code(200);
        echo "ok";
    }catch(Exception $Exception){
        http_response_code(400);
        echo "Error: " . $Exception;
    }
} else {
    http_response_code(400);
    echo "la base de datos ya existe";
}

?>