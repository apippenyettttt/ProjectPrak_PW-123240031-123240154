<?php
session_start();
include __DIR__ . '/../config/database.php';

// Hanya admin yang bisa akses
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'admin') {
    header("Location: ../pages/login.php");
    exit();
}

// Validasi input
if (empty($_POST['id_pendaftaran']) || empty($_POST['status_daftar'])) {
    echo "<script>alert('Data tidak lengkap!'); window.location='../pages/admin.php';</script>";
    exit();
}

$id_pendaftaran = $conn->real_escape_string($_POST['id_pendaftaran']);
$status_daftar = $conn->real_escape_string($_POST['status_daftar']);
$no_bib = $conn->real_escape_string($_POST['no_bib']);

// Update status & no BIB
$sql = "UPDATE pendaftaran
        SET status_daftar='$status_daftar', no_bib='$no_bib'
        WHERE id_pendaftaran='$id_pendaftaran'";

if ($conn->query($sql)) {
    echo "<script>alert('Data berhasil diperbarui!'); window.location='../pages/admin.php';</script>";
} else {
    echo "<script>alert('Terjadi kesalahan: " . $conn->error . "'); window.location='../pages/admin.php';</script>";
}
?>