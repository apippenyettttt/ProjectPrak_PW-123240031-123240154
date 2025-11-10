<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include __DIR__ . '/../config/database.php';

$email = $_POST['email'];
$password = $_POST['password'];

$result = $conn->query("SELECT * FROM users WHERE email='$email'");
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        $_SESSION['id_user'] = $user['id_user'];
        $_SESSION['nama'] = $user['nama'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'admin') {
            header("Location: ../pages/admin.php");
        } else {
            header("Location: ../pages/dashboard.php");
        }
        exit();
    } else {
        echo "<script>alert('Password salah!'); window.location='../pages/login.php';</script>";
    }
} else {
    echo "<script>alert('Email tidak ditemukan!'); window.location='../pages/login.php';</script>";
}
?>
