<?php
$feltoltesUzenet = null;
$feltoltottKepek = [];

if (!isset($_SESSION['login'])) {
    header('Location: belepes');
    exit;
}

$uploadDir = './uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['kep'])) {
    $file = $_FILES['kep'];
    $engedelyezett = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp', 'image/gif' => 'gif'];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        $feltoltesUzenet = 'A feltöltés nem sikerült.';
    } else {
        $mime = mime_content_type($file['tmp_name']);
        if (!isset($engedelyezett[$mime])) {
            $feltoltesUzenet = 'Csak JPG, PNG, WEBP vagy GIF kép tölthető fel.';
        } else {
            $ujNev = date('Ymd_His') . '_' . bin2hex(random_bytes(4)) . '.' . $engedelyezett[$mime];
            $cel = $uploadDir . $ujNev;

            if (move_uploaded_file($file['tmp_name'], $cel)) {
                $feltoltesUzenet = 'A kép feltöltése sikeres.';
            } else {
                $feltoltesUzenet = 'A fájl mentése nem sikerült.';
            }
        }
    }
}

foreach (glob($uploadDir . '*.{jpg,jpeg,png,webp,gif}', GLOB_BRACE) as $kep) {
    $feltoltottKepek[] = $kep;
}
