<?php

require_once '../includes/Database.php';
require_once '../model/User.php';
session_start();
if(isset($_SESSION['id']))
{
     header("Location:../");
    exit;
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Bazaar</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #fbeedc 0%, #f8e6b5 100%);
            min-height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
            color: #3b2d13;
        }
        .nav {
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
        .nav a {
            text-decoration: none;
            color: #6a4a1b;
            margin-right: 32px;
            font-weight: 600;
            transition: color 0.18s;
            display: flex;
            align-items: center;
        }
        .nav a:last-child { margin-right: 0; }
        .nav a:hover { color: #e2b04a; }
        .profile-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 54px;
            margin-bottom: 60px;
        }
        .profile-card {
            background: #fffefb;
            border-radius: 22px;
            box-shadow: 0 8px 32px #cdb89244;
            padding: 44px 48px 36px 48px;
            max-width: 440px;
            width: 100%;
            margin: 0 auto;
            border: 1.5px solid #f2e2be;
            animation: fadeInUp 0.7s cubic-bezier(.23,1.01,.32,1) 0.1s;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(40px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .profile-avatar {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #e2cfa2;
            background: #fff8e6;
            margin-bottom: 18px;
            box-shadow: 0 2px 12px #fbeedc55;
        }
        .profile-name {
            font-size: 2rem;
            font-weight: 800;
            color: #c19a6b;
            margin-bottom: 6px;
            letter-spacing: 0.5px;
        }
        .profile-email {
            font-size: 1.1rem;
            color: #7c6845;
            margin-bottom: 20px;
        }
        .profile-info {
            width: 100%;
            margin-bottom: 16px;
        }
        .profile-info label {
            font-weight: 600;
            color: #5b4a2b;
            margin-bottom: 4px;
            display: block;
        }
        .profile-info input {
            width: 100%;
            padding: 10px 14px;
            border-radius: 8px;
            border: 1.5px solid #e2cfa2;
            background: #fff8e6;
            font-size: 1.03rem;
            margin-bottom: 14px;
            font-family: inherit;
            box-shadow: 0 2px 8px #fbeedc33;
            transition: border 0.18s, box-shadow 0.18s;
        }
        .profile-info input:focus {
            border: 1.5px solid #c19a6b;
            outline: none;
            background: #fffbe7;
            box-shadow: 0 4px 16px #fbeedc77;
        }
        .profile-actions {
            display: flex;
            gap: 18px;
            margin-top: 8px;
            width: 100%;
            justify-content: center;
        }
        .profile-btn {
            background: linear-gradient(90deg, #f2c66d 60%, #e2b04a 100%);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px 28px;
            font-size: 1.08rem;
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
        .profile-btn:hover, .profile-btn:focus {
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
        @media (max-width: 600px) {
            .profile-card {
                padding: 18px 6vw 16px 6vw;
                max-width: 98vw;
            }
            .profile-section {
                margin-top: 18px;
            }
            .profile-name {
                font-size: 1.3rem;
            }
            .nav {
                padding: 12px 8px;
                font-size: 0.98rem;
            }
        }
    </style>
</head>
<body>
    <div class="nav">
        <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>
        <a href="cart.html"><i class="fa-solid fa-cart-shopping"></i> Cart</a>
        <a href="profile.php"><i class="fa-solid fa-user"></i> Profile</a>
        <a href="setting.html"><i class="fa-solid fa-gear"></i> Settings</a>
        <a href="confirm-logout.html"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
        
    </div>
    <main>
    <form action="../controller/login-con.php">
        <section class="profile-section">
            <div class="profile-card">
              
                <div class="profile-name">
    <?= isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'Guest' ?>
    </div>
                <div class="profile-email"><?= isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : 'Guest.com' ?></div>
                <form class="profile-info">
                   
                </form>
                <div class="profile-actions">
                    <button class="profile-btn" type="button"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                    <button class="profile-btn" type="button" style="background:linear-gradient(90deg,#e74c3c 60%,#e2b04a 100%);"><i class="fa-solid fa-trash"></i> Delete</button>
                </div>
            </div>
        </section>
    </form>
    </main>
    <footer>
        <div class="footer-content">
            <span>&copy; 2025 Bazaar E-commerce. All rights reserved.</span>
        </div>
    </footer>
</body>
</html>
