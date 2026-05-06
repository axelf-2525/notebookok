<?php if (isset($row)) { ?>
    <?php if ($row) { ?>
        <section class="message success">
            <h2>Sikeres bejelentkezés</h2>
            <p>Bejelentkezett felhasználó: <strong><?= htmlspecialchars($row['csaladi_nev'] . ' ' . $row['uto_nev']) ?></strong></p>
            <p>Azonosító: <strong><?= htmlspecialchars($row['id']) ?></strong></p>
            <a class="button-link" href=".">Tovább a címlapra</a>
        </section>
    <?php } else { ?>
        <section class="message error">
            <h2>A bejelentkezés nem sikerült!</h2>
            <p>Ellenőrizd a felhasználónevet és a jelszót.</p>
            <a class="button-link" href="belepes">Próbáld újra</a>
        </section>
    <?php } ?>
<?php } ?>

<?php if (isset($errormessage)) { ?>
    <section class="message error">
        <h2><?= htmlspecialchars($errormessage) ?></h2>
    </section>
<?php } ?>
