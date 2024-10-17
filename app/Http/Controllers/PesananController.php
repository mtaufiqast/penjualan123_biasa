<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $id_penjualan = $id;
        // $pesanan = Pesanan::select('id_penjualan', 'id_produk', Pesanan::raw('SUM(jumlah) as jml'))
        //     ->groupBy('id_produk')
        //     ->where('id_penjualan', $id_penjualan)
        //     ->get();
        $pesanan = Pesanan::query()
            ->select('id_penjualan', 'id_produk', Pesanan::raw('SUM(jumlah) as jml'))
            ->where('id_penjualan', $id_penjualan)
            ->groupBy('id_produk')
            ->get();



        return view('home.pesanan.index', compact('id_penjualan', 'pesanan'));
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
        Pesanan::create([
            'id_penjualan' => $id_penjualan,
            'id_produk' => $request->id_produk,
            'jumlah' => $request->jumlah,
        ]);
        return redirect('/detail_pesanan/' . $id_penjualan);
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
