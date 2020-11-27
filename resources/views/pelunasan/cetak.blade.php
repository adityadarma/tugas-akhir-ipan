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
    <title>Cetak Nota Pelunasan</title>
</head>
<script type="text/javascript">
    window.print();
</script>
<body align="text-center">
    <div class="form-group">
        <p align="center"><b>Nota Pelunasan</b></p>
        <table class="static" align="center" rules="all" border="1px" style="width:50%; text-align: center">
    @foreach ($pelunasan as $item)
    <tr>
            <th>ID Pelunasan</th>
            <td>{{ $item->ID_PELUNASAN }}</td>
    </tr>
            <th>ID Pesanan</th>
            <td>{{ $item->ID_PESANAN }}</td>
    </tr>
            <th>ID User</th>
            <td>{{ $item->ID_USER }}</td>
    </tr>
            <th>ID Pelanggan</th>
            <td>{{ $item->ID_PELANGGAN }}</td>
    </tr>
            <th>Nama Pelanggan</th>
            <td>{{ $item->NAMA }}</td>
    </tr>
            <th>Tanggal Pesanan</th>
            <td>{{ $item->TGL_PESAN }}</td>
    </tr>
            <th>Tanggal Pelunasan</th>
            <td>{{ $item->TGL_PELUNASAN }}</td>
    </tr>
            <th>Pesanan</th>
            <td>{{ $item->PESANAN }}</td>
    </tr>
            <th>Jumlah</th>
            <td>{{ $item->JUMLAH }} Pcs</td>
    </tr>
            <th>Diskon</th>
            <td>{{ $item->DISKON }} %</td>
    </tr>
            <th>Total Harga</th>
            <td>Rp.{{ number_format($item->HARGA_TOTAL, 2,',','.') }}</td>
    </tr>
            <th>Keterangan</th>
            <td>{{ $item->KET }}</td>
    </tr>
    @endforeach
        </table>
    </div>
</body>
