<?php
require_once 'koneksi.php';

$script_name = dirname($_SERVER['SCRIPT_NAME']);

$namaFolder = basename($script_name);

$explode = explode('/', trim($script_name, '/'));
$namaFolder2 = $explode[count($explode) - 2];
?>
<aside class="sidebar">
    <!-- <h1>Farm.ing</h1> -->
    <img src="<?= NM_FOLDER . "/assets/img/logo_main.png" ?>" alt="Logo Farming" class="logo">
    <div class="sidebar-nav">
        <a href="<?= NM_FOLDER . "/dashboard/admin/"; ?>" class="<?= ($namaFolder == 'admin') ? 'active' : ''; ?>">
            <i class="fas fa-house"></i>
            Dashboard
        </a>
        <a href="<?= NM_FOLDER . "/dashboard/admin/produk"; ?>" class="<?= ($namaFolder == 'produk' || $namaFolder2 == 'produk') ? 'active' : ''; ?>">
            <i class="fas fa-box"></i>
            Data Produk
        </a>
        <a href="<?= NM_FOLDER . "/dashboard/admin/gudang"; ?>" class="<?= ($namaFolder == 'gudang' || $namaFolder2 == 'gudang') ? 'active' : ''; ?>">
            <i class="fas fa-shop"></i>
            Data Gudang
        </a>
        <a href="<?= NM_FOLDER . "/dashboard/admin/pengaturan"; ?>" class="<?= ($namaFolder == 'pengaturan' || $namaFolder2 == 'pengaturan') ? 'active' : ''; ?>">
            <i class="fas fa-user"></i>
            Pengaturan Akun
        </a>
    </div>
    <div class="back">
        <a href="<?= NM_FOLDER . "/" ?>">
            <i class="fas fa-chevron-left"></i>
            Kembali
        </a>
    </div>
</aside>