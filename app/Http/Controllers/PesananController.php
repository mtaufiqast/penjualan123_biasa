<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $id_penjualan = $id;

        // Ambil data penjualan berdasarkan ID
        $penjualan = Penjualan::findOrFail($id_penjualan);

        // Ambil data pesanan dan hitung jumlah per produk
        $pesanan = Pesanan::query()
            ->select('id_penjualan', 'id_produk', DB::raw('SUM(jumlah) as jml'))
            ->where('id_penjualan', $id_penjualan)
            ->groupBy('id_produk')
            ->with('Produk') // agar bisa akses $pesanan->Produk->name dan price di view
            ->get();

        // Kirim data ke view
        return view('home.pesanan.index', compact('id_penjualan', 'pesanan', 'penjualan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $id_penjualan = $id;
        $pesanan = Pesanan::where('id', $id_penjualan)->get();
        $produk = Produk::all();

        return view('home.pesanan.tambah', compact('id_penjualan', 'pesanan', 'produk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, String $id)
    {
        $id_penjualan = $id;
        $id_produk = $request->id_produk;
        $produk = Produk::find($id_produk);

        if ($produk->stok < $request->jumlah) {
            return redirect()->route('detail_pesanan.tambah', $id)->with('error', 'Stok barang tidak mencukupi');
        }
        Pesanan::create([
            'id_penjualan' => $id_penjualan,
            'id_produk' => $request->id_produk,
            'jumlah' => $request->jumlah,
        ]);
        return redirect()->route('detail_pesanan.index', $id_penjualan);
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
