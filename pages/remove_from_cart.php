<?php
include '../includes/config.php';
include '../includes/auth.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn->query("DELETE FROM cart WHERE id = $id");
}
header("Location: view_cart.php");
?>
