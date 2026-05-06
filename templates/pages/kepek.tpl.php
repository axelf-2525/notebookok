<h2>Képfeltöltés</h2>
<p class="lead">Itt lehet notebook képeket feltölteni. A feltöltött képek az <code>uploads</code> könyvtárba kerülnek.</p>

<?php if (isset($feltoltesUzenet)) { ?>
    <div class="message <?= str_contains($feltoltesUzenet, 'sikeres') ? 'success' : 'error' ?>">
        <?= htmlspecialchars($feltoltesUzenet) ?>
    </div>
<?php } ?>

<form method="post" enctype="multipart/form-data" class="form-card upload-form">
    <fieldset>
        <legend>Kép feltöltése</legend>
        <label for="kep">Kép kiválasztása</label>
        <input id="kep" type="file" name="kep" accept="image/*" required>
        <button type="submit">Feltöltés</button>
    </fieldset>
</form>

<?php if (!empty($feltoltottKepek)) { ?>
    <h3>Feltöltött képek</h3>
    <div class="gallery-grid">
        <?php foreach (array_reverse($feltoltottKepek) as $kep) { ?>
            <figure>
                <img src="<?= htmlspecialchars($kep) ?>" alt="Feltöltött kép">
                <figcaption><?= htmlspecialchars(basename($kep)) ?></figcaption>
            </figure>
        <?php } ?>
    </div>
<?php } else { ?>
    <p>Még nincs feltöltött kép.</p>
<?php } ?>
