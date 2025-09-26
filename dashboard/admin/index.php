<?php
require_once '../../includes/koneksi.php'; 
require_once '../../includes/session_admin.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farm.ing - Dashboard</title>
    <link rel="shortcut icon" href="../../assets/img/favicon.ico" type="image/x-icon">
    
    <!-- Global CSS -->
    <link rel="stylesheet" href="../../assets/style/global.css">

    <!-- Dashboard CSS -->
    <link rel="stylesheet" href="../../assets/style/dashboard.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
</head>
<body>
    <main class="home">
        <?php require_once '../../includes/aside.php'; ?>

        <div class="main">
            <section class="heading">
                <h1 class="heading-head">Dashboard Admin</h1>
                <div class="heading-body">
                    <h1>Welcome, Smart Farmer!</h1>
                    <img src="../../assets/img/smart-farmer.png" alt="">
                </div>
            </section>

            <section class="options">
                <div class="option produk">
                    <a href="produk/" class="option-desc">
                        <p>Kelola Produk</p>
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
                <div class="option gudang">
                    <a href="gudang/" class="option-desc">
                        <p>Kelola Gudang</p>
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
            </section>
        </div>
    </main>
</body>
</html>