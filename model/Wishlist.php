<?php
require_once '../includes/Database.php';

class Wishlist
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function addToWishlist($user_id, $product_id)
    {
        $sql = "INSERT INTO wishlist (product_id, user_id, added_at) 
                VALUES (:product_id, :user_id, NOW())";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':product_id' => $product_id,
            ':user_id' => $user_id
        ]);
    }
      public function getWishlistItems($userID)
    {
        $sql = "SELECT w.id as wishlist_id, p.ProductID as id, p.nameproduct as title, p.price, p.image
                FROM wishlist w
                JOIN products p ON w.product_id = p.ProductID
                WHERE w.user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':user_id' => $userID]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getWishlistByUser($user_id)
    {
        $sql = "SELECT w.*, p.nameproduct, p.price, p.image
                FROM wishlist w
                JOIN products p ON w.product_id = p.ProductID
                WHERE w.user_id = :user_id
                ORDER BY w.added_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function removeFromWishlist($wishlist_id)
    {
        $sql = "DELETE FROM wishlist WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $wishlist_id]);
    }

    public function existsInWishlist($user_id, $product_id)
    {
        $sql = "SELECT id FROM wishlist WHERE user_id = :user_id AND product_id = :product_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':user_id' => $user_id,
            ':product_id' => $product_id
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    }
}
