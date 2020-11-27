@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Pesanan</h1>
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
                <a href="{{ url('pesanan')}}" class="btn btn-warning btn-sm">
                    <i class="fa fa-undo"></i> Kembali
                </a>
            </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 offset-md-4">
                    <form action="{{ url('pesanan/posting')}}" method="post">
                        @csrf

                        <div class="form-group">
                                <label>ID Pesanan</label>
                        <input type="text" name="ID_Pesanan" value="{{ $kodeP }}" readonly class="form-control" autofocus required>
                        <input type="hidden" name="ID_Pelanggan" value="{{$ID_PELANGGAN}}" class="form-control" autofocus required>
                        <input type="hidden" name="ID_User" value="{{$user->id}}" class="form-control" autofocus required>
                            </div>
                        <div class="form-group">
                                <label>Tanggal Pesanan</label>
                                <input type="date" name="Tgl_pesanan" class="form-control" autofocus required>
                            </div>
                        <div class="form-group">
                                <label>Tanggal Jadi</label>
                                <input type="date" name="Tgl_jadi" class="form-control" autofocus required>
                            </div>
                        <div class="form-group">
                            <label>Barang</label>
                                {{-- <input type="text" name="Jenis_pesanan" class="form-control" autofocus required> --}}
                                <select name="barang" id="barang" class="form-control">
                                <option value="">Pilih Barang</option>
                                {{-- <option value="ass">ass</option> --}}
                                @foreach ($barang as $item)
                                    <option value="{{$item->ID_BARANG}}" data-harga="{{$item->HARGA_JUAL}}">{{$item->NAMA_BARANG }} - {{ $item->HARGA_JUAL}}</option>
                                @endforeach
                            </select>
                        </div>
                         <div class="form-group">
                                <label>Jenis Pesanan</label>
                               {{-- <input type="text" name="Jenis_pesanan" class="form-control" autofocus required> --}}
                               <select name="Jenis_pesanan" class="form-control">
                               <option value="">Pilihlah</option>
                               @foreach ($barang as $item)
                                    <option value="{{$item->JENIS_BARANG}}">{{$item->JENIS_BARANG}}</option>
                               @endforeach
                            </select>
                            </div>
                         <div class="form-group">
                             <label>Ukuran</label>
                              <input type="text" name="Ukuran" class="form-control" autofocus required>
                             </div>
                        <div class="form-group">
                            <label>Jumlah Pesanan</label>
                            <input type="text" data-harga="" id="jml_pesan" min="1" required name="Jumlah_pesanan" class="form-control">
                        </div>
                         <div class="form-group">
                             <label>Jenis Kain</label>
                             <input type="text" name="Jenis_kain" class="form-control" autofocus required>
                            </div>
                        <div class="form-group">
                            <label>Jumlah Warna</label>
                            <input type="text" id="jml_warna" name="Jumlah_warna" class="form-control" autofocus required>
                            </div>
                         <div class="form-group">
                            <label>Diskon</label>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" id="disc" name="Disc" class="form-control" autofocus required>
                            <span class="input-group-text">%</span>
                        </div>
                        <div class="form-group">
                            <label>Total Harga</label>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Rp</span>
                            <input type="text" name="Total_harga" id="Total_harga"readonly class="form-control" autofocus required>
                            <span class="input-group-append">
                                <button type="button" id="hitung" class="btn btn-info btn-flat">Check</button>
                            </span>
                        </div>
                        <div class="form-group">
                             <label>Uang Muka</label>
                            </div>
                            <div class="input-group mb-3">
                            <span class="input-group-text">Rp</span>
                            <input type="text" name="Uang_muka" class="form-control" autofocus required>
                        </div>
                        <div class="form-group">
                             <label>Pembayaran</label>
                        </div>
                            <div class="input-group mb-3">
                            <span class="input-group-text">Rp</span>
                            <input type="text" name="Pembayaran" class="form-control" autofocus required>
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

@section('script')
<script>
$(document).ready(function(){
    //get barang
    $('#barang').change(function(){
        var harga = $("#barang option:selected").data('harga');
        $('#jml_pesan').attr('data-harga',harga);
    });

    //hitung
    $('#hitung').click(function(){
        var barang = $('#jml_pesan').data('harga'),
         warna = $('#jml_warna').val(),
         jmlP = $('#jml_pesan').val(),
         disc = $('#disc').val(),
         Disc = parseInt(disc)/100,
         totWarna = parseInt(warna)*10000,
         hasil = (parseInt(barang)*parseInt(jmlP))+totWarna,
         Total = hasil * Disc,
         final = hasil - Total;
        $('#Total_harga').val(final);
    });
});
</script>
@endsection

