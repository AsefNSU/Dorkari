<?php
include('config.php');

$name = $_POST['name'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$qty = $_POST['qty'];

// Filter out items with quantity > 0
$items = array_filter($qty, function ($q) {
    return $q > 0; });

if (count($items) == 0) {
    echo "No items selected!";
    exit;
}

// Optional: Insert order into a table like `orders`
foreach ($items as $item_id => $quantity) {
    $stmt = $conn->prepare("INSERT INTO orders (name, phone, address, item_id, quantity) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssii", $name, $phone, $address, $item_id, $quantity);
    $stmt->execute();
}

echo "✅ Order placed successfully! We'll call you soon.";
?>