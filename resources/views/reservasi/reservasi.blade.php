@include('template.header')
<link rel="stylesheet" href="{{ asset('css/reservasi.css') }}">

<section class="py-5" style="background-color: #FFB22C; min-height: 100vh;">
  <div class="container">
    <h2 class="text-center mb-4 fw-bold text-dark">Reservasi Tempat</h2>

    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('reservasi.store') }}" method="POST" class="bg-white p-4 rounded shadow">
      @csrf

      <div class="row">
        {{-- Nama --}}
        <div class="col-md-6 mb-3">
          <label for="nama" class="form-label">Nama Lengkap</label>
          <input type="text" name="nama" id="nama" class="form-control" required>
        </div>

        {{-- Email --}}
        <div class="col-md-6 mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" id="email" class="form-control" required>
        </div>

        {{-- Telepon --}}
        <div class="col-md-6 mb-3">
          <label for="telepon" class="form-label">No. Telepon</label>
          <input type="text" name="telepon" id="telepon" class="form-control" required>
        </div>

        {{-- Tanggal --}}
        <div class="col-md-6 mb-3">
          <label for="tanggal" class="form-label">Tanggal Reservasi</label>
          <input type="date" name="tanggal" id="tanggal" class="form-control" required>
        </div>

        {{-- Jam Mulai --}}
        <div class="col-md-6 mb-3">
          <label for="jam_mulai" class="form-label">Jam Mulai</label>
          <input type="time" name="jam_mulai" id="jam_mulai" class="form-control" required>
        </div>

        {{-- Jam Selesai --}}
        <div class="col-md-6 mb-3">
          <label for="jam_selesai" class="form-label">Jam Selesai</label>
          <input type="time" name="jam_selesai" id="jam_selesai" class="form-control" required>
        </div>

        {{-- Jumlah Orang --}}
        <div class="col-md-6 mb-3">
          <label for="jumlah_orang" class="form-label">Jumlah Orang</label>
          <input type="number" name="jumlah_orang" id="jumlah_orang" class="form-control" min="1" required>
        </div>

        {{-- Jenis Ruangan --}}
        <div class="col-md-6 mb-3">
          <label for="jenis_ruangan" class="form-label">Jenis Ruangan</label>
          <select name="jenis_ruangan" id="jenis_ruangan" class="form-select" required>
            <option value="">-- Pilih Ruangan --</option>
            <option value="VIP Room">VIP Room</option>
            <option value="Meeting Room">Meeting Room</option>
            <option value="Indoor AC">Indoor AC</option>
            <option value="Backyard Outdoor">Backyard Outdoor</option>
            <option value="Indoor Non-AC">Indoor Non-AC</option>
          </select>
        </div>

        {{-- Pilih Paket --}}
        <div class="col-md-12 mb-3">
          <label class="form-label fw-bold d-block">Pilih Paket:</label>
          <input type="hidden" name="paket_menu" id="paket" required>
          <input type="hidden" name="harga_paket" id="harga_paket" required>

          <div class="row g-3">
            <div class="col-md-4">
              <div class="card paket-card h-100" onclick="selectPaket('Paket Satu', 50000, this)">
                <img src="{{ asset('img/paket1.jpg') }}" class="card-img-top paket-img" alt="Paket Satu">
                <div class="card-body text-center">
                  <h5 class="card-title">Paket Satu</h5>
                  <p class="card-text">Rp 50.000 / orang</p>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card paket-card h-100" onclick="selectPaket('Paket Dua', 75000, this)">
                <img src="{{ asset('img/paket2.jpg') }}" class="card-img-top paket-img" alt="Paket Dua">
                <div class="card-body text-center">
                  <h5 class="card-title">Paket Dua</h5>
                  <p class="card-text">Rp 75.000 / orang</p>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card paket-card h-100" onclick="selectPaket('Paket Tiga', 100000, this)">
                <img src="{{ asset('img/paket3.jpg') }}" class="card-img-top paket-img" alt="Paket Tiga">
                <div class="card-body text-center">
                  <h5 class="card-title">Paket Tiga</h5>
                  <p class="card-text">Rp 100.000 / orang</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- Catatan --}}
        <div class="col-12 mb-3">
          <label for="catatan" class="form-label">Catatan Tambahan</label>
          <textarea name="catatan" id="catatan" class="form-control" rows="3" placeholder="Contoh: minta meja dekat jendela"></textarea>
        </div>

        {{-- Total Harga --}}
        <div class="col-12 mb-3">
          <label class="form-label fw-bold">Total Harga:</label>
          <p id="totalHargaPreview" class="fs-5 text-success">Rp 0</p>
        </div>
      </div>

      <button type="submit" class="btn btn-dark w-100 mt-3">Kirim Reservasi</button>
    </form>
  </div>
</section>

{{-- JavaScript --}}
<script>
  let animInterval;

  function selectPaket(paket, harga, el) {
    document.getElementById('paket').value = paket;
    document.getElementById('harga_paket').value = harga;

    document.querySelectorAll('.paket-card').forEach(card => {
      card.classList.remove('selected');
    });
    el.classList.add('selected');

    updateTotalHarga();
  }

  function updateTotalHarga() {
    const harga = parseInt(document.getElementById('harga_paket').value) || 0;
    const jumlah = parseInt(document.getElementById('jumlah_orang').value) || 0;
    const total = harga * jumlah;

    animateHarga(total);
  }

  function animateHarga(target) {
    clearInterval(animInterval);
    const preview = document.getElementById('totalHargaPreview');
    let current = 0;
    const step = Math.ceil(target / 20);

    animInterval = setInterval(() => {
      current += step;
      if (current >= target) {
        current = target;
        clearInterval(animInterval);
      }
      preview.textContent = formatRupiah(current);
    }, 30);
  }

  function formatRupiah(angka) {
    return new Intl.NumberFormat('id-ID', {
      style: 'currency',
      currency: 'IDR',
      minimumFractionDigits: 0
    }).format(angka);
  }

  document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('jumlah_orang').addEventListener('input', updateTotalHarga);
    updateTotalHarga(); // panggil sekali saat load
  });
</script>

@include('template.footer')
