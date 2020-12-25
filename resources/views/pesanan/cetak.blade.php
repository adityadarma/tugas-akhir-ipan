<html>

<head>
    <title>Invoice Pembayaran</title>
    <style>
        #tabel {
            font-size: 15px;
            border-collapse: collapse;
        }

        #tabel td {
            padding-left: 5px;
            border: 1px solid black;
        }

    </style>
</head>

<body style='font-family:tahoma; font-size:8pt;'>
    <center>
        <table style='width:100%; font-size:8pt; font-family:calibri; border-collapse: collapse;' border='0'>
            <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
                <span style='font-size:12pt'><b>CV.Kaos SisBro</b></span></br>
                Jln.Tukad Citarum F1 No.38.Renon, Kec.Denpasar Selatan,Kota Denpasar,Bali
            </td>
            <td style='vertical-align:top' width='30%' align='left'>
                <b><span style='font-size:12pt'>INVOICE PENJUALAN</span></b></br>
                No Pesanan. : {{ $pesanan->kode }}</br>
                Tanggal Pesanan : {{ date('d-m-Y', strtotime($pesanan->tgl_pesanan)) }}</br>
                Tanggal Jadi : {{ date('d-m-Y', strtotime($pesanan->tgl_jadi)) }}</br>
            </td>
        </table>
        <table style='width:100%; font-size:8pt; font-family:calibri; border-collapse: collapse;' border='0'>
            <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
                Nama Pelanggan : {{ $pesanan->nama_pelanggan }}</br>
                Alamat : {{ $pesanan->alamat_pelanggan }}
            </td>
            <td style='vertical-align:top' width='30%' align='left'></td>
        </table>
        <table cellspacing='0' style='width:100%; font-size:8pt; font-family:calibri;  border-collapse: collapse;' border='1'>

            <tr align='center'>
                <td width='10%'>Kode Barang</td>
                <td width='20%'>Nama Barang</td>
                <td width='13%'>Harga</td>
                <td width='3%'>Qty</td>
                <td width='13%'>Total Harga</td>
            </tr>
            @foreach ($pesanan->details as $item)
            <tr>
                <td>{{ $item->barang->kode_barang }}</td>
                <td>{{ $item->barang->nama_barang }}</td>
                <td style='text-align:right'>Rp. {{ number_format($item->harga_barang + ($item->jumlah_warna * 10000), 0,',','.') }}</td>
                <td style='text-align:right'>{{ $item->jumlah_pesanan }}</td>
                <td style='text-align:right'>Rp. {{ number_format(($item->harga_barang + ($item->jumlah_warna * 10000)) * $item->jumlah_pesanan, 0,',','.') }}</td>
            </tr>
            @endforeach

            <tr>
                <td colspan='4'>
                    <div style='text-align:right'>Sub Total : </div>
                </td>
                <td style='text-align:right'>Rp. {{ number_format($pesanan->total(), 0,',','.') }}</td>
            </tr>
            <tr>
                <td colspan='4'>
                    <div style='text-align:right'>Diskon : </div>
                </td>
                <td style='text-align:right'>Rp. {{ number_format($pesanan->total() * ($pesanan->disc/100), 0,',','.') }}</td>
            </tr>
            <tr>
                <td colspan='4'>
                    <div style='text-align:right'>Total Harga : </div>
                </td>
                <td style='text-align:right'>Rp. {{ number_format($pesanan->total_harga, 0,',','.') }}</td>
            </tr>
            <tr>
                <td colspan='4'>
                    <div style='text-align:right'>DP : </div>
                </td>
                <td style='text-align:right'>Rp. {{ number_format($pesanan->uang_muka, 0,',','.') }}</td>
            </tr>
            <tr>
                <td colspan='4'>
                    <div style='text-align:right'>Sisa Pembayaran : </div>
                </td>
                <td style='text-align:right'>Rp. {{ number_format($pesanan->total_harga - $pesanan->uang_muka, 0,',','.') }}</td>
            </tr>
        </table>
        <br>
        <table style='width:100%; font-size:7pt;' cellspacing='2'>
            <tr>
                <td align='center'>Diterima Oleh,</br></br><u>(............)</u></td>
                <td style='border:0px solid black; padding:5px; text-align:left; width:30%'></td>
                <td align='center'>TTD,</br></br><u>(...........)</u></td>
            </tr>
        </table>
    </center>
</body>

</html>
