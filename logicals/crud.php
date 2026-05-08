<?php
$crudUzenet = null;
$crudHibak = [];
$szerkesztettGep = null;
$gepek = [];
$processzorok = [];
$oprendszerek = [];

function tisztitottSzoveg(string $kulcs): string
{
    return trim($_POST[$kulcs] ?? '');
}

function tisztitottInt(string $kulcs): int
{
    return (int)($_POST[$kulcs] ?? 0);
}

try {
    $dbh = getDb();

    $processzorok = $dbh
        ->query("SELECT id, gyarto, tipus FROM processzor ORDER BY gyarto, tipus")
        ->fetchAll();

    $oprendszerek = $dbh
        ->query("SELECT id, nev FROM oprendszer ORDER BY nev")
        ->fetchAll();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'] ?? '';

        if ($action === 'create' || $action === 'update') {
            $id = tisztitottInt('id');
            $gyarto = tisztitottSzoveg('gyarto');
            $tipus = tisztitottSzoveg('tipus');
            $kijelzo = tisztitottSzoveg('kijelzo');
            $memoria = tisztitottInt('memoria');
            $merevlemez = tisztitottInt('merevlemez');
            $videovezerlo = tisztitottSzoveg('videovezerlo');
            $ar = tisztitottInt('ar');
            $processzorid = tisztitottInt('processzorid');
            $oprendszerid = tisztitottInt('oprendszerid');
            $db = tisztitottInt('db');

            if ($gyarto === '') {
                $crudHibak[] = 'A gyártó megadása kötelező.';
            }

            if ($tipus === '') {
                $crudHibak[] = 'A típus megadása kötelező.';
            }

            if ($kijelzo === '') {
                $crudHibak[] = 'A kijelző méretének megadása kötelező.';
            }

            if ($memoria <= 0) {
                $crudHibak[] = 'A memória értéke legyen nagyobb nullánál.';
            }

            if ($merevlemez <= 0) {
                $crudHibak[] = 'A merevlemez értéke legyen nagyobb nullánál.';
            }

            if ($videovezerlo === '') {
                $crudHibak[] = 'A videóvezérlő megadása kötelező.';
            }

            if ($ar <= 0) {
                $crudHibak[] = 'Az ár legyen nagyobb nullánál.';
            }

            if ($processzorid <= 0) {
                $crudHibak[] = 'Válassz processzort.';
            }

            if ($oprendszerid <= 0) {
                $crudHibak[] = 'Válassz operációs rendszert.';
            }

            if ($db < 0) {
                $crudHibak[] = 'A darabszám nem lehet negatív.';
            }

            if (empty($crudHibak)) {
                if ($action === 'create') {
                    $sql = "INSERT INTO gep
                            (gyarto, tipus, kijelzo, memoria, merevlemez, videovezerlo, ar, processzorid, oprendszerid, db)
                            VALUES
                            (:gyarto, :tipus, :kijelzo, :memoria, :merevlemez, :videovezerlo, :ar, :processzorid, :oprendszerid, :db)";

                    $stmt = $dbh->prepare($sql);
                    $stmt->execute([
                        ':gyarto' => $gyarto,
                        ':tipus' => $tipus,
                        ':kijelzo' => $kijelzo,
                        ':memoria' => $memoria,
                        ':merevlemez' => $merevlemez,
                        ':videovezerlo' => $videovezerlo,
                        ':ar' => $ar,
                        ':processzorid' => $processzorid,
                        ':oprendszerid' => $oprendszerid,
                        ':db' => $db
                    ]);

                    $crudUzenet = 'Az új notebook sikeresen létrejött.';
                }

                if ($action === 'update') {
                    if ($id <= 0) {
                        $crudHibak[] = 'Hiányzó vagy hibás azonosító.';
                    } else {
                        $sql = "UPDATE gep
                                SET gyarto = :gyarto,
                                    tipus = :tipus,
                                    kijelzo = :kijelzo,
                                    memoria = :memoria,
                                    merevlemez = :merevlemez,
                                    videovezerlo = :videovezerlo,
                                    ar = :ar,
                                    processzorid = :processzorid,
                                    oprendszerid = :oprendszerid,
                                    db = :db
                                WHERE id = :id";

                        $stmt = $dbh->prepare($sql);
                        $stmt->execute([
                            ':gyarto' => $gyarto,
                            ':tipus' => $tipus,
                            ':kijelzo' => $kijelzo,
                            ':memoria' => $memoria,
                            ':merevlemez' => $merevlemez,
                            ':videovezerlo' => $videovezerlo,
                            ':ar' => $ar,
                            ':processzorid' => $processzorid,
                            ':oprendszerid' => $oprendszerid,
                            ':db' => $db,
                            ':id' => $id
                        ]);

                        $crudUzenet = 'A notebook adatai sikeresen módosultak.';
                    }
                }
            }
        }

        if ($action === 'delete') {
            $id = tisztitottInt('id');

            if ($id <= 0) {
                $crudHibak[] = 'Hiányzó vagy hibás azonosító.';
            } else {
                $stmt = $dbh->prepare("DELETE FROM gep WHERE id = :id");
                $stmt->execute([':id' => $id]);

                $crudUzenet = 'A notebook sikeresen törölve lett.';
            }
        }
    }

    if (isset($_GET['action'], $_GET['id']) && $_GET['action'] === 'edit') {
        $id = (int)$_GET['id'];

        if ($id > 0) {
            $stmt = $dbh->prepare("SELECT * FROM gep WHERE id = :id");
            $stmt->execute([':id' => $id]);
            $szerkesztettGep = $stmt->fetch();

            if (!$szerkesztettGep) {
                $crudHibak[] = 'A szerkesztendő notebook nem található.';
            }
        }
    }

    $sql = "SELECT g.id, g.gyarto, g.tipus, g.kijelzo, g.memoria, g.merevlemez,
                   g.videovezerlo, g.ar, g.db, g.processzorid, g.oprendszerid,
                   CONCAT(p.gyarto, ' ', p.tipus) AS processzor,
                   o.nev AS oprendszer
            FROM gep g
            INNER JOIN processzor p ON g.processzorid = p.id
            INNER JOIN oprendszer o ON g.oprendszerid = o.id
            ORDER BY g.id DESC
            LIMIT 50";

    $gepek = $dbh->query($sql)->fetchAll();
} catch (PDOException $e) {
    $crudHibak[] = 'Adatbázis hiba: ' . $e->getMessage();
}