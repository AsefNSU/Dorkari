<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard - Dorkari</title>
    <link rel="stylesheet" href="styles/common.css">
    <link rel="stylesheet" href="styles/styles.css">
</head>

<body>
    <header>
        <div class="logo">DORKARI</div>
        <nav>
            <ul class="nav-links">
                <li><a href="customer-dashboard.html" class="active">Dashboard</a></li>
                <li><a href="my-orders.html">My Orders</a></li>
                <li><a href="my-profile.html">My Profile</a></li>
                <li><a href="login.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main class="dashboard-container">
        <!-- Sidebar -->
        <aside class="dashboard-sidebar">
            <h3>Customer Menu</h3>
            <ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">My Orders</a></li>
                <li><a href="#">Profile</a></li>
                <li><a href="#">Settings</a></li>
            </ul>
        </aside>

        <!-- Dashboard Content -->
        <section class="dashboard-content">
            <h2>Welcome, Customer</h2>
            <div class="order-summary">
                <div class="stat-item">
                    <h3>Total Orders</h3>
                    <p>10</p>
                </div>
                <div class="stat-item">
                    <h3>Total Spend</h3>
                    <p>2500 TK</p>
                </div>
            </div>
            <div class="recent-orders">
                <h3>Recent Orders</h3>
                <!-- List of customer orders -->
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Dorkari. All rights reserved.</p>
    </footer>

    <script src="scripts/script.js"></script>
</body>

</html>