<?php


session_start();
require_once '../includes/Database.php';
require_once '../model/OrderItem.php';
$database = new Database();
$conn = $database->getConnection();


if (!isset($_SESSION['id'])) {
    die("Please login first.");
}

$customerID = $_SESSION['id'];

// 1. هات cartID
$stmt = $conn->prepare("SELECT cartID FROM cart WHERE customerID = :cid");
$stmt->execute([':cid' => $customerID]);
$cart = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$cart) {
    die("Cart not found");
}

$cartID = $cart['cartID'];


$stmt = $conn->prepare("
    SELECT c.productID, c.quantity, p.price
    FROM cartitem c
    JOIN products p ON c.productID = p.ProductID
    WHERE c.cartID = :cartID
");
$stmt->execute([':cartID' => $cartID]);
$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($cartItems) == 0) {
    die("Cart is empty.");
}


$total = 0;
foreach ($cartItems as $item) {
    $total += $item['price'] * $item['quantity'];
}


$stmt = $conn->prepare("
    INSERT INTO `order` (customerID, date, status, totalAmount)
    VALUES (:cid, CURDATE(), 'pending', :total)
");
$stmt->execute([
    ':cid' => $customerID,
    ':total' => $total
]);

$orderID = $conn->lastInsertId();



foreach ($cartItems as $item) {
    $orderItem = new OrderItem();
    $orderItem->orderID = $orderID; 
    $orderItem->productID = $item['productID'];
    $orderItem->quantity = $item['quantity'];
    $orderItem->price = $item['price'];
    $orderItem->addToOrder();
}

$stmt = $conn->prepare("DELETE FROM cartitem WHERE cartID = :cartID");
$stmt->execute([':cartID' => $cartID]);


$_SESSION['success'] = "Order placed successfully!";
header("Location: ../view/order-confirmed.html"); 
?>


