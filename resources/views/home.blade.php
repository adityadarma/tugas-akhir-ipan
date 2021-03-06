@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Halaman Dashboard</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $pesanan }}</h3>
                            <p>Pesanan</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $pelunasan }}</sup></h3>
                            <p>Pelunasan</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $pelanggan }}</h3>
                            <p>Pelanggan</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- Default box -->
            <div class="card">
                <div class="card-body text-center">
                    <div class="table-responsive mt-3">
                        <table id="table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Pesanan</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Tanggal Pesanan</th>
                                    <th>Jumlah</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pesanans as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->kode }}</td>
                                    <td>{{ $item->nama_pelanggan }}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->tgl_pesanan)) }}</td>
                                    <td>{{ $item->details->sum('jumlah_pesanan') }} pcs</td>
                                    <td>Rp. {{ number_format($item->total_harga, 0,',','.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-footer-->
            </div>
            
            <div class="card">
                <div class="card-body text-center">
                  <br><br>
                    <img src="dist/img/sisbro.png" alt="" width="30%">
                    <br><br>
                    <h1>Selamat Datang di Aplikasi CV.POS</h1>
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection

@section('script')
<script>
    $('#table').DataTable({
        "responsive": true,
        "autoWidth": false
    });

</script>
@endsection