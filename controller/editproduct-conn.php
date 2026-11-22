<?php
require_once '../includes/session.php'; 
require_once '../includes/Database.php';
require_once '../model/admin.php';

$categories = [
    "Fashion",
    "Statues Fashion",
    "Jewelry & Watches",
    "Gifts & Occasions",
    "Gift Cards",
    "Party Supplies",
    "Home & Living"
];

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Missing product ID in URL.";
    exit;
}
$admin = new Admin();
// var_dump($_GET['id']);
// var_dump($admin);     




$products = $admin->getProductById($_GET['id']);

if (!$products) {
    echo "Product not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Edit Product</title>
  <link rel="stylesheet" href="../view/css/style.css">
</head>
<body>
  <section class="admin-section" style="max-width:600px; margin:50px auto; background:#fffefb; border-radius:10px; padding:30px;">
    <h2 style="margin-bottom:20px;">Edit Product</h2>

    <form action="updateproduct.php" method="POST">
    <input type="hidden" name="ProductID" value="<?= $products['ProductID'] ?>">

      <label>Name: <input type="text" name="nameproduct" value="<?= htmlspecialchars($products['nameproduct']) ?>" required></label><br><br>
      
      <label>Price: <input type="number" name="price" value="<?= $products['price'] ?>" step="0.01" required></label><br><br>
      
      <label>Stock: <input type="number" name="stock" value="<?= $products['stock'] ?>" required></label><br><br>
      
      <label>Description:<br>
        <textarea name="description" rows="3" style="width:100%;"><?= htmlspecialchars($products['description']) ?></textarea>
      </label><br><br>

      <label>Image URL: <input type="url" name="image" value="<?= htmlspecialchars($products['image']) ?>"></label><br><br>
       <label for="category">Category:</label>
<select name="category" id="category" required>
    <option value="">-- Select Category --</option>
    <?php foreach ($categories as $cat): ?>
        <option value="<?= htmlspecialchars($cat) ?>"><?= htmlspecialchars($cat) ?></option>
    <?php endforeach; ?>
</select>
      

      <button type="submit" class="cta-btn">Update</button>
      <a href="../view/prdManagemnt.php" class="cta-btn back">Cancel</a>
    </form>
  </section>
</body>
</html>
