<?php
include '../includes/config.php';
include '../includes/auth.php';

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
    $user_id = $_SESSION['user_id'];

    // Check if product exists
    $product = $conn->query("SELECT * FROM products WHERE id = $product_id");
    if ($product->num_rows == 0) {
        echo "Product not found!";
        exit();
    }

    // Check if product is already in the cart
    $cart_item = $conn->query("SELECT * FROM cart WHERE user_id = $user_id AND product_id = $product_id");
    if ($cart_item->num_rows == 0) {
        $conn->query("INSERT INTO cart (user_id, product_id, quantity) VALUES ($user_id, $product_id, 1)");
    } else {
        $conn->query("UPDATE cart SET quantity = quantity + 1 WHERE user_id = $user_id AND product_id = $product_id");
    }
    header("Location: view_cart.php");
}
?>
