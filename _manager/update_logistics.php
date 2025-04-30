<?php
include '../sql/config.php'; // adjust path if needed

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['logistics_id'];
    $product_name = $_POST['product_name'];
    $quantity = $_POST['quantity'];
    $unit_price = $_POST['unit_price'];

    // Sanitize inputs (optional but good practice)
    $product_name = mysqli_real_escape_string($conn, $product_name);
    $quantity = intval($quantity);
    $unit_price = floatval($unit_price);

    $sql = "UPDATE logistics 
            SET product_name = '$product_name', 
                quantity = $quantity, 
                unit_price = $unit_price 
            WHERE logistics_id = $id";

    if (mysqli_query($conn, $sql)) {
        header("Location: logistics.php?updated=1");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>