<?php
require_once '../includes/Database.php';
require_once '../model/Cart.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cartItemID = $_POST['cartItemID'];

    $db = new Database();
    $conn = $db->getConnection();

    $cart = new Cart();
    $cart->conn = $conn;

    $cart->deleteItem($cartItemID);
}

header("Location: ../view/cart.php");
exit;
