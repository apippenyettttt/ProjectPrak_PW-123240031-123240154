<?php
session_start();
include __DIR__.'/../config/database.php';

if(!isset($_SESSION['id_user'])) {
    header("Location: ../pages/login.php");
    exit();
}

$id_pendaftaran = $_POST['id_pendaftaran'];
$jumlah_bayar = $_POST['jumlah_bayar'];
$metode_bayar = $_POST['metode_bayar'];

// Cek apakah sudah bayar
$cek = $conn->query("SELECT * FROM pembayaran WHERE id_pendaftaran='$id_pendaftaran'");
if($cek->num_rows>0){
    $_SESSION['error'] = 'Pembayaran sudah dilakukan!';
    header("Location: ../pages/dashboard.php");
    exit();
}

// Handle file upload
$bukti_transfer = null;
if(isset($_FILES['bukti_transfer']) && $_FILES['bukti_transfer']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = __DIR__ . '/../asset/bukti_bayar/';
    
    // Buat folder jika belum ada
    if(!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
        
        // Buat file security
        file_put_contents($uploadDir . 'index.html', '<!DOCTYPE html><html><head><title>Access Denied</title></head><body><h1>403 - Access Forbidden</h1></body></html>');
    }
    
    $fileExtension = strtolower(pathinfo($_FILES['bukti_transfer']['name'], PATHINFO_EXTENSION));
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf', 'gif'];
    
    // Validasi ekstensi file
    if(!in_array($fileExtension, $allowedExtensions)) {
        $_SESSION['error'] = 'Format file tidak didukung! Gunakan JPG, PNG, PDF, atau GIF.';
        header("Location: ../pages/pembayaran.php?id_pendaftaran=" . $id_pendaftaran);
        exit();
    }
    
    // Validasi ukuran file (max 2MB)
    if($_FILES['bukti_transfer']['size'] > 2 * 1024 * 1024) {
        $_SESSION['error'] = 'Ukuran file terlalu besar! Maksimal 2MB.';
        header("Location: ../pages/pembayaran.php?id_pendaftaran=" . $id_pendaftaran);
        exit();
    }
    
    // Generate nama file yang unik
    $fileName = 'bukti_' . $id_pendaftaran . '_' . time() . '.' . $fileExtension;
    $filePath = $uploadDir . $fileName;
    
    // Pindahkan file
    if(move_uploaded_file($_FILES['bukti_transfer']['tmp_name'], $filePath)) {
        $bukti_transfer = $fileName;
        
        // Set permission file (untuk Linux/Unix)
        chmod($filePath, 0644);
    } else {
        $_SESSION['error'] = 'Gagal mengupload file. Silakan coba lagi.';
        header("Location: ../pages/pembayaran.php?id_pendaftaran=" . $id_pendaftaran);
        exit();
    }
}

// Jika transfer tapi tidak upload bukti
if($metode_bayar == 'transfer' && !$bukti_transfer) {
    $_SESSION['error'] = 'Bukti transfer wajib diupload untuk metode transfer!';
    header("Location: ../pages/pembayaran.php?id_pendaftaran=" . $id_pendaftaran);
    exit();
}

// Simpan pembayaran dengan prepared statement
if($bukti_transfer) {
    $stmt = $conn->prepare("INSERT INTO pembayaran (id_pendaftaran, jumlah_bayar, metode_bayar, bukti_transfer, status_bayar) VALUES (?, ?, ?, ?, 'menunggu')");
    $stmt->bind_param("idss", $id_pendaftaran, $jumlah_bayar, $metode_bayar, $bukti_transfer);
} else {
    $stmt = $conn->prepare("INSERT INTO pembayaran (id_pendaftaran, jumlah_bayar, metode_bayar, status_bayar) VALUES (?, ?, ?, 'menunggu')");
    $stmt->bind_param("ids", $id_pendaftaran, $jumlah_bayar, $metode_bayar);
}

if($stmt->execute()){
    $_SESSION['success'] = 'Pembayaran berhasil dicatat. Menunggu verifikasi admin.';
} else {
    $_SESSION['error'] = 'Terjadi kesalahan. Silakan coba lagi.';
}

header("Location: ../pages/dashboard.php");
exit();
?>