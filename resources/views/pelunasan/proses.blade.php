@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Proses Tambah Data Pelunasan</h1>
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
                <a href="{{ url('pelanggan')}}" class="btn btn-warning btn-sm">
                    <i class="fa fa-undo"></i> Kembali
                </a>
            </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 offset-md-4">
                    <form action="{{ url('pelunasan')}}" method="post">
                        @csrf

                        <div class="form-group">
                                <label>ID Pelunasan</label>
                                <input type="text" name="ID_PELUNASAN" readonly value="{{ $kodeP }}" class="form-control" autofocus required>
                            </div>
                            <div class="form-group">
                                    <label>ID Pesanan</label>
                                    <input type="text" name="ID_PESANAN" readonly value="{{ $pesanans->ID_PESANAN }}" class="form-control" autofocus required>
                                </div>
                        <div class="form-group">
                                <label>ID User</label>
                                <input type="text" name="ID_USER" readonly value="{{ $pesanans->ID_USER }}" class="form-control" autofocus required>
                            </div>
                            <div class="form-group">
                                    <label>ID Pelanggan</label>
                                    <input type="text" name="ID_PELANGGAN" readonly value="{{ $pesanans->ID_PELANGGAN }}" class="form-control" autofocus required>
                                </div>
                                <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" name="NAMA" readonly value="{{ $pesanans->NAMA_PELANGGAN }}" class="form-control" autofocus required>
                                    </div>
                                    <div class="form-group">
                                            <label>Tgl Pesan</label>
                                            <input type="text" name="TGL_PESAN" class="form-control" readonly value="{{ $pesanans->TGL_PESANAN }}" autofocus required>
                                        </div>
                                <div class="form-group">
                                    <label>Tgl Pelunasan</label>
                                        <input type="date" name="TGL_PELUNASAN" class="form-control" autofocus required>
                                    </div>
                                    <div class="form-group">
                                        <label>Pesanan</label>
                                        <input type="text" name="PESANAN" class="form-control" readonly value="{{ $pesanans->JENIS_PESANAN }}" autofocus required>
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah</label>
                                        <input type="text" name="JUMLAH" class="form-control" readonly value="{{ $pesanans->JUMLAH_PESANAN }}" autofocus required>
                                    </div>
                                    <div class="form-group">
                                        <label>Diskon</label>
                                        <input type="text" name="DISKON" class="form-control" readonly value="{{ $pesanans->DISC }}" autofocus required>
                                    </div>
                                    <div class="form-group">
                                        <label>Harga Total</label>
                                        <input type="text" name="HARGA_TOTAL" readonly value="{{ $pesanans->TOTAL_HARGA }}" class="form-control" autofocus required>
                                    </div>
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <input type="text" name="KET" class="form-control" autofocus required>
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


