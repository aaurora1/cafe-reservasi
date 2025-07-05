<!DOCTYPE html>
<html>
<head>
    <title>Halaman Pembayaran</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <style>
        body { font-family: Arial, sans-serif; padding: 40px; text-align: center; }
        table { margin: 0 auto; border-collapse: collapse; margin-bottom: 20px; }
        td { padding: 8px 15px; text-align: left; }
        h2 { margin-bottom: 30px; }
        .btn-bayar {
            padding: 10px 20px;
            background-color: #2a9d8f;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-bayar:hover {
            background-color: #21867a;
        }
    </style>
</head>
<body>
    <h2>Halaman Pembayaran</h2>

    <table>
        <tr>
            <td><strong>Nama Pemesan</strong></td>
            <td>: {{ $reservasi->nama }}</td>
        </tr>
        <tr>
            <td><strong>Email</strong></td>
            <td>: {{ $reservasi->email }}</td>
        </tr>
        <tr>
            <td><strong>Tanggal Reservasi</strong></td>
            <td>: {{ $reservasi->tanggal }}</td>
        </tr>
        <tr>
            <td><strong>Waktu</strong></td>
            <td>: {{ $reservasi->jam_mulai }} - {{ $reservasi->jam_selesai }}</td>
        </tr>
        <tr>
            <td><strong>Ruangan</strong></td>
            <td>: {{ $reservasi->ruangan->nama_ruangan ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Jumlah Orang</strong></td>
            <td>: {{ $reservasi->jumlah_orang ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Paket Menu</strong></td>
            <td>: {{ $reservasi->paketMenu->nama_paket ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Total Bayar</strong></td>
            <td>: Rp {{ number_format($reservasi->total_bayar, 0, ',', '.') }}</td>
        </tr>
    </table>

    <button class="btn-bayar" id="pay-button">Bayar Sekarang</button>

    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                    alert("Pembayaran berhasil!");
                    window.location.href = "{{ route('transaksi.riwayat', ['id' => $reservasi->id]) }}";
                },
                onPending: function(result){
                    alert("Menunggu pembayaran.");
                },
                onError: function(result){
                    alert("Pembayaran gagal.");
                }
            });
        });
    </script>
</body>
</html>
