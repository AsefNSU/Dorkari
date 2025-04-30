<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Info</title>
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
                    <li id="btn-customer" class="mb-2"><a href="#" class="block p-2 rounded hover:bg-blue-900">Customer Info</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <h1 class="text-2xl font-semibold mb-4">Customer Information</h1>

            <!-- Reservations Section -->
            <div class="bg-white p-6 rounded-lg shadow mb-6">
                <h2 class="text-xl font-semibold mb-3">Table Reservations</h2>
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 p-2">Customer</th>
                            <th class="border border-gray-300 p-2">Phone</th>
                            <th class="border border-gray-300 p-2">Table #</th>
                            <th class="border border-gray-300 p-2">People</th>
                            <th class="border border-gray-300 p-2">Time</th>
                            <th class="border border-gray-300 p-2">Status</th>
                            <th class="border border-gray-300 p-2">Action</th>
                        </tr>
                    </thead>
                    <tbody id="reservationTableBody">
                        <!-- Reservations will be inserted here dynamically -->
                    </tbody>
                </table>
            </div>

            <!-- Complaints Section -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-3">Customer Complaints</h2>
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 p-2">Customer</th>
                            <th class="border border-gray-300 p-2">Phone</th>
                            <th class="border border-gray-300 p-2">Complaint</th>
                            <th class="border border-gray-300 p-2">Action</th>
                        </tr>
                    </thead>
                    <tbody id="complaintTableBody">
                        <!-- Complaints will be inserted here dynamically -->
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const reservations = [
                { customer: "Rahim", phone: "01711111111", table: 5, people: 4, time: "7:00 PM", status: "Pending" },
                { customer: "Karim", phone: "01722222222", table: 3, people: 2, time: "8:30 PM", status: "Pending" },
                { customer: "Fatema", phone: "01733333333", table: 7, people: 6, time: "6:00 PM", status: "Pending" }
            ];

            const complaints = [
                { customer: "Ayesha", phone: "01744444444", description: "Cold food served." },
                { customer: "Tanvir", phone: "01755555555", description: "Late service." }
            ];

            function displayReservations() {
                const reservationTableBody = document.getElementById("reservationTableBody");
                reservationTableBody.innerHTML = "";
                
                reservations.forEach((res, index) => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td class="border border-gray-300 p-2">${res.customer}</td>
                        <td class="border border-gray-300 p-2">${res.phone}</td>
                        <td class="border border-gray-300 p-2">${res.table}</td>
                        <td class="border border-gray-300 p-2">${res.people}</td>
                        <td class="border border-gray-300 p-2">${res.time}</td>
                        <td class="border border-gray-300 p-2" id="status-${index}">${res.status}</td>
                        <td class="border border-gray-300 p-2">
                            <button onclick="acceptReservation(${index})" class="bg-green-500 text-white p-1 rounded">Accept</button>
                            <button onclick="declineReservation(${index})" class="bg-red-500 text-white p-1 rounded">Decline</button>
                        </td>
                    `;
                    reservationTableBody.appendChild(row);
                });
            }

            function displayComplaints() {
                const complaintTableBody = document.getElementById("complaintTableBody");
                complaintTableBody.innerHTML = "";
                
                complaints.forEach((comp, index) => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td class="border border-gray-300 p-2">${comp.customer}</td>
                        <td class="border border-gray-300 p-2">${comp.phone}</td>
                        <td class="border border-gray-300 p-2">${comp.description}</td>
                        <td class="border border-gray-300 p-2">
                            <button onclick="resolveComplaint(${index})" class="bg-blue-500 text-white p-1 rounded">Resolve</button>
                        </td>
                    `;
                    complaintTableBody.appendChild(row);
                });
            }

            window.acceptReservation = function (index) {
                reservations[index].status = "Accepted";
                document.getElementById(`status-${index}`).textContent = "Accepted";
            };

            window.declineReservation = function (index) {
                reservations[index].status = "Declined";
                document.getElementById(`status-${index}`).textContent = "Declined";
            };

            window.resolveComplaint = function (index) {
                complaints.splice(index, 1);
                displayComplaints();
            };

            displayReservations();
            displayComplaints();
        });
    </script>
    <script src="js/managertobutton.js"></script>
</body>
</html>
