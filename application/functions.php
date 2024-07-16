// application/functions.php
<?php
function show_404() {
    header("HTTP/1.0 404 Not Found");
    echo '<html><head><title>404 Not Found</title></head><body><h1>Not Found</h1><p>The requested URL was not found on this server.</p></body></html>';
    exit();
}

// application/core/Controller.php
class Controller {
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
    
    protected function loadModel($modelName) {
        require_once APP . 'model/' . $modelName . '.php';
        return new $modelName();
    }
}


?>
