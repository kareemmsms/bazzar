<?php
require_once '../includes/Database.php';
require_once '../model/Cart.php';

session_start();
$database = new Database();
$conn = $database->getConnection();

$cart = new Cart();
$cart->conn = $conn;

$customerID = $_SESSION['id'];
$cartItems = $cart->getCartItemsWithID($customerID);


$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart | Bazaar</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #fbeedc 0%, #f8e6b5 100%);
            min-height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
            color: #3b2d13;
        }
        .navbar {
            background: #fff;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
            padding: 18px 32px;
            box-shadow: 0 2px 12px #f8e6b5cc;
            font-size: 1.08rem;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .logo {
            font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
            font-size: 1.5rem;
            font-weight: bold;
            color: #c19a6b;
            margin-right: 32px;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .logo i {
            color: #e2b04a;
            font-size: 1.2em;
        }
        .nav-links {
            display: flex;
            list-style: none;
            margin: 0 28px 0 0;
            padding: 0;
            flex: 1;
        }
        .nav-links li {
            margin-right: 22px;
        }
        .nav-links li:last-child {
            margin-right: 0;
        }
        .nav-links a {
            text-decoration: none;
            color: #6a4a1b;
            font-weight: 600;
            transition: color 0.18s;
            display: flex;
            align-items: center;
        }
        .nav-links a:hover {
            color: #e2b04a;
        }
        .cart-icon {
            position: relative;
            margin-right: 32px;
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: transform 0.12s;
        }
        .cart-icon:hover {
            transform: scale(1.08);
        }
        .cart-count {
            position: absolute;
            top: -8px; right: -10px;
            background: #e2b04a;
            color: #fff;
            border-radius: 50%;
            font-size: 0.82rem;
            padding: 2px 7px;
            font-weight: bold;
            box-shadow: 0 2px 8px #fbeedc55;
        }
        .nav-account {
            display: flex;
            align-items: center;
            gap: 8px;
            position: relative;
        }
        .nav-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 2px solid #f2c66d;
        }
        .nav-username {
            font-size: 1.05rem;
            color: #7c6845;
            font-weight: 600;
        }
        .account-btn {
            background: none;
            border: none;
            cursor: pointer;
            margin-left: 6px;
        }
        .dropdown-pointer {
            width: 0;
            height: 0;
        }
        .account-dropdown {
            display: none;
            position: absolute;
            top: 48px;
            right: 0;
            background: #fff;
            border: 1px solid #f2e2be;
            border-radius: 10px;
            box-shadow: 0 8px 32px #cdb89244;
            min-width: 170px;
            z-index: 1001;
            padding: 12px 0;
        }
        .account-dropdown a {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #6a4a1b;
            text-decoration: none;
            font-weight: 500;
            font-size: 1rem;
            padding: 8px 20px;
            transition: background 0.14s, color 0.14s;
        }
        .account-dropdown a:hover {
            background: #fbeedc;
            color: #e2b04a;
        }
        .cart-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 48px;
            margin-bottom: 60px;
        }
        .cart-section h2 {
            font-size: 2.2rem;
            margin-bottom: 28px;
            font-weight: 800;
            color: #c19a6b;
            letter-spacing: 0.5px;
            text-align: center;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .cart-section h2 i {
            color: #e2b04a;
            font-size: 1.2em;
        }
        .cart-items {
            width: 100%;
            max-width: 650px;
            background: #fffefb;
            border-radius: 18px;
            box-shadow: 0 4px 24px #cdb89233;
            padding: 18px 28px;
            margin-bottom: 22px;
            min-height: 60px;
        }
        .cart-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 0;
            border-bottom: 1px solid #f2e2be;
            animation: fadeInUp 0.7s cubic-bezier(.23,1.01,.32,1) 0.1s;
        }
        .cart-item:last-child {
            border-bottom: none;
        }
        .cart-item-details {
            display: flex;
            align-items: center;
            gap: 18px;
        }
        .cart-item-img {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            object-fit: cover;
            border: 1.5px solid #e2cfa2;
        }
        .cart-item-title {
            font-size: 1.09rem;
            font-weight: 600;
            color: #6a4a1b;
        }
        .cart-item-qty {
            font-size: 1rem;
            color: #b49a6c;
        }
        .cart-item-remove {
            background: none;
            border: none;
            color: #e74c3c;
            font-size: 1.2rem;
            cursor: pointer;
            transition: color 0.18s;
        }
        .cart-item-remove:hover {
            color: #b92c1c;
        }
        .cart-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: 650px;
            background: #fff9ed;
            border-radius: 12px;
            box-shadow: 0 2px 12px #fbeedc33;
            padding: 18px 28px;
            font-size: 1.13rem;
            color: #7c6845;
            margin-bottom: 12px;
        }
        .checkout-btn {
            background: linear-gradient(90deg, #f2c66d 60%, #e2b04a 100%);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px 28px;
            font-size: 1.13rem;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 2px 12px #e9c97a33;
            transition: background 0.2s, box-shadow 0.2s, transform 0.14s;
            text-align: center;
            display: flex;
            align-items: center;
            gap: 10px;
            letter-spacing: 0.04em;
        }
        .checkout-btn:hover, .checkout-btn:focus {
            background: linear-gradient(90deg, #e2b04a 60%, #f2c66d 100%);
            box-shadow: 0 4px 24px #e9c97a55;
            transform: translateY(-2px) scale(1.01);
        }
        .footer-content {
            background: #fff9ed;
            border-top: 1.5px solid #e2cfa2;
            text-align: center;
            padding: 22px 0 16px 0;
            font-size: 1.01rem;
            color: #b49a6c;
            letter-spacing: 0.05em;
            box-shadow: 0 -2px 12px #fbeedc33;
        }
        .cart-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px 20px;
    margin-bottom: 16px;
    border-radius: 12px;
    background-color: #fff8e1;
    box-shadow: 0 3px 8px rgba(223, 194, 113, 0.2);
}
.cart-item-details {
    display: flex;
    align-items: center;
    gap: 18px;
}
.cart-item-img {
    width: 60px;
    height: 60px;
    border-radius: 8px;
    object-fit: cover;
    border: 2px solid #f2c66d;
}
.cart-item-title {
    font-weight: bold;
    color: #5d3b09;
}
.cart-item-qty form input[type="number"] {
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 4px 6px;
    width: 48px;
}
.cart-item-remove {
    background-color: #f9dcdc;
    border: none;
    padding: 6px 12px;
    border-radius: 6px;
    color: #d9534f;
    font-weight: bold;
    cursor: pointer;
}
.cart-item-remove:hover {
    background-color: #f2b5b5;
}
.cart-item-qty form button {
    background-color: #c19a6b;
    color: white;
    border: none;
    padding: 6px 12px;
    border-radius: 6px;
    margin-left: 6px;
    cursor: pointer;
}
.cart-item-qty form button:hover {
    background-color: #a67c52;
}
.cart-footer {
    background-color: #fff3cd;
    border: 1px solid #ffeeba;
    border-radius: 12px;
    padding: 16px 24px;
    font-size: 1.2rem;
    color: #856404;
    box-shadow: 0 2px 6px #e2cfa233;
}

        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(40px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        @media (max-width: 700px) {
            .cart-items, .cart-footer {
                max-width: 98vw;
                padding: 10px 4vw;
            }
            .cart-section {
                margin-top: 18px;
            }
            .cart-section h2 {
                font-size: 1.3rem;
            }
            .navbar {
                padding: 12px 8px;
                font-size: 0.98rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo"><i class="fa-solid fa-store"></i> Bazaar</div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="categories.html">Categories</a></li>
                <li><a href="wishlist.html">Wishlist</a></li>
                <li><a href="orders.html">Orders</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
            <div class="cart-icon" id="cartIcon">
                <span class="cart-count" id="cartCount">0</span>
                <img src="uploads/cart.svg" alt="Cart" height="28">
            </div>
            <div class="nav-account" id="navAccount">
                
                <button class="account-btn" id="accountBtn" aria-label="Account" tabindex="0">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <circle cx="12" cy="8" r="4" stroke="#c19a6b" stroke-width="2"/>
                      <path d="M4 20c0-3.3137 3.134-6 7-6s7 2.6863 7 6" stroke="#c19a6b" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </button>
                <div class="dropdown-pointer"></div>
                <div class="account-dropdown" id="accountDropdown">
                    <a href="account.html"><svg width="20" height="20" fill="none" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4" stroke="#6a4a1b" stroke-width="2"/><path d="M4 20c0-3.3137 3.134-6 7-6s7 2.6863 7 6" stroke="#6a4a1b" stroke-width="2" stroke-linecap="round"/></svg> Profile</a>
                    <a href="setting.html"><svg width="20" height="20" fill="none" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3" stroke="#6a4a1b" stroke-width="2"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 01-2.83 2.83l-.06-.06A1.65 1.65 0 0015 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 008.6 15a1.65 1.65 0 00-1.82-.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.6c.29-.12.61-.19.94-.19s.65.07.94.19a1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0015.4 9c.12.29.19.61.19.94s-.07.65-.19.94z" stroke="#6a4a1b" stroke-width="2"/></svg> Settings</a>
                    <a href="#" id="logoutBtnDropdown"><svg width="20" height="20" fill="none" viewBox="0 0 24 24"><path d="M16 17l5-5-5-5M21 12H9" stroke="#6a4a1b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><rect x="3" y="4" width="6" height="16" rx="2" stroke="#6a4a1b" stroke-width="2"/></svg> Logout</a>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <section class="cart-section">
         <div class="container mt-4">
  <h2 class="mb-4"><i class="fa-solid fa-cart-shopping"></i> Your Shopping Cart</h2>

  <?php foreach ($cartItems as $item): ?>
    <div class="cart-item">
        <div class="cart-item-details">
            <img class="cart-item-img" src="<?= htmlspecialchars($item['image']) ?>" alt="">
            <div>
                <div class="cart-item-title"><?= htmlspecialchars($item['nameproduct']) ?></div>
                <div class="cart-item-qty">
                    Quantity:
                    <form action="../controller/UpdateCartConn.php" method="POST" style="display:inline;">
                        <input type="hidden" name="cartItemID" value="<?= $item['cartItemID'] ?>">
                        <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" style="width:50px;">
                        <button type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
        <div>
            <div>$<?= $item['price'] ?> x <?= $item['quantity'] ?></div>
            <strong>Subtotal: $<?= $item['price'] * $item['quantity'] ?></strong>
            <form action="../controller/DeleteCartCon.php" method="POST" style="margin-top:10px;">
                <input type="hidden" name="cartItemID" value="<?= $item['cartItemID'] ?>">
                <button type="submit" class="cart-item-remove">Delete</button>
            </form>
        </div>
    </div>
    <?php $total += $item['price'] * $item['quantity']; ?>
<?php endforeach; ?>

 
</div>
      </tbody>
            </div>
            <div class="cart-footer">
                <span>Total: $<?= number_format($total, 2) ?></span>
                <a href="checkout.html" class="checkout-btn"><i class="fa-solid fa-credit-card"></i> Checkout</a>
            </div>
        </section>
    </main>
    <footer>
        <div class="footer-content">
            <span>&copy; 2025 Bazaar E-commerce. All rights reserved.</span>
        </div>
    </footer>
    <script src="app.js">
        
    </script>
</body>
</html>
