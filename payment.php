<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['fullName'] ?? '';
    $email = $_POST['email'] ?? '';
    $method = $_POST['paymentMethod'] ?? '';
    $address = $_POST['address'] ?? '';


    echo "<h2>Payment Successful!</h2>";
    echo "<p>Thank you, <strong>$name</strong>, for your order.</p>";
    echo "<p>Payment Method: <strong>" . ucfirst($method) . "</strong></p>";
    echo "<p>Confirmation sent to: <strong>$email</strong></p>";
    echo "<p>Delivery to: <strong>$address</strong></p>";
}
?>