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
                    <h1>Data Aruskas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Aruskas</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-body pt-4">
                <form action="{{ route('laporan.aruskas.index') }}" method="GET">
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
        @if (isset($aruskas))
        <div class="card">
            <div class="card-body pt-4">
                <table class="table table-striped table-bordered table-hover display select tg" cellspacing="0" width="100%" border="1" style="margin-top: 10px;">
                    <tr>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Debet</th>
                        <th>Kredit</th>
                    </tr>
                    <?php $total_debet = 0; $total_kredit= 0; ?>
                    @foreach ($aruskas as $key => $item)
                    <tr>
                        <td>{{ date('d-m-Y', strtotime($item->tanggal )) }}</td>
                        <td>{{ $item->keterangan }}</td>
                        @if ($item->status == 1)
                            <td>Rp. {{ number_format ($item->nominal, 0,',','.') }}</td>
                            <td></td>
                            <?php $total_debet += $item->nominal; ?>
                        @else
                            <td></td>
                            <td>Rp. {{ number_format ($item->nominal, 0,',','.') }}</td>
                            <?php $total_kredit += $item->nominal; ?>
                        @endif
                    </tr>
                    @endforeach
                    <tr>
                        <th colspan="2">Sub Total :</th>
                        <th>Rp. {{ number_format ($total_debet, 0,',','.') }}</th>
                        <th>Rp. {{ number_format ($total_kredit, 0,',','.') }}</th>
                    </tr>
                </table>
                <br>
                <form action="{{ route('laporan.aruskas.print') }}" method="GET" target="_blank">
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
