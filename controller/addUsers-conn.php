<?php
require_once '../includes/session.php'; 
require_once '../includes/Database.php';
require_once '../model/admin.php';
$admin = new Admin();

$admin->name = $_POST['name'];
$admin->email = $_POST['email'];
$admin->phone = $_POST['phone'];
$admin->password = $_POST['password'] ;
$admin->user_type = $_POST['user_type']; 
if ($admin->addUsers()) {
    header("Location: ../view/userManagement.php?success=1");
    exit;} else {
    echo "Error: " . $admin->error;
}


?>