<?php
session_start();
require_once '../../../includes/koneksi.php';
require_once '../../../includes/session_admin.php';

$query_get = 'SELECT produk.*, kategori.nama_kategori as kategori FROM produk JOIN kategori ON produk.id_kategori = kategori.id_kategori';
$result = $conn->query($query_get);

// Session message
$flash_message = null;
if (isset($_SESSION['pesan'])) {
    $flash_message = $_SESSION['pesan'];
    unset($_SESSION['pesan']);
}

if (isset($_GET['delete'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . NM_FOLDER . '/functions/products.php';
    $id_produk = $_GET['delete'];
    $produk = ambil_produk_by_id($conn, $id_produk);
    
    if ($produk) {
        $result = hapus_produk($conn, $id_produk);
        if ($result) {
            $_SESSION['pesan'] = [
                'type' => 'success',
                'message' => 'Data ' . $produk['nama'] . ' Berhasil Dihapus'
            ];
        } else {
            $_SESSION['pesan'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat menghapus data!'
            ];
        }
    } else {
            $_SESSION['pesan'] = [
                'type' => 'error',
                'message' => 'Data dengan ID Produk ' . $id_produk . ' Tidak Ditemukan!'
            ];
        }
        header("Location: ./");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farm.ing - Dashboard</title>
    <link rel="shortcut icon" href="../../../assets/img/favicon.ico" type="image/x-icon">
    
    <!-- Global CSS -->
    <link rel="stylesheet" href="../../../assets/style/global.css">

    <!-- Dashboard CSS -->
    <link rel="stylesheet" href="../../../assets/style/dashboard.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
</head>
<body>
    <main class="crud produk">
        <?php require_once '../../../includes/aside.php'; ?>

        <div class="main">
            <section class="heading">
                <div class="heading-body">
                    <h1>Data Produk</h1>
                    <form action="./" method="post" class="search-bar">
                        <input type="text" name="search_keyword" id="search_keyword" placeholder="Cari Produk...">
                        <button type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                    <img src="../../../assets/img/dash-produk.png" alt="">
                </div>
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

            <!-- <section class="confirm" id="popup-confirm">
                <p>Apakah Anda yakin ingin menghapus data ini?</p>
                <button id></button>
            </section> -->

            <section class="view-data">
                <a href="kelola/" class="btn btn-crud-dark">
                    <i class="fas fa-plus"></i>
                    Tambah Produk
                </a>

                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        while ($row = $result->fetch_assoc()) { 
                            // Format harga ke format Rupiah
                            $formatted_harga = 'Rp ' . number_format($row['harga'], 0, ',', '.');
                        ?>
                        <tr>
                            <td><?= $row['id_produk'] ?></td>
                            <td><?= $row['nama'] ?></td>
                            <td><?= $row['kategori'] ?></td>
                            <td><?= $row['stok'] ?></td>
                            <td><?= $formatted_harga ?></td>
                            <td class="img-produk">
                                <img src="../../../uploads/<?= $row['gambar'] ?>" alt="">
                            </td>
                            <td class="aksi">
                                <a href="kelola/?id=<?= $row['id_produk'] ?>" class="btn btn-crud-dark">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="?delete=<?= $row['id_produk'] ?>" data-id="<?= $row['id_produk'] ?>" class="btn btn-crud-dark crud-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php }
                        if ($result->num_rows == 0) {
                            echo '<tr><td colspan="7" style="text-align: center; font-style: italic; padding: 2rem;">Tidak ada data produk.</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </section>
        </div>
    </main>
    <script>
        // Confirm delete
        // const deleteBtn = document.querySelectorAll('.crud-delete');
        // deleteBtn.forEach(button => {
        //     button.addEventListener('click', function(e) {
        //         e.preventDefault();

        //         const id = this.dataset.id;
        //         console.log(id);
        //     })
        // });
    </script>
    <script src="../../../assets/js/script.js"></script>
</body>
</html>