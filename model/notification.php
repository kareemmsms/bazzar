<?php
class Notification {
    public $conn;

  public function __construct() {
        
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function create($message) {
        $stmt = $this->conn->prepare("INSERT INTO notifications (message) VALUES (:msg)");
        $stmt->execute([':msg' => $message]);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM notifications WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAll($limit = 10) {
        $stmt = $this->conn->prepare("SELECT * FROM notifications ORDER BY created_at DESC LIMIT :limit");
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>