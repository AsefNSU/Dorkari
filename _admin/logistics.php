<?php

include('sql/config.php');

// Fetch total inventory from the logistics table
$totalInventorySql = "SELECT COUNT(*) AS total FROM logistics";
$totalInventoryResult = $conn->query($totalInventorySql);
$totalInventory = $totalInventoryResult->fetch_assoc()['total'];

// Fetch pending orders from the logistics table
$pendingOrdersSql = "SELECT COUNT(*) AS pending FROM logistics WHERE delivery_status = 'pending'";
$pendingOrdersResult = $conn->query($pendingOrdersSql);
$pendingOrders = $pendingOrdersResult->fetch_assoc()['pending'];

// Fetch deliveries completed today (assuming you have a delivery_date column)
$deliveriesTodaySql = "SELECT COUNT(*) AS delivered_today FROM logistics WHERE DATE(delivery_date) = CURDATE()";
$deliveriesTodayResult = $conn->query($deliveriesTodaySql);
$deliveriesToday = $deliveriesTodayResult->fetch_assoc()['delivered_today'];

// Fetch logistics items from the database
$sql = "SELECT product_name, supplier_name, unit_price, delivery_status, last_updated AS import_date, delivery_date FROM logistics";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logistics Management</title>
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
                            class="block p-2 rounded hover:bg-blue-700">Staff Info</a></li>
                    <li class="mb-2" id="btn-branch"><a href="branchinfo.php"
                            class="block p-2 rounded hover:bg-blue-700">Branch Info</a></li>
                    <li class="mb-2" id="btn-order"><a href="totalorder.php"
                            class="block p-2 rounded hover:bg-blue-700">Total Orders</a></li>
                    <li class="mb-2" id="btn-cash"><a href="cashstatus.php"
                            class="block p-2 rounded hover:bg-blue-700">Cash Status</a></li>
                    <li class="mb-2" id="btn-setting"><a href="settings.php"
                            class="block p-2 rounded hover:bg-blue-700">Settings</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <h1 class="text-2xl font-semibold mb-4">Logistics Overview</h1>

            <div class="grid grid-cols-3 gap-6">
                <!-- Total Inventory -->
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-2">Total Inventory</h2>
                    <p class="font-bold"><?php echo $totalInventory; ?> Items</p>
                </div>
                <!-- Pending Orders -->
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-2">Pending Orders</h2>
                    <p class="font-bold"><?php echo $pendingOrders; ?></p>
                </div>
                <!-- Deliveries Completed Today -->
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-2">Deliveries Completed Today</h2>
                    <p class="font-bold"><?php echo $deliveriesToday; ?></p>
                </div>
            </div>

            <!-- Logistics Items Table -->
            <div class="bg-white p-4 rounded-lg shadow mt-6">
                <h2 class="text-xl font-semibold mb-2">Logistics Items</h2>
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 p-2">Item Name</th>
                            <th class="border border-gray-300 p-2">Supplier</th>
                            <th class="border border-gray-300 p-2">Unit Price</th>
                            <th class="border border-gray-300 p-2">Delivery Status</th>
                            <th class="border border-gray-300 p-2">Import Date</th>
                            <th class="border border-gray-300 p-2">Quantity</th>
                            <th class="border border-gray-300 p-2">Delivery Date</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            // Fetch each row of data and display it
                            while ($row = $result->fetch_assoc()) {
                                $productName = $row['product_name'];
                                $supplier = $row['supplier_name'];
                                $unitPrice = number_format($row['unit_price'], 2);
                                $deliveryStatus = ucfirst($row['delivery_status']);
                                $importDate = date('Y-m-d', strtotime($row['import_date']));
                                $deliveryDate = $row['delivery_date'] ? date('Y-m-d', strtotime($row['delivery_date'])) : 'Not Delivered Yet';

                                $quantity = 100; // Replace with actual quantity if available
                                $isExpired = $row['delivery_date'] && strtotime($row['delivery_date']) < time();
                                $deliveryClass = $row['delivery_date'] === null ? 'text-orange-600' : ($isExpired ? 'text-red-600' : '');

                                echo "<tr>
                                    <td class='border border-gray-300 p-2'>{$productName}</td>
                                    <td class='border border-gray-300 p-2'>{$supplier}</td>
                                    <td class='border border-gray-300 p-2'>৳{$unitPrice}</td>
                                    <td class='border border-gray-300 p-2'>{$deliveryStatus}</td>
                                    <td class='border border-gray-300 p-2'>{$importDate}</td>
                                    <td class='border border-gray-300 p-2'>{$quantity}</td>
                                    <td class='border border-gray-300 p-2 {$deliveryClass}'>{$deliveryDate}</td>
                                </tr>";
                            }

                        } else {
                            echo "<tr><td colspan='4' class='text-center p-2'>No logistics data found.</td></tr>";
                        }

                        // Close the database connection
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <script src="./js/adminbuttonid.js"></script>
</body>

</html>