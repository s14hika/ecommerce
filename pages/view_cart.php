<?php
include '../includes/config.php';
include '../includes/auth.php';

$user_id = $_SESSION['user_id'];

$cart_items = $conn->query("SELECT c.*, p.name, p.base_price FROM cart c JOIN products p ON c.product_id = p.id WHERE c.user_id = $user_id");

if (!$cart_items) {
    die("Query Failed: " . $conn->error);
}

$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Your Cart</title>
</head>
<body>
    <h2>Your Cart</h2>
    
    <?php if ($cart_items->num_rows > 0): ?>
        <?php while ($item = $cart_items->fetch_assoc()): ?>
            <p>
                <?php echo $item['name']; ?> (<?php echo $item['quantity']; ?>) - ₹<?php echo $item['base_price']; ?>
                <a href="remove_from_cart.php?id=<?php echo $item['id']; ?>">Remove</a>
            </p>
            <?php $total += $item['quantity'] * $item['base_price']; ?>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Your cart is empty!</p>
    <?php endif; ?>

    <p>Total: ₹<?php echo $total; ?></p>
    <a href="checkout.php">Checkout</a>
</body>
</html>
