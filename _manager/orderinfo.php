<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Info</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-red-700 text-white p-5">
            <h2 class="text-xl font-bold mb-5">Manager Dashboard</h2>
            <nav>
                <ul>
                    <li id="btn-dashboard" class="mb-2"><a href="#" class="block p-2 rounded hover:bg-blue-900">Dashboard</a></li>
                    <li id="btn-logistics" class="mb-2"><a href="#" class="block p-2 rounded hover:bg-blue-900">Logistics</a></li>
                    <li id="btn-staff" class="mb-2"><a href="#" class="block p-2 rounded hover:bg-blue-900">Staff Info</a></li>
                    <li id="btn-branch" class="mb-2"><a href="#" class="block p-2 rounded hover:bg-blue-900">Branch Info</a></li>
                    <li id="btn-order" class="mb-2"><a href="#" class="block p-2 rounded hover:bg-blue-900">Order Info</a></li>
                    <li id="btn-customer" class="mb-2"><a href="customerinfo.php" class="block p-2 rounded hover:bg-blue-900">Customer Info</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <h1 class="text-2xl font-semibold mb-4">Order Information</h1>

            <!-- Filter Options -->
            <div class="bg-white p-6 rounded-lg shadow mb-6">
                <h2 class="text-xl font-semibold mb-3">Filter Orders</h2>
                <label class="block text-gray-700">Select Date:</label>
                <input type="date" id="filterDate" class="w-full p-2 border rounded mb-3">
                
                <label class="block text-gray-700">Filter By:</label>
                <select id="filterOption" class="w-full p-2 border rounded">
                    <option value="day">Daily</option>
                    <option value="week">Weekly</option>
                    <option value="month">Monthly</option>
                </select>
            </div>

            <!-- Display Orders -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-3">Orders</h2>
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 p-2">Date</th>
                            <th class="border border-gray-300 p-2">Order #</th>
                            <th class="border border-gray-300 p-2">Customer</th>
                            <th class="border border-gray-300 p-2">Total Items</th>
                            <th class="border border-gray-300 p-2">Items Ordered</th>
                            <th class="border border-gray-300 p-2">Order Cost (Tk)</th>
                            <th class="border border-gray-300 p-2">Rating</th>
                        </tr>
                    </thead>
                    <tbody id="orderTableBody">
                        <!-- Orders will be inserted here dynamically -->
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const branchName = "Gulshan"; // This should be dynamically fetched from manager login
            
            // Sample order data
            const orders = [
                { date: "2025-03-20", orderNo: "ORD001", customer: "Rahim", totalItems: 3, items: "Burger x2, Fries x1", cost: 550, rating: "⭐⭐⭐⭐" },
                { date: "2025-03-21", orderNo: "ORD002", customer: "Karim", totalItems: 5, items: "Pizza x1, Coke x2, Nuggets x2", cost: 800, rating: "⭐⭐⭐⭐⭐" },
                { date: "2025-03-21", orderNo: "ORD003", customer: "Fatema", totalItems: 2, items: "Pasta x1, Coke x1", cost: 420, rating: "⭐⭐⭐" },
                { date: "2025-03-22", orderNo: "ORD004", customer: "Ayesha", totalItems: 4, items: "Burger x2, Fries x2", cost: 600, rating: "⭐⭐⭐⭐⭐" },
                { date: "2025-03-23", orderNo: "ORD005", customer: "Tanvir", totalItems: 1, items: "Pizza x1", cost: 700, rating: "⭐⭐⭐⭐" }
            ];

            document.getElementById("filterDate").addEventListener("change", displayOrders);
            document.getElementById("filterOption").addEventListener("change", displayOrders);

            function displayOrders() {
                const selectedDate = document.getElementById("filterDate").value;
                const filterType = document.getElementById("filterOption").value;
                const today = new Date();
                const orderTableBody = document.getElementById("orderTableBody");
                orderTableBody.innerHTML = "";

                let filteredOrders = orders;

                if (selectedDate) {
                    filteredOrders = filteredOrders.filter(order => order.date === selectedDate);
                }

                if (filterType === "week") {
                    filteredOrders = filteredOrders.filter(order => {
                        const orderDate = new Date(order.date);
                        const weekAgo = new Date();
                        weekAgo.setDate(today.getDate() - 7);
                        return orderDate >= weekAgo && orderDate <= today;
                    });
                } else if (filterType === "month") {
                    filteredOrders = filteredOrders.filter(order => {
                        const orderDate = new Date(order.date);
                        return orderDate.getMonth() === today.getMonth() && orderDate.getFullYear() === today.getFullYear();
                    });
                }

                filteredOrders.forEach(order => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td class="border border-gray-300 p-2">${order.date}</td>
                        <td class="border border-gray-300 p-2">${order.orderNo}</td>
                        <td class="border border-gray-300 p-2">${order.customer}</td>
                        <td class="border border-gray-300 p-2">${order.totalItems}</td>
                        <td class="border border-gray-300 p-2">${order.items}</td>
                        <td class="border border-gray-300 p-2">Tk ${order.cost}</td>
                        <td class="border border-gray-300 p-2">${order.rating}</td>
                    `;
                    orderTableBody.appendChild(row);
                });
            }
            // document.getElementById("filterOption").addEventListener("change", displayOrders);
            // document.getElementById("orderDate").addEventListener("change", displayOrders);

            // function viewOrderDetails(orderNumber) {
            //     const order = orderData.find(o => o.orderNumber === orderNumber);
            //     if (order) {
            //         alert(`Order #${orderNumber} Details:\n
            //                Customer: ${order.customerName}\n
            //                Total Items: ${order.totalItems}\n
            //                Order Cost: Tk ${order.orderCost}\n
            //                Items Ordered:\n${order.items.map(item => ${item.name} (x${item.quantity})).join("\n")}`);
            //     }
            // }

            displayOrders();
        });
    </script>
    <script src="js/managertobutton.js"></script>
</body>
</html>