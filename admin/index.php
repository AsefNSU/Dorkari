<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Dorkari</title>
    <link rel="stylesheet" href="styles/common.css">
    <link rel="stylesheet" href="styles/styles.css">
</head>

<body>
    <header>
        <div class="logo">DORKARI</div>
        <nav>
            <ul class="nav-links">
                <li><a href="admin-dashboard.html" class="active">Dashboard</a></li>
                <li><a href="manage-orders.html">Manage Orders</a></li>
                <li><a href="manage-products.html">Manage Products</a></li>
                <li><a href="manage-users.html">Manage Users</a></li>
                <li><a href="login.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main class="dashboard-container">
        <!-- Sidebar -->
        <aside class="dashboard-sidebar">
            <h3>Admin Menu</h3>
            <ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Orders</a></li>
                <li><a href="#">Products</a></li>
                <li><a href="#">Users</a></li>
                <li><a href="#">Settings</a></li>
            </ul>
        </aside>

        <!-- Dashboard -->
        <section class="dashboard-content">
            <h2>Welcome, Admin</h2>
            <div class="stats">
                <div class="stat-item">
                    <h3>Total Orders</h3>
                    <p>1250</p>
                </div>
                <div class="stat-item">
                    <h3>Total Revenue</h3>
                    <p>50,000 TK</p>
                </div>
                <div class="stat-item">
                    <h3>Total Users</h3>
                    <p>850</p>
                </div>
            </div>
            <div class="recent-orders">
                <h3>Recent Orders</h3>
                
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Dorkari. All rights reserved.</p>
    </footer>

    <script src="scripts/script.js"></script>
</body>

</html>