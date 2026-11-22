<?php
require_once __DIR__ . '/../includes/Database.php';

class Feedback {
    public $conn;
public $name;
public $email;
public $message;
    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function addFeedback($name, $email, $message) {
        $sql = "INSERT INTO feedback (name, email, message) VALUES (:name, :email, :message)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':message' => $message
        ]);
    }

    public function getFeedback() {
        $sql = "SELECT * FROM feedback ORDER BY mesID DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
