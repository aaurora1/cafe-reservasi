<!-- File: resources/views/event/event.blade.php -->

@extends('template.main')

@section('content')
<section class="py-5" style="background-color: #FFB22C;">
  <div class="container">
    <h2 class="text-center mb-2 fw-bold">Event di Café Ndalem Hanoman</h2>
    <p class="text-center mb-5">Nikmati momen spesial dengan suasana dan kegiatan yang tak terlupakan.</p>

    <div class="row">
      <div class="col-md-4 mb-4">
        <div class="card" style="background-color: #F7F7F7;">
          <img src="/img/event1.jpg" class="card-img-top" alt="Live Music">
          <div class="card-body">
            <h5 class="card-title">Live Music</h5>
            <p class="card-text">Pertunjukan musik akustik setiap akhir pekan untuk menemani suasana santai Anda.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card" style="background-color: #F7F7F7;">
          <img src="/img/event2.jpg" class="card-img-top" alt="Workshop Kopi">
          <div class="card-body">
            <h5 class="card-title">Workshop Kopi</h5>
            <p class="card-text">Belajar langsung dari barista profesional tentang teknik menyeduh kopi yang tepat.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card" style="background-color: #F7F7F7;">
          <img src="/img/event3.jpg" class="card-img-top" alt="Pameran Seni">
          <div class="card-body">
            <h5 class="card-title">Pameran Seni</h5>
            <p class="card-text">Menampilkan karya seniman lokal yang memperkaya suasana café dengan sentuhan seni.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection