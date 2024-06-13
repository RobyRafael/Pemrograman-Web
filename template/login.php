<?php
require_once __DIR__ . '/../includes/auth.php';
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: ../public/index.php');
    exit();
}

$pageTitle = 'Login';
?>

<?php include __DIR__ . '/../template/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Login</h1>
    <form action="authenticate.php" method="post">
        <label for="identifier">Username or Email:</label>
        <input type="text" id="identifier" name="identifier" required>
        <br>
        <label for="password">Password:</label>
        <input type="text" id="password" name="password" required>
        <br>
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="register.php">Register here</a></p>
</body>

<?php include __DIR__ . '/../template/footer.php'; ?>
</html>
