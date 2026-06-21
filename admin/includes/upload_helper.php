<?php
function uploadAndConvertToWebp($fileInputName, $uploadDir = '../assets/uploads/') {
    if (!isset($_FILES[$fileInputName]) || $_FILES[$fileInputName]['error'] !== UPLOAD_ERR_OK) {
        return null; // No file uploaded or error
    }

    $fileTmpPath = $_FILES[$fileInputName]['tmp_name'];
    $fileName = $_FILES[$fileInputName]['name'];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
    if (!in_array($fileExtension, $allowedExtensions)) {
        return false; // Invalid extension
    }

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $newFileName = uniqid() . '.webp';
    $destPath = $uploadDir . $newFileName;

    if ($fileExtension === 'webp') {
        if (move_uploaded_file($fileTmpPath, $destPath)) {
            return ltrim($uploadDir, '../') . $newFileName;
        }
    } else {
        $img = null;
        if ($fileExtension === 'png') {
            $img = @imagecreatefrompng($fileTmpPath);
            if ($img) {
                imagepalettetotruecolor($img);
                imagealphablending($img, true);
                imagesavealpha($img, true);
            }
        } else {
            $img = @imagecreatefromjpeg($fileTmpPath);
        }

        if ($img) {
            imagewebp($img, $destPath, 80);
            imagedestroy($img);
            return ltrim($uploadDir, '../') . $newFileName; // Return path like 'assets/uploads/file.webp'
        }
    }

    return false;
}
?>
