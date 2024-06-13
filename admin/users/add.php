<?php
require_once __DIR__ . '/../../includes/auth.php';
checkAuth();

$pageTitle = 'Add User';
?>

<?php include __DIR__ . '/../../template/dashboard/header.php'; ?>

            <main>
                <h1>Register User</h1>
                <form action="add_user.php" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select id="role" name="role" class="form-control">
                            <option value="admin">Admin</option>
                            <option value="author">Editor</option>
                            <option value="user" selected>User</option>
                        </select>
                    </div>
                        <div class="mb-3">
                        <a href="list.php" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Add User</button>
                    </div>
                </form>
            </main>

<?php include __DIR__ . '/../../template/dashboard/footer.php'; ?>