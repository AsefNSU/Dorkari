<?php
require 'config.php';
function signupCheck()
{
    global $conn;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $first_name = trim($_POST['first_name']);
        $last_name = trim($_POST['last_name']);
        $phone = trim($_POST['phone']);
        $address = trim($_POST['address']);
        $dob = trim($_POST['dob']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_message = "Invalid email format.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $check_email = $conn->prepare("SELECT id FROM customers WHERE email = ?");
            $check_email->bind_param("s", $email);
            $check_email->execute();
            $check_email->store_result();

            if ($check_email->num_rows > 0) {
                $error_message = "Email already registered. Try logging in.";
            } else {
                $stmt = $conn->prepare("INSERT INTO customers (first_name, last_name, phone, address, dob, email, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssss", $first_name, $last_name, $phone, $address, $dob, $email, $hashed_password);

                if ($stmt->execute()) {
                    $success_message = "Signup successful! <a href='login.php'>Login here</a>";
                } else {
                    $error_message = "Error: " . $stmt->error;
                }
                $stmt->close();
            }
            $check_email->close();
        }
    }
}
?>