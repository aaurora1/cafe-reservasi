<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up - Café Ndalem Hanoman</title>

  {{-- Bootstrap --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  {{-- Optional: CSS kamu sendiri --}}
  <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>
<body style="background-color: #F7F7F7;">

  {{-- Konten utama --}}
  <section class="vh-100 d-flex align-items-center">
    <div class="container">
      <div class="row">

        <!-- KIRI: Gambar + Kata Persuasif -->
        <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center"
             style="background: url('{{ asset('img/login-cafe.png') }}') no-repeat center center; background-size: cover;">
          <div class="text-white text-center p-4" style="background: rgba(0, 0, 0, 0.5); border-radius: 12px;">
            <h2 class="fw-bold">Bergabung dengan Café Ndalem Hanoman</h2>
            <p class="mt-3">Rasakan kemudahan reservasi dan nikmati penawaran menarik hanya untuk member!</p>
          </div>
        </div>

        <!-- KANAN: Form Sign Up -->
        <div class="col-md-6 bg-white p-5 rounded-end">
          <h3 class="mb-4 text-center">Buat Akun Baru</h3>
          <form method="POST" action="{{ route('register.submit') }}">
            @csrf

            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" required>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-4">
              <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
              <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn w-100 text-white" style="background-color: #FFB22C;">Sign Up</button>

            <div class="text-center mt-3">
              <p class="small">Sudah punya akun? <a href="/login" class="text-warning fw-bold">Sign In</a></p>
            </div>

            <div class="text-center mt-4">
              <button class="btn btn-outline-dark w-100" type="button">
                <img src="/img/google.png" alt="Google" width="20" class="me-2">
                Continue with Google
              </button>
            </div>

          </form>
        </div>

      </div>
    </div>
  </section>

  {{-- Bootstrap JS --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
