@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Masukkan Tanggal Pesanan</h1>
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
            Dari Tanggal <input type="date" name="idpesan" id="idpesan" class="form-control" placeholder="ID">
                </div>
        </form>
      <form class="form-inline">
        <form action="pelunasan/tambah" method="GET" role="search">
            <div class="input-group mx-sm-3 mb-2">
        Sampai Tanggal <input type="date" name="idpesan" id="idpesan" class="form-control" placeholder="ID">
                </div>
        </form>
        <button type="submit" class="btn btn-primary mb-3">Check</button>
            <!-- Main content -->
    <section class="content">

            <!-- Default box -->
            <div class="content mt-3">
              <div class="card">
              </div>
             </div>
          </section>
          <!-- /.content -->
      </form>
    </section>
    <!-- /.content -->
  </div>
@endsection


