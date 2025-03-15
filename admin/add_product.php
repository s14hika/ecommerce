<?php
include '../includes/config.php';
include '../includes/auth.php';

if ($_SESSION['role'] != 'admin') {
    echo "Access Denied!";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $price = floatval($_POST['price']);
    $stock = intval($_POST['stock']);

    $query = "INSERT INTO products (name, description, price, stock) VALUES ('$name', '$description', $price, $stock)";
    if ($conn->query($query)) {
        echo "Product added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Product - Admin</title>
</head>
<body>
    <h2>Add New Product</h2>
    <form action="" method="POST">
        <label>Name:</label><br>
        <input type="text" name="name" required><br>

        <label>Description:</label><br>
        <textarea name="description" required></textarea><br>

        <label>Price:</label><br>
        <input type="number" step="0.01" name="price" required><br>

        <label>Stock:</label><br>
        <input type="number" name="stock" required><br>

        <button type="submit">Add Product</button>
    </form>
    <a href="index.php">Back to Admin Dashboard</a>
</body>
</html>
