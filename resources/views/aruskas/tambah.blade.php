@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
          <div class="row mb-2">
              <div class="col-sm-6">
                  <h1>Data Arus Kas</h1>
              </div>
              <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active">Arus Kas</li>
                  </ol>
              </div>
          </div>
      </div><!-- /.container-fluid -->
  </section>

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tambah Data Pelanggan</h3>
        </div>
        <div class="card-body pt-2">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('aruskas.simpan') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Kode</label>
                                    <input type="text" name="kode" class="form-control" value="{{ $kode }}" readonly required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="text" name="tanggal" class="form-control datepicker" required>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input type="text" name="keterangan" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control" required>
                                      <option value="1">Debet</option>
                                      <option value="2">Kredit</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Jenis Transaksi</label>
                                    <select name="jenis_transaksi" class="form-control" required>
                                        <option value="1">Tunai</option>
                                        <option value="2">Non Tunai</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nominal</label>
                                    <input type="number" name="nominal" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="{{ route('aruskas.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
      </div>            
    </section>
    <!-- /.content -->
  </div>
@endsection

@section('script')
<script>
$(document).ready(function(){
    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy'
    }); 
});
</script>
@endsection