<?php

function redirect($url){
    header('Location: ');
    exit;
}

function isPostRequest(){
    return $_SERVER['REQUEST_METHOD'] == "POST";
}

function getPostData($field, $default = null){
    return isset($_POST[$field]) ? trim($_POST[$field]) : $default;
}



function formatDate($date)
{
    return date('F j, Y', strtotime($date));
}


function isLoggedIn()
{
    if(isset($_SESSION['email'])){
        return true;
    } else {
        return false;
    }
}


function checkUserLoggedIn(){
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }
    if(!isset($_SESSION['email'])){
        redirect("login.php");
    }

}

// function user_exists($conn, $username) {
//     $sql = "SELECT * FROM users WHERE name = ? LIMIT 1";
//     $stmt = $conn->prepare($sql);
//     $stmt->bindParam(':username', $username);
//     $stmt->execute();
//     $result = $stmt->get_result();
//       $user = $stmt->fetch(PDO::FETCH_ASSOC);
//     return $result->num_rows > 0;
// }
function user_exists(PDO $conn, $username) {
    $sql = "SELECT * FROM users WHERE name = :username";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':username' => $username]); 
    return $stmt->fetch(PDO::FETCH_ASSOC) ? true : false;
}

function email_exists(PDO $conn, $email) {
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user ? true : false;
}
