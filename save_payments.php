<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "traveldb"; 

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$payment_method = $_POST['payment_method'] ?? null;
$amount = $_POST['amount'] ?? null;
$currency = $_POST['currency'] ?? null;
$card_number = $_POST['card_number'] ?? null;
$card_holder_name = $_POST['card_holder_name'] ?? null;
$expiry_date = $_POST['expiry_date'] ?? null;
$cvv = $_POST['cvv'] ?? null;
$upi_id = $_POST['upi_id'] ?? null;
$bank_name = $_POST['bank_name'] ?? null;


if (!$payment_method || !$amount || !$currency) {
    echo "Error: Missing required fields.";
    exit;
}


if (!is_numeric($amount) || $amount <= 0) {
    echo "Error: Invalid amount.";
    exit;
}


$stmt = $conn->prepare("INSERT INTO payments (payment_method, amount, currency, card_number, card_holder_name, expiry_date, cvv, upi_id, bank_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
if (!$stmt) {
    echo "Error: " . $conn->error;
    exit;
}

$stmt->bind_param("sdsssssss", $payment_method, $amount, $currency, $card_number, $card_holder_name, $expiry_date, $cvv, $upi_id, $bank_name);

if ($stmt->execute()) {
    echo "Payment details saved successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
