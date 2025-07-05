@include('template.header')

<section class="py-5" style="background-color: #FFB22C;">
  <div class="container">
    <h2 class="text-center mb-4 fw-bold text-dark">Menu Café Ndalem Hanoman</h2>

    <!-- Filter Kategori -->
    <div class="text-center mb-4">
      <div class="d-flex justify-content-center gap-3 flex-wrap">
        <button type="button" class="btn btn-light active" onclick="filterMenu('wedangan')">Wedangan</button>
        <button type="button" class="btn btn-light" onclick="filterMenu('espresso')">Espresso Based</button>
        <button type="button" class="btn btn-light" onclick="filterMenu('snack')">Snack</button>
      </div>
    </div>

    <!-- Menu Grid -->
    <div class="row" id="menu-container">

      @php
        $wedangan = [
          ['title' => 'Wedang Laksmana', 'harga' => '12K', 'desc' => 'Jahe, Vanila, dan Jeruk Nipis', 'img' => 'wedang-laksmana.jpg'],
          ['title' => 'Wedang Bharata', 'harga' => '12K', 'desc' => 'Teh, Jahe, Vanila, Kayu Manis', 'img' => 'wedang-bharata.jpg'],
          ['title' => 'Wedang Sengkuni', 'harga' => '10K', 'desc' => 'Jahe dan Sereh', 'img' => 'wedang-sengkuni.jpg'],
          ['title' => 'Wedang Kumbakarna', 'harga' => '7K', 'desc' => 'Jahe, Secang, Kayu Manis, Sereh, Kapulaga, Gula Batu', 'img' => 'wedang-kumbakarna.jpg'],
          ['title' => 'Wedang Jeruk', 'harga' => '7K', 'desc' => 'Jeruk Peras Khas Hanoman', 'img' => 'wedang-jeruk.jpg'],
          ['title' => 'Wedang Teh Anjani', 'harga' => '5K', 'desc' => 'Teh Khas Ndalem Hanoman', 'img' => 'wedang-anjani.jpg'],
          ['title' => 'Wedang Dewi Sri', 'harga' => '15K', 'desc' => 'Jeruk, Susu, dan Sereh', 'img' => 'wedang-dewi-sri.jpg'],
          ['title' => 'Wedang Anila', 'harga' => '15K', 'desc' => 'Jahe, Susu, Kayu Manis', 'img' => 'wedang-anila.jpg'],
          ['title' => 'Wedang Aswanikumba', 'harga' => '13K', 'desc' => 'Teh, Jahe, dan Susu', 'img' => 'wedang-aswanikumba.jpg'],
          ['title' => 'Wedang Dewi Shinta', 'harga' => '12K', 'desc' => 'Teh dan Susu', 'img' => 'wedang-dewi-shinta.jpg'],
        ];
      @endphp

      {{-- Loop Menu Wedangan --}}
      @foreach($wedangan as $item)
      <div class="col-md-3 mb-4 menu-item wedangan">
        <div class="card shadow h-100 bg-white">
          <img src="{{ asset('img/'.$item['img']) }}" class="card-img-top" alt="{{ $item['title'] }}" style="height: 180px; object-fit: cover;">
          <div class="card-body">
            <h5 class="card-title">{{ $item['title'] }} <span class="float-end">{{ $item['harga'] }}</span></h5>
            <p class="card-text">{{ $item['desc'] }}</p>
          </div>
        </div>
      </div>
      @endforeach

      <!-- Espresso (contoh) -->
      <div class="col-md-3 mb-4 menu-item espresso" style="display: none;">
        <div class="card shadow h-100 bg-white">
          <img src="{{ asset('img/espresso.jpg') }}" class="card-img-top" alt="Espresso" style="height: 180px; object-fit: cover;">
          <div class="card-body">
            <h5 class="card-title">Espresso <span class="float-end">18K</span></h5>
            <p class="card-text">Espresso dengan aroma kuat dan rasa dalam.</p>
          </div>
        </div>
      </div>

      <!-- Snack (contoh) -->
      <div class="col-md-3 mb-4 menu-item snack" style="display: none;">
        <div class="card shadow h-100 bg-white">
          <img src="{{ asset('img/snack.jpg') }}" class="card-img-top" alt="Snack" style="height: 180px; object-fit: cover;">
          <div class="card-body">
            <h5 class="card-title">Snack Platter <span class="float-end">20K</span></h5>
            <p class="card-text">Aneka gorengan dan camilan khas café</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

@include('template.footer')

<script>
function filterMenu(category) {
  document.querySelectorAll('.menu-item').forEach(item => {
    item.style.display = 'none';
  });
  document.querySelectorAll('.' + category).forEach(item => {
    item.style.display = 'block';
  });

  document.querySelectorAll('.btn').forEach(btn => btn.classList.remove('active'));
  const activeBtn = Array.from(document.querySelectorAll('.btn'))
    .find(btn => btn.textContent.toLowerCase().includes(category));
  if (activeBtn) activeBtn.classList.add('active');
}

window.onload = () => {
  filterMenu('wedangan');
};
</script>
