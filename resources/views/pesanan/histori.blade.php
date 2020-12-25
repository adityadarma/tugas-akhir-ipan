@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Histori Pelanggan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Histori Pelanggan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $pelanggan->nama }}</h3>
            </div>
            <div class="card-body pt-4">
                <div class="table-responsive mt-3">
                    <table id="table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Pesanan</th>
                                <th>Tanggal Pesanan</th>
                                <th>Tanggal Jadi</th>
                                <th>Jumlah Pesanan</th>
                                <th>Total Harga</th>
                                <th>Uang Muka</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesanan as $key => $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->kode }}</td>
                                <td>{{ date('d-m-Y', strtotime($item->tgl_pesanan)) }}</td>
                                <td>{{ date('d-m-Y', strtotime($item->tgl_jadi)) }}</td>
                                <td>{{ $item->details->sum('jumlah_pesanan') }} pcs</td>
                                <td>Rp. {{ number_format($item->total_harga, 0,',','.') }}</td>
                                <td>Rp. {{ number_format($item->uang_muka, 0,',','.') }}</td>
                                <td><a href="{{ route('pesanan.cetak',['id' => $item->id]) }}" target="_blank" class="btn btn-info btn-sm"><i class="fa fa-print"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
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
