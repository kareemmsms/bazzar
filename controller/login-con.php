<?php
require_once '../includes/session.php';
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/Database.php';
require_once __DIR__ . '/../model/User.php';

// include './php/config/config.php';
// include './php/includes/Database.php';
// include '/php/classes/User.php';
$database = new Database();
$conn = $database->getConnection();
$user = new User();
// $user->login(); 
$user->login();

?>