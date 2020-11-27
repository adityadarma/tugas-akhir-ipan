@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Barang</h1>
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
                            <a href="{{ url('barang/tambah')}}" class="btn btn-success btn-sm">
                                <i class="fa fa-plus"></i> Tambah
                            </a>

                        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                <th>ID Barang</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jenis Barang</th>
                <th>Satuan</th>
                <th>QTY</th>
                <th>Harga Jual</th>
                <th>Harga Beli</th>
                <th>Harga PerItem</th>
                <th colspan="2">Aksi</th>
            </tr>
            </thead>
            <tbody>
                    <?php $total = 0; ?>
                    <?php $stotal = 0; ?>
                    @foreach ($barang as $item)
                    @foreach ($stoks as $s)
                    <?php $stotal += $s->JUMLAH_PESANAN; ?>
                    <?php $total = $item->QTY - $stotal; ?>
                    <tr>
                        <td>{{ $item->ID_BARANG }}</td>
                        <td>{{ $item->KODE_BARANG }}</td>
                        <td>{{ $item->NAMA_BARANG }}</td>
                        <td>{{ $item->JENIS_BARANG }}</td>
                        <td>{{ $item->SATUAN }}</td>
                        <td>{{ $total }} buah</td>
                        <td>Rp.{{ number_format($item->HARGA_JUAL, 2,',','.') }}</td>
                        <td>Rp.{{ number_format($item->HARGA_BELI, 2,',','.') }}</td>
                        <td>Rp.{{ number_format($item->HARGA_PERITEM, 2,',','.') }}</td>

                            <td class="text-center">
                                <a href="{{ url('barang/ubah/'.$item->ID_BARANG)}}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i> Ubah
                                </a>
                            </td>
                            <td>
                                <form action="{{ url('barang/'.$item->ID_BARANG)}}" method="POST" class="d-inline" onsubmit="return confirm('Hapus gak nih?')">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> Hapus

                                    </button>
                                </form>
                            </td>
                    </tr>
                    @endforeach
                    @endforeach
            </tbody>
        </table>
            </div>
            </div>
    </section>
    <!-- /.content -->
  </div>
@endsection

