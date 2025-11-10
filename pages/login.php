<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login|veteRUN</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="card mx-auto shadow" style="max-width:400px;">
    <div class="card-body">
      <h3 class="text-center mb-3 text-danger fw-bold">Login VETE-RUN</h3>
      <form action="../backend/login_process.php" method="POST">
        <div class="mb-3">
          <label>Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-danger w-100">Login</button>
      </form>
      <p class="mt-3 text-center">Belum punya akun? <a href="register.php">Daftar</a></p>
    </div>
  </div>
</div>
</body>
</html>
