<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;

class ReservasiController extends Controller
{
    public function index()
    {
        $data = Reservasi::all();
        return view('dashboard.dashboard', compact('data'));
    }

    public function create()
    {
        return view('reservasi.reservasi');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'telepon' => 'required',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'jenis_ruangan' => 'required', // Ubah ke jenis_ruangan (dari input)
            'paket_menu' => 'required',    // Ubah ke paket_menu (dari input)
            'jumlah_orang' => 'required|integer|min:1',
            'harga_paket' => 'required|numeric|min:0',
            'catatan' => 'nullable',
        ]);

        // Cek bentrok ruangan & jam
        $cek = Reservasi::where('tanggal', $request->tanggal)
            ->where('ruangan', $request->jenis_ruangan)
            ->where(function ($q) use ($request) {
                $q->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                  ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                  ->orWhere(function ($query) use ($request) {
                      $query->where('jam_mulai', '<=', $request->jam_mulai)
                            ->where('jam_selesai', '>=', $request->jam_selesai);
                  });
            })->exists();

        if ($cek) {
            return back()->with('error', 'Maaf, ruangan pada waktu tersebut sudah dibooking.');
        }

        $total = $request->jumlah_orang * $request->harga_paket;

        $reservasi = new Reservasi();
        $reservasi->id_user = auth()->id();
        $reservasi->nama = $request->nama;
        $reservasi->email = $request->email;
        $reservasi->telepon = $request->telepon;
        $reservasi->tanggal = $request->tanggal;
        $reservasi->jam_mulai = $request->jam_mulai;
        $reservasi->jam_selesai = $request->jam_selesai;
        $reservasi->ruangan = $request->jenis_ruangan; // Ubah
        $reservasi->paket = $request->paket_menu;      // Ubah
        $reservasi->jumlah_orang = $request->jumlah_orang;
        $reservasi->harga_paket = $request->harga_paket;
        $reservasi->total_bayar = $total;
        $reservasi->catatan = $request->catatan ?? null;
        $reservasi->status = 'pending';
        $reservasi->save();

        return redirect()->route('transaksi.pembayaran', $reservasi->id);
    }

    public function edit($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        return view('dashboard.edit', compact('reservasi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'         => 'required|string|max:255',
            'email'        => 'required|email',
            'telepon'      => 'required|string|max:20',
            'tanggal'      => 'required|date',
            'jam_mulai'    => 'required',
            'jam_selesai'  => 'required|after:jam_mulai',
            'ruangan'      => 'required|string',
            'paket'        => 'required|string',
            'jumlah_orang' => 'required|integer|min:1',
            'harga_paket'  => 'required|numeric|min:0',
        ]);

        $reservasi = Reservasi::findOrFail($id);
        $reservasi->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Reservasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->delete();
        return redirect()->route('dashboard')->with('success', 'Reservasi berhasil dihapus.');
    }

    public function pembayaran($id)
    {
        $reservasi = Reservasi::findOrFail($id);

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Snap parameter
        $params = [
            'transaction_details' => [
                'order_id'      => 'RESV-' . $reservasi->id,
                'gross_amount'  => $reservasi->total_bayar,
            ],
            'customer_details' => [
                'first_name'    => $reservasi->nama,
                'email'         => $reservasi->email,
                'phone'         => $reservasi->telepon,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('transaksi.pembayaran', compact('reservasi', 'snapToken'));
    }
}
