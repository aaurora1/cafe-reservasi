<!-- File: resources/views/dashboard/dashboard.blade.php -->

@extends('template.main')

@section('content')
<section class="py-5" style="background-color: #F7F7F7; min-height: 100vh;">
  <div class="container">
    <h2 class="text-center mb-5 fw-bold" style="color: #FFB22C;">Dashboard Admin - Data Reservasi</h2>

    <div class="mb-4 text-end">
      <a href="{{ route('reservasi.create') }}" class="btn btn-warning">+ Tambah Reservasi</a>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered bg-white">
        <thead class="table-warning">
          <tr class="text-center">
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>No. Telepon</th>
            <th>Tanggal Reservasi</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($reservasis as $index => $data)
          <tr>
            <td class="text-center">{{ $index + 1 }}</td>
            <td>{{ $data->nama }}</td>
            <td>{{ $data->email }}</td>
            <td>{{ $data->telepon }}</td>
            <td class="text-center">{{ $data->tanggal }}</td>
            <td class="text-center">
              <a href="{{ route('reservasi.edit', $data->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
              <form action="{{ route('reservasi.destroy', $data->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin hapus data ini?')">Hapus</button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="text-center">Belum ada data reservasi.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</section>
@endsection
