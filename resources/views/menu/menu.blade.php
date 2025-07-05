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
          ['title' => 'Wedang Jeruk', 'harga' => '7K', 'desc' => 'Jeruk Peras Khas Hanoman', 'img' => 'wedang-jeruk.jpg'],
          ['title' => 'Wedang Teh Anjani', 'harga' => '5K', 'desc' => 'Teh Khas Ndalem Hanoman', 'img' => 'wedang-anjani.jpg'],
          ['title' => 'Wedang Dewi Sri', 'harga' => '15K', 'desc' => 'Jeruk, Susu, dan Sereh', 'img' => 'wedang-dewi-sri.jpg'],
          ['title' => 'Wedang Anila', 'harga' => '15K', 'desc' => 'Jahe, Susu, Kayu Manis', 'img' => 'wedang-anila.jpg'],
          ['title' => 'Wedang Aswanikumba', 'harga' => '13K', 'desc' => 'Teh, Jahe, dan Susu', 'img' => 'wedang-aswanikumba.jpg'],
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
          <img src="{{ asset('img/daren.jpg') }}" class="card-img-top" alt="Espresso" style="height: 180px; object-fit: cover;">
          <div class="card-body">
            <h5 class="card-title">Daren <span class="float-end">18K</span></h5>
            <p class="card-text">Espresso, Secret Milk dan Whipcream.</p>
          </div>
        </div>
      </div>

      <div class="col-md-3 mb-4 menu-item espresso" style="display: none;">
        <div class="card shadow h-100 bg-white">
          <img src="{{ asset('img/aren.jpg') }}" class="card-img-top" alt="Espresso" style="height: 180px; object-fit: cover;">
          <div class="card-body">
            <h5 class="card-title">Aren <span class="float-end">18K</span></h5>
            <p class="card-text">Espresso, Susu Segar dan Gula Aren.</p>
          </div>
        </div>
      </div>

      <div class="col-md-3 mb-4 menu-item espresso" style="display: none;">
        <div class="card shadow h-100 bg-white">
          <img src="{{ asset('img/cap.jpg') }}" class="card-img-top" alt="Espresso" style="height: 180px; object-fit: cover;">
          <div class="card-body">
            <h5 class="card-title">Cappucino <span class="float-end">18K</span></h5>
            <p class="card-text">Espresso dan Susu Segar.</p>
          </div>
        </div>
      </div>

      <div class="col-md-3 mb-4 menu-item espresso" style="display: none;">
        <div class="card shadow h-100 bg-white">
          <img src="{{ asset('img/vanila.jpg') }}" class="card-img-top" alt="Espresso" style="height: 180px; object-fit: cover;">
          <div class="card-body">
            <h5 class="card-title">Vanila Latte <span class="float-end">18K</span></h5>
            <p class="card-text">Espresso Susu Segar dan Vanila.</p>
          </div>
        </div>
      </div>

      <div class="col-md-3 mb-4 menu-item espresso" style="display: none;">
        <div class="card shadow h-100 bg-white">
          <img src="{{ asset('img/caffelatte.jpg') }}" class="card-img-top" alt="Espresso" style="height: 180px; object-fit: cover;">
          <div class="card-body">
            <h5 class="card-title">Caffe Latte <span class="float-end">18K</span></h5>
            <p class="card-text">Espresso dan Susu Segar.</p>
          </div>
        </div>
      </div>

      <!-- Snack (contoh) -->
      <div class="col-md-3 mb-4 menu-item snack" style="display: none;">
        <div class="card shadow h-100 bg-white">
          <img src="{{ asset('img/d.jpg') }}" class="card-img-top" alt="Snack" style="height: 180px; object-fit: cover;">
          <div class="card-body">
            <h5 class="card-title">Dimsum <span class="float-end">15K</span></h5>
            <p class="card-text">Dimsum Ayam</p>
          </div>
        </div>
      </div>

      <div class="col-md-3 mb-4 menu-item snack" style="display: none;">
        <div class="card shadow h-100 bg-white">
          <img src="{{ asset('img/o.jpg') }}" class="card-img-top" alt="Snack" style="height: 180px; object-fit: cover;">
          <div class="card-body">
            <h5 class="card-title">Otak-otak <span class="float-end">20K</span></h5>
            <p class="card-text">Otak-otak Instan</p>
          </div>
        </div>
      </div>

      <div class="col-md-3 mb-4 menu-item snack" style="display: none;">
        <div class="card shadow h-100 bg-white">
          <img src="{{ asset('img/p.jpg') }}" class="card-img-top" alt="Snack" style="height: 180px; object-fit: cover;">
          <div class="card-body">
            <h5 class="card-title">Pisang Goreng <span class="float-end">20K</span></h5>
            <p class="card-text">Pisang goreng dengan adonan manis</p>
          </div>
        </div>
      </div>

      <div class="col-md-3 mb-4 menu-item snack" style="display: none;">
        <div class="card shadow h-100 bg-white">
          <img src="{{ asset('img/g.jpg') }}" class="card-img-top" alt="Snack" style="height: 180px; object-fit: cover;">
          <div class="card-body">
            <h5 class="card-title">Gemblong Cotot <span class="float-end">20K</span></h5>
            <p class="card-text">Olahan Singkong Lembut Diisi Gula Manis</p>
          </div>
        </div>
      </div>

      <div class="col-md-3 mb-4 menu-item snack" style="display: none;">
        <div class="card shadow h-100 bg-white">
          <img src="{{ asset('img/k.jpg') }}" class="card-img-top" alt="Snack" style="height: 180px; object-fit: cover;">
          <div class="card-body">
            <h5 class="card-title">Kentang Goreng <span class="float-end">20K</span></h5>
            <p class="card-text">Olahan Kentang Crinkle</p>
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
