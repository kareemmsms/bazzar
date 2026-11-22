<?php
require_once '../includes/session.php';
require_once '../includes/Database.php';
require_once '../model/admin.php';

$admin = new Admin();

if (!isset($_GET['id'])) {
    echo "Missing user ID.";
    exit;
}

$id = $_GET['id'];
$user = $admin->getUserById($id);

if (!$user) {
    echo "User not found.";
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit User | Bazaar Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="../view/css/style.css">
  <style>
    body {
      background: #f8f6f2;
      font-family: 'Segoe UI', Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    .edit-user-container {
      background: #fffefb;
      border-radius: 18px;
      box-shadow: 0 4px 28px #e9c97a33;
      max-width: 420px;
      margin: 60px auto 0 auto;
      padding: 36px 32px 28px 32px;
      display: flex;
      flex-direction: column;
      align-items: stretch;
    }
    .edit-user-container h2 {
      font-size: 1.4rem;
      font-weight: 800;
      color: #3a2b16;
      margin-bottom: 22px;
      letter-spacing: -1px;
      text-align: center;
    }
    .edit-user-form label {
      display: block;
      margin-bottom: 13px;
      color: #5a4d32;
      font-weight: 600;
      font-size: 1rem;
    }
    .edit-user-form input,
    .edit-user-form select {
      width: 100%;
      padding: 9px 12px;
      margin-top: 6px;
      border: 1px solid #e7c36a;
      border-radius: 7px;
      font-size: 1rem;
      background: #fdf8ef;
      box-sizing: border-box;
      transition: border 0.2s;
    }
    .edit-user-form input:focus,
    .edit-user-form select:focus {
      border-color: #e7c36a;
      outline: none;
    }
    .edit-user-form .btn-row {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      margin-top: 22px;
    }
    .cta-btn {
      background: #e7c36a;
      color: #1a2340;
      border: none;
      border-radius: 8px;
      padding: 11px 28px;
      font-size: 1.07rem;
      font-weight: 700;
      cursor: pointer;
      transition: background 0.2s;
    }
    .cta-btn:hover {
      background: #f6d97b;
    }
    .cta-btn.back {
      background: #eee;
      color: #5a4d32;
      border: 1px solid #e7c36a;
    }
    @media (max-width: 600px) {
      .edit-user-container {
        padding: 18px 6vw;
        max-width: 98vw;
      }
    }
  </style>
</head>
<body>
  <div class="edit-user-container">
    <h2>Edit User</h2>
    <form class="edit-user-form" action="updateuser-conn.php" method="post">
      <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">
      <label>
        Name:
        <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
      </label>
      <label>
        Email:
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
      </label>
      <label>
        Phone:
        <input type="text" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" required>
      </label>
      <label>
        User Type:
        <select name="user_type" required>
          <option value="user" <?= $user['user_type'] == 'user' ? 'selected' : '' ?>>User</option>
          <option value="admin" <?= $user['user_type'] == 'admin' ? 'selected' : '' ?>>Admin</option>
        </select>
      </label>
      <div class="btn-row">
        <button type="submit" class="cta-btn">Update</button>
        <button type="button" class="cta-btn back" onclick="window.history.back()">Cancel</button>
      </div>
    </form>
  </div>
</body>
</html>