<?php
$row = null;
$errormessage = null;

if (isset($_POST['felhasznalo'], $_POST['jelszo'])) {
    try {
        $dbh = getDb();

        $sqlSelect = "SELECT id, csaladi_nev, uto_nev, bejelentkezes
                      FROM felhasznalok
                      WHERE bejelentkezes = :bejelentkezes
                      AND jelszo = SHA1(:jelszo)";
        $sth = $dbh->prepare($sqlSelect);
        $sth->execute([
            ':bejelentkezes' => $_POST['felhasznalo'],
            ':jelszo' => $_POST['jelszo']
        ]);

        $row = $sth->fetch();

        if ($row) {
            $_SESSION['csn'] = $row['csaladi_nev'];
            $_SESSION['un'] = $row['uto_nev'];
            $_SESSION['login'] = $row['bejelentkezes'];
        }
    } catch (PDOException $e) {
        $errormessage = 'Adatbázis hiba: ' . $e->getMessage();
    }
} else {
    header('Location: belepes');
    exit;
}
