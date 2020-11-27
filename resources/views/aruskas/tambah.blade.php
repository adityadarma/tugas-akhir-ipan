@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Data Arus Kas</h1>
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

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 offset-md-4">
                    <form action="{{ url('aruskas')}}" method="post">
                        @csrf

                        <div class="form-group">
                                <label>ID Transaksi</label>
                                <input type="text" name="ID_TRANSAKSI" value="{{ $kodeP }}" readonly class="form-control" autofocus required>
                            </div>
                            <div class="form-group">
                                    <label>ID User</label>
                                    <input type="text" name="ID_USER" class="form-control" autofocus required>
                                </div>
                        <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="TANGGAL" class="form-control" autofocus required>
                            </div>
                            <div class="form-group">
                                    <label>Keterangan</label>
                                    <input type="text" name="KETERANGAN" class="form-control" autofocus required>
                                </div>
                                <div class="form-group">
                                        <label>Status</label>
                                        <input type="text" name="STATUS" class="form-control" autofocus required>
                                    </div>
                                    <div class="form-group">
                                            <label>Jenis Transaksi</label>
                                            <input type="text" name="JENIS_TRANSAKSI" class="form-control" autofocus required>
                                        </div>
                                    <div class="form-group">
                                            <label>Jumlah Tunai</label>
                                            <input type="text" name="JUMLAH_TUNAI" class="form-control" autofocus required>
                                        </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="{{ url('aruskas')}}" class="btn btn-danger btn-sm">
                                            <i class="fa"></i> Batal
                                        </a>
                        </form>
                    </div>
                </div>
            </div>
    </section>
    <!-- /.content -->
  </div>
@endsection

