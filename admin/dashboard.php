<?php
require_once __DIR__ . '/../includes/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';

if (!isLoggedIn()) {
    redirect('/../template/login.php');
}

$user = getUserById($_SESSION['user_id']);
$role = getRoleById($_SESSION['user_id']);
$pageTitle = "Dashboard";


include __DIR__ . '/../template/dashboard/header.php';?>


<main>
    <h1><?php echo $role == 'admin' ? 'Admin Dashboard' : 'Author Dashboard'; ?></h1>
        <p>Welcome, <?php echo $user['username']; ?>!</p>
        <div class="user-stats">
            <h2>Statistics</h2>
            <ul>
                <li>Total Posts: <?php echo getTotalPosts(); ?></li>
                <li>Total Categories: <?php echo getTotalCategories(); ?></li>
                <li>Total Users: <?php echo getTotalUsers(); ?></li>
            </ul>
        </div>
</main>
        

<?php include __DIR__ . '/../template/dashboard/footer.php'; ?>