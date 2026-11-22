<?php
session_start();
require_once '../includes/session.php';
require_once '../includes/helpers.php';
require_once '../includes/Database.php';
require_once '../model/Wishlist.php';
require_once '../model/User.php';


// Make sure the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$wishlist = new Wishlist();
$items = $wishlist->getWishlistItems($_SESSION['id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Wishlist | Bazaar</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <style>
        .wishlist-hero {
            background: linear-gradient(120deg, #f2c66d 60%, #e2b04a 100%);
            color: #fff;
            border-radius: 0 0 32px 32px;
            box-shadow: 0 4px 24px #cdb89233;
            margin-bottom: 0;
            position: relative;
        }
        .wishlist-hero-icon {
            color: #fff;
            background: #e2b04a;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 56px;
            height: 56px;
            margin-top: 18px;
            margin-bottom: 8px;
            box-shadow: 0 2px 12px #e2cfa233;
            animation: heartPop 1s cubic-bezier(.47,1.64,.41,.8);
        }
        .wishlist-hero-title {
            font-size: 2.2rem;
            font-weight: 900;
            margin-bottom: 10px;
            letter-spacing: 0.01em;
        }
        .wishlist-hero-desc {
            font-size: 1.13rem;
            color: #fffbe7;
            margin-bottom: 0;
        }
        @keyframes heartPop {
            0% { transform: scale(0.7); opacity: 0; }
            60% { transform: scale(1.2); opacity: 1; }
            100% { transform: scale(1); opacity: 1; }
        }

        body {
            background: linear-gradient(120deg, #fff9ed 0%, #fbeedc 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', 'Arial', sans-serif;
        }
        header {
            background: linear-gradient(90deg, #f2c66d 60%, #e2b04a 100%);
            box-shadow: 0 4px 24px #cdb89233;
            border-radius: 0 0 32px 32px;
            margin-bottom: 24px;
        }
        .logo {
            font-size: 2rem;
            font-weight: 900;
            color: #fff;
            letter-spacing: 1px;
            padding: 14px 0 0 18px;
        }
        .wishlist-section {
            max-width: 1200px;
            margin: 40px auto 0 auto;
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 4px 28px #e9c97a33;
            padding: 34px 36px 32px 36px;
        }
        .wishlist-section h2 {
            font-size: 2rem;
            font-weight: 900;
            color: #c19a6b;
            margin-bottom: 28px;
            letter-spacing: 0.01em;
            text-align: center;
        }
        #wishlistItems {
            margin-top: 18px;
        }
        .wishlist-card {
            background: linear-gradient(120deg, #fffefb 60%, #fff9ed 100%);
            border-radius: 18px;
            box-shadow: 0 2px 18px #e2cfa233;
            padding: 18px 16px 16px 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: box-shadow 0.18s, transform 0.13s;
            position: relative;
            min-height: 330px;
            animation: wishlistCardFadeIn 0.85s cubic-bezier(.47,1.64,.41,.8);
        }
        .wishlist-card:hover {
            box-shadow: 0 8px 32px #e2b04a33;
            transform: translateY(-6px) scale(1.03);
        }
        @keyframes wishlistCardFadeIn {
            0% { opacity: 0; transform: translateY(30px) scale(0.96); }
            100% { opacity: 1; transform: translateY(0) scale(1); }
        }
        .wishlist-card .wishlist-heart {
            position: absolute;
            top: 16px;
            left: 16px;
            color: #e2556c;
            background: #fff;
            border-radius: 50%;
            padding: 7px 9px 7px 9px;
            box-shadow: 0 2px 10px #e2cfa233;
            font-size: 1.2rem;
            animation: heartPop 0.7s cubic-bezier(.47,1.64,.41,.8);
        }

        .wishlist-card img {
            max-width: 120px;
            max-height: 120px;
            border-radius: 12px;
            margin-bottom: 14px;
            box-shadow: 0 2px 12px #e2cfa233;
        }
        .wishlist-card .card-title {
            font-size: 1.14rem;
            font-weight: 800;
            color: #7c6845;
            margin-bottom: 6px;
            text-align: center;
        }
        .wishlist-card .card-text {
            color: #8e7a5a;
            font-size: 1.01rem;
            margin-bottom: 10px;
            text-align: center;
        }
        .wishlist-card .btn {
            border-radius: 8px;
            font-weight: 600;
        }
        .wishlist-btn {
            background: #fff;
            border: none;
            color: #e2b04a;
            border-radius: 50%;
            box-shadow: 0 2px 8px #e2cfa233;
            padding: 6px 8px;
            transition: background 0.12s, color 0.12s;
        }
        .wishlist-btn:hover {
            background: #f2c66d;
            color: #fff;
        }
        @media (max-width: 900px) {
            .wishlist-section { padding: 22px 2vw; }
        }
        @media (max-width: 600px) {
            .wishlist-section { padding: 10px 1vw; }
            .wishlist-card { padding: 12px 4vw; }
        }
    </style>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">Bazaar</div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
            
                <li><a href="categories.html">Categories</a></li>
            
                <li><a href="myorders.php">Order History</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.php">Contact</a></li>
  
            </ul>
          <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>

    <div class="cart-icon" id="cartIcon" style="cursor:pointer;" onclick="window.location.href='cart.php'">
        <span class="cart-count" id="cartCount">0</span>
        <img src="uploads/cart.svg" alt="Cart" height="28">
    </div>
<?php else: ?>
   
    <div class="cart-icon" id="cartIcon" style="cursor:pointer;" onclick="window.location.href='notlogged.html'">
        <span class="cart-count" id="cartCount">0</span>
        <img src="uploads/cart.svg" alt="Cart" height="28">
    </div>
<?php endif; ?>
            <div class="nav-account" id="navAccount">
                <img class="nav-avatar" src="uploads/avatar.png" alt="Admin User" />
                        <span class="nav-username">
    <?php
        if (isLoggedIn()) {
            echo htmlspecialchars($_SESSION['name'] ?? '');
        } else {
            echo 'Guest'; 
        }
    ?>
         </span>
                <button class="account-btn" id="accountBtn" aria-label="Account" tabindex="0">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <circle cx="12" cy="8" r="4" stroke="#c19a6b" stroke-width="2"/>
                      <path d="M4 20c0-3.3137 3.134-6 7-6s7 2.6863 7 6" stroke="#c19a6b" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </button>
                <div class="dropdown-pointer"></div>
                <div class="account-dropdown" id="accountDropdown">
                    <a href="profile.html"><svg width="20" height="20" fill="none" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4" stroke="#6a4a1b" stroke-width="2"/><path d="M4 20c0-3.3137 3.134-6 7-6s7 2.6863 7 6" stroke="#6a4a1b" stroke-width="2" stroke-linecap="round"/></svg> Profile</a>
                    <a href="setting.html"><svg width="20" height="20" fill="none" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3" stroke="#6a4a1b" stroke-width="2"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 01-2.83 2.83l-.06-.06A1.65 1.65 0 0015 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 008.6 15a1.65 1.65 0 00-1.82-.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.6c.29-.12.61-.19.94-.19s.65.07.94.19a1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0015.4 9c.12.29.19.61.19.94s-.07.65-.19.94z" stroke="#6a4a1b" stroke-width="2"/></svg> Settings</a>
                    <a href="#" id="logoutBtnDropdown"><svg width="20" height="20" fill="none" viewBox="0 0 24 24"><path d="M16 17l5-5-5-5M21 12H9" stroke="#6a4a1b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><rect x="3" y="4" width="6" height="16" rx="2" stroke="#6a4a1b" stroke-width="2"/></svg> Logout</a>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <section class="wishlist-hero text-center py-4 mb-4">
            <div class="wishlist-hero-icon mb-2">
                <i class="fa-solid fa-heart fa-2x"></i>
            </div>
            <h2 class="wishlist-hero-title">My Wishlist</h2>
            <p class="wishlist-hero-desc">All your favorite products in one beautiful place. Add them to your cart anytime!</p>
        </section>
        <section class="wishlist-section">
            <h2>My Wishlist</h2>
    <div class="row g-4">
        <?php if (empty($items)): ?>
            <div class="alert alert-warning text-center">Your wishlist is empty.</div>
        <?php else: ?>
            <?php foreach ($items as $item): ?>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="wishlist-card h-100 shadow-sm position-relative">
                        <span class="wishlist-heart"><i class="fa-solid fa-heart"></i></span>
                        <form action="../controller/AddFromWishlistToCart-Conn.php" method="POST" class="position-absolute top-0 end-0 m-2">
    <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
    <input type="hidden" name="wishlist_id" value="<?= $item['wishlist_id'] ?>">
    <input type="hidden" name="quantity" value="1">
    <button class="btn btn-light btn-sm wishlist-btn" title="Add to Cart" type="submit">
        <i class="fa-solid fa-cart-plus"></i>
    </button>
</form>
                        <img src="uploads/<?= htmlspecialchars($item['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($item['title']) ?>">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= htmlspecialchars($item['title']) ?></h5>
                            <p class="card-text">Price: <span class="fw-bold">$<?= $item['price'] ?></span></p>
                            <form action="../controller/DeleteWishlist-conn.php" method="POST">
                                <input type="hidden" name="wishlist_id" value="<?= $item['wishlist_id'] ?>">
                                <button type="submit" class="btn btn-danger mt-2">
                                    <i class="fa-solid fa-trash me-2"></i>Remove
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
        </section>
    </main>
    <footer>
        <div class="footer-content">
            <span>&copy; 2025 Bazaar E-commerce. All rights reserved.</span>
        </div>
    </footer>
    <script src="app.js"></script>
    <script>
    // Wishlist logic
    const wishlistDiv = document.getElementById('wishlistItems');
    const user = localStorage.getItem('bazaar_user');
    function getWishlist() {
        const all = JSON.parse(localStorage.getItem('bazaar_wishlist')||'{}');
        return all[user] || [];
    }
    function saveWishlist(list) {
        const all = JSON.parse(localStorage.getItem('bazaar_wishlist')||'{}');
        all[user] = list;
        localStorage.setItem('bazaar_wishlist', JSON.stringify(all));
    }
    function renderWishlist() {
    const list = getWishlist();
    if (!user) {
        wishlistDiv.innerHTML = '<div class="alert alert-warning text-center">Please log in to view your wishlist.</div>';
    } else if (list.length === 0) {
        wishlistDiv.innerHTML = `<div class="d-flex flex-column align-items-center justify-content-center py-5 w-100">
            <img src="uploads/empty-wishlist.svg" alt="Empty Wishlist" style="max-width:180px;opacity:0.7;">
            <div class="fw-bold mt-3 mb-2" style="font-size:1.25rem;color:#b49a6c;">Your wishlist is empty</div>
            <div style="color:#a18c5c;font-size:1.07rem;">Start adding your favorite products!</div>
        </div>`;
    } else {
        wishlistDiv.innerHTML = list.map(item => `
            <div class="col-12 col-sm-6 col-md-4">
                <div class="wishlist-card h-100 shadow-sm position-relative">
                    <span class="wishlist-heart"><i class="fa-solid fa-heart"></i></span>
                    <button class="btn btn-light btn-sm position-absolute top-0 end-0 m-2 wishlist-btn" title="Remove from wishlist" onclick="removeFromWishlist('${item.id}')">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                    <img src="${item.img || item.image}" alt="${item.title}" class="card-img-top" style="height:160px;object-fit:cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">${item.title}</h5>
                        <p class="card-text">Price: <span class="fw-bold">$${item.price.toFixed(2)}</span></p>
                        <div class="mt-auto d-flex flex-column gap-2">
                            <button onclick="addToCartFromWishlist('${item.id}')" class="btn btn-primary"><i class="fa-solid fa-cart-plus me-2"></i>Add to Cart</button>
                            <button onclick="removeFromWishlist('${item.id}')" class="btn btn-danger"><i class="fa-solid fa-trash me-2"></i>Remove</button>
                        </div>
                    </div>
                </div>
            </div>
        `).join('');
    }
}
    function addToCartFromWishlist(id) {
        // Get product from wishlist
        const list = getWishlist();
        const prod = list.find(x=>x.id==id);
        if (prod) {
            let cart = JSON.parse(localStorage.getItem('bazaar_cart')||'[]');
            cart.push({...prod, qty:1, img: prod.img || prod.image});
            localStorage.setItem('bazaar_cart', JSON.stringify(cart));
            if (typeof updateCart === 'function') updateCart();
            removeFromWishlist(id);
            alert('Added to cart!');
        }
    }
    function removeFromWishlist(id) {
        let list = getWishlist();
        list = list.filter(x=>x.id!=id);
        saveWishlist(list);
        renderWishlist();
    }
    renderWishlist();
    </script>
</body>
</html>
