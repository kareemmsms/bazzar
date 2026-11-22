<?php
require_once 'Products.php';
class OrderItem {
    public $conn;
    public int $quantity;
    public float $price;
       public int $productID;
    public int $orderID;
       public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    public function addToOrder() {
        $sql = "INSERT INTO orderitem (orderID, productID, quantity, price)
                VALUES (:orderID, :productID, :quantity, :price)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':orderID' => $this->orderID,
            ':productID' => $this->productID,
            ':quantity' => $this->quantity,
            ':price' => $this->price
        ]);
    }
}

?>