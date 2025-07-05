<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Ndalem Hanoman</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom Login CSS -->
  <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>

<body style="display: flex; flex-direction: column; min-height: 100vh; background-color: #F7F7F7;">

  {{-- LOGIN FORM --}}
  <section class="login-wrapper py-5">
    <div class="container">
      <div class="row bg-white shadow rounded overflow-hidden">

        <!-- KIRI: GAMBAR -->
        <div class="col-md-6 d-none d-md-block p-0">
          <div class="login-image h-100 d-flex align-items-center justify-content-center">
            <div class="text-white text-center px-4">
              <h2 class="fw-bold mb-3">Selamat Datang</h2>
              <p class="mb-0">Reservasi mudah & cepat di Café Ndalem Hanoman</p>
            </div>
          </div>
        </div>


        <!-- KANAN: FORM -->
        <div class="col-md-6 p-5">
          <h3 class="mb-4 text-center fw-bold">Login Akun Anda</h3>

          {{-- Flash Message --}}
          @if (session('error'))
          <div class="alert alert-danger">{{ session('error') }}</div>
          @endif
          @if (session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
          @endif

          <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label class="form-label">Email atau Username</label>
              <input type="text" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" name="password" required>
            </div>

            <div class="text-end mb-3">
              <a href="#" class="small text-muted">Lupa Password?</a>
            </div>

            <button type="submit" class="btn btn-warning w-100 text-white">Sign In</button>

            <div class="text-center mt-3">
              <p class="small">Belum punya akun?
                <a href="{{ route('register') }}" class="text-warning fw-bold">Sign Up</a>
              </p>
            </div>

            <div class="text-center mt-4">
              <button type="button" class="btn btn-outline-secondary w-100">
                <img src="{{ asset('img/google.png') }}" alt="Google" width="20" class="me-2">
                Continue with Google
              </button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </section>
</body>

</html>