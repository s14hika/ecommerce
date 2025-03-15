<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
