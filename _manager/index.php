<?php
include 'sql/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-red-700 text-white p-5">
            <h2 class="text-xl font-bold mb-5">Manager Dashboard</h2>
            <nav>
                <ul>
                    <li class="mb-2"><a href="index.php"
                            class="block p-2 rounded hover:bg-blue-900 bg-blue-900">Dashboard</a></li>
                    <li class="mb-2"><a href="logistics.php">Logistics</a></li>
                    <li class="mb-2"><a href="staffinfo.php" class="block p-2 rounded hover:bg-blue-900">Staff Info</a>
                    </li>
                    <li class="mb-2"><a href="branchinfo.php" class="block p-2 rounded hover:bg-blue-900">Branch
                            Info</a></li>
                    <li class="mb-2"><a href="orderinfo.php" class="block p-2 rounded hover:bg-blue-900">Order Info</a>
                    </li>
                    <li class="mb-2"><a href="customerinfo.php" class="block p-2 rounded hover:bg-blue-900">Customer
                            Info</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <h1 class="text-2xl font-semibold mb-4">Branch Overview</h1>

            <!-- Dashboard Cards -->
            <div class="grid grid-cols-3 gap-6">
                <!-- Logistics Overview -->
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-2">Logistics Overview</h2>
                    <?php
                    $inventory = mysqli_query($conn, "SELECT SUM(stock_quantity) AS total FROM menu");
                    $inventory_total = mysqli_fetch_assoc($inventory)['total'] ?? 0;

                    $pending_orders = mysqli_query($conn, "SELECT COUNT(*) AS pending FROM orders WHERE status = 'pending'");
                    $pending_count = mysqli_fetch_assoc($pending_orders)['pending'] ?? 0;

                    $delivered_orders = mysqli_query($conn, "SELECT COUNT(*) AS delivered FROM orders WHERE status = 'delivered'");
                    $delivered_count = mysqli_fetch_assoc($delivered_orders)['delivered'] ?? 0;
                    ?>
                    <p>Total Inventory: <span class="font-bold"><?= $inventory_total ?> Items</span></p>
                    <p>Orders Pending: <span class="font-bold"><?= $pending_count ?></span></p>
                    <p>Deliveries Completed: <span class="font-bold"><?= $delivered_count ?></span></p>
                </div>

                <!-- Total Orders -->
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-2">Total Orders</h2>
                    <?php
                    $today = date('Y-m-d');
                    $week_start = date('Y-m-d', strtotime('monday this week'));
                    $month_start = date('Y-m-01');

                    $orders_today = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM orders WHERE order_date = '$today'"))['total'] ?? 0;
                    $orders_week = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM orders WHERE order_date >= '$week_start'"))['total'] ?? 0;
                    $orders_month = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM orders WHERE order_date >= '$month_start'"))['total'] ?? 0;
                    ?>
                    <p>Today: <span class="font-bold"><?= $orders_today ?></span></p>
                    <p>This Week: <span class="font-bold"><?= $orders_week ?></span></p>
                    <p>This Month: <span class="font-bold"><?= $orders_month ?></span></p>
                </div>

                <!-- Customer Overview -->
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-2">Customer Overview</h2>
                    <?php
                    $new_customers = mysqli_query($conn, "SELECT COUNT(*) AS total FROM customer");
                    $total_customers = mysqli_fetch_assoc($new_customers)['total'] ?? 0;

                    // Placeholder for returning customers logic
                    $returning_customers = 15; // Set manually or calculate based on repeat orders
                    ?>
                    <p>Total Customers: <span class="font-bold"><?= $total_customers ?></span></p>
                    <p>Returning Customers: <span class="font-bold"><?= $returning_customers ?></span></p>
                </div>
            </div>

            <!-- Staff Information -->
            <div class="bg-white p-4 rounded-lg shadow mt-6">
                <h2 class="text-xl font-semibold mb-2">Staff Information</h2>
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 p-2">Name</th>
                            <th class="border border-gray-300 p-2">Position</th>
                            <th class="border border-gray-300 p-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $staff_result = mysqli_query($conn, "SELECT name, position, status FROM staff");

                        while ($row = mysqli_fetch_assoc($staff_result)) {
                            $status_class = ($row['status'] === 'active') ? 'text-green-600' : 'text-red-600';
                            echo "<tr>";
                            echo "<td class='border border-gray-300 p-2'>" . htmlspecialchars($row['name']) . "</td>";
                            echo "<td class='border border-gray-300 p-2'>" . htmlspecialchars($row['position']) . "</td>";
                            echo "<td class='border border-gray-300 p-2 $status_class'>" . ucfirst($row['status']) . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <script src="js/managertobutton.js"></script>
</body>

</html>