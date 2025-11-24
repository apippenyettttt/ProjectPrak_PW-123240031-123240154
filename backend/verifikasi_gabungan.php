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

if($aksi == 'terverifikasi'){
    // 1. AMBIL DATA KATEGORI UNTUK DAPATKAN PREFIX BIB
    $stmt = $conn->prepare("
        SELECT k.prefix_bib 
        FROM pendaftaran p 
        JOIN kategori_lomba k ON p.id_kategori = k.id_kategori 
        WHERE p.id_pendaftaran = ?
    ");
    $stmt->bind_param("i", $id_pendaftaran);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $prefix_bib = $data['prefix_bib'];
    
    // 2. HITUNG NOMOR URUT BERIKUTNYA UNTUK KATEGORI INI
    $stmt = $conn->prepare("
        SELECT COUNT(*) as total 
        FROM pendaftaran p 
        JOIN kategori_lomba k ON p.id_kategori = k.id_kategori 
        WHERE k.prefix_bib = ? AND p.no_bib IS NOT NULL
    ");
    $stmt->bind_param("s", $prefix_bib);
    $stmt->execute();
    $result = $stmt->get_result();
    $count_data = $result->fetch_assoc();
    $next_number = $count_data['total'] + 1;
    
    // 3. GENERATE BIB NUMBER (contoh: VTR5K001, VTR15K045)
    $no_bib = $prefix_bib . str_pad($next_number, 3, '0', STR_PAD_LEFT);
    
    // 4. UPDATE DATABASE DENGAN PREPARED STATEMENTS
    $stmt = $conn->prepare("UPDATE pendaftaran SET status_daftar='disetujui', no_bib=? WHERE id_pendaftaran=?");
    $stmt->bind_param("si", $no_bib, $id_pendaftaran);
    $stmt->execute();
    
    $stmt = $conn->prepare("UPDATE pembayaran SET status_bayar='terverifikasi' WHERE id_pembayaran=?");
    $stmt->bind_param("i", $id_pembayaran);
    $stmt->execute();
    
    $_SESSION['success'] = "Pembayaran diverifikasi! No BIB: $no_bib";
    
} else if($aksi == 'ditolak') {
    // TOLAK - TIDAK KASIH BIB
    $stmt = $conn->prepare("UPDATE pendaftaran SET status_daftar='ditolak' WHERE id_pendaftaran=?");
    $stmt->bind_param("i", $id_pendaftaran);
    $stmt->execute();
    
    $stmt = $conn->prepare("UPDATE pembayaran SET status_bayar='ditolak' WHERE id_pembayaran=?");
    $stmt->bind_param("i", $id_pembayaran);
    $stmt->execute();
    
    $_SESSION['success'] = "Pendaftaran ditolak!";
}

header("Location: ../pages/admin.php");
exit();
?>