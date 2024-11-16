<?php
// Sertakan file functions.php
require_once(__DIR__ . '/../includes/functions.php');
require_once(__DIR__ . '/../includes/auth.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/../public/css/styles.css">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'CMS'; ?></title>
</head>
<body>
    <header>
        <h1><a href="/../public">Inspire Daily</a></h1>
        <nav>
            <ul>
                <li><a href="/../public">Home</a></li>
                <li><a href="/../public/categories.php">Categories</a></li>
                <li><a>About</a></li>
                <li><a>Contact</a></li>
                <?php if (function_exists('isLoggedIn') && isLoggedIn()): ?>
                    <li><a href="../admin/dashboard.php">Dashboard</a></li>
                    <li><a href="../template/logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="/../template/login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <div class="content">
