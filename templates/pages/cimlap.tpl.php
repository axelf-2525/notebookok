<section class="hero-card">
    <p class="eyebrow">ReNew Kft.</p>
    <h2>Gyárilag felújított notebookok, átlátható adatbázisból</h2>
    <p>Ez a beadandó egy egyszerű PHP alapú weboldal front-controller szerkezettel, reszponzív megjelenéssel, belépéssel, regisztrációval, képfeltöltéssel és adatbázisból listázott notebook adatokkal.</p>
    <div class="hero-actions">
        <a class="button-link" href="tablazat">Notebookok megtekintése</a>
        <?php if (!isset($_SESSION['login'])) { ?>
            <a class="button-link secondary" href="belepes">Belépés / Regisztráció</a>
        <?php } ?>
    </div>
</section>

<section class="feature-grid">
    <article>
        <h3>Reszponzív felület</h3>
        <p>Desktopon bal oldali menü, tableten szűkített elrendezés, mobilon hamburger menü jelenik meg.</p>
    </article>
    <article>
        <h3>Felhasználókezelés</h3>
        <p>A regisztráció nem léptet be automatikusan, a belépett felhasználó neve külön panelen látható.</p>
    </article>
    <article>
        <h3>Adatbázis kapcsolat</h3>
        <p>A notebookok, processzorok és operációs rendszerek kapcsolt táblákból jelennek meg.</p>
    </article>
</section>
