<h2>Beküldött üzenetek</h2>
<p class="lead">
    Itt láthatók a Kapcsolat oldalon beküldött üzenetek, fordított időrendben.
</p>

<?php
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
    $uzenetek = [];
    $uzenetHiba = $e->getMessage();
}
?>

<?php if (isset($uzenetHiba)) { ?>
    <section class="message error">
        <h3>Adatbázis hiba</h3>
        <p><?= htmlspecialchars($uzenetHiba) ?></p>
    </section>
<?php } elseif (empty($uzenetek)) { ?>
    <section class="message">
        <p>Még nem érkezett üzenet.</p>
    </section>
<?php } else { ?>
    <div class="table-wrapper">
        <table>
            <caption>Kapcsolat űrlapon beküldött üzenetek</caption>
            <thead>
                <tr>
                    <th>Küldés ideje</th>
                    <th>Küldő neve</th>
                    <th>E-mail</th>
                    <th>Tárgy</th>
                    <th>Üzenet</th>
                    <th>Felhasználó</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($uzenetek as $uzenet) { ?>
                    <tr>
                        <td><?= htmlspecialchars($uzenet['kuldes_ideje']) ?></td>
                        <td><?= htmlspecialchars($uzenet['nev']) ?></td>
                        <td><?= htmlspecialchars($uzenet['email']) ?></td>
                        <td><?= htmlspecialchars($uzenet['targy']) ?></td>
                        <td><?= nl2br(htmlspecialchars($uzenet['uzenet'])) ?></td>
                        <td><?= htmlspecialchars($uzenet['felhasznalo'] ?: 'Vendég') ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php } ?>