<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) && basename($_SERVER['PHP_SELF']) != 'login.php') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - izinnow.id</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: { primary: '#0b1933', accent: '#10b981' }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 font-sans text-gray-800 flex min-h-screen">

<?php if (isset($_SESSION['admin_logged_in'])): ?>
    <!-- Sidebar -->
    <aside class="w-64 bg-primary text-white flex flex-col hidden md:flex shrink-0">
        <div class="p-6 text-2xl font-bold border-b border-white/10 flex items-center gap-3">
            <i class="fa-solid fa-shield-halved text-accent"></i> Admin
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="index.php" class="flex items-center gap-3 px-4 py-3 rounded-lg <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'bg-white/10 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' ?> transition-colors">
                <i class="fa-solid fa-gauge-high w-5 text-center"></i> Dashboard
            </a>
            <a href="layanan.php" class="flex items-center gap-3 px-4 py-3 rounded-lg <?= basename($_SERVER['PHP_SELF']) == 'layanan.php' ? 'bg-white/10 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' ?> transition-colors">
                <i class="fa-solid fa-box-open w-5 text-center"></i> Layanan
            </a>
            <a href="instagram.php" class="flex items-center gap-3 px-4 py-3 rounded-lg <?= basename($_SERVER['PHP_SELF']) == 'instagram.php' ? 'bg-white/10 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' ?> transition-colors">
                <i class="fa-brands fa-instagram w-5 text-center"></i> Instagram
            </a>
            <a href="youtube.php" class="flex items-center gap-3 px-4 py-3 rounded-lg <?= basename($_SERVER['PHP_SELF']) == 'youtube.php' ? 'bg-white/10 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' ?> transition-colors">
                <i class="fa-brands fa-youtube w-5 text-center"></i> YouTube
            </a>
            <a href="testimoni.php" class="flex items-center gap-3 px-4 py-3 rounded-lg <?= basename($_SERVER['PHP_SELF']) == 'testimoni.php' ? 'bg-white/10 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' ?> transition-colors">
                <i class="fa-solid fa-comments w-5 text-center"></i> Testimoni
            </a>
            <a href="blog.php" class="flex items-center gap-3 px-4 py-3 rounded-lg <?= basename($_SERVER['PHP_SELF']) == 'blog.php' ? 'bg-white/10 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' ?> transition-colors">
                <i class="fa-solid fa-newspaper w-5 text-center"></i> Blog
            </a>
            <a href="../index.php" target="_blank" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-400 hover:bg-white/5 hover:text-white transition-colors mt-8">
                <i class="fa-solid fa-arrow-up-right-from-square w-5 text-center"></i> View Site
            </a>
        </nav>
        <div class="p-4 border-t border-white/10">
            <a href="logout.php" class="flex items-center gap-3 px-4 py-3 text-red-400 hover:text-red-300 transition-colors w-full">
                <i class="fa-solid fa-right-from-bracket w-5 text-center"></i> Logout
            </a>
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
        <!-- Top Header for Mobile -->
        <header class="bg-white shadow-sm px-6 py-4 flex items-center justify-between md:hidden">
            <div class="font-bold text-primary text-xl">Admin Panel</div>
            <button class="text-gray-600 focus:outline-none">
                <i class="fa-solid fa-bars text-2xl"></i>
            </button>
        </header>
        
        <!-- Content Area -->
        <main class="flex-1 overflow-y-auto p-6 md:p-10">
<?php endif; ?>
