<?php
require_once '../includes/session.php'; 
require_once '../includes/Database.php';
require_once '../model/admin.php';
$admin = new Admin();

$admin->nameproduct = $_POST['nameproduct'];
$admin->price = $_POST['price'];
$admin->stock = $_POST['stock'];
$admin->description = $_POST['description'];
$admin->image = $_POST['image']; 
$admin->category = $_POST['category']; 
if ($admin->addProducts()) {
    header("Location: ../view/prdManagemnt.php?success=1");
    exit;
} else {
    echo "Error: " . $admin->error;
}
