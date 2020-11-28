@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Pelanggan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pelanggan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="content mt-3">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Ubah Data Pelanggan</h3>
              </div>
              <div class="card-body pt-2">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('pelanggan.update',['id' => $pelanggan->id]) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Kode</label>
                                        <input type="text" name="kode" class="form-control" value="{{ $pelanggan->kode }}" readonly autofocus required>
                                    </div>
                                </div>
                              <div class="col-md-5">
                                  <div class="form-group">
                                      <label>Nama Pelanggan</label>
                                      <input type="text" name="nama" class="form-control" value="{{ $pelanggan->nama }}" autofocus required>
                                  </div>
                              </div>
                              <div class="col-md-5">
                                  <div class="form-group">
                                      <label>Alamat Pelanggan</label>
                                      <input type="text" name="alamat" class="form-control" value="{{ $pelanggan->alamat }}"  autofocus required>
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label>Email Pelanggan</label>
                                      <input type="text" name="email" class="form-control" value="{{ $pelanggan->email }}"  autofocus required>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label>No Telp</label>
                                      <input type="text" name="no_telp" class="form-control"  value="{{ $pelanggan->no_telp }}" autofocus required>
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
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
