<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar Akun | VETE-RUN 2025</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    background: url('../asset/img/hero.jpg') center/cover no-repeat;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    font-family: 'Segoe UI', sans-serif;
    margin: 0;
}
body::before {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.6);
    z-index: 0;
}
.register-card {
    position: relative;
    background: rgba(0,0,0,0.85);
    border-radius: 12px;
    color: #fff;
    padding: 2rem;
    max-width: 900px;
    width: 100%;
    box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    z-index: 1;
}
.register-card h3 {
    color: #ff4d4d;
    text-align: center;
    margin-bottom: 2rem;
    font-weight: bold;
}
.form-control {
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.3);
    color: #fff;
}
.form-control::placeholder {
    color: rgba(255,255,255,0.7);
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
    margin-top: 0.5rem;
}
.btn-danger:hover {
    background-color: #d00000;
    border-color: #d00000;
}
.btn-secondary {
    background-color: #6c757d;
    border-color: #6c757d;
    margin-top: 0.5rem;
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
label {
    font-weight: 500;
}
</style>
</head>
<body>
<div class="register-card">
    <h3>Daftar Akun VETE-RUN 2025</h3>
    <form action="../backend/register_process.php" method="POST">
        <div class="row g-3">
            <div class="col-md-6 text-start">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap" required>
            </div>
            <div class="col-md-6 text-start">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
            </div>
            <div class="col-md-6 text-start">
                <label class="form-label">Nomor HP</label>
                <input type="text" name="no_hp" class="form-control" placeholder="Masukkan nomor HP">
            </div>
            <div class="col-md-6 text-start">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" placeholder="Masukkan alamat"></textarea>
            </div>
            <div class="col-md-6 text-start">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>
            <div class="col-md-6 text-start">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" name="confirm_password" class="form-control" placeholder="Ulangi password" required>
            </div>
        </div>

        <button type="submit" class="btn btn-danger w-100 mt-3">Daftar</button>
    </form>

    <a href="index.php" class="btn btn-secondary w-100 mt-2 link-offset-2 link-underline link-underline-opacity-0">Kembali ke Beranda</a>
    <p class="mt-3 text-center">Sudah punya akun? <a href="login.php" class="link-underline link-underline-opacity-0">Masuk</a></p>
</div>

<script>
const form = document.querySelector('form');
form.addEventListener('submit', function(e){
    const password = form.password.value;
    const confirm = form.confirm_password.value;
    if(password !== confirm){
        e.preventDefault();
        alert('Password dan konfirmasi password tidak sama!');
        form.password.focus();
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
