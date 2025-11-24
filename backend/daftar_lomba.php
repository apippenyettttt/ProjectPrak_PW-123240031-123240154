<?php
session_start();
include __DIR__ . '/../config/database.php';

// Cek login & role
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'user') {
    header("Location: ../pages/login.php");
    exit();
}

// Cek data POST
if (empty($_POST['id_user']) || empty($_POST['id_kategori'])) {
    echo "<script>alert('Data tidak lengkap!'); window.location='../pages/dashboard.php';</script>";
    exit();
}

$id_user = $conn->real_escape_string($_POST['id_user']);
$id_kategori = $conn->real_escape_string($_POST['id_kategori']);

// Cek apakah user sudah daftar kategori apapun
$cek = $conn->query("SELECT * FROM pendaftaran WHERE id_user='$id_user'");
if ($cek->num_rows > 0) {
    echo "<script>alert('Anda sudah mendaftar kategori!'); window.location='../pages/dashboard.php';</script>";
    exit();
}

// Simpan pendaftaran
$sql = "INSERT INTO pendaftaran (id_user, id_kategori, status_daftar) 
        VALUES ('$id_user', '$id_kategori', 'Menunggu')";

if ($conn->query($sql)) {
    // Ambil id pendaftaran terakhir untuk pembayaran
    $id_pendaftaran = $conn->insert_id;
    echo "<script>
            alert('Pendaftaran berhasil! Silakan lanjut ke pembayaran.');
            window.location='../pages/pembayaran.php?id_pendaftaran=$id_pendaftaran';
          </script>";
} else {
    echo "<script>
            alert('Terjadi kesalahan sistem. Silakan coba lagi.');
            window.location='../pages/dashboard.php';
          </script>";
}
?>