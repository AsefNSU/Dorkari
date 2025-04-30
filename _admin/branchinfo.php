<?php include 'sql/config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Branch Information</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<!-- Edit Branch Modal -->
<div id="editModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-xl font-semibold mb-4">Edit Branch</h2>
        <form id="editForm">
            <input type="hidden" name="branch_id" id="editBranchId">
            <label class="block mb-2">Branch Name</label>
            <input type="text" name="branch_name" id="editBranchName" class="w-full border px-2 py-1 mb-4" required>

            <label class="block mb-2">Address</label>
            <input type="text" name="address" id="editBranchAddress" class="w-full border px-2 py-1 mb-4" required>

            <label class="block mb-2">Phone</label>
            <input type="text" name="phone_number" id="editBranchPhone" class="w-full border px-2 py-1 mb-4" required>

            <label class="block mb-2">Email</label>
            <input type="email" name="email" id="editBranchEmail" class="w-full border px-2 py-1 mb-4" required>

            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeEditModal()" class="bg-gray-400 px-4 py-2 rounded">Cancel</button>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal(branch) {
        document.getElementById('editBranchId').value = branch.branch_id;
        document.getElementById('editBranchName').value = branch.branch_name;
        document.getElementById('editBranchAddress').value = branch.address;
        document.getElementById('editBranchPhone').value = branch.phone_number;
        document.getElementById('editBranchEmail').value = branch.email;
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    document.getElementById('editForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);

        fetch('edit_branch.php', {
            method: 'POST',
            body: formData
        }).then(res => res.text())
            .then(response => {
                alert(response);
                location.reload();
            });
    });

    function deleteBranch(branchId) {
        if (confirm("Are you sure you want to delete this branch?")) {
            fetch(`delete_branch.php?branch_id=${branchId}`)
                .then(res => res.text())
                .then(response => {
                    alert(response);
                    location.reload();
                });
        }
    }
</script>

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
            <h1 class="text-2xl font-semibold mb-4">Branch Information</h1>

            <!-- Branch Information Table -->
            <div class="bg-white p-4 rounded-lg shadow">
                <a href="addbranch.php" class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block">+ Add
                    Branch</a>

                <h2 class="text-xl font-semibold mb-2">Branch List</h2>
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 p-2">Branch ID</th>
                            <th class="border border-gray-300 p-2">Branch Name</th>
                            <th class="border border-gray-300 p-2">Branch Address</th>
                            <th class="border border-gray-300 p-2">Phone</th>
                            <th class="border border-gray-300 p-2">Email</th>
                            <th class="border border-gray-300 p-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM branch";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td class='border border-gray-300 p-2'>" . htmlspecialchars($row['branch_id']) . "</td>";
                            echo "<td class='border border-gray-300 p-2'>" . htmlspecialchars($row['branch_name']) . "</td>";
                            echo "<td class='border border-gray-300 p-2'>" . htmlspecialchars($row['address']) . "</td>";
                            echo "<td class='border border-gray-300 p-2'>" . htmlspecialchars($row['phone_number']) . "</td>";
                            echo "<td class='border border-gray-300 p-2'>" . htmlspecialchars($row['email']) . "</td>";
                            echo "<td class='border border-gray-300 p-2'>
                <button onclick=\"showBranchDetails('{$row['branch_id']}')\" class='bg-blue-500 text-white px-2 py-1 rounded mr-2'>View</button>
                <button onclick='openEditModal(" . htmlspecialchars(json_encode($row), ENT_QUOTES) . ")' class='bg-yellow-500 text-white px-2 py-1 rounded mr-2'>Edit</button>
                <button onclick=\"deleteBranch('{$row['branch_id']}')\" class='bg-red-600 text-white px-2 py-1 rounded'>Delete</button>
            </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>

            </div>

            <!-- Branch Info Display -->
            <div id="branchInfo" class="bg-white p-4 rounded-lg shadow mt-6 hidden">
                <h2 class="text-xl font-semibold mb-2">Branch Sales Overview</h2>
                <p><strong>Branch ID:</strong> <span id="branchId"></span></p>
                <p><strong>Total Sales:</strong> Tk <span id="totalSales"></span></p>
                <p><strong>Total Items Sold:</strong> <span id="totalItems"></span></p>
                <p><strong>Total Customers Visited:</strong> <span id="totalCustomers"></span></p>
            </div>
        </main>
    </div>

    <script>
        function showBranchDetails(branchId) {
            fetch(`get_branch_stats.php?branch_id=${branchId}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById("branchId").textContent = branchId;
                    document.getElementById("totalSales").textContent = data.total_sales || "0";
                    document.getElementById("totalItems").textContent = data.total_items || "0";
                    document.getElementById("totalCustomers").textContent = data.total_customers || "0";
                    document.getElementById("branchInfo").classList.remove("hidden");
                });
        }
    </script>
</body>

</html>