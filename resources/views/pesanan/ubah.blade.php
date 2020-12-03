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
                    <h1>Data Pesanan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pesanan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Ubah Data Pesanan</h3>
            </div>
            <div class="animated fadeIn">
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
            </div>
            <div class="card-body pt-2">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('pesanan.update',['id' => $pesanan->id]) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kode</label>
                                        <input type="text" name="kode" class="form-control" value="{{ $pesanan->kode }}" readonly required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pelanggan</label>
                                            <select name="pelanggan" id="pelanggan" class="form-control select2" style="width: 100%;">
                                            @foreach ($pelanggan as $item)
                                                <option value="{{ $item->id }}" {{ ($pesanan->pelanggan_id == $item->id) ? 'selected' : '' }}>{{ $item->nama.' | '.$item->no_telp }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tanggal Pesanan</label>
                                        <input type="text" name="tgl_pesanan" class="form-control datepicker" value="{{ date('d-m-Y', strtotime($pesanan->tgl_pesanan)) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tanggal Jadi</label>
                                        <input type="text" name="tgl_jadi" class="form-control datepicker" value="{{ date('d-m-Y', strtotime($pesanan->tgl_jadi)) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Barang</label>
                                            <select name="barang" id="barang" class="form-control select2" style="width: 100%;">
                                            @foreach ($barang as $item)
                                                <option value="{{ $item->id }}" data-harga="{{ $item->harga_jual }}">{{ $item->nama.' | '.$item->jenis.' | '.$item->harga_jual }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Ukuran</label>
                                        <input type="text" name="ukuran" class="form-control" value="{{ $pesanan->ukuran }}" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Jumlah Pesanan</label>
                                        <input type="number" id="jml_pesanan" required name="jumlah_pesanan" class="form-control" value="{{ $pesanan->jumlah_pesanan }}" min="1">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Jumlah Warna</label>
                                        <input type="number" id="jml_warna" name="jumlah_warna" class="form-control" value="{{ $pesanan->jumlah_warna }}" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Diskon (%)</label>
                                        <input type="number" id="disc" name="disc" class="form-control" value="{{ $pesanan->disc }}"  min="0" max="100">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Total Harga</label>
                                        <input type="number" name="total_harga" id="total_harga" readonly class="form-control" value="0" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Uang Muka</label>
                                        <input type="text" id="uang_muka" name="uang_muka"  class="form-control" value="{{ $pesanan->uang_muka }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Sisa Pembayaran</label>
                                        <input type="text" id="sisa_pembayaran" name="sisa_pembayaran" class="form-control" value="0" readonly required>
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

@section('script')
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script>
$(document).ready(function(){
    $('.select2').select2();
    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy'
    }); 
    total_harga();
    sisa_pembayaran();
});

$('#barang, #jml_pesanan, #jml_warna, #disc').on('change', function(){
    total_harga();
    sisa_pembayaran();
});

$('#jml_pesanan, #jml_warna, #disc').on('keyup', function(){
    total_harga();
    sisa_pembayaran();
});

$('#uang_muka').on('change, keyup', function(){
    sisa_pembayaran();
});

function total_harga(){
    let harga = $("#barang option:selected").data('harga');
    let jml = $('#jml_pesanan').val();
    let warna = $('#jml_warna').val();
    let disc = $('#disc').val();

    let harga_sablon = parseInt(warna) * 10000;
    let hasil = (parseInt(harga) + harga_sablon) * parseInt(jml);
    if(disc){
        hasil_disc = hasil * (parseInt(disc) / 100);
        hasil = hasil - hasil_disc;
    }

    $('#total_harga').val(isNaN(hasil) ? 0 : hasil);
}

function sisa_pembayaran(){
    let uang_muka = $('#uang_muka').val();
    let total_harga = $('#total_harga').val();
    let hasil = parseInt(total_harga) - parseInt(uang_muka);
    $('#sisa_pembayaran').val((isNaN(hasil) ? 0 : hasil));
}
</script>
@endsection

