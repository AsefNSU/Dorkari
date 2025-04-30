<?php include 'sql/config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-red-700 text-white p-5">
            <h2 class="text-xl font-bold mb-5">Admin Dashboard</h2>
            <nav>
                <ul>
                    <li class="mb-2" id="btn-dashboard"><a href="index.php"
                            class="block p-2 rounded hover:bg-blue-700">Dashboard</a></li>
                    <li class="mb-2" id="btn-logistics"><a href="logistics.php"
                            class="block p-2 rounded hover:bg-blue-700">Logistics</a></li>
                    <li class="mb-2" id="btn-staff"><a href="staffinfo.php"
                            class="block p-2 rounded hover:bg-blue-700">Staff
                            Info</a></li>
                    <li class="mb-2" id="btn-branch"><a href="branchinfo.php"
                            class="block p-2 rounded hover:bg-blue-700">Branch
                            Info</a></li>
                    <li class="mb-2" id="btn-order"><a href="totalorder.php"
                            class="block p-2 rounded hover:bg-blue-700">Total
                            Orders</a></li>
                    <li class="mb-2" id="btn-cash"><a href="cashstatus.php"
                            class="block p-2 rounded hover:bg-blue-700">Cash
                            Status</a></li>
                    <li class="mb-2" id="btn-setting"><a href="settings.php"
                            class="block p-2 rounded hover:bg-blue-700">Settings</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <h1 class="text-2xl font-semibold mb-4">Overview</h1>

            <!-- Logistics Overview -->
            <div class="grid grid-cols-3 gap-6 mb-6">
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-2">Logistics Overview</h2>
                    <p>Total Inventory:
                        <span class="font-bold">
                            <?php
                            $result = $conn->query("SELECT COUNT(*) AS total_items FROM item");
                            $inventory = $result->fetch_assoc()['total_items'];
                            echo $inventory;
                            ?>
                        </span>
                    </p>
                    <p>Orders Pending:
                        <span class="font-bold">
                            <?php
                            $result = $conn->query("SELECT COUNT(*) AS pending FROM orders WHERE status = 'pending'");
                            $orders_pending = $result->fetch_assoc()['pending'];
                            echo $orders_pending;
                            ?>
                        </span>
                    </p>
                    <p>Deliveries Completed:
                        <span class="font-bold">
                            <?php
                            $result = $conn->query("SELECT COUNT(*) AS completed FROM orders WHERE status = 'completed'");
                            $orders_completed = $result->fetch_assoc()['completed'];
                            echo $orders_completed;
                            ?>
                        </span>
                    </p>
                </div>

                <!-- Total Orders -->
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-2">Total Orders</h2>
                    <p>Today:
                        <span class="font-bold">
                            <?php
                            $today = date('Y-m-d');
                            $result = $conn->query("SELECT COUNT(*) AS total FROM orders WHERE order_date = '$today'");
                            echo $result->fetch_assoc()['total'];
                            ?>
                        </span>
                    </p>
                    <p>This Week:
                        <span class="font-bold">
                            <?php
                            $weekStart = date('Y-m-d', strtotime("last Sunday"));
                            $weekEnd = date('Y-m-d', strtotime("next Saturday"));
                            $result = $conn->query("SELECT COUNT(*) AS total FROM orders WHERE order_date BETWEEN '$weekStart' AND '$weekEnd'");
                            echo $result->fetch_assoc()['total'];
                            ?>
                        </span>
                    </p>
                    <p>This Month:
                        <span class="font-bold">
                            <?php
                            $month = date('Y-m');
                            $result = $conn->query("SELECT COUNT(*) AS total FROM orders WHERE order_date LIKE '$month%'");
                            echo $result->fetch_assoc()['total'];
                            ?>
                        </span>
                    </p>
                </div>
            </div>

            <!-- Cash Status Per Branch -->
            <div class="bg-white p-4 rounded-lg shadow mb-6">
                <h2 class="text-xl font-semibold mb-2">Cash Status Per Branch</h2>
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border p-2">Branch</th>
                            <th class="border p-2">Total Sales Today</th>
                            <th class="border p-2">Cash Received</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $today = date('Y-m-d');

                        $branchQuery = "SELECT * FROM branch";
                        $branchResult = $conn->query($branchQuery);

                        while ($branch = $branchResult->fetch_assoc()) {
                            $branch_id = $branch['branch_id'];
                            $branch_name = $branch['branch_name'];

                            // Get orders for today for this branch via staff → branch
                            $salesQuery = "
                    SELECT SUM(o.total_price) as total_sales,
                           SUM(CASE WHEN o.payment_status = 'paid' THEN o.total_price ELSE 0 END) as cash_received
                    FROM orders o
                    JOIN customer c ON o.customer_id = c.customer_id
                    WHERE DATE(o.order_date) = '$today'
                    AND o.customer_id IN (
                        SELECT customer_id FROM orders
                        WHERE customer_id IS NOT NULL
                        AND order_id IN (
                            SELECT order_id FROM orders
                        )
                    )
                ";
                            $salesResult = $conn->query($salesQuery);
                            $sales = $salesResult->fetch_assoc();

                            echo "<tr>
                        <td class='border border-gray-300 p-2'>{$branch_name}</td>
                        <td class='border border-gray-300 p-2'>Tk " . number_format($sales['total_sales'] ?? 0) . "</td>
                        <td class='border border-gray-300 p-2'>Tk " . number_format($sales['cash_received'] ?? 0) . "</td>
                    </tr>";
                        }

                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Branch info here -->
            <div class="bg-white p-4 rounded-lg shadow mt-6">
                <h2 class="text-xl font-semibold mb-2">Branch Information</h2>
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 p-2">Branch Name</th>
                            <th class="border border-gray-300 p-2">Address</th>
                            <th class="border border-gray-300 p-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $branches = $conn->query("SELECT * FROM branch");
                        while ($row = $branches->fetch_assoc()) {
                            echo "<tr>
                        <td class='border border-gray-300 p-2'>{$row['branch_name']}</td>
                        <td class='border border-gray-300 p-2'>{$row['address']}</td>
                        <td class='border border-gray-300 p-2 text-green-600'>Operational</td>
                    </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- Staff info here-->
            <div class="bg-white p-4 rounded-lg shadow mt-6">
                <h2 class="text-xl font-semibold mb-2">Staff Information</h2>
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 p-2">Name</th>
                            <th class="border border-gray-300 p-2">Role</th>
                            <th class="border border-gray-300 p-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $staff = $conn->query("SELECT * FROM staff");
                        while ($row = $staff->fetch_assoc()) {
                            $status_class = $row['status'] == 'active' ? 'text-green-600' : 'text-red-600';
                            echo "<tr>
                        <td class='border border-gray-300 p-2'>{$row['name']}</td>
                        <td class='border border-gray-300 p-2'>{$row['position']}</td>
                        <td class='border border-gray-300 p-2 {$status_class}'>" . ucfirst($row['status']) . "</td>
                    </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <?php $conn->close(); ?>

</body>

</html>