<?php
session_start();
include  __DIR__ . '/../config/database.php';

//hanya admin yang bisa masuk
if(!isset($_SESSION['id_user']) || $_SESSION['role']!='admin'){
    header("Location: login.php");
    exit();
}

// Ambil data session dengan aman
$nama = isset($_SESSION['nama']) ? $_SESSION['nama'] : 'Admin VETE-RUN';
$id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null;

//ambil full data psrta
$sql = "SELECT
            p.id_pendaftaran,
            u.nama_lengkap,
            u.email,
            k.nama_kategori,
            p.tanggal_daftar,
            p.no_bib,
            p.status_daftar
        FROM pendaftaran p
        JOIN users u ON p.id_user = u.id_user
        JOIN kategori_lomba k ON p.id_kategori = k.id_kategori
        ORDER BY p.tanggal_daftar DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | veteRUN</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">🧑‍💼 Admin Panel - veteRUN</a>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav align-items-center">
        <li class="nav-item me-3">
          <span class="text-white">Halo, <strong><?= htmlspecialchars($nama) ?></strong></span>
        </li>
        <li class="nav-item">
          <a href="../backend/logout.php" class="btn btn-outline-light btn-sm">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<div class="container mt-4">
    <div class="card shadow">
        <div class="card-body">
         <h4 class="fw-bold text-danger">Daftar Peserta Lomba</h4>
            <table class="table table-bordered table-striped align-middle mt-3">
                <thead class="table-danger">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Kategori</th>
                    <th>Tanggal Daftar</th>
                    <th>Status</th>
                    <th>No BIB</th>
                    <th>Aksi</th>
                </tr>
                </thead>
            <tbody>
            <?php 
            $no = 1;
            while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama_lengkap']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['nama_kategori']) ?></td>
                <td><?= $row['tanggal_daftar'] ?></td>
                <td>
                <span class="badge 
                    <?= $row['status_daftar'] == 'Menunggu' ? 'bg-warning' : 
                        ($row['status_daftar'] == 'Disetujui' ? 'bg-success' : 'bg-danger') ?>">
                    <?= $row['status_daftar'] ?>
                </span>
                </td>
                <td><?= $row['no_bib'] ?: '-' ?></td>
                <td>
                <form action="../backend/update_status.php" method="POST" class="d-flex">
                    <input type="hidden" name="id_pendaftaran" value="<?= $row['id_pendaftaran'] ?>">
                    <input type="text" name="no_bib" class="form-control form-control-sm me-2" placeholder="No BIB" value="<?= $row['no_bib'] ?>">
                    <select name="status_daftar" class="form-select form-select-sm me-2">
                    <option <?= $row['status_daftar']=='Menunggu'?'selected':'' ?>>Menunggu</option>
                    <option <?= $row['status_daftar']=='Disetujui'?'selected':'' ?>>Disetujui</option>
                    <option <?= $row['status_daftar']=='Ditolak'?'selected':'' ?>>Ditolak</option>
                    </select>
                    <button type="submit" class="btn btn-sm btn-danger">Simpan</button>
                </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>   
    
</body>
</html>