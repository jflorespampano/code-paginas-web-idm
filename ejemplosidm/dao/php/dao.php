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
            $obj = [
               'sucess' => true, 
               'message'=>'ok',
               'data'=>[]
            ];
            return ($obj);
         }else{
            $obj = [
               'sucess' => true, 
               'message'=>'no se inserto el registro',
               'data'=>[]
            ];
            return ($obj);
         }
      } catch (Exception $e) {
         $obj = [
            'sucess' => false, 
            'message'=>'Error al insertar datos' . $e->getMessage(),
            'data'=>[]
         ];
         return ($obj);
      }
   }
   public function get($id) {
      $query = "SELECT * from alumnos " .
         "WHERE id = ? ";
      try {
         $connection = $this->db->open();
         $stmt = $connection->prepare($query);
         $stmt->execute(array($id));
         $libro = $stmt->fetch();
         $this->db->close();
         if ($libro){
            $obj = [
               'sucess' => true, 
               'message'=>'ok',
               'data'=>$libro
            ];
            return ($obj);
         }else{
            $obj = [
               'sucess' => true, 
               'message'=>'no hay registos',
               'data'=>[]
            ];
            return ($obj);
         }
      } catch (Exception $e) {
         $obj = [
            'sucess' => false, 
            'message'=>'Error al recuperar datos' . $e->getMessage(),
            'data'=>[]
         ];
         return ($obj);
      }
    }

    public function getAll() {
      $query = "SELECT * from alumnos ;";
      try {
         $connection = $this->db->open();
         $stmt = $connection->prepare($query);
         $stmt->execute();
         $libro = $stmt->fetchAll(PDO::FETCH_OBJ);
         $this->db->close();
         if ($libro){
            $obj = [
               'sucess' => true, 
               'message'=>'ok',
               'data'=>$libro
            ];
            return ($obj);
         }else{
            $obj = [
               'sucess' => true, 
               'message'=>'no hay registos',
               'data'=>[]
            ];
            return ($obj);
         }
      } catch (Exception $e) {
         $obj = [
            'sucess' => false, 
            'message'=>'Error al recuperar datos' . $e->getMessage(),
            'data'=>[]
         ];
         return ($obj);
      }
    }

    public function update(){;}
    public function delete(){;}
 }
 
?>