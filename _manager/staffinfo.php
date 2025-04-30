<?php
require_once '../sql/config.php';

$staffList = [];
$result = $conn->query("SELECT * FROM staff");
while ($row = $result->fetch_assoc()) {
    $staffList[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Staff Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-red-700 text-white p-5">
            <h2 class="text-xl font-bold mb-5">Manager Dashboard</h2>
            <nav>
                <ul>
                    <li class="mb-2"><a href="index.php" class="block p-2 rounded hover:bg-blue-900">Dashboard</a></li>
                    <li class="mb-2"><a href="logistics.php" class="block p-2 rounded hover:bg-blue-900">Logistics</a>
                    </li>
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
            <h1 class="text-2xl font-semibold mb-4">Staff Management</h1>

            <!-- Add Staff -->
            <div class="bg-white p-6 rounded-lg shadow mb-6">
                <h2 class="text-xl font-semibold mb-3">Add Staff</h2>
                <form action="staff-action.php" method="POST" class="grid grid-cols-4 gap-4">
                    <input type="hidden" name="action" value="add">
                    <input type="text" name="name" placeholder="Name" required class="p-2 border rounded col-span-1">
                    <input type="text" name="position" placeholder="Position" required
                        class="p-2 border rounded col-span-1">
                    <select name="status" required class="p-2 border rounded col-span-1">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded col-span-1">Add</button>
                </form>
            </div>

            <!-- Staff Table -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-3">Staff List</h2>
                <table class="w-full border border-gray-300 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2 border">ID</th>
                            <th class="p-2 border">Name</th>
                            <th class="p-2 border">Position</th>
                            <th class="p-2 border">Status</th>
                            <th class="p-2 border">Date Joined</th>
                            <th class="p-2 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($staffList as $staff): ?>
                            <tr>
                                <td class="p-2 border"><?= $staff['staff_id'] ?></td>
                                <td class="p-2 border"><?= $staff['name'] ?></td>
                                <td class="p-2 border"><?= $staff['position'] ?></td>
                                <td class="p-2 border"><?= $staff['status'] ?></td>
                                <td class="p-2 border"><?= $staff['date_joined'] ?></td>
                                <td class="p-2 border">
                                    <button class="edit-btn bg-yellow-500 text-white px-2 py-1 rounded"
                                        data-id="<?= $staff['staff_id'] ?>" data-name="<?= $staff['name'] ?>"
                                        data-position="<?= $staff['position'] ?>"
                                        data-status="<?= $staff['status'] ?>">Edit</button>
                                    <form action="staff-action.php" method="POST" class="inline">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="staff_id" value="<?= $staff['staff_id'] ?>">
                                        <button type="submit" class="bg-red-600 text-white px-2 py-1 rounded"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Edit Form -->
            <div id="editFormContainer" class="bg-white p-6 rounded-lg shadow mt-6 hidden">
                <h2 class="text-xl font-semibold mb-3">Edit Staff</h2>
                <form id="editStaffForm" action="staff-action.php" method="POST">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="staff_id" id="edit_id">
                    <div class="mb-3">
                        <label class="block font-semibold">Name</label>
                        <input type="text" name="name" id="edit_name" required class="w-full p-2 border rounded">
                    </div>
                    <div class="mb-3">
                        <label class="block font-semibold">Position</label>
                        <input type="text" name="position" id="edit_position" required
                            class="w-full p-2 border rounded">
                    </div>
                    <div class="mb-3">
                        <label class="block font-semibold">Status</label>
                        <select name="status" id="edit_status" class="w-full p-2 border rounded">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update</button>
                    <button type="button" id="cancelEdit"
                        class="ml-2 bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                </form>
            </div>
        </main>
    </div>

    <script>
        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('editFormContainer').classList.remove('hidden');
                document.getElementById('edit_id').value = btn.dataset.id;
                document.getElementById('edit_name').value = btn.dataset.name;
                document.getElementById('edit_position').value = btn.dataset.position;
                document.getElementById('edit_status').value = btn.dataset.status;
            });
        });

        document.getElementById('cancelEdit').addEventListener('click', () => {
            document.getElementById('editFormContainer').classList.add('hidden');
        });
    </script>
</body>

</html>