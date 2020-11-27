<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token()}}">
    <style>
        table.static {
            position: relative;
            border: 1px solid cornflowerblack;
        }
    </style>
    <title>Cetak Bukti Pesanan</title>
</head>
<script type="text/javascript">
    window.print();
</script>
<body align="text-center">
    <div class="form-group">
        <p align="center"><b>Bukti Pesanan</b></p>
        <table class="static" align="center" rules="all" border="1px" style="width:50%; text-align: center">
    @foreach ($pesanan as $item)
    <tr>
            <th>ID Pesanan</th>
            <td>{{ $item->ID_PESANAN }}</td>
    </tr>
            <th>ID User</th>
            <td>{{ $item->ID_USER }}</td>
    </tr>
            <th>Tgl Pesanan</th>
            <td>{{ $item->TGL_PESANAN }}</td>
    </tr>
            <th>Tgl Jadi</th>
            <td>{{ $item->TGL_JADI }}</td>
    </tr>
            <th>Jenis Pesanan</th>
            <td>{{ $item->JENIS_PESANAN }}</td>
    </tr>
            <th>Ukuran</th>
            <td>{{ $item->UKURAN }}</td>
    </tr>
            <th>Jumlah Pesanan</th>
            <td>{{ $item->JUMLAH_PESANAN }} pcs</td>
    </tr>
            <th>Jenis Kain</th>
            <td>{{ $item->JENIS_KAIN }}</td>
    </tr>
            <th>Jumlah Warna</th>
            <td>{{ $item->JUMLAH_WARNA }}</td>
    </tr>
            <th>Diskon</th>
            <td>{{ $item->DISC }} %</td>
    </tr>
            <th>Total Harga</th>
            <td>Rp.{{ number_format($item->TOTAL_HARGA, 2,',','.') }}</td>
    </tr>
            <th>Uang Muka</th>
            <td>Rp.{{ number_format($item->UANG_MUKA, 2,',','.') }}</td>
    </tr>
            <th>Pembayaran</th>
            <td>Rp.{{ number_format($item->PEMBAYARAN, 2,',','.') }}</td>
    </tr>
    @endforeach
        </table>
    </div>
</body>
