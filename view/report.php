<?php
require_once '../includes/Database.php';

// Calculate total revenue and sales
$totalRevenue = 0;
$totalSales = 0;

try {
    $db = new Database();
    $conn = $db->getConnection();
    $stmt = $conn->prepare("SELECT SUM(total) as revenue, COUNT(*) as sales FROM `order` WHERE status = 'Completed'");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $totalRevenue = $row['revenue'] ?? 0;
        $totalSales = $row['sales'] ?? 0;
    }
} catch (Exception $e) {
    $error = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports | Bazaar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(120deg, #fff9ed 0%, #fbeedc 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', 'Arial', sans-serif;
        }
        .report-section {
            max-width: 600px;
            margin: 60px auto;
            background: #fffefb;
            border-radius: 22px;
            box-shadow: 0 8px 32px #e9c97a33, 0 0 0 8px #fff;
            padding: 44px 38px 38px 38px;
            border: 1.5px solid #fff;
            z-index: 2;
            position: relative;
        }
        .report-title {
            font-size: 2.1rem;
            font-weight: 900;
            color: #c19a6b;
            margin-bottom: 22px;
            text-align: center;
        }
        .report-item {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 2px 12px #e2cfa233;
            padding: 28px 18px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 18px;
        }
        .report-icon {
            font-size: 2.4rem;
            color: #e2b04a;
            background: #fff9ed;
            border-radius: 50%;
            width: 56px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px #e2cfa233;
        }
        .report-label {
            font-size: 1.18rem;
            color: #7c6845;
            font-weight: 700;
        }
        .report-value {
            font-size: 2rem;
            color: #2a7a2a;
            font-weight: 900;
            margin-left: auto;
        }
        .back-btn {
            background: linear-gradient(90deg, #f2c66d 60%, #e2b04a 100%);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 10px 26px;
            font-size: 1.07rem;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 2px 8px #e9c97a33;
            transition: background 0.2s, box-shadow 0.2s, transform 0.15s;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 18px;
        }
        .back-btn:hover, .back-btn:focus {
            background: #e2b04a;
            box-shadow: 0 4px 16px #e9c97a55;
            transform: translateY(-2px) scale(1.03);
            color: #fff;
        }
        @media (max-width: 700px) {
            .report-section {
                padding: 18px 2vw 18px 2vw;
            }
        }
    </style>
</head>
<body>
    <div class="report-section">
        <a href="admin.php" class="back-btn mb-3"><i class="fa-solid fa-arrow-left me-2"></i>Back</a>
        <div class="report-title"><i class="fa-solid fa-chart-line me-2"></i>Sales & Revenue Report</div>
        <div class="report-item">
            <div class="report-icon"><i class="fa-solid fa-sack-dollar"></i></div>
            <div class="report-label">Total Revenue</div>
            <div class="report-value">$<?= number_format($totalRevenue, 2) ?></div>
        </div>
        <div class="report-item">
            <div class="report-icon"><i class="fa-solid fa-basket-shopping"></i></div>
            <div class="report-label">Total Sales</div>
            <div class="report-value"><?= $totalSales ?></div>
        </div>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger text-center mt-3">Error: <?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
