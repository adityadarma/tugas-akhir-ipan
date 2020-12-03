<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cetak Laporan Arus Kas</title>
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/print-table.css')}}">
</head>
<body>
    <div class="container">
        <p align="center"><b>Laporan Arus Kas</b></p>
        <table class="table table-striped table-bordered table-hover display select tg" cellspacing="0" width="100%" border="1" style="margin-top: 10px;">
            <tr>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Debet</th>
                <th>Kredit</th>
            </tr>
            <?php $total_debet = 0; $total_kredit= 0; ?>
            @foreach ($aruskas as $key => $item)
            <tr>
                <td>{{ date('d-m-Y', strtotime($item->tanggal )) }}</td>
                <td>{{ $item->keterangan }}</td>
                @if ($item->status == 1)
                    <td>Rp. {{ number_format ($item->nominal, 0,',','.') }}</td>
                    <td></td>
                    <?php $total_debet += $item->nominal; ?>
                @else
                    <td></td>
                    <td>Rp. {{ number_format ($item->nominal, 0,',','.') }}</td>
                    <?php $total_kredit += $item->nominal; ?>
                @endif
            </tr>
            @endforeach
            <tr>
                <th colspan="2">Sub Total :</th>
                <th>Rp. {{ number_format ($total_debet, 0,',','.') }}</th>
                <th>Rp. {{ number_format ($total_kredit, 0,',','.') }}</th>
            </tr>
        </table>
        <br>
    </div>

    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>
