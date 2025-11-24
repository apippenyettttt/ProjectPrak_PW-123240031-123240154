<?php
session_start();
include __DIR__.'/../config/database.php';

// Hanya admin yang bisa akses
if(!isset($_SESSION['id_user']) || $_SESSION['role'] != 'admin'){
    header("Location: ../pages/login.php");
    exit();
}

// TAMPILKAN PESAN SUKSES/ERROR
if(isset($_SESSION['success'])) {
    echo '<div class="alert alert-success alert-dismissible fade show mx-3 mt-3" role="alert">
            ' . $_SESSION['success'] . '
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>';
    unset($_SESSION['success']);
}

if(isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger alert-dismissible fade show mx-3 mt-3" role="alert">
            ' . $_SESSION['error'] . '
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>';
    unset($_SESSION['error']);
}

// Ambil semua pendaftaran + pembayaran + user + kategori
$sql = "SELECT p.id_pendaftaran, p.id_user, p.id_kategori, p.no_bib, p.status_daftar,
        u.nama_lengkap, u.email, u.no_hp, u.alamat,
        k.nama_kategori, k.prefix_bib,
        pb.id_pembayaran, pb.jumlah_bayar, pb.metode_bayar, pb.status_bayar, pb.tanggal_bayar, pb.bukti_transfer
        FROM pendaftaran p
        JOIN users u ON p.id_user = u.id_user
        JOIN kategori_lomba k ON p.id_kategori = k.id_kategori
        LEFT JOIN pembayaran pb ON p.id_pendaftaran = pb.id_pendaftaran
        ORDER BY p.tanggal_daftar DESC";

$result = $conn->query($sql);

// Hitung statistik
$stats_sql = "SELECT 
    COUNT(*) as total_peserta,
    SUM(CASE WHEN p.status_daftar = 'disetujui' THEN 1 ELSE 0 END) as disetujui,
    SUM(CASE WHEN p.status_daftar = 'menunggu' THEN 1 ELSE 0 END) as menunggu,
    SUM(CASE WHEN p.status_daftar = 'ditolak' THEN 1 ELSE 0 END) as ditolak,
    SUM(CASE WHEN pb.status_bayar = 'terverifikasi' THEN 1 ELSE 0 END) as lunas
    FROM pendaftaran p
    LEFT JOIN pembayaran pb ON p.id_pendaftaran = pb.id_pendaftaran";
$stats = $conn->query($stats_sql)->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Panel | VETE-RUN</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
body {
    background: #f8f9fa;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
.navbar-brand {
    font-weight: 800;
}
.lari {
    height: 100vh; /* full height viewport */
    min-height: 600px; /* optional untuk layar kecil */
    position: relative;
    background: url('../asset/img/lari.jpg') center center / cover no-repeat;
}

.lari-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.45);
}

.lari-content {
    position: relative;
    z-index: 2;
    top: 50%;
    transform: translateY(-50%);
    color: white;
    text-align: center;
    padding: 0 1rem; /* agar responsif di layar kecil */
}

html, body {
    height: 100%;
    margin: 0;
}
.main-content {
    padding: 20px;
}
.stat-card {
    border-radius: 10px;
    border: none;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    transition: transform 0.3s;
}
.stat-card:hover {
    transform: translateY(-5px);
}
.stat-card .card-body {
    padding: 25px;
}
.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0;
}
.table thead {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white;
}
.badge-status {
    padding: 0.5em 0.8em;
    font-size: 0.85rem;
    border-radius: 20px;
}
.bukti-img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
    cursor: pointer;
    transition: transform 0.3s;
    border: 2px solid #dee2e6;
}
.bukti-img:hover {
    transform: scale(2.5);
    z-index: 1000;
    position: relative;
}
.btn-action {
    padding: 0.3rem 0.6rem;
    font-size: 0.75rem;
    border-radius: 6px;
}
.modal-bukti-img {
    max-height: 70vh;
    width: auto;
    margin: 0 auto;
    display: block;
}
.actions-column {
    min-width: 220px;
}
</style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary bg-gradient shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="admin.php">
            <img src="../asset/img/logoVTR.png" width="" height="40" class="me-2">
        </a>
        
        <div class="d-flex align-items-center">
            <span class="text-light me-3">
                <i class="fas fa-user-circle me-1"></i>
                <?= htmlspecialchars($_SESSION['nama'] ?? 'Admin') ?>
            </span>
            <a class="btn btn-outline-light btn-sm" href="../backend/logout.php">
                <i class="fas fa-sign-out-alt me-1"></i>Logout
            </a>
        </div>
    </div>
