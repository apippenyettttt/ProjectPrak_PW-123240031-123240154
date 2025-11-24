<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Detail Rute 15K | VETE-RUN</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    #navbar {
        background: rgba(255,255,255,0); 
        box-shadow: none;
        }

        #navbar.scrolled {
            background: #ffffff;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        #navbar.scrolled .navlink {
            color: #333 !important;
        }

    .header-banner {
        background: linear-gradient(to right,#000000ff, #ffffffff, #000000ff);
        color: white;
        padding: 60px 20px;
        text-align: center;
        border-radius: 0 0 25px 25px;
    }
    .info-box {
        background: #fff;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        margin-bottom: 25px;
    }
    iframe {
        border-radius: 12px;
        width: 100%;
        height: 350px;
    }
    .btn-back {
        background: #444;
        color: white;
    }
</style>
</head>

<body class="bg-light">
<!-- NAVBAR TRANSPARAN -->
<nav id="navbar" class="navbar navbar-expand-lg navbar-light fixed-top py-2" style="transition: .3s;">
    <div class="container">

        <!-- LOGO -->
        <a class="navbar-brand fw-bold d-flex align-items-center" href="index.php">
            <img src="../asset/img/logoVTR.png" width="140" class="me-2">
        </a>
        <!-- BURGER -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navmenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- MENU -->
        <div class="collapse navbar-collapse justify-content-end" id="navmenu">
            <ul class="navbar-nav ms-auto text-center text-lg-end">

                <li class="nav-item">
                    <a class="nav-link fw-semibold text-white navlink" href="index.php">Beranda</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fw-semibold text-white navlink" href="#kategori">Kategori</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fw-semibold text-white navlink" href="#tentang">Tentang</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fw-semibold text-danger navlink" href="login.php">Login</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fw-semibold text-danger navlink" href="register.php">Daftar</a>
                </li>

            </ul>
        </div>
    </div>
</nav>

<!-- HEADER -->
<div class="header-banner" style="color:black;">
    <h1 class="fw-bold">Rute Lomba 15K</h1>
    <p>Start & Finish: Kampus UPN Veteran Yogyakarta</p>
</div>

<div class="container mt-4">

    <!-- INFO KATEGORI -->
    <div class="info-box">
        <h3 class="fw-bold text-danger">Informasi Kategori 15K</h3>
        <ul>
            <li>Jarak: <strong>15 Kilometer</strong></li>
            <li>Biaya Pendaftaran: <strong>Rp 150.000</strong></li>
            <li>Kuota: <strong>100 Peserta</strong></li>
            <li>Tingkat: <strong>Menengah - Lanjutan</strong></li>
        </ul>

        <h5 class="fw-bold text-danger mt-4">Fasilitas Peserta</h5>
        <ul>
            <li>BIB Number</li>
            <li>Kaos Lari (Race Shirt Premium)</li>
            <li>Jaket Lari Ringan (Windbreaker)</li>
            <li>Medali Finisher (Metal)</li>
            <li>Air Mineral & 2 Hydration Point</li>
            <li>Snack Recovery</li>
            <li>E-Certificate</li>
            <li>Asuransi Kecelakaan</li>
        </ul>
    </div>

    <!-- RUTE MAPS -->
    <div class="info-box">
        <h3 class="fw-bold text-danger">Rute Lomba</h3>
        <p>Melewati area Ring Road Utara → Seturan → Jalan Kaliurang km 10 → Kentungan → kembali ke UPN</p>

        <!-- MAPS EMBED (15K loop) -->
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d7902.325550210417!2d110.40860000000002!3d-7.774100000000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e2!4m3!3m2!1d-7.7743126!2d110.4088673!4m3!3m2!1d-7.764884!2d110.4084502!4m3!3m2!1d-7.7764218!2d110.4142113!5e0!3m2!1sid!2sid!4v1732315555555!5m2!1sid!2sid" 
            loading="lazy" allowfullscreen>
        </iframe>
    </div>

    <!-- TOMBOL -->
    <div class="d-flex justify-content-between mb-4">
        <a href="index.php" class="btn btn-back">← Kembali</a>

        <?php if (!isset($_SESSION['id_user'])) : ?>
            <a href="login.php" class="btn btn-danger">Daftar Sekarang</a>
        <?php else: ?>
            <a href="dashboard.php" class="btn btn-danger">Daftar Sekarang</a>
        <?php endif; ?>
    </div>

</div>

<script>
    window.addEventListener("scroll", function () {
        let navbar = document.getElementById("navbar");
        if (window.scrollY > 60) {
            navbar.classList.add("scrolled");
        } else {
            navbar.classList.remove("scrolled");
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>