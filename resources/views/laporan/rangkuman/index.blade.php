@extends('layouts.master')

@section('style')
<link rel="stylesheet" href="{{asset('dist/css/print-table.css')}}">
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Rangkuman</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Rangkuman</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-body pt-4">
                <form action="{{ route('laporan.rangkuman.index') }}" method="GET">
                    <div class="row">
                        <div class="col-md-2">
                            <input type="text" name="awal" class="form-control datepicker" value="{{ $awal ?? null }}" placeholder="Tanggal Awal" required>
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="akhir" class="form-control datepicker" value="{{ $akhir ?? null }}" placeholder="Tanggal Akhir" required>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Cari</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @if (isset($pesanan))
        <div class="card">
            <div class="card-body pt-4">
                <table class="table table-striped table-bordered table-hover display select tg" cellspacing="0" width="100%" border="1" style="margin-top: 10px;">
                    <tr>
                        <th>Kode Pesanan</th>
                        <th>Tanggal Pesanan</th>
                        <th>Nama Pelanggan</th>
                        <th>Jenis Pesanan</th>
                        <th>Jumlah Pesanan</th>
                        <th>Diskon</th>
                        <th>Total Harga</th>
                        <th>Uang Muka</th>
                        <th>Sisa Pembayaran</th>
                    </tr>
                    <?php $total_harga = 0; $uang_muka = 0; $sisa_pembayaran = 0;?>
                    @foreach ($pesanan as $key => $item)
                    <tr>
                        <td>{{ $item->kode }}</td>
                        <td>{{ date('d-m-Y', strtotime($item->tgl_pesanan )) }}</td>
                        <td>{{ $item->nama_pelanggan }}</td>
                        <td>{{ $item->jenis }}</td>
                        <td>{{ $item->jumlah_pesanan }}</td>
                        <td>{{ $item->disc }}%</td>
                        <td>Rp. {{ number_format ($item->total_harga, 0,',','.') }}</td>
                        <td>Rp. {{ number_format ($item->uang_muka, 0,',','.') }}</td>
                        <td>Rp. {{ number_format ($item->total_harga - $item->uang_muka , 0,',','.') }}</td>
                    </tr>
                    <?php $total_harga += $item->total_harga; $uang_muka += $item->uang_muka ; $sisa_pembayaran += $item->total_harga - $item->uang_muka;?>
                    @endforeach
                    <tr>
                        <th colspan="6">Sub Total :</th>
                        <th>Rp. {{ number_format ($total_harga, 0,',','.') }}</th>
                        <th>Rp. {{ number_format ($uang_muka, 0,',','.') }}</th>
                        <th>Rp. {{ number_format ($sisa_pembayaran, 0,',','.') }}</th>
                    </tr>
                </table>
                <br>
                <form action="{{ route('laporan.rangkuman.print') }}" method="GET" target="_blank">
                    <input type="hidden" name="awal" value="{{ $awal ?? null }}">
                    <input type="hidden" name="akhir" value="{{ $akhir ?? null }}">
                    <button type="submit" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
                </form>
            </div>
        </div>            
        @endif
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
