<?php
require 'config.php';
session_start();
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
            $message = "Invalid email format.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $check_email = $conn->prepare("SELECT id FROM customers WHERE email = ?");
            $check_email->bind_param("s", $email);
            $check_email->execute();
            $check_email->store_result();

            if ($check_email->num_rows > 0) {
                $message = "Email already registered. Try logging in.";
            } else {
                $stmt = $conn->prepare("INSERT INTO customers (first_name, last_name, phone, address, dob, email, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssss", $first_name, $last_name, $phone, $address, $dob, $email, $hashed_password);
                if ($stmt->execute()) {
                    $message = "Signup successful! <a href='login.php'>Login here</a>";
                    $stmt->close();
                    return $message;
                } else {
                    $message = "Error: " . $stmt->error;
                    $stmt->close();
                    return $message;
                }
            }
            $check_email->close();
        }
    }
}

function loginCheck()
{
    global $conn;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        if (!empty($email) && !empty($password)) {
            $stmt = $conn->prepare("SELECT id, firstName, password FROM customers WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id, $firstName, $hashed_password);
                $stmt->fetch();

                if (password_verify($password, $hashed_password)) {
                    $_SESSION["user_id"] = $id;
                    $_SESSION["first_name"] = $firstName;
                    exit();
                } else {
                    $message = "Invalid email or password.";
                    return $message;
                }
            } else {
                $message = "Invalid email or password.";
                $stmt->close();
                return $message;
            }
        } else {
            $message = "Please fill in all fields.";
            return $message;
        }
    }
    $conn->close();
}
?>