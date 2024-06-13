<?php
require_once __DIR__ . '/../../includes/database.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../includes/auth.php';

checkAuth();

$pageTitle = 'View Profile';

$userId = $_SESSION['user_id'];
$user = getUserById($userId);

$pageTitle = "View Profile";
include __DIR__ . '/../../template/dashboard/header.php';
?>
        <main>
            <h1>Your Profile</h1>
            <div class="profile-view">
                <?php if ($user['avatar']): ?>
                    <div class="avatar">
                        <img src="/../public/avatars/<?php echo htmlspecialchars($user['avatar']); ?>" alt="Avatar" style="max-width: 150px; margin-bottom: 20px;">
                    </div>
                <?php endif; ?>
                <div class="profile-details">
                    <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
                    <p><strong>Bio:</strong> <?php echo $user['bio']; ?></p>
                </div>
                <div class="edit-profile">
                    <a href="edit.php" class="btn btn-primary">Edit Profile</a>
                    <a href="change_password.php" class="btn btn-secondary">Change Password</a>
                </div>
            </div>
        </main>

<?php include __DIR__ . '/../../template/dashboard/footer.php'; ?>