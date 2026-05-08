<?php
$uzenetek = [];
$uzenetHiba = null;

if (!isset($_SESSION['login'])) {
    header('Location: belepes');
    exit;
}

try {
    $dbh = getDb();

    $sql = "SELECT id, nev, email, targy, uzenet, kuldes_ideje, felhasznalo
            FROM uzenetek
            ORDER BY kuldes_ideje DESC";

    $uzenetek = $dbh->query($sql)->fetchAll();
} catch (PDOException $e) {
    $uzenetHiba = 'Adatbázis hiba: ' . $e->getMessage();
}