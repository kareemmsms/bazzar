<?php

require_once '../includes/Database.php';
session_start();

$customerID = $_SESSION['id'];
$name = $_GET['name'];
$address = $_GET['address'];
$paymentMethod = $_GET['payment'];

// 1. Connect to DB
$db = new Database();
$conn = $db->getConnection();

// 2. احسب التوتال من cartitem
$stmt = $conn->prepare("
    SELECT ci.productID, ci.quantity, p.price
    FROM cartitem ci
    JOIN products p ON ci.productID = p.productID
    WHERE ci.cartID = (SELECT cartID FROM cart WHERE customerID = ?)
");
$stmt->execute([$customerID]);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

$totalAmount = 0;
foreach ($items as $item) {
    $totalAmount += $item['price'] * $item['quantity'];
}

// 3. Insert into `order`
$stmt = $conn->prepare("
    INSERT INTO `order` (customerID, date, status, totalAmount)
    VALUES (?, NOW(), 'Pending', ?)
");
$stmt->execute([$customerID, $totalAmount]);
$orderID = $conn->lastInsertId();

// 4. Insert into `orderitem`
$stmt = $conn->prepare("
    INSERT INTO orderitem (orderID, productID, quantity, price)
    VALUES (?, ?, ?, ?)
");

foreach ($items as $item) {
    $stmt->execute([$orderID, $item['productID'], $item['quantity'], $item['price']]);
}

// 5. Optional: Clear cart
$conn->prepare("
    DELETE FROM cartitem
    WHERE cartID = (SELECT cartID FROM cart WHERE customerID = ?)
")->execute([$customerID]);

require_once '../model/notification.php';




$notif = new Notification();

$notif->create("One of users{$customerID} make orders");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed | Bazaar</title>
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
        .confirmed-container {
            max-width: 480px;
            margin: 70px auto 0 auto;
            background: #fffefb;
            border-radius: 22px;
            padding: 44px 36px 36px 36px;
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
        .confirmed-title {
            font-size: 2rem;
            font-weight: 800;
            color: #c19a6b;
            margin-bottom: 18px;
            text-align: center;
        }
        .confirmed-icon {
            font-size: 3.2rem;
            color: #27ae60;
            margin-bottom: 18px;
            background: #e9fbe7;
            border-radius: 50%;
            padding: 18px 22px;
            box-shadow: 0 2px 16px #cdecd644;
        }
        .confirmed-details {
            width: 100%;
            margin-bottom: 22px;
        }
        .confirmed-details label {
            font-weight: 600;
            color: #5b4a2b;
            margin-bottom: 4px;
            display: block;
        }
        .confirmed-details .info {
            width: 100%;
            padding: 10px 14px;
            border-radius: 8px;
            border: 1.5px solid #e2cfa2;
            background: #fff8e6;
            font-size: 1.03rem;
            margin-bottom: 14px;
            font-family: inherit;
            box-shadow: 0 2px 8px #fbeedc33;
        }
        .confirmed-summary {
            background: #fffbe7;
            border-radius: 12px;
            box-shadow: 0 2px 12px #fbeedc33;
            border: 1px solid #f2e2be;
            padding: 14px 18px;
            margin-bottom: 18px;
            width: 100%;
        }
        .confirmed-summary-title {
            font-weight: 700;
            color: #c19a6b;
            margin-bottom: 6px;
            font-size: 1.13rem;
        }
        .confirmed-summary-list {
            color: #7c6845;
            font-size: 1.05rem;
            margin-left: 0;
            padding-left: 0;
            list-style: none;
        }
        .confirmed-btn {
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
            margin: 0 auto;
        }
        .confirmed-btn:hover, .confirmed-btn:focus {
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
            .confirmed-container {
                padding: 18px 6vw 16px 6vw;
                max-width: 98vw;
            }
            .confirmed-title {
                font-size: 1.3rem;
            }
        }
    </style>
</head>
<body>
    <nav class="nav">
        <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>
        <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i> Cart</a>
        <a href="profile.php"><i class="fa-solid fa-user"></i> Profile</a>
        <a href="setting.html"><i class="fa-solid fa-gear"></i> Settings</a>
        <a href="confirm-logout.html"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
    </nav>
    <main>
        <div class="confirmed-container">
            <div class="confirmed-icon"><i class="fa-solid fa-circle-check"></i></div>
            <div class="confirmed-title">Order Confirmed!</div>
            <div class="confirmed-details">
                <label><i class="fa-solid fa-clock"></i> Estimated Delivery Time</label>
                <div class="info" id="confirmedDelivery">1-2 business days</div>
                <label><i class="fa-solid fa-file-invoice"></i> Bill Amount</label>
                <div class="info" id="confirmedBill">$99.99</div>
                <label><i class="fa-solid fa-money-bill-wave"></i> Payment Method</label>
                <div class="info" id="confirmedPayment">Cash on Delivery</div>
            </div>
            <div class="confirmed-summary">
                <div class="confirmed-summary-title"><i class="fa-solid fa-clipboard-list"></i> Order Summary</div>
                <ul class="confirmed-summary-list">
                    <li><b>Delivery:</b> <span id="summaryDelivery">1-2 business days</span></li>
                    <li><b>Bill:</b> <span id="summaryBill">$99.99</span></li>
                    <li><b>Payment:</b> <span id="summaryPayment">Cash on Delivery</span></li>
                </ul>
            </div>
            <a href="index.php" class="confirmed-btn"><i class="fa-solid fa-house"></i> Back to Home</a>
        </div>
    </main>
    <footer>
        <div class="footer-content">
            <span>&copy; 2025 Bazaar E-commerce. All rights reserved.</span>
        </div>
    </footer>
    <script>
        // Get order info from URL params and display
        function getParam(name) {
            const url = new URL(window.location.href);
            return url.searchParams.get(name);
        }
        const delivery = getParam('delivery') || '1-2 business days';
        const bill = getParam('bill') || '$99.99';
        const payment = getParam('payment') || 'Cash on Delivery';
        document.getElementById('confirmedDelivery').textContent = delivery;
        document.getElementById('confirmedBill').textContent = bill;
        document.getElementById('confirmedPayment').textContent = payment;
        document.getElementById('summaryDelivery').textContent = delivery;
        document.getElementById('summaryBill').textContent = bill;
        document.getElementById('summaryPayment').textContent = payment;
    </script>
</body>
</html>
