<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Detail Rute 50K | VETE-RUN</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: url('../asset/img/lari.jpg') center/cover no-repeat fixed;
    min-height: 100vh;
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    position: relative;
}

body::before {
    content: "";
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.45);
    z-index: 0;
}

#navbar {
    background: transparent;
    transition: .3s;
    z-index: 10;
}
#navbar.scrolled {
    background: #d6d6d6ff;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
}
#navbar .navlink {
    color: #fff !important;
}
#navbar.scrolled .navlink {
    color: #000000ff !important;
}

.header-banner {
    position: relative;
    z-index: 1;
    text-align: center;
    padding: 70px 20px;
    color: #fff;
}
.header-banner h1 {
    font-weight: 800;
    color: #ff0000ff;
}

.info-box {
    background: rgba(0,0,0,0.65);
    border-radius: 12px;
    padding: 25px;
    color: #fff;
    box-shadow: 0 10px 20px rgba(0,0,0,0.6);
    margin-bottom: 30px;
    position: relative;
    z-index: 1;
}
.info-box h3 {
    color: #ff4d4d;
    font-weight: 700;
}

iframe {
    width: 100%;
    height: 350px;
    border-radius: 12px;
    border: 2px solid rgba(255,255,255,0.3);
}

.btn-danger {
    background-color: #ff4d4d;
    border-color: #ff4d4d;
    font-weight: 600;
}
.btn-danger:hover {
    background-color: #d00000;
}

.btn-back {
    background: rgba(255,255,255,0.2);
    color: #fff;
    border: 1px solid rgba(255,255,255,0.3);
}
.btn-back:hover {
    background: rgba(255,255,255,0.35);
    color: #000;
}

[id]::before {
    content: "";
    display: block;
    height: 85px;
    margin-top: -50px;
}

body::before { pointer-events: none; }
nav, .header-banner, .info-box, iframe, .btn, .container { position: relative; z-index: 2; }
</style>
</head>

<body>
<!-- NAVBAR -->
<nav id="navbar" class="navbar navbar-expand-lg fixed-top py-2">
    <div class="container">

        <a class="navbar-brand fw-bold d-flex align-items-center text-white" href="index.php">
            <img src="../asset/img/logoVTR.png" width="140">
        </a>
        <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navmenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navmenu">
            <ul class="navbar-nav ms-auto text-center">
                <li class="nav-item">
                    <a class="nav-link fw-semibold navlink" href="index.php">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold navlink" href="#info50">Informasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold navlink" href="#rute">Rute</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<div class="header-banner">
    <h1 class="fw-bold">Rute Lomba 50K</h1>
    <p>Start & Finish: Kampus UPN Veteran Yogyakarta — Ultra Distance Route</p>
</div>

<div class="container mt-4">

    <div class="info-box" id="info50">
        <h3 class="fw-bold text-danger">Informasi Kategori 50K</h3>
        <ul>
            <li>Jarak: <strong>50 Kilometer</strong></li>
            <li>Biaya Pendaftaran: <strong>Rp 350.000</strong></li>
            <li>Kuota: <strong>50 Peserta</strong></li>
            <li>Tingkat: <strong>Advanced - Profesional</strong></li>
        </ul>

        <h5 class="fw-bold text-danger mt-4">Fasilitas Peserta</h5>
        <ul>
            <li>BIB Number + Chip Timing</li>
            <li>Jersey Premium</li>
            <li>Jaket Lari Waterproof</li>
            <li>Hydration Bag 1L</li>
            <li>Medali Finisher 50K</li>
            <li>3 Hydration Station</li>
            <li>Snack Recovery</li>
            <li>Foto HD</li>
            <li>Asuransi</li>
            <li>Ambulance & Medical Team</li>
        </ul>
    </div>

    <div class="info-box" id="rute">
        <h3 class="fw-bold text-danger">Rute Lomba</h3>
        <p>UPN → Ring Road Utara → Jalan Kaliurang Km 12 → Sleman → Maguwoharjo → kembali ke UPN</p>
         <iframe 
            src="https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d7902.880550210417!2d110.40880000000002!3d-7.773800000000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e2!4m3!3m2!1d-7.7743126!2d110.4088673!4m3!3m2!1d-7.752884!2d110.4074502!4m3!3m2!1d-7.7764218!2d110.4142113!5e0!3m2!1sid!2sid!4v1732317777777!5m2!1sid!2sid" 
            allowfullscreen="" loading="lazy">
        </iframe>
    </div>

    <div class="d-flex justify-content-between mb-4">
        <a href="index.php" class="btn btn-back px-4">← Kembali</a>

        <?php if (!isset($_SESSION['id_user'])) : ?>
            <a href="login.php" class="btn btn-danger px-4">Daftar Sekarang</a>
        <?php else: ?>
            <a href="dashboard.php" class="btn btn-danger px-4">Daftar Sekarang</a>
        <?php endif; ?>
    </div>

</div>

<script>
    window.addEventListener("scroll", () => {
        document.getElementById("navbar").classList.toggle("scrolled", window.scrollY > 60);
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
