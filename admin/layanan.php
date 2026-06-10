<?php
require_once '../includes/db.php';

// Handle Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM services WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: layanan.php?msg=deleted");
    exit;
}

// Handle Add/Edit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $price_text = $_POST['price_text'];
    $icon_class = $_POST['icon_class'];
    $theme_color = $_POST['theme_color'];
    $content_html = $_POST['content_html'];

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        // Update
        $id = (int)$_POST['id'];
        $stmt = $pdo->prepare("UPDATE services SET title=?, price_text=?, icon_class=?, theme_color=?, content_html=? WHERE id=?");
        $stmt->execute([$title, $price_text, $icon_class, $theme_color, $content_html, $id]);
        header("Location: layanan.php?msg=updated");
    } else {
        // Insert
        $stmt = $pdo->prepare("INSERT INTO services (title, price_text, icon_class, theme_color, content_html) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$title, $price_text, $icon_class, $theme_color, $content_html]);
        header("Location: layanan.php?msg=added");
    }
    exit;
}

include 'includes/header.php';

// Fetch all services
$stmt = $pdo->query("SELECT * FROM services ORDER BY created_at DESC");
$services = $stmt->fetchAll();

// Edit Mode
$editData = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM services WHERE id = ?");
    $stmt->execute([(int)$_GET['edit']]);
    $editData = $stmt->fetch();
}
?>

<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Manajemen Layanan</h1>
        <p class="text-gray-500 mt-1">Kelola data paket layanan yang akan tampil di halaman Layanan.</p>
    </div>
    <?php if ($editData): ?>
        <a href="layanan.php" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
            <i class="fa-solid fa-plus mr-2"></i> Tambah Baru
        </a>
    <?php endif; ?>
</div>

<?php if (isset($_GET['msg'])): ?>
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6 relative">
        Data berhasil <?= $_GET['msg'] == 'deleted' ? 'dihapus' : ($_GET['msg'] == 'updated' ? 'diperbarui' : 'ditambahkan') ?>!
    </div>
<?php endif; ?>

<div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
    <!-- Form Area -->
    <div class="xl:col-span-1 bg-white rounded-xl shadow-sm border border-gray-100 p-6 self-start sticky top-6">
        <h2 class="text-xl font-bold text-gray-900 mb-6"><?= $editData ? 'Edit Layanan' : 'Tambah Layanan Baru' ?></h2>
        
        <form action="layanan.php" method="POST" class="space-y-4">
            <?php if ($editData): ?>
                <input type="hidden" name="id" value="<?= $editData['id'] ?>">
            <?php endif; ?>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul Layanan *</label>
                <input type="text" name="title" required placeholder="Contoh: Pendirian PT" value="<?= htmlspecialchars($editData['title'] ?? '') ?>" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-accent focus:border-accent">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Teks Harga / Promo *</label>
                <input type="text" name="price_text" required placeholder="Contoh: Rp 4.500.000" value="<?= htmlspecialchars($editData['price_text'] ?? '') ?>" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-accent focus:border-accent">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Icon (FontAwesome)</label>
                    <input type="text" name="icon_class" placeholder="fa-solid fa-city" value="<?= htmlspecialchars($editData['icon_class'] ?? 'fa-solid fa-box') ?>" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-accent focus:border-accent text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tema Warna</label>
                    <select name="theme_color" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-accent focus:border-accent text-sm">
                        <option value="white" <?= ($editData['theme_color'] ?? '') == 'white' ? 'selected' : '' ?>>Putih (Minimalis)</option>
                        <option value="primary" <?= ($editData['theme_color'] ?? '') == 'primary' ? 'selected' : '' ?>>Navy (Primary)</option>
                        <option value="cream" <?= ($editData['theme_color'] ?? '') == 'cream' ? 'selected' : '' ?>>Cream (Soft)</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Konten / Detail Layanan (HTML) *</label>
                <textarea name="content_html" required rows="8" placeholder="Tuliskan list fitur, syarat, atau bonus di sini..." class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-accent focus:border-accent text-sm font-mono"><?= htmlspecialchars($editData['content_html'] ?? '') ?></textarea>
                <p class="text-xs text-gray-500 mt-1">Gunakan tag HTML untuk styling yang lebih kompleks seperti list.</p>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-primary text-white font-medium py-2.5 rounded-lg hover:bg-opacity-90 transition-colors">
                    <?= $editData ? 'Simpan Perubahan' : 'Simpan Layanan' ?>
                </button>
            </div>
        </form>
    </div>

    <!-- Data List Area -->
    <div class="xl:col-span-2">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="py-3 px-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Judul & Tema</th>
                            <th class="py-3 px-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Harga</th>
                            <th class="py-3 px-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php foreach ($services as $srv): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 align-top">
                                    <div class="font-medium text-gray-900 flex items-center gap-2">
                                        <i class="<?= htmlspecialchars($srv['icon_class']) ?> text-gray-400"></i>
                                        <?= htmlspecialchars($srv['title']) ?>
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">Tema: <?= htmlspecialchars($srv['theme_color']) ?></div>
                                </td>
                                <td class="py-3 px-4 align-top text-sm">
                                    <?= htmlspecialchars($srv['price_text']) ?>
                                </td>
                                <td class="py-3 px-4 align-top text-right whitespace-nowrap">
                                    <a href="layanan.php?edit=<?= $srv['id'] ?>" class="text-blue-600 hover:text-blue-900 mr-3" title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="layanan.php?delete=<?= $srv['id'] ?>" onclick="return confirm('Yakin ingin menghapus layanan ini?');" class="text-red-600 hover:text-red-900" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        
                        <?php if (empty($services)): ?>
                            <tr>
                                <td colspan="3" class="py-8 text-center text-gray-500">Belum ada data layanan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
