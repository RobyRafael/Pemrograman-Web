<?php
require_once __DIR__ . '/../includes/auth.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identifier = $_POST['identifier'];
    $password = $_POST['password'];

    $user = authenticateUser($identifier, $password);

    if ($user) {
        $_SESSION['user_id'] = $user['users_id'];
        $_SESSION['username'] = $user['username'];
        header('Location: ../public/index.php');
        exit();
    } else {
        echo 'Login failed. Invalid username or email and password combination.';
    }
} else {
    header('Location: login.php');
    exit();
}
?>
