@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Data Barang</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="content mt-3">
            <div class="animated fadeIn">

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

        <div class="card-body">
            <td class="text-center">
                <a href="{{ url('barang')}}" class="btn btn-warning btn-sm">
                    <i class="fa fa-undo"></i> Kembali
                </a>
            </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 offset-md-4">
                    <form action="{{ url('barang')}}" method="post">
                        @csrf

                        <div class="form-group">
                                <label>ID Barang</label>
                                <input type="text" name="ID_BARANG" value="{{ $kodeP }}" readonly class="form-control" autofocus required>
                            </div>
                            <div class="form-group">
                                    <label>ID User</label>
                                    <input type="text" name="ID_USER" class="form-control" autofocus required>
                                </div>
                            <div class="form-group">
                                    <label>Kode Barang</label>
                                    <input type="text" name="KODE_BARANG" class="form-control" autofocus required>
                                </div>
                                <div class="form-group">
                                        <label>Nama Barang</label>
                                        <input type="text" name="NAMA_BARANG" class="form-control" autofocus required>
                                    </div>
                                    <div class="form-group">
                                            <label>Jenis Barang</label>
                                            <input type="text" name="JENIS_BARANG" class="form-control" autofocus required>
                                        </div>
                                        <div class="form-group">
                                                <label>Satuan</label>
                                                <input type="text" name="SATUAN" class="form-control" autofocus required>
                                            </div>
                                            <div class="form-group">
                                                    <label>QTY</label>
                                                    <input type="text" name="QTY" class="form-control" autofocus required>
                                                </div>
                                                <div class="form-group">
                                                        <label>Harga Jual</label>
                                                        <input type="text" name="HARGA_JUAL" class="form-control" autofocus required>
                                                    </div>
                                                    <div class="form-group">
                                                            <label>Harga Beli</label>
                                                            <input type="text" name="HARGA_BELI" class="form-control" autofocus required>
                                                        </div>
                                                        <div class="form-group">
                                                                <label>Harga PerItem</label>
                                                                <input type="text" name="HARGA_PERITEM" class="form-control" autofocus required>
                                                            </div>
                                    <button type="submit" class="btn btn-success">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
    </section>
    <!-- /.content -->
  </div>
@endsection

