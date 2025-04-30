<?php
require_once '../sql/config.php';

// Handle Add Staff
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'add') {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $status = $_POST['status'];
    $date_joined = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO staff (name, position, status, date_joined) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $position, $status, $date_joined);
    $stmt->execute();
    exit;
}


// Handle Edit Staff
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'edit') {
    $staff_id = $_POST['staff_id'];
    $name = $_POST['name'];
    $position = $_POST['position'];
    $status = $_POST['status'];
    $date_joined = $_POST['date_joined'];

    $stmt = $conn->prepare("UPDATE staff SET name=?, position=?, status=?, date_joined=? WHERE staff_id=?");
    $stmt->bind_param("ssssi", $name, $position, $status, $date_joined, $staff_id);
    $stmt->execute();
    exit;
}

// Handle Delete Staff
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'delete') {
    $staff_id = $_POST['staff_id'];
    $stmt = $conn->prepare("DELETE FROM staff WHERE staff_id=?");
    $stmt->bind_param("i", $staff_id);
    $stmt->execute();
    exit;
}

// Fetch staff list
$staffList = [];
$result = $conn->query("SELECT * FROM staff");
while ($row = $result->fetch_assoc()) {
    $staffList[] = $row;
}
?>