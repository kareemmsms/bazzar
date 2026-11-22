<?php
require_once '../includes/session.php';
require_once '../includes/Database.php';
require_once '../model/admin.php';

header('Content-Type: application/json');

$admin = new Admin();
$users = $admin->getUsers();

if ($users) {
    echo json_encode($users);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to fetch users.']);
}
?>
