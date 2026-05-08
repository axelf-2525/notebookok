<?php
$kapcsolatUzenet = null;
$kapcsolatHibak = [];
$elkuldottAdatok = [
    'nev' => '',
    'email' => '',
    'targy' => '',
    'uzenet' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nev = trim($_POST['nev'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $targy = trim($_POST['targy'] ?? '');
    $uzenet = trim($_POST['uzenet'] ?? '');

    $elkuldottAdatok = [
        'nev' => $nev,
        'email' => $email,
        'targy' => $targy,
        'uzenet' => $uzenet
    ];

    if ($nev === '') {
        $kapcsolatHibak[] = 'A név megadása kötelező.';
    } elseif (mb_strlen($nev) < 3) {
        $kapcsolatHibak[] = 'A név legalább 3 karakter hosszú legyen.';
    }

    if ($email === '') {
        $kapcsolatHibak[] = 'Az e-mail cím megadása kötelező.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $kapcsolatHibak[] = 'Az e-mail cím formátuma nem megfelelő.';
    }

    if ($targy === '') {
        $kapcsolatHibak[] = 'A tárgy megadása kötelező.';
    } elseif (mb_strlen($targy) < 3) {
        $kapcsolatHibak[] = 'A tárgy legalább 3 karakter hosszú legyen.';
    }

    if ($uzenet === '') {
        $kapcsolatHibak[] = 'Az üzenet megadása kötelező.';
    } elseif (mb_strlen($uzenet) < 10) {
        $kapcsolatHibak[] = 'Az üzenet legalább 10 karakter hosszú legyen.';
    }

    if (empty($kapcsolatHibak)) {
        try {
            $dbh = getDb();

            $felhasznalo = 'Vendég';
            if (isset($_SESSION['login'])) {
                $felhasznalo = $_SESSION['csn'] . ' ' . $_SESSION['un'] . ' (' . $_SESSION['login'] . ')';
            }

            $sql = "INSERT INTO uzenetek
                    (nev, email, targy, uzenet, kuldes_ideje, felhasznalo)
                    VALUES
                    (:nev, :email, :targy, :uzenet, NOW(), :felhasznalo)";

            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ':nev' => $nev,
                ':email' => $email,
                ':targy' => $targy,
                ':uzenet' => $uzenet,
                ':felhasznalo' => $felhasznalo
            ]);

            $kapcsolatUzenet = 'Az üzenetet sikeresen elküldted.';
            $elkuldottAdatok = [
                'nev' => '',
                'email' => '',
                'targy' => '',
                'uzenet' => ''
            ];
        } catch (PDOException $e) {
            $kapcsolatHibak[] = 'Adatbázis hiba: ' . $e->getMessage();
        }
    }
}