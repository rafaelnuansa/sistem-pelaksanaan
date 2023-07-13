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
        th, td {
            border: 1px solid #000;
            padding: 8px;
        }
        thead {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <h3>
        <?php if (!empty($tahun_akademik) || !empty($prodi_id) || !empty($mahasiswa_id)) : ?>
            <?php if (!empty($tahun_akademik)) : ?>
                Tahun Akademik: <?= $tahun_akademik ?>
            <?php endif; ?>
            <?php if (!empty($prodi_id)) : ?>
                <?php foreach ($getProdi as $p) : ?>
                    <?php if ($p['id'] == $prodi_id) : ?>
                        Prodi: <?= $p['nama_prodi'] ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if (!empty($mahasiswa_id)) : ?>
                <?php foreach ($mahasiswaAll as $mahasiswa) : ?>
                    <?php if ($mahasiswa['id'] == $mahasiswa_id) : ?>
                        Mahasiswa: <?= $mahasiswa['nama'] ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php else : ?>
            Laporan Bimbingan PKL - Semua Data
        <?php endif; ?>
    </h3>

    <?php if (!empty($bimbingan)) : ?>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Dosen</th>
                    <th>Tanggal</th> 
                    <th>Jam</th>
                    <!-- Tambahkan kolom lain yang diperlukan -->
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($bimbingan as $row) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['nim'] ?></td>
                        <td><?= $row['nama_mahasiswa'] ?></td>
                        <td><?= $row['nama_dosen'] ?></td>
                        <td><?= $row['tanggal'] ?></td>
                        <td><?= $row['jam'] ?></td>
                        <!-- Tambahkan data lainnya sesuai dengan kolom yang ditambahkan -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>Tidak ada data bimbingan PKL yang tersedia.</p>
    <?php endif; ?>
</body>
</html>
