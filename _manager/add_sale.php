<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../sql/config.php';

if (
    isset($_POST['branch']) && isset($_POST['date']) &&
    isset($_POST['itemsSold']) && isset($_POST['cashReceived']) &&
    isset($_POST['onlineTransaction'])
) {
    $branch = $_POST['branch'];
    $date = $_POST['date'];
    $itemsSold = (int) $_POST['itemsSold'];
    $cashReceived = (float) $_POST['cashReceived'];
    $onlineTransaction = (float) $_POST['onlineTransaction'];

    $stmt = $conn->prepare("INSERT INTO sales (branch_name, sale_date, items_sold, cash_received, online_transaction) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssidd", $branch, $date, $itemsSold, $cashReceived, $onlineTransaction);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Sales data inserted"]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to insert: " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Incomplete form data received."]);
}

$conn->close();
?>