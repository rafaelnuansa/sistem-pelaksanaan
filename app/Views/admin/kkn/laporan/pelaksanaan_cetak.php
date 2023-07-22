<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pelaksanaan PKL</title>
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
    <?php if (!empty($tahun_akademik) || !empty($prodi_id) || !empty($status)) : ?>
        <h1>Laporan Pelaksanaan PKL</h1>
        <?php if (!empty($tahun_akademik)) : ?>
            <h3>Tahun Akademik: <?= $tahun_akademik ?></h3>
        <?php endif; ?>
        <?php if (!empty($prodi_id)) : ?>
            <h3>Prodi: <?= $prodi_id ?></h3>
        <?php endif; ?>
        <?php if (!empty($status)) : ?>
            <h3>Status: <?= $status ?></h3>
        <?php endif; ?>
    <?php else : ?>
        <h1>Laporan Pelaksanaan PKL - Semua Data</h1>
    <?php endif; ?>

    <?php if (!empty($pelaksanaan)) : ?>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Prodi</th>
                    <th>Instansi</th>
                    <th>Tahun Akademik</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pelaksanaan as $i => $data) : ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= $data['nim'] ?></td>
                        <td><?= $data['nama_mahasiswa'] ?></td>
                        <td><?= $data['nama_prodi'] ?></td>
                        <td><?= $data['nama_perusahaan'] ?></td>
                        <td><?= $data['tahun_akademik'] ?></td>
                        <td><?= $data['status'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>Tidak ada data yang sesuai dengan filter yang diberikan.</p>
    <?php endif; ?>
</body>
</html>
