<?php
require_once '../includes/session.php'; 
require_once '../includes/Database.php';
require_once '../model/admin.php';

if (!isset($_GET['id'])) {
    echo "Missing user ID.";
    exit;
}

$admin = new Admin();
$id = $_GET['id'];

if ($admin->deleteUsers($id)) {
    header("Location: ../view/userManagement.php");
    exit;
} else {
    echo "Error: " . $admin->error;
}
?>