<?php
require_once 'includes/db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $pdo->prepare("SELECT * FROM blogs WHERE id = ?");
$stmt->execute([$id]);
$blog = $stmt->fetch();

if (!$blog) {
    header("Location: blog.php");
    exit;
}

include 'includes/header.php';
?>

<main class="flex-grow w-full bg-white py-16">
    <article class="max-w-4xl mx-auto px-6">
        
        <div class="mb-10 text-center">
            <a href="blog.php" class="inline-flex items-center gap-2 text-gray-500 hover:text-primary transition-colors mb-8 font-medium">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Blog
            </a>
            
            <h1 class="text-3xl md:text-5xl font-bold text-primary mb-6 leading-tight">
                <?= htmlspecialchars($blog['title']) ?>
            </h1>
            
            <div class="flex items-center justify-center gap-4 text-gray-500 text-sm">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-calendar"></i>
                    <?= date('d F Y', strtotime($blog['created_at'])) ?>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-user"></i>
                    Admin izinnow
                </div>
            </div>
        </div>

        <?php if ($blog['image_url']): ?>
            <div class="w-full h-64 md:h-96 rounded-3xl overflow-hidden mb-12 shadow-lg">
                <img src="<?= htmlspecialchars($blog['image_url']) ?>" alt="<?= htmlspecialchars($blog['title']) ?>" class="w-full h-full object-cover">
            </div>
        <?php endif; ?>

        <div class="prose prose-lg prose-green max-w-none text-gray-700 leading-relaxed">
            <?= nl2br(htmlspecialchars($blog['content'])) ?>
        </div>
        
    </article>
</main>

<?php include 'includes/footer.php'; ?>
