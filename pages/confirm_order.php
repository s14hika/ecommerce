<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$total_amount = $_POST['total_amount'];
$payment_method = $_POST['payment_method'];

$payment_status = ($payment_method == "COD") ? "Pending" : "Completed";

// Insert order into the database
$conn->query("INSERT INTO orders (user_id, total_amount, payment_method, payment_status, order_status) VALUES ('$user_id', '$total_amount', '$payment_method', '$payment_status', 'Processing')");
$order_id = $conn->insert_id;

// Move items from cart to order_items
$cart_items = $conn->query("SELECT * FROM cart WHERE user_id = '$user_id'");
while ($item = $cart_items->fetch_assoc()) {
    $product_id = $item['product_id'];
    $quantity = $item['quantity'];
    $price = $conn->query("SELECT base_price FROM products WHERE id = '$product_id'")->fetch_assoc()['base_price'];

    $conn->query("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ('$order_id', '$product_id', '$quantity', '$price')");
}

// Clear the cart
$conn->query("DELETE FROM cart WHERE user_id = '$user_id'");

// Redirect to order confirmation page
header("Location: order_confirmation.php?order_id=$order_id");
exit();
?>
