<?php
require_once __DIR__ . '/../../includes/database.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../includes/auth.php';

checkAuth();

$pageTitle = 'Edit Profile';

$userId = $_SESSION['user_id'];
$user = getUserById($userId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $bio = $_POST['bio'];
    $avatarPath = $user['avatar'];

    // Handle avatar upload
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['avatar']['tmp_name'];
        $imageName = basename($_FILES['avatar']['name']);
        $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($imageExtension, $allowedExtensions)) {
            $avatarPath = uniqid() . '.' . $imageExtension;
            $uploadDir = __DIR__ . '/../../public/avatars/';
            move_uploaded_file($imageTmpPath, $uploadDir . $avatarPath);
        } else {
            echo "Invalid file format. Please upload an image.";
            exit();
        }
    }

    // Update user data
    $sql = "UPDATE users SET username = ?, email = ?, name = ?, bio = ?, avatar = ? WHERE users_id = ?";
    $stmt = prepare($sql);
    $stmt->bind_param('sssssi', $username, $email, $name, $bio, $avatarPath, $userId);
    $stmt->execute();
    $stmt->close();

    // Refresh the user data after updating
    $user = getUserById($userId);

    header('Location: /../admin/profile/view.php');
    exit();
}

$pageTitle = "Your Profile";
include __DIR__ . '/../../template/dashboard/header.php';
?>

        <main>
            <h1>Your Profile</h1>
            <div class="profile-view">
                <form action="edit.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="avatar" class="form-label">Avatar</label>
                        <input type="file" id="avatar" name="avatar" class="form-control" accept=".jpg, .jpeg, .png, .gif">
                        <?php if ($user['avatar']): ?>
                            <img src="/../public/avatars/<?php echo $user['avatar']; ?>" alt="Avatar" style="max-width: 100px; margin-top: 10px;" id="avatar-preview">
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="bio" class="form-label">Bio</label>
                        <textarea id="bio" name="bio" class="form-control"><?php echo htmlspecialchars($user['bio']); ?></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <a href="view.php" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </div>
                </form>
            </div>
        </main>

        <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('bio');
</script>
<?php include __DIR__ . '/../../template/dashboard/footer.php'; ?>