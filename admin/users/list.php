<?php
require_once __DIR__ . '/../../includes/database.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../includes/auth.php';

checkAuth();

$users = getAllUsers();

include __DIR__ . '/../../template/dashboard/header.php';
?>

<main>
            <h1>Users</h1>
            <a href="add.php" class="btn btn-primary mb-3">Add Admin</a>
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?php echo $user['username']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['role']; ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $user['users_id']; ?>" class="btn btn-secondary btn-sm">Edit</a>
                                <a href="delete.php?id=<?php echo $user['users_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>

<?php include __DIR__ . '/../../template/dashboard/footer.php'; ?>