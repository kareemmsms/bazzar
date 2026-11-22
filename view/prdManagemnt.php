<?php
require_once '../includes/Database.php';
require_once '../model/Admin.php';

$admin = new Admin();
$products = $admin->getProducts();
// $products =$admin->addProducts();
$categories = [
    "Fashion",
    "Statues Fashion",
    "Jewelry & Watches",
    "Gifts & Occasions",
    "Gift Cards",
    "Party Supplies",
    "Home & Living"
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Products Management | Bazaar Admin</title>
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
      background: linear-gradient(120deg, #fffefb 60%, #fff9ed 100%);
      border-radius: 28px;
      box-shadow: 0 8px 32px #e9c97a33, 0 0 0 8px #fff;
      max-width: 1200px;
      margin: 36px auto 0 auto;
      padding: 40px 44px 36px 44px;
      border: 1.5px solid #fff;
      position: relative;
    }
    .admin-table {
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 2px 18px #cdb89233;
      background: #fffefb;
    }
    .admin-table thead tr {
      background: linear-gradient(90deg, #f2c66d 60%, #e2b04a 100%);
      color: #fff;
      font-weight: 800;
      font-size: 1.08rem;
      letter-spacing: 0.5px;
      border-bottom: 3px solid #e2b04a;
      position: sticky;
      top: 0;
      z-index: 2;
    }
    .admin-table th, .admin-table td {
      vertical-align: middle !important;
      padding: 15px 12px !important;
      border-bottom: 1.5px solid #f2e2be;
      background: transparent;
    }
    .admin-table tbody tr:nth-child(even) {
      background: #fffbe7;
    }
    .admin-table tbody tr:nth-child(odd) {
      background: #fffefb;
    }
    .admin-table tbody tr {
      transition: background 0.13s, box-shadow 0.13s;
    }
    .admin-table tbody tr:hover {
      background: #fff9ed !important;
      box-shadow: 0 2px 12px #e2cfa233;
      z-index: 1;
      position: relative;
    }
    .admin-table td img {
      max-width: 60px;
      max-height: 60px;
      border-radius: 8px;
      box-shadow: 0 2px 8px #e9c97a33;
      border: 1px solid #f2c66d33;
    }
    .admin-table select {
      border-radius: 6px;
      border: 1.5px solid #e2cfa2;
      padding: 7px 10px;
      font-size: 1rem;
      background: #fff;
      color: #7c6845;
      font-weight: 500;
      transition: border 0.15s, box-shadow 0.15s;
      box-shadow: 0 1px 4px #e2cfa211;
    }
    .admin-table select:focus {
      border: 1.5px solid #c19a6b;
      outline: none;
      box-shadow: 0 2px 8px #e2cfa233;
      background: #fffbe7;
    }
    .cta-btn, .cta-btn.back {
      background: linear-gradient(90deg, #f2c66d 60%, #e2b04a 100%);
      color: #fff;
      border: none;
      border-radius: 8px;
      padding: 10px 22px;
      font-size: 1.08rem;
      font-weight: 600;
      margin-right: 8px;
      margin-bottom: 8px;
      box-shadow: 0 2px 8px #e9c97a33;
      transition: background 0.15s, box-shadow 0.15s, transform 0.13s;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
    }
    .cta-btn:hover, .cta-btn.back:hover {
      background: #e2b04a;
      color: #fff;
      box-shadow: 0 4px 16px #e9c97a55;
      transform: translateY(-2px) scale(1.03);
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
    .admin-table tbody tr {
    height: 100px; /* Increase row height */
    padding: 18px;
    font-size: 1rem;
}
.admin-table td {
    vertical-align: top; /* Align top for better layout */
    line-height: 1.4;
}
.admin-table td {
    word-wrap: break-word;
    max-width: 200px;
}

  </style>
</head>
<body>
  <div class="admin-header">
    <button class="back-btn" onclick="window.location.href='admins.php'" title="Back to Dashboard"><i class="fa fa-arrow-left"></i></button>
    <span class="admin-title"><i class="fa fa-box" style="margin-right:10px;"></i>Product Management</span>
  </div>
  <section class="admin-section">
    <button onclick="document.getElementById('adminProductModal').style.display='flex'" class="cta-btn"><i class="fa fa-plus"></i> Add Product</button>

    <!-- Add Product Modal -->
    <div id="adminProductModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:#0006; z-index:1000; align-items:center; justify-content:center;">
      <div class="modal-content" style="background:#fffefb; border-radius:12px; padding:32px 28px; min-width:300px; max-width:90vw; margin:auto; position:relative;">
        <h3>Add Product</h3>
        
        <form action="../controller/addproduct-con.php" method="post">
          <label>Name: <input type="text" name="nameproduct" required></label><br>
          <label>Price: <input type="number" name="price" required min="0" step="0.01"></label><br>
          <label>Stock: <input type="number" name="stock" required min="0"></label><br>
          <label>Description:<br><textarea name="description" rows="2" style="width:95%;resize:vertical;"></textarea></label><br>
          <label>Image URL: <input type="url" name="image" placeholder="https://example.com/image.jpg"></label><br>
        <label for="category">Category:</label>
<select name="category" id="category" required>
    <option value="">-- Select Category --</option>
    <?php foreach ($categories as $cat): ?>
        <option value="<?= htmlspecialchars($cat) ?>"><?= htmlspecialchars($cat) ?></option>
    <?php endforeach; ?>
</select>

          <div style="margin-top:14px; text-align:right;">
            <button type="submit" class="cta-btn">Save</button>
            <button type="button" class="cta-btn back" onclick="document.getElementById('adminProductModal').style.display='none'">Cancel</button>
          </div>
        </form>
      </div>
    </div>
    <input type="number" id="searchByIdInput" placeholder="Search by Product ID" style="padding:8px; border-radius:6px; border:1px solid #ccc; margin-bottom: 12px;">
    <button type="button" class="cta-btn" onclick="searchById()">Search</button>
    <button type="button" class="cta-btn back" onclick="clearSearchById()">Clear</button>
    <table class="admin-table" style="margin-top:10px;">
      <thead>
        <tr>
          <th>ID</th><th>Name</th><th>Price</th><th>Stock</th><th>Description</th><th>Image</th><th>category</th><th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($products as $index => $p): ?>
        <tr>
          <td><?= $index + 1 ?></td>
          <td><?= htmlspecialchars($p['nameproduct']) ?></td>
          <td><?= htmlspecialchars($p['price']) ?></td>
          <td><?= htmlspecialchars($p['stock']) ?></td>
          <td><?= htmlspecialchars($p['description']) ?></td>
          
          <td>
            <?php if (!empty($p['image'])): ?>
              <img src="<?= htmlspecialchars($p['image']) ?>" alt="Product Image" style="max-width:60px;max-height:60px;border-radius:5px;">
            <?php endif; ?>
          </td>
          <td>
              <td><?= htmlspecialchars(string: $p['category']) ?></td>

          </td>
          <td>

            <a href="../controller/editproduct-conn.php?id=<?= $p['ProductID'] ?>"style="background:#e7c36a; color:#1a2340; border:none; border-radius:6px; padding:6px 14px; margin-right:5px; font-weight:600; text-decoration:none;">Edit</a>
            <a href="../controller/delproduct-conn.php?id=<?= $p['ProductID'] ?>" onclick="return confirm('Delete this product?')" style="background:#e57373; color:#fff; border:none; border-radius:6px; padding:6px 14px; font-weight:600; text-decoration:none;">Delete</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <script>
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
                msg.innerHTML = `<td colspan="7" style="color:red;text-align:center;">No product found with ID ${input}.</td>`;
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