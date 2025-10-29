<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penjualan = Penjualan::all();
        return view('home.penjualan.index', compact('penjualan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pelanggan = Pelanggan::all();
        return view('home.penjualan.tambah', compact('pelanggan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        Penjualan::create([
            'id_pelanggan' => $request->id_pelanggan,
            'tanggal' => date(now()),
            'total_amount' => 0,
            'paid_amount' => 0,
            'change_amount' => 0,
            'status' => 0,
        ]);
        return redirect('/penjualan');
    }

    public function bayar(string $id, Request $request)
    {
        $id_penjualan = $id;
        $penjualan = Penjualan::find($id);
        $pesanan = Pesanan::query()
            ->select('id_penjualan', 'id_produk', Pesanan::raw('SUM(jumlah) as jml'))
            ->where('id_penjualan', $id_penjualan)
            ->groupBy('id_produk')
            ->get();


        //cek stok
        foreach ($pesanan as $ps) {
            $id_produk = $ps->id_produk;
            $produk = Produk::find($id_produk);
            if ($produk->stok < $ps->jml) {
                return redirect('/detail_pesanan/' . $id_penjualan)->with('error', 'Stok barang tidak mencukupi !!');
            }
        }

        //kurangi stok
        foreach ($pesanan as $ps2) {
            $id_produk = $ps2->id_produk;
            $produk = Produk::find($id_produk);
            $produk->decrement('stok', $ps2->jml);
            $penjualan->update([
                'status' => 1,
                'total_amount' => $request->total_harga,
                'paid_amount' => $request->bayar,
                'change_amount' => $request->kembalian
            ]);
        }

        return redirect('/penjualan');
    }


    public function cetak($id)
    {
        // Ambil data penjualan berdasarkan ID beserta detail barang
        $penjualan = Penjualan::with('detail.produk')->findOrFail($id);

        // Kirim data ke view cetak
        return view('home.penjualan.cetak', compact('penjualan'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
