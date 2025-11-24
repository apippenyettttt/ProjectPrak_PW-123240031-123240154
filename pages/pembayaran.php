<?php
session_start();
include __DIR__.'/../config/database.php';

if(!isset($_SESSION['id_user'])) header("Location: ../pages/login.php");

$id_user = $_SESSION['id_user'];
$id_pendaftaran = $_GET['id_pendaftaran'];

// Ambil data pendaftaran + kategori
$pendaftaran = $conn->query("SELECT pd.*, k.nama_kategori, k.biaya 
                             FROM pendaftaran pd 
                             JOIN kategori_lomba k ON pd.id_kategori = k.id_kategori
                             WHERE pd.id_pendaftaran='$id_pendaftaran' AND pd.id_user='$id_user'")->fetch_assoc();

if(!$pendaftaran){
    echo "<script>alert('Data tidak ditemukan!'); window.location='dashboard.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Form Pembayaran | VETE-RUN</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-body">
            <h4 class="fw-bold text-danger">Bayar Kategori: <?= htmlspecialchars($pendaftaran['nama_kategori']) ?></h4>
            <form action="../backend/pembayaran_process.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_pendaftaran" value="<?= $pendaftaran['id_pendaftaran'] ?>">
                <div class="mb-3">
                    <label>Jumlah Bayar (Rp)</label>
                    <input type="text" class="form-control" value="<?= number_format($pendaftaran['biaya'],0,',','.') ?>" readonly>
                    <input type="hidden" name="jumlah_bayar" value="<?= $pendaftaran['biaya'] ?>">
                </div>
                <div class="mb-3">
                    <label>Metode Bayar</label>
                    <select name="metode_bayar" class="form-select" required>
                        <option value="transfer">Transfer</option>
                        <option value="cash">Cash</option>
                    </select>
                </div>
                <!-- Tambahkan di form pembayaran -->
                <div class="mb-3">
                    <label>Bukti Transfer <span class="text-danger">*</span></label>
                    <input type="file" name="bukti_transfer" class="form-control" required accept="image/*,.pdf">
                    <div class="form-text">
                        Format: JPG, PNG, PDF (Maks. 2MB)
                        <br>File akan disimpan di: <code>asset/bukti_bayar/</code>
                    </div>
                </div>
                <button type="submit" class="btn btn-danger">Bayar Sekarang</button>
                <a href="dashboard.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
