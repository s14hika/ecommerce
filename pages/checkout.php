<?php
include '../includes/config.php';
include '../includes/auth.php';

$user_id = $_SESSION['user_id'];
$cart_items = $conn->query("SELECT * FROM cart WHERE user_id = $user_id");

$total = 0;
while ($item = $cart_items->fetch_assoc()) {
    $product = $conn->query("SELECT * FROM products WHERE id = {$item['product_id']}")->fetch_assoc();
    $total += $item['quantity'] * $product['base_price'];
}

if ($total > 0) {
    $conn->query("INSERT INTO orders (user_id, total_amount) VALUES ($user_id, $total)");
    $order_id = $conn->insert_id;

    $cart_items->data_seek(0);
    while ($item = $cart_items->fetch_assoc()) {
        $conn->query("INSERT INTO order_items (order_id, product_id, quantity, base_price) VALUES ($order_id, {$item['product_id']}, {$item['quantity']}, {$item['quantity']} * (SELECT base_price FROM products WHERE id = {$item['product_id']}))");
    }

    $conn->query("DELETE FROM cart WHERE user_id = $user_id");
    echo "Order placed successfully!";
    header("Location: index.php");
} else {
    echo "Your cart is empty!";
}
?>
