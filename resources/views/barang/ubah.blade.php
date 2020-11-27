@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ubah Data Barang</h1>
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
                    <form action="{{ url('barang/ubah/')}}/{{$barang->ID_BARANG}}" method="post">
                        @csrf

                        <div class="form-group">
                                <label>ID Barang</label>
                                <input type="text" name="ID_Barang" class="form-control" value="{{$barang->ID_BARANG}}" readonly autofocus required>
                            </div>
                            <div class="form-group">
                                    <label>ID User</label>
                                    <input type="text" name="ID_User" class="form-control" value="{{$barang->ID_USER}}" readonly autofocus required>
                                </div>
                        {{-- <div class="form-group">
                                <label>ID Pesanan</label>
                                <input type="text" name="ID_Pesanan" class="form-control" value="{{$barang->ID_PESANAN}}" autofocus required>
                            </div> --}}
                            <div class="form-group">
                                    <label>Kode Barang</label>
                                    <input type="text" name="Kode_Barang" class="form-control" value="{{$barang->KODE_BARANG}}" readonly autofocus required>
                                </div>
                                <div class="form-group">
                                        <label>Nama Barang</label>
                                        <input type="text" name="Nama_Barang" class="form-control" value="{{$barang->NAMA_BARANG}}" autofocus required>
                                    </div>
                                    <div class="form-group">
                                            <label>Jenis Barang</label>
                                            <input type="text" name="Jenis_Barang" class="form-control" value="{{$barang->JENIS_BARANG}}" autofocus required>
                                        </div>
                                        <div class="form-group">
                                                <label>Satuan</label>
                                                <input type="text" name="Satuan" class="form-control" value="{{$barang->SATUAN}}" autofocus required>
                                            </div>
                                            <div class="form-group">
                                                    <label>QTY</label>
                                                    <input type="text" name="Qty" class="form-control" value="{{$barang->QTY}}" autofocus required>
                                                </div>
                                                <div class="form-group">
                                                        <label>Harga Jual</label>
                                                        <input type="text" name="Harga_Jual" class="form-control" value="{{$barang->HARGA_JUAL}}" autofocus required>
                                                    </div>
                                                    <div class="form-group">
                                                            <label>Harga Beli</label>
                                                            <input type="text" name="Harga_Beli" class="form-control" value="{{$barang->HARGA_BELI}}" autofocus required>
                                                        </div>
                                                        <div class="form-group">
                                                                <label>Harga PerItem</label>
                                                                <input type="text" name="Harga_PerItem" class="form-control" value="{{$barang->HARGA_PERITEM}}" autofocus required>
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

