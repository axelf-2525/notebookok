<h2>Kapcsolat</h2>
<p class="lead">
    Az alábbi űrlapon keresztül üzenetet küldhetsz a ReNew Kft. számára.
    Az üzenetek adatbázisba kerülnek, és bejelentkezés után az Üzenetek oldalon megtekinthetők.
</p>

<?php if (!empty($kapcsolatHibak)) { ?>
    <section class="message error">
        <h3>Az üzenet elküldése nem sikerült</h3>
        <ul>
            <?php foreach ($kapcsolatHibak as $hiba) { ?>
                <li><?= htmlspecialchars($hiba) ?></li>
            <?php } ?>
        </ul>
    </section>
<?php } ?>

<?php if (isset($kapcsolatUzenet)) { ?>
    <section class="message success">
        <h3>Sikeres küldés</h3>
        <p><?= htmlspecialchars($kapcsolatUzenet) ?></p>
    </section>
<?php } ?>

<section class="contact-grid">
    <form id="kapcsolatForm" action="kapcsolat" method="post" class="form-card" novalidate>
        <fieldset>
            <legend>Üzenetküldés</legend>

            <div id="jsHibak" class="message error" style="display: none;"></div>

            <label for="nev">Név</label>
            <input
                id="nev"
                type="text"
                name="nev"
                value="<?= htmlspecialchars($elkuldottAdatok['nev'] ?? '') ?>"
                placeholder="pl. Gipsz Elek"
            >

            <label for="email">E-mail cím</label>
            <input
                id="email"
                type="text"
                name="email"
                value="<?= htmlspecialchars($elkuldottAdatok['email'] ?? '') ?>"
                placeholder="pl. gipsz.elek@email.hu"
            >

            <label for="targy">Tárgy</label>
            <input
                id="targy"
                type="text"
                name="targy"
                value="<?= htmlspecialchars($elkuldottAdatok['targy'] ?? '') ?>"
                placeholder="pl. Érdeklődés notebook iránt"
            >

            <label for="uzenet">Üzenet</label>
            <textarea
                id="uzenet"
                name="uzenet"
                rows="7"
                placeholder="Írd ide az üzenetedet..."
            ><?= htmlspecialchars($elkuldottAdatok['uzenet'] ?? '') ?></textarea>

            <button type="submit">Üzenet küldése</button>
        </fieldset>
    </form>

    <section class="info-card">
        <h3>Cégadatok</h3>
        <p>Ügyvezető: <strong>Valaki Az</strong></p>
        <p>E-mail: <strong>info@renew-notebook.hu</strong></p>
        <p>Telephely: <strong>Seholország fővárosa</strong></p>

        <h3>Kapcsolatfelvétel</h3>
        <p>
            Az űrlapon beküldött üzeneteket adatbázisban tároljuk.
            A legfrissebb üzenetek bejelentkezés után az Üzenetek menüpontban láthatók.
        </p>
    </section>
</section>

<div class="map-wrapper">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2726.3375296155727!2d19.66695091525771!3d46.89607994478184!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4743da7a6c479e1d%3A0xc8292b3f6dc69e7f!2sPallasz+Ath%C3%A9n%C3%A9+Egyetem+GAMF+Kar!5e0!3m2!1shu!2shu!4v1475753185783"
        loading="lazy"
        allowfullscreen>
    </iframe>
</div>

<script src="./scripts/kapcsolat.js"></script>