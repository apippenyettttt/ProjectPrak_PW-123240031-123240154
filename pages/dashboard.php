<?php
session_start();
include __DIR__ . '/../config/database.php';

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'user') {
    header("Location: ../pages/login.php");
    exit();
}

$id_user = $_SESSION['id_user'];
$nama = htmlspecialchars($_SESSION['nama']);

// Ambil semua kategori
$kategori_result = $conn->query("SELECT * FROM kategori_lomba ORDER BY id_kategori ASC");

// Ambil pendaftaran user (jika ada)
$cek_daftar = $conn->query("SELECT p.*, k.nama_kategori, pb.id_pembayaran, pb.status_bayar
                            FROM pendaftaran p
                            JOIN kategori_lomba k ON p.id_kategori = k.id_kategori
                            LEFT JOIN pembayaran pb ON p.id_pendaftaran = pb.id_pendaftaran
                            WHERE p.id_user='$id_user'");
$user_daftar = $cek_daftar->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Peserta - VETE-RUN 2025</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        background: url('../asset/img/hero.jpg') center/cover no-repeat;
        background-size: cover;
        min-height: 100vh;
        font-family: 'Segoe UI', sans-serif;
        padding-top: 70px;
    }
    .overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: -1; }
    .card-dashboard { background: rgba(50,50,50,0.8); color: #fff; border-radius:12px; box-shadow:0 10px 30px rgba(0,0,0,0.5); }
    .table thead { background-color: #ff4d4d; color: #fff; }
    .btn-danger { background-color: #ff4d4d; border-color: #ff4d4d; }
    .btn-danger:hover { background-color: #d00000; border-color: #d00000; }
    .badge-status { padding: 0.5em 0.7em; font-size: 0.85rem; }
</style>
</head>
<body>
<div class="overlay"></div>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
<div class="container">
    <a class="navbar-brand fw-bold d-flex align-items-center" href="dashboard.php">
        <img src="../asset/img/logoVTR.png" width="130">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navmenu">
        <ul class="navbar-nav text-center text-lg-end">
            <li class="nav-item"><a class="nav-link fw-semibold text-dark" href="dashboard.php">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link fw-semibold text-dark" href="#kategori">Kategori</a></li>
            <li class="nav-item"><a class="nav-link fw-semibold text-dark" href="#riwayat">Riwayat</a></li>
            <li class="nav-item"><a class="nav-link fw-semibold text-danger" href="../backend/logout.php">Logout</a></li>
        </ul>
    </div>
</div>
</nav>

<div class="container mt-4">

<!-- Halo User -->
<div class="card card-dashboard p-4 mb-4">
    <h4 class="fw-bold text-danger">Halo, <?= $nama ?>!</h4>
    <p>Selamat datang di dashboard peserta VETE-RUN 2025. Silakan pilih kategori lomba yang ingin diikuti.</p>
</div>

<!-- Kategori Lomba -->
<div class="card card-dashboard p-4 mb-5" id="kategori">
    <h4 class="fw-bold text-danger mb-3">Kategori Lomba</h4>
    <div class="table-responsive">
    <table class="table table-bordered table-striped align-middle text-white">
        <thead>
            <tr>
                <th width="10%">No</th>
                <th>Kategori</th>
                <th>Jarak</th>
                <th>Biaya</th>
                <th>Kuota</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $no=1;
        while($row = $kategori_result->fetch_assoc()): 
            $disabled = ($user_daftar) ? 'disabled' : '';
            $btn_text = ($user_daftar) 
                        ? ($user_daftar['id_pembayaran'] 
                            ? 'Lihat Pembayaran' 
                            : 'Bayar Sekarang') 
                        : 'Daftar';
            $link = ($user_daftar) 
                        ? "../pages/pembayaran.php?id_pendaftaran={$user_daftar['id_pendaftaran']}" 
                        : null;
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama_kategori']) ?></td>
                <td><?= $row['jarak_km'] ?> KM</td>
                <td>Rp <?= number_format($row['biaya'],0,',','.') ?></td>
                <td><?= $row['kuota'] ?></td>
                <td>
                    <?php if($user_daftar): ?>
                        <a href="<?= $link ?>" class="btn btn-sm btn-danger"><?= $btn_text ?></a>
                    <?php else: ?>
                        <form action="../backend/daftar_lomba.php" method="POST" style="display:inline;">
                            <input type="hidden" name="id_user" value="<?= $id_user ?>">
                            <input type="hidden" name="id_kategori" value="<?= $row['id_kategori'] ?>">
                            <button type="submit" class="btn btn-sm btn-danger">Daftar</button>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    </div>
</div>

<!-- Riwayat Pendaftaran -->
<div class="card card-dashboard p-4 mb-5" id="riwayat">
    <h4 class="fw-bold text-danger mb-3">Riwayat Pendaftaran</h4>
    <?php if($user_daftar): ?>
        <p>Anda telah mendaftar kategori: <strong><?= htmlspecialchars($user_daftar['nama_kategori']) ?></strong></p>
        <p>Status Pendaftaran: 
            <span class="badge badge-status 
                <?= strtolower($user_daftar['status_daftar'])=='menunggu'?'bg-warning':
                    (strtolower($user_daftar['status_daftar'])=='disetujui'?'bg-success':'bg-danger') ?>">
                <?= ucfirst($user_daftar['status_daftar']) ?>
            </span>
        </p>
        <p>Status Pembayaran:
            <span class="badge badge-status 
                <?= strtolower($user_daftar['status_bayar'])=='menunggu'?'bg-warning':
                    (strtolower($user_daftar['status_bayar'])=='terverifikasi'?'bg-success':'bg-danger') ?>">
                <?= $user_daftar['id_pembayaran'] 
                    ? ucfirst($user_daftar['status_bayar']) 
                    : 'Belum Bayar' ?>
            </span>
        </p>
        <p>No BIB: <?= $user_daftar['no_bib'] ? htmlspecialchars($user_daftar['no_bib']) : '-' ?></p>
        <?php if(!$user_daftar['id_pembayaran']): ?>
            <a href="../pages/pembayaran.php?id_pendaftaran=<?= $user_daftar['id_pendaftaran'] ?>" class="btn btn-danger btn-sm">Bayar Sekarang</a>
        <?php endif; ?>
    <?php else: ?>
        <p>Belum ada pendaftaran kategori.</p>
    <?php endif; ?>
</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
