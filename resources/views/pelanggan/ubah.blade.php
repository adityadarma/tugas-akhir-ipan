@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ubah Data Pelanggan</h1>
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
                    <form action="{{ url('pelanggan/ubah/')}}/{{$pelanggan->ID_PELANGGAN}}" method="post">
                        @csrf

                        <div class="form-group">
                                <label>ID Pelanggan</label>
                        <input type="text" name="ID_PELANGGAN" class="form-control" value="{{$pelanggan->ID_PELANGGAN}}" readonly autofocus required>
                            </div>
                            <div class="form-group">
                                    <label>ID User</label>
                            <input type="text" name="ID_USER" class="form-control" value="{{ $pelanggan->ID_USER }}" readonly autofocus required>
                                </div>
                        <div class="form-group">
                                <label>Nama Pelanggan</label>
                                <input type="text" name="NAMA_PELANGGAN" class="form-control" value="{{ $pelanggan->NAMA_PELANGGAN }}" autofocus required>
                            </div>
                            <div class="form-group">
                                    <label>Alamat Pelanggan</label>
                                    <input type="text" name="ALAMAT_PELANGGAN" class="form-control" value="{{ $pelanggan->ALAMAT_PELANGGAN }}" autofocus required>
                                </div>
                                <div class="form-group">
                                        <label>Email Pelanggan</label>
                                        <input type="text" name="EMAIL_PELANGGAN" class="form-control" value="{{ $pelanggan->EMAIL_PELANGGAN }}" autofocus required>
                                    </div>
                                    <div class="form-group">
                                            <label>No Telp</label>
                                            <input type="text" name="NO_TELP" class="form-control" value="{{ $pelanggan->NO_TELP }}" autofocus required>
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

