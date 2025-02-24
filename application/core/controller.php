<?php

class Controller
{
    /**
     * @var null Database Connection
     */
    public $db = null;

    /**
     * @var null Model
     */
    public $model = null;

    /**
     * Whenever controller is created, open a database connection too and load "the model".
     */
    // function __construct()
    // {
    //     $this->openDatabaseConnection();
    //     $this->loadModel();
    // }

    /**
     * Open the database connection with the credentials from application/config/config.php
     */
    private function openDatabaseConnection()
    {
        // set the (optional) options of the PDO connection. in this case, we set the fetch mode to
        // "objects", which means all results will be objects, like this: $result->user_name !
        // For example, fetch mode FETCH_ASSOC would return results like this: $result["user_name] !
        // @see http://www.php.net/manual/en/pdostatement.fetch.php
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

        // generate a database connection, using the PDO connector
        // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
        $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);
    }

    /**
     * Loads the "model".
     * @return object model
     */
    public function loadModel($model)
    {
        $this->openDatabaseConnection();
        require APP . "model/$model.php";
        // create new "model" (and pass the database connection)
        return new $model($this->db);
    }

    protected function loadView($viewPath, $data = [], $returnAsString = false) {
        // Extraer los datos para que estén disponibles en la vista
        extract($data);

        // Iniciar el buffer de salida si se va a devolver como cadena
        if ($returnAsString) {
            ob_start();
        }

        // Incluir la vista
        require APP . 'view/' . $viewPath . '.php';

        // Devolver el contenido de la vista como cadena si se indicó
        if ($returnAsString) {
            return ob_get_clean();
        }
    }
}
