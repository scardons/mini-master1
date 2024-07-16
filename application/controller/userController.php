<?php
//crear la clase 
class userController extends Controller{
    // este atributo se encargara de hacer el el llamado al archivo modelo 
    //se crean cuantos sean necesarios 
    private $modelU;
    private $modelR;


    //crear el constructor para llamar los modelos 
    public function __construct(){
        //instanciar los modelos
        $this->modelU = $this->loadModel("mdlUsers");
        $this->modelR = $this->loadModel("mdlRoles");
    }

    // metodo para llamar el login y poder hacer sesion


    public function login(){
        //para llamar al login uso la constante APP y la funcion require de php 
        //esta variable nos va a permitir capturar todos los errores
        $error = false;

        //vamos a validar los datos que vengan del modelo y del formulario
        if(isset($_POST['btnLogin'])){
            $this->modelU->__SET('username', $_POST['txtUser']);
            $this->modelU->__SET('password', $_POST['txtPassword']);

            //guardar en un arreglo vacio
            $_POST=[];

            //con una variable vamos a llamar el método de validación del modelo
            $validate = $this->modelU->validateUser();

            //revisar la validación
            if($validate == true){
                $_SESSION['SESSION_START'] = true;

                $error = false;

                //comunicamos modelo con formulario
                $_SESSION['Names'] = $validate['Names'];
                $_SESSION['idUser'] = $validate['idUser'];
                $_SESSION['Lastname'] = $validate['Lastname'];
                $_SESSION['Document'] = $validate['Document'];
                $_SESSION['Username'] = $validate['Username'];
                $_SESSION['Description'] = $validate['Description'];

                //después de la validación cargar la vista del admin
                header("Location:" .URL."orderController/showDashboard");
            }else{
                $error = true;
            }
        }

        require APP . 'view/users/login.php';
    }

    //método para cargar el main y el admin diseños
    public function main(){
        require APP . 'view/_templates/header.php';
        require APP . 'view/users/main.php';
        require APP . 'view/_templates/footer.php';
    }

    //método para cerrar la sesión
    public function closeSession(){
        if(isset($_SESSION['SESSION_START'])){
            session_destroy();
        }

        header("Location:" .URL. "userController/login");
    }

