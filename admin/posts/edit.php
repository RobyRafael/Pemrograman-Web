<?php
require_once __DIR__ . '/../../includes/database.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../includes/auth.php';

checkAuth();

$pageTitle = 'Edit Post';

if (!isset($_GET['id'])) {
    header('Location: posts.php');
    exit();
}

$postId = $_GET['id'];
$post = getPostById($postId);
if (!$post) {
    header('Location: posts.php');
    exit();
}

$categories = getAllCategories();
$postCategories = array_column(getCategoriesByPostId($postId), 'category_id');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category_id = $_POST['category_id'];
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
    $status = $_POST['status'];
    $featured_image = $post['featured_image'];

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

    $sql = "UPDATE posts SET title = ?, content = ?, slug = ?, status = ?, featured_image = ? WHERE posts_id = ?";
    $stmt = prepare($sql);
    $stmt->bind_param('sssssi', $title, $content, $slug, $status, $featured_image, $postId);
    $stmt->execute();

    // Update post_categories
    $sql = "DELETE FROM post_categories WHERE post_id = ?";
    $stmt = prepare($sql);
    $stmt->bind_param('i', $postId);
    $stmt->execute();

    $sql = "INSERT INTO post_categories (post_id, category_id) VALUES (?, ?)";
    $stmt = prepare($sql);
    $stmt->bind_param('ii', $postId, $category_id);
    $stmt->execute();

    header('Location: list.php');
    exit();
}

include __DIR__ . '/../../template/dashboard/header.php';
?>


            <main>
                <h1>Edit Post</h1>
                <form action="edit.php?id=<?php echo $postId; ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" id="title" name="title" class="form-control" value="<?php echo $post['title']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="featured_image" class="form-label">Featured Image</label>
                        <input type="file" id="featured_image" name="featured_image" class="form-control" accept=".jpg, .jpeg, .png, .gif">
                        <?php if ($post['featured_image']) : ?>
                            <img src="/../public/uploads/<?php echo $post['featured_image']; ?>" alt="Featured Image" style="max-width: 200px; margin-top: 10px;">
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <!-- Convert textarea into CKEditor -->
                        <textarea id="content" name="content" class="form-control" required><?php echo $post['content']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select id="category_id" name="category_id" class="form-select" required>
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?php echo $category['categories_id']; ?>" <?php echo in_array($category['categories_id'], $postCategories) ? 'selected' : ''; ?>><?php echo $category['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" name="status" class="form-select">
                            <option value="draft" <?php echo $post['status'] === 'Draft' ? 'selected' : ''; ?>>Draft</option>
                            <option value="published" <?php echo $post['status'] === 'Published' ? 'selected' : ''; ?>>Published</option>
                            <option value="archived" <?php echo $post['status'] === 'Archived' ? 'selected' : ''; ?>>Archived</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <a href="list.php" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Post</button>
                    </div>
                </form>
            </main>
            <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content');
</script>
<?php include __DIR__ . '/../../template/dashboard/footer.php'; ?>
