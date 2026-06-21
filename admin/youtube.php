<?php
require_once '../includes/db.php';
require_once 'includes/upload_helper.php';

// Handle Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM youtube_posts WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: youtube.php?msg=deleted");
    exit;
}

// Handle Add/Edit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $image_url_input = $_POST['image_url'] ?? '';
    $link_url = $_POST['link_url'];

    // Process File Upload
    $uploadedPath = uploadAndConvertToWebp('image_file', '../assets/uploads/youtube/');

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        // Update
        $id = (int)$_POST['id'];
        
        if ($uploadedPath) {
            $image_url = $uploadedPath;
        } elseif (!empty($image_url_input)) {
            $image_url = $image_url_input;
        } else {
            $stmt = $pdo->prepare("SELECT image_url FROM youtube_posts WHERE id = ?");
            $stmt->execute([$id]);
            $oldData = $stmt->fetch();
            $image_url = $oldData['image_url'] ?? '';
        }

        $stmt = $pdo->prepare("UPDATE youtube_posts SET image_url=?, link_url=? WHERE id=?");
        $stmt->execute([$image_url, $link_url, $id]);
        header("Location: youtube.php?msg=updated");
    } else {
        // Insert
        $image_url = $uploadedPath ? $uploadedPath : $image_url_input;
        $stmt = $pdo->prepare("INSERT INTO youtube_posts (image_url, link_url) VALUES (?, ?)");
        $stmt->execute([$image_url, $link_url]);
        header("Location: youtube.php?msg=added");
    }
    exit;
}

include 'includes/header.php';

// Fetch all posts
$stmt = $pdo->query("SELECT * FROM youtube_posts ORDER BY created_at DESC");
$posts = $stmt->fetchAll();

// Edit Mode
$editData = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM youtube_posts WHERE id = ?");
    $stmt->execute([(int)$_GET['edit']]);
    $editData = $stmt->fetch();
}
?>

<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Manajemen YouTube</h1>
        <p class="text-gray-500 mt-1">Kelola video YouTube yang tampil di halaman Beranda.</p>
    </div>
    <?php if ($editData): ?>
        <a href="youtube.php" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
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
        <h2 class="text-xl font-bold text-gray-900 mb-6"><?= $editData ? 'Edit Video' : 'Tambah Video Baru' ?></h2>
        
        <form action="youtube.php" method="POST" enctype="multipart/form-data" class="space-y-4">
            <?php if ($editData): ?>
                <input type="hidden" name="id" value="<?= $editData['id'] ?>">
            <?php endif; ?>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Upload Gambar / Thumbnail (Opsional)</label>
                <input type="file" name="image_file" accept=".jpg,.jpeg,.png,.webp" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-accent focus:border-accent">
                <p class="text-xs text-gray-500 mt-1">Pilih gambar dari perangkat. Otomatis dikonversi ke WebP.</p>
                <?php if($editData && $editData['image_url']): ?>
                    <div class="mt-2 text-sm text-gray-500">
                        Thumbnail saat ini: <img src="<?= strpos($editData['image_url'], 'http') === 0 ? htmlspecialchars($editData['image_url']) : '../' . htmlspecialchars($editData['image_url']) ?>" class="h-10 w-auto rounded inline-block">
                    </div>
                <?php endif; ?>
            </div>

            <div class="mt-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Atau Gunakan URL Gambar / Thumbnail (Jika tidak upload)</label>
                <input type="text" name="image_url" placeholder="https://..." value="<?= htmlspecialchars($editData['image_url'] ?? '') ?>" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-accent focus:border-accent">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Link Tujuan (YouTube Video URL) *</label>
                <input type="url" name="link_url" required placeholder="https://youtube.com/watch?v=..." value="<?= htmlspecialchars($editData['link_url'] ?? '') ?>" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-accent focus:border-accent">
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-primary text-white font-medium py-2.5 rounded-lg hover:bg-opacity-90 transition-colors">
                    <?= $editData ? 'Simpan Perubahan' : 'Simpan Video' ?>
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
                            <th class="py-3 px-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Preview Thumbnail</th>
                            <th class="py-3 px-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Link YouTube</th>
                            <th class="py-3 px-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php foreach ($posts as $post): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 align-top w-40">
                                    <div class="aspect-video bg-gray-100 rounded-lg overflow-hidden relative">
                                        <img src="<?= htmlspecialchars(strpos($post['image_url'], 'http') === 0 ? $post['image_url'] : '../' . $post['image_url']) ?>" class="w-full h-full object-cover" alt="YT Thumbnail">
                                    </div>
                                </td>
                                <td class="py-3 px-4 align-top text-sm">
                                    <a href="<?= htmlspecialchars($post['link_url']) ?>" target="_blank" class="text-blue-600 hover:underline">Tonton Video <i class="fa-solid fa-external-link-alt text-xs ml-1"></i></a>
                                    <div class="text-xs text-gray-400 mt-2">Dibuat: <?= date('d M Y', strtotime($post['created_at'])) ?></div>
                                </td>
                                <td class="py-3 px-4 align-top text-right whitespace-nowrap">
                                    <a href="youtube.php?edit=<?= $post['id'] ?>" class="text-blue-600 hover:text-blue-900 mr-3" title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="youtube.php?delete=<?= $post['id'] ?>" onclick="return confirm('Yakin ingin menghapus video ini?');" class="text-red-600 hover:text-red-900" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        
                        <?php if (empty($posts)): ?>
                            <tr>
                                <td colspan="3" class="py-8 text-center text-gray-500">Belum ada data video YouTube.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
