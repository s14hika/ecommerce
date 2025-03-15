<?php
include '../includes/config.php';

$product_id = $_GET['id'];
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

$discount_price = $product['price'] - ($product['price'] * $product['discount'] / 100);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $product['name']; ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1><?php echo $product['name']; ?></h1>
    <p><?php echo $product['description']; ?></p>
    <p>Original Price: <del>$<?php echo $product['price']; ?></del></p>
    <p>Discounted Price: <strong>$<?php echo number_format($discount_price, 2); ?></strong></p>
    <button onclick="addToCart(<?php echo $product['id']; ?>)">Add to Cart</button>
</body>
</html>
