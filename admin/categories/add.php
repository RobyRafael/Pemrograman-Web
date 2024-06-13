<?php
require_once __DIR__ . '/../../includes/database.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../includes/auth.php';

checkAuth();

$pageTitle = 'Add Category';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $parent_id = isset($_POST['parent_id']) ? $_POST['parent_id'] : null;
    $slug = slugify($name);

    $sql = "INSERT INTO categories (name, description, slug, parent_id) VALUES (?, ?, ?, ?)";
    $stmt = prepare($sql);
    $stmt->bind_param('sssi', $name, $description, $slug, $parent_id);
    $stmt->execute();
    $stmt->close();

    header('Location: list.php');
    exit();
}

$parentCategories = getParentCategories();
include __DIR__ . '/../../template/dashboard/header.php';
?>
           
           <main>
                <h1>Add Category</h1>
                <form action="add.php" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" name="description" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="parent_id" class="form-label">Parent Category</label>
                        <select id="parent_id" name="parent_id" class="form-select">
                        <option value="0" >None</option>
                            <?php foreach ($parentCategories as $parentCategory) : ?>
                                <option value="<?php echo $parentCategory['categories_id']; ?>"><?php echo $parentCategory['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <a href="list.php" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </div>
                </form>
            </main>
            <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description');
</script>
<?php include __DIR__ . '/../../template/dashboard/footer.php'; ?>