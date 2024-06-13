<?php
require_once __DIR__ . '/../includes/auth.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role']; // Menyimpan peran yang dipilih oleh pengguna
    $name = $_POST['name']; // Menyimpan nama pengguna

    // Register the user
    if (registerUser($username, $email, $password, $role, $name)) {
        // Redirect to login page after successful registration
        header('Location: login.php');
        exit();
    } else {
        echo 'Failed to register user. Please try again.';
    }
}
?>
