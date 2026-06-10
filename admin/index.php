<?php
require_once '../includes/db.php';
include 'includes/header.php';

// Fetch stats
$stmt = $pdo->query("SELECT COUNT(*) FROM testimonials");
$testi_count = $stmt->fetchColumn();

$stmt = $pdo->query("SELECT COUNT(*) FROM blogs");
$blog_count = $stmt->fetchColumn();
?>

<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
    <p class="text-gray-500 mt-1">Selamat datang kembali, <?= htmlspecialchars($_SESSION['admin_username']) ?>!</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <!-- Stat Card 1 -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center gap-4">
        <div class="w-14 h-14 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-2xl">
            <i class="fa-solid fa-comments"></i>
        </div>
        <div>
            <div class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Testimoni</div>
            <div class="text-3xl font-bold text-gray-900"><?= $testi_count ?></div>
        </div>
    </div>

    <!-- Stat Card 2 -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center gap-4">
        <div class="w-14 h-14 rounded-full bg-green-100 text-green-600 flex items-center justify-center text-2xl">
            <i class="fa-solid fa-newspaper"></i>
        </div>
        <div>
            <div class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Blog Post</div>
            <div class="text-3xl font-bold text-gray-900"><?= $blog_count ?></div>
        </div>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    <h2 class="text-xl font-bold text-gray-900 mb-4">Informasi Sistem</h2>
    <p class="text-gray-600">Sistem manajemen konten izinnow.id berjalan normal. Anda dapat mengelola testimoni dan blog melalui menu di sidebar kiri.</p>
    
    <div class="mt-6 flex gap-4">
        <a href="testimoni.php" class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-colors">
            Kelola Testimoni <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
