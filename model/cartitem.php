<?php
require_once 'Cart.php';
class Cartitem extends Cart
{

public $conn;
public int $cartID;
public int $productID;
public int $quantity;
 public function __construct($db) {
        $this->conn = $db;
    }

  public function addItem() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $cartID = $_POST['cartID'] ;
        $productID = $_POST['productID'] ;
        $quantity = $_POST['quantity'] ;

        if ($cartID && $productID) {
            try {
                $sql = "INSERT INTO cartitem (cartID, productID, quantity) 
                        VALUES (:cartID, :productID, :quantity)";
                $stmt = $this->conn->prepare($sql);
                return $stmt->execute([
                    ':cartID' => $cartID,
                    ':productID' => $productID,
                    ':quantity' => $quantity
                ]);
            } catch (PDOException $e) {
                error_log("Insert failed: " . $e->getMessage());
                return false;
            }
        }
    }
    return false;
}
public function getCartItems($cartID) {
    $sql = "SELECT p.*, ci.quantity
            FROM cartitem ci
            JOIN products p ON ci.productID = p.ProductID
            WHERE ci.cartID = :cartID";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute([':cartID' => $cartID]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


}
?>