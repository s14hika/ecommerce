<?php
include '../includes/config.php';
include '../includes/auth.php';

if (!isset($_SESSION['user_id'])) {
    die("User is not logged in!");
}

$user_id = $_SESSION['user_id'];

$cart_items = $conn->query("SELECT c.*, p.name, p.base_price 
                            FROM cart c 
                            JOIN products p ON c.product_id = p.id 
                            WHERE c.user_id = $user_id");

if (!$cart_items) {
    die("Query Failed: " . $conn->error);
}

$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Checkout</title>
</head>
<body>
    <h2>Checkout</h2>

    <?php if ($cart_items->num_rows > 0): ?>
        <?php while ($item = $cart_items->fetch_assoc()): ?>
            <p>
                <?php echo $item['name']; ?> (<?php echo $item['quantity']; ?>) - ₹<?php echo $item['base_price']; ?>
            </p>
            <?php $total += $item['quantity'] * $item['base_price']; ?>
        <?php endwhile; ?>
        
        <p><strong>Total: ₹<?php echo $total; ?></strong></p>

        <h2>Choose Payment Method</h2>
<form action="confirm_order.php" method="POST">
    <input type="hidden" name="total_amount" value="<?= $total; ?>">

    <label>
        <input type="radio" name="payment_method" value="COD" required> Cash on Delivery
    </label><br>

    <label>
        <input type="radio" name="payment_method" value="PhonePe" required> PhonePe
    </label><br>

    <label>
        <input type="radio" name="payment_method" value="GooglePay" required> Google Pay
    </label><br>

    <label>
        <input type="radio" name="payment_method" value="Razorpay" required> Razorpay
    </label><br>

    <label>
        <input type="radio" name="payment_method" value="PayPal" required> PayPal
    </label><br>

    <button type="submit">Confirm Order</button>
</form>

    <?php else: ?>
        <p>Your cart is empty!</p>
    <?php endif; ?>
</body>
</html>
