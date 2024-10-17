@extends('layouts.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">Halaman Tambah Penjualan</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Halaman Tambah Penjualan</li>
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
                    <form action="/penjualan/simpan" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Pilih Pelanggan</label>
                            <select
                                class="form-select form-select-lg form-control"
                                name="id_pelanggan"
                                id=""
                                required
                            >
                                <option value="" id="">Pilih Pelanggan</option>
                                @foreach($pelanggan as $p)
                                    <option value="{{ $p->id }}" id="">{{ $p->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                        <a class="btn btn-info" href="/pelanggan">Tambah Pelanggan baru</a>
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