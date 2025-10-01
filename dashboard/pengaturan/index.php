<?php
session_start();
require_once '../../includes/koneksi.php'; 
require_once '../../includes/user/session_user.php';
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
    <main class="pengaturan">
        <?php require_once '../../includes/user/aside.php'; ?>

        <div class="main">
            <section class="heading">
                <h1 class="heading-head">Profil Anda</h1>
                <div class="heading-body">
                    <img src="../../assets/img/profile.png" class="profile" alt="Blank Profile">
                    <div class="profile-info">
                        <h2><?= $_SESSION['user']['nama'] ?></h2>
                        <p>&ndash; <?= $_SESSION['user']['role'] ?></p>
                    </div>
                </div>
            </section>
            <section class="heading profil">
                <div class="heading-body">
                    <div class="data-top">
                        <div class="input-box">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" readonly value="<?= $_SESSION['user']['email'] ?>">
                        </div>
                        <div class="input-box">
                            <label for="no_hp">No. HP</label>
                            <input type="text" name="no_hp" id="no_hp" readonly value="<?= $_SESSION['user']['no_telp'] ?>">
                        </div>
                    </div>
                    <div class="data-bottom">
                        <div class="input-box">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" readonly><?= $_SESSION['user']['alamat'] ?></textarea>
                        </div>
                    </div>
                    <a href="#" class="btn btn-light">
                        <i class="fas fa-pen-to-square"></i>
                        Edit
                    </a>
                </div>
            </section>
            <div class="logout">
                <a href="../../auth/logout/" class="btn btn-crud-dark logout-button">
                    Logout
                    <i class="fas fa-right-from-bracket"></i>
                </a>
            </div>
        </div>
    </main>
</body>
</html>