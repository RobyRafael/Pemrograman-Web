<?php
require_once __DIR__ . '/../includes/auth.php';
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

$pageTitle = 'Register';
?>

<?php include __DIR__ . '/../template/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Register</h1>
    <form action="register_user.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="text" id="password" name="password" required>
        <br>
        <label for="name">Nama:</label> <!-- Tambahkan input untuk nama -->
        <input type="text" id="name" name="name" required>
        <br>
        <label for="role">Role:</label>
        <select id="role" name="role">
            <option value="author">Author</option>
            <option value="user" selected>User</option>
        </select>
        <br>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login here</a></p>
</body>

<?php include __DIR__ . '/../template/footer.php'; ?>
</html>
