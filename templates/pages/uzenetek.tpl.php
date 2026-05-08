<h2>Beküldött üzenetek</h2>

<p class="lead">
    Itt láthatók a Kapcsolat oldalon beküldött üzenetek.
    A lista fordított időrendben jelenik meg, vagyis a legfrissebb üzenet van legfelül.
</p>

<?php if (isset($uzenetHiba)) { ?>
    <section class="message error">
        <h3>Adatbázis hiba</h3>
        <p><?= htmlspecialchars($uzenetHiba) ?></p>
    </section>
<?php } elseif (empty($uzenetek)) { ?>
    <section class="message">
        <h3>Nincs megjeleníthető üzenet</h3>
        <p>Még nem érkezett üzenet a Kapcsolat űrlapon keresztül.</p>
    </section>
<?php } else { ?>
    <div class="table-wrapper">
        <table>
            <caption>Kapcsolat űrlapon beküldött üzenetek</caption>

            <thead>
                <tr>
                    <th>Küldés ideje</th>
                    <th>Üzenetküldő neve</th>
                    <th>E-mail cím</th>
                    <th>Tárgy</th>
                    <th>Üzenet</th>
                    <th>Bejelentkezett felhasználó</th>
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
                        <td>
                            <?php if (!empty($uzenet['felhasznalo'])) { ?>
                                <?= htmlspecialchars($uzenet['felhasznalo']) ?>
                            <?php } else { ?>
                                Vendég
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php } ?>