<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h3>Laporan Keuangan Bulan Ini</h3>
    <p>Total Pendapatan: <strong>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</strong></p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Laundry</th>
                <th>Berat (kg)</th>
                <th>Total Harga</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pesanans as $index => $pesanan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $pesanan->jenis_laundry)) }}</td>
                    <td>{{ $pesanan->berat }}</td>
                    <td>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                    <td>{{ $pesanan->created_at->format('d M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        window.print();
    </script>
</body>
</html>
