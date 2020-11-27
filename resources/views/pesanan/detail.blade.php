@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Pesanan Pelanggan</h1>
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
                                <a href="{{ url('pelanggan')}}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-undo"></i> Kembali
                                </a>
                            </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td>{{$pelanggan->NAMA_PELANGGAN}}</td>
                    <td>{{$pelanggan->ALAMAT_PELANGGAN}}</td>
                </tr>
            </thead>
            <tbody>

            </tbody>
        <table class="table table-bordered">
            <thead>
                <tr>
                <th>ID Pesanan</th>
                <th>ID User</th>
                <th>Tgl Pesanan</th>
                <th>Tgl Jadi</th>
                <th>Jenis Pesanan</th>
                <th>Ukuran</th>
                <th>Jumlah Pesanan</th>
                <th>Jenis Kain</th>
                <th>Jumlah Warna</th>
                <th>Diskon</th>
                <th>Total Harga</th>
                <th>Uang Muka</th>
                <th>Pembayaran</th>
                <th colspan="2">Action</th>
            </tr>
            </thead>
            <tbody>
                    <?php $total = 0; ?>
                    @foreach ($pesanan as $item)
                    <tr>
                        <td>{{ $item->ID_PESANAN }}</td>
                        <td>{{ $item->ID_USER }}</td>
                        <td>{{ $item->TGL_PESANAN }}</td>
                        <td>{{ $item->TGL_JADI }}</td>
                        <td>{{ $item->JENIS_PESANAN }}</td>
                        <td>{{ $item->UKURAN }}</td>
                        <td>{{ $item->JUMLAH_PESANAN }} pcs</td>
                        <td>{{ $item->JENIS_KAIN }}</td>
                        <td>{{ $item->JUMLAH_WARNA }}</td>
                        <td>{{ $item->DISC}}%</td>
                        <td>Rp.{{ number_format ($item->TOTAL_HARGA, 2,',','.') }}</td>
                        <td>Rp.{{ number_format ($item->UANG_MUKA, 2,',','.') }}</td>
                        <td>Rp.{{ number_format ($item->PEMBAYARAN, 2,',','.') }}</td>

                        <td class="text-pull-right">
                                <a href="{{ url('pesanan/dcetak/'.$item->ID_PESANAN)}}" target="_blank" class="btn btn-info btn-sm">
                                        <i class="fa fa-print"></i>
                                    </a>
                                </td>
                        <td>
                                <a href="{{ url('pesanan/ubah/'.$item->ID_PESANAN)}}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i>
                                    </a>
                        </td>
                        <?php $total += $item->TOTAL_HARGA; ?>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="10">SubTotal</td>
                        <td>Rp.{{ number_format ($total, 2,',','.') }}</td>
                    </tr>
            </tbody>
        </table>
        <div class="pull-down">
            <a href="{{ url('pesanan/tambah/'.$pelanggan->ID_PELANGGAN)}}" class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i> Tambah Pesanan
            </a>

        </div>
            </div>
            </div>
    </section>
    <!-- /.content -->
  </div>
@endsection


