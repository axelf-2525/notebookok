<?php
include('./includes/config.inc.php');

// Alapértelmezett oldal
$oldal = 'cimlap';

// Ha van GET paraméter
if (isset($_GET['oldal']) && $_GET['oldal'] != '') {
    $oldal = $_GET['oldal'];
}

// Létezik-e az oldal?
if (isset($oldalak[$oldal]) && 
    file_exists("./templates/pages/" . $oldalak[$oldal]['fajl'] . ".tpl.php")) {

    $keres = $oldalak[$oldal];

} else {
    $keres = $hiba_oldal;
    header("HTTP/1.0 404 Not Found");
}

// Template betöltése 
include('./templates/index.tpl.php');
?>