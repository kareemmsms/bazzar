<?php
require_once 'products.php';

class Cart {
    public int $cartID;
    public int $customerID;
    public int $productID;

     public $conn;

  
       public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    public function getCartByCustomer($customerID) {
        $sql = "SELECT * FROM cart WHERE customerID = :customerID";
        $customerID = $_SESSION['id'];
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':customerID' => $customerID]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
        
    }

    public function createCart($customerID) {
        $sql = "INSERT INTO cart (customerID) VALUES (:customerID)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':customerID' => $customerID]);
        return $this->conn->lastInsertId();
    }
public function getCartItemsWithID($customerID) {
    $sql = "SELECT c.cartID, ci.cartItemID, ci.productID, ci.quantity, 
                   p.nameproduct, p.price, p.image
            FROM cartitem ci
            JOIN cart c ON ci.cartID = c.cartID
            JOIN products p ON ci.productID = p.ProductID
            WHERE c.customerID = :customerID";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([':customerID' => $customerID]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function updateQuantity($cartItemID, $quantity) {
    $sql = "UPDATE cartitem SET quantity = :quantity WHERE cartItemID = :cartItemID";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([':quantity' => $quantity, ':cartItemID' => $cartItemID]);
}

public function deleteItem($cartItemID) {
    $sql = "DELETE FROM cartitem WHERE cartItemID = :cartItemID";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([':cartItemID' => $cartItemID]);
}

public function addItem() {
    if (isset($_POST['cartID'], $_POST['productID'], $_POST['quantity'])) {
        $cartID = $_POST['cartID'];
        $productID = $_POST['productID'];
        $quantity = $_POST['quantity'];

        $sql = "INSERT INTO cartitem (cartID, productID, quantity)
                VALUES (:cartID, :productID, :quantity)";
        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':cartID' => $cartID,
            ':productID' => $productID,
            ':quantity' => $quantity
        ]);
    } else {
        echo " Missing cart data.";
    }
}

public function addItemFromWishlist($cartID, $productID, $quantity)
{
    $sql = "INSERT INTO cartitem (cartID, productID, quantity)
            VALUES (:cartID, :productID, :quantity)";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([
        ':cartID' => $cartID,
        ':productID' => $productID,
        ':quantity' => $quantity
    ]);
}


    public function removeItem() {}
    public function clearCart() {}
    public function viewCart() {}
}

?>