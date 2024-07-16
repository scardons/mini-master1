<?php
class mdlRoles{
    //atributos
    public $idRol;
    public $rolDescription;
    public $estado;
    public $db;

    //crear el metodo para fijar los datos en la db
    public function __SET($attribute, $value){
        //instanciar los atributos
        $this -> $attribute = $value;
    }

    //crear el metodo para reclamar los datos cuando sean necesarios 
    public function __GET($attribute){
        //nos regresa los atributos 
        return $this -> $attribute;
    }

    //crear la conexion 
    public function __construct($db){
        //inentamos la conexion
        try{
            $this->db = $db;
        }catch(PDOException $e){
            exit("Error to conect");
        }
    }

    //método para ver u obtener los roles
    public function getRoles(){
        //consulta
        $sql = "SELECT * FROM roles ORDER BY RolDescription ASC";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>