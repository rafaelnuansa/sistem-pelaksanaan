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

        th:first-child,
        td:first-child {
            width: 40px;
            text-align: center;
        }
    </style>
</head>
 
<body>
<h2>Pelaksanaan Praktek Kerja Lapangan</h2> 
    <p>
        NIM : <?= $mahasiswa->nim; ?><br>
        Nama Mahasiswa : <?= $mahasiswa->nama; ?><br>
        Dosen Pembibming : <?= $mahasiswa->nama_pembimbing; ?><br>
        Program Studi : <?= $prodi->nama_prodi; ?><br>
        Tahun Akademik: <?= $mahasiswa->tahun_akademik ?><br>
    </p>

    <?php if (!empty($pelaksanaan)) : ?>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pelaksanaan as $i => $data) : ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= $data['nim'] ?></td>
                        <td><?= $data['nama_mahasiswa'] ?></td>
                        <td><?= $data['hari'] ?></td>
                        <td><?= $data['jam'] ?></td>
                        <td><?= $data['keterangan'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>Tidak ada data.</p>
    <?php endif; ?>
</body>

</html>