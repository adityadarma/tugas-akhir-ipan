@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Pesanan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Pesanan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-body pt-4">
                <div class="animated fadeIn">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('pesanan.tambah')}}" class="btn btn-success btn-sm"><i
                                class="fa fa-plus"></i> Tambah</a>
                    </div>
                </div>
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
                                <th>Dibuat</th>
                                <th width="90px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesanan as $key => $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->kode }}</td>
                                <td>{{ $item->nama_pelanggan }}</td>
                                <td>{{ date('d-m-Y', strtotime($item->tgl_pesanan)) }}</td>
                                <td>{{ $item->details->sum('jumlah_pesanan') }} pcs</td>
                                <td>Rp. {{ number_format($item->total_harga, 0,',','.') }}</td>
                                <td>{{ $item->nama_user }}</td>
                                <td>
                                    <a href="{{ route('pesanan.ubah',['id' => $item->id]) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                    <form action="{{ route('pesanan.hapus',['id' => $item->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus gak nih?')">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                    </form>
                                    <a href="{{ route('pesanan.cetak',['id' => $item->id]) }}" target="_blank" class="btn btn-info btn-sm"><i class="fa fa-print"></i></a>
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
