<?php
require_once '../includes/session.php';
require_once '../includes/helpers.php';
require_once '../includes/Database.php';
require_once '../model/admin.php';
require_once '../model/User.php';

$admin = new Admin();
 $products = $admin->getProducts();
$user = new User();
$products1 =$user->addItem();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bazaar E-commerce</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* Enhanced cart sidebar and icon styles */
        .cart-icon {
            position: relative;
            margin-left: 18px;
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
        .cart-icon i {
            color: #c19a6b;
            font-size: 1.5em;
        }
        .cart-sidebar {
            position: fixed;
            top: 0;
            right: -410px;
            width: 370px;
            height: 100vh;
            background: #fffefb;
            box-shadow: -6px 0 32px #cdb89233;
            border-left: 2px solid #f2e2be;
            border-radius: 18px 0 0 18px;
            z-index: 1200;
            transition: right 0.35s cubic-bezier(.47,1.64,.41,.8);
            display: flex;
            flex-direction: column;
            padding: 0;
        }
        .cart-sidebar.open {
            right: 0;
        }
        .cart-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 26px 28px 18px 28px;
            border-bottom: 1.5px solid #f2e2be;
            background: #fff9ed;
            border-radius: 18px 0 0 0;
        }
        .cart-header h3 {
            font-size: 1.4rem;
            font-weight: 800;
            color: #c19a6b;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .cart-header h3 i {
            color: #e2b04a;
            font-size: 1.1em;
        }
        .close-cart {
            background: none;
            border: none;
            color: #e74c3c;
            font-size: 2rem;
            cursor: pointer;
            transition: color 0.18s;
        }
        .close-cart:hover {
            color: #b92c1c;
        }
        .cart-sidebar .cart-items {
            flex: 1;
            overflow-y: auto;
            padding: 18px 28px 0 28px;
        }
        .cart-sidebar .cart-footer {
            background: #fff9ed;
            border-top: 1.5px solid #f2e2be;
            border-radius: 0 0 0 18px;
            padding: 20px 28px 24px 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1.13rem;
            color: #7c6845;
            box-shadow: 0 -2px 12px #fbeedc33;
        }
        .cart-sidebar .checkout-btn {
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
        .cart-sidebar .checkout-btn:hover, .cart-sidebar .checkout-btn:focus {
            background: linear-gradient(90deg, #e2b04a 60%, #f2c66d 100%);
            box-shadow: 0 4px 24px #e9c97a55;
            transform: translateY(-2px) scale(1.01);
        }
        @media (max-width: 500px) {
            .cart-sidebar {
                width: 98vw;
                border-radius: 12px 0 0 12px;
            }
            .cart-header, .cart-sidebar .cart-footer {
                padding-left: 8vw;
                padding-right: 8vw;
            }
            .cart-sidebar .cart-items {
                padding-left: 8vw;
                padding-right: 8vw;
            }
        }
    </style>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background: linear-gradient(135deg, #fbeedc 0%, #f8e6b5 100%);
        }
        .pharaonic-hero {
            background: url('uploads/pharaoh.png') no-repeat right bottom/contain, linear-gradient(135deg, #fbeedc 0%, #f8e6b5 100%);
            min-height: 400px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding: 48px 0 48px 5vw;
            position: relative;
            border-radius: 0 0 36px 36px;
            box-shadow: 0 6px 32px #cdb89233;
            overflow: hidden;
        }
        .hero-logo {
    opacity: 0;
    transform: translateY(-30px);
    animation: fadeSlideIn 1.1s 0.2s cubic-bezier(.47,1.64,.41,.8) forwards;
}
    
        .hero-logo img {
            height: 64px;
            width: 64px;
            border-radius: 50%;
            background: #fffbe7;
            border: 2px solid #c19a6b;
            box-shadow: 0 2px 12px #e9c97a33;
        }
        .hero-title {
            font-size: 2.7rem;
            font-weight: 900;
            color: #a87c2d;
            letter-spacing: 1.2px;
            text-shadow: 0 2px 8px #f8e6b5cc;
        }
        .hero-tagline {
            font-size: 1.3rem;
            color: #6a4a1b;
            margin-bottom: 24px;
            font-weight: 500;
            letter-spacing: 0.3px;
        }
        .egyptian-motif {
            width: 120px;
            margin: 24px 0 0 0;
            opacity: 0.7;
        }
        @media (max-width: 700px) {
            .pharaonic-hero {
                min-height: 260px;
                padding: 28px 0 28px 2vw;
                border-radius: 0 0 18px 18px;
            }
            .hero-logo img {
                height: 44px;
                width: 44px;
            }
            .hero-title {
                font-size: 1.4rem;
            }
            .hero-tagline {
                font-size: 1rem;
            }
        }
        /* Animated sun and floating motifs */
    .hero-sun {
        position: absolute;
        top: 28px;
        left: 44px;
        width: 80px;
        height: 80px;
        background: radial-gradient(circle at 60% 40%, #ffe066 70%, #f7c948 100%);
        border-radius: 50%;
        box-shadow: 0 0 70px 20px #ffe06699;
        animation: sunFloat 4s ease-in-out infinite alternate;
        z-index: 1;
        opacity: 0.92;
    }
    .hero-motif {
        position: absolute;
        width: 50px;
        opacity: 0.35;
        z-index: 1;
        animation: motifFloat 5s ease-in-out infinite alternate;
    }
    .hero-motif.motif1 {
        top: 90px;
        left: 12vw;
        animation-delay: 0.5s;
    }
    .hero-motif.motif2 {
        bottom: 60px;
        left: 24vw;
        animation-delay: 1.2s;
    }
    .hero-motif.motif3 {
        top: 60px;
        right: 10vw;
        animation-delay: 1.7s;
    }
    @keyframes fadeSlideIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    @keyframes fadeSlideInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    @keyframes sunFloat {
        0% { transform: translateY(0) scale(1); }
        100% { transform: translateY(18px) scale(1.04); }
    }
    @keyframes motifFloat {
        0% { transform: translateY(0) scale(1); }
        100% { transform: translateY(-16px) scale(1.07); }
    }
    .hero-tagline {
        background: linear-gradient(90deg, #a87c2d, #ffe066, #a87c2d);
       -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-size: 200% auto;
        animation: gradientMove 3s linear infinite alternate;
    }
    @keyframes gradientMove {
        0% { background-position: 0% 50%; }
        100% { background-position: 100% 50%; }
    }
    .sparkle {
        position: absolute;
        left: 85px;
        top: 18px;
        width: 24px;
        height: 24px;
        z-index: 3;
        pointer-events: none;
        animation: sparkleTwinkle 2.2s infinite;
    }
    @keyframes sparkleTwinkle {
        0%, 100% { opacity: 0.5; transform: scale(0.8) rotate(0deg); }
        50% { opacity: 1; transform: scale(1.2) rotate(20deg); }
    }
    .product-card {
        transition: transform 0.5s cubic-bezier(.47,1.64,.41,.8), box-shadow 0.3s;
    }
    .product-card.in-view {
        transform: translateY(-18px) scale(1.04);
        box-shadow: 0 8px 32px #c19a6b33;
    }
</style>
<script>
// Parallax for sun and motifs
window.addEventListener('mousemove', function(e) {
    const hero = document.querySelector('.pharaonic-hero');
    if (!hero) return;
    const sun = document.querySelector('.hero-sun');
    const motifs = document.querySelectorAll('.hero-motif');
    const rect = hero.getBoundingClientRect();
    const x = (e.clientX - rect.left) / rect.width - 0.5;
    const y = (e.clientY - rect.top) / rect.height - 0.5;
    if(sun) sun.style.transform = `translate(${x*30}px, ${y*30}px)`;
    motifs.forEach((m, i) => {
        m.style.transform = `translate(${x*20*(i+1)}px, ${y*15*(i+1)}px)`;
    });
});
// Floating product cards on scroll
function checkCardsInView() {
    document.querySelectorAll('.product-card').forEach(card => {
        const rect = card.getBoundingClientRect();
        if(rect.top < window.innerHeight - 80) {
            card.classList.add('in-view');
        } else {
            card.classList.remove('in-view');
        }
    });
}
window.addEventListener('scroll', checkCardsInView);
window.addEventListener('DOMContentLoaded', checkCardsInView);
</script>
</head>
<body>
    <header>
    <nav class="navbar">
         <div class="logo"><i class="fa-solid fa-store"></i> Bazaar</div>
        <button class="hamburger" id="hamburgerBtn" aria-label="Open menu">
            <svg width="32" height="32" viewBox="0 0 100 100"><rect y="20" width="100" height="12" rx="6" fill="#c19a6b"/><rect y="44" width="100" height="12" rx="6" fill="#c19a6b"/><rect y="68" width="100" height="12" rx="6" fill="#c19a6b"/></svg>
        </button>
        <nav class="main-sidebar-nav">
            <!-- <a href="index.html"><svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M3 11.5L12 4l9 7.5" stroke="#c19a6b" stroke-width="2"/><rect x="6" y="12" width="12" height="8" rx="2" stroke="#c19a6b" stroke-width="2"/></svg> Home</a> -->
            <!-- <a href="products.php"><svg width="20" height="20" viewBox="0 0 24 24" fill="none"><rect x="3" y="7" width="18" height="13" rx="2" stroke="#c19a6b" stroke-width="2"/><rect x="7" y="3" width="10" height="4" rx="2" stroke="#c19a6b" stroke-width="2"/></svg> Products</a> -->
            <a href="categories.html"><svg width="20" height="20" viewBox="0 0 24 24" fill="none"><rect x="3" y="3" width="7" height="7" rx="2" stroke="#c19a6b" stroke-width="2"/><rect x="14" y="3" width="7" height="7" rx="2" stroke="#c19a6b" stroke-width="2"/><rect x="14" y="14" width="7" height="7" rx="2" stroke="#c19a6b" stroke-width="2"/><rect x="3" y="14" width="7" height="7" rx="2" stroke="#c19a6b" stroke-width="2"/></svg> Categories</a>
            <a href="wishlist.php"><svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M12 21s-6.5-4.35-9-7.5C1.5 9.5 4 5 8.5 5c2.5 0 3.5 2 3.5 2s1-2 3.5-2C20 5 22.5 9.5 21 13.5c-2.5 3.15-9 7.5-9 7.5z" stroke="#c19a6b" stroke-width="2" fill="none"/></svg> Wishlist</a>
            <a href="myorders.php"><svg width="20" height="20" viewBox="0 0 24 24" fill="none"><rect x="4" y="4" width="16" height="16" rx="2" stroke="#c19a6b" stroke-width="2"/><path d="M8 2v4" stroke="#c19a6b" stroke-width="2"/><path d="M16 2v4" stroke="#c19a6b" stroke-width="2"/><path d="M4 10h16" stroke="#c19a6b" stroke-width="2"/></svg> Orders</a>
            <a href="about.html"><svg width="20" height="20" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" stroke="#c19a6b" stroke-width="2"/><path d="M12 8v4" stroke="#c19a6b" stroke-width="2"/><circle cx="12" cy="16" r="1" fill="#c19a6b"/></svg> About</a>
            <a href="contact.php"><img src="uploads/mailbox.svg">Contact</a>
<!--             
            <a href="confirm-logout.html">logout</a> -->
        </nav>
        <div class="nav-account" id="navAccount">
          <?php
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
            echo '<img class="nav-avatar" src="uploads/person-check-fill.svg" alt="User Avatar">';
            } else {
             echo '<img class="nav-avatar" src="uploads/person.svg" alt="Guest Avatar">'; 
        }
          ?>
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
                <a href="profile.php"><svg width="20" height="20" fill="none" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4" stroke="#6a4a1b" stroke-width="2"/><path d="M4 20c0-3.3137 3.134-6 7-6s7 2.6863 7 6" stroke="#6a4a1b" stroke-width="2" stroke-linecap="round"/></svg> Profile</a>
                <a href="setting.html"><svg width="20" height="20" fill="none" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3" stroke="#6a4a1b" stroke-width="2"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 01-2.83 2.83l-.06-.06A1.65 1.65 0 0015 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 008.6 15a1.65 1.65 0 00-1.82-.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.6c.29-.12.61-.19.94-.19s.65.07.94.19a1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0015.4 9c.12.29.19.61.19.94s-.07.65-.19.94z" stroke="#6a4a1b" stroke-width="2"/></svg> Settings</a>
               
                <form action="../controller/LogoutConn.php" method="">
                <a  href="confirm-logout.html" id="logoutBtnDropdown"><svg width="20" height="20" fill="none" viewBox="0 0 24 24"><path d="M16 17l5-5-5-5M21 12H9" stroke="#6a4a1b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><rect x="3" y="4" width="6" height="16" rx="2" stroke="#6a4a1b" stroke-width="2"/></svg> Logout</a>
                 </form>
         </div>
        </div>
        

<?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>

    <div class="cart-icon" id="cartIcon" style="cursor:pointer;" onclick="window.location.href='cart.php'">
       
        <img src="uploads/cart.svg" alt="Cart" height="28">
    </div>
<?php else: ?>
   
    <div class="cart-icon" id="cartIcon" style="cursor:pointer;" onclick="window.location.href='notlogged.html'">
       
        <img src="uploads/cart.svg" alt="Cart" height="28">
    </div>
<?php endif; ?>

        </nav>
    </nav>
    </header>
    <!-- Login/Register Modal -->
    <div class="modal-bg" id="userModalBg"></div>
    <div class="user-modal" id="userModal">
        <div class="user-modal-content">
            <h2 id="modalTitle">Login</h2>
            <form id="loginForm">
                <label>Username<input type="text" id="loginUsername" required></label>
                <label>Password<input type="password" id="loginPassword" required></label>
                <button type="submit" class="cta-btn">Login</button>
            </form>
            <form id="registerForm" style="display:none;">
                <label>Username<input type="text" id="registerUsername" required></label>
                <label>Password<input type="password" id="registerPassword" required></label>
                <button type="submit" class="cta-btn">Register</button>
            </form>
            <div class="user-modal-footer">
                <span id="loginPrompt">New user? <a href="#" id="showRegister">Register here</a></span>
                <span id="registerPrompt" style="display:none;">Already have an account? <a href="#" id="showLogin">Login</a></span>
            </div>
            <div id="userModalError" class="admin-error"></div>
        </div>
    </div>
    <main id="mainContent" class="container-fluid" style="display:none;">
        <form action="../controller/AddToCartController.php" method="">
        <section class="hero pharaonic-hero" id="home">
    <div class="hero-sun"></div>
    <svg class="hero-motif motif1" viewBox="0 0 24 24" width="50" height="50"><circle cx="12" cy="8" r="4" stroke="#c19a6b" stroke-width="2" fill="none"/><path d="M4 20c0-3.3137 3.134-6 7-6s7 2.6863 7 6" stroke="#c19a6b" stroke-width="2" stroke-linecap="round" fill="none"/></svg>
    <svg class="hero-motif motif2" viewBox="0 0 24 24" width="50" height="50"><rect x="4" y="6" width="16" height="12" rx="2" stroke="#a87c2d" stroke-width="2" fill="none"/><path d="m6 8 6 5 6-5" stroke="#a87c2d" stroke-width="2" fill="none"/></svg>
    <svg class="hero-motif motif3" viewBox="0 0 24 24" width="50" height="50"><rect x="3" y="5" width="18" height="14" rx="2" stroke="#c19a6b" stroke-width="2" fill="none"/><path d="M3 7l9 6 9-6" stroke="#c19a6b" stroke-width="2" fill="none"/></svg>
    <div class="hero-content" style="position:relative;z-index:2;">
        <div class="hero-logo" style="position:relative;">
    <svg class="sparkle" viewBox="0 0 24 24"><circle cx="12" cy="12" r="5" fill="#ffe066" opacity="0.7"/><g><circle cx="12" cy="4" r="1.2" fill="#fffbe7"/><circle cx="18" cy="12" r="1" fill="#fffbe7"/><circle cx="12" cy="20" r="0.7" fill="#fffbe7"/><circle cx="6" cy="12" r="0.9" fill="#fffbe7"/></g></svg>
            <img src="uploads/pharaoh.png" alt="Bazaar Pharaoh Logo">
            <span class="hero-title">Bazaar</span>
        </div>
        <div class="hero-tagline">Where Pharaohs Shop – Experience the Grandeur of Ancient Egypt!</div>
        <a href="products.html" class="btn btn-warning btn-lg mt-3" style="transition: transform 0.18s cubic-bezier(.47,1.64,.41,.8), box-shadow 0.18s; font-weight:700; letter-spacing:0.5px;">Shop Now</a>
        <!-- <img src="uploads/pharaoh.png" alt="Egyptian Motif" class="egyptian-motif"/> -->
    </div>
</section>
        <h2 style="margin-top:44px; color:#a87c2d; font-weight:800; letter-spacing:0.8px;">Featured Products</h2>
        <section class="products-section" id="products">
            <style>
  /* Enhanced product card grid and card design */
  #productGrid .col {
    display: flex;
    align-items: stretch;
  }
  .product-card {
    background: #fffefb;
    border: 1.5px solid #e2cfa2;
    border-radius: 18px;
    min-height: 370px;
    display: flex;
    flex-direction: column;
    transition: box-shadow 0.22s cubic-bezier(.47,1.64,.41,.8), transform 0.22s cubic-bezier(.47,1.64,.41,.8);
    box-shadow: 0 2px 12px #e2b04a22;
    position: relative;
  }
  .product-card:hover {
    box-shadow: 0 8px 32px #c19a6b33;
    transform: translateY(-6px) scale(1.025);
    z-index: 2;
  }
  .product-card .badge {
    font-size: 0.82rem;
    font-weight: bold;
    border-radius: 8px;
    padding: 4px 9px;
    box-shadow: 0 2px 8px #fbeedc55;
    letter-spacing: 0.02em;
  }
  .wishlist-btn {
    background: #fffefb;
    border: 1.5px solid #e2cfa2;
    border-radius: 50%;
    padding: 6px;
    box-shadow: 0 2px 8px #fbeedc33;
    transition: background 0.18s, box-shadow 0.18s;
  }
  .wishlist-btn:hover {
    background: #fbeedc;
    box-shadow: 0 4px 16px #e2b04a33;
  }
  .product-card .product-img {
    max-height: 180px;
    max-width: 100%;
    object-fit: cover;
    display: block;
    border-radius: 14px;
    background: #fbeedc;
    box-shadow: 0 1px 8px #e2cfa233;
  }
  .product-card .card-title {
    font-weight: 700;
    color: #a87c2d;
    font-size: 1.17rem;
    margin-bottom: 2px;
    letter-spacing: 0.03em;
  }
  .product-card .card-text {
    color: #7c6845;
    font-size: 0.98rem;
    margin-bottom: 8px;
    overflow: hidden;
    text-overflow: ellipsis;
    max-height: 3.2em;
  }
  .product-card .product-price {
    color: #e2b04a;
    font-size: 1.13rem;
    font-weight: bold;
    letter-spacing: 0.02em;
  }
  @media (max-width: 700px) {
    .product-card {
      min-height: 320px;
      font-size: 0.96rem;
    }
    .product-card .card-title {
      font-size: 1rem;
    }
    .product-card .card-text {
      font-size: 0.92rem;
    }
  }
</style>
<form action="../controller/AddToCartController.php" method="">
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4" id="productGrid" aria-label="Featured Products">
  <?php foreach ($products as $index => $p): ?>
    <div class="col">
      <div class="card h-100 product-card shadow-sm w-100" tabindex="0" aria-label="<?= htmlspecialchars($p['nameproduct']) ?>">
        <div class="position-absolute top-0 end-0 m-2">
  <form method="POST" action="../controller/AddtoWishlist-Conn.php">
    <input type="hidden" name="product_id" value="<?= $p['ProductID'] ?>">
    <button 
      type="submit"
      class="btn btn-light btn-sm wishlist-btn p-1"
      aria-label="Add to wishlist"
      style="width: 34px; height: 34px; border-radius: 50%; display: flex; align-items: center; justify-content: center;"
    >
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#c19a6b" stroke-width="2">
        <path d="M12 21s-6.5-4.35-9-7.5C1.5 9.5 4 5 8.5 5c2.5 0 3.5 2 3.5 2s1-2 3.5-2C20 5 22.5 9.5 21 13.5c-2.5 3.15-9 7.5-9 7.5z"/>
      </svg>
    </button>
  </form>
</div>
        <div style="width:100%;height:200px;display:flex;align-items:center;justify-content:center;overflow:hidden;background:#fbeedc;border-radius:16px 16px 0 0;">
          <img src="<?= htmlspecialchars($p['image']) ?>" alt="<?= htmlspecialchars($p['nameproduct']) ?>" class="product-img" onerror="this.onerror=null;this.src='uploads/placeholder.png';" />
        </div>
        <div class="card-body d-flex flex-column" style="flex:1 1 auto;">
          <h5 class="card-title product-title"><?= htmlspecialchars($p['nameproduct']) ?></h5>
          <p class="card-text product-desc"><?= htmlspecialchars($p['description']) ?></p>
          <small class="text-muted" style="margin-bottom:6px;">In stock: <?= htmlspecialchars($p['stock']) ?></small>
          <div class="mt-auto d-flex justify-content-between align-items-center pt-2">
            <span class="fw-bold product-price">$<?= htmlspecialchars($p['price']) ?></span>
            <div class="d-flex gap-2">
              <a href="../controller/AddToCartController.php?id=<?= $p['ProductID'] ?>" class="btn btn-warning btn-sm" style="color:#1a2340; font-weight:600;">Add to cart</a>
              <!-- <a href="../controller/delproduct-conn.php?id=<?= $p['ProductID'] ?>" onclick="return confirm('Delete this product?')" class="btn btn-danger btn-sm" style="color:#fff; font-weight:600;">Delete</a> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>
        </section>
        </form>
    </main>
    <aside class="cart-sidebar" id="cartSidebar">
        <div class="cart-header">
            <h3><i class="fa-solid fa-cart-shopping"></i> Your Cart</h3>
            <button class="close-cart" id="closeCart">&times;</button>
        </div>
        <div class="cart-items" id="cartItems"></div>
        <div class="cart-footer">
            <span>Total: $<span id="cartTotal">0.00</span></span>
            <a href="checkout.html" class="checkout-btn" id="checkoutBtn"><i class="fa-solid fa-credit-card"></i> Checkout</a>
        </div>
    </aside>
    <div class="modal-bg" id="modalBg"></div>
   
 <footer>
        <div class="footer-content" style="background:linear-gradient(120deg,#fbeedc 40%,#e2b04a22 100%);border-top:2.5px solid #e2cfa2;box-shadow:0 -4px 32px #cdb89233;padding:38px 5vw 26px 5vw;display:flex;flex-wrap:wrap;gap:32px;justify-content:space-between;align-items:flex-start;">
            <div style="flex:1 1 260px;min-width:220px;background:#fffefb;box-shadow:0 2px 12px #fbeedc33;border-radius:16px;padding:22px 18px 16px 18px;margin-bottom:8px;">
                <div style="font-weight:800;color:#c19a6b;font-size:1.18rem;margin-bottom:8px;letter-spacing:0.04em;"><i class="fa-solid fa-store"></i> Bazaar E-commerce</div>
                <div style="font-size:1.02rem;color:#7c6845;max-width:340px;line-height:1.4;">Bazaar is your trusted platform for modern, secure, and enjoyable online shopping. Discover unique products and enjoy fast, friendly service!</div>
            </div>
            <div style="flex:1 1 200px;min-width:180px;background:#fffefb;box-shadow:0 2px 12px #fbeedc33;border-radius:16px;padding:22px 18px 16px 18px;margin-bottom:8px;">
                <div style="font-weight:700;color:#b49a6c;margin-bottom:7px;font-size:1.05rem;"><i class="fa-solid fa-envelope"></i> Email</div>
                <a href="mailto:support@bazaar.com" style="color:#7c6845;text-decoration:none;font-size:1.02rem;display:block;margin-bottom:10px;">support@bazaar.com</a>
                <div style="font-weight:700;color:#b49a6c;margin-bottom:7px;font-size:1.05rem;"><i class="fa-solid fa-phone"></i> Phone</div>
                <a href="tel:+201234567890" style="color:#7c6845;text-decoration:none;font-size:1.02rem;display:block;">01205732052</a>
                     <div style="font-weight:700;color:#b49a6c;margin-bottom:7px;font-size:1.05rem;"><i class='fa-solid fa-location-dot'></i> Address</div>
                     <a href="https://g.co/kgs/yVDp3ws" style="color:#7c6845;text-decoration:none;font-size:1.02rem;display:block;">Giza,Egypt</a>
            </div>
            <div style="flex:1 1 150px;min-width:140px;background:#fffefb;box-shadow:0 2px 12px #fbeedc33;border-radius:16px;padding:22px 18px 16px 18px;margin-bottom:8px;display:flex;flex-direction:column;align-items:center;">
                <div style="font-weight:700;color:#b49a6c;margin-bottom:10px;font-size:1.05rem;">Follow Us</div>
                <div style="display:flex;gap:18px;">
                    <a href="https://www.facebook.com/p/Bazzar-100063950767442/" aria-label="Facebook" style="color:#3b5998;font-size:1.7rem;transition:transform 0.15s;" onmouseover="this.style.transform='scale(1.18)';" onmouseout="this.style.transform='scale(1)';"><i class="fab fa-facebook"></i></a>
                    <a href="#" aria-label="Twitter" style="color:#1da1f2;font-size:1.7rem;transition:transform 0.15s;" onmouseover="this.style.transform='scale(1.18)';" onmouseout="this.style.transform='scale(1)';"><i class="fab fa-twitter"></i></a>
                    <a href="#" aria-label="Instagram" style="color:#e4405f;font-size:1.7rem;transition:transform 0.15s;" onmouseover="this.style.transform='scale(1.18)';" onmouseout="this.style.transform='scale(1)';"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div style="flex-basis:100%;text-align:center;font-size:1.01rem;color:#b49a6c;margin-top:24px;letter-spacing:0.03em;">
                &copy; 2025 Bazaar E-commerce. All rights reserved.
            </div>
        </div>
    </footer>
    
<script src="app.js">
// Account sidebar (profile icon)
const accountBtn = document.getElementById('accountBtn');
const accountSidebar = document.getElementById('accountSidebar');
const accountSidebarOverlay = document.getElementById('accountSidebarOverlay');
const closeAccountSidebar = document.getElementById('closeAccountSidebar');
accountBtn.addEventListener('click', function(e) {
  e.stopPropagation();
  accountSidebar.classList.add('open');
  accountSidebarOverlay.classList.add('open');
});
accountSidebarOverlay.addEventListener('click', function() {
  accountSidebar.classList.remove('open');
  accountSidebarOverlay.classList.remove('open');
});
closeAccountSidebar.addEventListener('click', function() {
  accountSidebar.classList.remove('open');
  accountSidebarOverlay.classList.remove('open');
});
// Hamburger/main menu sidebar
const hamburgerBtn = document.getElementById('hamburgerBtn');
const mainSidebar = document.getElementById('mainSidebar');
const mainSidebarOverlay = document.getElementById('mainSidebarOverlay');
const closeMainSidebar = document.getElementById('closeMainSidebar');
hamburgerBtn.addEventListener('click', function(e) {
  e.stopPropagation();
  mainSidebar.classList.add('open');
  mainSidebarOverlay.classList.add('open');
});
mainSidebarOverlay.addEventListener('click', function() {
  mainSidebar.classList.remove('open');
  mainSidebarOverlay.classList.remove('open');
});
closeMainSidebar.addEventListener('click', function() {
  mainSidebar.classList.remove('open');
  mainSidebarOverlay.classList.remove('open');
});
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    accountSidebar.classList.remove('open');
    accountSidebarOverlay.classList.remove('open');
    mainSidebar.classList.remove('open');
    mainSidebarOverlay.classList.remove('open');
  }
});
</script>

</body>
</html>