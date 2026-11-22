<?php
session_start();
require_once '../includes/Database.php';
if (!isset($_SESSION['id'])) {
    
     header("Location: view/not-logged-in.html");
   
    exit;
}
$customerID = $_SESSION['id'];

$db = new Database();
$conn = $db->getConnection();

$stmt = $conn->prepare("
    SELECT * FROM `order` 
    WHERE customerID = ? 
    ORDER BY date DESC
");
$stmt->execute([$customerID]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Orders | Bazaar</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <style>
        .bazaar-back-btn {
            position: absolute;
            top: 24px;
            left: 24px;
            z-index: 100;
            background: #fffbe7;
            color: #c19a6b;
            border: 2px solid #f2c66d;
            border-radius: 8px;
            font-weight: 600;
            box-shadow: 0 2px 12px #fbeedc55;
            padding: 8px 20px 8px 16px;
            font-size: 1.08rem;
            transition: background 0.16s, color 0.16s, border 0.16s, transform 0.13s;
            text-decoration: none;
            display: inline-block;
        }
        .bazaar-back-btn i {
            margin-right: 7px;
        }
        .bazaar-back-btn:hover {
            background: #f2c66d;
            color: #fff;
            border-color: #e2b04a;
            transform: translateY(-2px) scale(1.04);
            text-decoration: none;
        }
        body {
            background: linear-gradient(120deg, #fff9ed 0%, #fbeedc 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', 'Arial', sans-serif;
        }
        .orders-header {
            background: linear-gradient(90deg, #f2c66d 60%, #e2b04a 100%);
            color: #fff;
            padding: 32px 0 22px 0;
            border-radius: 0 0 32px 32px;
            box-shadow: 0 4px 32px #cdb89233;
            text-align: center;
            margin-bottom: 32px;
            position: relative;
        }
        .orders-header .fa-box-archive {
            font-size: 2.3rem;
            margin-bottom: 10px;
        }
        .orders-header h1 {
            font-size: 2rem;
            font-weight: 800;
            margin: 0;
            letter-spacing: 0.03em;
            color: #fff;
        }
        .orders-container {
            max-width: 800px;
            margin: 0 auto 40px auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 24px #cdb89233;
            padding: 32px 28px 24px 28px;
        }
        .orders-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 12px #fbeedc55;
        }
        .orders-table th, .orders-table td {
            padding: 16px 12px;
            text-align: left;
            border-bottom: 1.5px solid #f2e2be;
        }
        .orders-table th {
            background: linear-gradient(90deg, #fbeedc 60%, #fff9ed 100%);
            color: #7c6845;
            font-weight: 700;
            font-size: 1.08rem;
        }
        .orders-table tr:last-child td {
            border-bottom: none;
        }
        .order-status {
            padding: 5px 16px;
            border-radius: 16px;
            font-size: 1.01rem;
            font-weight: 600;
            display: inline-block;
            box-shadow: 0 2px 8px #fbeedc55;
        }
        .status-pending {
            background: #fff9ed;
            color: #e2b04a;
        }
        .status-completed {
            background: #e2fbe2;
            color: #4cae4c;
        }
        .status-cancelled {
            background: #fde2e2;
            color: #e74c3c;
        }
        @media (max-width: 600px) {
            .orders-container { padding: 12px 2vw; }
            .orders-header h1 { font-size: 1.2rem; }
            .orders-table th, .orders-table td { font-size: 0.97rem; }
        }
    </style>
</head>
<body>
    <a href="index.php" class="btn btn-light bazaar-back-btn">
        <i class="fa fa-arrow-left"></i> Back
    </a>
    <div class="orders-header">
        <i class="fa-solid fa-box-archive"></i>
        <h1>My Orders</h1>
    </div>
    <div class="orders-container">
        <?php if (count($orders) === 0): ?>
            <p style="color:#b49a6c;font-size:1.13rem;text-align:center;">No orders found.</p>
        <?php else: ?>
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= $order['orderID'] ?></td>
                        <td><?= $order['date'] ?></td>
                        <td><span class="order-status status-<?= strtolower($order['status']) ?>"><?= $order['status'] ?></span></td>
                        <td>$<?= number_format($order['totalAmount'], 2) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
