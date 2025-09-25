<?php 
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farm.ing</title>

    <!-- Global CSS -->
    <link rel="stylesheet" href="assets/style/global.css">

    <!-- Style CSS -->
    <link rel="stylesheet" href="assets/style/style.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
</head>
<body>
    <nav>
        <h1>Farm.ing</h1>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">About</a></li>
            <?php if(isset($_SESSION['user'])): ?>
            <div class="user-login">
                <i class="fas fa-user-circle fa-xl"></i>
                <!-- <p><?= $_SESSION['user']['nama'] ?></p> -->
            </div>
            <div class="dropdown">
                <li><a href="dashboard/<?= $_SESSION['user']['role'] == 'Admin' ? 'admin/' : '' ?>" role="button">Dashboard</a></li>
                <li><a href="dashboard/<?= $_SESSION['user']['role'] == 'Admin' ? 'admin/pengaturan/' : 'pengaturan/' ?>" role="button">Akun Saya</a></li>
            </div>
            <?php else: ?>
            <div class="auth">
                <li><a class="btn-crud" href="auth/login/" role="button">Login</a></li>
                <li><a class="btn-crud-2" href="auth/register/" role="button">Register</a></li>
            </div>
            <?php endif; ?>
        </ul>
    </nav>

    <header>
        <div class="hero">
            <p>Selamat Datang</p>
            <h1 class="hero-title">Petani Pintar!</h1>
            <a href="#pengertian" class="btn btn-light" role="button">Selengkapnya</a>
        </div>
    </header>

    <main>
        <section class="pengertian" id="pengertian">
            <div class="light-bg"></div>
            <div class="dark-bg">
                <h2>Apa itu Farm.ing?</h2>
                <p>Farm.ing adalah sebuah platform yang memungkinkan para pengguna melakukan transaksi terhadap produk-produk yang berkaitan dengan usaha pertanian secara online.</p>
                <a href="dashboard/" class="btn btn-light">Beli Sekarang</a>
            </div>
            <div class="image">
                <img src="assets/img/padi.png" alt="Padi" class="img-rice">
            </div>
        </section>

        <section class="produk">
            <h1>Produk Kami</h1>
            <div class="card-container">
                <div class="card">
                    <img src="assets/img/sayur.png" alt="Sayur">
                    <p>Sayur</p>
                </div>
                <div class="card">
                    <img src="assets/img/buah.png" alt="Buah">
                    <p>Buah</p>
                </div>
                <div class="card">
                    <img src="assets/img/alat_tani.png" alt="Alat Tani">
                    <p>Alat Tani</p>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-top">
            <div class="footer-left">
                <h1>Farm.ing</h1>
                <div class="social-media">
                    <i class="fab fa-facebook"></i>
                    <i class="fab fa-youtube"></i>
                    <i class="fab fa-instagram"></i>
                </div>
            </div>
            <div class="footer-right">
                <div class="contact-us">
                    <h3>Kontak Kami</h3>
                    <p>WhatsApp: +62 812-3456-7890</p>
                    <p>Email: farming@gmail.com</p>
                </div>
                <div class="pages">
                    <h3>Halaman</h3>
                    <a href="#">Home</a>
                    <a href="#">About</a>
                    <a href="#">Produk</a>
                </div>
                <div class="legal">
                    <h3>I-Legal</h3>
                    <a href="#">Kebijakan Privasi</a>
                    <a href="#">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2025 Farm.ing. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>