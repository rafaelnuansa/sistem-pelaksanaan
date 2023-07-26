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
            padding: 5px;
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
        <thead class="bg-primary">
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Mahasiswa</th>
                <th>Dosen</th>
                <th>Program Studi</th>
                <th>Tgl Mulai</th>
                <th>Tgl Selesai</th>
                <th>Instansi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>

            <?php if ($data_pkl) : ?>
                <?php foreach ($data_pkl as $i => $pkl) : ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= $pkl['nim'] ?></td>
                        <td><?= $pkl['nama'] ?></td>
                        <td><?= $pkl['nama_prodi'] ?></td>
                        <td><?= $pkl['nama_dosen'] ?? '-' ?></td>
                        <td><?= $pkl['tgl_mulai'] ?? '-' ?></td>
                        <td><?= $pkl['tgl_selesai'] ?? '-' ?></td>
                        <td><?= $pkl['nama_perusahaan'] ?? '-' ?></td>
                        <td> <span class="label <?= $pkl['total_nilai'] === null ? 'label-warning' : ($pkl['status_ujian'] ? 'label-primary' : 'label-danger') ?>">
                                <?= $pkl['total_nilai'] === null ? 'Belum Melaksanakan' : ($pkl['status_ujian'] ? 'Lulus' : 'Tidak Lulus') ?>
                            </span></td>
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