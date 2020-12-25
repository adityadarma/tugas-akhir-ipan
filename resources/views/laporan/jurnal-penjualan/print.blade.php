<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cetak Laporan Jurnal Penjualan</title>
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/print-table.css')}}">
</head>
<body>
    <div class="container">
        <p align="center"><b>Laporan Jurnal Penjualan</b></p>
        <table class="table table-striped table-bordered table-hover display select tg" cellspacing="0" width="100%" border="1" style="margin-top: 10px;">
            <tr>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>No Bukti</th>
                <th>Debet</th>
                <th>Kredit</th>
            </tr>
            <?php $debet = 0; $kredit = 0; ?>
            @foreach ($pesanan as $item)
            <tr>
                <td>{{ date('d-m-Y', strtotime($item->tgl_pesanan )) }}</td>
                <td>{{ $item->keterangan }}</td>
                <td>{{ $item->no_bukti }}</td>
                <td>Rp. {{ number_format($item->debet, 0,',','.') }}</td>
                <td>Rp. {{ number_format($item->kredit, 0,',','.') }}</td>
            </tr>
            <?php $debet += $item->debet; $kredit += $item->kredit ; ?>
            @endforeach
            <tr>
                <th colspan="3">Total :</th>
                <th>Rp. {{ number_format ($debet, 0,',','.') }}</th>
                <th>Rp. {{ number_format ($kredit, 0,',','.') }}</th>
            </tr>
        </table>
        <br>
    </div>

    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>
