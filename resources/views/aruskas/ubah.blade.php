@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ubah Data ArusKas</h1>
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
                <a href="{{ url('aruskas/detail')}}" class="btn btn-warning btn-sm">
                    <i class="fa fa-undo"></i> Kembali
                </a>
            </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 offset-md-4">
                    <form action="{{ url('aruskas/ubah/')}}/{{$aruskas->ID_TRANSAKSI}}" method="post">
                        @csrf

                        <div class="form-group">
                                <label>ID Transaksi</label>
                        <input type="text" name="ID_Transaksi" class="form-control" value="{{$aruskas->ID_TRANSAKSI}}" readonly autofocus required>
                            </div>
                            <div class="form-group">
                                    <label>ID User</label>
                            <input type="text" name="ID_User" class="form-control" value="{{ $aruskas->ID_USER }}" readonly autofocus required>
                                </div>
                                <div class="form-group">
                                        <label>Tanggal</label>
                                        <input type="date" name="Tanggal" class="form-control" value="{{ $aruskas->TANGGAL }}" autofocus required>
                                    </div>
                        <div class="form-group">
                                <label>Keterangan</label>
                                <input type="text" name="Keterangan" class="form-control" value="{{ $aruskas->KETERANGAN }}" autofocus required>
                            </div>
                            <div class="form-group">
                                    <label>Status</label>
                                    <input type="text" name="Status" class="form-control" value="{{ $aruskas->STATUS }}" autofocus required>
                                </div>
                                <div class="form-group">
                                        <label>Jenis Transaksi</label>
                                        <input type="text" name="Jenis_transaksi" class="form-control" value="{{ $aruskas->JENIS_TRANSAKSI }}" autofocus required>
                                    </div>
                                    <div class="form-group">
                                            <label>Jumlah Tunai</label>
                                            <input type="text" name="Jumlah_tunai" class="form-control" value="{{ $aruskas->JUMLAH_TUNAI }}" autofocus required>
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

