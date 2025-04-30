<?php
include './sql/config.php';

$branches = [];
$orders = [];
$totalSold = 0;

$selectedBranch = $_GET['branch'] ?? '';
$selectedDate = $_GET['date'] ?? '';

// Fetch branch list
$branchQuery = "SELECT branch_id, branch_name FROM branch";
$branchResult = mysqli_query($conn, $branchQuery);
while ($row = mysqli_fetch_assoc($branchResult)) {
    $branches[] = $row;
}

// Fetch orders if filters are applied
if ($selectedBranch && $selectedDate) {
    $orderQuery = "
    SELECT m.food_name, SUM(oi.quantity) as total_quantity
    FROM orders o
    JOIN order_items oi ON o.order_id = oi.order_id
    JOIN menu m ON oi.food_id = m.food_id
    WHERE o.branch_id = '$selectedBranch' AND DATE(o.order_date) = '$selectedDate'
    GROUP BY m.food_name
";

    $orderResult = mysqli_query($conn, $orderQuery);
    while ($row = mysqli_fetch_assoc($orderResult)) {
        $orders[] = $row;
        $totalSold += $row['total_quantity'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Orders</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-red-700 text-white p-5">
            <h2 class="text-xl font-bold mb-5">Admin Dashboard</h2>
            <nav>
                <ul>
                    <li class="mb-2"><a href="index.php" class="block p-2 rounded hover:bg-blue-700">Dashboard</a></li>
                    <li class="mb-2"><a href="logistics.php" class="block p-2 rounded hover:bg-blue-700">Logistics</a>
                    </li>
                    <li class="mb-2"><a href="staffinfo.php" class="block p-2 rounded hover:bg-blue-700">Staff Info</a>
                    </li>
                    <li class="mb-2"><a href="branchinfo.php" class="block p-2 rounded hover:bg-blue-700">Branch
                            Info</a></li>
                    <li class="mb-2"><a href="totalorder.php" class="block p-2 rounded hover:bg-blue-700">Total
                            Orders</a></li>
                    <li class="mb-2"><a href="cashstatus.php" class="block p-2 rounded hover:bg-blue-700">Cash
                            Status</a></li>
                    <li class="mb-2"><a href="settings.php" class="block p-2 rounded hover:bg-blue-700">Settings</a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-2xl font-semibold">Total Orders</h1>
                <button onclick="location.href='addorder.php'" class="bg-blue-600 text-white px-4 py-2 rounded">Add
                    Order</button>
            </div>

            <form method="GET" class="mb-6 flex flex-wrap gap-4">
                <div>
                    <label for="branchSelect" class="block font-semibold mb-1">Select Branch:</label>
                    <select id="branchSelect" name="branch" class="p-2 border border-gray-300 rounded w-64 bg-white">
                        <option value="">-- Choose Branch --</option>
                        <?php foreach ($branches as $branch): ?>
                            <option value="<?= $branch['branch_id'] ?>" <?= ($branch['branch_id'] == $selectedBranch) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($branch['branch_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label for="orderDate" class="block font-semibold mb-1">Select Date:</label>
                    <input type="date" id="orderDate" name="date" value="<?= $selectedDate ?>"
                        class="p-2 border border-gray-300 rounded w-64 bg-white">
                </div>

                <div class="flex items-end">
                    <button type="submit" class="bg-red-700 text-white px-4 py-2 rounded">Filter</button>
                </div>
            </form>

            <?php if ($selectedBranch && $selectedDate): ?>
                <div class="bg-white p-4 rounded-lg shadow mt-4">
                    <h2 class="text-xl font-semibold mb-2">Items Sold</h2>
                    <table class="w-full border-collapse border border-gray-300">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="border border-gray-300 p-2">Item Name</th>
                                <th class="border border-gray-300 p-2">Quantity Sold</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td class="border border-gray-300 p-2"><?= htmlspecialchars($order['item_name']) ?></td>
                                    <td class="border border-gray-300 p-2"><?= $order['total_quantity'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($orders)): ?>
                                <tr>
                                    <td colspan="2" class="border border-gray-300 p-2 text-center text-gray-500">No orders
                                        found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="bg-white p-4 rounded-lg shadow mt-6">
                    <h2 class="text-xl font-semibold mb-2">Total Items Sold</h2>
                    <p class="text-lg"><span class="font-bold">Total Items Sold: </span><?= $totalSold ?></p>
                </div>

                <div class="flex justify-center items-center mt-6">
                    <div
                        class="bg-red-700 text-white p-6 rounded-full text-center w-32 h-32 flex flex-col justify-center items-center shadow-lg">
                        <span class="text-3xl font-bold"><?= $totalSold ?></span>
                        <p class="text-sm">Items Sold</p>
                    </div>
                </div>
            <?php endif; ?>
        </main>
    </div>
    <script src="./js/adminbuttonid.js"></script>
</body>

</html>