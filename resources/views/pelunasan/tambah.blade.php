@extends('layouts.master')

@section('style')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css')}}">
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Pelunasan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pelunasan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Data Pelunasan</h3>
            </div>
            <div class="card-body pt-2">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('pelunasan.simpan') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Kode</label>
                                        <input type="text" name="kode" class="form-control" value="{{ $kode }}" readonly required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pesanan</label>
                                            <select name="pesanan" id="pesanan" class="form-control select2" style="width: 100%;">
                                            <option value="">Pilih Pesanan</option>
                                            @foreach ($pesanan as $item)
                                                <option value="{{ $item->id }}" data-pembayaran="{{ $item->total_harga - $item->uang_muka }}">{{ $item->kode.' | '.$item->nama_pelanggan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>  
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Sisa Pembayaran</label>
                                        <input type="number" id="pembayaran" name="pembayaran"  value="0" class="form-control" required readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tanggal Pelunasan</label>
                                        <input type="text" name="tgl_pelunasan" class="form-control datepicker" value="{{ $tanggal }}" required readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <input type="text" id="keterangan" name="keterangan" value="Lunas" class="form-control" required readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Upload Bukti</label>
                                        <input type="file" id="file" name="file">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a href="{{ route('pelunasan.index') }}" class="btn btn-secondary">Batal</a>
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
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script>
$(document).ready(function(){
    $('.select2').select2();
    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy'
    }); 
});

$('#pesanan').on('change', function(){
  let pembayaran = $("#pesanan option:selected").data('pembayaran');
  $('#pembayaran').val(pembayaran);
});
</script>
@endsection

