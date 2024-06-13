<?php
require_once __DIR__ . '/../../includes/database.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../includes/auth.php';

checkAuth();

$pageTitle = 'Delete Post';

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Hapus postingan dari tabel `posts`
    $sql = "DELETE FROM posts WHERE posts_id = ?";
    $stmt = prepare($sql);
    $stmt->bind_param('i', $postId);
    $stmt->execute();

    // Hapus kategori postingan dari tabel `post_categories`
    $sql = "DELETE FROM post_categories WHERE post_id = ?";
    $stmt = prepare($sql);
    $stmt->bind_param('i', $postId);
    $stmt->execute();

    header('Location: list.php');
    exit();
}

include __DIR__ . '/../../template/dashboard/header.php';
?>

            <main>
                <h1>Delete Post</h1>
                <p>Are you sure you want to delete the post "<?php echo $post['title']; ?>"?</p>
                <form action="delete.php?id=<?php echo $postId; ?>" method="post">
                    <div class="mb-3">
                        <a href="list.php" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </main>

<?php include __DIR__ . '/../../template/dashboard/footer.php'; ?>

