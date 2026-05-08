<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$DB_HOST = 'localhost';
$DB_NAME = 'u4bkst';
$DB_USER = 'u4bkst';
$DB_PASS = 'U4BKST2026WEB';

function getDb(): PDO
{
    global $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS;

    $dsn = "mysql:host={$DB_HOST};dbname={$DB_NAME};charset=utf8mb4";
    return new PDO($dsn, $DB_USER, $DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
}

$ablakcim = [
    'cim' => 'ReNew Notebook Webáruház',
    'motto' => 'Felújított notebookok kedvező áron'
];

$fejlec = [
    'kepforras' => 'logo.png',
    'kepalt' => 'ReNew logo',
    'cim' => 'ReNew Notebook',
    'motto' => 'Reszponzív PHP beadandó front-controller mintával'
];

$lablec = [
    'copyright' => 'Copyright ' . date('Y') . '.',
    'ceg' => 'ReNew Kft. | Farkas Tamás PLPJEB, Fodor Árpád U4BKST'
];

$oldalak = [
    'cimlap' => [
        'fajl' => 'cimlap',
        'szoveg' => 'Címlap',
        'menun' => [1, 1]
    ],

    'tablazat' => [
        'fajl' => 'tablazat',
        'szoveg' => 'Notebookok',
        'menun' => [1, 1]
    ],

    'kepek' => [
        'fajl' => 'kepek',
        'szoveg' => 'Képfeltöltés',
        'menun' => [0, 1]
    ],

    'kapcsolat' => [
        'fajl' => 'kapcsolat',
        'szoveg' => 'Kapcsolat',
        'menun' => [1, 1]
    ],

    'uzenetek' => [
        'fajl' => 'uzenetek',
        'szoveg' => 'Üzenetek',
        'menun' => [0, 1]
    ],

    'belepes' => [
        'fajl' => 'belepes',
        'szoveg' => 'Belépés',
        'menun' => [1, 0]
    ],

    'kilepes' => [
        'fajl' => 'kilepes',
        'szoveg' => 'Kilépés',
        'menun' => [0, 1]
    ],

    'belep' => [
        'fajl' => 'belep',
        'szoveg' => '',
        'menun' => [0, 0]
    ],

    'regisztral' => [
        'fajl' => 'regisztral',
        'szoveg' => '',
        'menun' => [0, 0]
    ],
];

$hiba_oldal = [
    'fajl' => '404',
    'szoveg' => 'A keresett oldal nem található!'
];