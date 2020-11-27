@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Pelanggan</h1>
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
                            <a href="{{ url('pelanggan/tambah')}}" class="btn btn-success btn-sm">
                                <i class="fa fa-plus"></i> Tambah
                            </a>
                        </div>
        <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                <th>ID Pelanggan</th>
                <th>Nama Pelanggan</th>
                <th>Alamat Pelanggan</th>
                <th>Email Pelanggan</th>
                <th>No Telp</th>
                <th colspan="2">Action</th>
            </tr>
            </thead>
            <tbody>
                    @foreach ($pelanggan as $item)
                    <tr>
                    <td><a href="{{ url('pesanan/detail/') }}/{{ $item->ID_PELANGGAN }}">{{ $item->ID_PELANGGAN }}</a></td>
                        <td>{{ $item->NAMA_PELANGGAN }}</td>
                        <td>{{ $item->ALAMAT_PELANGGAN }}</td>
                        <td>{{ $item->EMAIL_PELANGGAN }}</td>
                        <td>{{ $item->NO_TELP }}</td>

                        <td class="text-center">
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
            </div>
        </table>
            </div>
            </div>
    </section>
    <!-- /.content -->
</div>
@endsection


