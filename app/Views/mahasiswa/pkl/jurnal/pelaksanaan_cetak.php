<!DOCTYPE html>
<html>
<head>
    <title>Laporan PKL Mahasiswa</title>
    <!-- Add any necessary CSS styles here -->
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            line-height: 1.5;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table th, .table td {
            border: 1px solid #ccc;
            padding: 6px;
            text-align: left;
        }

        /* Inline CSS untuk tanda tangan */
       
        /* Inline CSS untuk tanda tangan */
        .signature-container {
            margin-top: 250px;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center; /* Tengahkan secara vertikal */
            text-align: center;
        }

        .signature {
            width: 40%;
        }

        .signature img {
            width: 100%;
            max-height: 100px;
        }

        /* CSS untuk mengatur posisi tanda tangan */
        .signature1 {
            float: left;
        }

        .signature2 {
            float: right;
        }
    </style>
</head>
<body>
    <div>
        <div>
            <h2>Log Harian</h2>
            <p>Nama Mahasiswa: <?= $mahasiswa->nama; ?></p>
            <p>NIM: <?= $mahasiswa->nim; ?></p>
            <p>Instansi: <?= $nama_perusahaan ?? 'Belum ditentukan';?></p>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Keterangan Kegiatan PKL</th>
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
            <div class="signature-container">
                <div class="signature signature1">
                    <p>Mahasiswa Praktek Kerja Lapangan</p>
                    <br><br>
                    <br><br>
                    <p><?= $mahasiswa->nama ?? '';?></p>
                </div>
                <div class="signature signature2">
                    <p>Pembimbing Lapangan</p>
                    <br><br>
                    <br><br>
                    <p><?= $nama_pembimbing ?? '';?></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
