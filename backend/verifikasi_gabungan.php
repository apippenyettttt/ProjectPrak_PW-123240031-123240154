<?php
session_start();
include __DIR__.'/../config/database.php';

if(!isset($_SESSION['id_user']) || $_SESSION['role']!='admin'){
    header("Location: ../pages/login.php");
    exit();
}

if(!isset($_POST['id_pendaftaran'], $_POST['id_pembayaran'], $_POST['aksi'])){
    header("Location: admin.php");
    exit();
}

$id_pendaftaran = $_POST['id_pendaftaran'];
$id_pembayaran = $_POST['id_pembayaran'];
$aksi = $_POST['aksi'];
$no_bib = $_POST['no_bib'] ?? null;

if($aksi=='terverifikasi'){
    $sql = "UPDATE pendaftaran SET status_daftar='Disetujui', no_bib='$no_bib' WHERE id_pendaftaran='$id_pendaftaran';
            UPDATE pembayaran SET status_bayar='Terverifikasi' WHERE id_pembayaran='$id_pembayaran'";
}else{
    $sql = "UPDATE pendaftaran SET status_daftar='Ditolak' WHERE id_pendaftaran='$id_pendaftaran';
            UPDATE pembayaran SET status_bayar='Ditolak' WHERE id_pembayaran='$id_pembayaran'";
}

if($conn->multi_query($sql)){
    echo "<script>alert('Verifikasi berhasil.'); window.location='../pages/admin.php';</script>";
}else{
    echo "<script>alert('Terjadi kesalahan.'); window.location='../pages/admin.php';</script>";
}
?>