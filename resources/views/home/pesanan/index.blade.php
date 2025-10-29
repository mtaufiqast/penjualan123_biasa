@extends('layouts.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">
                            Halaman Pemesanan ID : {{ $id_penjualan }}
                            <a class="btn btn-primary btn-sm {{ $penjualan->status == 1 ? 'disabled' : '' }}"
                                href="{{ $penjualan->status == 1 ? '#' : route('detail_pesanan.tambah', $id_penjualan) }}"
                                @if ($penjualan->status == 1) aria-disabled="true" 
            title="Transaksi sudah selesai, tidak dapat menambah produk" @endif>
                                Tambah Produk
                            </a>
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Halaman Pemesanan</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Nama Produk</th>
                                                <th scope="col">Jumlah</th>
                                                <th scope="col">Harga</th>
                                                <th scope="col">Subtotal</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $grandTotal = 0;
                                            @endphp
                                            @foreach ($pesanan as $pesanan)
                                                <tr>
                                                    <td scope="row">{{ $loop->iteration }}</td>
                                                    <td>{{ $pesanan->Produk->name }}</td>
                                                    <td>{{ $pesanan->jml }}</td>
                                                    <td>Rp {{ number_format($pesanan->Produk->price, 0, ',', '.') }}</td>
                                                    <td>Rp
                                                        {{ number_format($pesanan->jml * $pesanan->Produk->price, 0, ',', '.') }}
                                                    </td>
                                                    <td>
                                                        <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                                    </td>
                                                </tr>
                                                @php
                                                    $grandTotal += $pesanan->Produk->price * $pesanan->jml;
                                                @endphp
                                            @endforeach
                                        </tbody>



                                        <tfoot>
                                            <tr class="table-success">
                                                <th colspan="4" class="text-end">Total</th>
                                                <th colspan="2">Rp {{ number_format($grandTotal, 0, ',', '.') }}</th>
                                            </tr>
                                        </tfoot>

                                    </table>
                                </div>
                                {{-- <a class="btn btn-success btn-sm" href="{{ route('penjualan.bayar', $id_penjualan) }}"
                                    onclick="return confirm('Yakin ?')">Bayar</a> --}}

                                <!-- Tombol Bayar -->
                                {{-- <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalBayar{{ $id_penjualan }}">
                                    Bayar
                                </button> --}}

                                <!-- Button trigger modal -->
                                <button type="button"
                                    class="btn btn-warning btn-sm {{ $penjualan->status == 1 ? 'disabled' : '' }}"
                                    data-toggle="modal"
                                    data-target="{{ $penjualan->status == 1 ? '' : '#exampleModal' . $id_penjualan }}"
                                    @if ($penjualan->status == 1) aria-disabled="true" 
        title="Transaksi sudah selesai, tidak dapat melakukan pembayaran" @endif>
                                    Bayar
                                </button>
                                <a class="btn btn-secondary btn-sm" href="{{ route('penjualan.index') }}">Kembali ke
                                    Penjualan</a>


                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $id_penjualan }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('penjualan.bayar', $id_penjualan) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label>Total Bayar</label>
                                                            <input type="number" class="form-control" name="total_harga"
                                                                id="total_harga{{ $id_penjualan }}" 
                                                                {{-- @php
$total =$pesanan->jml * $pesanan->Produk->price; @endphp --}}
                                                                <input type="number" class="form-control"
                                                                name="total_harga" id="total_harga{{ $id_penjualan }}"
                                                                value="{{ $grandTotal }}" readonly>

                                                        </div>

                                                        <div class="mb-3">
                                                            <label>Jumlah Bayar</label>
                                                            <input type="number" class="form-control" name="bayar"
                                                                id="bayar{{ $id_penjualan }}" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label>Kembalian</label>
                                                            <input type="number" class="form-control" name="kembalian"
                                                                id="kembalian{{ $id_penjualan }}" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-success">Konfirmasi
                                                            Bayar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Script hitung kembalian otomatis -->
                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        const total = document.getElementById('total_harga{{ $id_penjualan }}');
                                        const bayar = document.getElementById('bayar{{ $id_penjualan }}');
                                        const kembali = document.getElementById('kembalian{{ $id_penjualan }}');

                                        if (bayar && total && kembali) {
                                            bayar.addEventListener('input', function() {
                                                const totalVal = parseInt(total.value) || 0;
                                                const bayarVal = parseInt(bayar.value) || 0;
                                                kembali.value = bayarVal - totalVal >= 0 ? bayarVal - totalVal : 0;
                                            });
                                        }
                                    });
                                </script>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
