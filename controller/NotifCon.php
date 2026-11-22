<?php
require_once '../includes/Database.php';
require_once '../model/notification.php';

class NotificationController {
    public $notification;

    public function __construct() {
        $db = (new Database())->getConnection();
        $this->notification = new Notification();
    }

    public function showNotification($id) {
        return $this->notification->getById($id);
    }

    public function showAllNotifications($limit = 10) {
        return $this->notification->getAll($limit);
    }

    public function createNotification($message) {
        $this->notification->create($message);
    }
}
