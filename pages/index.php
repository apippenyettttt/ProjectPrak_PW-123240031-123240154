<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VETE-RUN | Event Lari Tahunan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #eeeeeeff; 
            /* background-color: #f4f4f4;  */
        }
        .card {
            background-color: rgba(255, 255, 255, 0.9); /* putih transparan sedikit soft */
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        /* NAVBAR */
        #navbar {
            background: rgba(255,255,255,0);
            box-shadow: none;
            transition: .3s;
        }

        #navbar.scrolled {
            background: #ffffff;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        #navbar.scrolled .navlink {
            color: #333 !important;
        }

        /* HERO */
        .hero {
            height: 100vh; /* full height viewport */
            min-height: 600px; /* optional untuk layar kecil */
            position: relative;
            background: url('../asset/img/hero.jpg') center center / cover no-repeat;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
        }

        .hero-content {
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

        /* SECTION TITLE */
        .section-title {
            margin-top: 5rem;
            font-weight: 800;
            font-size: 2rem;
            text-align: center;
            color: #d00000;
            margin-bottom: 2rem;
        }

        .kategori-card {
            border-radius: 12px;
            padding: 25px;
            background: linear-gradient(
                135deg,
                rgba(255, 255, 255, 0.1),   /* soft merah */
                rgba(0, 0, 0, 0.3)        /* soft gelap */
            );
            border: 1px solid rgba(255, 255, 255, 0.15);
            transition: all .3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }
        .kategori-card:hover {
            transform: translateY(-5px);
            background: linear-gradient(
                135deg,
                rgba(0, 0, 0, 0.5),
                rgba(0, 0, 0, 0.1) 
             );
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .kategori-card a {
            text-decoration: none;
            color: inherit;
        }
        .kategori-card:hover {
            cursor: pointer;
        }


        .kategori-title {
            font-size: 1.4rem;
            font-weight: bold;
            color: #b60000; /* tetap merah untuk judul */
        }


        /* FOOTER */
        footer {
            width: 100vw;   
            margin-left: calc(50% - 50vw); 
            margin-right: calc(50% - 50vw);
            margin-top: 5rem;
            background: #000;
            color: #bbb;
            text-align: center;
            padding: 12px 0; 
            font-size: 0.95rem;
        }

        /* RESPONSIVE HERO TEXT */
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2rem;
            }

            .hero-content p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav id="navbar" class="navbar navbar-expand-lg navbar-light fixed-top py-2">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="index.php">
            <img src="../asset/img/logoVTR.png" width="140" class="me-2">
        </a>

        <button class="navbar-toggler btn btn-outline-danger" type="button" data-bs-toggle="collapse"  data-bs-target="#navmenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navmenu">
            <ul class="navbar-nav ms-auto text-center text-lg-end">
                <li class="nav-item">
                    <a class="nav-link fw-semibold text-white navlink" href="#beranda">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold text-white navlink" href="#tentang">Tentang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold text-white navlink" href="#kategori">Kategori</a>
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

<!-- HERO SECTION -->
<section class="hero" id="beranda">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1 class="fw-bold">VETE-RUN 2025</h1>
        <p class="lead">Lomba Lari Tahunan – Bersatu Dalam Semangat Kebugaran & Bela Negara</p>
        <a href="register.php" class="btn btn-danger btn-lg mt-3">Daftar Sekarang</a>
    </div>
</section>

<!-- TENTANG EVENT -->
<section class="container mt-5" id="tentang">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="p-4 p-md-5 rounded shadow-sm" style="background: linear-gradient(100deg, #bc2929ff, #000000ff); color: #fff;">
                <h2 class="fw-bold text-center mb-3" style="color:#ff4d4d;">Tentang VETE-RUN 2025</h2>
                <p class="text-center mb-4" style="font-size: 1.05rem;">
                    <strong>VETE-RUN</strong> adalah event lari tahunan yang diselenggarakan oleh 
                    <strong>UPN “Veteran” Yogyakarta</strong> dengan semangat kebugaran, sportivitas, dan jiwa bela negara.
                </p>
                <div class="row mt-4 text-center">
                    <div class="col-md-4 mb-3">
                        <h5 class="fw-bold" style="color:#ff6969;">🏃‍♂️ Tiga Kategori Lari</h5>
                        <p class="small">5K Fun Run, 15K Challenge, dan 50K Ultra Run untuk pelari profesional.</p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <h5 class="fw-bold" style="color:#ff6969;">🎽 Fasilitas Premium</h5>
                        <p class="small">Race Shirt, BIB Number, Medali Finisher, Hydration Point, dan Asuransi Peserta.</p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <h5 class="fw-bold" style="color:#ff6969;">📍 Rute Ikonik</h5>
                        <p class="small">Mengelilingi kawasan sekitar UPN, Ring Road Utara, Seturan hingga wilayah Sleman.</p>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a href="register.php" class="btn btn-danger btn-lg">Daftar Sekarang</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- KATEGORI LOMBA -->
<section class="container mt-5" id="kategori">
    <h2 class="section-title">Kategori Lomba</h2>

    <div class="row g-4">

        <div class="col-md-4">
            <a href="detail_5k.php" class="text-decoration-none">
                <div class="kategori-card ">
                    <div class="kategori-title">5K FUN RUN</div>
                    <p class="text-muted">Lari jarak pendek untuk pemula & pelari cepat</p>
                <h6 class ="fw-bold text-muted">Start: 08.00 WIB</h6>
                <h6 class ="fw-bold text-muted">Minggu, 7 Desember 2025</h6>
                <h5 class="fw-bold text-danger mt-4">Fasilitas</h5>
                    <ul>
                        <li>BIB Number</li>
                        <li>Kaos Lari (Race Shirt)</li>
                        <li>Medali Finisher</li>
                        <li>Air Mineral & Hydration Point</li>
                        <li>E-Certificate</li>
                        <li>Asuransi Kecelakaan</li>
                    </ul>
    
                    <a href="detail_5k.php" class="btn btn-danger btn-sm">Lihat Detail</a>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="detail_15k.php" class="text-decoration-none">
                <div class="kategori-card">
                    <div class="kategori-title">15K CHALLENGE</div>
                    <p class="text-muted">Tantangan jarak menengah untuk pelari serius</p>
                    <h6 class ="fw-bold text-muted">Start: 06.00 WIB</h6>
                    <h6 class ="fw-bold text-muted">Minggu, 7 Desember 2025</h6>
                    <h5 class="fw-bold text-danger mt-4">Fasilitas</h5>
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
                    <a href="detail_15k.php" class="btn btn-danger btn-sm">Lihat Detail</a>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="detail_50k.php" class="text-decoration-none">
                <div class="kategori-card">
                    <div class="kategori-title">50K ULTRA</div>
                    <p class="text-muted">Kategori ekstrim khusus pelari ultra endurance</p>
                    <h6 class ="fw-bold text-muted">Start: 05.00 WIB</h6>
                    <h6 class ="fw-bold text-muted">Minggu, 7 Desember 2025</h6>
                    <h5 class="fw-bold text-danger mt-4">Fasilitas</h5>
                        <ul>
                            <li>BIB Number + Chip Timing</li>
                            <li>Jersey Premium (Dry-Fit Elite)</li>
                            <li>Jaket Lari (Windbreaker Waterproof)</li>
                            <li>Hydration Bag (Kantong Air 1L)</li>
                            <li>Medali Finisher 50K (Metal Khusus)</li>
                            <li>3 Hydration Station</li>
                            <li>Banana & Recovery Snack</li>
                            <li>Free Photos HD</li>
                            <li>Asuransi Kecelakaan</li>
                            <li>Ambulance & Medical Team</li>
                        </ul>
                    <a href="detail_50k.php" class="btn btn-danger btn-sm">Lihat Detail</a>
                </div>
            </a>
        </div>

    </div>
</section>

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

<!-- FOOTER -->
<footer>
    © 2025 VETE-RUN | Event Lari Kampus Bela Negara
</footer>

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
