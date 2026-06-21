<?php
require_once '../includes/db.php';
require_once 'includes/upload_helper.php';

// Handle Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM blogs WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: blog.php?msg=deleted");
    exit;
}

// Handle Add/Edit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    // Auto-generate slug from title
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
    $content = $_POST['content'];
    $image_url_input = $_POST['image_url'] ?? '';

    // Process File Upload
    $uploadedPath = uploadAndConvertToWebp('image_file', '../assets/uploads/blog/');

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        // Update
        $id = (int)$_POST['id'];
        
        // If there's a new upload, use it, else if there's a URL input use it, else keep old
        if ($uploadedPath) {
            $image_url = $uploadedPath;
        } elseif (!empty($image_url_input)) {
            $image_url = $image_url_input;
        } else {
            $stmt = $pdo->prepare("SELECT image_url FROM blogs WHERE id = ?");
            $stmt->execute([$id]);
            $oldData = $stmt->fetch();
            $image_url = $oldData['image_url'] ?? '';
        }

        $stmt = $pdo->prepare("UPDATE blogs SET title=?, slug=?, content=?, image_url=? WHERE id=?");
        $stmt->execute([$title, $slug, $content, $image_url, $id]);
        header("Location: blog.php?msg=updated");
    } else {
        // Insert
        $image_url = $uploadedPath ? $uploadedPath : $image_url_input;
        $stmt = $pdo->prepare("INSERT INTO blogs (title, slug, content, image_url) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $slug, $content, $image_url]);
        header("Location: blog.php?msg=added");
    }
    exit;
}

include 'includes/header.php';

// Fetch all blogs
$stmt = $pdo->query("SELECT * FROM blogs ORDER BY created_at DESC");
$blogs = $stmt->fetchAll();

// Edit Mode
$editData = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM blogs WHERE id = ?");
    $stmt->execute([(int)$_GET['edit']]);
    $editData = $stmt->fetch();
}
?>

<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Manajemen Blog</h1>
        <p class="text-gray-500 mt-1">Kelola artikel dan berita untuk izinnow.id.</p>
    </div>
    <?php if ($editData): ?>
        <a href="blog.php" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
            <i class="fa-solid fa-plus mr-2"></i> Tulis Artikel Baru
        </a>
    <?php endif; ?>
</div>

<?php if (isset($_GET['msg'])): ?>
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6 relative">
        Artikel berhasil <?= $_GET['msg'] == 'deleted' ? 'dihapus' : ($_GET['msg'] == 'updated' ? 'diperbarui' : 'ditambahkan') ?>!
    </div>
<?php endif; ?>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Form Area -->
    <div class="lg:col-span-1 bg-white rounded-xl shadow-sm border border-gray-100 p-6 self-start sticky top-6">
        <h2 class="text-xl font-bold text-gray-900 mb-6"><?= $editData ? 'Edit Artikel' : 'Tulis Artikel Baru' ?></h2>
        
        <form action="blog.php" method="POST" enctype="multipart/form-data" class="space-y-4">
            <?php if ($editData): ?>
                <input type="hidden" name="id" value="<?= $editData['id'] ?>">
            <?php endif; ?>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul Artikel *</label>
                <input type="text" name="title" required value="<?= htmlspecialchars($editData['title'] ?? '') ?>" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-accent focus:border-accent">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Upload Gambar Cover (Opsional)</label>
                <input type="file" name="image_file" accept=".jpg,.jpeg,.png,.webp" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-accent focus:border-accent">
                <p class="text-xs text-gray-500 mt-1">Pilih gambar dari perangkat. Otomatis dikonversi ke WebP.</p>
                <?php if($editData && $editData['image_url']): ?>
                    <div class="mt-2 text-sm text-gray-500">
                        Gambar saat ini: <img src="../<?= htmlspecialchars($editData['image_url']) ?>" class="h-10 w-auto rounded inline-block">
                    </div>
                <?php endif; ?>
            </div>

            <div class="mt-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Atau Gunakan URL Gambar Cover (Jika tidak upload)</label>
                <input type="url" name="image_url" placeholder="https://..." value="<?= htmlspecialchars($editData['image_url'] ?? '') ?>" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-accent focus:border-accent">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Konten Artikel *</label>
                <textarea name="content" rows="10" class="wysiwyg-editor w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-accent focus:border-accent"><?= htmlspecialchars($editData['content'] ?? '') ?></textarea>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-primary text-white font-medium py-2.5 rounded-lg hover:bg-opacity-90 transition-colors">
                    <?= $editData ? 'Simpan Perubahan' : 'Terbitkan Artikel' ?>
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
                            <th class="py-3 px-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Artikel</th>
                            <th class="py-3 px-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal</th>
                            <th class="py-3 px-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php foreach ($blogs as $b): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 align-top">
                                    <div class="font-medium text-gray-900"><?= htmlspecialchars($b['title']) ?></div>
                                    <div class="text-xs text-gray-400">/<?= htmlspecialchars($b['slug']) ?></div>
                                </td>
                                <td class="py-3 px-4 align-top text-sm text-gray-500 whitespace-nowrap">
                                    <?= date('d M Y', strtotime($b['created_at'])) ?>
                                </td>
                                <td class="py-3 px-4 align-top text-right whitespace-nowrap">
                                    <a href="blog.php?edit=<?= $b['id'] ?>" class="text-blue-600 hover:text-blue-900 mr-3" title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="blog.php?delete=<?= $b['id'] ?>" onclick="return confirm('Yakin ingin menghapus artikel ini?');" class="text-red-600 hover:text-red-900" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        
                        <?php if (empty($blogs)): ?>
                            <tr>
                                <td colspan="3" class="py-8 text-center text-gray-500">Belum ada artikel blog.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
