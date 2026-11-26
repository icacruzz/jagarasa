<?php

$src = __DIR__ . '/../logo.jpg';
$destDir = __DIR__ . '/images';
if (!is_dir($destDir)) {
    mkdir($destDir, 0777, true);
}
if (file_exists($src)) {
    copy($src, $destDir . '/logo-jagarasa.png');
    copy($src, $destDir . '/logo-jagarasa.jpg');
}
