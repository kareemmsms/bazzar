<?php
require_once '../includes/session.php';
require_once '../includes/Database.php';
require_once '../model/admin.php';

header('Content-Type: application/json');

$database = new Database();
$conn = $database->getConnection();
$admin = new Admin( );
$products = $admin->getProducts();
echo json_encode($products);
?>