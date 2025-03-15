<?php include '../includes/config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register - E-Commerce</title>
</head>
<body>
    <h2>Register</h2>
    <form action="../process/register_user.php" method="POST">
        <label>Name:</label>
        <input type="text" name="name" required><br>

        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Register</button>
    </form>
    <a href="login.php">Already have an account? Login</a>
</body>
</html>
