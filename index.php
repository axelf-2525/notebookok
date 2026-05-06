<?php
require_once './includes/config.inc.php';

$oldal = 'cimlap';

if (isset($_GET['oldal']) && trim($_GET['oldal']) !== '') {
    $oldal = trim($_GET['oldal'], '/');
}

if (isset($oldalak[$oldal]) && file_exists('./templates/pages/' . $oldalak[$oldal]['fajl'] . '.tpl.php')) {
    $keres = $oldalak[$oldal];
} else {
    $keres = $hiba_oldal;
    header('HTTP/1.0 404 Not Found');
}

require './templates/index.tpl.php';
