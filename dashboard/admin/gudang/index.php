<?php
require_once '../../../includes/koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farm.ing - Dashboard</title>

    <!-- Global CSS -->
    <link rel="stylesheet" href="../../../assets/style/global.css">

    <!-- Dashboard CSS -->
    <link rel="stylesheet" href="../../../assets/style/dashboard.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    <style>
        .under-construction {
            margin: 3rem auto;
            padding: 2rem 2rem 2.5rem 2rem;
            max-width: 50%;
            background: #f3fffa;
            border: 2px dashed #265548;
            border-radius: 24px;
            text-align: center;
        }

        .under-construction i {
            font-size: 3rem;
            color: #265548;
            margin-bottom: 1rem;
        }

        .under-construction h2 {
            margin: 0.5rem 0 1rem 0;
            color: #265548;
            font-size: 1.5rem;
        }

        .under-construction p {
            color: #265548;
            font-size: 1.1rem;
        }
    </style>
</head>

<body>
    <main class="home">
        <?php require_once '../../../includes/aside.php'; ?>

        <div class="main">
            <!-- Pages Under Construction -->
            <section class="under-construction">
                <i class="fas fa-tools"></i>
                <h2>Halaman Sedang Dalam Pengembangan</h2>
                <p>Maaf, halaman ini sedang dalam proses pembangunan.<br>Doakan kami lolos ke babak final.</p>
                <br>
                <em>- Hmm.dev -</em>
            </section>
        </div>
    </main>
</body>

</html>