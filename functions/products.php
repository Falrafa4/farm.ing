<?php

function ambil_produk_by_id($conn, $id)
{
    $query = 'SELECT * FROM produk WHERE id_produk = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();

    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    $stmt->close();

    // jika data null, return false
    return $data ?: false;
}

function tambah_produk($conn, $nama, $id_kategori, $harga, $stok, $file_gambar)
{
    $split_gambar = explode('.', $file_gambar['name']);
    $ext_gambar = $split_gambar[count($split_gambar) - 1];
    $nama_gambar = time() . '.' . $ext_gambar;

    $from = $file_gambar['tmp_name'];
    $to = $_SERVER['DOCUMENT_ROOT'] . NM_FOLDER . '/uploads/' . $nama_gambar;

    if (move_uploaded_file($from, $to)) {
        $query = 'INSERT INTO produk (nama, id_kategori, harga, stok, gambar) VALUES (?, ?, ?, ?, ?)';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('siiis', $nama, $id_kategori, $harga, $stok, $nama_gambar);

        $result = $stmt->execute();
        $stmt->close();
        return $result;
    } else {
        return false;
    }
}

function update_produk($conn, $id_produk, $nama, $id_kategori, $harga, $stok, $file_gambar)
{
    // get produk untuk ambil nama gambar
    $produk = ambil_produk_by_id($conn, $id_produk);
    $nama_gambar = $produk['gambar'];
    // var_dump($produk);
    // die();

    if ($file_gambar['name'] != '') {
        $split_gambar = explode('.', $file_gambar['name']);
        $ext_gambar = end($split_gambar);
        $nama_gambar = time() . '.' . $ext_gambar;

        $from = $file_gambar['tmp_name'];
        $to = $_SERVER['DOCUMENT_ROOT'] . NM_FOLDER . '/uploads/' . $nama_gambar;

        // hapus file gambar kalau ada
        if (!empty($produk['gambar']) && file_exists($_SERVER['DOCUMENT_ROOT'] . NM_FOLDER . '/uploads/' . $produk['gambar'])) {
            // var_dump($_SERVER['DOCUMENT_ROOT'] . NM_FOLDER . '/uploads/' . $produk['gambar']);
            // die();
            unlink($_SERVER['DOCUMENT_ROOT'] . NM_FOLDER . '/uploads/' . $produk['gambar']);
        }


        // coba upload/pindahin file gambar
        if (!move_uploaded_file($from, $to)) {
            return false;
        }
    }

    $query = "UPDATE produk SET nama=?, id_kategori=?, harga=?, stok=?, gambar=? WHERE id_produk=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('siiisi', $nama, $id_kategori, $harga, $stok, $nama_gambar, $id_produk);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}

function hapus_produk($conn, $id_produk) {
    $query = 'DELETE FROM produk WHERE id_produk = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id_produk);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}

function cari_produk($conn, $keyword) {
    $query = "SELECT produk.*, kategori.nama_kategori AS kategori
            FROM produk
            JOIN kategori ON produk.id_kategori = kategori.id_kategori
            WHERE produk.nama LIKE ? 
               OR produk.id_kategori LIKE ? 
               OR produk.stok LIKE ? 
               OR produk.harga LIKE ?";

    $stmt = $conn->prepare($query);

    $param = "%".$keyword."%";
    $stmt->bind_param("ssss", $param, $param, $param, $param);

    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    
    return $result;
}