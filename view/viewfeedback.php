<?php
require_once '../includes/Database.php';
require_once '../model/feedback.php';

$feedbacks = new Feedback(); 

$feedbacks = $feedbacks->getFeedback();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Feedback | Bazaar Admin</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
        @media (max-width: 600px) {
            .bazaar-back-btn {
                top: 10px;
                left: 10px;
                padding: 7px 14px 7px 11px;
                font-size: 0.97rem;
            }
        }
        body {
            background: linear-gradient(120deg, #fff9ed 0%, #fbeedc 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', 'Arial', sans-serif;
        }
        .admin-section {
            max-width: 1100px;
            margin: 48px auto 40px auto;
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 4px 24px #cdb89233;
            padding: 40px 32px 32px 32px;
        }
        .admin-title {
            font-size: 1.8rem;
            font-weight: 800;
            color: #c19a6b;
            margin-bottom: 18px;
            letter-spacing: -1px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .admin-title i {
            color: #e2b04a;
            font-size: 1.6rem;
        }
        .feedback-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 12px #fbeedc55;
        }
        .feedback-table th, .feedback-table td {
            padding: 16px 12px;
            text-align: left;
            border-bottom: 1.5px solid #f2e2be;
        }
        .feedback-table th {
            background: linear-gradient(90deg, #fbeedc 60%, #fff9ed 100%);
            color: #7c6845;
            font-weight: 700;
            font-size: 1.08rem;
        }
        .feedback-table tr:last-child td {
            border-bottom: none;
        }
        .feedback-row {
            transition: background 0.18s;
        }
        .feedback-row:hover {
            background: #fff9ed;
        }
        .feedback-message {
            color: #3a2b16;
            font-size: 1.06rem;
            font-style: italic;
        }
        .feedback-rating {
            color: #e2b04a;
            font-weight: bold;
            font-size: 1.15rem;
        }
        @media (max-width: 900px) {
            .admin-section { padding: 26px 6vw; }
            .feedback-table th, .feedback-table td { padding: 12px 7px; }
        }
        @media (max-width: 600px) {
            .admin-section { padding: 14px 2vw; }
            .admin-title { font-size: 1.1rem; }
            .feedback-table th, .feedback-table td { font-size: 0.98rem; }
        }
    </style>
</head>
<body>
    <a href="admins.php" class="btn btn-light bazaar-back-btn">
        <i class="fa fa-arrow-left"></i> Back
    </a>
    <div class="admin-section">
        <div class="admin-title"><i class="fa fa-comments"></i> View Feedback</div>
        <table class="feedback-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Message</th>
                   
                    <th>Date</th>
                </tr>
            </thead>
             <tbody>
                <?php foreach ($feedbacks as $fb): ?>
                    <tr class="feedback-row">
                        <td><?= htmlspecialchars($fb['mesID']) ?></td>
                        <td><?= htmlspecialchars($fb['name']) ?></td>
                        <td class="feedback-message"><?= htmlspecialchars($fb['message']) ?></td>
                       
                        <td><?= date('Y-m-d') // or use actual date if stored ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
