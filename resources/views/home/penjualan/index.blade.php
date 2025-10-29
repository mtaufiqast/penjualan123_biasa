@extends('layouts.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Halaman Penjualan
                            <a href="/penjualan/tambah" class="btn btn-primary btn-sm">Tambah Penjualan Baru</a>
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Halaman Penjualan</li>
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
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Total Harga</th>
                                                <th scope="col">Bayar</th>
                                                <th scope="col">Kembalian</th>
                                                <th scope="col">Pelanggan</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($penjualan as $penjualan)
                                                <tr class="">
                                                    <td scope="row">{{ $loop->iteration }}</td>
                                                    <td>{{ $penjualan->tanggal }}</td>
                                                    <td>{{ $penjualan->total_amount }}</td>
                                                    <td>{{ $penjualan->paid_amount }}</td>
                                                    <td>{{ $penjualan->change_amount }}</td>
                                                    <td>{{ $penjualan->Pelanggan->name }}</td>
                                                    <td>
                                                        @if ($penjualan->status == 1)
                                                            <button class="btn btn-success btn-sm">Berhasil</button>
                                                        @else
                                                            <button class="btn btn-danger btn-sm">Belum Bayar</button>
                                                        @endif
                                                    </td>
                                                    <td>

                                                        <a href="{{ route('detail_pesanan.index', $penjualan->id) }}"
                                                            class="btn btn-info btn-sm">Detail Pesanan</a>

                                                        <a href="{{ route('penjualan.cetak', $penjualan->id) }}"
                                                            class="btn btn-secondary btn-sm">Print</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
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
