<?php
require_once __DIR__ . '/../includes/database.php';
require_once __DIR__ . '/../includes/functions.php';

// Fetch posts from the database
$posts = getAllPublishedPosts();

$pageTitle = 'Beranda';
?>

<?php include __DIR__ . '/../template/header.php'; ?>


    <h1>Daftar Postingan Terbaru</h1>
    <div class="posts">
    <?php if (!empty($posts)) : ?>
        <?php foreach ($posts as $post) : ?>
            <div class="post">
                <h3><a href="single-post.php?slug=<?php echo $post['slug']; ?>"><?php echo $post['title']; ?></a></h3>
                <img src="uploads/<?php echo $post['featured_image']; ?>" alt="<?php echo $post['title']; ?>">
                <p><?php echo substr($post['content'], 0, 150); ?>...</p>
                <a href="single-post.php?slug=<?php echo $post['slug']; ?>" class="btn btn-primary">Read more</a>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>Belum ada data</p>
    <?php endif; ?>
    </div>

<?php include __DIR__ . '/../template/footer.php'; ?>
