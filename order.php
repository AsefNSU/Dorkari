<?php
// order.php

$cartData = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cart"])) {
    $cartData = json_decode($_POST["cart"], true);
}

// If there's no cart data or decoding failed
if (!$cartData || !is_array($cartData)) {
    echo "<p>No cart data received.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Your Order Summary</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
        }

        .order-item {
            margin-bottom: 15px;
            padding: 10px;
            background-color: #f8f8f8;
            border-left: 5px solid #dc3545;
        }

        .order-item img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
            margin-right: 10px;
        }

        .total {
            font-weight: bold;
            font-size: 18px;
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }
    </style>
</head>

<body>

    <h2>Your Order Summary</h2>

    <?php
    $total = 0;

    foreach ($cartData as $item) {
        $name = htmlspecialchars($item['name']);
        $qty = (int) $item['quantity'];
        $price = (float) $item['price'];
        $image = htmlspecialchars($item['image']);
        $subtotal = $qty * $price;
        $total += $subtotal;

        echo '<div class="order-item">';
        echo '<div style="display: flex; align-items: center;">';
        echo '<img src="images/' . $image . '" alt="' . $name . '">';
        echo '<div>';
        echo "<strong>{$name}</strong><br>";
        echo "{$qty} × " . number_format($price, 2) . " BDT = " . number_format($subtotal, 2) . " BDT";
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    echo "<div class='total'>Total: " . number_format($total, 2) . " BDT</div>";
    ?>

    <form action="/burgerii/amarpay/index.php" method="POST" class="mt-4">
        <input type="hidden" name="amount" value="<?php echo htmlspecialchars($total); ?>">
        <button type="submit" class="btn btn-success btn-lg">Proceed to Checkout</button>
    </form>

</body>

</html>