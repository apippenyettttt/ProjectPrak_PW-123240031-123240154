<?php
session_start();
include __DIR__.'/../config/database.php';

if(!isset($_SESSION['id_user'])) header("Location: ../pages/login.php");

$id_user = $_SESSION['id_user'];
$id_pendaftaran = $_GET['id_pendaftaran'];

$pendaftaran = $conn->query("
    SELECT pd.*, k.nama_kategori, k.biaya
    FROM pendaftaran pd
    JOIN kategori_lomba k ON pd.id_kategori = k.id_kategori
    WHERE pd.id_pendaftaran='$id_pendaftaran'
    AND pd.id_user='$id_user'
")->fetch_assoc();

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
<title>Pembayaran | VETE-RUN 2025</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: url('../asset/img/lari.jpg') center/cover no-repeat;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    font-family: 'Segoe UI', sans-serif;
    margin: 0;
}

body::before {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.6);
    z-index: 0;
}

.payment-card {
    position: relative;
    background: rgba(0,0,0,0.65);
    border-radius: 12px;
    color: #fff;
    padding: 2rem;
    width: 95%;
    max-width: 550px;
    box-shadow: 0 15px 30px rgba(0,0,0,0.6);
    z-index: 1;
}

.payment-card h3 {
    color: #ff4d4d;
    text-align: center;
    margin-bottom: 1.2rem;
    font-weight: bold;
}
.form-control, .form-select {
    background: rgba(255,255,255,0.12);
    border: 1px solid rgba(255,255,255,0.35);
    color: #fff;
}

.form-control::placeholder {
    color: rgba(255,255,255,0.7);
}

.form-control:focus,
.form-select:focus {
    background: rgba(255,255,255,0.18);
    border-color: #ff4d4d;
    color: #fff;
    box-shadow: none;
}
.btn-danger {
    background-color: #ff4d4d;
    border-color: #ff4d4d;
    font-weight: 600;
}

.btn-danger:hover {
    background-color: #d00000;
    border-color: #d00000;
}

.btn-secondary {
    margin-top: 0.6rem;
    background-color: #6c757d;
}

.btn-secondary:hover {
    background-color: #5a6268;
}

/* small text */
.form-text {
    color: #ccc;
}
</style>

</head>
<body>

<div class="payment-card">

    <h3>Pembayaran Kategori</h3>

    <p class="text-center mb-4, text-bold">
        <h4><?= htmlspecialchars($pendaftaran['nama_kategori']) ?></h4>
        <br>
    </p>
    <form action="../backend/pembayaran_process.php" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="id_pendaftaran" value="<?= $pendaftaran['id_pendaftaran'] ?>">
        <!-- JUMLAH BAYAR -->
        <div class="mb-3">
            <label class="form-label">Jumlah Bayar (Rp)</label>
            <input type="text" class="form-control"
                   value="<?= number_format($pendaftaran['biaya'],0,',','.') ?>" readonly>
            <input type="hidden" name="jumlah_bayar" value="<?= $pendaftaran['biaya'] ?>">
        </div>
        <!-- METODE -->
        <div class="mb-3">
            <label class="form-label">Metode Pembayaran</label>
            <select name="metode_bayar" class="form-select" required>
                <option value="transfer">Transfer</option>
                <option value="cash">Cash</option>
            </select>
        </div>
        <!-- FILE -->
        <div class="mb-3">
            <label class="form-label">Upload Bukti Pembayaran *</label>
            <input type="file" name="bukti_transfer" class="form-control" required accept="image/*,.pdf">
            <div class="form-text mt-1">
                Format: JPG, PNG, PDF — Maks. 2MB <br>
                Disimpan ke folder: <code>asset/bukti_bayar/</code>
            </div>
        </div>

        <button type="submit" class="btn btn-danger w-100 mt-2">Bayar Sekarang</button>
        <a href="dashboard.php" class="btn btn-secondary w-100">Batal</a>

    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
