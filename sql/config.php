<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dorkarimaster";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error)
    die("Failed to connect: " . $conn->connect_error);