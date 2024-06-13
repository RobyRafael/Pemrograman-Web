<?php
require_once __DIR__ . '/database.php';

function redirect($url) {
    header("Location: $url");
    exit();
}

function getPostsByUserId($userId) {
    $sql = "SELECT * FROM posts WHERE user_id = ?";
    $stmt = prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    return $stmt->get_result();
}

function getAllPosts() {
    $sql = "SELECT * FROM posts ORDER BY created_at DESC";
    return query($sql);
}

function getPostById($postId) {
    $sql = "SELECT * FROM posts WHERE posts_id = ?";
    $stmt = prepare($sql);
    $stmt->bind_param('i', $postId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}


function getPostBySlug($slug) {
    $sql = "SELECT * FROM posts WHERE slug = ?";
    $stmt = prepare($sql);
    $stmt->bind_param('s', $slug);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}
function getPostsByCategorySlug($slug) {
    $sql = "SELECT p.* FROM posts p 
            JOIN post_categories pc ON p.posts_id = pc.post_id
            JOIN categories c ON pc.category_id = c.categories_id
            WHERE c.slug = ? AND p.status = 'published'";
    $stmt = prepare($sql);
    $stmt->bind_param('s', $slug);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getAllCategories() {
    $sql = "SELECT * FROM categories";
    $result = query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getSubCategories($parent_id) {
    $sql = "SELECT * FROM categories WHERE parent_id = ?";
    $stmt = prepare($sql);
    $stmt->bind_param('i', $parent_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getCategoryBySlug($slug) {
    $sql = "SELECT * FROM categories WHERE slug = ?";
    $stmt = prepare($sql);
    $stmt->bind_param('s', $slug);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function getAllUsers() {
    $sql = "SELECT * FROM users";
    return query($sql);
}

function getAllPublishedPosts() {
    $sql = "SELECT * FROM posts WHERE status = 'published'";
    return query($sql);
}

function getCategoryById($category_id) {
    $sql = "SELECT * FROM categories WHERE categories_id = ?";
    $stmt = prepare($sql);
    $stmt->bind_param('i', $category_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function getCategoriesByPostId($postId) {
    global $conn;
    $sql = "SELECT category_id FROM post_categories WHERE post_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $postId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function slugify($string) {
    $slug = strtolower(trim($string));
    $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
    $slug = preg_replace('/-+/', "-", $slug);
    return $slug;
}

function getAllParentCategories() {
    global $conn;
    $sql = "SELECT * FROM categories WHERE parent_id IS NULL";
    $result = $conn->query($sql);
    $categories = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
    }
    return $categories;
}

function getParentCategories() {
    $sql = "SELECT * FROM categories WHERE parent_id IS NULL";
    $result = query($sql);
    $categories = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
    }
    return $categories;
}

function getTotalPosts() {
    $sql = "SELECT COUNT(*) as count FROM posts";
    $result = query($sql);
    return $result->fetch_assoc()['count'];
}

function getTotalCategories() {
    $sql = "SELECT COUNT(*) as count FROM categories";
    $result = query($sql);
    return $result->fetch_assoc()['count'];
}

function getTotalUsers() {
    $sql = "SELECT COUNT(*) as count FROM users";
    $result = query($sql);
    return $result->fetch_assoc()['count'];
}
?>
