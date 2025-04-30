<?php
include 'sql/config.php';

$branch_id = $_GET['branch_id'] ?? '';

$response = [
    'total_sales' => 0,
    'total_items' => 0,
    'total_customers' => 0
];

if ($branch_id) {
    // Get total sales, total items, total customers for this branch
    $sales_query = "
        SELECT 
            SUM(o.total_price) AS total_sales,
            COUNT(o.order_id) AS total_items,
            COUNT(DISTINCT o.customer_id) AS total_customers
        FROM orders o
        JOIN customer c ON o.customer_id = c.customer_id
        JOIN staff s ON s.branch_id = '$branch_id'
        LIMIT 1
    ";

    $result = mysqli_query($conn, $sales_query);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        $response['total_sales'] = $row['total_sales'] ?? 0;
        $response['total_items'] = $row['total_items'] ?? 0;
        $response['total_customers'] = $row['total_customers'] ?? 0;
    }
}

header('Content-Type: application/json');
echo json_encode($response);
