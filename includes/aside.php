<?php
require_once 'koneksi.php';

$script_name = dirname($_SERVER['SCRIPT_NAME']);

$namaFolder = basename($script_name);

$explode = explode('/', trim($script_name, '/'));
$namaFolder2 = $explode[count($explode) - 2];
?>
<aside class="sidebar">
    <h1>Farm.ing</h1>
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
    <div class="logout">
        <a href="<?= NM_FOLDER . "/auth/logout/" ?>">
            <i class="fas fa-right-from-bracket fa-rotate-180"></i>
            Logout
        </a>
    </div>
</aside>