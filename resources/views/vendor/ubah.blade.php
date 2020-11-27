@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ubah Data Vendor</h1>
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
                <a href="{{ url('vendor')}}" class="btn btn-warning btn-sm">
                    <i class="fa fa-undo"></i> Kembali
                </a>
            </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 offset-md-4">
                    <form action="{{ url('vendor/ubah/')}}/{{$vendor->ID_VENDOR}}" method="post">
                        @csrf

                        <div class="form-group">
                                <label>ID Vendor</label>
                                <input type="text" name="ID_VENDOR" class="form-control" value="{{$vendor->ID_VENDOR}}" readonly >
                            </div>
                            <div class="form-group">
                                    <label>ID User</label>
                                    <input type="text" name="ID_USER" class="form-control" value="{{$vendor->ID_USER}}" readonly >
                                </div>
                        <div class="form-group">
                                <label>Nama Vendor</label>
                                <input type="text" name="NAMA_VENDOR" class="form-control" value="{{$vendor->NAMA_VENDOR}}" autofocus required>
                            </div>
                            <div class="form-group">
                                    <label>Alamat Vendor</label>
                                    <input type="text" name="ALAMAT_VENDOR" class="form-control" value="{{$vendor->ALAMAT_VENDOR}}" autofocus required>
                                </div>
                                <div class="form-group">
                                        <label>Email Vendor</label>
                                        <input type="text" name="EMAIL_VENDOR" class="form-control" value="{{$vendor->EMAIL_VENDOR}}" autofocus required>
                                    </div>
                                    <div class="form-group">
                                            <label>No Telepon</label>
                                            <input type="text" name="NO_TELEPON" class="form-control" value="{{$vendor->NO_TELEPON}}" autofocus required>
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

