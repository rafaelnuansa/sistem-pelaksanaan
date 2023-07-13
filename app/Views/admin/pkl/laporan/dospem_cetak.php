<!DOCTYPE html>
<html>
<head>
    <title>Laporan Dosen Pembimbing PKL</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Laporan Dosen Pembimbing PKL</h2>

    <?php if (!empty($dospem)) : ?>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Dosen Pembimbing</th>
                    <th>Nama Mahasiswa</th>
                    <th>Prodi</th>
                    <!-- Tambahkan kolom lain yang diperlukan -->
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($dospem as $row) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['nama_dospem'] ?></td>
                        <td><?= $row['nama_mahasiswa'] ?></td>
                        <td><?= $row['nama_prodi'] ?></td>
                        <!-- Tambahkan data lainnya sesuai dengan kolom yang ditambahkan -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>Tidak ada data Dosen Pembimbing PKL yang tersedia.</p>
    <?php endif; ?>
</body>
</html>
