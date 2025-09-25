<?php

session_start();

$_SESSION['pesan'] = [
    'type' => 'success',
    'message' => 'Anda berhasil logout dari akun ' . $_SESSION['user']['nama']
];

// Session message
$flash_message = null;
if (isset($_SESSION['pesan'])) {
    $flash_message = $_SESSION['pesan'];
    unset($_SESSION['pesan']);
}

session_destroy();
// header("Location: ../login/");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link rel="stylesheet" href="../../assets/style/global.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
</head>

<body>
    <section class="message <?= $flash_message['type'] ?>" id="message-container">
        <p><?= htmlspecialchars($flash_message['message']) ?></p>
        <i class="fas fa-close" id="message-close"></i>
        <script>
            window.addEventListener('DOMContentLoaded', () => showAlert());

            // Close Icon
            const closeIcon = document.getElementById('message-close');
            const message = document.getElementById('message-container');

            closeIcon.addEventListener("click", function() {
                message.style.transform = 'translateX(-50%) translateY(-5rem)';
                message.style.opacity = 0;

                setTimeout(function() {
                    message.style.display = 'none';
                }, 1000)

                window.location.href = '../login/'
            })
            
            function showAlert() {
                message.classList.remove('hidden'); // Biar tampil di DOM
                requestAnimationFrame(() => {
                    message.classList.add('show'); // Trigger animasi
                });

                setTimeout(function() {
                    message.style.transform = 'translateX(-50%) translateY(-5rem)';
                    message.style.opacity = 0;
                    message.style.display = 'none';
                    window.location.href = '../login/'
                }, 2000);
            }
        </script>
    </section>
    <script src="../../assets/js/script.js"></script>
</body>

</html>