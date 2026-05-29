<?php
// config/database.php

define('DB_HOST', 'localhost');
define('DB_USER', '9010MA_www_sb');
define('DB_PASS', '33vUfSoqkauKAz4Q');
define('DB_NAME', '9010MA_www_sbucher_ch');

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $e) {
    die("Datenbankverbindung fehlgeschlagen: " . $e->getMessage());
}
