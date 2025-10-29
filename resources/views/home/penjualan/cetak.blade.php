<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Struk - Penjualan 123</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }

        .container {
            background: white;
            border-radius: 8px;
            padding: 20px;
            max-width: 400px;
            margin: auto;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        h2,
        h3 {
            text-align: center;
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table td {
            padding: 5px;
        }

        .total {
            font-weight: bold;
            border-top: 1px dashed #000;
            border-bottom: 1px dashed #000;
            margin: 10px 0;
        }

        .btn-print {
            display: block;
            width: 100%;
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-print:hover {
            background-color: #218838;
        }

        @media print {
            .btn-print {
                display: none;
            }

            body {
                background: white;
            }
        }
    </style>
</head>

<body>

    <div class="container" id="struk">
        <h2><strong>PENJUALAN 123</strong></h2>
        <h3>Struk Transaksi</h3>
        <hr>

        <table>
            <tr>
                <td>No. Transaksi</td>
                <td>:</td>
                <td>{{ $penjualan->id }}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td>{{ $penjualan->tanggal }}</td>
            </tr>
            <tr>
                <td>Nama Pelanggan</td>
                <td>:</td>
                <td>{{ $penjualan->Pelanggan->name }}</td>
            </tr>
        </table>

        <hr>

        <table>
            <tr>
                <td><strong>Nama Barang</strong></td>
                <td><strong>Jumlah</strong></td>
                <td><strong>Subtotal</strong></td>
            </tr>
            <!-- Contoh data, bisa diganti loop di Laravel -->
            @php
                // Kelompokkan produk berdasarkan nama
                $grouped = $penjualan->detail->groupBy(fn($d) => $d->Produk->name);

                // Siapkan array hasil akhir
                $rekap = [];

                foreach ($grouped as $nama => $items) {
                    $totalJumlah = $items->sum('jumlah');
                    $totalSubtotal = $items->sum(function ($i) {
                        return $i->jumlah * $i->Produk->price;
                    });
                    $rekap[] = [
                        'nama' => $nama,
                        'jumlah' => $totalJumlah,
                        'subtotal' => $totalSubtotal,
                    ];
                }
            @endphp

            @foreach ($rekap as $r)
                <tr>
                    <td>{{ $r['nama'] }}</td>
                    <td>{{ $r['jumlah'] }}</td>
                    <td>Rp {{ number_format($r['subtotal'], 0, ',', '.') }}</td>
                </tr>
            @endforeach

                
        </table>

        <hr>

        <table>
            <tr>
                <td>Total Bayar</td>
                <td>:</td>
                <td>Rp {{ number_format($penjualan->total_amount ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Bayar</td>
                <td>:</td>
                <td>Rp {{ number_format($penjualan->paid_amount ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Kembalian</td>
                <td>:</td>
                <td>Rp {{ number_format($penjualan->change_amount ?? 0, 0, ',', '.') }}</td>
            </tr>
        </table>

        <p style="text-align:center; margin-top:15px;">Terima kasih telah berbelanja di <strong>PENJUALAN
                123</strong><br>
            Semoga hari Anda menyenangkan!</p>

        <button class="btn-print" onclick="window.print()">🖨️ Cetak Struk</button>
    </div>

</body>

</html>
