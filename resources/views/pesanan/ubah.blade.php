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
                        <form action="{{ route('pesanan.update',['id' => $pesanan->id]) }}" method="post" onsubmit="return validateForm()">
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Pesanan</label>
                                        <input type="text" name="tgl_pesanan" class="form-control datepicker" value="{{ date('d-m-Y', strtotime($pesanan->tgl_pesanan)) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Jadi</label>
                                        <input type="text" name="tgl_jadi" class="form-control datepicker" value="{{ date('d-m-Y', strtotime($pesanan->tgl_jadi)) }}" required>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <h5>Detail Pesanan</h5>
                                <table width="100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Barang</th>
                                            <th>Jumlah Pesanan</th>
                                            <th>Jumlah Warna</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detail">
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach ($pesanan->details as $key => $item)
                                        <tr>
                                            <td width="2%">
                                                <a href="javascript:void(0)" class="delDetail" data-toggle="tooltip" title="Delete"><span class="fas fa-times-circle text-danger"></a>
                                            </td>
                                            <td width="53%">
                                                <select name="barang[]" class="form-control select2 barang" style="width: 100%;" id="barang_{{ $key }}" data-key="{{ $key }}">
                                                    <option value="">Pilih Barang</option>
                                                    @foreach ($barang as $value)
                                                    <option value="{{ $value->id }}" data-harga="{{ $value->harga_jual }}" data-stok="{{ $value->stok + $item->jumlah_pesanan }}" {{ ($value->id == $item->barang_id) ? 'selected' : ''  }}>{{ $value->nama }} | {{ $value->jenis }} | {{ $value->stok }} | {{ $value->harga_jual }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td width="15%"><input type="number" min="1" required name="jumlah_pesanan[]" class="form-control jml_pesanan" id="jml_pesanan_{{ $key }}" data-key="{{ $key }}" value="{{ $item->jumlah_pesanan }}"></td>
                                            <td width="15%"><input type="number" name="jumlah_warna[]" class="form-control jml_warna" id="jml_warna_{{ $key }}" data-key="{{ $key }}" value="{{ $item->jumlah_warna }}" required></td>
                                            <td width="15%"><input type="text" name="total[]" class="form-control total" id="total_{{ $key }}" value="{{ (($item->jumlah_warna * 10000) + $item->harga_barang) * $item->jumlah_pesanan }}" data-key="{{ $key }}" required readonly></td>
                                        </tr>
                                        @php
                                            $total += (($item->jumlah_warna * 10000) + $item->harga_barang) * $item->jumlah_pesanan;
                                        @endphp
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5"><a href="javascript:void(0)" class="btn btn-sm btn-success" id="add">Tambah</a></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Sub Total</label>
                                        <input type="number" name="sub_total" id="sub_total" value="{{ $total }}" class="form-control" required readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Diskon (%)</label>
                                        <input type="number" id="disc" name="disc" class="form-control" value="{{ $pesanan->disc }}"  min="0" max="100">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Total Harga</label>
                                        <input type="number" name="total_harga" id="total_harga" readonly class="form-control" value="{{ $pesanan->total_harga }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Uang Muka</label>
                                        <input type="number" id="uang_muka" name="uang_muka"  class="form-control" value="{{ $pesanan->uang_muka }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Sisa Pembayaran</label>
                                        <input type="text" id="sisa_pembayaran" name="sisa_pembayaran" class="form-control" value="{{ $pesanan->total_harga - $pesanan->uang_muka }}" readonly required>
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
var list_barang = JSON.parse('{!!$barang!!}');
$(document).ready(function(){
    $('.select2').select2();
    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy'
    }); 
});

$('#uang_muka, #disc').on('keyup', function(){
    total_harga();
    sisa_pembayaran();
});

$('#uang_muka, #disc').on('change', function(){
    total_harga();
    sisa_pembayaran();
});

