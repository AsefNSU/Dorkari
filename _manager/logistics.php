<?php
require_once '../sql/config.php';

// Handle Add
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'add') {
    $stmt = $conn->prepare("INSERT INTO logistics (branch, product_name, quantity, unit_price) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $_POST['branch'], $_POST['product_name'], $_POST['quantity'], $_POST['unit_price']);
    $stmt->execute();
    exit;
}

// Handle Delete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'delete') {
    $stmt = $conn->prepare("DELETE FROM logistics WHERE logistics_id = ?");
    $stmt->bind_param("i", $_POST['id']);
    $stmt->execute();
    exit;
}

// Handle Edit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'edit') {
    $stmt = $conn->prepare("UPDATE logistics SET product_name=?, quantity=?, unit_price=? WHERE logistics_id=?");
    $stmt->bind_param("siii", $_POST['product_name'], $_POST['quantity'], $_POST['unit_price'], $_POST['id']);
    $stmt->execute();
    exit;
}

// Fetch logistics data
$logistics = $conn->query("SELECT * FROM logistics")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Logistics Management</title>
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
        <main class="flex-1 p-6 overflow-y-auto">
            <h1 class="text-2xl font-semibold mb-4">Logistics Management</h1>

            <!-- Add Form -->
            <div class="bg-white p-6 rounded-lg shadow mb-6">
                <h2 class="text-xl font-semibold mb-3">Add Item</h2>
                <form id="addForm" class="grid grid-cols-4 gap-4">
                    <input type="text" name="branch" value="Gulshan Branch" readonly
                        class="p-2 border rounded bg-gray-200">
                    <input type="text" name="product_name" placeholder="Product Name" required
                        class="p-2 border rounded">
                    <input type="number" name="quantity" placeholder="Quantity" required class="p-2 border rounded">
                    <input type="number" name="unit_price" placeholder="Unit Price" required class="p-2 border rounded">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded col-span-1">Add</button>
                </form>
            </div>

            <!-- Inventory Table -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-3">Inventory</h2>
                <table class="w-full border border-gray-300 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2 border">ID</th>
                            <th class="p-2 border">Branch</th>
                            <th class="p-2 border">Product</th>
                            <th class="p-2 border">Quantity</th>
                            <th class="p-2 border">Unit Price</th>
                            <th class="p-2 border">Total</th>
                            <th class="p-2 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($logistics as $item): ?>
                            <tr data-id="<?= $item['logistics_id'] ?>">
                                <td class="border p-2"><?= $item['logistics_id'] ?></td>
                                <td class="border p-2"><?= htmlspecialchars($item['branch']) ?></td>
                                <td class="border p-2 name-cell"><?= htmlspecialchars($item['product_name']) ?></td>
                                <td class="border p-2 quantity-cell"><?= $item['quantity'] ?></td>
                                <td class="border p-2 unit-price-cell"><?= $item['unit_price'] ?></td>
                                <td class="border p-2">Tk <?= $item['unit_price'] * $item['quantity'] ?></td>
                                <td class="border p-2">
                                    <button class="edit-btn bg-yellow-400 text-white px-2 py-1 rounded"
                                        data-id="<?= $item['logistics_id'] ?>">Edit</button>
                                    <button class="delete-btn bg-red-600 text-white px-2 py-1 rounded ml-1"
                                        data-id="<?= $item['logistics_id'] ?>">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Edit Form -->
                <div id="editFormContainer" class="bg-white p-6 rounded-lg shadow mt-6 hidden">
                    <h2 class="text-xl font-semibold mb-3">Edit Logistics Item</h2>
                    <form id="editLogisticsForm">
                        <input type="hidden" name="id" id="edit_id">
                        <input type="hidden" name="action" value="edit">

                        <div class="mb-3">
                            <label class="block font-semibold">Product Name</label>
                            <input type="text" name="product_name" id="edit_name" class="w-full p-2 border rounded"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="block font-semibold">Quantity</label>
                            <input type="number" name="quantity" id="edit_quantity" class="w-full p-2 border rounded"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="block font-semibold">Unit Price (Tk)</label>
                            <input type="number" name="unit_price" id="edit_unit_price"
                                class="w-full p-2 border rounded" required>
                        </div>

                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update</button>
                        <button type="button" id="cancelEdit"
                            class="ml-2 bg-gray-400 text-white px-4 py-2 rounded">Cancel</button>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Add Item
        document.getElementById('addForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const form = new FormData(this);
            form.append('action', 'add');

            fetch('logistics.php', {
                method: 'POST',
                body: form
            }).then(() => location.reload());
        });

        // Edit Logic
        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const row = btn.closest('tr');
                document.getElementById('edit_id').value = btn.dataset.id;
                document.getElementById('edit_name').value = row.querySelector('.name-cell').innerText;
                document.getElementById('edit_quantity').value = row.querySelector('.quantity-cell').innerText;
                document.getElementById('edit_unit_price').value = row.querySelector('.unit-price-cell').innerText;
                document.getElementById('editFormContainer').classList.remove('hidden');
                window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
            });
        });

        document.getElementById('cancelEdit').addEventListener('click', () => {
            document.getElementById('editFormContainer').classList.add('hidden');
            document.getElementById('editLogisticsForm').reset();
        });

        document.getElementById('editLogisticsForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const form = new FormData(this);
            fetch('logistics.php', {
                method: 'POST',
                body: form
            }).then(() => location.reload());
        });

        // Delete Logic
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                if (confirm("Are you sure you want to delete this item?")) {
                    const form = new FormData();
                    form.append('action', 'delete');
                    form.append('id', btn.dataset.id);

                    fetch('logistics.php', {
                        method: 'POST',
                        body: form
                    }).then(() => location.reload());
                }
            });
        });
    </script>
</body>

</html>