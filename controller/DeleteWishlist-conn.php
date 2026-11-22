<?php
session_start();
require_once '../model/Wishlist.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['id'], $_POST['wishlist_id'])) {
        $userID = $_SESSION['id'];
        $wishlistID = $_POST['wishlist_id'];

        $wishlist = new Wishlist();

        $success = $wishlist->removeFromWishlist($wishlistID);
        if ($success) {
            echo "Wishlist item deleted successfully ✅";
        } else {
            echo "Failed to delete wishlist item ❌";
        }
    } else {
        echo "Missing data!";
    }
} else {
    echo "Invalid request!";
}
