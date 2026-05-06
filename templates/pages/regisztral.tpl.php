<section class="message <?= ($ujra ?? false) ? 'error' : 'success' ?>">
    <h2>Regisztráció</h2>
    <?php if (isset($uzenet)) { ?>
        <p><?= htmlspecialchars($uzenet) ?></p>
    <?php } ?>

    <?php if ($ujra ?? false) { ?>
        <a class="button-link" href="belepes">Próbáld újra</a>
    <?php } else { ?>
        <a class="button-link" href="belepes">Belépés</a>
    <?php } ?>
</section>
