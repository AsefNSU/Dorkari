<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    echo "You must be logged in to access checkout.";
    exit;
}

$firstName = $_SESSION["first_name"];
$phone = $_SESSION["phone"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
        }

        form {
            max-width: 500px;
            margin: auto;
            background-color: #f8f8f8;
            padding: 25px;
            border-radius: 10px;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            margin: 8px 0 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #dc3545;
            color: white;
            padding: 12px;
            width: 100%;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }

        button:hover {
            background-color: #bd2f3b;
        }
    </style>
</head>

<body>

    <h2 style="text-align: center;">Checkout</h2>

    <form id="checkoutForm" method="POST">
        <label>Full Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($firstName); ?>" required>

        <label>Phone Number:</label>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>" required>

        <label>Payment Method:</label>
        <select name="payment_method" id="paymentMethod" required>
            <option value="">Select Payment Method</option>
            <option value="amar_pay">AmarPay</option>
            <option value="paypal">PayPal</option>
            <option value="card">Credit/Debit Card</option>
        </select>

        <button type="submit">Place Order</button>
    </form>

    <script>
        document.getElementById("checkoutForm").addEventListener("submit", function (e) {
            e.preventDefault();

            const form = e.target;
            const method = document.getElementById("paymentMethod").value;

            const formData = new FormData(form);

            let actionURL = "";

            if (method === "amar_pay") {
                formData.append("amount", "100"); // Replace with actual order total
                formData.append("currency", "BDT");
                formData.append("desc", "Burger Order Payment");
                formData.append("payment_type", "VISA"); // Or AMEX, BKASH etc if needed
                actionURL = "amarpay/process.php";
            }
            else if (method === "paypal") {
                actionURL = "paypal/process.php";
            } else if (method === "card") {
                actionURL = "card/process.php";
            } else {
                alert("Please select a valid payment method.");
                return;
            }

            const tempForm = document.createElement("form");
            tempForm.method = "POST";
            tempForm.action = actionURL;

            for (const [key, value] of formData.entries()) {
                const input = document.createElement("input");
                input.type = "hidden";
                input.name = key;
                input.value = value;
                tempForm.appendChild(input);
            }

            document.body.appendChild(tempForm);
            tempForm.submit();
        });
    </script>

</body>

</html>