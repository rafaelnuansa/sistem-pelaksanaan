<!DOCTYPE html>
<html>

<head>
    <title>Laporan Jadwal Sidang PKL</title>
    <style>
        /* CSS styling for the PDF */
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Laporan Jadwal Sidang PKL <?= !empty($tanggal) ? 'Tanggal ' . $tanggal : '' ?></h2>


    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Tanggal</th>
                <th>Tempat</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($jadwal as $row) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['nim'] ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['tanggal'] ?></td>
                    <td><?= $row['nama_tempat'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>