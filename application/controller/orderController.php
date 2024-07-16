<?php


use Dompdf\Dompdf;
use Dompdf\Options;
class orderController extends Controller {
    private $modelO;
    private $modelP;

    public function __construct() {
        $this->modelO = $this->loadModel("mdlOrder");
        $this->modelP = $this->loadModel("mdlProduct");
    }

    public function showOrderForm() {
        $products = $this->modelP->getProducts(); // Obtener todos los productos desde la base de datos
        require APP . 'view/ordenes/cart.php'; // Pasar los productos a la vista
    }

    public function createOrder() {
        if (isset($_POST['products']) && !empty($_POST['products'])) {
            $userId = 1; // Reemplazar con el ID del usuario actualmente autenticado
            $totalAmount = $_POST['total_amount'];

            // Crear la venta
            $saleId = $this->modelO->createSale($userId, $totalAmount);

            // Agregar los productos a la venta
            foreach ($_POST['products'] as $product) {
                $this->modelO->addProductToSale(
                    $saleId,
                    $product['product_id'],
                    $product['product_quantity'],
                    $product['price']
                );
            }

            // Redirigir a la vista de carrito
            header('Location: ' . URL . 'orderController/showCart');
            exit();
        }
    }

    public function cart() { //metodo para traer la ruta
        require APP . 'view/_templates/header.php';
        require APP . 'view/ordenes/cart.php';
        require APP . 'view/_templates/footer.php';
    }

   
    public function showCart() {
        $sales = $this->modelO->getAllSalesWithDetails();
        // var_dump($sales); // Agregar para depuración
        require APP . 'view/_templates/header.php';
        require APP . 'view/ordenes/showCart.php';
        require APP . 'view/_templates/footer.php';
    }

    
    


    //Este controlador recibe la solicitud AJAX y devuelve los detalles del producto en formato JSON.
    // este metodo es para obtener el precio
    public function getProductPrice() {
        // Verifica si se envió un nombre de producto por POST
        
        if (isset($_POST['product_name'])) {
            $productName = $_POST['product_name'];
            
            // Llama al método del modelo para obtener el precio del producto por su nombre
            $productData = $this->modelO->getProductPriceByName($productName);
    
            // Devuelve el resultado en formato JSON
            if ($productData !== null) {
                echo json_encode($productData);
            } else {
                echo json_encode(['error' => 'Producto no encontrado']);
            }
        } else {
            echo json_encode(['error' => 'Nombre de producto no recibido']);
        }
    }

    //llamar al metodo que tiene el enrutado ene el router que en este caso es el header mijo
    public function showDashboard() {
        require APP . 'view/_templates/header.php';
        require APP . 'view/ordenes/dashboard.php';
        require APP . 'view/_templates/footer.php';
    }

    
    //------------------------------ los metodos para el dashboard

    public function getTotalSalesOfDay() {
        $totalSales = $this->modelO->getTotalSalesOfDay();
        echo json_encode(['total_sales' => $totalSales['total_sales']]);
    }
    
    //----------------- este metodo es para traer el mdl de la grafica
    public function getTotalSalesOfLastFiveDays() {
        $salesData = $this->modelO->getTotalSalesOfLastFiveDays();
        echo json_encode($salesData);
    }
    
    
    public function generate_pdf($sale_id) {

        

        $sale = $this->modelO->getSaleById($sale_id);

        if (!$sale) {
            show_404();
        }

        $data = [
            'sale_id' => $sale['id'],
            'username' => $sale['username'],
            'sale_date' => $sale['sale_date'],
            'total_amount' => $sale['total_amount'],
            'products' => $sale['products']
        ];

        $html = $this->loadView('ordenes/generate_pdf', $data, true);

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('invoice_' . $sale['id'] . '.pdf', ['Attachment' => true]);

        
    }

    protected function loadView($viewPath, $data = [], $returnAsString = false) {
        extract($data);
        if ($returnAsString) {
            ob_start();
        }
        require APP . 'view/' . $viewPath . '.php';
        if ($returnAsString) {
            return ob_get_clean();
        }
    }
    
    
    
}

?>
