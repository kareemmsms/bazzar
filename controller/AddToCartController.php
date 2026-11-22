<?php
session_start();
require_once '../includes/Database.php';
require_once '../model/Cart.php';
require_once '../model/admin.php';

if (!isset($_SESSION['id']) || !isset($_GET['id'])) {
    die("Missing user or product");
}

$customerID = $_SESSION['id'];
$productID = $_GET['id'];

$cart = new Cart();
$admin = new Admin();

$product = $admin->getProductById($productID);
if (!$product) {
    die("Product not found");
}

// get or create cart
$cartData = $cart->getCartByCustomer($customerID);
$cartID = $cartData ? $cartData['cartID'] : $cart->createCart($customerID);


$_POST['cartID'] = $cartID;
$_POST['productID'] = $productID;
$_POST['quantity'] = 1;


$cart->addItem();
echo json_encode(['status' => 'success']);

echo '<pre>'; print_r($_POST); echo '</pre>';

header("Location: ../view/index.php");
exit;

?>