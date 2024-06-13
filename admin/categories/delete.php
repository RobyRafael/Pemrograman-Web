<?php
require_once __DIR__ . '/../../includes/database.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../includes/auth.php';

checkAuth();

$pageTitle = 'Delete Category';

if (!isset($_GET['id'])) {
    header('Location: categories.php');
    exit();
}

$categoryId = $_GET['id'];

// Periksa apakah kategori yang akan dihapus ada
$category = getCategoryById($categoryId);
if (!$category) {
    header('Location: categories.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Set parent_id kategori terkait ke null
    $sql = "UPDATE categories SET parent_id = NULL WHERE parent_id = ?";
    $stmt = prepare($sql);
    $stmt->bind_param('i', $categoryId);
    $stmt->execute();
    $stmt->close();

    // Hapus kategori dari database
    $sql = "DELETE FROM categories WHERE categories_id = ?";
    $stmt = prepare($sql);
    $stmt->bind_param('i', $categoryId);
    $stmt->execute();
    $stmt->close();

    header('Location: list.php');
    exit();
}

include __DIR__ . '/../../template/dashboard/header.php';
?>

<main>
<h1>Delete Category</h1>
            <p>Are you sure you want to delete the category "<?php echo $category['name']; ?>"?</p>
            <form action="delete.php?id=<?php echo $categoryId; ?>" method="post">
                <div class="mb-3">
                    <a href="list.php" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
</main>

<?php include __DIR__ . '/../../template/dashboard/footer.php'; ?>