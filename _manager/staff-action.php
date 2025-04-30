<?php
require_once '../sql/config.php';

$action = $_POST['action'] ?? '';

if ($action === 'add') {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $status = $_POST['status'];
    $date_joined = date('Y-m-d');
    $stmt = $conn->prepare("INSERT INTO staff (name, position, status, date_joined) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $position, $status, $date_joined);
    $stmt->execute();
    $stmt->close();
} elseif ($action === 'edit') {
    $staff_id = $_POST['staff_id'];
    $name = $_POST['name'];
    $position = $_POST['position'];
    $status = $_POST['status'];
    $stmt = $conn->prepare("UPDATE staff SET name=?, position=?, status=? WHERE staff_id=?");
    $stmt->bind_param("sssi", $name, $position, $status, $staff_id);
    $stmt->execute();
    $stmt->close();
} elseif ($action === 'delete') {
    $staff_id = $_POST['staff_id'];
    $stmt = $conn->prepare("DELETE FROM staff WHERE staff_id=?");
    $stmt->bind_param("i", $staff_id);
    $stmt->execute();
    $stmt->close();
}

header("Location: staffinfo.php");
exit;
