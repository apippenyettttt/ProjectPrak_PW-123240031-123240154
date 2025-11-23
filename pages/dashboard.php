<?php
session_start();
include __DIR__ . '/../config/database.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: ../pages/login.php");
    exit();
}

$nama = htmlspecialchars($_SESSION['nama']);
$id_user = $_SESSION['id_user'];

$kategori_result = $conn->query("SELECT * FROM kategori_lomba");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Peserta - VETE-RUN</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">

        <!-- LOGO -->
        <a class="navbar-brand fw-bold d-flex align-items-center" href="dashboard.php">
            <img src="../asset/img/logoVTR.png" width="130">
        </a>

        <!-- BURGER -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navmenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- MENU -->
        <div class="collapse navbar-collapse justify-content-end" id="navmenu">
            <ul class="navbar-nav text-center text-lg-end">

                <li class="nav-item">
                    <a class="nav-link fw-semibold text-dark" href="dashboard.php">Dashboard</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fw-semibold text-dark" href="#kategori">Kategori</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fw-semibold text-dark" href="#riwayat">Riwayat</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fw-semibold text-danger" href="../backend/logout.php">Logout</a>
                </li>

            </ul>
        </div>

    </div>
</nav>


<div class="container mt-4">
  <div class="card shadow">
    <div class="card-body">
      <h4 class="fw-bold text-danger">Kategori Lomba</h4>
      <p>Pilih kategori lomba yang ingin kamu ikuti.</p>

      <table class="table table-bordered table-striped align-middle">
        <thead class="table-danger">
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
            $no = 1;
            while ($row = $kategori_result->fetch_assoc()) :

                // cek apakah user sudah daftar kategori ini
                $cek = $conn->query("SELECT * FROM pendaftaran WHERE id_user='$id_user' AND id_kategori='{$row['id_kategori']}'");
                $data_daftar = $cek->fetch_assoc();
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama_kategori']) ?></td>
                <td><?= $row['jarak_km'] ?> KM</td>
                <td>Rp <?= number_format($row['biaya'], 0, ',', '.') ?></td>
                <td><?= $row['kuota'] ?> orang</td>
                <td>
                    <?php if ($data_daftar): ?>
                        <span class="badge 
                            <?= $data_daftar['status_daftar'] == 'menunggu' ? 'bg-warning' : 
                                ($data_daftar['status_daftar'] == 'disetujui' ? 'bg-success' : 'bg-danger') ?>">
                            <?= ucfirst($data_daftar['status_daftar']) ?>
                        </span>
                        <?php if ($data_daftar['no_bib']): ?>
                            <br><small>BIB: <?= htmlspecialchars($data_daftar['no_bib']) ?></small>
                        <?php endif; ?>
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
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>