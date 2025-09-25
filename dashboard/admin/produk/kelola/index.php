<?php
session_start();
require_once '../../../../includes/koneksi.php';

$id_produk = '';
$nama = '';
$id_kategori = '';
$stok = '';
$harga = '';
$gambar = '';

if (isset($_POST['tambah_produk'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . NM_FOLDER . '/functions/products.php';
    $nama = $_POST['nama'];
    $id_kategori = $_POST['id_kategori'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    // Insert data ke database
    if (tambah_produk($conn, $nama, $id_kategori, $harga, $stok, $_FILES['gambar'])) {
        // Redirect ke halaman utama produk setelah berhasil menambah
        header("Location: ../");
        $_SESSION['pesan'] = [
            'type' => 'success',
            'message' => "Data Produk " . $nama . " Berhasil Ditambahkan!"
        ];
        exit();
    } else {
        $_SESSION['pesan'] = [
            'type' => 'error',
            'message' => "Data Produk " . $nama . " Gagal Ditambahkan :("
        ];
    }
}

if (isset($_POST['update_produk'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . NM_FOLDER . '/functions/products.php';
    $id_produk = $_POST['id_produk'];
    $nama = $_POST['nama'];
    $id_kategori = $_POST['id_kategori'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    // Update data produk
    if (update_produk($conn, $id_produk, $nama, $id_kategori, $harga, $stok, $_FILES['gambar'])) {
        header("Location: ../");
        $_SESSION['pesan'] = [
            'type' => 'success',
            'message' => "Data Produk " . $nama . " Berhasil Diubah!"
        ];
        exit();
    } else {
        $_SESSION['pesan'] = [
            'type' => 'error',
            'message' => "Data Produk " . $nama . " Gagal Diubah :("
        ];
    }
}

if (isset($_GET['id'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . NM_FOLDER . '/functions/products.php';

    $id = $_GET['id'];
    $produk = ambil_produk_by_id($conn, $id);

    if ($produk) {
        $id_produk = $produk['id_produk'];
        $nama = $produk['nama'];
        $id_kategori = $produk['id_kategori'];
        $stok = $produk['stok'];
        $harga = $produk['harga'];
        $gambar = $produk['gambar'];
    } else {
        echo "<script>alert('Produk Tidak Ditemukan. Harap masukkan ID yang tepat!'); window.location.href='../'</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farm.ing - Dashboard</title>

    <!-- Global CSS -->
    <link rel="stylesheet" href="../../../../assets/style/global.css">

    <!-- Dashboard CSS -->
    <link rel="stylesheet" href="../../../../assets/style/dashboard.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
</head>

<body>
    <main class="crud produk">
        <?php require_once '../../../../includes/aside.php'; ?>

        <div class="main">
            <section class="kelola">
                <h2><?= isset($_GET['id']) ? 'Edit' : 'Tambah' ?> Produk</h2>
                <hr>
                <form action="./" method="post" enctype="multipart/form-data">
                    <?php if(isset($_GET['id'])) { ?>
                        <input type="text" name="id_produk" id="id_produk" value="<?= htmlspecialchars($id_produk) ?>" hidden>
                    <?php } ?>
                    <div class="input-box">
                        <label for="nama" class="input-label">Nama Produk</label>
                        <input type="text" name="nama" id="nama" placeholder="ex: Sawi" value="<?= htmlspecialchars($nama) ?>" required>
                    </div>
                    <div class="input-box">
                        <label for="kategori" class="input-label">Kategori</label>
                        <select class="input-select" name="id_kategori" id="kategori" required>
                            <option value="" disabled <?= !isset($_GET['id']) ? 'selected' : '' ?>>-- Pilih Kategori --</option>
                            <?php
                            $query_kategori = 'SELECT * FROM kategori';
                            $result_kategori = $conn->query($query_kategori);
                            while ($row_kategori = $result_kategori->fetch_assoc()) {
                            ?>
                                <option value="<?= $row_kategori['id_kategori']; ?>" <?php $id_kategori == $row_kategori['id_kategori'] ? 'selected' : '' ?>>
                                    <?= $row_kategori['nama_kategori']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="input-box">
                        <label for="harga" class="input-label">Harga</label>
                        <input type="text" name="harga" id="harga" placeholder="ex: 15000" value="<?= htmlspecialchars($harga) ?>" required>
                    </div>
                    <div class="input-box">
                        <label for="stok" class="input-label">Stok</label>
                        <input type="number" name="stok" id="stok" placeholder="ex: 100" value="<?= htmlspecialchars($stok) ?>" required>
                    </div>
                    <div class="input-box">
                        <p class="input-label"><?= isset($_GET['id']) ? 'Gambar Baru (Opsional):' : 'Gambar:' ?></p>
                        <label class="drop-area" id="drop-area" for="gambar">
                            <input type="file" accept=".png, .jpg, .jpeg, .pdf" name="gambar" id="gambar" <?= !isset($_GET['id']) ? 'required' : '' ?> hidden>
                            <div id="img-view">
                                <i class="fas fa-cloud-arrow-up"></i>
                                <p>Drag and Drop Here</p>
                                <p>or</p>
                                <p class="browse-files">Browse Files</p>
                            </div>
                        </label>
                        <p>Accepted File Types: .png, jpeg, pdf</p>
                    </div>
                    <div class="btn-group">
                        <a href="../" class="btn btn-light">
                            <i class="fas fa-arrow-left"></i>
                            Kembali
                        </a>
                        <?php
                        if (isset($_GET['id'])){
                        ?>
                        <button type="submit" name="update_produk" class="btn btn-light">
                            <i class="fas fa-floppy-disk"></i>
                            Simpan Produk
                        </button>
                        <?php } else { ?>
                        <button type="submit" name="tambah_produk" class="btn btn-light">
                            <i class="fas fa-plus"></i>
                            Tambah Produk
                        </button>
                        <?php } ?>
                    </div>
                </form>
            </section>
        </div>
    </main>
    <script src="<?= NM_FOLDER . '/assets/js/script.js' ?>"></script>
</body>

</html>