<?php
session_start();
require '/includes/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$order_id = $_GET['order_id'];
$user_id = $_SESSION['user_id'];

// Fetch order details
$order = $conn->query("SELECT * FROM orders WHERE id = '$order_id' AND user_id = '$user_id'")->fetch_assoc();
$order_items = $conn->query("SELECT oi.*, p.name FROM order_items oi JOIN products p ON oi.product_id = p.id WHERE oi.order_id = '$order_id'");

?>

<h2>Order Confirmation</h2>
<p><strong>Order ID:</strong> <?= $order['id'] ?></p>
<p><strong>Total Amount:</strong> ₹<?= $order['total_amount'] ?></p>
<p><strong>Payment Method:</strong> <?= $order['payment_method'] ?></p>
<p><strong>Payment Status:</strong> <?= $order['payment_status'] ?></p>
<p><strong>Order Status:</strong> <?= $order['order_status'] ?></p>

<h3>Items Purchased:</h3>
<ul>
    <?php while ($item = $order_items->fetch_assoc()) { ?>
        <li><?= $item['name'] ?> (<?= $item['quantity'] ?>) - ₹<?= $item['price'] ?></li>
    <?php } ?>
</ul>

<p>Thank you for shopping with us!</p>
<a href="index.php">Continue Shopping</a>
