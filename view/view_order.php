<?php
require_once '../includes/Database.php';

if (!isset($_GET['id'])) {
    die("Order ID not provided");
}

$orderID = $_GET['id'];

$db = new Database();
$conn = $db->getConnection();

// بيانات الأوردر
$stmt = $conn->prepare("
    SELECT o.*, c.name AS customerName
    FROM `order` o
    JOIN users c ON o.customerID = c.id
    WHERE o.orderID = ?
");
$stmt->execute([$orderID]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$order) {
    die("Order not found.");
}

// المنتجات داخل الأوردر
$stmt = $conn->prepare("
    SELECT oi.*, p.nameproduct AS productName
    FROM orderitem oi
    JOIN products p ON oi.productID = p.ProductID
    WHERE oi.orderID = ?
");
$stmt->execute([$orderID]);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Details | Bazaar</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <style>
        body {
            background: linear-gradient(120deg, #fff9ed 0%, #fbeedc 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', 'Arial', sans-serif;
        }
        .order-header {
            background: linear-gradient(90deg, #f2c66d 60%, #e2b04a 100%);
            color: #fff;
            padding: 32px 0 22px 0;
            border-radius: 0 0 32px 32px;
            box-shadow: 0 4px 32px #cdb89233;
            text-align: center;
            margin-bottom: 32px;
            position: relative;
        }
        .order-header .fa-receipt {
            font-size: 2.3rem;
            margin-bottom: 10px;
        }
        .order-header h1 {
            font-size: 2rem;
            font-weight: 800;
            margin: 0;
            letter-spacing: 0.03em;
            color: #fff;
        }
        .order-details-container {
            max-width: 700px;
            margin: 0 auto 40px auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 24px #cdb89233;
            padding: 32px 28px 24px 28px;
        }
        .order-info-list {
            list-style: none;
            padding: 0;
            margin-bottom: 32px;
        }
        .order-info-list li {
            margin-bottom: 13px;
            font-size: 1.11rem;
            color: #7c6845;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .order-info-list li i {
            color: #e2b04a;
            font-size: 1.13rem;
            min-width: 20px;
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
        .products-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 12px #fbeedc55;
        }
        .products-table th, .products-table td {
            padding: 16px 12px;
            text-align: left;
            border-bottom: 1.5px solid #f2e2be;
        }
        .products-table th {
            background: linear-gradient(90deg, #fbeedc 60%, #fff9ed 100%);
            color: #7c6845;
            font-weight: 700;
            font-size: 1.08rem;
        }
        .products-table tr:last-child td {
            border-bottom: none;
        }
        .back-link {
            display: inline-block;
            margin-top: 32px;
            margin-left: 12px;
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
        }
        .back-link i {
            margin-right: 7px;
        }
        .back-link:hover {
            background: #f2c66d;
            color: #fff;
            border-color: #e2b04a;
            transform: translateY(-2px) scale(1.04);
            text-decoration: none;
        }
        @media (max-width: 600px) {
            .order-details-container { padding: 12px 2vw; }
            .order-header h1 { font-size: 1.2rem; }
            .products-table th, .products-table td { font-size: 0.97rem; }
        }
    </style>
</head>
<body>
    <div class="order-header">
        <i class="fa-solid fa-receipt"></i>
        <h1>Order #<?= $orderID ?></h1>
    </div>
    <div class="order-details-container">
        <ul class="order-info-list">
            <li><i class="fa fa-user"></i> <strong>Customer:</strong> <?= htmlspecialchars($order['customerName']) ?></li>
            <li><i class="fa fa-calendar"></i> <strong>Date:</strong> <?= $order['date'] ?></li>
            <li><i class="fa fa-info-circle"></i> <strong>Status:</strong> <span class="order-status status-<?= strtolower($order['status']) ?>"><?= $order['status'] ?></span></li>
            <li><i class="fa fa-money-bill-wave"></i> <strong>Total:</strong> $<?= number_format($order['totalAmount'], 2) ?></li>
        </ul>
        <h2 style="color:#c19a6b;font-size:1.25rem;font-weight:700;margin-bottom:18px;"><i class="fa fa-box"></i> Products</h2>
        <table class="products-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['productName']) ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td>$<?= number_format($item['price'], 2) ?></td>
                    <td>$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="admin_orders.php" class="back-link"><i class="fa fa-arrow-left"></i>Back to Orders</a>
    </div>
</body>
</html>
