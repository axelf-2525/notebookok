<?php
if (file_exists('./logicals/' . $keres['fajl'] . '.php')) {
    include './logicals/' . $keres['fajl'] . '.php';
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($ablakcim['cim']) ?></title>
    <link rel="stylesheet" href="./styles/stilus.css" type="text/css">
    <?php if (file_exists('./styles/' . $keres['fajl'] . '.css')) { ?>
        <link rel="stylesheet" href="./styles/<?= htmlspecialchars($keres['fajl']) ?>.css" type="text/css">
    <?php } ?>
</head>
<body>
    <div class="page-shell">
        <input type="checkbox" id="menu-toggle" class="menu-toggle">

        <header class="site-header">
            <div class="brand">
                <img src="./images/<?= htmlspecialchars($fejlec['kepforras']) ?>" alt="<?= htmlspecialchars($fejlec['kepalt']) ?>">
                <div>
                    <h1><?= htmlspecialchars($fejlec['cim']) ?></h1>
                    <?php if (isset($fejlec['motto'])) { ?>
                        <p><?= htmlspecialchars($fejlec['motto']) ?></p>
                    <?php } ?>
                </div>
            </div>

            <label for="menu-toggle" class="hamburger" aria-label="Menü megnyitása">
                <span></span>
                <span></span>
                <span></span>
            </label>
        </header>

        <div id="wrapper" class="layout">
            <aside id="nav" class="sidebar">
                <nav>
                    <h2>Menü</h2>
                    <ul>
                        <?php foreach ($oldalak as $url => $oldal) { ?>
                            <?php if ((!isset($_SESSION['login']) && $oldal['menun'][0]) || (isset($_SESSION['login']) && $oldal['menun'][1])) { ?>
                                <li<?= (($oldal == $keres) ? ' class="active"' : '') ?>>
                                    <a href="<?= ($url === 'cimlap') ? '.' : htmlspecialchars($url) ?>">
                                        <?= htmlspecialchars($oldal['szoveg']) ?>
                                    </a>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </nav>

                <?php if (isset($_SESSION['login'])) { ?>
                    <fieldset class="user-panel">
                        <legend>Felhasználó</legend>
                        <span>Bejelentkezett felhasználó:</span>
                        <strong><?= htmlspecialchars($_SESSION['csn'] . ' ' . $_SESSION['un']) ?></strong>
                        <small><?= htmlspecialchars($_SESSION['login']) ?></small>
                        <a href="kilepes" class="logout-link">[ Kilépés ]</a>
                    </fieldset>
                <?php } ?>
            </aside>

            <main id="content" class="content-card">
                <?php include './templates/pages/' . $keres['fajl'] . '.tpl.php'; ?>
            </main>
        </div>

        <footer class="site-footer">
            <?php if (isset($lablec['copyright'])) { ?>&copy;&nbsp;<?= htmlspecialchars($lablec['copyright']) ?> <?php } ?>
            <?php if (isset($lablec['ceg'])) { ?><?= htmlspecialchars($lablec['ceg']) ?><?php } ?>
        </footer>
    </div>
</body>
</html>
