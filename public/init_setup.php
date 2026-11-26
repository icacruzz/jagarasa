<?php

/**
 * Script Setup Inisialisasi Otomatis Jagarasa:
 * 1. Generate Application Key jika kosong di .env
 * 2. Setup SQLite Database file jika belum ada
 * 3. Copy logo.jpg ke public/images/logo-jagarasa.png
 * 4. Create dummy placeholder images untuk 5 produk seeder
 * 5. Buat symbolic link storage/public
 */

$root = dirname(__DIR__);

// 1. Copy Logo
$imagesDir = $root . '/public/images';
if (!is_dir($imagesDir)) {
    mkdir($imagesDir, 0777, true);
}

$logoSrc = $root . '/logo.jpg';
if (file_exists($logoSrc)) {
    copy($logoSrc, $imagesDir . '/logo-jagarasa.png');
    copy($logoSrc, $imagesDir . '/logo-jagarasa.jpg');
}

// 2. Setup product images
$prodImagesDir = $imagesDir . '/products';
if (!is_dir($prodImagesDir)) {
    mkdir($prodImagesDir, 0777, true);
}

$prodNames = [
    'pisang-cokelat.jpg',
    'pisang-keju.jpg',
    'singkong-balado.jpg',
    'kemplang-panggang.jpg',
    'kopi-robusta.jpg',
];

foreach ($prodNames as $name) {
    $target = $prodImagesDir . '/' . $name;
    if (!file_exists($target) && file_exists($logoSrc)) {
        copy($logoSrc, $target);
    }
}

// 3. Database sqlite
$dbDir = $root . '/database';
if (!file_exists($dbDir . '/database.sqlite')) {
    touch($dbDir . '/database.sqlite');
}

// 4. Storage directory structure
$storagePublic = $root . '/storage/app/public/produk';
if (!is_dir($storagePublic)) {
    mkdir($storagePublic, 0777, true);
}

// 5. Public storage symlink fallback
$publicStorage = $root . '/public/storage';
if (!file_exists($publicStorage)) {
    @symlink($root . '/storage/app/public', $publicStorage);
}

// 6. Check APP_KEY
$envFile = $root . '/.env';
if (file_exists($envFile)) {
    $envContent = file_get_contents($envFile);
    if (strpos($envContent, 'APP_KEY=base64:') === false) {
        $key = 'base64:' . base64_encode(random_bytes(32));
        $envContent = preg_replace('/^APP_KEY=.*$/m', "APP_KEY={$key}", $envContent);
        file_put_contents($envFile, $envContent);
    }
}

echo "Setup Jagarasa Berhasil!\n";
