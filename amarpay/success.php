<?php
session_start();
unset($_SESSION['cart']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Payment Successful</title>
    <meta http-equiv="refresh" content="10;url=../index.php">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
            text-align: center;
        }

        h2 {
            color: green;
        }

        p {
            font-size: 18px;
        }

        .timer {
            margin-top: 20px;
            font-style: italic;
            color: #555;
        }
    </style>
</head>

<body>
    <h2>Payment Successful!</h2>
    <?php if (isset($_SESSION["first_name"])): ?>
        <p>Thank you, <?= htmlspecialchars($_SESSION["first_name"]) ?>! Your order has been received.</p>
    <?php else: ?>
        <p>Thank you for your order.</p>
    <?php endif; ?>

    <p class="timer">You will be redirected to the homepage in 10 seconds...</p>
</body>

</html>
