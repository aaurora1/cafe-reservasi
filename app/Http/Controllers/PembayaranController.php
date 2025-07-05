<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi;
use App\Models\Pembayaran;
use Midtrans\Snap;
use Midtrans\Transaction;
use Midtrans\Config;

class PembayaranController extends Controller
{
    public function show($id)
{
    $reservasi = Reservasi::with(['ruangan', 'paketMenu'])->findOrFail($id);

    // Konfigurasi Midtrans
    \Midtrans\Config::$serverKey = config('midtrans.server_key');
    \Midtrans\Config::$isProduction = false;
    \Midtrans\Config::$isSanitized = true;
    \Midtrans\Config::$is3ds = true;

    $params = [
        'transaction_details' => [
            'order_id' => $reservasi->id,
            'gross_amount' => $reservasi->total_bayar,
        ],
        'customer_details' => [
            'first_name' => $reservasi->nama,
            'email' => auth()->user()->email,
        ]
    ];

    $snapToken = Snap::getSnapToken($params);

    return view('pembayaran', [
        'snapToken' => $snapToken,
        'orderId' => $reservasi->id,
        'reservasi' => $reservasi // kirim data lengkap
    ]);


    }

    public function handle(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $orderId = $data['order_id'] ?? null;
        $transactionStatus = $data['transaction_status'] ?? null;

        if ($orderId && $transactionStatus) {
            $reservasi = Reservasi::find($orderId);
            if ($reservasi) {
                if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
                    $reservasi->status = 'Sudah Dibayar';
                } elseif ($transactionStatus == 'pending') {
                    $reservasi->status = 'Menunggu Pembayaran';
                } else {
                    $reservasi->status = 'Gagal';
                }
                $reservasi->save();
            }
        }

        return response()->json(['message' => 'Callback handled'], 200);
    }

    public function cekbayar($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        return view('transaksi.riwayatuser', [
            'data_transaksi' => [$reservasi]
        ]);
    }
    public function detail($id)
    {
        $transaksi = Reservasi::with(['ruangan', 'paket'])->findOrFail($id);
        return view('detail_transaksi', compact('transaksi'));
    }
    public function cekbayarAll()
{
    $data_transaksi = Reservasi::where('id_user', auth()->user()->id)->get();
    return view('transaksi.riwayatuser', compact('data_transaksi'));
}

}
