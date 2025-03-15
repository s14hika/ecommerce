<?php
include '../includes/config.php';
include '../includes/auth.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home - E-Commerce</title>
</head>

<body>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h2>
    <a href="../process/logout.php">Logout</a>

    <h3>Available Products</h3>
    <?php
    $result = $conn->query("SELECT * FROM products WHERE stock > 0");
    while ($product = $result->fetch_assoc()) {
        echo "<div>
                <h4>{$product['name']}</h4>
                <p>{$product['description']}</p>
                <p>Price: {$product['base_price']}</p>
                <a href='add_to_cart.php?id={$product['id']}'>Add to Cart</a>
              </div><hr>";
    }
    ?>
</body>

</html>
