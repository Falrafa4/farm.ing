<?php
session_start();
require_once '../includes/koneksi.php'; 
require_once '../includes/user/session_user.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farm.ing - Dashboard</title>
    <link rel="shortcut icon" href="../assets/img/favicon.ico" type="image/x-icon">
    
    <!-- Global CSS -->
    <link rel="stylesheet" href="../assets/style/global.css">

    <!-- Dashboard CSS -->
    <link rel="stylesheet" href="../assets/style/dashboard.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    <style>
        main .main .heading .heading-body h1 {
            width: 65%;
        }
    </style>
</head>
<body>
    <main class="home">
        <?php require_once '../includes/user/aside.php'; ?>

        <div class="main">
            <section class="heading">
                <h1 class="heading-head">Dashboard</h1>
                <div class="heading-body">
                    <h1>Welcome,<br> <?= $_SESSION['user']['nama'] ?></h1>
                    <!-- <p><?= $_SESSION['user']['nama'] ?></p> -->
                    <img src="../assets/img/smart-farmer.png" alt="">
                </div>
            </section>

            
        </div>
    </main>
</body>
</html>