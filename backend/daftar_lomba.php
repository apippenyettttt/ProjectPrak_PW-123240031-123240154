<?php
session_start();
include __DIR__ . '/../config/database.php';

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'user') {
    header("Location: ../pages/login.php");
    exit();
}

if (empty($_POST['id_user']) || empty($_POST['id_kategori'])) {
    echo "<script>alert('Data tidak lengkap!'); window.location='../pages/dashboard.php';</script>";
    exit();
}

$id_user = $conn->real_escape_string($_POST['id_user']);
$id_kategori = $conn->real_escape_string($_POST['id_kategori']);

$cek = $conn->query("SELECT * FROM pendaftaran WHERE id_user='$id_user' AND id_kategori='$id_kategori'");
if ($cek->num_rows > 0) {
    echo "<script>alert('Anda sudah mendaftar kategori ini!'); window.location='../pages/dashboard.php';</script>";
    exit();
}

// Simpan pendaftaran
$sql = "INSERT INTO pendaftaran (id_user, id_kategori, status_daftar) 
        VALUES ('$id_user', '$id_kategori', 'Menunggu')";
        
if ($conn->query($sql)) {
    echo "<script>alert('Pendaftaran berhasil! Menunggu verifikasi admin.'); window.location='../pages/dashboard.php';</script>";
} else {
    echo "<script>alert('Terjadi kesalahan sistem. Silakan coba lagi.'); window.location='../pages/dashboard.php';</script>";
}
?>