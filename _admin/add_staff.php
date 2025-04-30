<?php
include 'sql/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $branch_id = $_POST['branch_id'];
    $status = $_POST['status'];
    $contact_info = $_POST['contact_info'];

    $stmt = $conn->prepare("INSERT INTO staff (name, contact_info, position, status, branch_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $name, $contact_info, $position, $status, $branch_id);
    $stmt->execute();
    header("Location: staffinfo.php");
    exit;
}

$branches = $conn->query("SELECT branch_id, branch_name FROM branch");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Staff</title>
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
            <h1 class="text-2xl font-semibold mb-4">Add New Staff</h1>
            <form method="POST" class="bg-white p-4 rounded shadow w-full max-w-md">
                <div class="mb-3">
                    <label class="block">Name:</label>
                    <input type="text" name="name" required class="w-full border p-2">
                </div>
                <div class="mb-3">
                    <label class="block">Contact Info:</label>
                    <input type="text" name="contact_info" required class="w-full border p-2">
                </div>
                <div class="mb-3">
                    <label class="block">Position:</label>
                    <input type="text" name="position" required class="w-full border p-2">
                </div>
                <div class="mb-3">
                    <label class="block">Branch:</label>
                    <select name="branch_id" required class="w-full border p-2">
                        <?php while ($b = $branches->fetch_assoc()): ?>
                            <option value="<?= $b['branch_id']; ?>"><?= $b['branch_name']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="block">Status:</label>
                    <select name="status" class="w-full border p-2">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Add Staff</button>
                <a href="staffinfo.php" class="ml-4 text-blue-600">← Back to Staff Info</a>
            </form>
</body>


</html>