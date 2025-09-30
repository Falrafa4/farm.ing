<?php

function ambil_user_by_email($conn, $email)
{
    $query = 'SELECT * FROM user WHERE email = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    $stmt->close();

    // jika data null, return false
    return $data ?: false;
}

function tambah_user($conn, $nama, $email, $password, $no_telp, $alamat) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = 'INSERT INTO user (nama, email, password, no_telp, alamat) VALUES (?, ?, ?, ?, ?)';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssss', $nama, $email, $hashed_password, $no_telp, $alamat);

    $result = $stmt->execute();
    $stmt->close();
    return $result;
}