<!DOCTYPE html>
<html>
<head>
    <title>Laporan KKN Mahasiswa</title>
    <!-- Add any necessary CSS styles here -->
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table th, .table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div>
        <div >
            <h2>Log Harian</h2>
            <p>Nama Mahasiswa: <?= $mahasiswa->nama; ?></p>
            <p>NIM: <?= $mahasiswa->nim; ?></p>
            <p>Lokasi: <?= $nama_lokasi;?> </p> 
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Hari/Tanggal</th>
                        <th>Jam</th>
                        <th>Keterangan Kegiatan KKN</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $i => $row) : ?>
                        <tr>
                            <td><?= ++$i ?></td>
                            <td><?= $row['hari'] ?></td>
                            <td><?= $row['jam'] ?></td>
                            <td><?= $row['keterangan'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
