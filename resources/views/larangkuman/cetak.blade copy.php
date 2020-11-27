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
    <title>Cetak Laporan Penjualan Rangkuman</title>
</head>
<script type="text/javascript">
    window.print();
</script>
<body align="text-center">
    <div class="form-group">
        <p align="center"><b>Laporan Penjualan Rangkuman</b></p>
        @foreach ($pelanggan as $i)

        @foreach ($pesanan as $item)

        @if($i->ID_PELANGGAN == $item->ID_PELANGGAN)
        <h1>{{$i->NAMA_PELANGGAN}}</h1>
            <table class="static" align="center" rules="all" border="1px" style="width:80%; text-align: center">
                <thead>
                        <tr>
                                <th width="100rem">ID Pesanan</th>
                                <th>ID User</th>
                                <th>Tgl Pesanan</th>
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
                            </tr>
                </thead>
                <tbody>
                        <tr>
                                <td>{{ $item->ID_PESANAN }}</td>
                                <td>{{ $item->ID_USER }}</td>
                                <td>{{ $item->TGL_PESANAN }}</td>
                                <td>{{ $item->TGL_JADI }}</td>
                                <td>{{ $item->JENIS_PESANAN }}</td>
                                <td>{{ $item->UKURAN }}</td>
                                <td>{{ $item->JUMLAH_PESANAN }} pcs</td>
                                <td>{{ $item->JENIS_KAIN }}</td>
                                <td>{{ $item->JUMLAH_WARNA }}</td>
                                <td>{{ $item->DISC}}%</td>
                                <td>Rp.{{ number_format ($item->TOTAL_HARGA, 2,',','.') }}</td>
                                <td>Rp.{{ number_format ($item->UANG_MUKA, 2,',','.') }}</td>
                                <td>Rp.{{ number_format ($item->PEMBAYARAN, 2,',','.') }}</td>
                            </tr>
                </tbody>
            <tr>
                <td colspan="9">Sub Total</td>
                <td>Total</td>
                <td>Total</td>
                <td>Total</td>
                <td>Total</td>
            </tr>

            </table>
        @else

        @endif
        @endforeach
        @endforeach
    </div>
</body>
