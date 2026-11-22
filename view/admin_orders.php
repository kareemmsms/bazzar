<?php
require_once '../includes/Database.php';
require_once '../model/OrderItem.php';
$database = new Database();
$conn = $database->getConnection();

$sql = "SELECT o.orderID, o.date, o.status, o.totalAmount, u.name AS customer_name
        FROM `order` o
        JOIN users u ON o.customerID = u.id
        ORDER BY o.date DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Requested Orders | Bazaar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
      body {
            background: linear-gradient(120deg, #fff9ed 0%, #fbeedc 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', 'Arial', sans-serif;
        }
        .bazaar-header {
            background: linear-gradient(90deg, #f2c66d 60%, #e2b04a 100%);
            color: #fff;
            padding: 32px 0 22px 0;
            border-radius: 0 0 32px 32px;
            box-shadow: 0 4px 32px #cdb89233;
            text-align: center;
            margin-bottom: 32px;
            position: relative;
        }
        .bazaar-header .fa-clipboard-list {
            font-size: 2.6rem;
            margin-bottom: 10px;
        }
        .bazaar-header h1 {
            font-size: 2.3rem;
            font-weight: 800;
            margin: 0;
            letter-spacing: 0.03em;
            color: #fff;
        }
        .bazaar-header p {
            color: #fffbe7;
            font-size: 1.13rem;
            margin-top: 8px;
            margin-bottom: 0;
        }
        .orders-container {
            max-width: 1100px;
            margin: 0 auto 50px auto;
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 4px 24px #cdb89233;
            padding: 40px 32px 32px 32px;
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
            padding: 18px 14px;
            text-align: left;
            border-bottom: 1.5px solid #f2e2be;
        }
        .orders-table th {
            background: linear-gradient(90deg, #fbeedc 60%, #fff9ed 100%);
            color: #7c6845;
            font-weight: 700;
            font-size: 1.08rem;
            letter-spacing: 0.01em;
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
        .btn-view {
            background: linear-gradient(90deg, #f2c66d 60%, #e2b04a 100%);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 8px 22px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.18s, transform 0.18s;
            box-shadow: 0 2px 12px #e9c97a33;
        }
        .btn-view:hover {
            background: #c19a6b;
            transform: scale(1.06);
        }
        @media (max-width: 900px) {
            .orders-container { padding: 26px 6vw; }
            .orders-table th, .orders-table td { padding: 12px 7px; }
        }
        @media (max-width: 600px) {
            .orders-container { padding: 14px 2vw; }
            .bazaar-header h1 { font-size: 1.3rem; }
            .orders-table th, .orders-table td { font-size: 0.98rem; }
        }
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
        }
        .bazaar-back-btn i {
            margin-right: 7px;
        }
        .bazaar-back-btn:hover {
            background: #f2c66d;
            color: #fff;
            border-color: #e2b04a;
            transform: translateY(-2px) scale(1.04);
        }
        @media (max-width: 600px) {
            .bazaar-back-btn {
                top: 10px;
                left: 10px;
                padding: 7px 14px 7px 11px;
                font-size: 0.97rem;
            }
        }
    </style>
</head>
<body>
    <a href="admins.php" class="btn btn-light bazaar-back-btn">
        <i class="fa fa-arrow-left"></i> Back
    </a>

    <div class="bazaar-header">
        <i class="fa-solid fa-clipboard-list"></i>
        <h1>Requested Orders</h1>
        <p>View and manage all requested orders in style</p>
    </div>

    <div class="orders-container">
        <table class="orders-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($orders) > 0): ?>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?= htmlspecialchars($order['orderID']) ?></td>
                            <td><?= htmlspecialchars($order['customer_name']) ?></td>
                            <td><?= htmlspecialchars($order['date']) ?></td>
                            <td>
                                <span class="order-status status-<?= strtolower($order['status']) ?>">
                                    <?= htmlspecialchars($order['status']) ?>
                                </span>
                            </td>
                            <td>$<?= number_format($order['totalAmount'], 2) ?></td>
                            <td><a href="view_order.php?id=<?= $order['orderID'] ?>" class="btn-view">View</a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">No orders found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
