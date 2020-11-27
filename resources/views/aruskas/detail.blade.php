@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Arus Kas</h1>
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
                    <div class="pull-right">
                            <a href="{{ url('aruskas')}}" class="btn btn-warning btn-sm">
                                <i class="fa fa-undo"></i> Kembali
                            </a>

                        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Jenis Transaksi</th>
                <th>Jumlah Tunai</th>
            </tr>
            </thead>
            <tbody>
                    @foreach ($aruskas as $item)
                    <tr>
                        <td>{{ $item->STATUS }}</td>
                        <td>{{ $item->TANGGAL }}</td>
                        <td>{{ $item->KETERANGAN }}</td>
                        <td>{{ $item->JENIS_TRANSAKSI }}</td>
                        <td>Rp.{{ number_format($item->JUMLAH_TUNAI, 2,',','.') }}</td>



                        <td class="text-center">
                                <a href="{{ url('aruskas/ubah/'.$item->ID_TRANSAKSI)}}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i> Ubah
                                </a>
                            </td>

                    </tr>
                    @endforeach
            </tbody>
        </table>
            </div>
            </div>
    </section>
    <!-- /.content -->
  </div>
@endsection