$('#add').on('click', function(){
    var option = ''
    $.each(list_barang, function(i,v){
        option += '<option value="'+v.id+'" data-harga="'+v.harga_jual+'" data-stok="'+v.stok+'">'+v.nama+' | '+v.jenis+' | '+v.stok+' | '+v.harga_jual+'</option>';
    });
    let number = $('.barang').length;
    $('#detail').append(
        '<tr>'+
            '<td width="2%">'+
                '<a href="javascript:void(0)" class="delDetail" data-toggle="tooltip" title="Delete"><span class="fas fa-times-circle text-danger"></a>'+
            '</td>'+
            '<td width="53%">'+
                '<select name="barang[]" class="form-control select2 barang" style="width: 100%;" id="barang_'+number+'" data-key="'+number+'">'+
                    '<option value="">Pilih Barang</option>'+
                    option+
                '</select>'+
            '</td>'+
            '<td width="15%"><input type="number" min="1" required name="jumlah_pesanan[]" value="0" class="form-control jml_pesanan" id="jml_pesanan_'+number+'" data-key="'+number+'"></td>'+
            '<td width="15%"><input type="number" name="jumlah_warna[]" value="0" class="form-control jml_warna" id="jml_warna_'+number+'" data-key="'+number+'" required></td>'+
            '<td width="15%"><input type="text" name="total[]" value="0" class="form-control total" id="total_'+number+'" data-key="'+number+'" required></td>'+
        '</tr>'
    );
    $('.delDetail').click(function(){
        var toprow = $(this).closest("tr");
        toprow.remove(); 
        sub_total();
        total_harga();
        sisa_pembayaran();
    });
})

$(document).on('keyup', '.barang, .jml_pesanan, .jml_warna', function(){
    let key = $(this).data('key');
    let harga = $('#barang_'+key).find(':selected').data('harga');
    let jumlah = $('#jml_pesanan_'+key).val();
    let warna = $('#jml_warna_'+key).val();
    console.log(harga);
    console.log(jumlah);
    console.log(warna);

    var total = (harga + (warna * 10000)) * jumlah;

    $('#total_'+key).val(total);
    sub_total();
    total_harga();
    sisa_pembayaran();
});

$(document).on('change', '.barang, .jml_pesanan, .jml_warna', function(){
    let key = $(this).data('key');
    let harga = $('#barang_'+key).find(':selected').data('harga');
    let jumlah = $('#jml_pesanan_'+key).val();
    let warna = $('#jml_warna_'+key).val();
    console.log(harga);
    console.log(jumlah);
    console.log(warna);
    var total = (harga + (warna * 10000)) * jumlah;

    $('#total_'+key).val(total);
    sub_total();
    total_harga();
    sisa_pembayaran();
});
$('.delDetail').click(function(){
    var toprow = $(this).closest("tr");
    toprow.remove(); 
    sub_total();
    total_harga();
    sisa_pembayaran();
});

function sub_total(){
    let total = 0;
    $(".total").each(function() {
        total += parseInt($(this).val());
    });
    $('#sub_total').val(total);
}

function total_harga(){
    let total = $('#sub_total').val();
    let disc = $('#disc').val();
    let hasil = parseInt(disc) > 0 ? parseInt(total) - parseInt(total * (parseInt(disc) / 100)) : parseInt(total);
    $('#total_harga').val(hasil);
}

function sisa_pembayaran(){
    let disc = $('#disc').val();;
    let uang_muka = $('#uang_muka').val();
    let total_harga = $('#total_harga').val();

    let hasil = parseInt(total_harga) - parseInt(total_harga * (parseInt(disc) / 100)) - parseInt(uang_muka);
    $('#sisa_pembayaran').val((isNaN(hasil) ? 0 : hasil));
}

function validateForm() {
    var status = true;
    let disc = $('#disc').val();;
    let uang_muka = $('#uang_muka').val();
    let total_harga = $('#total_harga').val();
    let total = total_harga - disc;

    $(".barang").each(function() {
        let key = $(this).data('key');
        let stok = $('#barang_'+key).find(':selected').data('stok');
        let jumlah = $('#jml_pesanan_'+key).val();

        if (stok < jumlah) {
            alert("Pesanan melebihi stok");
            status = false;
        }
    });

    if ((parseInt(total)/2) > parseInt(uang_muka)) {
        alert("Pembayaran minimal 50%");
        status = false;
    }

    if ((parseInt(uang_muka) - parseInt(total_harga * (parseInt(disc) / 100))) > parseInt(total_harga)) {
        alert("Tolong cek nominal uang muka");
        status = false;
    }
    return status;
}
</script>
@endsection