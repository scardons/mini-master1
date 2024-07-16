<?php
//crear la clase normalmente se le pone el mism nombre del fichero 

class mdlPeople{
    //atributos
    public $idPerson;

    public $document;

    public $idTypeDocument;

    public $names;

    public $lastname;

    public $phone;

    public $address;

    public $email;

    public $birthdate;

    public $gender;

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

    // metodo para registrar las personas  
    public function registerPeople(){
        //crear la consulta
        $sql = "INSERT INTO people(Document, Names, Lastname, Email, Phone, Address, Gender, Birthdate, idTypeDocument) VALUES (?,?,?,?,?,?,?,?,?)";

        //crear la vriable para preparar la consulta y enviarla
        $stm = $this->db->prepare($sql);
        $stm->bindParam(1, $this->document);
        $stm->bindParam(2, $this->names);
        $stm->bindParam(3, $this->lastname);
        $stm->bindParam(4, $this->email);
        $stm->bindParam(5, $this->phone);
        $stm->bindParam(6, $this->address);
        $stm->bindParam(7, $this->gender);
        $stm->bindParam(8, $this->birthdate);
        $stm->bindParam(9, $this->idTypeDocument);


        //respuesta
        $result = $stm->execute();
        return $result;
    }

    // metodo ppara retornar el id de la ultima persona registrada 
    public function lastPersonId(){
        //consulta 
        $sql = "SELECT MAX(idPerson) AS lastPersonId FROM people";
        $query = $this->db->prepare($sql);
        $query->execute();
        $lastId = $query->fetchAll(PDO::FETCH_ASSOC);
        return $lastId;
    }

    //metodo para poder obtener los datos de la tabla documentos 

    public function getTypeDocument(){
        //consulta 
        $sql = "SELECT idTypeDocument, Description AS doc FROM typedocuments";
        $query = $this->db->prepare($sql);
        $query->execute();
        $doc = $query->fetchAll(PDO::FETCH_ASSOC);
        return $doc;
    }
}
?>