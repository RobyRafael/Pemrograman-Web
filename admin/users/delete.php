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

// Periksa apakah pengguna yang akan dihapus ada
$user = getUserById($userId);

if (!$user) {
    header('Location: list.php');
    exit();
}

// Jika formulir disubmit, hapus pengguna
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "DELETE FROM users WHERE users_id = ?";
    $stmt = prepare($sql);
    $stmt->bind_param('i', $userId);
    $stmt->execute();

    // Redirect ke halaman setelah pengguna berhasil dihapus
    header('Location: list.php');
    exit();
}

$pageTitle = "Delete User";
include __DIR__ . '/../../template/dashboard/header.php';
?>

        <main>
            <h1>Delete User</h1>
            <p>Are you sure you want to delete user <?php echo htmlspecialchars($user['username']); ?>?</p>
            <form action="delete.php?id=<?php echo $userId; ?>" method="post">
                <div class="mb-3">
                    <a href="list.php" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-danger">Delete User</button>
                </div>
            </form>
        </main>
<?php include __DIR__ . '/../../template/dashboard/footer.php'; ?>