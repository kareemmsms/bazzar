<?php
require_once '../includes/session.php'; 
require_once '../includes/Database.php';
require_once '../model/Wishlist.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['id']) && isset($_POST['product_id'])) {
        $userID = $_SESSION['id'];
        $productID = $_POST['product_id'];

        $wishlist = new Wishlist();

        // Check if the product is already in the wishlist
        if (!$wishlist->existsInWishlist($userID, $productID)) {
            $success = $wishlist->addToWishlist($userID, $productID);
            if ($success) {
             
           header("Location: ../view/index.php");
            } else {
                echo "An error occurred while adding the product ❌";
            }
        } else {
            echo "Product is already in your wishlist ❤️";
        }
    } else {
        echo "Missing data!";
    }
} else {
    echo "Invalid request!";
}
