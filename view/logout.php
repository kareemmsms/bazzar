<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout | Bazaar</title>
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
        .logout-container {
            max-width: 420px;
            margin: 100px auto 0 auto;
            background: #fffefb;
            border-radius: 22px;
            padding: 48px 36px 36px 36px;
            box-shadow: 0 8px 32px #cdb89244;
            border: 1.5px solid #f2e2be;
            display: flex;
            flex-direction: column;
            align-items: center;
            animation: fadeInUp 0.7s cubic-bezier(.23,1.01,.32,1) 0.1s;
        }
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(40px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .logout-icon {
            font-size: 3.2rem;
            color: #e74c3c;
            margin-bottom: 18px;
            background: #fff9ed;
            border-radius: 50%;
            padding: 18px 22px;
            box-shadow: 0 2px 16px #fbeedc44;
        }
        .logout-title {
            font-size: 2rem;
            font-weight: 800;
            color: #c19a6b;
            margin-bottom: 10px;
            text-align: center;
        }
        .logout-message {
            font-size: 1.13rem;
            color: #7c6845;
            margin-bottom: 28px;
            text-align: center;
        }
        .logout-btn {
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
        .logout-btn:hover, .logout-btn:focus {
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
            margin-top: 40px;
        }
        @media (max-width: 600px) {
            .logout-container {
                padding: 18px 6vw 16px 6vw;
                max-width: 98vw;
            }
            .logout-title {
                font-size: 1.3rem;
            }
        }
    </style>
</head>
<body>
    <main>
       
        <div class="logout-container">
            <div class="logout-icon"><i class="fa-solid fa-right-from-bracket"></i></div>
            <div class="logout-title">You have been logged out</div>
            <div class="logout-message">Thank you for visiting Bazaar. We hope to see you again soon!</div>
            <a href="login.php" class="logout-btn"><i class="fa-solid fa-arrow-right-to-bracket"></i> Login Again</a>
            <a href="index.php" class="logout-btn" style="margin-top: 14px; background: linear-gradient(90deg, #b8b8b8 60%, #e2b04a 100%);"><i class="fa-solid fa-user"></i> Continue as Guest</a>
        </div>
      
    </main>
    <footer>
        <div class="footer-content">
            <span>&copy; 2025 Bazaar E-commerce. All rights reserved.</span>
        </div>
    </footer>
</body>
</html>
