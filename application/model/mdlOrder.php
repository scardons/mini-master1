<?php

require_once("mdlPeople.php");

class mdlOrder extends mdlPeople {
   

    public function createOrder($user_id, $total_amount) {
        try {
            $sql = "INSERT INTO orders (user_id, total_amount, order_date, status) VALUES (?, ?, NOW(), 'Pending')";
            $query = $this->db->prepare($sql);
            $query->execute([$user_id, $total_amount]);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log('Error creating order: ' . $e->getMessage());
            return false;
        }
    }

    public function addOrderItem($order_id, $product_id, $quantity, $price) {
        try {
            $sql = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
            $query = $this->db->prepare($sql);
            return $query->execute([$order_id, $product_id, $quantity, $price]);
        } catch (PDOException $e) {
            error_log('Error adding order item: ' . $e->getMessage());
            return false;
        }
    }

    public function addPayment($order_id, $amount, $payment_method, $payment_status) {
        try {
            $sql = "INSERT INTO payments (order_id, payment_date, amount, payment_method, payment_status) VALUES (?, NOW(), ?, ?, ?)";
            $query = $this->db->prepare($sql);
            return $query->execute([$order_id, $amount, $payment_method, $payment_status]);
        } catch (PDOException $e) {
            error_log('Error adding payment: ' . $e->getMessage());
            return false;
        }
    }
    //metodo del modelo para traer el precio del product
    public function getProductPriceByName($productName) {
        $sql = "SELECT product_id, product_name, product_price FROM product WHERE product_name = ?";
        $query = $this->db->prepare($sql);
        $query->execute([$productName]);
        
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result ? $result : null;
    }
    //-----------------------------------------------metodos para traer las ventas a showcart
    //Modelo: Métodos para insertar ventas y productos, y recuperar ventas y detalles de ventas.
    public function createSale($userId, $totalAmount) {
        $sql = "INSERT INTO sales (user_id, total_amount) VALUES (?, ?)";
        $query = $this->db->prepare($sql);
        $query->execute([$userId, $totalAmount]);
        return $this->db->lastInsertId();
    }

    public function addProductToSale($saleId, $productId, $quantity, $price) {
        $sql = "INSERT INTO sales_products (sale_id, product_id, product_quantity, product_price) VALUES (?, ?, ?, ?)";
        $query = $this->db->prepare($sql);
        $query->execute([$saleId, $productId, $quantity, $price]);
    }

    public function getAllSalesWithDetails() {
        $sql = "SELECT s.sale_id, s.sale_date, s.total_amount, u.username, 
                       p.product_name, sp.product_quantity, sp.product_price
                FROM sales s
                JOIN users u ON s.user_id = u.idUser
                JOIN sales_products sp ON s.sale_id = sp.sale_id
                JOIN product p ON sp.product_id = p.product_id";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    //-----------------------este modelo es del escritorio
    public function getTotalSalesOfDay() {
        $sql = "SELECT SUM(total_amount) as total_sales 
                FROM sales 
                WHERE DATE(sale_date) = CURDATE()";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getTotalSalesOfLastFiveDays() {
        $sql = "SELECT DATE(sale_date) as sale_date, SUM(total_amount) as total_sales_amount 
                FROM sales 
                WHERE sale_date >= DATE_SUB(CURDATE(), INTERVAL 5 DAY)
                GROUP BY DATE(sale_date)
                ORDER BY sale_date ASC";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
}

?>
