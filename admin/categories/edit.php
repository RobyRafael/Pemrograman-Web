<?php
require_once __DIR__ . '/../../includes/database.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../includes/auth.php';

checkAuth();

$pageTitle = 'Edit Category';

if (!isset($_GET['id'])) {
    header('Location: categories.php');
    exit();
}

$categoryId = $_GET['id'];

// Periksa apakah kategori yang akan diedit ada
$category = getCategoryById($categoryId);
if (!$category) {
    header('Location: categories.php');
    exit();
}

// Ambil daftar kategori induk
$parentCategories = getParentCategories();

// Jika formulir disubmit, proses data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $parent_id = isset($_POST['parent_id']) ? ($_POST['parent_id'] === '0' ? null : $_POST['parent_id']) : null;
    $slug = slugify($name);

    // Perbarui data kategori
    $sql = "UPDATE categories SET name = ?, description = ?, slug = ?, parent_id = ? WHERE categories_id = ?";
    $stmt = prepare($sql);
    $stmt->bind_param('sssii', $name, $description, $slug, $parent_id, $categoryId);
    $stmt->execute();
    $stmt->close();

    header('Location: list.php');
    exit();
}

include __DIR__ . '/../../template/dashboard/header.php';
?>

        <main>
            <h1>Edit Category</h1>
            <form action="edit.php?id=<?php echo $categoryId; ?>" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="<?php echo $category['name']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" name="description" class="form-control"><?php echo $category['description']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="parent_id" class="form-label">Parent Category</label>
                    <select id="parent_id" name="parent_id" class="form-select">
                        <option value="0" <?php echo $category['parent_id'] === null ? 'selected' : ''; ?>>None</option>
                        <?php foreach ($parentCategories as $parentCategory) : ?>
                            <?php if ($parentCategory['categories_id'] != $categoryId) : ?>
                                <option value="<?php echo $parentCategory['categories_id']; ?>" <?php echo $parentCategory['categories_id'] == $category['parent_id'] ? 'selected' : ''; ?>><?php echo $parentCategory['name']; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <a href="list.php" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Category</button>
                </div>
            </form>
        </main>
        <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description');
</script>
<?php include __DIR__ . '/../../template/dashboard/footer.php'; ?>