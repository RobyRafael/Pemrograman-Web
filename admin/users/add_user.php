<?php
require_once __DIR__ . '/../../includes/database.php';

// Pastikan metode yang digunakan adalah POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: add.php');
    exit();
}

// Ambil data yang dikirimkan melalui metode POST
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$name = $_POST['name'];
$role = $_POST['role'];

// Hash password sebelum disimpan di database
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Query SQL untuk menambahkan pengguna baru
$sql = "INSERT INTO users (username, email, password, name, role) VALUES (?, ?, ?, ?, ?)";
$stmt = prepare($sql);
$stmt->execute([$username, $email, $hashedPassword, $name, $role]);

// Redirect ke halaman setelah penambahan pengguna berhasil
header('Location: list.php');
exit();
?>
