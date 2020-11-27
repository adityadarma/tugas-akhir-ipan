@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Pelunasan</h1>
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
      <div class="content mt-3">
            <div class="animated fadeIn">
                    <i class="fa"></i> Lihat Data Pelunasan?
                    <div class="pull-center">
                            <a href="{{ url('pelunasan/detail')}}" class="btn btn-info btn-sm">
                                <i class="fa fa-eye"></i> Lihat
                            </a>

                        </div>
      <div class="content mt-3">
            <div class="animated fadeIn">
                    <i class="fa"></i> Tambah Data Pelunasan
                    <div class="pull-center">
                            <a href="{{ url('pelunasan/tambah')}}" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus"></i> Tambah
                            </a>

                        </div>
            </div>
            </div>
    </section>
    <!-- /.content -->
  </div>
@endsection

