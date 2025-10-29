@extends('layouts.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Halaman Pemesanan ID : {{ $id_penjualan }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Halaman Tambah Produk Pemesanan</li>
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
                                <form action="{{ route('detail_pesanan.simpan', $id_penjualan) }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="" class="form-label">Pilih Produk</label>
                                        <select name="id_produk" class="form-control" id="">
                                            <option value="">Pilih Produk</option>
                                            @foreach ($produk as $pr)
                                                <option value="{{ $pr->id }}">{{ $pr->name }} -
                                                    {{ $pr->stok }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Jumlah</label>
                                        <input type="text" class="form-control" name="jumlah" id=""
                                            aria-describedby="helpId" placeholder="" />
                                    </div>
                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                </form>
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