    //método para registrar usuario
    public function userRegister(){
        //con condicional para el modelo y formulario
        if(isset($_POST['btnRegister'])){
            //comunicación modelo y formulario
            $this->modelU->__SET('idTypeDocument', $_POST['selDocType']);
            $this->modelU->__SET('document', $_POST['txtDocument']);
            $this->modelU->__SET('names', $_POST['txtNames']);
            $this->modelU->__SET('lastname', $_POST['txtLastname']);
            $this->modelU->__SET('email', $_POST['txtEmail']);
            $this->modelU->__SET('phone', $_POST['txtPhone']);
            $this->modelU->__SET('birthdate', $_POST['txtBirthdate']);
            $this->modelU->__SET('address', $_POST['txtAddress']);
            $this->modelU->__SET('gender', $_POST['selGender']);

            //vamos a crear una variable que llamará al método del modelo para poder registrar los datos
            $person = $this->modelU->registerPeople();

            //validamos que registre desde la última persona registrada
            if($person == true){
                $lastId = $this->modelU->lastPersonId();
                //con un foreach vamos a recorrer y tomar el dato
                foreach($lastId as $value){
                    $lastIdValue = $value['lastPersonId'];
                }
            }

            //datos para la tabla usuarios
            $this->modelU->__SET('idPerson', $lastIdValue);
            $this->modelU->__SET('username', $_POST['txtUser']);
            $this->modelU->__SET('password', $_POST['txtPassword']);
            $this->modelU->__SET('idRol', $_POST['selRol']);
            
            $user = $this->modelU->userRegister();

            //aquí irá el sweetalert
            if($person == true && $user == true){
                $_SESSION['alert'] = "Swal.fire({
                    position: '',
                    icon: 'success',
                    title: 'Done',
                    showConfirmButton: false,
                    timer: 1500})";

                    header("Location:" . URL. "userController/getUsers");
                    exit();
            }else{
                $_SESSION['alert'] = "Swal.fire({
                    position: '',
                    icon: 'error',
                    title: 'Error',
                    showConfirmButton: false,
                    timer: 1500})";

                    header("Location:" . URL. "userController/userRegister");
                    exit();
            }
        }
        //métodos para ver los datos necesarios
        $typeDocument = $this->modelU->getTypeDocument();
        $roles = $this->modelR->getRoles();
        
        require APP . 'view/_templates/header.php';
        require APP . 'view/users/userRegister.php';
        require APP . 'view/_templates/footer.php';
    }

    //método para obtener los datos de usuarios
    public function getUsers(){
        //vamos a tener el condicional para cuando sea el momento de editar
        if(isset($_POST['btnUpdate'])){
            $this->modelU->__SET('idTypeDocument', $_POST['selDocType']);
            $this->modelU->__SET('document', $_POST['txtDocument']);
            $this->modelU->__SET('names', $_POST['txtNames']);
            $this->modelU->__SET('lastname', $_POST['txtLastname']);
            $this->modelU->__SET('email', $_POST['txtEmail']);
            $this->modelU->__SET('phone', $_POST['txtPhone']);
            //$this->modelU->__SET('birthdate', $_POST['txtBirthdate']);
            $this->modelU->__SET('address', $_POST['txtAddress']);
            $this->modelU->__SET('username', $_POST['txtUser']);
            $this->modelU->__SET('password', $_POST['txtPassword']);
            $this->modelU->__SET('idUser', $_POST['txtIdUser']);

            //variable para actualizar
            $update = $this->modelU->updateUser();

            //aquí irá el sweetalert
        }

        //crear las variables para llamar a los métodos de los modelos
        $user = $this->modelU->getUsers();
        $roles = $this->modelR->getRoles();
        $typeDocument = $this->modelU->getTypeDocument();

        require APP . 'view/_templates/header.php';
        require APP . 'view/users/getUsers.php';
        require APP . 'view/_templates/footer.php';
    }

    //funcion para traer el ID DEL MODELO
    public function dataUser(){
        //crear una variable para controlar el dato
        $dataUser = $this->modelU->userId($_POST['id']);
        echo json_encode($dataUser);
    }

    public function changeStatus(){
        //crear una variable para controlar el dato
        $Stat = $this->modelU->changeStatus($_POST['id']);
        echo 1;
    }

    public function deleteUser(){
        //crear una variable para controlar el dato
        $Stat = $this->modelU->deleteUser($_POST['id']);
        echo 1;
    }

    public function RegisterUser(){
        //con condicional para el modelo y formulario
        if(isset($_POST['btnRegister'])){
            //comunicación modelo y formulario
            $this->modelU->__SET('product_name', $_POST['txtProduct_name']);
            $this->modelU->__SET('product_price', $_POST['txtProduct_price']);
            $this->modelU->__SET('product_quantity', $_POST['txtProduct_quantity']);
            $this->modelU->__SET('product_status', $_POST['txtProduct_status']);

            //vamos a crear una variable que llamará al método del modelo para poder registrar los datos
            $product = $this->modelU->registerUser();

            //validamos que registre desde la última persona registrada
            if($product == true){
                $lastId = $this->modelU->lastPersonId();
                //con un foreach vamos a recorrer y tomar el dato
                foreach($lastId as $value){
                    $lastIdValue = $value['lastPersonId'];
                }
            }

        
            $user = $this->modelU->registerProduct();

            //aquí irá el sweetalert
            // if($product == true && $user == true){
            //     $_SESSION['alert'] = "Swal.fire({
            //         position: '',
            //         icon: 'success',
            //         title: 'Done',
            //         showConfirmButton: false,
            //         timer: 1500})";

            //         header("Location:" . URL. "userController/getUsers");
            //         exit();
            // }else{
            //     $_SESSION['alert'] = "Swal.fire({
            //         position: '',
            //         icon: 'error',
            //         title: 'Error',
            //         showConfirmButton: false,
            //         timer: 1500})";

            //         header("Location:" . URL. "userController/userRegister");
            //         exit();
            // }
        }
        
        require APP . 'view/_templates/header.php';
        require APP . 'view/user/userRegister.php';
        require APP . 'view/_templates/footer.php';
    }

}
?>