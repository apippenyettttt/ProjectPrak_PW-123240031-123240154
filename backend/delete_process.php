<?php
session_start();
include __DIR__.'/../config/database.php';

// Hanya admin yang bisa akses
if(!isset($_SESSION['id_user']) || $_SESSION['role'] != 'admin'){
    $_SESSION['error'] = 'Akses ditolak!';
    header("Location: ../pages/login.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_pendaftaran'])) {
    $id_pendaftaran = $conn->real_escape_string($_POST['id_pendaftaran']);
    
    try {
        $conn->begin_transaction();
        
        // 1. Hapus data pembayaran jika ada
        $sql1 = "DELETE FROM pembayaran WHERE id_pendaftaran = '$id_pendaftaran'";
        $conn->query($sql1);
        
        // 2. Hapus data pendaftaran
        $sql2 = "DELETE FROM pendaftaran WHERE id_pendaftaran = '$id_pendaftaran'";
        $conn->query($sql2);
        
        // CATATAN: Data user TIDAK dihapus, sehingga user bisa mendaftar lagi
        
        $conn->commit();
        
        $_SESSION['success'] = 'Data pendaftaran berhasil dihapus!';
        
    } catch (Exception $e) {
        $conn->rollback();
        $_SESSION['error'] = 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage();
    }
    
    header("Location: ../pages/admin.php");
    exit();
    
} else {
    $_SESSION['error'] = 'Data tidak valid!';
    header("Location: ../pages/admin.php");
    exit();
}
?>
