<h2>Belépés és regisztráció</h2>
<p class="lead">Belépés után megjelenik a bejelentkezett felhasználó neve, és elérhetővé válik a képfeltöltés menüpont.</p>

<div class="form-grid">
    <form action="belep" method="post" class="form-card">
        <fieldset>
            <legend>Belépés</legend>

            <label for="felhasznalo">Felhasználónév</label>
            <input id="felhasznalo" type="text" name="felhasznalo" placeholder="pl. gipszelek" required>

            <label for="jelszo">Jelszó</label>
            <input id="jelszo" type="password" name="jelszo" placeholder="jelszó" required>

            <input type="submit" name="belepes" value="Belépés">
        </fieldset>
    </form>

    <form action="regisztral" method="post" class="form-card">
        <fieldset>
            <legend>Regisztráció</legend>

            <label for="vezeteknev">Vezetéknév</label>
            <input id="vezeteknev" type="text" name="vezeteknev" placeholder="pl. Gipsz" required>

            <label for="utonev">Utónév</label>
            <input id="utonev" type="text" name="utonev" placeholder="pl. Elek" required>

            <label for="regfelhasznalo">Felhasználónév</label>
            <input id="regfelhasznalo" type="text" name="felhasznalo" placeholder="pl. gipszelek" required>

            <label for="regjelszo">Jelszó</label>
            <input id="regjelszo" type="password" name="jelszo" placeholder="jelszó" required>

            <input type="submit" name="regisztracio" value="Regisztráció">
        </fieldset>
    </form>
</div>
