<?php
include 'sql/config.php';

$branch_id = $_GET['branch_id'];

$query = "DELETE FROM branch WHERE branch_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $branch_id);

if ($stmt->execute()) {
    echo "Branch deleted successfully!";
} else {
    echo "Error deleting branch.";
}

$stmt->close();
$conn->close();
