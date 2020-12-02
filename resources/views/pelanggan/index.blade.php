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
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Pelanggan</li>
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
                      <a href="{{ route('pelanggan.tambah')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah</a>
                  </div>
              </div>
              <div class="table-responsive mt-3">
                  <table id="table" class="table table-bordered">
                      <thead>
                          <tr>
                              <th width="10px">No</th>
                              <th>Kode</th>
                              <th>Nama</th>
                              <th>Alamat</th>
                              <th>Email</th>
                              <th>No Telp</th>
                              <th width="60px">Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($pelanggan as $key => $item)
                          <tr>
                              <td>{{ $key+1 }}</td>
                              <td><a href="{{ route('pesanan.detail', ['id' => $item->id]) }}">{{ $item->kode }}</a></td>
                              <td>{{ $item->nama }}</td>
                              <td>{{ $item->alamat }}</td>
                              <td>{{ $item->email }}</td>
                              <td>{{ $item->no_telp }}</td>

                              <td class="text-center">
                                  <a href="{{ route('pelanggan.ubah',['id' => $item->id]) }}" class="btn btn-warning btn-sm" title="Ubah"><i class="fa fa-edit"></i></a> 
                                  <form action="{{ route('pelanggan.hapus',['id' => $item->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus gak nih?')">
                                      @method('delete')
                                      @csrf
                                      <button class="btn btn-danger btn-sm" title="Hapus"><i class="fa fa-trash"></i></button>
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
</div>
@endsection

@section('script')
<script>
    $('#table').DataTable({
        "responsive": true, "autoWidth": false
    });

</script>
@endsection
