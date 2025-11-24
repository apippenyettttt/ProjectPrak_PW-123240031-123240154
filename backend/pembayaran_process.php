<?php
session_start();
include __DIR__.'/../config/database.php';

if(!isset($_SESSION['id_user'])) header("Location: ../pages/login.php");

$id_pendaftaran = $_POST['id_pendaftaran'];
$jumlah_bayar = $_POST['jumlah_bayar'];
$metode_bayar = $_POST['metode_bayar'];

// Cek apakah sudah bayar
$cek = $conn->query("SELECT * FROM pembayaran WHERE id_pendaftaran='$id_pendaftaran'");
if($cek->num_rows>0){
    echo "<script>alert('Pembayaran sudah dilakukan!'); window.location='../pages/dashboard.php';</script>";
    exit;
}

// Simpan pembayaran
$sql = "INSERT INTO pembayaran (id_pendaftaran, jumlah_bayar, metode_bayar, status_bayar)
        VALUES ('$id_pendaftaran', '$jumlah_bayar', '$metode_bayar', 'menunggu')";

if($conn->query($sql)){
    echo "<script>alert('Pembayaran berhasil dicatat. Menunggu verifikasi admin.'); window.location='../pages/dashboard.php';</script>";
}else{
    echo "<script>alert('Terjadi kesalahan. Silakan coba lagi.'); window.location='../pages/dashboard.php';</script>";
}
?>
