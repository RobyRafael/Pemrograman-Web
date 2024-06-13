<?php
require_once __DIR__ . '/../../includes/database.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../includes/auth.php';

checkAuth();

$pageTitle = 'Manage Posts';

// Periksa apakah pengguna masuk
if (!isLoggedIn()) {
    redirect('/../template/login.php');
}

$user = getUserById($_SESSION['user_id']);

// Ambil semua postingan jika pengguna adalah admin, atau hanya postingan yang dibuat oleh pengguna jika dia adalah author
$posts = ($user['role'] === 'admin') ? getAllPosts() : getPostsByUserId($user['users_id']);

include __DIR__ . '/../../template/dashboard/header.php';
?>

<main>
    <h1>Manage Posts</h1>
            <a href="add.php" class="btn btn-primary mb-3">Create New Post</a>
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Title</th>
                        <?php if ($user['role'] === 'admin') : ?>
                            <th>Author</th>
                        <?php endif; ?>
                        <th>Created At</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($posts as $post) : ?>
                        <tr>
                            <td><?php echo $post['title']; ?></td>
                            <?php if ($user['role'] === 'admin') : ?>
                                <td><?php echo getUserById($post['user_id'])['username']; ?></td>
                            <?php endif; ?>
                            <td><?php echo $post['created_at']; ?></td>
                            <td><?php echo $post['status']; ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $post['posts_id']; ?>" class="btn btn-secondary">Edit</a>
                                <a href="delete.php?id=<?php echo $post['posts_id']; ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
</main>
<?php include __DIR__ . '/../../template/dashboard/footer.php'; ?>