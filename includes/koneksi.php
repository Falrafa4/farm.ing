<?php
define('NM_FOLDER', '/farm.ing');

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'db_farming';

$conn = new mysqli($host, $user, $pass, $db);

if (!$conn) {
    die('Koneksi gagal :(, error: ' . mysqli_error($conn));
}