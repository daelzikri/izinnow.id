<?php include 'includes/header.php'; ?>

<main class="flex-grow w-full bg-white pb-24">
    
    <!-- Hero Section Contact -->
    <section class="w-full bg-[#f8fafc] py-20 px-6 text-center border-b border-gray-100">
        <h1 class="text-4xl md:text-5xl font-bold text-primary mb-4">Hubungi Kami</h1>
        <p class="text-lg text-secondary max-w-2xl mx-auto">Tim kami siap membantu Anda menjawab segala pertanyaan terkait legalitas dan perizinan bisnis.</p>
    </section>

    <!-- Contact Content -->
    <section class="max-w-7xl mx-auto px-6 py-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
            
            <!-- Contact Information & Map -->
            <div>
                <h2 class="text-3xl font-bold text-primary mb-8">Informasi Kontak</h2>
                
                <div class="space-y-6 mb-12">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-green-100 text-accent rounded-full flex items-center justify-center text-xl shrink-0">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-lg">Alamat Kantor</h4>
                            <p class="text-gray-600 leading-relaxed mt-1">Jl. Guru Bangkol No.5a, Karang Anyar, Kec. Mataram, Kota Mataram, Nusa Tenggara Bar. 83127</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-5">
                        <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xl shrink-0">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-lg">WhatsApp</h4>
                            <p class="text-gray-600 mt-1">
                                <a href="https://wa.me/6288973295314" target="_blank" class="hover:text-blue-600 transition-colors">+62 889 7329 5314</a>
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-pink-100 text-pink-600 rounded-full flex items-center justify-center text-xl shrink-0">
                            <i class="fa-brands fa-instagram"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-lg">Instagram</h4>
                            <p class="text-gray-600 mt-1">
                                <a href="https://www.instagram.com/izinnow.id/" target="_blank" class="hover:text-pink-600 transition-colors">@izinnow.id</a>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Embedded Map -->
                <div class="w-full h-[300px] rounded-3xl overflow-hidden shadow-md border border-gray-100">
                    <iframe 
                        src="https://maps.google.com/maps?q=Jl.%20Guru%20Bangkol,%20Karang%20Anyar,%20Mataram&t=&z=16&ie=UTF8&iwloc=&output=embed" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 md:p-12">
                <h3 class="text-2xl font-bold text-primary mb-6">Kirim Pesan</h3>
                <p class="text-gray-600 mb-8">Isi formulir di bawah ini dan konsultan kami akan segera menghubungi Anda kembali.</p>
                
                <form action="#" method="POST" class="space-y-6" onsubmit="event.preventDefault(); alert('Terima kasih! Pesan Anda telah terkirim (Ini adalah contoh form).');">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" required class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-accent focus:border-accent outline-none transition-shadow" placeholder="Cth: Budi Santoso">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon/WA</label>
                            <input type="tel" required class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-accent focus:border-accent outline-none transition-shadow" placeholder="Cth: 08123456789">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Layanan yang Dibutuhkan</label>
                        <select class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-accent focus:border-accent outline-none transition-shadow bg-white">
                            <option>Pendirian PT</option>
                            <option>Pendirian CV</option>
                            <option>Pendaftaran HAKI</option>
                            <option>Perizinan Khusus / OSS</option>
                            <option>Lainnya</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pesan Anda</label>
                        <textarea rows="5" required class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-accent focus:border-accent outline-none transition-shadow" placeholder="Ceritakan sedikit tentang kebutuhan bisnis Anda..."></textarea>
                    </div>

                    <button type="submit" class="w-full py-4 bg-primary hover:bg-opacity-90 text-white rounded-xl font-bold text-lg shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1">
                        Kirim Pesan Sekarang <i class="fa-solid fa-paper-plane ml-2"></i>
                    </button>
                </form>
            </div>

        </div>
    </section>

</main>

<?php include 'includes/footer.php'; ?>
