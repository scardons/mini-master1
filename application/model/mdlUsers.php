<?php
//heredar del mdlpeople
require_once("mdlPeople.php");
//crear la clase para heredar
class mdlUsers extends mdlPeople{
    //ATRIBUTOS
    private $idUser;

    private $username;

    private $password;

    private $idRol;

    private $status;

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

    //metodo para validar y logear con el usuario 
    public function validateUser(){
        $sql = "SELECT P.Document, P.Names, P.Lastname, U.idUser, U.Username, U.PASSWORD, R.RolDescription FROM people AS P INNER JOIN typedocuments AS TD ON P.idTypeDocument = TD.idTypeDocument INNER JOIN users AS U ON P.idPerson = U.idPerson INNER JOIN roles AS R ON U.idRol = R.idRol WHERE U.Username = ? AND U.PASSWORD = ? AND U.Stat = 1";

        $stm = $this->db->prepare($sql);
        $stm->bindParam(1, $this->username);
        $stm->bindParam(2, $this->password);
        $stm->execute();

        // retornar los datos
        $user = $stm->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    //método para registrar usuario
    public function userRegister(){
        //consulta
        $sql = "INSERT INTO users(Username, PASSWORD, idPerson, idRol, Stat) VALUES (?,?,?,?,?)";

        //vamos a enviar el estado activo por defecto
        $status = 1;

        //vamos a enviar los parámetros
        $stm = $this->db->prepare($sql);
        $stm->bindParam(1, $this->username);
        $stm->bindParam(2, $this->password);
        $stm->bindParam(3, $this->idPerson);
        $stm->bindParam(4, $this->idRol);
        $stm->bindParam(5, $status);

        //respuesta
        $result = $stm->execute();
        return $result;
    }

    //método para obtener los usuarios
    public function getUsers(){
        //consulta
        $sql = "SELECT P.*, U.idUser, U.Username, U.Stat, R.RolDescription, TD.Description FROM people AS P INNER JOIN users AS U ON P.idPerson = U.idPerson INNER JOIN roles AS R ON R.idRol = U.idRol INNER JOIN typedocuments AS TD ON P.idTypeDocument = TD.idTypeDocument";

        //preparar y enviar la consulta
        $stm = $this->db->prepare($sql);
        $stm->execute();

        //crear la variable para retornar los datos
        $user = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $user;
    }

    //método para tomar el id, filtrar, editar, eliminar y cambiar estado
    public function userId($id){
        //consulta
        $sql = "SELECT P.*, U.*, R.idRol, R.RolDescription AS rol, TD.Description AS typeDoc FROM people AS P INNER JOIN users AS U ON P.idPerson = U.idPerson INNER JOIN roles AS R ON R.idRol = U.idRol INNER JOIN typedocuments AS TD ON P.idTypeDocument = TD.idTypeDocument WHERE U.idUser = ?";

        $query = $this->db->prepare($sql);
        $query->bindParam(1, $id);
        $query -> execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    //metodo para cambiar el estado
    public function changeStatus($id){
        //consulta
        $sql = "UPDATE users SET Stat = (CASE WHEN Stat = 1 THEN 0 ELSE 1 END) WHERE idUser = ?";

        $query = $this->db->prepare($sql);
        $query->bindParam(1, $id);
        return $query -> execute();
    }

    public function deleteUser($id){
        //consulta
        $sql = "DELETE U, P FROM users AS U INNER JOIN people AS P WHERE P.idPerson = U.idPerson AND U.idUser = ?";

        $query = $this->db->prepare($sql);
        $query->bindParam(1, $id);
        return $query -> execute();
    }

    //metodo par actualizar
    public function updateUser(){
        $sql = "UPDATE people AS P INNER JOIN users AS U ON P.idPerson = U.idPerson
        SET P.idTypeDocument = ?, P.Document = ?, P.Names = ?, P.Lastname = ?, P.Email=?, P.phone = ?, P.Address = ?, U.Username = ?, U.PASSWORD = ? WHERE U.idUser = ?";

        //crear la vriable para preparar la consulta y enviarla
        $stm = $this->db->prepare($sql);
        $stm->bindParam(1, $this->idTypeDocument);
        $stm->bindParam(2, $this->document);
        $stm->bindParam(3, $this->names);
        $stm->bindParam(4, $this->lastname);
        $stm->bindParam(5, $this->email);
        $stm->bindParam(6, $this->phone);
        $stm->bindParam(7, $this->address);
        $stm->bindParam(8, $this->username);
        $stm->bindParam(9, $this->password);
        $stm->bindParam(10, $this->idUser);

        //respuesta
        $result = $stm->execute();
        return $result;


    }
}
?>