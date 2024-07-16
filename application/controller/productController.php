<?php

class productController extends Controller {
    private $modelP;

    public function __construct() {
        $this->modelP = $this->loadModel("mdlProduct");
    }

    public function registerProduct() {
        if (isset($_POST['btnRegisterProduct'])) {
            $this->modelP->__SET('product_name', $_POST['txtProduct_name']);
            $this->modelP->__SET('product_price', $_POST['txtProduct_price']);
            $this->modelP->__SET('product_quantity', $_POST['txtProduct_quantity']);
            $this->modelP->__SET('product_status', $_POST['txtProduct_status']);
            $product = $this->modelP->registerProduct();

            if ($product == true) {
                $_SESSION['alert'] = "Swal.fire({
                    position: '',
                    icon: 'success',
                    title: 'Done',
                    showConfirmButton: false,
                    timer: 1500
                })";
                header("Location:" . URL . "productController/getProducts");
                exit();
            } else {
                $_SESSION['alert'] = "Swal.fire({
                    position: '',
                    icon: 'error',
                    title: 'Error',
                    showConfirmButton: false,
                    timer: 1500
                })";
                header("Location:" . URL . "productController/productRegister");
                exit();
            }
        }

        require APP . 'view/_templates/header.php';
        require APP . 'view/users/productRegister.php';
        require APP . 'view/_templates/footer.php';
    }

    public function getProducts() {
      //vamos a tener el condicional para cuando sea el momento  de editar los usuarios 
      if(isset($_POST['btnUpdateProduct'])){
        $this->modelP->__SET('product_id', $_POST['txtIdProduct']);
        $this->modelP->__SET('product_name', $_POST['txtProductName']);
        $this->modelP->__SET('product_price', $_POST['txtProductPrice']);
        $this->modelP->__SET('product_quantity', $_POST['txtProductQuantity']);

        //variable para actualizar 
        $update = $this->modelP->updateProduct();


    }
        $product = $this->modelP->getProducts();

        require APP . 'view/_templates/header.php';
        require APP . 'view/products/getProducts.php';
        require APP . 'view/_templates/footer.php';
    }

    

    public function dataProduct(){
        //crear una variable para controlar el dato
        $productData = $this->modelP->productId($_POST['id']);
        echo json_encode($productData);
    }

    public function changeProductStatus() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
            $productId = $_POST['id'];
    
            // Lógica para cambiar el estado del producto en el modelo (mdlProduct)
            $success = $this->modelP->changeStatusProduct($productId);
    
            if ($success) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Invalid request']);
        }
    }


    public function deleteProduct() {
        $response = array('success' => false);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['id'])) {
                $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

                if ($id) {
                    try {
                        if ($this->modelP->deleteProduct($id)) {
                            $response['success'] = true;
                        } else {
                            $response['message'] = 'Failed to delete product.';
                        }
                    } catch (PDOException $e) {
                        $response['message'] = 'Database error: ' . $e->getMessage();
                    }
                } else {
                    $response['message'] = 'Invalid product ID.';
                }
            } else {
                $response['message'] = 'Product ID is missing.';
            }
        } else {
            $response['message'] = 'Invalid request method.';
        }

        echo json_encode($response);
    }
    
    
    
    

    public function productRegister() {
        if (isset($_POST['btnRegisterProduct'])) {
            $this->modelP->__SET('product_name', $_POST['txtProduct_name']);
            $this->modelP->__SET('product_price', $_POST['txtProduct_price']);
            $this->modelP->__SET('product_quantity', $_POST['txtProduct_quantity']);
            $this->modelP->__SET('product_status', $_POST['txtProduct_status']);
    
            $product = $this->modelP->registerProduct();
    
            if ($product == true) {
                // Redireccionar a getProducts después de un registro exitoso
                header("Location: " . URL . "productController/getProducts");
                exit(); // Asegurar que no se ejecuten más instrucciones después de la redirección
            } else {
                // Manejar errores si el registro falla
                // Por ejemplo, mostrar un mensaje de error o redirigir a una página de error
            }
        }
    
        require APP . 'view/_templates/header.php';
        require APP . 'view/products/productRegister.php';
        require APP . 'view/_templates/footer.php';
    }
    
    

 


    
    
    
}
?>
