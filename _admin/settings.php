<?php
include "sql/config.php";

// Add or Edit Logic
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["item_name"])) {
    $name = $_POST["item_name"];
    $price = $_POST["price"];
    $branch = $_POST["branch"] ?? 'bashundhara';
    $status = $_POST["status"] ?? 'active';
    $description = $_POST["description"];
    $editMode = isset($_POST["edit_mode"]) && $_POST["edit_mode"] === "1";
    $foodId = $_POST["food_id"] ?? null;

    // Handle image upload
    $imageName = "";
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] === 0) {
        $imageName = basename($_FILES["image"]["name"]);
        $imageTmp = $_FILES["image"]["tmp_name"];
        move_uploaded_file($imageTmp, "../images/" . $imageName);
    }

    if ($editMode && $foodId) {
        if ($imageName) {
            $stmt = $conn->prepare("UPDATE menu SET food_name=?, price=?, branch=?, status=?, description=?, image=? WHERE food_id=?");
            $stmt->bind_param("sdssssi", $name, $price, $branch, $status, $description, $imageName, $foodId);
        } else {
            $stmt = $conn->prepare("UPDATE menu SET food_name=?, price=?, branch=?, status=?, description=? WHERE food_id=?");
            $stmt->bind_param("sdsssi", $name, $price, $branch, $status, $description, $foodId);
        }
    } else {
        $stmt = $conn->prepare("INSERT INTO menu (food_name, price, branch, status, description, image) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sdssss", $name, $price, $branch, $status, $description, $imageName);
    }

    $stmt->execute();
    $stmt->close();
    header("Location: settings.php");
    exit();
}

// Delete Logic
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete_id"])) {
    $deleteId = intval($_POST["delete_id"]);
    $stmt = $conn->prepare("SELECT image FROM menu WHERE food_id = ?");
    $stmt->bind_param("i", $deleteId);
    $stmt->execute();
    $stmt->bind_result($image);
    $stmt->fetch();
    $stmt->close();

    if ($image && file_exists("images/$image")) {
        unlink("images/$image");
    }

    $stmt = $conn->prepare("DELETE FROM menu WHERE food_id = ?");
    $stmt->bind_param("i", $deleteId);
    $stmt->execute();
    $stmt->close();
    header("Location: settings.php");
    exit();
}

// Fetch for edit
$editItem = null;
if (isset($_GET["edit_id"])) {
    $editId = intval($_GET["edit_id"]);
    $stmt = $conn->prepare("SELECT * FROM menu WHERE food_id = ?");
    $stmt->bind_param("i", $editId);
    $stmt->execute();
    $result = $stmt->get_result();
    $editItem = $result->fetch_assoc();
    $stmt->close();
}

// Fetch all items
$result = $conn->query("SELECT * FROM menu");
?>

<!-- HTML STARTS -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Settings - Manage Menu</title>
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

        <main class="flex-1 p-6 overflow-auto">
            <h1 class="text-2xl font-semibold mb-4">Manage Menu</h1>

            <!-- Add / Edit Form -->
            <div class="bg-white p-4 rounded-lg shadow mb-6">
                <h2 class="text-xl font-semibold mb-2"><?= $editItem ? "Edit Menu Item" : "Add New Menu Item" ?></h2>
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="edit_mode" value="<?= $editItem ? '1' : '0' ?>">
                    <input type="hidden" name="food_id" value="<?= $editItem['food_id'] ?? '' ?>">
                    <div class="grid grid-cols-2 gap-4">
                        <input type="text" name="item_name" placeholder="Item Name"
                            value="<?= htmlspecialchars($editItem['food_name'] ?? '') ?>"
                            class="p-2 border border-gray-300 rounded w-full">
                        <input type="text" name="price" placeholder="Price (Tk)"
                            value="<?= htmlspecialchars($editItem['price'] ?? '') ?>"
                            class="p-2 border border-gray-300 rounded w-full">
                        <select name="branch" class="p-2 border border-gray-300 rounded w-full">
                            <option value="">Select Branch</option>
                            <?php foreach (["bashundhara", "dhanmondi", "banani"] as $b): ?>
                                <option value="<?= $b ?>" <?= ($editItem['branch'] ?? '') == $b ? 'selected' : '' ?>>
                                    <?= ucfirst($b) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <select name="status" class="p-2 border border-gray-300 rounded w-full">
                            <option value="active" <?= ($editItem['status'] ?? '') == 'active' ? 'selected' : '' ?>>Active
                            </option>
                            <option value="inactive" <?= ($editItem['status'] ?? '') == 'inactive' ? 'selected' : '' ?>>
                                Inactive</option>
                        </select>
                        <input type="file" name="image" class="p-2 border border-gray-300 rounded w-full">
                    </div>
                    <textarea name="description" placeholder="Ingredients & Description"
                        class="mt-4 p-2 border border-gray-300 rounded w-full"><?= htmlspecialchars($editItem['description'] ?? '') ?></textarea>
                    <button type="submit" class="mt-4 bg-blue-700 text-white p-2 rounded w-full">
                        <?= $editItem ? "Update Item" : "Add Item" ?>
                    </button>
                </form>
            </div>

            <!-- Menu Items Table -->
            <div class="bg-white p-4 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-2">Current Menu</h2>
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border p-2">Image</th>
                            <th class="border p-2">Item Name</th>
                            <th class="border p-2">Price</th>
                            <th class="border p-2">Branch</th>
                            <th class="border p-2">Status</th>
                            <th class="border p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td class="border p-2"><img src="../images/<?= htmlspecialchars($row['image']) ?>"
                                        class="w-12 h-12 object-cover rounded"></td>
                                <td class="border p-2"><?= htmlspecialchars($row['food_name']) ?></td>
                                <td class="border p-2">Tk <?= htmlspecialchars($row['price']) ?></td>
                                <td class="border p-2"><?= htmlspecialchars(ucfirst($row['branch'])) ?></td>
                                <td
                                    class="border p-2 <?= $row['status'] == 'active' ? 'text-green-600' : 'text-red-600' ?>">
                                    <?= ucfirst($row['status']) ?>
                                </td>
                                <td class="border p-2">
                                    <form method="GET" action="settings.php" class="inline">
                                        <input type="hidden" name="edit_id" value="<?= $row['food_id'] ?>">
                                        <button class="bg-red-500 text-white p-1 rounded">Edit</button>
                                    </form>
                                    <form method="POST" action="settings.php" class="inline">
                                        <input type="hidden" name="delete_id" value="<?= $row['food_id'] ?>">
                                        <button onclick="return confirm('Are you sure?')"
                                            class="bg-red-500 text-white p-1 rounded">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <script src="./js/adminbuttonid.js"></script>
</body>

</html>

<?php $conn->close(); ?>