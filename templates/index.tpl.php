<?php
if (file_exists('./logicals/' . $keres['fajl'] . '.php')) {
    include './logicals/' . $keres['fajl'] . '.php';
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($ablakcim['cim']) ?></title>

    <link rel="stylesheet" href="./styles/stilus.css" type="text/css">

    <?php if (file_exists('./styles/' . $keres['fajl'] . '.css')) { ?>
        <link rel="stylesheet" href="./styles/<?= htmlspecialchars($keres['fajl']) ?>.css" type="text/css">
    <?php } ?>
</head>

<body>
    <div class="page-shell">

        <header class="site-header">
            <div class="brand">
                <img src="./images/<?= htmlspecialchars($fejlec['kepforras']) ?>" 
                     alt="<?= htmlspecialchars($fejlec['kepalt']) ?>">

                <div>
                    <h1><?= htmlspecialchars($fejlec['cim']) ?></h1>

                    <?php if (isset($fejlec['motto'])) { ?>
                        <p><?= htmlspecialchars($fejlec['motto']) ?></p>
                    <?php } ?>

                    <?php if (isset($_SESSION['login'])) { ?>
                        <div class="logged-user">
                            Bejelentkezett:
                            <strong>
                                <?= htmlspecialchars($_SESSION['csn'] . ' ' . $_SESSION['un'] . ' (' . $_SESSION['login'] . ')') ?>
                            </strong>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </header>

        <nav class="topnav">
            <button
                type="button"
                class="menu-toggle"
                onclick="document.body.classList.toggle('menu-open'); this.setAttribute('aria-expanded', document.body.classList.contains('menu-open') ? 'true' : 'false');"
                aria-expanded="false"
                aria-controls="main-menu"
            >
                ☰ Menü
            </button>

            <ul id="main-menu">
                <?php foreach ($oldalak as $url => $oldal) { ?>
                    <?php if ((!isset($_SESSION['login']) && $oldal['menun'][0]) || (isset($_SESSION['login']) && $oldal['menun'][1])) { ?>
                        <li<?= (($oldal == $keres) ? ' class="active"' : '') ?>>
                            <a href="<?= ($url == '/') ? '.' : htmlspecialchars($url) ?>">
                                <?= htmlspecialchars($oldal['szoveg']) ?>
                            </a>
                        </li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </nav>

        <div id="wrapper">
            <main id="content" class="content-card">
                <?php include './templates/pages/' . $keres['fajl'] . '.tpl.php'; ?>
            </main>
        </div>

        <footer class="site-footer">
            <?php if (isset($lablec['copyright'])) { ?>
                &copy;&nbsp;<?= htmlspecialchars($lablec['copyright']) ?>
            <?php } ?>

            <?php if (isset($lablec['ceg'])) { ?>
                <?= htmlspecialchars($lablec['ceg']) ?>
            <?php } ?>
        </footer>

    </div>
</body>
</html>