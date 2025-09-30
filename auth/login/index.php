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

// Handle proses login
$flash_message = null;
if (isset($_POST['login'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . NM_FOLDER . '/functions/users.php';
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($user = ambil_user_by_email($conn, $email)) {
        if (password_verify($password, $user['password'])) {
            // Password benar, set session
            $_SESSION['user'] = $user;

            // Redirect berdasarkan role
            if ($user['role'] === 'Admin') {
                $flash_message = [
                    "type" => "success",
                    "message" => "Selamat Datang! " . $user['nama']
                ];
                // header("Location: " . NM_FOLDER . "/dashboard/admin/");
            } else {
                $flash_message = [
                    "type" => "success",
                    "message" => "Selamat Datang! " . $user['nama']
                ];
                // header("Location: " . NM_FOLDER . "/dashboard/");
            }
        } else {
            // Password salah
            $flash_message = [
                "type" => "error",
                "message" => "Email atau password salah."
            ];
        }
    } else {
        // User tidak ditemukan
        $flash_message = [
            "type" => "error",
            "message" => "User tidak ditemukan. Silakan daftar terlebih dahulu."
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farm.ing - Login</title>
    <link rel="shortcut icon" href="../../assets/img/favicon.ico" type="image/x-icon">

    <!-- Global CSS -->
    <link rel="stylesheet" href="../../assets/style/global.css">

    <!-- Auth CSS -->
    <link rel="stylesheet" href="../../assets/style/auth.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
</head>

<body>
    <main class="login">
        <?php if ($flash_message) { ?>
            <section class="message <?= $flash_message['type'] ?>" id="message-container">
                <p><?= htmlspecialchars($flash_message['message']) ?></p>
                <i class="fas fa-close" id="message-close"></i>
                <script>
                    window.addEventListener('DOMContentLoaded', () => showAlert());

                    // Close Icon
                    const closeIcon = document.getElementById('message-close');
                    const message = document.getElementById('message-container');

                    if (closeIcon && message) {
                        closeIcon.addEventListener("click", function() {
                            message.style.transform = 'translateX(-50%) translateY(-5rem)';
                            message.style.opacity = 0;

                            setTimeout(function() {
                                message.style.display = 'none';
                            }, 1000);
                            <?php
                            if (isset($_SESSION['user']) && $_SESSION['user']):
                                if ($_SESSION['user']['role'] === 'Admin') { ?>
                                    window.location.href = "<?= NM_FOLDER ?>/dashboard/admin";
                                <?php } else { ?>
                                    window.location.href = "<?= NM_FOLDER ?>/dashboard/";
                            <?php }
                            endif; ?>
                        })
                    }

                    // Tampilkan alert
                    function showAlert() {
                        message.classList.remove('hidden'); // Biar tampil di DOM
                        requestAnimationFrame(() => {
                            message.classList.add('show'); // Trigger animasi
                        });

                        <?php if (isset($_SESSION['user']) && $_SESSION['user']): ?>
                            setTimeout(function() {
                                message.style.transform = 'translateX(-50%) translateY(-5rem)';
                                message.style.opacity = 0;
                                message.style.display = 'none';
                                <?php if ($_SESSION['user']['role'] === 'Admin') { ?>
                                    window.location.href = "<?= NM_FOLDER ?>/dashboard/admin";
                                    // console.log("gua di sini");
                                <?php } else { ?>
                                    window.location.href = "<?= NM_FOLDER ?>/dashboard/";
                                <?php } ?>
                            }, 2000);
                        <?php endif; ?>
                    }
                </script>
            </section>
        <?php } ?>

        <section class="left">
            <h1>Selamat Datang Kembali</h1>
            <img src="../../assets/img/auth-bg-2.svg" alt="Background Green" class="auth-bg">
            <div class="auth-bg-hp">
            <img src="../../assets/img/smart-farmer.png" alt="Smart Farmer" class="farmer">
            <a href="../../" class="btn btn-light back">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
        </section>

        <section class="right">
            <h1>Login</h1>
            <form action="./" class="login" method="post">
                <div class="input-box">
                    <input type="email" name="email" id="email" placeholder="Email" required>
                </div>
                <div class="input-box">
                    <input type="password" name="password" id="password" placeholder="Password" required>
                </div>

                <div class="link-group">
                    <button type="submit" name="login" class="btn btn-dark">Login</button>
                    <p>
                        Belum punya akun? <a href="../register/">Daftar</a>
                    </p>
                </div>
            </form>
        </section>
    </main>
</body>

</html>