<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard - Dorkari</title>
    <link rel="stylesheet" href="styles/common.css">
    <link rel="stylesheet" href="styles/styles.css">
</head>

<body>
    <header>
        <div class="logo">DORKARI</div>
        <nav>
            <ul class="nav-links">
                <li><a href="staff-dashboard.html" class="active">Dashboard</a></li>
                <li><a href="manage-orders.html">Manage Orders</a></li>
                <li><a href="manage-products.html">Manage Products</a></li>
                <li><a href="login.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main class="dashboard-container">
        <!-- Sidebar -->
        <aside class="dashboard-sidebar">
            <h3>Staff Menu</h3>
            <ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Orders</a></li>
                <li><a href="#">Products</a></li>
                <li><a href="#">Settings</a></li>
            </ul>
        </aside>

        <!-- Dashboard Content -->
        <section class="dashboard-content">
            <h2>Welcome, Staff</h2>
            <div class="stats">
                <div class="stat-item">
                    <h3>Orders Pending</h3>
                    <p>20</p>
                </div>
                <div class="stat-item">
                    <h3>Orders Delivered</h3>
                    <p>1230</p>
                </div>
            </div>
            <div class="order-list">
                <h3>Orders to Process</h3>
                <!-- List of orders -->
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Dorkari. All rights reserved.</p>
    </footer>

    <script src="scripts/script.js"></script>
</body>

</html>