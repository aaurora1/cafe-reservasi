<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-3">Riwayat Transaksi</h2>
    <p class="text-center">Berikut adalah riwayat transaksi Anda</p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($data_transaksi && count($data_transaksi))
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Pembelian</th>
            <th>Total</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data_transaksi as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->tgl_transaksi }}</td>
                <td>{{ $item->daftar_produk ?? '-' }}</td>
                <td>Rp {{ number_format($item->total_bayar, 0, ',', '.') }}</td>
                <td>
                    @if ($item->status == 'Menunggu Pembayaran')
                        <span class="badge bg-warning">Menunggu</span>
                    @elseif ($item->status == 'Sudah Dibayar')
                        <span class="badge bg-success">Sudah Dibayar</span>
                    @else
                        <span class="badge bg-danger">{{ $item->status }}</span>
                    @endif
                </td>
                <td>
                    @if ($item->status == 'Menunggu Pembayaran')
                        <a href="{{ url('pembayaran/' . $item->id) }}" class="btn btn-info btn-sm">Bayar</a>
                    @endif
                    <a href="{{ url('transaksi/detail/' . $item->id) }}" class="btn btn-primary btn-sm">Detail</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @else
        <div class="alert alert-info text-center">Tidak ada transaksi ditemukan.</div>
    @endif
</div>
</body>
</html>
