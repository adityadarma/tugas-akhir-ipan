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
        <div class="card">
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
                                {{-- <th colspan="2">Action</th> --}}
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($pesanan as $item)
                                <tr>
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
                                    <td>{{ $item->DISC }} %</td>
                                    <td>Rp.{{ number_format($item->TOTAL_HARGA, 2,',','.') }}</td>
                                    <td>Rp.{{ number_format($item->UANG_MUKA, 2,',','.') }}</td>
                                    <td>Rp.{{ number_format($item->PEMBAYARAN, 2,',','.') }}</td>

                                    {{-- <td>
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
                                    </td> --}}
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

<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script>
//  $('#table').DataTable();
</script>

@endsection
