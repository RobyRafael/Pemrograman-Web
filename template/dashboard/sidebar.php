<?php
require_once __DIR__ . '/../../includes/auth.php';
checkAuth();
$userRole = getRoleById($_SESSION['user_id']);
?>

<div id="sidebarku" class="sidebar">
    
    <div class="sidebar-header">
        <h1><a href="/../public">Inspire Daily</a></h1>
        <button class="toggle-btn" onclick="toggleSidebar()"></button>
    </div>
    <div class="sidebar-content">
        <ul>
            <li><a href="/../public/">Home</a></li>
            <?php if ($userRole == 'author' || $userRole == 'admin'){ ?>
                <li><a href="/../admin/dashboard.php">Dashboard</a></li>
            <?php } ?>
            <li><a href="/../admin/profile/view.php">Profile</a></li>
            <?php if ($userRole == 'author' || $userRole == 'admin'): ?>
                <li><a href="/../admin/posts/list.php">Manage Posts</a></li>
            <?php endif; ?>
            <?php if ($userRole == 'admin'): ?>
                <li><a href="/../admin/categories/list.php">Manage Categories</a></li>
                <li><a href="/../admin/users/list.php">Manage Users</a></li>
            <?php endif; ?>
            <li><a href="/../template/logout.php">Logout</a></li>
        </ul>
    </div>
</div>