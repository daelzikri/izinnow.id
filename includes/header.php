<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>izinnow.id - Legalitas Bisnis Tanpa Ribet</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Swiper CSS (For Testimonials) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Tailwind CSS (via CDN for simplicity in PHP env without build step) -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Tailwind Configuration -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: '#0b1933',
                        cream: '#f3efe3',
                        secondary: '#4a5568',
                        light: '#fcfbf8',
                    }
                }
            }
        }
    </script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="font-sans text-primary bg-white antialiased flex flex-col min-h-screen relative overflow-x-hidden">

    <!-- Abstract Background Patterns -->
    <div class="fixed inset-0 pointer-events-none z-[-1] opacity-50" style="background-image: linear-gradient(#e2e8f0 1px, transparent 1px), linear-gradient(90deg, #e2e8f0 1px, transparent 1px); background-size: 50px 50px;"></div>
    <div class="fixed w-[600px] h-[600px] rounded-full top-[-200px] right-[-200px] z-[-1] blur-3xl opacity-60" style="background: radial-gradient(circle, rgba(11, 25, 51, 0.05) 0%, rgba(255, 255, 255, 0) 70%);"></div>

    <!-- Navigation -->
    <nav class="w-full px-6 py-4 md:px-12 md:py-6 flex justify-between items-center sticky top-0 bg-white/80 backdrop-blur-md z-50 border-b border-gray-100 transition-all duration-300">
        <a href="index.php" class="flex items-center gap-3 text-2xl font-bold tracking-tight text-primary hover:opacity-80 transition-opacity">
            <img src="assets/logo/Logo-02.webp" alt="Logo izinnow.id" class="h-10 w-auto rounded-lg object-contain">
            izinnow.id
        </a>
        
        <!-- Desktop Menu -->
        <div class="hidden md:flex items-center gap-8 font-medium text-gray-600">
            <a href="index.php" class="hover:text-primary transition-colors">Beranda</a>
            <a href="profil.php" class="hover:text-primary transition-colors">Profil</a>
            <a href="layanan.php" class="hover:text-primary transition-colors">Layanan</a>
            <a href="blog.php" class="hover:text-primary transition-colors">Blog</a>
            <a href="contact.php" class="px-5 py-2.5 bg-primary text-white rounded-full hover:bg-opacity-90 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">Contact Us</a>
        </div>

        <!-- Mobile Menu Button -->
        <button class="md:hidden text-primary text-2xl focus:outline-none">
            <i class="fa-solid fa-bars"></i>
        </button>
    </nav>
