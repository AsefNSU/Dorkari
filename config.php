<?php
$servername = "localhost"; // Change if your DB is hosted elsewhere
$username = "root"; // Default XAMPP/WAMP username
$password = ""; // Default is empty for XAMPP/WAMP unless you set one
$database = "burgerii"; // Replace with your actual DB name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Optional: Uncomment this to see a success message while testing
// echo "Connected successfully";
?>
