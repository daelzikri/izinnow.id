<?php
require_once '../includes/db.php';

// Handle Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM testimonials WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: testimoni.php?msg=deleted");
    exit;
}

// Handle Add/Edit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $client_name = $_POST['client_name'];
    $company_name = $_POST['company_name'];
    $quote = $_POST['quote'];
    $image_url = $_POST['image_url'];
    $video_url = $_POST['video_url'] ?? '';
    $is_active = isset($_POST['is_active']) ? 1 : 0;

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        // Update
        $id = (int)$_POST['id'];
        $stmt = $pdo->prepare("UPDATE testimonials SET client_name=?, company_name=?, quote=?, image_url=?, video_url=?, is_active=? WHERE id=?");
        $stmt->execute([$client_name, $company_name, $quote, $image_url, $video_url, $is_active, $id]);
        header("Location: testimoni.php?msg=updated");
    } else {
        // Insert
        $stmt = $pdo->prepare("INSERT INTO testimonials (client_name, company_name, quote, image_url, video_url, is_active) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$client_name, $company_name, $quote, $image_url, $video_url, $is_active]);
        header("Location: testimoni.php?msg=added");
    }
    exit;
}

include 'includes/header.php';

// Fetch all testimonials
$stmt = $pdo->query("SELECT * FROM testimonials ORDER BY id DESC");
$testimonials = $stmt->fetchAll();

// Edit Mode
$editData = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM testimonials WHERE id = ?");
    $stmt->execute([(int)$_GET['edit']]);
    $editData = $stmt->fetch();
}
?>

<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Manajemen Testimoni</h1>
        <p class="text-gray-500 mt-1">Kelola ulasan klien yang tampil di halaman Beranda.</p>
    </div>
    <?php if ($editData): ?>
        <a href="testimoni.php" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
            <i class="fa-solid fa-plus mr-2"></i> Tambah Baru
        </a>
    <?php endif; ?>
</div>

<?php if (isset($_GET['msg'])): ?>
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6 relative">
        Data berhasil <?= $_GET['msg'] == 'deleted' ? 'dihapus' : ($_GET['msg'] == 'updated' ? 'diperbarui' : 'ditambahkan') ?>!
    </div>
<?php endif; ?>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Form Area -->
    <div class="lg:col-span-1 bg-white rounded-xl shadow-sm border border-gray-100 p-6 self-start sticky top-6">
        <h2 class="text-xl font-bold text-gray-900 mb-6"><?= $editData ? 'Edit Testimoni' : 'Tambah Testimoni Baru' ?></h2>
        
        <form action="testimoni.php" method="POST" class="space-y-4">
            <?php if ($editData): ?>
                <input type="hidden" name="id" value="<?= $editData['id'] ?>">
            <?php endif; ?>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Klien *</label>
                <input type="text" name="client_name" required value="<?= htmlspecialchars($editData['client_name'] ?? '') ?>" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-accent focus:border-accent">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Perusahaan</label>
                <input type="text" name="company_name" value="<?= htmlspecialchars($editData['company_name'] ?? '') ?>" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-accent focus:border-accent">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Isi Kutipan / Quote *</label>
                <textarea name="quote" required rows="4" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-accent focus:border-accent"><?= htmlspecialchars($editData['quote'] ?? '') ?></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">URL Foto (Image URL)</label>
                <input type="url" name="image_url" placeholder="https://..." value="<?= htmlspecialchars($editData['image_url'] ?? '') ?>" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-accent focus:border-accent">
                <p class="text-xs text-gray-500 mt-1">Gunakan link gambar (JPG/PNG). Kosongkan untuk menggunakan avatar bawaan.</p>
            </div>

            <div class="flex items-center mt-4">
                <input type="checkbox" name="is_active" id="is_active" value="1" <?= (!$editData || $editData['is_active']) ? 'checked' : '' ?> class="h-4 w-4 text-accent border-gray-300 rounded focus:ring-accent">
                <label for="is_active" class="ml-2 block text-sm text-gray-900">Tampilkan di Halaman Depan</label>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-primary text-white font-medium py-2.5 rounded-lg hover:bg-opacity-90 transition-colors">
                    <?= $editData ? 'Simpan Perubahan' : 'Simpan Testimoni' ?>
                </button>
            </div>
        </form>
    </div>

    <!-- Data List Area -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="py-3 px-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Klien</th>
                            <th class="py-3 px-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Quote</th>
                            <th class="py-3 px-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                            <th class="py-3 px-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php foreach ($testimonials as $t): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 align-top">
                                    <div class="font-medium text-gray-900"><?= htmlspecialchars($t['client_name']) ?></div>
                                    <div class="text-sm text-gray-500"><?= htmlspecialchars($t['company_name']) ?></div>
                                </td>
                                <td class="py-3 px-4 align-top max-w-xs">
                                    <p class="text-sm text-gray-600 line-clamp-2" title="<?= htmlspecialchars($t['quote']) ?>">
                                        <?= htmlspecialchars($t['quote']) ?>
                                    </p>
                                </td>
                                <td class="py-3 px-4 align-top">
                                    <?php if ($t['is_active']): ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Nonaktif</span>
                                    <?php endif; ?>
                                </td>
                                <td class="py-3 px-4 align-top text-right whitespace-nowrap">
                                    <a href="testimoni.php?edit=<?= $t['id'] ?>" class="text-blue-600 hover:text-blue-900 mr-3" title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="testimoni.php?delete=<?= $t['id'] ?>" onclick="return confirm('Yakin ingin menghapus testimoni ini?');" class="text-red-600 hover:text-red-900" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        
                        <?php if (empty($testimonials)): ?>
                            <tr>
                                <td colspan="4" class="py-8 text-center text-gray-500">Belum ada data testimoni.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
