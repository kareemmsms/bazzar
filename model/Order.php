<?php
require_once 'OrderItem.php';
require_once '../includes/Database.php';

class Order {
    public int $orderID;
    public DateTime $date;
    public string $status;
    public float $totalAmount;
    public int $customerID;
    public array $items = [];

    public $conn;

    public function __construct() {
        
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function addItem(OrderItem $item) {
        $this->items[] = $item;
        $this->totalAmount += $item->price * $item->quantity;
    }

    public function saveOrder() {
   
        $stmt = $this->conn->prepare("INSERT INTO orders (customerID, orderDate, status, totalAmount) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $this->customerID,
            $this->date->format('Y-m-d'),
            $this->status,
            $this->totalAmount
        ]);
        $this->orderID = $this->conn->lastInsertId();

        
        $stmtItem = $this->conn->prepare("INSERT INTO orderitem (orderID, productID, quantity, price) VALUES (?, ?, ?, ?)");
        foreach ($this->items as $item) {
            $stmtItem->execute([
                $this->orderID,
                $item->productID,
                $item->quantity,
                $item->price
            ]);
        }
    }

    public function updateStatus($newStatus) {
        $stmt = $this->conn->prepare("UPDATE orders SET status = ? WHERE orderID = ?");
        $stmt->execute([$newStatus, $this->orderID]);
        $this->status = $newStatus;
    }
}
?>
