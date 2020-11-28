@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Barang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Barang</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Data Barang</h3>
            </div>
            <div class="card-body pt-2">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('barang.simpan') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kode</label>
                                        <input type="text" name="kode" class="form-control" value="{{ $kode }}" readonly autofocus required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Barang</label>
                                        <input type="text" name="nama" class="form-control" autofocus required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Barang</label>
                                        <input type="text" name="jenis" class="form-control" autofocus required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Satuan</label>
                                        <input type="text" name="satuan" class="form-control" autofocus required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Stok</label>
                                        <input type="text" name="stok" class="form-control" autofocus required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Harga Jual</label>
                                        <input type="text" name="harga_jual" class="form-control" autofocus required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Harga Beli</label>
                                        <input type="text" name="harga_beli" class="form-control" autofocus required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Harga PerItem</label>
                                        <input type="text" name="harga_peritem" class="form-control" autofocus required>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
