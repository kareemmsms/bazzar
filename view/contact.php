<?php

require_once '../includes/Database.php';
require_once '../model/User.php';

$user = new User();
$user->sendFeedback();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | Bazaar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <style>
        body {
            background: linear-gradient(120deg, #fff9ed 0%, #fbeedc 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', 'Arial', sans-serif;
        }
        .contact-hero {
            background: linear-gradient(90deg, #f2c66d 60%, #e2b04a 100%);
            color: #fff;
            border-radius: 0 0 32px 32px;
            box-shadow: 0 4px 24px #cdb89233;
            margin-bottom: 0;
            position: relative;
            text-align: center;
            padding: 2.6rem 0 2rem 0;
        }
        .contact-hero-icon {
            color: #fff;
            background: #e2b04a;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            margin-bottom: 10px;
            box-shadow: 0 2px 12px #e2cfa233;
            font-size: 2.2rem;
            animation: contactPop 1s cubic-bezier(.47,1.64,.41,.8);
        }
        .contact-hero-title {
            font-size: 2.2rem;
            font-weight: 900;
            margin-bottom: 10px;
            letter-spacing: 0.01em;
        }
        .contact-hero-desc {
            font-size: 1.13rem;
            color: #fffbe7;
            margin-bottom: 0;
        }
        @keyframes contactPop {
            0% { transform: scale(0.7); opacity: 0; }
            60% { transform: scale(1.2); opacity: 1; }
            100% { transform: scale(1); opacity: 1; }
        }
        .contact-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 110px;
            margin-bottom: 0px;
        }
        .contact-card {
            background: #fffefb;
            border-radius: 22px;
            box-shadow: 0 8px 32px #e9c97a33, 0 0 0 8px #fff;
            padding: 38px 44px 32px 44px;
            max-width: 430px;
            width: 100%;
            margin: -60px auto 0 auto;
            border: 1.5px solid #fff;
            z-index: 2;
            position: relative;
        }
        .contact-section h2 {
            display: none;
        }
        .contact-form label {
            display: flex;
            align-items: center;
            margin-bottom: 18px;
            font-weight: 600;
            color: #5b4a2b;
        }
        .contact-form .input-group {
            margin-bottom: 18px;
        }
        .contact-form .input-group-text {
            background: #fff;
            border: none;
            color: #c19a6b;
            font-size: 1.2rem;
            border-radius: 8px 0 0 8px;
            padding-left: 14px;
            padding-right: 10px;
        }
        .contact-form input,
        .contact-form textarea {
            border-radius: 0 8px 8px 0;
            border: 1px solid #e2cfa2;
            background: #fff;
            font-size: 1rem;
            font-family: inherit;
            transition: border 0.2s;
        }
        .contact-form input:focus,
        .contact-form textarea:focus {
            border: 1.5px solid #c19a6b;
            outline: none;
            background: #fffbe7;
        }
        .contact-form textarea {
            min-height: 70px;
            resize: vertical;
        }
        .input-icon {
            display: flex;
            align-items: center;
            margin-right: 6px;
        }
        .cta-btn {
            background: linear-gradient(90deg, #f2c66d 60%, #e2b04a 100%);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px 0;
            width: 100%;
            font-size: 1.13rem;
            font-weight: bold;
            cursor: pointer;
            margin-top: 8px;
            box-shadow: 0 2px 8px #e9c97a33;
            transition: background 0.2s, box-shadow 0.2s, transform 0.15s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        .cta-btn:hover, .cta-btn:focus {
            background: #e2b04a;
            box-shadow: 0 4px 16px #e9c97a55;
            transform: translateY(-2px) scale(1.03);
        }
        .contact-success {
            color: #2a7a2a;
            margin-top: 14px;
            font-weight: 600;
            min-height: 22px;
            text-align: center;
        }
        @media (max-width: 600px) {
            .contact-card {
                padding: 18px 6vw 16px 6vw;
                max-width: 98vw;
            }
            .contact-section {
                margin-top: 0;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">Bazaar</div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="categories.html">Categories</a></li>
                <li><a href="wishlist.html">Wishlist</a></li>
                <li><a href="orders.html">Orders</a></li>
                <li><a href="about.html">About</a></li>
               
            </ul>
            <div class="cart-icon" id="cartIcon">
                <span class="cart-count" id="cartCount">0</span>
                <img src="uploads/cart.svg" alt="Cart" height="28">
            </div>
            <div class="nav-account" id="navAccount">
                <img class="nav-avatar" src="uploads/avatar.png" alt="Admin User" />
                <span class="nav-username">Admin User</span>
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
        <section class="contact-hero">
            <div class="contact-hero-icon mb-2">
                <i class="fa-solid fa-envelope"></i>
            </div>
            <h2 class="contact-hero-title">Contact Us</h2>
            <p class="contact-hero-desc">We'd love to hear from you. Send us your questions, feedback, or suggestions!</p>
        </section>
        <section class="contact-section">
            <div class="contact-card">
                <form class="contact-form" id="contactForm" method="post" action="../controller/SendFeedback-Conn.php">
                    <div class="mb-4 text-center">
                        <h3 class="fw-bold mb-2" style="color:#c19a6b;letter-spacing:0.5px;">Get in Touch</h3>
                        <div style="color:#a18c5c;font-size:1.01rem;">Fill out the form below and we'll get back to you soon.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="name" style="color:#7c6845;">Name</label>
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                            <input type="text" class="form-control" id="contactName" name="name" placeholder="Your Name" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="email" style="color:#7c6845;">Email</label>
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                            <input type="email" class="form-control" id="contactEmail" name="email" placeholder="Your Email" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold" for="message" style="color:#7c6845;">Message</label>
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text"><i class="fa-solid fa-message"></i></span>
                            <textarea class="form-control" id="contactMessage" name="message" placeholder="Type your message..." required rows="3"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="cta-btn"><i class="fa-solid fa-paper-plane me-2"></i>Send Message</button>
                    <div id="contactSuccess" class="contact-success"></div>
                </form>
            </div>
        </section>
        <script>
       
        </script>
    </main>
    <footer>
        <div class="footer-content">
            <span>&copy; 2025 Bazaar E-commerce. All rights reserved.</span>
        </div>
    </footer>
   
</body>
</html>
