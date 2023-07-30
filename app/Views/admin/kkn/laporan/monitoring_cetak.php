<!DOCTYPE html>
<html>

<head>
    <title>Laporan Monitoring KKN</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
        }

        h3 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
        }

    </style>
</head>

<body>
    <h2>Monitoring Kuliah Kerja Nyata</h2>
    <p>
        Nama Mahasiswa : <?= $mahasiswa->nama; ?><br>
        NIM : <?= $mahasiswa->nim; ?><br>
        Dosen Pembimbing : <?= $mahasiswa->nama_pembimbing; ?><br>
        Program Studi : <?= $prodi->nama_prodi; ?><br>
        Tahun Akademik: <?= $mahasiswa->tahun_akademik ?><br>
    </p>
    <?php if (!empty($monitoring)) : ?>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($monitoring as $row) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['tanggal'] ?></td>
                        <td><?= $row['catatan'] ?></td>
                        <td><?= $row['status'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>Tidak ada data .</p>
    <?php endif; ?>
</body>

</html>