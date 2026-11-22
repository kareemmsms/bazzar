<?php
require_once '../includes/Database.php';
require_once '../includes/session.php'; 
require_once '../model/Cart.php';
require_once '../model/Wishlist.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['id'], $_POST['product_id'], $_POST['wishlist_id'], $_POST['quantity'])) {
        $customerID = $_SESSION['id'];
        $productID = $_POST['product_id'];
        $wishlistID = $_POST['wishlist_id'];
        $quantity = (int) $_POST['quantity'];

        $cart = new Cart();
        $wishlist = new Wishlist();

        // Get cart or create it
        $cartData = $cart->getCartByCustomer($customerID);
        if (!$cartData) {
            $cartID = $cart->createCart($customerID);
        } else {
            $cartID = $cartData['cartID'];
        }

        // Add to cart
        $cart->addItemFromWishlist($cartID, $productID, $quantity);

        // Remove from wishlist after adding
        $wishlist->removeFromWishlist($wishlistID);

        echo "Item moved from wishlist to cart successfully ✅";
    } else {
        echo "Missing data!";
    }
} else {
    echo "Invalid request!";
}
