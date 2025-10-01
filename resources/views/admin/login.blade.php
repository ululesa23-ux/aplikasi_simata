<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login | Aplikasi</title>
  <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="hold-transition login-page">

<div class="login-box">
  <div class="login-logo">
    <b>Aplikasi</b>Simata
  </div>

  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Silakan login untuk masuk</p>

      {{-- Respon gagal login --}}
      @if($errors->any())
          <div class="alert alert-danger text-center">
              <i class="fas fa-exclamation-circle"></i> {{ $errors->first('login_error') }}
          </div>
      @endif

      <form method="POST" action="{{ url('/login') }}">
        @csrf
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username" required>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-user"></span></div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-lock"></span></div>
          </div>
        </div>

        <!-- IMEI wajib diisi sesuai seeder -->
        <div class="input-group mb-3">
          <input type="text" name="imei" class="form-control" placeholder="IMEI" required>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-mobile-alt"></span></div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </div>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- AdminLTE Scripts -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>
