@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Vendor</h1>
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
                            <a href="{{ url('vendor/tambah')}}" class="btn btn-success btn-sm">
                                <i class="fa fa-plus"></i> Tambah
                            </a>

                        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                <th>ID Vendor</th>
                <th>Nama Vendor</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>No Telp</th>
                <th colspan="2">Aksi</th>
            </tr>
            </thead>
            <tbody>
                    @foreach ($vendor as $item)
                    <tr>
                        <td>{{ $item->ID_VENDOR }}</td>
                        <td>{{ $item->NAMA_VENDOR }}</td>
                        <td>{{ $item->ALAMAT_VENDOR }}</td>
                        <td>{{ $item->EMAIL_VENDOR }}</td>
                        <td>{{ $item->NO_TELEPON }}</td>

                            <td class="text-center">
                            <a href="{{ url('vendor/ubah/'.$item->ID_VENDOR)}}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i> Ubah
                                </a>
                            </td>
                            <td>
                                    <form action="{{ url('vendor/'.$item->ID_VENDOR)}}" method="POST" class="d-inline" onsubmit="return confirm('Hapus gak nih?')">
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
    </section>
    <!-- /.content -->
  </div>
@endsection

