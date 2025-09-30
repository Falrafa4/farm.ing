<?php
require_once '../../includes/koneksi.php';
session_start();

// Cek apakah sudah login
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['role'] == 'Admin') {
        header("Location: " . NM_FOLDER . "/dashboard/admin/");
    } else {
        header("Location: " . NM_FOLDER . "/dashboard/");
    }
}

// Handle proses register
if (isset($_POST['daftar'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . NM_FOLDER . '/functions/users.php';
    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $cek_user = ambil_user_by_email($conn, $email);
    if (!$cek_user) {
        if (tambah_user($conn, $nama, $email, $password, $no_hp, $alamat)) {
            $_SESSION['pesan'] = [
                'type' => 'success',
                'message' => 'Anda berhasil mendaftarkan akun! Silahkan login.'
            ];
        } else {
            $_SESSION['pesan'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat mendaftarkan akun! Silahkan coba lagi :('
            ];
        }
    } else {
        $_SESSION['pesan'] = [
            'type' => 'error',
            'message' => 'Email yang Anda masukkan telah terdaftar di Farm.ing. Silahkan login.'
        ];
    }
}

// flash message
$flash_message = null;
if (isset($_SESSION['pesan'])) {
    $flash_message = $_SESSION['pesan'];
    unset($_SESSION['pesan']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farm.ing - Register</title>
    <link rel="shortcut icon" href="../../assets/img/favicon.ico" type="image/x-icon">

    <!-- Global CSS -->
    <link rel="stylesheet" href="../../assets/style/global.css">

    <!-- Auth CSS -->
    <link rel="stylesheet" href="../../assets/style/auth.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
</head>
<body>
    <main class="register">
        <section class="left">
            <h1>Selamat Datang</h1>
            <img src="../../assets/img/auth-bg-2.svg" alt="Background Green" class="auth-bg">
            <img src="../../assets/img/smart-farmer.png" alt="Smart Farmer" class="farmer">
            <div class="auth-bg-hp"></div>
            <a href="../../" class="btn btn-light back">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
        </section>

        <?php if($flash_message) { ?>
        <section class="message <?= $flash_message['type'] ?>" id="message-container">
            <p><?= htmlspecialchars($flash_message['message']) ?></p>
            <i class="fas fa-close" id="message-close"></i>
            <script>
                window.addEventListener('DOMContentLoaded', () => showAlert());
            </script>   
        </section>
        <?php } ?>

        <section class="right">
            <h1>Daftar</h1>
            <form action="./" class="register" method="post">
                <div class="input-box">
                    <input type="text" name="nama" id="nama" placeholder="Nama Lengkap" required>
                </div>
                <div class="input-box"> 
                    <input type="tel" name="no_hp" id="no_hp" placeholder="No. HP" pattern="08\d{9,11}" minlength="9" maxlength="12" inputmode="numeric" title="Masukkan nomor yang dimulai 08 dan panjang 9–11 digit, tanpa spasi/tanda." required>
                </div>
                <div class="input-box">
                    <input type="text" name="alamat" id="alamat" placeholder="Alamat Lengkap" required>
                </div>
                <div class="input-box">
                    <input type="email" name="email" id="email" placeholder="Email" required>
                </div>
                <div class="input-box">
                    <input type="password" name="password" id="password" placeholder="Password" required>
                </div>

                <div class="link-group">
                    <button type="submit" name="daftar" class="btn btn-dark">Daftar</button>
                    <p>
                        Sudah punya akun? <a href="../login/">Login</a>
                    </p>
                </div>
            </form>
        </section>
    </main>
    <script src="../../assets/js/script.js"></script>
</body>
</html>