</nav>

<div class="container-fluid mx-0 px-0">
    <section class="lari" id="beranda">
        <div class="lari-overlay"></div>
        <div class="lari-content">
            <div class="col-md-9 col-lg-10 main-content mx-auto">
                <!-- STATISTIK -->
                <div class="row mb-4">
                    <div class="col-md-3 mb-3">
                        <div class="card stat-card border-primary">
                            <div class="card-body text-center">
                                <i class="fas fa-users fa-2x text-primary mb-2"></i>
                                <h3 class="stat-number text-primary"><?= $stats['total_peserta'] ?></h3>
                                <p class="text-muted mb-0">Total Peserta</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card stat-card border-success">
                            <div class="card-body text-center">
                                <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                                <h3 class="stat-number text-success"><?= $stats['disetujui'] ?></h3>
                                <p class="text-muted mb-0">Disetujui</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card stat-card border-warning">
                            <div class="card-body text-center">
                                <i class="fas fa-clock fa-2x text-warning mb-2"></i>
                                <h3 class="stat-number text-warning"><?= $stats['menunggu'] ?></h3>
                                <p class="text-muted mb-0">Menunggu</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card stat-card border-danger">
                            <div class="card-body text-center">
                                <i class="fas fa-times-circle fa-2x text-danger mb-2"></i>
                                <h3 class="stat-number text-danger"><?= $stats['ditolak'] ?></h3>
                                <p class="text-muted mb-0">Ditolak</p>
                            </div>
                        </div>
                    </div>
                </div>  

                <!-- DATA PESERTA -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h4 class="mb-0 text-danger">
                            <i class="fas fa-list-alt me-2"></i>Data Pendaftaran Peserta
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle">
                                <thead>
                                    <tr>
                                        <th width="50">No</th>
                                        <th>Nama Peserta</th>
                                        <th>Email</th>
                                        <th>Kategori</th>
                                        <th>Status Daftar</th>
                                        <th>Status Pembayaran</th>
                                        <th>Bukti Bayar</th>
                                        <th>No BIB</th>
                                        <th width="220" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if($result->num_rows > 0): ?>
                                    <?php $no=1; while($row=$result->fetch_assoc()): ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td>
                                                <strong><?= htmlspecialchars($row['nama_lengkap']) ?></strong>
                                                <?php if($row['no_hp']): ?>
                                                    <br><small class="text-muted"><i class="fas fa-phone me-1"></i><?= htmlspecialchars($row['no_hp']) ?></small>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= htmlspecialchars($row['email']) ?></td>
                                            <td>
                                                <span class="badge bg-light text-dark">
                                                    <?= htmlspecialchars($row['nama_kategori']) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-status 
                                                    <?= $row['status_daftar']=='menunggu'?'bg-warning':
                                                       ($row['status_daftar']=='disetujui'?'bg-success':'bg-danger') ?>">
                                                    <i class="fas fa-<?= $row['status_daftar']=='menunggu'?'clock':($row['status_daftar']=='disetujui'?'check':'times') ?> me-1"></i>
                                                    <?= ucfirst($row['status_daftar']) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?php if($row['id_pembayaran']): ?>
                                                    <span class="badge badge-status 
                                                        <?= $row['status_bayar']=='menunggu'?'bg-warning':
                                                           ($row['status_bayar']=='terverifikasi'?'bg-success':'bg-danger') ?>">
                                                        <i class="fas fa-<?= $row['status_bayar']=='menunggu'?'clock':($row['status_bayar']=='terverifikasi'?'check':'times') ?> me-1"></i>
                                                        <?= ucfirst($row['status_bayar']) ?>
                                                    </span>
                                                    <br>
                                                    <small class="text-muted">
                                                        Rp <?= number_format($row['jumlah_bayar'],0,',','.') ?>
                                                        • <?= ucfirst($row['metode_bayar']) ?>
                                                    </small>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary">
                                                        <i class="fas fa-minus me-1"></i>Belum Bayar
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if($row['bukti_transfer']): 
                                                    $file_extension = strtolower(pathinfo($row['bukti_transfer'], PATHINFO_EXTENSION));
                                                    $is_image = in_array($file_extension, ['jpg', 'jpeg', 'png']);
                                                ?>
                                                    <?php if($is_image): ?>
                                                        <img src="../asset/bukti_bayar/<?= $row['bukti_transfer'] ?>" 
                                                             class="bukti-img" 
                                                             alt="Bukti Transfer"
                                                             data-bs-toggle="modal" 
                                                             data-bs-target="#buktiModal"
                                                             data-bukti="<?= $row['bukti_transfer'] ?>"
                                                             data-nama="<?= htmlspecialchars($row['nama_lengkap']) ?>">
                                                    <?php else: ?>
                                                        <a href="../asset/bukti_bayar/<?= $row['bukti_transfer'] ?>" 
                                                           target="_blank" 
                                                           class="btn btn-sm btn-outline-primary">
                                                            <i class="fas fa-file me-1"></i>Lihat
                                                        </a>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if($row['no_bib']): ?>
                                                    <span class="badge bg-dark"><?= $row['no_bib'] ?></span>
                                                <?php else: ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                            <div class="d-flex flex-column gap-1">
                                                <?php 
                                                // TOMBOL VERIFIKASI - untuk yang sudah upload bukti & status menunggu
                                                if($row['status_daftar']=='menunggu' && $row['id_pembayaran'] && $row['status_bayar']=='menunggu'): ?>
                                                    <!-- Tombol Lihat Bukti -->
                                                    <?php if($row['bukti_transfer']): ?>
                                                        <button type="button" class="btn btn-sm btn-info btn-action"
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#buktiModal"
                                                                data-bukti="<?= $row['bukti_transfer'] ?>"
                                                                data-nama="<?= htmlspecialchars($row['nama_lengkap']) ?>">
                                                            <i class="fas fa-eye me-1"></i>Lihat Bukti
                                                        </button>
                                                    <?php endif; ?>
                                                    
                                                    <!-- Form Verifikasi -->
                                                    <form action="../backend/verifikasi_gabungan.php" method="POST" class="d-flex gap-1">
                                                        <input type="hidden" name="id_pendaftaran" value="<?= $row['id_pendaftaran'] ?>">
                                                        <input type="hidden" name="id_pembayaran" value="<?= $row['id_pembayaran'] ?>">
                                                        <button type="submit" name="aksi" value="terverifikasi" class="btn btn-sm btn-success btn-action flex-fill">
                                                            <i class="fas fa-check me-1"></i>Setujui
                                                        </button>
                                                        <button type="submit" name="aksi" value="ditolak" class="btn btn-sm btn-danger btn-action flex-fill">
                                                            <i class="fas fa-times me-1"></i>Tolak
                                                        </button>
                                                    </form>
                                                
                                                <?php 
                                                // TOMBOL TOLAK - untuk yang belum upload bukti & status menunggu
                                                elseif($row['status_daftar']=='menunggu' && !$row['id_pembayaran']): ?>
                                                    <form action="../backend/verifikasi_gabungan.php" method="POST">
                                                        <input type="hidden" name="id_pendaftaran" value="<?= $row['id_pendaftaran'] ?>">
                                                        <input type="hidden" name="id_pembayaran" value="0"> <!-- Kosongkan karena belum bayar -->
                                                        <button type="submit" name="aksi" value="ditolak" class="btn btn-sm btn-danger btn-action">
                                                            <i class="fas fa-times me-1"></i>Tolak Pendaftaran
                                                        </button>
                                                        <small class="text-muted d-block mt-1">Belum upload bukti</small>
                                                    </form>

                                                <?php 
                                                // UNTUK STATUS SUDAH VERIFIKASI/DITOLAK
                                                else: ?>
                                                    <!-- Untuk yang sudah diverifikasi -->
                                                    <?php if($row['no_bib']): ?>
                                                        <span class="badge bg-success">
                                                            <i class="fas fa-check me-1"></i><?= $row['no_bib'] ?>
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="text-muted">
                                                            <i class="fas fa-minus"></i>
                                                        </span>
                                                    <?php endif; ?>
                                                    
                                                    <!-- Tombol Hapus untuk status ditolak -->
                                                    <?php if($row['status_daftar'] == 'ditolak'): ?>
                                                        <button type="button" class="btn btn-sm btn-outline-danger btn-action" 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#deleteModal"
                                                                data-id="<?= $row['id_pendaftaran'] ?>"
                                                                data-nama="<?= htmlspecialchars($row['nama_lengkap']) ?>">
                                                            <i class="fas fa-trash me-1"></i>Hapus Pendaftaran
                                                        </button>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="9" class="text-center py-4">
                                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                            <p class="text-muted">Belum ada data pendaftaran</p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- MODAL BUKTI BAYAR -->
