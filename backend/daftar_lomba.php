<?php
session_start();
include __DIR__ . '/../config/database.php';

$id_user = isset($_POST['id_user'])? $_POST['id_user'] : $_SESSION['id_user'];
$id_kategori = $_POST['id_kategori'];

// Cek apakah sudah daftar
$cek = $conn->query("SELECT * FROM pendaftaran WHERE id_user='$id_user'");
if ($cek->num_rows > 0) {
    echo "<script>alert('Kamu sudah terdaftar di lomba!'); window.location='../pages/dashboard.php';</script>";
    exit;
}

// Tambahkan pendaftaran
$sql = "INSERT INTO pendaftaran (id_user, id_kategori, status_daftar)
        VALUES ('$id_user', '$id_kategori', 'Menunggu')";
if ($conn->query($sql)) {
    echo "<script>alert('Pendaftaran berhasil! Menunggu verifikasi admin.'); window.location='../pages/dashboard.php';</script>";
} else {
   die('Query error: ' . $conn->error);
}
?>
