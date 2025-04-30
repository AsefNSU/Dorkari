<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Branch Info</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-red-700 text-white p-5">
            <h2 class="text-xl font-bold mb-5">Manager Dashboard</h2>
            <nav>
                <ul>
                    <li class="mb-2"><a href="#" class="block p-2 rounded hover:bg-blue-900">Dashboard</a></li>
                    <li class="mb-2"><a href="#" class="block p-2 rounded hover:bg-blue-900">Logistics</a></li>
                    <li class="mb-2"><a href="#" class="block p-2 rounded hover:bg-blue-900">Staff Info</a></li>
                    <li class="mb-2"><a href="#" class="block p-2 rounded hover:bg-blue-900">Branch Info</a></li>
                    <li class="mb-2"><a href="orderinfo.php" class="block p-2 rounded hover:bg-blue-900">Order Info</a></li>
                    <li class="mb-2"><a href="#" class="block p-2 rounded hover:bg-blue-900">Customer Info</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 overflow-auto">
            <h1 class="text-2xl font-semibold mb-4">Branch Information</h1>

            <!-- Sales Entry Form -->
            <div class="bg-white p-6 rounded-lg shadow mb-6">
                <h2 class="text-xl font-semibold mb-3">Enter Sales Data</h2>
                <form id="salesForm">
                    <input type="hidden" id="branchName" value="Gulshan" />

                    <div class="mb-4">
                        <label class="block text-gray-700">Date:</label>
                        <input type="date" id="saleDate" class="w-full p-2 border rounded" required />
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Total Items Sold:</label>
                        <input type="number" id="itemsSold" class="w-full p-2 border rounded" required />
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Total Cash Received (Tk):</label>
                        <input type="number" id="cashReceived" class="w-full p-2 border rounded" required />
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Online Transactions (Tk):</label>
                        <input type="number" id="onlineTransaction" class="w-full p-2 border rounded" required />
                    </div>

                    <button type="submit" class="bg-blue-700 text-white p-2 rounded w-full">Submit Data</button>
                </form>
            </div>

            <!-- Filter Options -->
            <div class="bg-white p-6 rounded-lg shadow mb-6">
                <h2 class="text-xl font-semibold mb-3">View Past Sales Data</h2>
                <label class="block text-gray-700">Filter By:</label>
                <select id="filterOption" class="w-full p-2 border rounded">
                    <option value="day">Daily</option>
                    <option value="week">Weekly</option>
                    <option value="month">Monthly</option>
                </select>
            </div>

            <!-- Sales Data Table -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-3">Sales Data</h2>
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 p-2">Date</th>
                            <th class="border border-gray-300 p-2">Items Sold</th>
                            <th class="border border-gray-300 p-2">Cash Received</th>
                            <th class="border border-gray-300 p-2">Online Transactions</th>
                        </tr>
                    </thead>
                    <tbody id="salesTableBody">
                        <!-- Populated by JS -->
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- JavaScript -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const branchName = document.getElementById("branchName").value;
            const salesForm = document.getElementById("salesForm");
            const filterSelect = document.getElementById("filterOption");
            const salesTable = document.getElementById("salesTableBody");

            const loadSalesData = () => {
                const filter = filterSelect.value;

                fetch(`get_sales.php?branch=${branchName}&filter=${filter}`)
                    .then(res => res.json())
                    .then(data => {
                        salesTable.innerHTML = "";

                        data.forEach(row => {
                            const tr = document.createElement("tr");

                            const isGrouped = row.total_items !== undefined;

                            const date = isGrouped ? row.period : row.sale_date;
                            const items = isGrouped ? row.total_items : row.items_sold;
                            const cash = isGrouped ? row.total_cash : row.cash_received;
                            const online = isGrouped ? row.total_online : row.online_transaction;

                            tr.innerHTML = `
                    <td class="border border-gray-300 p-2">${date}</td>
                    <td class="border border-gray-300 p-2">${items}</td>
                    <td class="border border-gray-300 p-2">Tk ${cash}</td>
                    <td class="border border-gray-300 p-2">Tk ${online}</td>
                `;
                            salesTable.appendChild(tr);
                        });
                    })
                    .catch(err => console.error("Fetch error:", err));
            };



            salesForm.addEventListener("submit", e => {
                e.preventDefault();

                const formData = new FormData();
                formData.append("branch", branchName);
                formData.append("date", document.getElementById("saleDate").value);
                formData.append("itemsSold", document.getElementById("itemsSold").value);
                formData.append("cashReceived", document.getElementById("cashReceived").value);
                formData.append("onlineTransaction", document.getElementById("onlineTransaction").value);

                fetch("add_sale.php", {
                    method: "POST",
                    body: formData
                })
                    .then(res => res.json())
                    .then(data => {
                        alert(data.message);
                        if (data.success) {
                            salesForm.reset();
                            loadSalesData();
                        }
                    })
                    .catch(err => console.error("Error submitting form:", err));
            });

            filterSelect.addEventListener("change", loadSalesData);
            loadSalesData(); // Load initial data
        });
    </script>

    <script src="js/managertobutton.js"></script>
</body>

</html>