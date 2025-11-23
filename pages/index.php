<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VETE-RUN | Event Lari Tahunan</title>
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


        /* HERO */
        .hero {
            height: 85vh;
            position: relative;
            background: url('../asset/img/hero.jpg') center/cover no-repeat;
        }
        .hero-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.45);
        }
        .hero-content {
            position: relative;
            z-index: 2;
            top: 50%;
            transform: translateY(-50%);
            color: white;
            text-align: center;
        }

        /* SECTION TITLE */
        .section-title {
            font-weight: 800;
            font-size: 2.2rem;
            text-align: center;
            color: #d00000;
            margin-bottom: 40px;
        }

        /* KATEGORI CARD */
        .kategori-card {
            border-radius: 12px;
            padding: 25px;
            background: linear-gradient(
            100deg,
            rgba(139, 0, 0, 0.08),
            rgba(0, 0, 0, 0.10)
            );
            border: 2px solid rgba(255, 255, 255, 0.1);
            transition: all .25s ease;
        }
        .kategori-card:hover {
            transform: translateY(-5px);
            background: linear-gradient(
            100deg,
            rgba(139, 0, 0, 0.18),
            rgba(0, 0, 0, 0.20)
            );
            box-shadow: 0 6px 20px rgba(0, 0, 0, .15);
        }
        .kategori-title {
            font-size: 1.4rem;
            font-weight: bold;
            color: #b60000;
        }

        /* FOOTER */
        footer {
            width: 100vw;   
            margin-left: calc(50% - 50vw); /* paksa full dari ujung layar */
            margin-right: calc(50% - 50vw);
            margin-top: 25rem;
            background: #000;
            color: #bbb;
            text-align: center;

            padding: 12px 0; /* lebih tipis */
            font-size: 0.95rem;
        }

    </style>
</head>
<body>

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
                    <a class="nav-link fw-semibold text-white navlink" href="#tentang">Tentang</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fw-semibold text-white navlink" href="#kategori">Kategori</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fw-semibold text-warning navlink" href="login.php">Login</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fw-semibold text-warning navlink" href="register.php">Daftar</a>
                </li>

            </ul>
        </div>
    </div>
</nav>

<!-- HERO SECTION -->
<section class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1 class="fw-bold display-4">VETE-RUN 2025</h1>
        <p class="lead">Lomba Lari Tahunan – Bersatu Dalam Semangat Kebugaran & Bela Negara</p>
        <a href="register.php" class="btn btn-danger btn-lg mt-3">Daftar Sekarang</a>
    </div>
</section>

<section class="container mt-5" id="kategori">
<section class="container mt-5" id="tentang">

<!-- TENTANG EVENT -->
<section class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="p-4 p-md-5 rounded shadow-sm"
                 style="background: linear-gradient(120deg, #111, #3a0000); color: #fff;">

                <h2 class="fw-bold text-center mb-3" style="color:#ff4d4d;">
                    Tentang VETE-RUN 2025
                </h2>

                <p class="text-center mb-4" style="font-size: 1.05rem;">
                    <strong>VETE-RUN</strong> adalah event lari tahunan yang diselenggarakan oleh 
                    <strong>UPN “Veteran” Yogyakarta</strong> dengan semangat kebugaran,
                    sportivitas, dan jiwa bela negara.
                </p>

                <div class="row mt-4 text-center">

                    <div class="col-md-4 mb-3">
                        <h5 class="fw-bold" style="color:#ff6969;">🏃‍♂️ Tiga Kategori Lari</h5>
                        <p class="small">
                            5K Fun Run, 15K Challenge, dan 50K Ultra Run untuk pelari profesional.
                        </p>
                    </div>

                    <div class="col-md-4 mb-3">
                        <h5 class="fw-bold" style="color:#ff6969;">🎽 Fasilitas Premium</h5>
                        <p class="small">
                            Race Shirt, BIB Number, Medali Finisher, Hydration Point,
                            dan Asuransi Peserta.
                        </p>
                    </div>

                    <div class="col-md-4 mb-3">
                        <h5 class="fw-bold" style="color:#ff6969;">📍 Rute Ikonik</h5>
                        <p class="small">
                            Mengelilingi kawasan sekitar UPN, Ring Road Utara,
                            Seturan hingga wilayah Sleman.
                        </p>
                    </div>

                </div>

                <div class="text-center mt-4">
                    <a href="register.php" class="btn btn-danger btn-lg">
                        Daftar Sekarang
                    </a>
                </div>

            </div>

        </div>
    </div>
</section>

<!-- KATEGORI LOMBA -->
<section class="container mt-5">
    <h2 class="section-title">Kategori Lomba</h2>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="kategori-card text-center">
                <div class="kategori-title">5K FUN RUN</div>
                <p class="text-muted">Lari jarak pendek untuk pemula & pelari cepat</p>
                <a href="detail_5k.php" class="btn btn-danger btn-sm">Lihat Detail</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="kategori-card text-center">
                <div class="kategori-title">15K Challenge</div>
                <p class="text-muted">Tantangan jarak menengah untuk pelari serius</p>
                <a href="detail_15k.php" class="btn btn-danger btn-sm">Lihat Detail</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="kategori-card text-center">
                <div class="kategori-title">50K ULTRA</div>
                <p class="text-muted">Kategori ekstrim khusus pelari ultra endurance</p>
                <a href="detail_50k.php" class="btn btn-danger btn-sm">Lihat Detail</a>
            </div>
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


<!--footer-->
<footer>
    © 2025 VETE-RUN | Event Lari Kampus Bela Negara
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
