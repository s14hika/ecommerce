<?php
include '../includes/config.php';
include '../includes/auth.php';

if ($_SESSION['role'] != 'admin') {
    echo "Access Denied!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h2>Admin Dashboard</h2>
    <a href="add_product.php">Add Product</a>
    <a href="manage_orders.php">Manage Orders</a>
    <a href="users.php">Manage Users</a>
    <a href="../process/logout.php">Logout</a>
</body>
</html>
