@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Masukkan ID Pesanan</h1>
          </div>
          {{-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div> --}}
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <form class="form-inline">
        <form action="pelunasan/tambah" method="GET" role="search">
            <div class="input-group mx-sm-3 mb-2">
                    <input type="date" name="idpesan" id="idpesan" class="form-control" placeholder="ID">
                </div>
            <button type="submit" class="btn btn-primary mb-2">Check</button>
        </form>
            <!-- Main content -->
    <section class="content">

            <!-- Default box -->
            <div class="content mt-3">
              <div class="card">
                  {{-- <div class="card-header">
                      <h3 class="card-title">Table</h3>
                  </div> --}}
                  <div class="card-body">
                          <table id="table" class="table table-bordered">
                                  <thead>
                                      <tr>
                                      <th>ID Pesanan</th>
                                      <th>ID Pelanggan</th>
                                      <th>ID User</th>
                                      <th>Tgl Pesan</th>
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
                                      <th colspan="1">Aksi</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($pesanan as $item)
                                      <tr id="findOne">
                                          <td>{{ $item->ID_PESANAN }}</td>
                                          <td>{{ $item->ID_PELANGGAN }}</td>
                                          <td>{{ $item->ID_USER }}</td>
                                          <td>{{ $item->TGL_PESANAN }}</td>
                                          <td>{{ $item->TGL_JADI }}</td>
                                          <td>{{ $item->JENIS_PESANAN }}</td>
                                          <td>{{ $item->UKURAN }}</td>
                                          <td>{{ $item->JUMLAH_PESANAN }} pcs</td>
                                          <td>{{ $item->JENIS_KAIN }}</td>
                                          <td>{{ $item->JUMLAH_WARNA }}</td>
                                          <td>{{ $item->DISC }}%</td>
                                          <td>Rp.{{ number_format($item->TOTAL_HARGA, 2,',','.') }}</td>
                                          <td>Rp.{{ number_format($item->UANG_MUKA, 2,',','.') }}</td>
                                          <td>Rp.{{ number_format($item->PEMBAYARAN, 2,',','.') }}</td>

                                          <td>
                                              <a href="{{ url('pelunasan/proses/'.$item->ID_PESANAN)}}" class="btn btn-warning btn-sm">
                                              <i class="fa fa-edit"></i>
                                              </a>
                                          </td>
                                      </tr>
                                      @endforeach
                                  </tbody>
                              </table>
                  </div>
              </div>
             </div>
          </section>
          <!-- /.content -->
      </form>
    </section>
    <!-- /.content -->
  </div>
@endsection


