<?php
require_once __DIR__ . '/../../includes/database.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../includes/auth.php';

checkAuth();

$pageTitle = 'Change Password';

$userId = $_SESSION['user_id'];
$user = getUserById($userId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if (!password_verify($currentPassword, $user['password'])) {
        $error = "Current password is incorrect.";
    } elseif ($newPassword !== $confirmPassword) {
        $error = "New passwords do not match.";
    } else {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = ? WHERE users_id = ?";
        $stmt = prepare($sql);
        $stmt->bind_param('si', $hashedPassword, $userId);
        $stmt->execute();
        $stmt->close();
        $success = "Password updated successfully.";
    }

    header('Location: /../admin/profile/view.php');
    exit();
}

$pageTitle = "Change Password";

include __DIR__ . '/../../template/dashboard/header.php';
?>

        <main>
            <h1>Change Password</h1>
            <form action="change_password.php" method="post">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                <?php if (isset($success)): ?>
                    <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
                <?php endif; ?>
                <div class="mb-3">
                    <label for="current_password" class="form-label">Current Password</label>
                    <input type="password" id="current_password" name="current_password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="new_password" class="form-label">New Password</label>
                    <input type="password" id="new_password" name="new_password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm New Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <a href="view.php" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
            </form>
        </main>
        
<?php include __DIR__ . '/../../template/dashboard/footer.php'; ?>