<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cetak Laporan Penjualan Perpelanggan</title>
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/print-table.css')}}">
</head>
<body>
    <div class="container">
        <p align="center"><b>Laporan Penjualan Perpelanggan</b></p>
        @foreach ($pelanggan as $key => $pesanan)
        <p>{{ $key  }}</p>
        <table class="table table-striped table-bordered table-hover display select tg" cellspacing="0" width="100%" border="1" style="margin-top: 10px;">
            <tr>
                <th>Kode Pesanan</th>
                <th>Tanggal Pesanan</th>
                <th>Jumlah Pesanan</th>
                <th>Sub Total</th>
                <th>Diskon</th>
                <th>Total Harga</th>
                <th>Uang Muka</th>
                <th>Sisa Pembayaran</th>
            </tr>
            <?php $total_harga = 0; $uang_muka = 0; $sisa_pembayaran = 0;?>
            @foreach ($pesanan as $item)
            <tr>
                <td>{{ $item->kode }}</td>
                <td>{{ date('d-m-Y', strtotime($item->tgl_pesanan )) }}</td>
                <td>{{ $item->details->sum('jumlah_pesanan') }}</td>
                <td>{{ number_format ($item->total(), 0,',','.') }}</td>
                <td>{{ $item->disc }}%</td>
                <td>Rp. {{ number_format ($item->total_harga, 0,',','.') }}</td>
                <td>Rp. {{ number_format ($item->uang_muka, 0,',','.') }}</td>
                <td>Rp. {{ number_format ($item->total_harga - $item->uang_muka , 0,',','.') }}</td>
            </tr>
            <?php $total_harga += $item->total_harga; $uang_muka += $item->uang_muka ; $sisa_pembayaran += $item->total_harga - $item->uang_muka;?>
            @endforeach
            <tr>
                <th colspan="5">Sub Total :</th>
                <th>Rp. {{ number_format ($total_harga, 0,',','.') }}</th>
                <th>Rp. {{ number_format ($uang_muka, 0,',','.') }}</th>
                <th>Rp. {{ number_format ($sisa_pembayaran, 0,',','.') }}</th>
            </tr>
        </table>
        <br>
    @endforeach
    </div>

    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>
