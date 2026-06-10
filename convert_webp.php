<?php
ini_set('memory_limit', '1024M');
require 'includes/db.php';

function convertDir($dir) {
    $files = scandir($dir);
    foreach($files as $file) {
        if($file === '.' || $file === '..') continue;
        $path = $dir . DIRECTORY_SEPARATOR . $file;
        if(is_dir($path)) {
            convertDir($path);
        } else {
            $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
            if(in_array($ext, ['jpg', 'jpeg', 'png'])) {
                $newPath = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $path);
                
                $img = null;
                if($ext === 'png') {
                    $img = @imagecreatefrompng($path);
                    if ($img) {
                        imagepalettetotruecolor($img);
                        imagealphablending($img, true);
                        imagesavealpha($img, true);
                    }
                } else {
                    $img = @imagecreatefromjpeg($path);
                }
                
                if($img) {
                    imagewebp($img, $newPath, 80);
                    imagedestroy($img);
                    unlink($path);
                    echo "Converted $path to $newPath\n";
                } else {
                    echo "Failed to load $path\n";
                }
            }
        }
    }
}

// Convert files in assets folder
convertDir(__DIR__ . '/assets');

// Update Database for testimonials
$pdo->exec("UPDATE testimonials SET image_url = REPLACE(image_url, '.jpeg', '.webp') WHERE image_url LIKE '%.jpeg'");
$pdo->exec("UPDATE testimonials SET image_url = REPLACE(image_url, '.jpg', '.webp') WHERE image_url LIKE '%.jpg'");
$pdo->exec("UPDATE testimonials SET image_url = REPLACE(image_url, '.png', '.webp') WHERE image_url LIKE '%.png'");
echo "Database updated.\n";
