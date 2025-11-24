<?php
session_start();
include __DIR__ . '/../config/database.php';

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'user') {
    header("Location: ../pages/login.php");
    exit();
}

// Validasi input
if (empty($_POST['id_user']) || empty($_POST['id_kategori'])) {
    $_SESSION['error'] = 'Data tidak lengkap!';
    header("Location: ../pages/dashboard.php");
    exit();
}

// Validasi tipe data
if (!is_numeric($_POST['id_user']) || !is_numeric($_POST['id_kategori'])) {
    $_SESSION['error'] = 'Data tidak valid!';
    header("Location: ../pages/dashboard.php");
    exit();
}

$id_user = (int)$_POST['id_user'];
$id_kategori = (int)$_POST['id_kategori'];

// 1. CEK APAKAH USER ID ADA DI TABLE USERS
$stmt = $conn->prepare("SELECT id_user FROM users WHERE id_user = ?");
$stmt->bind_param("i", $id_user);
$stmt->execute();
$user_result = $stmt->get_result();

if ($user_result->num_rows == 0) {
    $_SESSION['error'] = 'User tidak ditemukan!';
    header("Location: ../pages/dashboard.php");
    exit();
}

// 2. CEK APAKAH KATEGORI ID ADA
$stmt = $conn->prepare("SELECT id_kategori FROM kategori_lomba WHERE id_kategori = ?");
$stmt->bind_param("i", $id_kategori);
$stmt->execute();
$kategori_result = $stmt->get_result();

if ($kategori_result->num_rows == 0) {
    $_SESSION['error'] = 'Kategori lomba tidak ditemukan!';
    header("Location: ../pages/dashboard.php");
    exit();
}

// 3. CEK APAKAH SUDAH PERNAH DAFTAR (dengan prepared statement)
$stmt = $conn->prepare("SELECT * FROM pendaftaran WHERE id_user = ? AND id_kategori = ?");
$stmt->bind_param("ii", $id_user, $id_kategori);
$stmt->execute();
$cek = $stmt->get_result();

if ($cek->num_rows > 0) {
    $_SESSION['error'] = 'Anda sudah mendaftar kategori ini!';
    header("Location: ../pages/dashboard.php");
    exit();
}

// 4. SIMPAN PENDAFTARAN (dengan prepared statement)
$stmt = $conn->prepare("INSERT INTO pendaftaran (id_user, id_kategori, status_daftar) VALUES (?, ?, 'menunggu')");
$stmt->bind_param("ii", $id_user, $id_kategori);

if ($stmt->execute()) {
    $_SESSION['success'] = 'Pendaftaran berhasil! Menunggu verifikasi admin.';
} else {
    $_SESSION['error'] = 'Terjadi kesalahan sistem. Silakan coba lagi.';
}

header("Location: ../pages/dashboard.php");
exit();
?>