@extends('layouts.master')

@section('content')
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
            <!-- Main content -->
    <section class="content">

            <!-- Default box -->
            <div class="content mt-3">
              <div class="card">
                  <div class="card-header">
                      <h3 class="card-title">Table</h3>
                  </div>
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
                                      <th colspan="2">Action</th>
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
                                          <td>{{ $item->UANG_MUKA }}</td>
                                          <td>{{ $item->PEMBAYARAN }}</td>

                                          <td>
                                              <a href="{{ url('pelanggan/ubah/'.$item->ID_PELANGGAN)}}" class="btn btn-warning btn-sm">
                                              <i class="fa fa-edit"></i> Ubah
                                              </a>
                                          </td>
                                          <td>
                                              <form action="{{ url('pelanggan/'.$item->ID_PELANGGAN)}}" method="POST" class="d-inline" onsubmit="return confirm('Hapus gak nih?')">
                                              @method('delete')
                                              @csrf
                                              <button class="btn btn-danger btn-sm">
                                              <i class="fa fa-trash"></i> Hapus

                                              </button>
                                              </form>
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


