<?php
require_once __DIR__ . '/../../includes/database.php';
require_once __DIR__ . '/../../includes/auth.php';

// Periksa apakah pengguna yang sedang login adalah admin
checkAuth();

// Periksa apakah ID pengguna telah disediakan
if (!isset($_GET['id'])) {
    header('Location: list.php');
    exit();
}

$userId = $_GET['id'];

// Periksa apakah pengguna yang akan diedit ada
$user = getUserById($userId);

if (!$user) {
    header('Location: list.php');
    exit();
}

// Jika formulir disubmit, proses data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $role = $_POST['role'];

    // Query SQL untuk mengupdate informasi pengguna
    $sql = "UPDATE users SET username = ?, email = ?, name = ?, role = ? WHERE users_id = ?";
    $stmt = prepare($sql);
    $stmt->bind_param('ssssi', $username, $email, $name, $role, $userId);
    $stmt->execute();

    // Redirect ke halaman setelah proses edit berhasil
    header('Location: list.php');
    exit();
}

include __DIR__ . '/../../template/dashboard/header.php';
?>
        <main>
            <h1>Edit User</h1>
            <form action="edit.php?id=<?php echo $userId; ?>" method="post">
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
                    <label for="role" class="form-label">Role</label>
                    <select id="role" name="role" class="form-select" required>
                        <option value="user" <?php echo $user['role'] === 'user' ? 'selected' : ''; ?>>User</option>
                        <option value= "author" <?php echo $user['role'] === 'author' ? 'selected' : ''; ?>>Author</option>
                        <option value="admin" <?php echo $user['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
                    </select>
                </div>
                <div class="mb-3">   
                    <a href="list.php" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update User</button>
                </div>
            </form>
        </main>

<?php include __DIR__ . '/../../template/dashboard/footer.php'; ?>