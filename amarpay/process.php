<?php
require '../config.php'; // Update this path to point to your DB config if needed
session_start();

if (!isset($_POST['cus_name'])) {
  echo "Direct access restricted";
  exit();
}

// Gather customer and payment info
$fullName = $_POST['cus_name'];
$phone_number = $_POST['cus_phone'];
$currency = $_POST['currency'];
$amount = $_POST['amount'];
//$menu_id = $_POST['menu_id'];
$menu_id = 1; 
$customer_id = $_SESSION["user_id"]; 
$delivery_address = "House 258, Bashundhara R/A"; 
$payment_method = "AmarPay";

// Prepare order values
$order_date = date("Y-m-d H:i:s");
$status = "completed";
$payment_status = "paid";
$branch_id = 1;

// Insert into orders table
$stmt = $conn->prepare("INSERT INTO orders (customer_id, order_date, total_price, delivery_address, status, payment_status, branch_id, menu_id, payment_method) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isdssssss", $customer_id, $order_date, $amount, $delivery_address, $status, $payment_status, $branch_id, $menu_id, $payment_method);

if ($stmt->execute()) {
  // Proceed with payment API call, but always redirect to success.php
  header("Location: success.php");
  exit();
} else {
  echo "Database error: " . $stmt->error;
}
$stmt->close();
$conn->close();

// Optionally still call AmarPay API (mocked here but not redirecting to them)
$url = 'https://sandbox.aamarpay.com/jsonpost.php';

$payload = json_encode([
  "store_id" => $store_id,
  "tran_id" => $tran_id,
  "success_url" => "http://localhost:3000/success.php",
  "fail_url" => "http://localhost:3000/fail.php",
  "cancel_url" => "http://localhost:3000/index.php",
  "amount" => $amount,
  "currency" => $currency,
  "signature_key" => $signature_key,
  "desc" => "Merchant Registration Payment",
  "cus_name" => $fullName,
  "cus_email" => $email,
  "cus_add1" => "House 258",
  "cus_add2" => "Bashundhara R/A",
  "cus_city" => "Dhaka",
  "cus_state" => "Dhaka",
  "cus_postcode" => "1229",
  "cus_country" => "Bangladesh",
  "cus_phone" => $phone_number,
  "type" => "json"
]);

$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $payload,
  CURLOPT_HTTPHEADER => ['Content-Type: application/json']
]);

$response = curl_exec($curl);
curl_close($curl);

// Redirect to success.php regardless of response
header("Location: http://localhost:3000/success.php?transaction_id=" . $tran_id);
exit();
?>