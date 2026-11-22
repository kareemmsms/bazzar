<?php

class Product
{
    public $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllProducts()
    {
        $sql = "SELECT * FROM products";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($id)
    {
        $sql = "SELECT * FROM products WHERE ProductID = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Add more methods as needed (addProduct, updateProduct, deleteProduct, etc.)
}

?>
