<?php
session_start();
include __DIR__.'/../config/database.php';

// Hanya admin yang bisa akses
if(!isset($_SESSION['id_user']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit();
}
// Ambil semua pendaftaran + pembayaran + user + kategori
$sql = "SELECT p.id_pendaftaran, p.id_user, p.id_kategori, p.no_bib, p.status_daftar,
        u.nama_lengkap, u.email,
        k.nama_kategori,
        pb.id_pembayaran, pb.jumlah_bayar, pb.metode_bayar, pb.status_bayar, pb.tanggal_bayar
        FROM pendaftaran p
        JOIN users u ON p.id_user = u.id_user
        JOIN kategori_lomba k ON p.id_kategori = k.id_kategori
        LEFT JOIN pembayaran pb ON p.id_pendaftaran = pb.id_pendaftaran
        ORDER BY p.tanggal_daftar DESC";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Admin Panel | VETE-RUN</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    background: #cacacaff;
}
.navbar-dark .navbar-nav .nav-link {
    color: #fff;
}
.table thead {
    background-color: #ff4d4d;
    color: #fff;
}
.badge-status {
    padding: 0.4em 0.7em;
    font-size: 0.85rem;
}
</style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="admin.php">
            <img src="../asset/img/logoVTR.png" width="130" alt="">
            <span class="ms-2">Admin Panel</span>
        </a>
        <div class="collapse navbar-collapse" id="navmenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link fw-semibold" href="admin.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold text-danger" href="../backend/logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <h3 class="mb-3 fw-bold" >Verifikasi Pendaftaran & Pembayaran</h3>

    <div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Kategori</th>
                <th>Status Daftar</th>
                <th>Pembayaran</th>
                <th>No BIB</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php $no=1; while($row=$result->fetch_assoc()): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama_lengkap']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['nama_kategori']) ?></td>
                <td>
                    <span class="badge badge-status 
                        <?= strtolower($row['status_daftar'])=='menunggu'?'bg-warning':
                           (strtolower($row['status_daftar'])=='disetujui'?'bg-success':'bg-danger') ?>">
                        <?= ucfirst($row['status_daftar']) ?>
                    </span>
                </td>
                <td>
                    <?php if($row['id_pembayaran']): ?>
                        <span class="badge badge-status 
                            <?= strtolower($row['status_bayar'])=='menunggu'?'bg-warning':
                               (strtolower($row['status_bayar'])=='terverifikasi'?'bg-success':'bg-danger') ?>">
                            <?= ucfirst($row['status_bayar']) ?>
                        </span><br>
                        Rp <?= number_format($row['jumlah_bayar'],0,',','.') ?> - <?= ucfirst($row['metode_bayar']) ?>
                    <?php else: ?>
                        <span class="text-muted">Belum bayar</span>
                    <?php endif; ?>
                </td>
                <td><?= $row['no_bib'] ?: '-' ?></td>
                <td>
                    <?php 
                    // Hanya tampilkan form jika status daftar menunggu dan pembayaran menunggu
                    if(strtolower($row['status_daftar'])=='menunggu' && $row['id_pembayaran'] && strtolower($row['status_bayar'])=='menunggu'): ?>
                        <form action="../backend/verifikasi_gabungan.php" method="POST" class="d-flex gap-1">
                            <input type="hidden" name="id_pendaftaran" value="<?= $row['id_pendaftaran'] ?>">
                            <input type="hidden" name="id_pembayaran" value="<?= $row['id_pembayaran'] ?>">
                            <input type="text" name="no_bib" class="form-control form-control-sm" placeholder="No BIB" required>
                            <button type="submit" name="aksi" value="terverifikasi" class="btn btn-sm btn-success">Verifikasi</button>
                            <button type="submit" name="aksi" value="ditolak" class="btn btn-sm btn-danger">Tolak</button>
                        </form>
                    <?php else: ?>
                        <span>-</span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    </div>
</div>

</body>
</html>
