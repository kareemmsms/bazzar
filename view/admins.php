
<?php
require_once '../includes/Database.php';
require_once '../controller/NotifCon.php';

$db = new Database();
$conn = $db->getConnection();
$notif = new Notification();

$allNotifications = $notif->getAll(10); 
// echo "<ul>";
// foreach ($allNotifications as $n) {
//     echo "<li>" . htmlspecialchars($n['message']) . " - " . $n['created_at'] . "</li>";
// }
// echo "</ul>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Bazaar</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
       .notification-box {
    animation: slideDownFade 0.5s ease forwards;
    opacity: 0;
    transform: translateY(-10px);
    margin-bottom: 18px;
    position: relative;
    border-radius: 18px;
    border: 2.5px solid transparent;
    background: linear-gradient(100deg, #fffbe9 70%, #ffe7b8 100%);
    box-shadow: 0 4px 24px #e2b04a22, 0 0 0 4px #ffe7b880 inset;
    padding: 18px 20px 16px 22px;
    overflow: hidden;
    transition: box-shadow 0.25s, border 0.25s;
}
.fancy-notif {
    border-image: linear-gradient(90deg,#e2b04a 0%,#f2c66d 100%) 1;
    box-shadow: 0 6px 30px #fbeedc55, 0 0 0 4px #f2c66d33 inset;
}
.notif-close-btn {
    position: absolute;
    top: 8px;
    right: 16px;
    border: none;
    background: linear-gradient(120deg,#fff9ed 60%,#ffe7b8 100%);
    color: #b49a6c;
    font-size: 1.4rem;
    font-weight: bold;
    border-radius: 50%;
    width: 32px;
    height: 32px;
    line-height: 28px;
    box-shadow: 0 2px 8px #fbeedc22;
    cursor: pointer;
    z-index: 2;
    transition: background 0.2s, color 0.2s;
}
.notif-close-btn:hover {
    background: linear-gradient(120deg,#e2b04a 60%,#f2c66d 100%);
    color: #fff;
}
.notif-bell {
    color: #e2b04a;
    font-size: 1.3rem;
    margin-right: 6px;
    animation: notif-bell-pulse 1.6s infinite;
}
@keyframes notif-bell-pulse {
    0%, 100% { transform: rotate(-8deg) scale(1); }
    10% { transform: rotate(8deg) scale(1.15); }
    20% { transform: rotate(-8deg) scale(1.07); }
    30% { transform: rotate(8deg) scale(1.12); }
    40% { transform: rotate(-6deg) scale(1.05); }
    50% { transform: rotate(0deg) scale(1); }
}
.notif-badge {
    background: linear-gradient(90deg,#e2b04a 60%,#f2c66d 100%) !important;
    color: #fff !important;
    font-weight: 700;
    font-size: 1.03rem;
    border-radius: 8px;
    padding: 6px 18px;
    box-shadow: 0 2px 8px #e2b04a33;
    letter-spacing: 0.04em;
    border: 1.5px solid #fffbe9;
}
.notif-content {
    font-size: 1.08rem;
    color: #7c6845;
    font-weight: 500;
    letter-spacing: 0.01em;
}
.notif-msg {
    font-size: 1.09rem;
    font-weight: 600;
}
.notif-date {
    color: #b49a6c !important;
    font-size: 0.93rem;
    font-style: italic;
}
@media (max-width: 600px) {
    .notification-box {
        padding: 14px 8px 13px 10px;
    }
    .notif-close-btn {
        top: 4px;
        right: 8px;
        width: 26px;
        height: 26px;
        font-size: 1.1rem;
    }
    .notif-badge {
        padding: 4px 10px;
        font-size: 0.97rem;
    }
    .notif-content, .notif-msg {
        font-size: 0.99rem;
    }
}

    @keyframes slideDownFade {
    to {
        opacity: 1;
        transform: translateY(0);
    }
    }
    .read-btn {
    position: absolute;
    top: 8px;
    right: 12px;
    border: none;
    background: transparent;
    color: #555;
    font-size: 1.1rem;
    cursor: pointer;
    }
    .read-btn:hover {
    color: green;
    }
        body {
            background: linear-gradient(120deg, #fff9ed 0%, #fbeedc 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', 'Arial', sans-serif;
        }
        header {
            background: linear-gradient(90deg, #f2c66d 60%, #e2b04a 100%);
            box-shadow: 0 4px 24px #cdb89233;
            padding: 0 0 10px 0;
            border-radius: 0 0 32px 32px;
            margin-bottom: 24px;
        }
        .logo {
            font-size: 2rem;
            font-weight: 900;
            color: #fff;
            letter-spacing: 1px;
            padding: 14px 0 0 18px;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 36px;
            background: none;
        }
        .nav-links {
            display: flex;
            gap: 22px;
            list-style: none;
            margin: 0;
        }
        .nav-links a {
            color: #fff;
            font-weight: 600;
            text-decoration: none;
            font-size: 1.08rem;
            transition: color 0.15s;
        }
        .nav-links a:hover {
            color: #7c6845;
        }
        main {
            margin-top: 18px;
        }
        .admin-section {
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 4px 28px #e9c97a33;
            max-width: 1100px;
            margin: 32px auto 0 auto;
            padding: 34px 36px 32px 36px;
        }
        .admin-panels {
            display: flex;
            flex-wrap: wrap;
            gap: 32px 24px;
            justify-content: center;
            margin-top: 20px;
        }
        .admin-panel {
            background: linear-gradient(120deg, #fbeedc 0%, #fff9ed 100%);
            border-radius: 18px;
            box-shadow: 0 2px 18px #cdb89233;
            padding: 34px 28px 28px 28px;
            min-width: 220px;
            max-width: 290px;
            flex: 1 1 220px;
            text-align: center;
            cursor: pointer;
            transition: box-shadow 0.17s, transform 0.13s, background 0.17s;
            border: none;
        }
        .admin-panel:hover {
            background: #f2c66d;
            color: #fff;
            box-shadow: 0 4px 32px #e2b04a33;
            transform: translateY(-4px) scale(1.03);
        }
        .admin-panel h3 {
            font-size: 1.22rem;
            font-weight: 800;
            margin-bottom: 8px;
            color: #c19a6b;
        }
        .admin-panel p {
            color: #7c6845;
            font-size: 1.01rem;
        }
      min-panel i {
            font-size: 1.6rem;
            margin-bottom: 10px;
            color: #e2b04a;
        }
        @media (max-width: 900px) {
            .admin-section { padding: 22px 2vw; }
            .admin-panels { gap: 18px 8px; }
        }
        @media (max-width: 600px) {
            .admin-panel { min-width: 160px; max-width: 100vw; padding: 18px 7vw; }
            .logo { font-size: 1.3rem; }
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">Bazaar Admin</div>
            <ul class="nav-links" id="adminNavLinks">
                <li><a href="index.php">Home</a></li>
                <!-- <li><a href="cart.html">Cart</a></li> -->
                <!-- <li><a href="profile.php">Profile</a></li> -->
                <li class="nav-item dropdown">
                    <a class="nav-link position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="notifDropdown">
                        <i class="fas fa-bell"></i>
                        <?php
                        $unreadCount = 0;
                        foreach ($allNotifications as $n) {
                            if (isset($n['is_read']) && $n['is_read'] == 0) $unreadCount++;
                        }
                        ?>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="notifCount">
                            <?= $unreadCount ?>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end p-2 shadow" aria-labelledby="notifDropdown" style="width: 320px; max-height: 400px; overflow-y: auto;">
                        <?php $hasUnread = false; foreach ($allNotifications as $n): ?>
                            <?php if (isset($n['is_read']) && $n['is_read'] == 0): $hasUnread = true; ?>
                            <li class="mb-2">
                                <div class="alert alert-warning p-2 mb-0">
                                    <small><i class="fas fa-bell me-1"></i><?= htmlspecialchars($n['message']) ?></small><br>
                                    <small class="text-muted"><?= $n['created_at'] ?></small>
                                </div>
                            </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <?php if (!$hasUnread): ?>
                            <li><small class="text-muted">لا توجد إشعارات حالياً</small></li>
                        <?php endif; ?>
                    </ul>
                </li>
                <li><a href="setting.html">Settings</a></li>
                <li><a href="confirm-logout.html" id="logoutBtn">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <!-- Products Management Section -->
        <section class="admin-section" id="productsSection" style="display:none; background: #fffefb; border-radius: 18px; box-shadow: 0 4px 28px #e9c97a33; max-width:900px; margin:40px auto 0 auto; padding:34px 36px 32px 36px;">
            <h2 style="font-size:1.45rem; font-weight:800; margin-bottom:22px; color:#3a2b16; letter-spacing:-1px;">Products Management</h2>
            <button onclick="showProductModal()" class="cta-btn" style="margin-bottom:20px; padding:11px 26px; font-size:1.1rem; border-radius:8px;">Add Product</button>
            <input type="text" id="adminProductSearch" placeholder="Search products..." style="margin-bottom:18px; max-width:320px; border-radius:8px; border:1.5px solid #e2cfa2; background:#fff8e6; font-size:1.08rem; padding:10px 14px; display:block;">
            <table class="admin-table" style="margin-top:10px;">
                <thead><tr><th>ID</th><th>Name</th><th>Price</th><th>Stock</th><th>Description</th><th>Actions</th></tr></thead>
                <tbody id="adminProductsTableBody"></tbody>
            </table>
            <!-- Add/Edit Product Modal -->
            <div id="adminProductModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:#0006; z-index:1000; align-items:center; justify-content:center;">
                <div class="modal-content" style="background:#fffefb; border-radius:12px; padding:32px 28px; min-width:300px; max-width:90vw; margin:auto; position:relative;">
                    <h3 id="adminProductModalTitle">Add Product</h3>
                    <form id="adminProductForm">
                        <label>Name: <input type="text" id="adminModalProductName" required></label><br>
                        <label>Price: <input type="number" id="adminModalProductPrice" required min="0" step="0.01"></label><br>
                        <label>Stock: <input type="number" id="adminModalProductStock" required min="0"></label><br>
                        <label>Description:<br><textarea id="adminModalProductDesc" rows="2" style="width:95%;resize:vertical;"></textarea></label><br>
                        <div style="margin-top:14px; text-align:right;">
                            <button type="submit" class="cta-btn">Save</button>
                            <button type="button" class="cta-btn back" onclick="closeAdminProductModal()">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            <script>
            // In-memory products array for admin
            let adminProducts = [];
            let editingAdminProductIdx = null;
            function renderAdminProductsTable() {
                const tbody = document.getElementById('adminProductsTableBody');
                const search = (document.getElementById('adminProductSearch')?.value || '').toLowerCase();
                const filtered = adminProducts.filter((p, i) =>
                    String(i + 1).includes(search) ||
                    p.name.toLowerCase().includes(search) ||
                    (p.desc||'').toLowerCase().includes(search) ||
                    String(p.price).toLowerCase().includes(search)
                );
                tbody.innerHTML = filtered.map((p, i) => `
                    <tr>
                        <td>${i + 1}</td>
                        <td>${p.name}</td>
                        <td>$${p.price}</td>
                        <td>${p.stock}</td>
                        <td>${p.desc||''}</td>
                        <td>
                            <button onclick="editAdminProduct(${adminProducts.indexOf(p)})" style="background:#e7c36a; color:#1a2340; border:none; border-radius:6px; padding:6px 14px; margin-right:5px; font-weight:600; cursor:pointer;">Edit</button>
                            <button onclick="deleteAdminProduct(${adminProducts.indexOf(p)})" style="background:#e57373; color:#fff; border:none; border-radius:6px; padding:6px 14px; font-weight:600; cursor:pointer;">Delete</button>
                        </td>
                    </tr>
                `).join('');
            }
            document.getElementById('adminProductSearch').addEventListener('input', renderAdminProductsTable);
            function showProductModal() {
                editingAdminProductIdx = null;
                document.getElementById('adminProductModalTitle').textContent = 'Add Product';
                document.getElementById('adminModalProductName').value = '';
                document.getElementById('adminModalProductPrice').value = '';
                document.getElementById('adminModalProductStock').value = '';
                document.getElementById('adminModalProductDesc').value = '';
                document.getElementById('adminProductModal').style.display = 'flex';
            }
            function editAdminProduct(idx) {
                editingAdminProductIdx = idx;
                const p = adminProducts[idx];
                document.getElementById('adminProductModalTitle').textContent = 'Edit Product';
                document.getElementById('adminModalProductName').value = p.name;
                document.getElementById('adminModalProductPrice').value = p.price;
                document.getElementById('adminModalProductStock').value = p.stock;
                document.getElementById('adminModalProductDesc').value = p.desc || '';
                document.getElementById('adminProductModal').style.display = 'flex';
            }
            function closeAdminProductModal() {
                document.getElementById('adminProductModal').style.display = 'none';
            }
            document.getElementById('adminProductForm').onsubmit = function(e) {
                e.preventDefault();
                const name = document.getElementById('adminModalProductName').value;
                const price = parseFloat(document.getElementById('adminModalProductPrice').value);
                const stock = parseInt(document.getElementById('adminModalProductStock').value, 10);
                const desc = document.getElementById('adminModalProductDesc').value;
                if (editingAdminProductIdx === null) {
                    adminProducts.push({ name, price, stock, desc });
                } else {
                    adminProducts[editingAdminProductIdx] = { ...adminProducts[editingAdminProductIdx], name, price, stock, desc };
                }
                closeAdminProductModal();
                renderAdminProductsTable();
            };
            window.editAdminProduct = editAdminProduct;
            window.deleteAdminProduct = function(idx) {
                if (confirm('Delete this product?')) {
                    adminProducts.splice(idx, 1);
                    renderAdminProductsTable();
                }
            };
            window.showProductModal = showProductModal;
            window.closeAdminProductModal = closeAdminProductModal;
            // Render on load
            renderAdminProductsTable();
            </script>
        </section>
        <!-- Consignors List Section -->
        <section class="admin-section" id="usersSection" style="display:none;">
            <div style="max-width:900px; margin: 40px auto 0 auto; background: #fffefb; border-radius: 18px; box-shadow: 0 4px 28px #e9c97a33; padding: 34px 36px 32px 36px;">
                <h2 style="font-size:1.45rem; font-weight:800; margin-bottom:22px; color:#3a2b16; letter-spacing:-1px;">Consignors Management</h2>
                <form id="addConsignorForm" style="display:flex; flex-wrap:wrap; gap:16px 18px; align-items:center; margin-bottom:18px;" action="../admin.php" method="POST">
                    <label style="flex:1 1 160px; font-weight:600; font-size:1.03rem;">Name
                        <input type="text" id="consignorName" required style="margin-top:5px; border-radius:8px; border:1.5px solid #e2cfa2; padding:10px 12px; font-size:1.04rem; background:#fff8e6; width:100%;">
                    </label>
                    <label style="flex:1 1 180px; font-weight:600; font-size:1.03rem;">Email
                        <input type="email" id="consignorEmail" required style="margin-top:5px; border-radius:8px; border:1.5px solid #e2cfa2; padding:10px 12px; font-size:1.04rem; background:#fff8e6; width:100%;">
                    </label>
                    <label style="flex:1 1 150px; font-weight:600; font-size:1.03rem;">Registration Date
                        <input type="date" id="consignorRegDate" required style="margin-top:5px; border-radius:8px; border:1.5px solid #e2cfa2; padding:10px 12px; font-size:1.04rem; background:#fff8e6; width:100%;">
                    </label>
                    <label style="flex:1 1 140px; font-weight:600; font-size:1.03rem;">Identity ID
                        <input type="text" id="consignorIdentity" required style="margin-top:5px; border-radius:8px; border:1.5px solid #e2cfa2; padding:10px 12px; font-size:1.04rem; background:#fff8e6; width:100%;">
                    </label>
                    <label style="flex:2 1 240px; font-weight:600; font-size:1.03rem;">Address
                        <input type="text" id="consignorAddress" required style="margin-top:5px; border-radius:8px; border:1.5px solid #e2cfa2; padding:10px 12px; font-size:1.04rem; background:#fff8e6; width:100%;">
                    </label>
                    <button type="submit" class="cta-btn" style="margin-top:8px; padding:11px 26px; font-size:1.1rem; border-radius:8px;">Add Consignor</button>
                </form>
                <input type="text" id="searchConsignor" placeholder="Search consignors..." style="margin-bottom:18px; max-width:320px; border-radius:8px; border:1.5px solid #e2cfa2; background:#fff8e6; font-size:1.08rem; padding:10px 14px;">
                <table class="admin-table" style="margin-top:10px;">
                    <thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Reg. Date</th><th>Identity ID</th><th>Address</th><th>Actions</th></tr></thead>
                    <tbody id="consignorsTableBody"></tbody>
    <script>
    // In-memory consignors array
    let consignors = [];
    let editingConsignorIdx = null;

    function renderConsignorsTable() {
        const tbody = document.getElementById('consignorsTableBody');
        const search = (document.getElementById('searchConsignor')?.value || '').toLowerCase();
        const filtered = consignors.filter((c, i) =>
            String(i + 1).includes(search) ||
            c.name.toLowerCase().includes(search) ||
            c.email.toLowerCase().includes(search) ||
            c.regDate.toLowerCase().includes(search) ||
            c.identity.toLowerCase().includes(search) ||
            c.address.toLowerCase().includes(search)
        );
        tbody.innerHTML = filtered.map((c, i) => `
            <tr>
                <td>${i + 1}</td>
                <td>${c.name}</td>
                <td>${c.email}</td>
                <td>${c.regDate}</td>
                <td>${c.identity}</td>
                <td>${c.address}</td>
                <td>
                    <button onclick="editConsignor(${consignors.indexOf(c)})" style="background:#e7c36a; color:#1a2340; border:none; border-radius:6px; padding:6px 14px; margin-right:5px; font-weight:600; cursor:pointer;">Edit</button>
                    <button onclick="deleteConsignor(${consignors.indexOf(c)})" style="background:#e57373; color:#fff; border:none; border-radius:6px; padding:6px 14px; font-weight:600; cursor:pointer;">Delete</button>
                </td>
            </tr>
        `).join('');
    }ك
  
    </script>
            </table>
            <div id="consignorFunctions" style="display:none; margin-top:32px;">
                <h3>Consignor Products</h3>
                <form id="addProductForm">
                    <label>Product Name: <input type="text" id="productName" required></label>
                    <label>Price: <input type="number" id="productPrice" required min="0" step="0.01"></label>
                    <label>Stock: <input type="number" id="productStock" required min="0" step="1"></label>
                    <button type="submit" class="cta-btn">Add Product</button>
                </form>
                <table class="admin-table" style="margin-top:10px;">
                    <thead><tr><th>ID</th><th>Name</th><th>Price</th><th>Stock</th><th>Sales</th><th>Actions</th></tr></thead>
                    <tbody id="productsTableBody"></tbody>
                </table>
                <div style="margin-top:10px;">
                    <strong>Total Earnings: $<span id="totalEarnings">0.00</span></strong>
                </div>
                <div style="margin-top:24px;">
                    <h4>Contact Support</h4>
                    <form id="supportForm">
                        <textarea id="supportMessage" rows="2" placeholder="Type your message..." required></textarea>
                        <button type="submit" class="cta-btn">Send</button>
                    </form>
                    <div id="supportResponse" style="color:green;margin-top:5px;"></div>
                </div>
            </div>
        </section>
        <!-- View Feedbacks Section -->
        <section class="admin-section" id="viewFeedbacksSection" style="display:none;">
            <h2>Feedbacks</h2>
            <table style="width:100%; border-collapse:collapse; margin-bottom:20px;">
                <thead>
                    <tr style="background:#f2c66d;color:#fff;"><th>User</th><th>Email</th><th>Feedback</th><th>Date</th></tr>
                </thead>
                <tbody id="feedbacksTableBody"></tbody>
            </table>
            <button class="cta-btn" onclick="showAdminSection('dashboard')">Back to Dashboard</button>
        </section>
        <!-- Approve Consignor Section -->
        <section class="admin-section" id="approveConsignorSection" style="display:none;">
            <h2>Approve Consignors</h2>
            <table style="width:100%; border-collapse:collapse; margin-bottom:20px;">
                <thead>
                    <tr style="background:#f2c66d;color:#fff;"><th>Name</th><th>Email</th><th>ID Identity</th><th>Address</th><th>Reg. Date</th><th>Action</th></tr>
                </thead>
                <tbody id="consignorsApproveTableBody"></tbody>
            </table>
            <button class="cta-btn" onclick="showAdminSection('dashboard')">Back to Dashboard</button>
        </section>

        <section class="admin-section" id="adminDashboardSection" style="display:block;">
    <h2 style="font-size:2rem;font-weight:900;color:#c19a6b;text-align:center;margin-bottom:14px;letter-spacing:0.01em;">
        <i class="fa-solid fa-gauge-high" style="color:#e2b04a;margin-right:10px;"></i>Welcome, Admin!
    </h2>
    <div class="admin-panels">
        <div class="admin-panel" onclick="window.location.href='../view/userManagement.php';">
            <i class="fa fa-users"></i>
            <h3>Manage Users</h3>
            <p>Manage all users on the platform.</p>
        </div>
        <div class="admin-panel" onclick="window.location.href='../view/prdManagemnt.php';">
            <i class="fa fa-box"></i>
            <h3>Product Management</h3>
            <p>Manage all products on the platform.</p>
        </div>
        <div class="admin-panel" onclick="window.location.href='../view/admin_orders.php';">
            <i class="fa fa-list-check"></i>
            <h3>Orders</h3>
            <p>See all requested orders.</p>
        </div>
        <div class="admin-panel" onclick="window.location.href='../view/viewfeedback.php';">
            <i class="fa fa-comments"></i>
            <h3>View Feedbacks</h3>
            <p>See all user and consignor feedbacks.</p>
        </div>
        <div class="admin-panel" onclick="showAdminSection('viewReports')">
            <i class="fa fa-chart-bar"></i>
            <h3>View Reports</h3>
            <p>View all platform reports.</p>
        </div>
        <div class="admin-panel" onclick="showAdminSection('addAdmin')">
            <i class="fa fa-user-plus"></i>
            <h3>Add Admin</h3>
            <p>Add a new admin account.</p>
        </div>
    </div>
</section>
        <!-- Admin Permissions Sections -->
        <section class="admin-section" id="addProductSection" style="display:none;">
            <h2>Add Product</h2>
            <form id="addProductForm">
                <label>Product Name: <input type="text" id="productName" required></label>
                <label>Price: <input type="number" id="productPrice" required min="0" step="0.01"></label>
                <label>Stock: <input type="number" id="productStock" required min="0" step="1"></label>
                <button type="submit" class="cta-btn">Add Product</button>
            </form>
            <h3>Products List</h3>
            <table class="admin-table">
                <thead><tr><th>ID</th><th>Name</th><th>Price</th><th>Stock</th></tr></thead>
                <tbody id="productsTableBody"></tbody>
            </table>
            <button class="cta-btn" onclick="showAdminSection('dashboard')">Back to Dashboard</button>
        </section>
        <section class="admin-section" id="viewReportsSection" style="display:none;">
            <h2>View Reports</h2>
            <p>All platform reports will be shown here.</p>
            <button class="cta-btn" onclick="showAdminSection('dashboard')">Back to Dashboard</button>
        </section>
        <section class="admin-section" id="deleteUserSection" style="display:none;">
            <h2>Delete User</h2>
            <form>
                <label>User ID: <input type="text" placeholder="Enter User ID"></label>
                <button type="submit" class="cta-btn">Delete User</button>
            </form>
            <button class="cta-btn" onclick="showAdminSection('dashboard')">Back to Dashboard</button>
        </section>
        <section class="admin-section" id="forbiddenUserSection" style="display:none;">
            <h2>Forbid User</h2>
            <form>
                <label>User ID: <input type="text" placeholder="Enter User ID"></label>
                <button type="submit" class="cta-btn">Forbid User</button>
            </form>
            <button class="cta-btn" onclick="showAdminSection('dashboard')">Back to Dashboard</button>
        </section>
        <section class="admin-section" id="addAdminSection" style="display:none;">
            <h2>Add Admin</h2>
            <form>
                <label>Username: <input type="text" placeholder="Enter Username"></label>
                <label>Email: <input type="email" placeholder="Enter Email"></label>
                <button type="submit" class="cta-btn">Add Admin</button>
            </form>
            <button class="cta-btn" onclick="showAdminSection('dashboard')">Back to Dashboard</button>
        </section>
        <section class="admin-section" id="updateProductSection" style="display:none;">
            <h2>Update Product</h2>
            <form>
                <label>Product ID: <input type="text" placeholder="Enter Product ID"></label>
                <button type="submit" class="cta-btn">Update Product</button>
            </form>
            <button class="cta-btn" onclick="showAdminSection('dashboard')">Back to Dashboard</button>
        </section>
        <section class="admin-section" id="approveProductSection" style="display:none;">
            <h2>Approve Product</h2>
            <form>
                <label>Product ID: <input type="text" placeholder="Enter Product ID"></label>
                <button type="submit" class="cta-btn">Approve Product</button>
            </form>
            <button class="cta-btn" onclick="showAdminSection('dashboard')">Back to Dashboard</button>
        </section>
        <section class="admin-section" id="deleteCustomerAccountSection" style="display:none;">
            <h2>Delete Customer Account</h2>
            <form>
                <label>Customer ID: <input type="text" placeholder="Enter Customer ID"></label>
                <button type="submit" class="cta-btn">Delete Account</button>
            </form>
            <button class="cta-btn" onclick="showAdminSection('dashboard')">Back to Dashboard</button>
        </section>
        <section class="admin-section" id="verifySellerIdentitySection" style="display:none;">
            <h2>Verify Seller Identity</h2>
            <form>
                <label>Seller ID: <input type="text" placeholder="Enter Seller ID"></label>
                <button type="submit" class="cta-btn">Verify Identity</button>
            </form>
            <button class="cta-btn" onclick="showAdminSection('dashboard')">Back to Dashboard</button>
        </section>
        <section class="admin-section" id="viewReportedProductsSection" style="display:none;">
            <h2>View Reported Products</h2>
            <p>All reported products will be listed here.</p>
            <button class="cta-btn" onclick="showAdminSection('dashboard')">Back to Dashboard</button>
        </section>
    </main>
    <footer>
        <div class="footer-content">
            <span>&copy; 2025 Bazaar E-commerce. Admin Panel.</span>
        </div>
    </footer>
    <script>
    // Simple JS login/logout (DEMO ONLY!)
    const adminLoginSection = document.getElementById('adminLoginSection');
    const adminDashboardSection = document.getElementById('adminDashboardSection');
    const adminNavLinks = document.getElementById('adminNavLinks');
    const logoutBtn = document.getElementById('logoutBtn');
    const loginForm = document.getElementById('adminLoginForm');
    const loginError = document.getElementById('adminLoginError');
    const adminSections = {
        dashboard: adminDashboardSection,
        addProduct: document.getElementById('addProductSection'),
        viewReports: document.getElementById('viewReportsSection'),
        deleteUser: document.getElementById('deleteUserSection'),
        forbiddenUser: document.getElementById('forbiddenUserSection'),
        addAdmin: document.getElementById('addAdminSection'),
        updateProduct: document.getElementById('updateProductSection'),
        approveProduct: document.getElementById('approveProductSection'),
        deleteCustomerAccount: document.getElementById('deleteCustomerAccountSection'),
        verifySellerIdentity: document.getElementById('verifySellerIdentitySection'),
        viewReportedProducts: document.getElementById('viewReportedProductsSection'),
        viewFeedbacks: document.getElementById('viewFeedbacksSection'),
        approveConsignor: document.getElementById('approveConsignorSection'),
        users: document.getElementById('usersSection'), // Consignors List
        products: document.getElementById('productsSection') // Products Management
    };

    function showAdminSection(section) {
        Object.values(adminSections).forEach(sec => sec.style.display = 'none');
        if (adminSections[section]) adminSections[section].style.display = '';
    }

    if (logoutBtn) {
        logoutBtn.onclick = function() {
            // No login/logout anymore. Just reload dashboard.
            adminDashboardSection.style.display = '';
            showAdminSection('dashboard');
        };
    }
    // On page load
    // In-memory product list
    let products = [];
    // Add Product form handling
    const addProductForm = document.getElementById('addProductForm');
    const productsTableBody = document.getElementById('productsTableBody');
    if (addProductForm && productsTableBody) {
        addProductForm.onsubmit = function(e) {
            e.preventDefault();
            const name = document.getElementById('productName').value;
            const price = parseFloat(document.getElementById('productPrice').value).toFixed(2);
            const stock = parseInt(document.getElementById('productStock').value, 10);
            const id = products.length + 1;
            products.push({ id, name, price, stock });
            renderProducts();
            addProductForm.reset();
        };
        function renderProducts() {
            productsTableBody.innerHTML = products.map(p => `<tr><td>${p.id}</td><td>${p.name}</td><td>$${p.price}</td><td>${p.stock}</td></tr>`).join('');
        }
    }
    // Demo feedbacks and consignors
    const feedbacks = [
        { user: 'Alice', email: 'alice@mail.com', message: 'Great platform!', date: '2025-05-10' },
        { user: 'Bob', email: 'bob@mail.com', message: 'Consignor registration was easy.', date: '2025-05-12' }
    ];
    const consignorsToApprove = [
        { name: 'Charlie', email: 'charlie@mail.com', identityId: 'ID12345', address: '123 Main St', regDate: '2025-05-14' },
        { name: 'Dana', email: 'dana@mail.com', identityId: 'ID67890', address: '456 Oak Ave', regDate: '2025-05-15' }
    ];
    function renderFeedbacks() {
        const tbody = document.getElementById('feedbacksTableBody');
        if (!tbody) return;
        tbody.innerHTML = feedbacks.map(f => `<tr><td>${f.user}</td><td>${f.email}</td><td>${f.message}</td><td>${f.date}</td></tr>`).join('');
    }
    function renderConsignorsToApprove() {
        const tbody = document.getElementById('consignorsApproveTableBody');
        if (!tbody) return;
        tbody.innerHTML = consignorsToApprove.map((c, i) => `<tr><td>${c.name}</td><td>${c.email}</td><td>${c.identityId}</td><td>${c.address}</td><td>${c.regDate}</td><td><button onclick="approveConsignor(${i})">Approve</button> <button onclick="rejectConsignor(${i})" style="background:#e57373; color:#fff; margin-left:7px;">Reject</button></td></tr>`).join('');
    }
    window.approveConsignor = function(idx) {
        const c = consignorsToApprove.splice(idx, 1)[0];
        alert('Consignor approved: ' + c.name);
        renderConsignorsToApprove();
    };
    window.rejectConsignor = function(idx) {
        const c = consignorsToApprove.splice(idx, 1)[0];
        alert('Consignor rejected: ' + c.name);
        renderConsignorsToApprove();
    }
    window.onload = function() {
        adminDashboardSection.style.display = '';
        showAdminSection('dashboard');
        renderFeedbacks();
        renderConsignorsToApprove();
    };

    window.showAdminSection = showAdminSection;
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
