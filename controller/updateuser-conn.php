<?php
require_once '../includes/Database.php';
require_once '../model/admin.php';
require_once '../includes/session.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admin = new Admin();
    $id = $_POST['id'];

    $admin->name = $_POST['name'];
    $admin->email = $_POST['email'];
    $admin->phone = $_POST['phone'];
    $admin->user_type = $_POST['user_type'];

    if ($admin->editUsers($id)) {
        header("Location: ../view/userManagement.php");
        exit;
    } else {
        echo "Error: " . $admin->error;
    }
}
?>
