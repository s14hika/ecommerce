<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/login.php");
    exit();
}
?>
