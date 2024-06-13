<?php
require_once __DIR__ . '/../includes/database.php';
require_once __DIR__ . '/../includes/functions.php';

// Periksa apakah parameter slug postingan ada dalam URL
if (!isset($_GET['slug'])) {
    die('Slug not provided');
}

$slug = $_GET['slug'];
$post = getPostBySlug($slug);

$pageTitle = $post['title'];
?>

<?php include __DIR__ . '/../template/header.php'; ?>

    <div class="post">
        <h3><?php echo $post['title']; ?></h3>
        <img src="uploads/<?php echo $post['featured_image']; ?>" alt="<?php echo $post['title']; ?>">
        <p>Published on: <?php echo $post['created_at']; ?></p>
        <p>By: <?php echo getUserById($post['user_id'])['username']; ?></p>
        <br>
        <p><?php echo $post['content']; ?></p>
    </div>

<?php include __DIR__ . '/../template/footer.php'; ?>
