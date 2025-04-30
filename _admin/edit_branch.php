<?php
include 'sql/config.php';

$branch_id = $_POST['branch_id'];
$name = $_POST['branch_name'];
$address = $_POST['address'];
$phone = $_POST['phone_number'];
$email = $_POST['email'];

$query = "UPDATE branch 
          SET branch_name = ?, address = ?, phone_number = ?, email = ? 
          WHERE branch_id = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("ssssi", $name, $address, $phone, $email, $branch_id);

if ($stmt->execute()) {
    echo "Branch updated successfully!";
} else {
    echo "Error updating branch.";
}

$stmt->close();
$conn->close();
