<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include __DIR__. '/../config/database.php';

$nama = $_POST['nama'];
$email = $_POST['email'];
$password = $_POST['password'];

// Hash password sebelum disimpan
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Cek apakah email sudah terdaftar
$cek = $conn->query("SELECT * FROM users WHERE email='$email'");
if ($cek->num_rows > 0) {
    echo "<script>alert('Email sudah terdaftar!'); window.location='../pages/register.php';</script>";
    exit;
}

// Simpan user baru
$sql = "INSERT INTO users (nama_lengkap, email, password, role) 
        VALUES ('$nama', '$email', '$hashedPassword', 'user')";
if ($conn->query($sql)) {
    echo "<script>alert('Pendaftaran berhasil! Silakan login.'); window.location='../pages/login.php';</script>";
} else {
    die("Query Error: " . $conn->error);
}
?>
