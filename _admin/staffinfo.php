<?php
include 'sql/config.php';

// Remove staff
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_staff_id'])) {
    $id = intval($_POST['remove_staff_id']);
    $conn->query("DELETE FROM staff WHERE staff_id = $id");
    header("Location: staffinfo.php");
    exit;
}

// Toggle status
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['toggle_status_id'])) {
    $id = intval($_POST['toggle_status_id']);
    $current = $_POST['current_status'];
    $newStatus = ($current === 'active') ? 'inactive' : 'active';
    $conn->query("UPDATE staff SET status = '$newStatus' WHERE staff_id = $id");
    header("Location: staffinfo.php");
    exit;
}

// Get staff list
$sql = "
    SELECT s.staff_id, s.name, s.contact_info, b.branch_name, s.position, s.status, 
           DATEDIFF(CURDATE(), s.date_joined) AS days_present
    FROM staff s
    LEFT JOIN branch b ON s.branch_id = b.branch_id
";
$staff_result = $conn->query($sql);
?>

<!-- HTML (unchanged styles as requested) -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Staff Information</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
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

        <main class="flex-1 p-6 overflow-y-auto">
            <h1 class="text-2xl font-semibold mb-4">Staff Information</h1>

            <a href="add_staff.php" class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block">+ Add Staff</a>

            <div class="bg-white p-4 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-2">Staff List</h2>
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 p-2">Staff ID</th>
                            <th class="border border-gray-300 p-2">Name</th>
                            <th class="border border-gray-300 p-2">Contact</th>
                            <th class="border border-gray-300 p-2">Branch</th>
                            <th class="border border-gray-300 p-2">Role</th>
                            <th class="border border-gray-300 p-2">Status</th>
                            <th class="border border-gray-300 p-2">Days Present</th>
                            <th class="border border-gray-300 p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($staff_result && $staff_result->num_rows > 0): ?>
                            <?php while ($row = $staff_result->fetch_assoc()): ?>
                                <tr>
                                    <td class="border border-gray-300 p-2"><?= $row['staff_id']; ?></td>
                                    <td class="border border-gray-300 p-2"><?= htmlspecialchars($row['name']); ?></td>
                                    <td class="border border-gray-300 p-2"><?= htmlspecialchars($row['contact_info']); ?></td>
                                    <td class="border border-gray-300 p-2">
                                        <?= htmlspecialchars($row['branch_name'] ?? 'N/A'); ?>
                                    </td>
                                    <td class="border border-gray-300 p-2"><?= htmlspecialchars($row['position']); ?></td>
                                    <td class="border border-gray-300 p-2"><?= ucfirst($row['status']); ?></td>
                                    <td class="border border-gray-300 p-2"><?= $row['days_present']; ?> days</td>
                                    <td class="border border-gray-300 p-2 space-y-1">
                                        <form method="POST">
                                            <input type="hidden" name="remove_staff_id" value="<?= $row['staff_id']; ?>">
                                            <button type="submit"
                                                class="bg-red-500 text-white px-2 py-1 rounded">Remove</button>
                                        </form>
                                        <form method="POST">
                                            <input type="hidden" name="toggle_status_id" value="<?= $row['staff_id']; ?>">
                                            <input type="hidden" name="current_status" value="<?= $row['status']; ?>">
                                            <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded">Toggle
                                                Status</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center p-4">No staff found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <script src="./js/adminbuttonid.js"></script>
</body>

</html>