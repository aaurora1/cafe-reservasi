@extends('template.main')

@section('content')

<section class="vh-100 d-flex align-items-center" style="background-color: #F7F7F7;">
  <div class="container">
    <div class="row">
      
      <!-- KIRI: Gambar + Kata Persuasif -->
      <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center" style="background: url('/img/admin-login.jpg') no-repeat center center; background-size: cover;">
        <div class="text-white text-center p-4" style="background: rgba(0, 0, 0, 0.5); border-radius: 12px;">
          <h2 class="fw-bold">Login Admin Café Ndalem Hanoman</h2>
          <p class="mt-3">Kelola reservasi dan pantau aktivitas café secara efisien dari dashboard admin.</p>
        </div>
      </div>

      <!-- KANAN: Form Login -->
      <div class="col-md-6 bg-white p-5 rounded-end">
        <h3 class="mb-4 text-center">Login Admin</h3>
        <form action="/login-admin" method="POST">
          @csrf
          
          <div class="mb-3">
            <label for="email" class="form-label">Email Admin</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>

          <div class="mb-2">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>

          <div class="text-end mb-3">
            <a href="#" class="small text-muted">Lupa Password?</a>
          </div>

          <button type="submit" class="btn w-100 text-white" style="background-color: #FFB22C;">Sign In</button>

          <div class="text-center mt-4">
            <button class="btn btn-outline-dark w-100" type="button">
              <img src="/img/google-icon.png" alt="Google" width="20" class="me-2">
              Continue with Google
            </button>
          </div>

        </form>
      </div>

    </div>
  </div>
</section>

@endsection
