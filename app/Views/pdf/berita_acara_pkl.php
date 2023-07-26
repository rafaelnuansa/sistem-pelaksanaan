<html>

<head>
    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
    <title>Cetak Penilaian</title>

    <style>
        div.centered {
            text-align: center;
            margin-top: 10px;
            /* Adjust top margin */
            margin-bottom: 10px;
            /* Adjust bottom margin */
        }

        .pharagraph {
            line-height: 1.5;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        div.centered h3 {
            margin-top: 5px;
            /* Adjust top margin for h3 elements */
            margin-bottom: 5px;
            /* Adjust bottom margin for h3 elements */
        }

        td {
            padding: 5px;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            line-height: 1.5;
        }

        .table-noborder {
            width: 100%;
            margin-top: 10px;
        }

        .table th,
        .table td {
            border: 1px solid #ccc;
            padding: 6px;
            text-align: left;
        }

        .signature-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .signature {
            width: 250px;
            border-bottom: 1px dotted #000;
            text-align: center;
        }
    </style>

</head>

<body>

<?php helper('date'); ?>
    <div>
        <div class="centered">
            <h3>BERITA ACARA</h3>
            <h3>UJIAN PRAKTIK KERJA LAPANGAN (PKL)</h3>
            <h3 style="text-transform: uppercase;"><?= $data->fakultas; ?></h3>
            <h3 style="text-transform: uppercase;">TAHUN AKADEMIK <?= $data->tahun_akademik; ?></h3>
        </div>
        <?php

        ?>
<div class="pharagraph">
    Pada hari <b><?= date_format_id(new DateTime($data->tanggal)); ?></b>
    tanggal <b><?= date_format(new DateTime($data->tanggal), 'd'); ?></b>
    bulan <b><?= format_date_id_month($data->tanggal); ?></b>
    tahun <b><?= format_date_id_year($data->tanggal); ?></b>
    pukul <b><?= date('H.i', strtotime($data->jam)); ?> WIB s.d Selesai</b>
    bertempat di ruang <b><?= $data->tempat_nama; ?></b> Universitas Peradaban telah dilaksanakan ujian PKL :
</div>



        <table style="width: 100%;">
            <tbody>
                <tr>
                    <td width="10%">Nama</td>
                    <td>: <?= $data->nama_mahasiswa; ?></td>
                </tr>
                <tr>
                    <td width="10%">NIM</td>
                    <td>: <?= $data->nim; ?></td>
                </tr>
                <tr>
                    <td d width="10%">Judul</td>
                    <td>: <?= $data->judul_laporan; ?></td>
                </tr>

            </tbody>
        </table>


        <p><span style='font-family:"Times New Roman",serif'>
                Demikian berita acara ini dibuat dengan sesungguhnya dan sebenar-benarnya untuk digunakan sebagaimana mestinya.
            </span></p>
        <p style='float:right'>
            <span style='font-family:"Times New Roman",serif'>
              
                <?php $formattedDate = format_date_id($data->tanggal, 'd F Y');?>
                Bumiayu, <?= $formattedDate;?>
            </span>
        </p>

        <p></p>
        <br>
        <br>
        <table class="table-noborder">
            <tbody>
                <tr>
                    <td>Pembimbing / Ketua Tim Penguji dan Penguji</td>
                    <td>Tanda Tangan</td>
                </tr>
                <tr>
                    <td>1. <?= $data->dospemNama ?? '';?></td>
                    <td class="signature">
                    <td>
                </tr>
                <tr>
                    <td>2. <?= $data->dospengNama ?? '';?></td>
                    <td class="signature">
                    <td>
                </tr>
            </tbody>
        </table>


    </div>

</body>

</html>