<div class="modal fade" id="buktiModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-receipt me-2"></i>
                    Bukti Pembayaran - <span id="namaPeserta"></span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <div id="modalContent"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL KONFIRMASI HAPUS -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Konfirmasi Hapus Data
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus data pendaftaran peserta <strong id="namaPesertaHapus"></strong>?</p>
                <p class="text-danger"><small>Data pendaftaran dan pembayaran akan dihapus, namun data user tetap tersimpan.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Batal
                </button>
                <form id="deleteForm" method="POST" action="../backend/delete_process.php">
                    <input type="hidden" name="id_pendaftaran" id="deleteIdPendaftaran">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>Hapus Pendaftaran
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
// JavaScript untuk modal bukti bayar
document.addEventListener('DOMContentLoaded', function() {
    const buktiModal = document.getElementById('buktiModal');
    
    buktiModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const buktiFile = button.getAttribute('data-bukti');
        const namaPeserta = button.getAttribute('data-nama');
        const fileExtension = buktiFile.split('.').pop().toLowerCase();
        const modalContent = document.getElementById('modalContent');
        const isImage = ['jpg', 'jpeg', 'png'].includes(fileExtension);
        
        // Isi data ke modal
        document.getElementById('namaPeserta').textContent = namaPeserta;
        
        if (isImage) {
            // Tampilkan gambar
            modalContent.innerHTML = `
                <img src="../asset/bukti_bayar/${buktiFile}" 
                     class="modal-bukti-img" 
                     alt="Bukti Pembayaran"
                     onerror="this.style.display='none'; document.getElementById('fallbackContent').style.display='block'">
                <div id="fallbackContent" style="display: none;">
                    <p class="text-muted">Gagal memuat gambar</p>
                    <a href="../asset/bukti_bayar/${buktiFile}" target="_blank" class="btn btn-primary">
                        <i class="fas fa-external-link-alt me-1"></i>Buka File
                    </a>
                </div>
            `;
        } else if (fileExtension === 'pdf') {
            // Tampilkan PDF
            modalContent.innerHTML = `
                <div class="mb-3">
                    <p class="text-muted">File PDF: ${buktiFile}</p>
                    <a href="../asset/bukti_bayar/${buktiFile}" target="_blank" class="btn btn-primary mb-3">
                        <i class="fas fa-external-link-alt me-1"></i>Buka PDF di Tab Baru
                    </a>
                </div>
                <iframe src="../asset/bukti_bayar/${buktiFile}" 
                        width="100%" 
                        height="500px" 
                        style="border: 1px solid #dee2e6; border-radius: 5px;">
                </iframe>
            `;
        } else {
            // File lainnya
            modalContent.innerHTML = `
                <div class="text-center">
                    <i class="fas fa-file fa-4x text-muted mb-3"></i>
                    <p class="text-muted">File: ${buktiFile}</p>
                    <a href="../asset/bukti_bayar/${buktiFile}" target="_blank" class="btn btn-primary">
                        <i class="fas fa-download me-1"></i>Download File
                    </a>
                </div>
            `;
        }
    });

    // JavaScript untuk modal hapus
const deleteModal = document.getElementById('deleteModal');
deleteModal.addEventListener('show.bs.modal', function(event) {
    const button = event.relatedTarget;
    const idPendaftaran = button.getAttribute('data-id');
    const namaPeserta = button.getAttribute('data-nama');
    
    document.getElementById('namaPesertaHapus').textContent = namaPeserta;
    document.getElementById('deleteIdPendaftaran').value = idPendaftaran;
});

    // Auto-close alerts setelah 5 detik
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);
});
</script>
</body>
</html>