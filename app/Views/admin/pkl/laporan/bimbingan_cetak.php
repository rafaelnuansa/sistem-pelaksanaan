<!DOCTYPE html>
<html>

<head>
    <title>Laporan Bimbingan PKL</title>
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

        thead {
            background-color: #f5f5f5;
        }

        th:first-child,
        td:first-child {
            width: 40px;
            text-align: center;
        }
    </style>
</head>

<body>
    <h2>Bimbingan Praktek Kerja Lapangan</h2>
    <p>
        Nama Mahasiswa : <?= $mahasiswa->nama; ?><br>
        NIM : <?= $mahasiswa->nama; ?><br>
        Dosen Pembibming : <?= $mahasiswa->nama; ?><br>
        Program Studi : <?= $prodi->nama_prodi; ?><br>
        Tahun Akademik: <?= $mahasiswa->tahun_akademik ?><br>
    </p>

    <?php if (!empty($bimbingan)) : ?>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($bimbingan as $row) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['tanggal'] ?></td>
                        <td><?= $row['catatan'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>Tidak ada data bimbingan PKL yang tersedia.</p>
    <?php endif; ?>
</body>

</html>