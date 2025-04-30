<?php
header('Content-Type: application/json');
require_once '../sql/config.php';

$branch = $_GET['branch'] ?? '';
$filter = $_GET['filter'] ?? 'day';

$conn = new mysqli("localhost", "root", "", "burgerii");

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "DB connection failed"]);
    exit;
}

$where = "branch_name = ?";
$dateCondition = "";
$groupBy = "";
$select = "";

if ($filter === "week") {
    $select = "
        CONCAT(
            'Week ', WEEK(sale_date, 1), ' (',
            MIN(DATE(sale_date)), ' to ', MAX(DATE(sale_date)), ')'
        ) AS period,
        SUM(items_sold) AS total_items,
        SUM(cash_received) AS total_cash,
        SUM(online_transaction) AS total_online
    ";
    $groupBy = "GROUP BY YEAR(sale_date), WEEK(sale_date, 1)";
} elseif ($filter === "month") {
    $select = "DATE_FORMAT(sale_date, '%Y-%m') AS period, SUM(items_sold) AS total_items, SUM(cash_received) AS total_cash, SUM(online_transaction) AS total_online";
    $groupBy = "GROUP BY DATE_FORMAT(sale_date, '%Y-%m')";
} else {
    // Default: daily
    $select = "sale_date, items_sold, cash_received, online_transaction";
}

$query = "SELECT $select FROM sales WHERE $where $groupBy ORDER BY sale_date DESC";

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $branch);
$stmt->execute();

$result = $stmt->get_result();
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
$conn->close();
