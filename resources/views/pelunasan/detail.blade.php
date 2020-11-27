@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Data Pelunasan</h1>
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
                    <div class="card-body">
                            <td class="text-center">
                                <a href="{{ url('pelunasan')}}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-undo"></i> Kembali
                                </a>
                            </div>
        <table class="table table-bordered">
            <tbody>

            </tbody>
        <table class="table table-bordered">
            <thead>
                <tr>
                <th>ID Pelunasan</th>
                <th>ID Pesanan</th>
                <th>ID User</th>
                <th>Tgl Pesan</th>
                <th>Tgl Pelunasan</th>
                <th>Pesanan</th>
                <th>Jumlah</th>
                <th>Diskon</th>
                <th>Harga Total</th>
                <th>Keterangan</th>
                <th colspan="2">Aksi</th>
            </tr>
            </thead>
            <tbody>
                    @foreach ($pelunasan as $item)
                    <tr>
                        <td>{{ $item->ID_PELUNASAN }}</td>
                        <td>{{ $item->ID_PESANAN }}</td>
                        <td>{{ $item->ID_USER }}</td>
                        <td>{{ $item->TGL_PESAN }}</td>
                        <td>{{ $item->TGL_PELUNASAN }}</td>
                        <td>{{ $item->PESANAN }}</td>
                        <td>{{ $item->JUMLAH }} pcs</td>
                        <td>{{ $item->DISKON }} %</td>
                        <td>Rp.{{ number_format ($item->HARGA_TOTAL, 2,',','.') }}</td>
                        <td>{{ $item->KET }}</td>

                        <td>
                                <a href="{{ url('pelunasan/dcetak/'.$item->ID_PELUNASAN)}}" target="_blank" class="btn btn-primary btn-sm">
                                    <i class="fa fa-print"></i>
                                    </a>
                        </td>
                        <td>
                                <a href="{{ url('pelunasan/data/'.$item->ID_PELUNASAN)}}" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                    </a>
                        </td>

                    </tr>
                    @endforeach
            </tbody>
        </table>
        {{-- <div class="pull-down">
            <a href="{{ url('pesanan/tambah/'.$pelanggan->ID_PELANGGAN)}}" class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i> Tambah Pesanan
            </a>

        </div> --}}
            </div>
            </div>
    </section>
    <!-- /.content -->
  </div>
@endsection


