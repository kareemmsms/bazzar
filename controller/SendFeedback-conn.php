<?php
require_once '../model/Feedback.php';
require_once '../includes/session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ;
    $email =$_POST['email'] ;
    $message = $_POST['message'];
    if ($name && $email && $message) {
        $feedback = new Feedback();
        if ($feedback->addFeedback($name, $email, $message)) {
            header("Location: ../view/feedback-success.html");
            exit;
        } else {
            echo " Failed to submit feedback.";
        }
    } else {
        echo " Please fill all fields.";
    }
}
?>
