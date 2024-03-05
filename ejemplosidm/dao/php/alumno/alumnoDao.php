<?php
class AlumnoDAO {
   private $db;
   public function __construct($db) {
      $this->db=$db;
   }
   public function insert($alumno){
      // $alumno=[
      //    "matricula"=> $_POST["matricula"],
      //    "nombre"=> $_POST["nombre"],
      //    "carrera"=> $_POST["carrera"]
      // ];
      $query = "insert into alumnos(matricula,nombre,carrera) values(:matricula, :nombre, :carrera);";
      try{
         $connection = $this->db->open();
         $sentencia = $connection->prepare($query);
         $resultado = $sentencia->execute($alumno);
         $this->db->close();
         if($resultado){
            return [json_encode([]), null];
         }else{
            throw new Exception("Warning no se inserto dato ", 1);
         }
      } catch (Exception $e) {
         return [json_encode([]), $error];
      }
   }
   public function read($id) {
      $query = "SELECT * from alumnos " .
         "WHERE id = ? ";
      try {
         $connection = $this->db->open();
         $stmt = $connection->prepare($query);
         $stmt->execute(array($id));
         $rows = $stmt->fetch();
         $this->db->close();
         return [json_encode($rows, JSON_UNESCAPED_UNICODE), null];
      }catch (Exception $e) {
         return [json_encode([]), $error];
      }
    }

    public function readAll() {
      $query = "SELECT * from alumnos ;";
      try {
         $connection = $this->db->open();
         $stmt = $connection->prepare($query);
         $stmt->execute();
         $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
         $this->db->close();
         return [json_encode($rows, JSON_UNESCAPED_UNICODE), null];
      } catch (Exception $e) {
         return [json_encode([]), $error];
      }
    }

   public function update($alumno){
      $query = "update alumnos set matricula=:matricula, nombre=:nombre, carrera=:carrera
         where id=:id;";
      try{
         $connection = $this->db->open();
         $sentencia = $connection->prepare($query);
         $resultado = $sentencia->execute($alumno);
         $this->db->close();
         if($resultado){
            return [json_encode([]), null];
         }else{
            throw new Exception("Warning no se inserto dato ", 1);
         }
      } catch (Exception $e) {
         return [json_encode([]), $error];
      }
   }
   public function delete($id){
      $query = "delete from alumnos where id=$id;";
      try{
         $connection = $this->db->open();
         $sentencia = $connection->prepare($query);
         $resultado = $sentencia->execute();
         $this->db->close();
         if($resultado){
            $obj = [
               'sucess' => true, 
               'message'=>'ok',
               'data'=>[]
            ];
            return ($obj);
         }else{
            $obj = [
               'sucess' => true, 
               'message'=>'no se elimino el registro',
               'data'=>[]
            ];
            return ($obj);
         }
      } catch (Exception $e) {
         $obj = [
            'sucess' => false, 
            'message'=>'Error al eliminar dato' . $e->getMessage(),
            'data'=>[]
         ];
         return ($obj);
      }
   }
 }
 
?>