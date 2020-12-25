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
                    <h1>Data Jurnal Penjulan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Jurnal Penjulan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-body pt-4">
                <form action="{{ route('laporan.jurnal-penjualan.index') }}" method="GET">
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
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>No Bukti</th>
                        <th>Debet</th>
                        <th>Kredit</th>
                    </tr>
                    <?php $debet = 0; $kredit = 0; ?>
                    @foreach ($pesanan as $item)
                    <tr>
                        <td>{{ date('d-m-Y', strtotime($item->tanggal )) }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td>{{ $item->no_bukti }}</td>
                        <td>Rp. {{ number_format($item->debet, 0,',','.') }}</td>
                        <td>Rp. {{ number_format($item->kredit, 0,',','.') }}</td>
                    </tr>
                    <?php $debet += $item->debet; $kredit += $item->kredit ; ?>
                    @endforeach
                    <tr>
                        <th colspan="3">Total :</th>
                        <th>Rp. {{ number_format ($debet, 0,',','.') }}</th>
                        <th>Rp. {{ number_format ($kredit, 0,',','.') }}</th>
                    </tr>
                </table>
                <br>
                <form action="{{ route('laporan.jurnal-penjualan.print') }}" method="GET" target="_blank">
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
