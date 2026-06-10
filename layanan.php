<?php
require_once 'includes/db.php';
$stmt = $pdo->query("SELECT * FROM services ORDER BY id ASC");
$services = $stmt->fetchAll();
?>
<?php include 'includes/header.php'; ?>

<main class="flex-grow w-full bg-white pb-24">
    
    <!-- Hero Section Layanan -->
    <section class="w-full bg-[#f8fafc] py-20 px-6 text-center border-b border-gray-100">
        <h1 class="text-4xl md:text-5xl font-bold text-primary mb-4">Layanan Kami</h1>
        <p class="text-lg text-secondary max-w-2xl mx-auto">Solusi lengkap untuk segala kebutuhan perizinan dan pendirian badan usaha Anda.</p>
    </section>

    <!-- Services Grid -->
    <section class="max-w-7xl mx-auto px-6 py-20">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <?php foreach($services as $srv): 
                // Determine styling based on theme_color
                if ($srv['theme_color'] == 'primary') {
                    $cardBg = "bg-primary text-cream border-primary";
                    $iconBg = "bg-cream text-primary";
                    $titleColor = "text-cream font-serif";
                    $priceColor = "text-cream border-white/20";
                    $btnBg = "bg-cream text-primary hover:bg-white";
                } elseif ($srv['theme_color'] == 'cream') {
                    $cardBg = "bg-cream border-cream/80 text-gray-700";
                    $iconBg = "bg-primary text-cream";
                    $titleColor = "text-primary font-serif";
                    $priceColor = "text-primary border-primary/20";
                    $btnBg = "bg-primary text-cream hover:bg-primary/90";
                } else { // default 'white'
                    $cardBg = "bg-white border-cream text-gray-600";
                    $iconBg = "bg-primary text-cream";
                    $titleColor = "text-primary";
                    $priceColor = "text-primary border-gray-100";
                    $btnBg = "bg-primary text-cream hover:bg-primary/90";
                }
            ?>
            <div class="<?= $cardBg ?> border rounded-3xl p-8 shadow-lg hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group relative overflow-hidden flex flex-col">
                <div class="absolute top-0 right-0 w-32 h-32 bg-black/5 rounded-bl-full z-0 transition-transform group-hover:scale-110"></div>
                <div class="relative z-10 flex flex-col flex-grow">
                    <div class="w-16 h-16 <?= $iconBg ?> rounded-2xl shadow-md flex items-center justify-center text-3xl mb-6">
                        <i class="<?= htmlspecialchars($srv['icon_class']) ?>"></i>
                    </div>
                    <h3 class="text-xl font-bold <?= $titleColor ?> mb-2"><?= htmlspecialchars($srv['title']) ?></h3>
                    
                    <div class="text-3xl font-extrabold <?= $priceColor ?> mb-6 border-b pb-6 mt-4">
                        <?= htmlspecialchars($srv['price_text']) ?>
                    </div>
                    
                    <div class="flex-grow mb-8">
                        <?= $srv['content_html'] ?>
                    </div>
                    
                    <a href="https://wa.me/6288973295314" class="block w-full py-4 rounded-xl <?= $btnBg ?> font-bold text-center transition-colors mt-auto shadow-lg">Konsultasi GRATIS</a>
                </div>
            </div>
            <?php endforeach; ?>

            <?php if(empty($services)): ?>
                <div class="col-span-full text-center text-gray-500 py-12">Belum ada layanan yang ditambahkan.</div>
            <?php endif; ?>

        </div>
    </section>

</main>

<?php include 'includes/footer.php'; ?>
