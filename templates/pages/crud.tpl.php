<h2>CRUD - Notebookok kezelése</h2>

<p class="lead">
    Ezen az oldalon a <code>gep</code> tábla adatai kezelhetők.
    Lehet új notebookot felvinni, meglévőt listázni, módosítani és törölni.
</p>

<?php if (!empty($crudHibak)) { ?>
    <section class="message error">
        <h3>Hiba történt</h3>
        <ul>
            <?php foreach ($crudHibak as $hiba) { ?>
                <li><?= htmlspecialchars($hiba) ?></li>
            <?php } ?>
        </ul>
    </section>
<?php } ?>

<?php if (isset($crudUzenet)) { ?>
    <section class="message success">
        <h3>Sikeres művelet</h3>
        <p><?= htmlspecialchars($crudUzenet) ?></p>
    </section>
<?php } ?>

<?php
$formAdat = [
    'id' => $szerkesztettGep['id'] ?? '',
    'gyarto' => $szerkesztettGep['gyarto'] ?? '',
    'tipus' => $szerkesztettGep['tipus'] ?? '',
    'kijelzo' => $szerkesztettGep['kijelzo'] ?? '',
    'memoria' => $szerkesztettGep['memoria'] ?? '',
    'merevlemez' => $szerkesztettGep['merevlemez'] ?? '',
    'videovezerlo' => $szerkesztettGep['videovezerlo'] ?? '',
    'ar' => $szerkesztettGep['ar'] ?? '',
    'processzorid' => $szerkesztettGep['processzorid'] ?? '',
    'oprendszerid' => $szerkesztettGep['oprendszerid'] ?? '',
    'db' => $szerkesztettGep['db'] ?? '0',
];

$modositas = isset($szerkesztettGep) && $szerkesztettGep;
?>

<section class="form-card">
    <form action="crud" method="post">
        <fieldset>
            <legend><?= $modositas ? 'Notebook módosítása' : 'Új notebook felvitele' ?></legend>

            <input type="hidden" name="action" value="<?= $modositas ? 'update' : 'create' ?>">
            <input type="hidden" name="id" value="<?= htmlspecialchars($formAdat['id']) ?>">

            <div class="form-grid">
                <div>
                    <label for="gyarto">Gyártó</label>
                    <input
                        id="gyarto"
                        type="text"
                        name="gyarto"
                        value="<?= htmlspecialchars($formAdat['gyarto']) ?>"
                    >
                </div>

                <div>
                    <label for="tipus">Típus</label>
                    <input
                        id="tipus"
                        type="text"
                        name="tipus"
                        value="<?= htmlspecialchars($formAdat['tipus']) ?>"
                    >
                </div>

                <div>
                    <label for="kijelzo">Kijelző</label>
                    <input
                        id="kijelzo"
                        type="text"
                        name="kijelzo"
                        value="<?= htmlspecialchars($formAdat['kijelzo']) ?>"
                        placeholder="pl. 15,6"
                    >
                </div>

                <div>
                    <label for="memoria">Memória / MB</label>
                    <input
                        id="memoria"
                        type="number"
                        name="memoria"
                        value="<?= htmlspecialchars($formAdat['memoria']) ?>"
                    >
                </div>

                <div>
                    <label for="merevlemez">Merevlemez / GB</label>
                    <input
                        id="merevlemez"
                        type="number"
                        name="merevlemez"
                        value="<?= htmlspecialchars($formAdat['merevlemez']) ?>"
                    >
                </div>

                <div>
                    <label for="videovezerlo">Videóvezérlő</label>
                    <input
                        id="videovezerlo"
                        type="text"
                        name="videovezerlo"
                        value="<?= htmlspecialchars($formAdat['videovezerlo']) ?>"
                    >
                </div>

                <div>
                    <label for="ar">Ár / Ft</label>
                    <input
                        id="ar"
                        type="number"
                        name="ar"
                        value="<?= htmlspecialchars($formAdat['ar']) ?>"
                    >
                </div>

                <div>
                    <label for="db">Darabszám</label>
                    <input
                        id="db"
                        type="number"
                        name="db"
                        value="<?= htmlspecialchars($formAdat['db']) ?>"
                    >
                </div>

                <div>
                    <label for="processzorid">Processzor</label>
                    <select id="processzorid" name="processzorid">
                        <option value="0">-- Válassz processzort --</option>
                        <?php foreach ($processzorok as $processzor) { ?>
                            <option
                                value="<?= htmlspecialchars($processzor['id']) ?>"
                                <?= ((int)$formAdat['processzorid'] === (int)$processzor['id']) ? 'selected' : '' ?>
                            >
                                <?= htmlspecialchars($processzor['gyarto'] . ' ' . $processzor['tipus']) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div>
                    <label for="oprendszerid">Operációs rendszer</label>
                    <select id="oprendszerid" name="oprendszerid">
                        <option value="0">-- Válassz operációs rendszert --</option>
                        <?php foreach ($oprendszerek as $oprendszer) { ?>
                            <option
                                value="<?= htmlspecialchars($oprendszer['id']) ?>"
                                <?= ((int)$formAdat['oprendszerid'] === (int)$oprendszer['id']) ? 'selected' : '' ?>
                            >
                                <?= htmlspecialchars($oprendszer['nev']) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <button type="submit">
                <?= $modositas ? 'Módosítás mentése' : 'Új notebook létrehozása' ?>
            </button>

            <?php if ($modositas) { ?>
                <a class="button-link secondary" href="crud">Mégsem</a>
            <?php } ?>
        </fieldset>
    </form>
</section>

<h3>Notebookok listája</h3>

<?php if (empty($gepek)) { ?>
    <section class="message">
        <p>Nincs megjeleníthető notebook.</p>
    </section>
<?php } else { ?>
    <div class="table-wrapper">
        <table>
            <caption>Legutóbbi 50 notebook a <code>gep</code> táblából</caption>

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Gyártó</th>
                    <th>Típus</th>
                    <th>Kijelző</th>
                    <th>Memória</th>
                    <th>Merevlemez</th>
                    <th>Processzor</th>
                    <th>Operációs rendszer</th>
                    <th>Ár</th>
                    <th>Db</th>
                    <th>Műveletek</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($gepek as $gep) { ?>
                    <tr>
                        <td><?= htmlspecialchars($gep['id']) ?></td>
                        <td><?= htmlspecialchars($gep['gyarto']) ?></td>
                        <td><?= htmlspecialchars($gep['tipus']) ?></td>
                        <td><?= htmlspecialchars($gep['kijelzo']) ?>”</td>
                        <td><?= htmlspecialchars($gep['memoria']) ?> MB</td>
                        <td><?= htmlspecialchars($gep['merevlemez']) ?> GB</td>
                        <td><?= htmlspecialchars($gep['processzor']) ?></td>
                        <td><?= htmlspecialchars($gep['oprendszer']) ?></td>
                        <td><?= number_format((int)$gep['ar'], 0, ',', ' ') ?> Ft</td>
                        <td><?= htmlspecialchars($gep['db']) ?></td>
                        <td>
                            <a class="button-link secondary" href="crud?action=edit&id=<?= urlencode($gep['id']) ?>">
                                Módosítás
                            </a>

                            <form
                                action="crud"
                                method="post"
                                style="display:inline;"
                                onsubmit="return confirm('Biztosan törlöd ezt a notebookot?');"
                            >
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($gep['id']) ?>">
                                <button type="submit">Törlés</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php } ?>