<?php  
require_once '../includes/session.php';
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/Database.php';
require_once __DIR__ . '/../model/User.php';



require_once '../includes/Database.php';
require_once '../model/User.php';

$database = new Database();
$conn = $database->getConnection();


$user = new User();
$user->logout();

 header("Location: ../view/logout.php");

?>