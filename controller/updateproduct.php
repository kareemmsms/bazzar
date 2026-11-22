<?php
require_once '../includes/Database.php';
require_once '../model/admin.php';
require_once '../includes/session.php';
$admin = new Admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['ProductID'];
    $admin->nameproduct = $_POST['nameproduct'];
    $admin->price = $_POST['price'];
    $admin->stock = $_POST['stock'];
    $admin->description = $_POST['description'];
    $admin->image = $_POST['image'];
$admin->category = $_POST['category'];
    if ($admin->editProducts($id)) {
        header("Location: ../view/prdManagemnt.php");
        exit;
    } else {
        echo "Error: " . $admin->error;
    }
}
