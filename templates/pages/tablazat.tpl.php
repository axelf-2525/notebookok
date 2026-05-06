<h2>Notebookok adatbázisból</h2>
<p class="lead">A lista a <code>gep</code>, <code>processzor</code> és <code>oprendszer</code> táblák összekapcsolásával jelenik meg.</p>

<?php
try {
    $dbh = getDb();
    $sql = "SELECT g.gyarto, g.tipus, g.kijelzo, g.memoria, g.merevlemez, g.videovezerlo, g.ar, g.db,
                   CONCAT(p.gyarto, ' ', p.tipus) AS processzor,
                   o.nev AS oprendszer
            FROM gep g
            INNER JOIN processzor p ON g.processzorid = p.id
            INNER JOIN oprendszer o ON g.oprendszerid = o.id
            ORDER BY g.ar ASC
            LIMIT 50";
    $notebookok = $dbh->query($sql)->fetchAll();
} catch (PDOException $e) {
    $notebookok = [];
    $tablaHiba = $e->getMessage();
}
?>

<?php if (isset($tablaHiba)) { ?>
    <section class="message error">
        <h3>Adatbázis hiba</h3>
        <p><?= htmlspecialchars($tablaHiba) ?></p>
        <p>Importáld az <code>sql/notebook_adatbazis.sql</code> fájlt phpMyAdminban a <code>gyakorlat7</code> adatbázisba.</p>
    </section>
<?php } elseif (empty($notebookok)) { ?>
    <section class="message error">
        <p>Nincs megjeleníthető notebook adat.</p>
    </section>
<?php } else { ?>
    <div class="table-wrapper">
        <table>
            <caption>Első 50 notebook ár szerint rendezve</caption>
            <thead>
                <tr>
                    <th>Gyártó</th>
                    <th>Típus</th>
                    <th>Kijelző</th>
                    <th>Memória</th>
                    <th>Merevlemez</th>
                    <th>Processzor</th>
                    <th>Operációs rendszer</th>
                    <th>Ár</th>
                    <th>Db</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($notebookok as $gep) { ?>
                    <tr>
                        <td><?= htmlspecialchars($gep['gyarto']) ?></td>
                        <td><?= htmlspecialchars($gep['tipus']) ?></td>
                        <td><?= htmlspecialchars($gep['kijelzo']) ?>”</td>
                        <td><?= htmlspecialchars($gep['memoria']) ?> MB</td>
                        <td><?= htmlspecialchars($gep['merevlemez']) ?> GB</td>
                        <td><?= htmlspecialchars($gep['processzor']) ?></td>
                        <td><?= htmlspecialchars($gep['oprendszer']) ?></td>
                        <td><?= number_format((int)$gep['ar'], 0, ',', ' ') ?> Ft</td>
                        <td><?= htmlspecialchars($gep['db']) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php } ?>
