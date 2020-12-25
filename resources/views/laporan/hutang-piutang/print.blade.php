<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cetak Laporan Hutang Piutang</title>
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/print-table.css')}}">
</head>
<body>
    <div class="container">
        <p align="center"><b>Laporan Hutang Piutang</b></p>
        <table class="table table-striped table-bordered table-hover display select tg" cellspacing="0" width="100%" border="1" style="margin-top: 10px;">
            <tr>
                <th>Kode Pesanan</th>
                <th>Nama Pelanggan</th>
                <th>Tgl Pesanan</th>
                <th>Tgl Jatuh Tempo</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Uang Muka</th>
                <th>Tgl Pelunasan</th>
                <th>Pelunasan</th>
                <th>Keterangan</th>
            </tr>
            <?php $uang_muka = 0; $pembayaran = 0;?>
            @foreach ($pesanan as $item)
            <tr>
                <td>{{ $item->kode }}</td>
                <td>{{ $item->nama_pelanggan }}</td>
                <td>{{ date('d-m-Y', strtotime($item->tgl_pesanan )) }}</td>
                <td>{{ Carbon::parse($item->tgl_jadi)->addDays(3)->format('d-m-Y') }}</td>
                <td>{{ $item->details->sum('jumlah_pesanan') }}</td>
                <td>Rp. {{ number_format ($item->total_harga, 0,',','.') }}</td>
                <td>Rp. {{ number_format ($item->uang_muka, 0,',','.') }}</td>
                <td>{{ ($item->tgl_pelunasan) ? date('d-m-Y', strtotime($item->tgl_pelunasan)) : '-' }}</td>
                <td>Rp. {{ number_format ($item->pembayaran, 0,',','.') }}</td>
                <td>{{ $item->keterangan }}</td>
            </tr>
            <?php $uang_muka += $item->uang_muka ; $pembayaran += $item->pembayaran;?>
            @endforeach
        </table>
        <br>
    </div>

    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>
