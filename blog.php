<?php
require_once 'includes/db.php';
include 'includes/header.php';

// Fetch all blogs
$stmt = $pdo->query("SELECT * FROM blogs ORDER BY created_at DESC");
$blogs = $stmt->fetchAll();
?>

<main class="flex-grow flex flex-col items-center w-full bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-6 w-full">
        
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-bold text-primary mb-4">Blog & Artikel</h1>
            <p class="text-lg text-secondary max-w-2xl mx-auto">Temukan berbagai informasi, tips, dan panduan seputar legalitas bisnis dan perizinan usaha di Indonesia.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($blogs as $blog): ?>
                <article class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-shadow duration-300 group flex flex-col">
                    <div class="h-56 overflow-hidden bg-gray-200 relative">
                        <?php if ($blog['image_url']): ?>
                            <img src="<?= htmlspecialchars($blog['image_url']) ?>" alt="<?= htmlspecialchars($blog['title']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <i class="fa-solid fa-image text-5xl"></i>
                            </div>
                        <?php endif; ?>
                        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur text-primary text-xs font-bold px-3 py-1 rounded-full">
                            <?= date('d M Y', strtotime($blog['created_at'])) ?>
                        </div>
                    </div>
                    <div class="p-6 flex-grow flex flex-col">
                        <h2 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-accent transition-colors">
                            <a href="blog-detail.php?id=<?= $blog['id'] ?>" class="hover:underline">
                                <?= htmlspecialchars($blog['title']) ?>
                            </a>
                        </h2>
                        <p class="text-gray-600 mb-6 line-clamp-3 text-sm flex-grow">
                            <?= htmlspecialchars(strip_tags($blog['content'])) ?>
                        </p>
                        <a href="blog-detail.php?id=<?= $blog['id'] ?>" class="inline-flex items-center gap-2 text-accent font-medium hover:text-green-700 transition-colors mt-auto">
                            Baca Selengkapnya <i class="fa-solid fa-arrow-right text-sm"></i>
                        </a>
                    </div>
                </article>
            <?php endforeach; ?>

            <?php if (empty($blogs)): ?>
                <div class="col-span-full text-center py-20 bg-white rounded-2xl border border-gray-100">
                    <i class="fa-regular fa-folder-open text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-medium text-gray-600">Belum ada artikel</h3>
                    <p class="text-gray-500 mt-2">Artikel sedang dipersiapkan. Cek kembali nanti.</p>
                </div>
            <?php endif; ?>
        </div>

    </div>
</main>

<?php include 'includes/footer.php'; ?>
