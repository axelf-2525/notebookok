<?php
$uzenet = null;
$ujra = false;

if (isset($_POST['felhasznalo'], $_POST['jelszo'], $_POST['vezeteknev'], $_POST['utonev'])) {
    try {
        $dbh = getDb();

        $sqlSelect = "SELECT id FROM felhasznalok WHERE bejelentkezes = :bejelentkezes";
        $sth = $dbh->prepare($sqlSelect);
        $sth->execute([':bejelentkezes' => $_POST['felhasznalo']]);

        if ($sth->fetch()) {
            $uzenet = 'A felhasználói név már foglalt!';
            $ujra = true;
        } else {
            $sqlInsert = "INSERT INTO felhasznalok(csaladi_nev, uto_nev, bejelentkezes, jelszo)
                          VALUES(:csaladinev, :utonev, :bejelentkezes, SHA1(:jelszo))";
            $stmt = $dbh->prepare($sqlInsert);
            $stmt->execute([
                ':csaladinev' => $_POST['vezeteknev'],
                ':utonev' => $_POST['utonev'],
                ':bejelentkezes' => $_POST['felhasznalo'],
                ':jelszo' => $_POST['jelszo']
            ]);

            $newid = $dbh->lastInsertId();
            $uzenet = "A regisztráció sikeres. Azonosító: {$newid}. Most már külön be tudsz jelentkezni.";
            $ujra = false;
        }
    } catch (PDOException $e) {
        $uzenet = 'Adatbázis hiba: ' . $e->getMessage();
        $ujra = true;
    }
} else {
    header('Location: belepes');
    exit;
}
