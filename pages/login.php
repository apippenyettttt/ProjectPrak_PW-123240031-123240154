<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | VETE-RUN 2025</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
        background: url('../asset/img/hero.jpg') center/cover no-repeat;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: 'Segoe UI', sans-serif;
        position: relative;
    }

    body::before {
        content: "";
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.6); /* overlay gelap */
    }

    .login-card {
        position: relative; /* di atas overlay */
        background: rgba(0, 0, 0, 0.85);
        padding: 2rem;
        border-radius: 12px;
        color: #fff;
        max-width: 400px;
        width: 100%;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        animation: fadeIn 1s ease-in-out;
    }

    .login-card h3 {
        color: #ff4d4d;
        margin-bottom: 1.5rem;
        font-weight: bold;
    }

    .form-control {
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.3);
        color: #fff;
    }

    .form-control::placeholder {
        color: rgba(255,255,255,0.7);
        opacity: 1;
    }

    .form-control:focus {
        background: rgba(255,255,255,0.15);
        border-color: #ff4d4d;
        color: #fff;
        box-shadow: none;
    }

    .btn-danger {
        background-color: #ff4d4d;
        border-color: #ff4d4d;
    }

    .btn-danger:hover {
        background-color: #d00000;
        border-color: #d00000;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
        margin-top: 0.75rem;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
    }

    a {
        color: #ff4d4d;
    }

    a:hover {
        color: #d00000;
        text-decoration: underline;
    }

    @keyframes fadeIn {
        from {opacity: 0; transform: translateY(-20px);}
        to {opacity: 1; transform: translateY(0);}
    }
  </style>
</head>
<body>
  <div class="login-card text-center">
    <h3>Login VETE-RUN 2025</h3>
    <form action="../backend/login_process.php" method="POST">
      <div class="mb-3 text-start">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
      </div>
      <div class="mb-3 text-start">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
      </div>
      <button type="submit" class="btn btn-danger w-100">Login</button>
    </form>

    <!-- Tombol tambahan untuk kembali ke beranda -->
    <a href="index.php" class="btn btn-secondary w-100">Kembali ke Beranda</a>

    <p class="mt-3">Belum punya akun? <a href="register.php">Daftar Sekarang</a></p>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
