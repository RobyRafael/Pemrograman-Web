<?php
require_once 'database.php';

function authenticateUser($usernameOrEmail, $password) {
    $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = prepare($sql);
    $stmt->bind_param("ss", $usernameOrEmail, $usernameOrEmail);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        return $user;
    } else {
        return null;
    }
}

function registerUser($username, $email, $password, $role, $name) {
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $sql = "INSERT INTO users (username, email, password, role, name) VALUES (?, ?, ?, ?, ?)";
    $stmt = prepare($sql);
    $stmt->bind_param("sssss", $username, $email, $hashedPassword, $role, $name);
    $stmt->execute();
    $stmt->close();
    return true;
}

function isLoggedIn() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    return isset($_SESSION['user_id']);
}

function getUserById($userId) {
    $sql = "SELECT * FROM users WHERE users_id = ?";
    $stmt = prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function getRoleById($userId) {
    $sql = "SELECT role FROM users WHERE users_id = ?";
    $stmt = prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($role);
    $stmt->fetch();
    $stmt->close();
    return $role;
}

function checkAuth() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['user_id'])) {
        header('Location: ../../template/login.php');
        exit();
    }
}

function logoutUser() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    session_unset();
    session_destroy();
    header('Location: /../template/login.php');
    exit();
}

?>
