<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include __DIR__ . '/../config/database.php';

if (empty($_POST['nama']) || empty($_POST['email']) || empty($_POST['password'])) {
    echo "<script>alert('Semua field harus diisi!'); window.location='../pages/register.php';</script>";
    exit();
}

$nama = $conn->real_escape_string($_POST['nama']);
$email = $conn->real_escape_string($_POST['email']);
$password = $_POST['password'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Format email tidak valid!'); window.location='../pages/register.php';</script>";
    exit();
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Cek apakah email sudah terdaftar
$cek = $conn->query("SELECT * FROM users WHERE email='$email'");
if ($cek->num_rows > 0) {
    echo "<script>alert('Email sudah terdaftar!'); window.location='../pages/register.php';</script>";
    exit();
}

$sql = "INSERT INTO users (nama_lengkap, email, password, role) 
        VALUES ('$nama', '$email', '$hashedPassword', 'user')";
        
if ($conn->query($sql)) {
    echo "<script>alert('Pendaftaran berhasil! Silakan login.'); window.location='../pages/login.php';</script>";
} else {
    echo "<script>alert('Terjadi kesalahan sistem. Silakan coba lagi.'); window.location='../pages/register.php';</script>";
}
?>