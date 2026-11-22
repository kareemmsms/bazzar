<?php
require_once '../includes/Database.php';
require_once '../model/admin.php';

$admin = new admin(); 

$users = $admin->getUsers();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>User Management | Bazaar Admin</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="css/style.css" />
  <style>
    body {
      background: linear-gradient(120deg, #fff9ed 0%, #fbeedc 100%);
      min-height: 100vh;
      font-family: 'Segoe UI', 'Arial', sans-serif;
    }
    .admin-header {
      background: linear-gradient(90deg, #f2c66d 60%, #e2b04a 100%);
      box-shadow: 0 4px 24px #cdb89233;
      padding: 0 0 10px 0;
      border-radius: 0 0 32px 32px;
      margin-bottom: 24px;
      display: flex;
      align-items: center;
      justify-content: flex-start;
      gap: 18px;
    }
    .back-btn {
      background: #fff;
      color: #c19a6b;
      border: none;
      border-radius: 50%;
      width: 44px;
      height: 44px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      box-shadow: 0 2px 10px #e9c97a33;
      margin-left: 18px;
      margin-top: 12px;
      transition: background 0.15s, color 0.15s;
    }
    .back-btn:hover {
      background: #f2c66d;
      color: #fff;
    }
    .admin-title {
      font-size: 2rem;
      font-weight: 900;
      color: #fff;
      letter-spacing: 1px;
      margin-top: 14px;
    }
    .admin-section {
      background: #fff;
      border-radius: 24px;
      box-shadow: 0 4px 28px #e9c97a33;
      max-width: 1100px;
      margin: 32px auto 0 auto;
      padding: 34px 36px 32px 36px;
    }
    .admin-table {
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 2px 18px #cdb89233;
      background: #fffefb;
    }
    .admin-table thead tr {
      background: #f2c66d;
      color: #fff;
      font-weight: 700;
    }
    .admin-table tbody tr {
      transition: background 0.13s;
    }
    .admin-table tbody tr:hover {
      background: #fff9ed;
    }
    .cta-btn, .cta-btn.back {
      background: #f2c66d;
      color: #fff;
      border: none;
      border-radius: 8px;
      padding: 10px 22px;
      font-size: 1.08rem;
      font-weight: 600;
      margin-right: 8px;
      margin-bottom: 8px;
      transition: background 0.15s;
    }
    .cta-btn:hover, .cta-btn.back:hover {
      background: #e2b04a;
      color: #fff;
    }
    .modal-content {
      background: #fffefb;
      border-radius: 12px;
      padding: 32px 28px;
      min-width: 300px;
      max-width: 90vw;
      margin: auto;
      position: relative;
      box-shadow: 0 2px 18px #cdb89233;
    }
    @media (max-width: 900px) {
      .admin-section { padding: 22px 2vw; }
    }
    @media (max-width: 600px) {
      .admin-section { padding: 10px 1vw; }
      .admin-title { font-size: 1.2rem; }
    }
  </style>
</head>
<body>
  <div class="admin-header">
    <button class="back-btn" onclick="window.location.href='admins.php'" title="Back to Dashboard"><i class="fa fa-arrow-left"></i></button>
    <span class="admin-title"><i class="fa fa-users" style="margin-right:10px;"></i>User Management</span>
  </div>
  <section class="admin-section">
    <button onclick="document.getElementById('adminUserModal').style.display='flex'" class="cta-btn"><i class="fa fa-user-plus"></i> Add User</button>

    <!-- Add User Modal -->
    <div id="adminUserModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:#0006; z-index:1000; align-items:center; justify-content:center;">
      <div class="modal-content" style="background:#fffefb; border-radius:12px; padding:32px 28px; min-width:300px; max-width:90vw; margin:auto; position:relative;">
        <h3>Add User</h3>
        <form action="../controller/addUsers-conn.php" method="post">
          <label>Name: <input type="text" name="name" required></label><br>
          <label>Email: <input type="email" name="email" required></label><br>
          <label>Phone: <input type="text" name="phone" required></label><br>
          <label>password: <input type="password" name="password" required></label><br>
          <label>User Type:
            <select name="user_type" required>
              <option value="user">User</option>
              <option value="admin">Admin</option>
            </select>
          </label><br>
          <div style="margin-top:14px; text-align:right;">
            <button type="submit" class="cta-btn">Save</button>
            <button type="button" class="cta-btn back" onclick="document.getElementById('adminUserModal').style.display='none'">Cancel</button>
          </div>
        </form>
      </div>
    </div>
    <input type="number" id="searchByIdInput" placeholder="Search by User ID" style="padding:8px; border-radius:6px; border:1px solid #ccc; margin-bottom: 12px;">
    <button type="button" class="cta-btn" onclick="searchById()">Search</button>
    <button type="button" class="cta-btn back" onclick="clearSearchById()">Clear</button>
    <table class="admin-table" style="margin-top:10px;">
      <thead>
        <tr>
          <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>User Type</th><th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $u): ?>
        <tr>
          <td><?= htmlspecialchars($u['id']) ?></td>
          <td><?= htmlspecialchars($u['name']) ?></td>
          <td><?= htmlspecialchars($u['email']) ?></td>
          <td><?= htmlspecialchars($u['phone']) ?></td>
          <td><?= htmlspecialchars($u['user_type']) ?></td>
          <td>
            <a href="../controller/edituser-conn.php?id=<?= $u['id'] ?>" style="background:#e7c36a; color:#1a2340; border:none; border-radius:6px; padding:6px 14px; margin-right:5px; font-weight:600; text-decoration:none;">Edit</a>
            <a href="../controller/deleteUsers-conn.php?id=<?= $u['id'] ?>" onclick="return confirm('Delete this user?')" style="background:#e57373; color:#fff; border:none; border-radius:6px; padding:6px 14px; font-weight:600; text-decoration:none;">Delete</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <script>
      fetch('../controller/getUsers-conn.php')
  .then(res => res.json())
  .then(data => console.log(data))
  .catch(err => console.error('Fetch error:', err));

    function searchById() {
        var input = document.getElementById('searchByIdInput').value.trim();
        var table = document.querySelector('.admin-table tbody');
        var rows = table.getElementsByTagName('tr');
        var found = false;

        for (var i = 0; i < rows.length; i++) {
            var idCell = rows[i].getElementsByTagName('td')[0];
            if (!idCell) continue;
            if (input === "" || idCell.textContent.trim() === input) {
                rows[i].style.display = "";
                found = true;
            } else {
                rows[i].style.display = "none";
            }
        }

        // Show a message if not found
        var msg = document.getElementById('notFoundMsg');
        if (input !== "" && !found) {
            if (!msg) {
                msg = document.createElement('tr');
                msg.id = 'notFoundMsg';
                msg.innerHTML = `<td colspan="6" style="color:red;text-align:center;">No user found with ID ${input}.</td>`;
                table.appendChild(msg);
            }
        } else if (msg) {
            msg.parentNode.removeChild(msg);
        }
    }

    function clearSearchById() {
        document.getElementById('searchByIdInput').value = '';
        searchById();
    }
    </script>
  </section>
</body>
</html>