<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Laporan PKL</title>
    <style>
        /* CSS styling for the PDF content */
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        h1 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #000;
        }
    </style>
</head>

<body>

    <?php if (!empty($tahun_akademik) || !empty($prodi_id)) : ?>
        <h1>Laporan Kelompok PKL</h1>
        <?php if (!empty($tahun_akademik)) : ?>
            <h3>Tahun Akademik: <?= $tahun_akademik ?></h3>
        <?php endif; ?>
        <?php if (!empty($prodi_id)) : ?>
            <?php foreach ($getProdi as $p) : ?>
                <?php if ($p['id'] == $prodi_id) : ?>
                    <h3>Prodi: <?= $p['nama_prodi'] ?></h3>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    <?php else : ?>
        <h1>Laporan Kelompok PKL - Semua Data</h1>
    <?php endif; ?>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Program Studi</th>
                <th>Dosen</th>
                <th>Lokasi</th>
            </tr>
        </thead>
        <tbody>

            <?php if ($data_kkn) : ?>
                <?php foreach ($data_kkn as $i => $kkn) : ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= $kkn['nim'] ?></td>
                        <td><?= $kkn['nama'] ?></td>
                        <td><?= $kkn['tgl_mulai'] ?? '-' ?></td>
                        <td><?= $kkn['tgl_selesai'] ?? '-' ?></td>
                        <td><?= $kkn['nama_prodi'] ?></td>
                        <td><?= $kkn['nama_dosen'] ?? '-' ?></td>
                        <td><?= $kkn['nama_lokasi'] ?? '-' ?></td>
                    </tr>
                <?php endforeach; ?>

            <?php else :; ?>
                    <tr>
                        <td colspan="7" style="text-align: center;">Tidak Ada Data</td>
                    </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>