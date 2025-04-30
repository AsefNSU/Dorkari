<?php
require_once "sql/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $branch_name = $_POST["branch_name"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];

    $stmt = $conn->prepare("INSERT INTO branch (branch_name, address, phone_number, email) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $branch_name, $address, $phone, $email);

    if ($stmt->execute()) {
        header("Location: branchinfo.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Branch</title>
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
            <h1 class="text-2xl font-semibold mb-4">Add New Branch</h1>

            <form method="POST" class="bg-white p-6 rounded shadow-md space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Branch Name</label>
                    <input type="text" name="branch_name" required class="mt-1 p-2 w-full border rounded" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Address</label>
                    <input type="text" name="address" required class="mt-1 p-2 w-full border rounded" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="text" name="phone" required class="mt-1 p-2 w-full border rounded" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" required class="mt-1 p-2 w-full border rounded" />
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Add Branch</button>
                </div>
            </form>
        </main>
    </div>
</body>

</html>