<?php include '../includes/config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login - E-Commerce</title>
</head>
<body>
    <h2>Login</h2>
    <form action="../process/login_user.php" method="POST">
        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Login</button>
    </form>
    <a href="register.php">New User? Register Here</a>
</body>
</html>
