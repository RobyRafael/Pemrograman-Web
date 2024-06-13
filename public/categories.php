<?php
require_once __DIR__ . '/../includes/database.php';
require_once __DIR__ . '/../includes/functions.php';
// Ambil semua kategori utama
$categories = getAllParentCategories();
$pageTitle = 'Daftar Kategori';
?>
<?php include __DIR__ . '/../template/header.php'; ?>
    
    <h1>Daftar Kategori</h1>
    <div class="posts">
    <div class="categories">
        <?php if (!empty($categories)) : ?>
            <ul class="parent-categories">
                <?php foreach ($categories as $category) : ?>
                    <li>
                        <h3><a href="single-category.php?slug=<?php echo $category['slug']; ?>"><?php echo $category['name']; ?></a></h3>
                        <?php
                        $subCategories = getSubCategories($category['categories_id']);
                        if (!empty($subCategories)) : ?>
                            <ul class="sub-categories">
                                <?php foreach ($subCategories as $subCategory) : ?>
                                    <li><a href="single-category.php?slug=<?php echo $subCategory['slug']; ?>"><?php echo "~".$subCategory['name']; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>Belum ada kategori</p>
        <?php endif; ?>
    </div>
    </div>
    
<?php include __DIR__ . '/../template/footer.php'; ?>