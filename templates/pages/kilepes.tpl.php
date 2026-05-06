<section class="message success">
    <h2>Kilépés sikeres</h2>
    <?php if (isset($data['login'])) { ?>
        <p>Kilépett felhasználó: <strong><?= htmlspecialchars($data['csn'] . ' ' . $data['un'] . ' (' . $data['login'] . ')') ?></strong></p>
    <?php } else { ?>
        <p>Nem volt bejelentkezett felhasználó.</p>
    <?php } ?>
    <a class="button-link" href=".">Vissza a címlapra</a>
</section>
