<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Inventaris SMAN 2 Majalaya</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }

        .title {
            text-align: center;
            margin-bottom: 20px;
        }

        .signature {
            display: flex;
            justify-content: flex-end;
            /* Geser ke kanan */
            align-items: right;
            /* Vertikal tengah */
            height: 200px;
        }

        .signature .right {
            margin-right: 10px;
            text-align: right;
            /* Agar teks tanda tangan rapi */
        }
    </style>
</head>

<body>
    <!-- Judul Laporan -->
    <div class="title">
        <h2>Laporan Inventaris SMAN 2 Majalaya</h2>
    </div>

    <!-- Tabel Data -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Peminjam</th>
                <th>Barang</th>
                <th>Tanggal Pinjam</th>
                <th>Kondisi Barang</th>
                <th>Tanggal Kembali</th>
            </tr>
        </thead>
        <tbody>
            @foreach($records as $index => $record)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $record->peminjaman->nama_peminjam ?? '-' }}</td>
                <td>{{ $record->peminjaman->barang->nama ?? '-' }}</td>
                <td>{{ $record->peminjaman->tanggal_dibuat ?? '-' }}</td>
                <td>{{ $record->pengembalian->kondisi ?? '-' }}</td>
                <td>{{ $record->pengembalian->tanggal_dibuat ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tanda Tangan -->
    <div class="signature">
        <div class="right">
            <p>Majalaya, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <br><br><br> <!-- Spasi untuk tanda tangan -->
            <p><strong>______________________</strong></p>
            <p>Kepala Logistik</p>
        </div>
    </div>
</body>

</html>