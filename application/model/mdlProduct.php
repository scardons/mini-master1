<?php
require_once("mdlPeople.php");

class mdlProduct extends mdlPeople {
    public $product_id;
    public $product_name;
    public $product_price;
    public $product_quantity;
    public $product_status;
    
    public function __SET($attribute, $value) {
        $this->$attribute = $value;
    }
    public function __GET($attribute) {
        return $this->$attribute;
    }

    public function __construct($db) {
        parent::__construct($db);
    }
    // Método para registrar los productos
    public function registerProduct() {
        $sql = "INSERT INTO product (product_name, product_price, product_quantity, product_status) VALUES (?, ?, ?, ?)";
        $stm = $this->db->prepare($sql);
        $stm->bindParam(1, $this->product_name);
        $stm->bindParam(2, $this->product_price);
        $stm->bindParam(3, $this->product_quantity);
        $stm->bindParam(4, $this->product_status);
        return $stm->execute();
    }

    // Método para obtener los productos
    public function getProducts() {
        $sql = "SELECT * FROM product";
        $stm = $this->db->prepare($sql);
        $stm->execute();
    
        $products = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }

    // Método para obtener el producto por id
    public function productId($id) {
        $sql = "SELECT * FROM product WHERE product_id = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $id);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para cambiar el estado del producto
    // mdlProduct.php

    public function changeStatusProduct($id) {
    $sql = "UPDATE product SET product_status = (CASE WHEN product_status = 'Activo' THEN 'Inactivo' ELSE 'Activo' END) WHERE product_id = ?";
    $query = $this->db->prepare($sql);
    $query->bindParam(1, $id);
    return $query->execute();
    }

    

    // Método para eliminar el producto
    public function deleteProduct($id) {
        $sql = "DELETE FROM product WHERE product_id = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $id);
        return $query->execute();
    }

    // Método para actualizar el producto
    public function updateProduct() {
        $sql = "UPDATE product SET product_name = ?, product_price = ?, product_quantity = ? WHERE product_id = ?";
        $stm = $this->db->prepare($sql);
        $stm->bindParam(1, $this->product_name);
        $stm->bindParam(2, $this->product_price);
        $stm->bindParam(3, $this->product_quantity);
        $stm->bindParam(4, $this->product_id);
        
        $result = $stm->execute();
        return $result;
    }
    public static function getProductPriceByName($db, $productName) {
        // Preparar y ejecutar la consulta
        $stmt = $db->prepare("SELECT price FROM product WHERE product_name = :product_name");
        $stmt->bindParam(':product_name', $productName);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result ? $result['price'] : null;
    }
}
?>
