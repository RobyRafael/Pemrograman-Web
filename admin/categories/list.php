<?php
require_once __DIR__ . '/../../includes/database.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../includes/auth.php';

checkAuth();

$pageTitle = 'Manage Categories';

$categories = getAllCategories();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $parent_id = isset($_POST['parent_id']) ? $_POST['parent_id'] : null;

    $sql = "INSERT INTO categories (name, parent_id) VALUES (?, ?)";
    $stmt = prepare($sql);
    $stmt->bind_param('si', $name, $parent_id);
    $stmt->execute();
    $stmt->close();

    header('Location: categories.php');
    exit();
}

include __DIR__ . '/../../template/dashboard/header.php';
?>

<main>
<h1>Manage Categories</h1>
            <a href="add.php" class="btn btn-primary">Create New Category</a>
            <table class="table table-striped table-bordered">
                <thead class ="thead-dark">
                    <tr>
                        <th>Name</th>
                        <th>Parent Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category) : ?>
                        <tr>
                            <td><?php echo $category['name']; ?></td>
                            <td><?php echo $category['parent_id'] ? getCategoryById($category['parent_id'])['name'] : 'None'; ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $category['categories_id']; ?>" class="btn btn-secondary">Edit</a>
                                <a href="delete.php?id=<?php echo $category['categories_id']; ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
</main>

<?php include __DIR__ . '/../../template/dashboard/footer.php'; ?>