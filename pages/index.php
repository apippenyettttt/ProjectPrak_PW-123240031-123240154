<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VETE-RUN | Event Lari Tahunan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body {
            background-color: #04060fff; /* Navy gelap mengikuti konsep register */
            font-family: 'Poppins', sans-serif;
        }

        .card,
        .kategori-card {
            background: rgba(255, 255, 255, 0.12); 
            border: 1px solid rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            color: #fff;
            border-radius: 15px;
            transition: 0.3s ease;
        }

        .kategori-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.18);
        }

        #navbar {
            background: rgba(0,0,0,0.1);
            transition: .3s;
        }
        #navbar.scrolled {
            background: rgba(68, 68, 68, 0.75);
            box-shadow: 0 3px 10px rgba(0,0,0,0.4);
        }
        .navlink {
            color: #ffffff !important;
            font-weight: 600;
        }
        .navlink:hover {
            color: #ff4d4d !important;
        }

        .hero {
            height: 100vh;
            min-height: 600px;
            background: url('../asset/img/hero.jpg') center/cover no-repeat;
            position: relative;
        }
        .hero-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
        }
        .hero-content {
            position: relative;
            z-index: 2;
            top: 50%;
            transform: translateY(-50%);
            color: white;
            text-align: center;
            padding: 0 1rem;
        }
        .hero-content h1 {
            font-size: 3.2rem;
            font-weight: 800;
            text-shadow: 0 0 15px rgba(0,0,0,0.4);
        }

        #tentang-box {
            background: linear-gradient(135deg, #1a2038, #0a0f24);
            color: #fff;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }

        .section-title {
            margin-top: 5rem;
            font-weight: 800;
            font-size: 2.1rem;
            text-align: center;
            color: #ff4d4d;
            margin-bottom: 2rem;
        }

        .kategori-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #ff4d4d;
        }
        footer {
            margin-top: 5rem;
            background: rgba(63, 63, 63, 1);
            color: #aaa;
            text-align: center;
            padding: 15px;
        }
        [id]::before {
        content: "";
        display: block;
        height: 85px;      
        margin-top: -50px;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav id="navbar" class="navbar navbar-expand-lg navbar-dark fixed-top py-2">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center text-white" href="index.php">
            <img src="../asset/img/logoVTR.png" width="140" class="me-2">
        </a>

        <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navmenu">
            <ul class="navbar-nav ms-auto text-center text-lg-end">
                <li class="nav-item"><a class="nav-link navlink" href="#beranda">Beranda</a></li>
                <li class="nav-item"><a class="nav-link navlink" href="#tentang">Tentang</a></li>
                <li class="nav-item"><a class="nav-link navlink" href="#kategori">Kategori</a></li>
                <li class="nav-item"><a class="nav-link text-danger fw-semibold" href="login.php">Login</a></li>
                <li class="nav-item"><a class="nav-link text-danger fw-semibold" href="register.php">Daftar</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="hero" id="beranda">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1>VETE-RUN 2025</h1>
        <p class="lead">Lomba Lari Tahunan – Sportivitas, Kebugaran & Bela Negara</p>
        <a href="register.php" class="btn btn-danger btn-lg mt-3">Daftar Sekarang</a>
    </div>
</section>

<!-- TENTANG -->
<section class="container mt-5" id="tentang">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div id="tentang-box">
                <h2 class="text-center fw-bold mb-4" style="color:#ff6464;">Tentang VETE-RUN 2025</h2>
                <p class="text-center mb-4">
                    <strong>VETE-RUN</strong> adalah event lari tahunan oleh <strong>UPN “Veteran” Yogyakarta</strong>
                    dengan semangat sportivitas dan bela negara.
                </p>

                <div class="row text-center mt-4">
                    <div class="col-md-4 mb-3">
                        <h5 class="fw-bold text-danger">🏃‍♂️ 3 Kategori</h5>
                        <p class="small">5K, 15K, dan 50K Ultra Endurance.</p>
                    </div>

                    <div class="col-md-4 mb-3">
                        <h5 class="fw-bold text-danger">🎽 Fasilitas</h5>
                        <p class="small">Medali, Jersey, Hydration Point, Asuransi.</p>
                    </div>

                    <div class="col-md-4 mb-3">
                        <h5 class="fw-bold text-danger">📍 Rute Ikonik</h5>
                        <p class="small">Area UPN, Ring Road Utara, Seturan & Sleman.</p>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="register.php" class="btn btn-danger btn-lg">Daftar Sekarang</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- KATEGORI -->
<section class="container mt-5" id="kategori">
    <h2 class="section-title">Kategori Lomba</h2>

    <div class="row g-4">

        <!-- 5K -->
        <div class="col-md-4">
            <a href="detail_5k.php" class="text-decoration-none">
                <div class="kategori-card p-4">
                    <div class="kategori-title">5K FUN RUN</div>
                    <p class="text-light">Untuk pemula & pelari cepat.</p>
                    <h6 class="fw-bold text-secondary">Start: 08.00 WIB</h6>
                    <h6 class="fw-bold text-secondary">7 Desember 2025</h6>

                    <h5 class="fw-bold text-danger mt-3">Fasilitas</h5>
                    <ul>
                        <li>BIB Number</li>
                        <li>Race Shirt</li>
                        <li>Medali Finisher</li>
                        <li>Hydration Point</li>
                        <li>E-Certificate</li>
                        <li>Asuransi</li>
                    </ul>

                    <button class="btn btn-danger btn-sm">Lihat Detail</button>
                </div>
            </a>
        </div>

        <!-- 15K -->
        <div class="col-md-4">
            <a href="detail_15k.php" class="text-decoration-none">
                <div class="kategori-card p-4">
                    <div class="kategori-title">15K CHALLENGE</div>
                    <p class="text-light">Untuk pelari serius.</p>
                    <h6 class="fw-bold text-secondary">Start: 06.00 WIB</h6>
                    <h6 class="fw-bold text-secondary">7 Desember 2025</h6>

                    <h5 class="fw-bold text-danger mt-3">Fasilitas</h5>
                    <ul>
                        <li>BIB Number</li>
                        <li>Race Shirt Premium</li>
                        <li>Windbreaker</li>
                        <li>Metal Medal</li>
                        <li>2 Hydration Points</li>
                        <li>Snack Recovery</li>
                    </ul>

                    <button class="btn btn-danger btn-sm">Lihat Detail</button>
                </div>
            </a>
        </div>

        <!-- 50K -->
        <div class="col-md-4">
            <a href="detail_50k.php" class="text-decoration-none">
                <div class="kategori-card p-4">
                    <div class="kategori-title">50K ULTRA</div>
                    <p class="text-light">Ultra endurance level.</p>
                    <h6 class="fw-bold text-secondary">Start: 05.00 WIB</h6>
                    <h6 class="fw-bold text-secondary">7 Desember 2025</h6>

                    <h5 class="fw-bold text-danger mt-3">Fasilitas</h5>
                    <ul>
                        <li>BIB + Chip Timing</li>
                        <li>Jersey Premium</li>
                        <li>Windbreaker Waterproof</li>
                        <li>Hydration Bag 1L</li>
                        <li>Special Metal Medal</li>
                        <li>3 Hydration Stations</li>
                        <li>Recovery Snack</li>
                        <li>Photos HD</li>
                        <li>Medical Team</li>
                    </ul>

                    <button class="btn btn-danger btn-sm">Lihat Detail</button>
                </div>
            </a>
        </div>

    </div>
</section>

<!-- NAVBAR SCROLL -->
<script>
    window.addEventListener("scroll", function () {
        let navbar = document.getElementById("navbar");
        if (window.scrollY > 60) navbar.classList.add("scrolled");
        else navbar.classList.remove("scrolled");
    });
</script>

<footer>© 2025 VETE-RUN | Event Lari Kampus Bela Negara</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
