<?php
require_once '../includes/session.php'; 
require_once '../includes/Database.php';
require_once '../model/admin.php';

$admin = new Admin();
if (!isset($_GET['id'])) {
    echo "Missing Product ID.";
    exit;
}

$admin->ProductID = $_GET['id'];

if ($admin->deleteProducts()) {
    header("Location: ../view/prdManagemnt.php");
    exit;
} else {
    echo "Error: " . $admin->error;
}
?>