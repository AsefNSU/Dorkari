<?php
session_start();
include('config.php');

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$action = $_REQUEST['action'] ?? '';

if ($action === 'add' && isset($_POST['id'])) {
    $id = $_POST['id'];
    if (!isset($_SESSION['cart'][$id])) {
        $result = mysqli_query($conn, "SELECT * FROM menu WHERE id = $id LIMIT 1");
        if ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['cart'][$id] = [
                'id' => $row['id'],
                'name' => $row['food_name'],
                'price' => $row['price'],
                'quantity' => 1
            ];
        }
    } else {
        $_SESSION['cart'][$id]['quantity']++;
    }
    exit;
}

if ($action === 'remove' && isset($_POST['id'])) {
    unset($_SESSION['cart'][$_POST['id']]);
    exit;
}

if ($action === 'fetch') {
    echo json_encode(array_values($_SESSION['cart']));
    exit;
}

if ($action === 'place') {
    $_SESSION['cart'] = [];
    echo "Order placed successfully!";
    exit;
}
