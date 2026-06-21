<?php
require_once 'includes/db.php';
include 'includes/header.php';

// Fetch active testimonials
$stmt = $pdo->query("SELECT * FROM testimonials WHERE is_active = 1 ORDER BY id DESC LIMIT 5");
$testimonials = $stmt->fetchAll();

// Fetch instagram posts
$stmt = $pdo->query("SELECT * FROM instagram_posts ORDER BY created_at DESC LIMIT 10");
$ig_posts = $stmt->fetchAll();

// Fetch youtube posts
$stmt = $pdo->query("SELECT * FROM youtube_posts ORDER BY created_at DESC LIMIT 6");
$yt_posts = $stmt->fetchAll();
?>

<main class="flex-grow flex flex-col items-center w-full">
    
    <!-- Hero Section -->
    <section class="relative w-full pt-8 pb-16 lg:pt-12 lg:pb-24 px-6 overflow-hidden bg-gradient-to-b from-white to-cream">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            
            <!-- Left Text Content -->
            <div class="flex flex-col items-center text-center lg:items-start lg:text-left z-10 animate-[fadeRight_1s_ease-out]">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-cream text-primary font-semibold text-xs md:text-sm mb-6 border border-primary/10 shadow-sm">
                    <i class="fa-solid fa-building-shield"></i>
                    Konsultan Legalitas Bisnis
                </div>
                
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight tracking-tight text-primary mb-6">
                    Solusi Tepat <br>
                    <span class="text-primary">Legalitas Bisnis</span>
                </h1>
                
                <p class="text-lg md:text-xl text-gray-600 leading-relaxed mb-10 max-w-xl font-light">
                    Mitra profesional Anda di Lombok untuk pengurusan Pembuatan PT Perorangan, PT Perseroan, CV, Yayasan, NIB, NPWP, dan legalitas bisnis lainnya secara aman dan terpercaya.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 w-full justify-center lg:justify-start">
                    <a href="#profil" class="px-8 py-4 bg-primary text-cream text-sm md:text-base font-bold rounded-xl shadow-[0_10px_20px_-10px_rgba(11,25,51,0.5)] hover:bg-primary/90 transition-all hover:-translate-y-1">
                        Profil Perusahaan
                    </a>
                    <a href="layanan.php" class="px-8 py-4 bg-white border-2 border-cream text-primary text-sm md:text-base font-bold rounded-xl hover:border-primary hover:text-primary transition-all hover:-translate-y-1">
                        Layanan Kami
                    </a>
                </div>
            </div>

            <!-- Right Image Content -->
            <div class="relative z-10 animate-[fadeLeft_1s_ease-out] flex justify-center">
                <!-- Decorative background blob -->
                <div class="absolute inset-0 bg-gradient-to-tr from-cream to-white rounded-full blur-3xl opacity-80 scale-110"></div>
                
                <!-- Image Container -->
                <div class="relative w-full max-w-[300px] sm:max-w-sm lg:max-w-md aspect-[4/5] rounded-[2.5rem] overflow-hidden shadow-2xl border-8 border-white transform rotate-2 hover:rotate-0 transition-transform duration-500 mx-auto">
                    <img src="assets/komponen/beranda.webp" alt="Lombok Background" class="w-full h-full object-cover">
                    <!-- Overlay gradient for aesthetic -->
                    <div class="absolute inset-0 bg-gradient-to-t from-primary/30 to-transparent"></div>
                </div>
                
                <!-- Floating Badge -->
                <div class="absolute bottom-4 -left-2 sm:-left-6 lg:bottom-8 lg:-left-8 bg-white p-3 sm:p-4 rounded-2xl shadow-xl flex items-center gap-3 sm:gap-4 animate-bounce" style="animation-duration: 3s; z-index: 20;">
                    <div class="w-12 h-12 rounded-full bg-cream flex items-center justify-center text-primary text-xl">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <div>
                        <p class="font-bold text-primary">100% Legal</p>
                        <p class="text-xs text-gray-500">Terpercaya & Cepat</p>
                    </div>
                </div>
            </div>
            
        </div>
    </section>

    <!-- Company Profile Section -->
    <section id="profil" class="w-full py-24 px-6 bg-white border-t border-gray-100 relative overflow-hidden">
        <!-- Abstract Background Pattern -->
        <div class="absolute -right-40 -top-40 w-96 h-96 bg-cream rounded-full blur-3xl opacity-70 z-0"></div>
        
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16 items-center relative z-10">
            
            <div class="relative flex justify-center items-center">
                <div class="w-full max-w-md bg-white rounded-3xl p-10 shadow-[0_20px_50px_-15px_rgba(0,0,0,0.05)] border border-cream relative group">
                    <img src="assets/logo/Logo-01.webp" alt="PT RAVEXA KREASI INDONESIA" class="w-full h-auto object-contain group-hover:scale-105 transition-transform duration-500">
                </div>
            </div>

            <div class="flex flex-col">
                <p class="text-primary/70 text-sm font-bold tracking-widest uppercase mb-4">
                    TENTANG KAMI
                </p>
                <h2 class="text-3xl md:text-4xl font-bold text-primary mb-6">
                    PT RAVEXA KREASI INDONESIA
                </h2>
                <p class="text-gray-600 text-lg leading-relaxed mb-6">
                    Kami hadir sebagai solusi satu pintu untuk segala kebutuhan legalitas bisnis Anda di Lombok dan sekitarnya. Dengan tim ahli yang berpengalaman, kami berkomitmen memberikan layanan terbaik dalam pengurusan izin usaha dan pendirian badan hukum.
                </p>
                <p class="text-gray-600 text-lg leading-relaxed mb-10">
                    Visi kami adalah mempermudah para pengusaha dan investor dalam merintis dan menjalankan bisnis mereka tanpa harus pusing memikirkan urusan birokrasi dan regulasi.
                </p>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="flex items-start gap-4 p-4 rounded-2xl hover:bg-cream/50 transition-colors">
                        <div class="w-12 h-12 rounded-xl bg-cream text-primary flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-user-tie text-lg"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-primary">Tim Profesional</h4>
                            <p class="text-sm text-gray-500 mt-1">Berpengalaman di bidangnya.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 p-4 rounded-2xl hover:bg-cream/50 transition-colors">
                        <div class="w-12 h-12 rounded-xl bg-cream text-primary flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-bolt text-lg"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-primary">Proses Cepat</h4>
                            <p class="text-sm text-gray-500 mt-1">Efisien dan transparan.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 p-4 rounded-2xl hover:bg-cream/50 transition-colors">
                        <div class="w-12 h-12 rounded-xl bg-cream text-primary flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-handshake text-lg"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-primary">Terpercaya</h4>
                            <p class="text-sm text-gray-500 mt-1">Ratusan klien bergabung.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 p-4 rounded-2xl hover:bg-cream/50 transition-colors">
                        <div class="w-12 h-12 rounded-xl bg-cream text-primary flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-headset text-lg"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-primary">Dukungan Penuh</h4>
                            <p class="text-sm text-gray-500 mt-1">Konsultasi gratis kapan saja.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="w-full bg-cream py-24 px-6 relative overflow-hidden">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-primary mb-16">
                Apa kata mereka tentang <br> IZIN.co.id
            </h2>

            <div class="relative px-12 md:px-20">
                <!-- Swiper Container -->
                <div class="swiper testimonialSwiper overflow-hidden">
                    <div class="swiper-wrapper">
                        <?php foreach ($testimonials as $testi): ?>
                        <div class="swiper-slide">
                            <div class="flex flex-col md:flex-row items-center gap-12 py-8">
                                <!-- Image Side -->
                                <div class="w-full md:w-5/12 flex justify-center relative">
                                    <div class="w-64 h-64 md:w-80 md:h-80 rounded-full overflow-hidden border-8 border-white shadow-xl relative z-10">
                                        <img src="<?= htmlspecialchars($testi['image_url'] ?: 'https://ui-avatars.com/api/?name='.urlencode($testi['client_name']).'&size=512') ?>" alt="Client" class="w-full h-full object-cover">
                                    </div>
                                    <!-- Quote Icon Bubble -->
                                    <div class="absolute bottom-4 right-10 md:right-16 md:bottom-8 w-20 h-20 bg-primary rounded-full border-4 border-white flex items-center justify-center text-cream shadow-lg z-20">
                                        <i class="fa-solid fa-quote-left text-3xl"></i>
                                    </div>
                                </div>
                                
                                <!-- Content Side -->
                                <div class="w-full md:w-7/12 text-center md:text-left px-4">
                                    <p class="text-gray-700 text-lg md:text-xl leading-relaxed mb-8 font-medium">
                                        "<?= htmlspecialchars($testi['quote']) ?>"
                                    </p>
                                    <div class="uppercase font-bold tracking-wide">
                                        <span class="text-primary"><?= htmlspecialchars($testi['client_name']) ?></span>
                                        <?php if ($testi['company_name']): ?>
                                        <span class="text-primary/80">, <?= htmlspecialchars($testi['company_name']) ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        
                        <?php if(empty($testimonials)): ?>
                        <div class="swiper-slide text-center text-gray-500 py-12">Belum ada testimoni.</div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Custom Navigation -->
                <button class="swiper-button-prev-custom absolute left-0 top-1/2 -translate-y-1/2 text-primary hover:text-primary/70 transition-colors z-10 text-4xl">
                    <i class="fa-solid fa-angle-left"></i>
                </button>
                <button class="swiper-button-next-custom absolute right-0 top-1/2 -translate-y-1/2 text-primary hover:text-primary/70 transition-colors z-10 text-4xl">
                    <i class="fa-solid fa-angle-right"></i>
                </button>
            </div>
        </div>
    </section>

    <!-- Client Section -->
    <section class="w-full py-16 bg-white border-t border-gray-100 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="text-[#475569] text-xs md:text-sm font-bold tracking-[0.3em] uppercase mb-4">
                OUR CLIENTS
            </p>
            <h2 class="text-3xl md:text-4xl font-bold text-primary mb-12 font-serif">
                Client Kami
            </h2>

            <div class="swiper clientSwiper">
                <div class="swiper-wrapper items-center">
                    <?php
                    $client_dir = 'assets/client';
                    if (is_dir($client_dir)) {
                        // Scan dir and filter for common image types, focusing on webp now.
                        $files = array_diff(scandir($client_dir), array('.', '..'));
                        foreach ($files as $file) {
                            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                            if (in_array($ext, ['webp', 'png', 'jpg', 'jpeg'])) {
                                echo '<div class="swiper-slide text-center flex justify-center p-4">';
                                echo '<img src="' . htmlspecialchars($client_dir . '/' . $file) . '" alt="Client" class="max-h-16 w-auto object-contain transition-transform hover:scale-110">';
                                echo '</div>';
                            }
                        }
                    } else {
                        echo '<div class="swiper-slide text-center text-gray-500">No client images found.</div>';
                    }
                    ?></div>
            </div>
        </div>
    </section>

    <!-- Instagram Section -->
    <section class="w-full py-20 px-6 bg-white">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">Follow Kami di Instagram</h2>
            <p class="text-secondary mb-10">Dapatkan informasi terbaru seputar legalitas bisnis dan perizinan.</p>
            
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4 mb-8">
                <?php foreach($ig_posts as $post): ?>
                <a href="<?= htmlspecialchars($post['link_url']) ?>" target="_blank" class="block group relative overflow-hidden rounded-xl aspect-square bg-gray-100">
                    <img src="<?= htmlspecialchars(strpos($post['image_url'], 'http') === 0 ? $post['image_url'] : $post['image_url']) ?>" alt="Instagram Post" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <i class="fa-brands fa-instagram text-white text-3xl"></i>
                    </div>
                </a>
                <?php endforeach; ?>
                <?php if(empty($ig_posts)): ?>
                    <div class="col-span-full text-center text-gray-500 py-4">Belum ada postingan Instagram.</div>
                <?php endif; ?>
            </div>
            
            <a href="https://www.instagram.com/izinnow.id/" target="_blank" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-full font-medium hover:shadow-lg transition-shadow">
                <i class="fa-brands fa-instagram"></i> Lihat di Instagram
            </a>
        </div>
    </section>

    <!-- YouTube Section -->
    <section class="w-full py-20 px-6 bg-cream">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">Tonton Kami di YouTube</h2>
            <p class="text-secondary mb-10">Simak video edukasi dan panduan seputar legalitas bisnis.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <?php foreach($yt_posts as $post): ?>
                <div class="relative w-full overflow-hidden rounded-2xl shadow-lg bg-black aspect-video group">
                    <img src="<?= htmlspecialchars(strpos($post['image_url'], 'http') === 0 ? $post['image_url'] : $post['image_url']) ?>" alt="YouTube Thumbnail" class="w-full h-full object-cover opacity-70 group-hover:opacity-50 transition-opacity">
                    <div class="absolute inset-0 flex items-center justify-center transition-colors">
                        <i class="fa-brands fa-youtube text-red-600 text-6xl group-hover:scale-110 transition-transform shadow-sm rounded-full bg-white/10"></i>
                    </div>
                    <a href="<?= htmlspecialchars($post['link_url']) ?>" target="_blank" class="absolute inset-0 z-10"></a>
                </div>
                <?php endforeach; ?>
                <?php if(empty($yt_posts)): ?>
                    <div class="col-span-full text-center text-gray-500 py-4">Belum ada video YouTube.</div>
                <?php endif; ?>
            </div>
            
            <a href="https://www.youtube.com/@izinnow.id" target="_blank" class="inline-flex items-center gap-2 px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-full font-medium shadow-lg transition-colors">
                <i class="fa-brands fa-youtube"></i> Subscribe YouTube Kami
            </a>
        </div>
    </section>

    <!-- Map Section -->
    <section class="w-full py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            
            <!-- Left Info Column -->
            <div class="flex flex-col">
                <p class="text-primary/70 text-sm font-bold tracking-widest uppercase mb-4">
                    Alamat Kantor
                </p>
                <h2 class="text-4xl md:text-5xl font-bold text-primary mb-6 font-serif">
                    Kunjungi <span class="text-primary/80">Kami</span>
                </h2>
                <p class="text-gray-500 text-lg leading-relaxed mb-10">
                    Sachi Lombok Konsultan berlokasi strategis di Lombok untuk memberikan kemudahan akses bagi klien dan mitra. Kami siap mendukung kebutuhan legalitas, perizinan, dan pengembangan properti Anda secara profesional.
                </p>

                <div class="space-y-8">
                    <div class="flex items-start gap-5">
                        <div class="w-12 h-12 rounded-xl bg-white flex items-center justify-center shrink-0 shadow-sm">
                            <i class="fa-solid fa-location-dot text-primary text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-primary text-lg">Alamat Kantor</h4>
                            <p class="text-gray-500 text-sm mt-1 leading-relaxed">Jl. Guru Bangkol No.5a, Karang Anyar, Kec. Mataram, Kota Mataram, Nusa Tenggara Bar. 83127</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-5">
                        <div class="w-12 h-12 rounded-xl bg-white flex items-center justify-center shrink-0 shadow-sm">
                            <i class="fa-solid fa-clock text-primary text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-primary text-lg">Jam Operasional</h4>
                            <p class="text-gray-500 text-sm mt-1 leading-relaxed">Senin - Sabtu: 08.00 - 17.00 WITA</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Map Column -->
            <div class="relative w-full h-[450px] rounded-3xl overflow-hidden shadow-xl border border-gray-100 bg-white group">
                <iframe 
                    src="https://maps.google.com/maps?q=Jl.%20Guru%20Bangkol,%20Karang%20Anyar,%20Mataram&t=&z=16&ie=UTF8&iwloc=&output=embed" 
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade"
                    class="absolute inset-0">
                </iframe>
                <div class="absolute inset-0 bg-black/5 pointer-events-none group-hover:bg-transparent transition-colors"></div>
            </div>
            
        </div>
    </section>

</main>

<!-- Tailwind Custom Animations Config for this page -->
<style>
@keyframes fadeRight {
    from { opacity: 0; transform: translateX(-30px); }
    to { opacity: 1; transform: translateX(0); }
}
@keyframes fadeLeft {
    from { opacity: 0; transform: translateX(30px); }
    to { opacity: 1; transform: translateX(0); }
}
@keyframes shine {
    0% { left: -100%; }
    20% { left: 200%; }
    100% { left: 200%; }
}
</style>

<!-- Initialize Swiper -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof Swiper !== 'undefined') {
        const swiper = new Swiper('.testimonialSwiper', {
            loop: true,
            autoHeight: true,
            navigation: {
                nextEl: '.swiper-button-next-custom',
                prevEl: '.swiper-button-prev-custom',
            },
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
        });

        const clientSwiper = new Swiper('.clientSwiper', {
            loop: true,
            slidesPerView: 3,
            spaceBetween: 30,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },
            breakpoints: {
                640: { slidesPerView: 4, spaceBetween: 40 },
                1024: { slidesPerView: 6, spaceBetween: 50 },
            }
        });
    }
});
</script>

<?php include 'includes/footer.php'; ?>
