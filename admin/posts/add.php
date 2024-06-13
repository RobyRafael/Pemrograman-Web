<?php
require_once __DIR__ . '/../../includes/database.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../includes/auth.php';

checkAuth();

$pageTitle = 'Add Post';

$categories = getAllCategories();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category_id = $_POST['category_id'];
    $slug = slugify($title);
    $status = $_POST['status'];
    $featured_image = '';

    // Handle image upload
    if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['featured_image']['tmp_name'];
        $imageName = basename($_FILES['featured_image']['name']);
        $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($imageExtension, $allowedExtensions)) {
            $featured_image = uniqid() . '.' . $imageExtension;
            $uploadDir = __DIR__ . '/../../public/uploads/';
            move_uploaded_file($imageTmpPath, $uploadDir . $featured_image);
        } else {
            echo "Invalid file format. Please upload an image.";
            exit();
        }
    }

    $sql = "INSERT INTO posts (title, content, slug, user_id, status, featured_image) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = prepare($sql);
    $stmt->bind_param('sssiss', $title, $content, $slug, $_SESSION['user_id'], $status, $featured_image);
    $stmt->execute();
    $postId = $stmt->insert_id;
    $stmt->close();

    // Insert post categories
    foreach ($category_id as $catId) {
        $sql = "INSERT INTO post_categories (post_id, category_id) VALUES (?, ?)";
        $stmt = prepare($sql);
        $stmt->bind_param('ii', $postId, $catId);
        $stmt->execute();
        $stmt->close();
    }

    header('Location: list.php');
    exit();
}

include __DIR__ . '/../../template/dashboard/header.php';
?>

            <main>
                <h1>Create New Post</h1>
                <form action="add.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" id="title" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="featured_image" class="form-label">Featured Image</label>
                        <input type="file" id="featured_image" name="featured_image" class="form-control" accept=".jpg, .jpeg, .png, .gif">
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea id="content" name="content" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select id="category_id" name="category_id[]" class="form-select" required>
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?php echo $category['categories_id']; ?>"><?php echo $category['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" name="status" class="form-select">
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                            <option value="archived">Archived</option>
                        </select>
                    </div>
                    <div>
                        <a href="list.php" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Create Post</button>
                    </div>
                </form>
            </main>
            <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content');
</script>
<?php include __DIR__ . '/../../template/dashboard/footer.php'; ?>