<?php
include 'sql/config.php';

// Get all branches
$branchesResult = mysqli_query($conn, "SELECT branch_id, branch_name FROM branch");
$branches = [];
while ($row = mysqli_fetch_assoc($branchesResult)) {
    $branches[] = $row;
}

$selectedBranch = $branches[0]['branch_id'] ?? null;
$selectedName = $branches[0]['branch_name'] ?? '';

// Calculate Time Frame
$timeFrame = $_GET['timeFrame'] ?? 'day';
$dateCondition = "";

switch ($timeFrame) {
    case 'week':
        $dateCondition = "AND order_date >= CURDATE() - INTERVAL 7 DAY";
        break;
    case 'month':
        $dateCondition = "AND order_date >= CURDATE() - INTERVAL 1 MONTH";
        break;
    default:
        $dateCondition = "AND order_date = CURDATE()";
        break;
}

// Helper function to format currency
function formatTk($amount)
{
    return "Tk " . number_format($amount, 2);
}

// Individual Branch Data
function getBranchStats($conn, $branch_id, $dateCondition)
{
    $query = "
        SELECT 
            COALESCE(SUM(m.cost_price * o.quantity), 0) AS inventory_spent,
            COALESCE(SUM(m.price * o.quantity), 0) AS total_sales,
            COALESCE(SUM(CASE WHEN o.payment_method = 'online' THEN m.price * o.quantity ELSE 0 END), 0) AS online_sales,
            COALESCE(SUM(CASE WHEN o.payment_method = 'cash' THEN m.price * o.quantity ELSE 0 END), 0) AS cash_sales
        FROM orders o
        JOIN menu m ON o.menu_id = m.food_id
        WHERE o.branch_id = '$branch_id' $dateCondition
    ";

    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

// Total Combined Stats
$combined = ['inventory_spent' => 0, 'total_sales' => 0, 'online_sales' => 0, 'cash_sales' => 0];
$branchStats = [];

foreach ($branches as $branch) {
    $stats = getBranchStats($conn, $branch['branch_id'], $dateCondition);
    $branchStats[] = ['name' => $branch['branch_name'], 'stats' => $stats];

    $combined['inventory_spent'] += $stats['inventory_spent'];
    $combined['total_sales'] += $stats['total_sales'];
    $combined['online_sales'] += $stats['online_sales'];
    $combined['cash_sales'] += $stats['cash_sales'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cash Status</title>
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
            <h1 class="text-2xl font-semibold mb-4">Cash Status</h1>

            <!-- Time Frame Selection -->
            <form method="GET" class="mb-4">
                <label for="timeFrame" class="block text-lg font-semibold mb-2">Select Time Frame:</label>
                <select name="timeFrame" id="timeFrame" class="p-2 border border-gray-300 rounded w-64 bg-white"
                    onchange="this.form.submit()">
                    <option value="day" <?= $timeFrame == 'day' ? 'selected' : '' ?>>Day</option>
                    <option value="week" <?= $timeFrame == 'week' ? 'selected' : '' ?>>Week</option>
                    <option value="month" <?= $timeFrame == 'month' ? 'selected' : '' ?>>Month</option>
                </select>
            </form>

            <!-- Cash Status Overview -->
            <div class="grid grid-cols-2 gap-6">
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-2">Total Inventory Spent</h2>
                    <p class="text-lg font-bold"><?= formatTk($combined['inventory_spent']) ?></p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-2">Total Sales</h2>
                    <p class="text-lg font-bold"><?= formatTk($combined['total_sales']) ?></p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-2">Total Online Transactions</h2>
                    <p class="text-lg font-bold"><?= formatTk($combined['online_sales']) ?></p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-2">Total Hand Cash Received</h2>
                    <p class="text-lg font-bold"><?= formatTk($combined['cash_sales']) ?></p>
                </div>
            </div>

            <!-- Summary Table -->
            <div class="bg-white p-4 rounded-lg shadow mt-6">
                <h2 class="text-xl font-semibold mb-2">Branch Cash Flow Summary</h2>
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 p-2">Branch</th>
                            <th class="border border-gray-300 p-2">Inventory Spent</th>
                            <th class="border border-gray-300 p-2">Total Sales</th>
                            <th class="border border-gray-300 p-2">Online Transactions</th>
                            <th class="border border-gray-300 p-2">Hand Cash</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($branchStats as $b): ?>
                            <tr>
                                <td class="border border-gray-300 p-2"><?= htmlspecialchars($b['name']) ?></td>
                                <td class="border border-gray-300 p-2"><?= formatTk($b['stats']['inventory_spent']) ?></td>
                                <td class="border border-gray-300 p-2"><?= formatTk($b['stats']['total_sales']) ?></td>
                                <td class="border border-gray-300 p-2"><?= formatTk($b['stats']['online_sales']) ?></td>
                                <td class="border border-gray-300 p-2"><?= formatTk($b['stats']['cash_sales']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Total Sales Icon Display -->
            <div class="flex justify-center items-center mt-6">
                <div
                    class="bg-red-700 text-white p-6 rounded-full text-center w-32 h-32 flex flex-col justify-center items-center shadow-lg">
                    <span class="text-3xl font-bold"><?= formatTk($combined['total_sales']) ?></span>
                    <p class="text-sm">Total Sales</p>
                </div>
            </div>
        </main>
    </div>
</body>

</html>