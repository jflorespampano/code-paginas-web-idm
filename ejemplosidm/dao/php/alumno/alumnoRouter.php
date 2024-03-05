<?php
include 'alumnoDao.php';
class ClsRequest
{
    function getOne($cual)
    {
        $db=getDbController();
        $objDB = new AlumnoDao($db);
        list($data, $error) = $objDB->read($cual);
        if (is_null($error)) {
            http_response_code(200);
            echo $data;
        } else {
            http_response_code(400);
            echo $error;
        }
        $objDB = null;
    }
    function getAll()
    {
        $db=getDbController();
        $objDB = new AlumnoDao($db);
        // $data = $objDB->read(1);
        list($data, $error) = $objDB->readAll();
        if (is_null($error)) {
            http_response_code(200);
            echo $data;
        } else {
            http_response_code(400);
            echo $error;
        }
        $objDB = null;
    }
    function get()
    {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $this->getOne($id);
        } else {
            $this->getAll();
        }
    }
    //
    function update()
    {
        if ($_SERVER["CONTENT_TYPE"] == 'application/x-www-form-urlencoded') {
            //recuperar datos
            parse_str(file_get_contents("php://input"), $put_vars);
            try {
                if (empty($put_vars["id"])) {
                    throw new Exception("Falta id");
                }
                $id = $put_vars['id'];
                if (empty($put_vars["matricula"])) {
                    throw new Exception("Falta matricula");
                }
                $matricula = $put_vars['matricula'];
                if (empty($put_vars["nombre"])) {
                    throw new Exception("Falta nombre");
                }
                $nombre = $put_vars['nombre'];
                if (empty($put_vars["carrera"])) {
                    throw new Exception("Falta carrera");
                }
                $carrera = $put_vars['carrera'];
                $alumno = [
                    "id" => $id,
                    "matricula" => $matricula,
                    "nombre" => $nombre,
                    "carrera" => $carrera
                ];
            } catch (Exception $ex) {
                http_response_code(400);
                exit ("Error faltan datos: ".$ex);
            }
            //ejecutar sentencia
            $db=getDbController();
            $objDB = new AlumnoDao($db);
            list($data, $error) = $objDB->update($alumno);
            if (!$error) {
                http_response_code(200);
                echo "datos actualizados";
            } else {
                http_response_code(400);
                echo "no se pudo actualizar el dato";
            }
            return true;
        } else {
            http_response_code(400);
            echo 'sin parametros';
            return false;
        }
    }
    function insert()
    {
        if ($_SERVER["CONTENT_TYPE"] == 'application/x-www-form-urlencoded') {
            //recuperar datos
            parse_str(file_get_contents("php://input"), $put_vars);
            // $id = $put_vars['id'];
            $matricula = $put_vars['matricula'];
            $nombre = $put_vars['nombre'];
            $carrera = $put_vars['carrera'];
            $alumno = [
                "matricula" => $matricula,
                "nombre" => $nombre,
                "carrera" => $carrera
            ];
            //ejecutar sentencia
            $db=getDbController();
            $objDB = new AlumnoDao($db);
            list($data, $error) = $objDB->insert($alumno);
            if (!$error) {
                http_response_code(200);
                echo "datos insertados correctamente";
            } else {
                http_response_code(400);
                echo "no se pudo insertar el dato";
            }
            return true;
        } else {
            http_response_code(400);
            echo 'sin parametros';
            return false;
        }
    }
    function delete()
    {
        if ($_SERVER["CONTENT_TYPE"] == 'application/x-www-form-urlencoded') {
            //recuperar datos
            parse_str(file_get_contents("php://input"), $put_vars);
            $id = $put_vars['id'];
            $alumno = [
                "id" => $id
            ];
            //ejecutar sentencia
            $objDB = new AlumnoDAO();
            $respuesta = $objDB->delete($alumno);
            if ($respuesta) {
                http_response_code(200);
                echo "dato eliminado";
            } else {
                http_response_code(400);
                echo "no se pudo actualizar el dato";
            }
            return true;
        } else {
            http_response_code(400);
            echo 'sin parametros';
            return false;
        }
    }

}
function AlumnoRoterMain()
{
    $or = new ClsRequest();
    switch ($_SERVER["REQUEST_METHOD"]) {
        case "PUT":
            $or->update();
            break;
        case "POST":
            $or->insert();
            break;
        case "GET":
            $or->get();
            break;
        case "DELETE":
            $or->delete();
            break;
        default:
            echo '<p>Error, no se recibio REQUEST_METHOD</p>';
            break;
    }
}
?>