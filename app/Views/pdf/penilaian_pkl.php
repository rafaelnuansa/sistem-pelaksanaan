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

        div.centered h3 {
            margin-top: 5px;
            /* Adjust top margin for h3 elements */
            margin-bottom: 5px;
            /* Adjust bottom margin for h3 elements */
        }
    </style>

</head>

<body>

    <div>
        <div class="centered">
            <h3>LEMBAR PENILAIAN</h3>
            <h3>UJIAN PRAKTIK KERJA LAPANGAN (PKL)</h3>
            <h3 style="text-transform: uppercase;"><?= $data->fakultas; ?></h3>
            <h3 style="text-transform: uppercase;">TAHUN AKADEMIK <?= $data->tahun_akademik; ?></h3>
        </div>
        <style type="text/css">
            .tg {
                border-collapse: collapse;
                border-spacing: 0;
                width: 100%;
            }

            .tg td {
                border-color: black;
                border-style: solid;
                border-width: 1px;
                font-family: Arial, sans-serif;
                overflow: hidden;
                font-size: 16px;
                padding-left: 4px;
                padding-right: 4px;
                word-break: normal;
            }

            .tg th {
                border-color: black;
                border-style: solid;
                border-width: 1px;
                font-family: Arial, sans-serif;
                font-weight: normal;
                overflow: hidden;
                padding: 8px 10px;
                word-break: normal;
            }

            .tg .tg-0p91 {
                border-color: inherit;
                font-family: "Times New Roman", Times, serif !important;
                text-align: center;
                vertical-align: middle;
            }

            .tg .tg-dgg6 {
                border-color: inherit;
                font-family: "Times New Roman", Times, serif !important;
                font-weight: bold;
                text-align: center;
                vertical-align: middle;
                background-color: #f2f2f2;
            }

            .tg .tg-53v8 {
                border-color: inherit;
                font-family: "Times New Roman", Times, serif !important;
                font-weight: bold;
                text-align: left;
                vertical-align: top;
            }

            .tg .tg-iucd {
                border-color: inherit;
                font-family: "Times New Roman", Times, serif !important;
                text-align: left;
                vertical-align: top;
            }

            /* Menyesuaikan lebar kolom nomor */
            .tg .tg-no {
                width: 20px;
                font-weight: bold;
            }

            /* Menyesuaikan lebar kolom Kriteria Penilaian */
            .tg .tg-criteria {
                width: 250px;
            }

            /* Menyesuaikan lebar kolom Bobot Nilai Maksimal */
            .tg .tg-max-value {
                width: 140px;
            }

            /* Menyesuaikan lebar kolom Nilai */
            .tg .tg-value {
                width: 100px;
            }
        </style>

        <table class="tg">
            <tbody>
                <tr>
                    <td class="tg-iucd" colspan="2">Nama Mahasiswa</td>
                    <td class="tg-iucd" colspan="2">: <?= $data->nama_mahasiswa; ?></td>
                </tr>
                <tr>
                    <td class="tg-iucd" colspan="2">NIM</td>
                    <td class="tg-iucd" colspan="2">: <?= $data->nim; ?></td>
                </tr>
                <tr>
                    <td class="tg-iucd" colspan="2">Jurusan</td>
                    <td class="tg-iucd" colspan="2">: <?= $data->prodi; ?></td>
                </tr>
                <tr>
                    <td class="tg-iucd" colspan="2">Tahun Angkatan</td>
                    <td class="tg-iucd" colspan="2">: <?= $data->angkatan; ?></td>
                </tr>
                <tr>
                    <td class="tg-iucd" colspan="2">Judul Laporan</td>
                    <td class="tg-iucd" colspan="2">: <?= $data->judul_laporan; ?></td>
                </tr>
                <tr>
                    <td class="tg-iucd" colspan="2">Tempat Sidang</td>
                    <td class="tg-iucd" colspan="2">: <?= $data->tempat_nama; ?></td>
                </tr>
                <tr>
                    <td class="tg-no tg-dgg6">No</td>
                    <td class="tg-dgg6 tg-criteria">Kriteria Penilaian</td>
                    <td class="tg-dgg6 tg-max-value">Bobot Nilai Maksimal</td>
                    <td class="tg-dgg6 tg-value">Nilai</td>
                </tr>
                <tr>
                    <td class="tg-no tg-0p91">1</td>
                    <td class="tg-53v8">Sikap/Penampilan Penyaji</td>
                    <td class="tg-0p91">10</td>
                    <td class="tg-0p91"><?= $data->nilai_sikap; ?></td>
                </tr>
                <tr>
                    <td class="tg-no tg-0p91">2</td>
                    <td class="tg-53v8">Cara Penyajian Materi</td>
                    <td class="tg-0p91">10</td>
                    <td class="tg-0p91"><?= $data->nilai_penyajian_materi; ?></td>
                </tr>
                <tr>
                    <td class="tg-no tg-0p91" rowspan="6">3</td>
                    <td class="tg-53v8" colspan="3">Pengorganisasian Makalah</td>
                </tr>
                <tr>
                    <td class="tg-iucd">Pendahuluan</td>
                    <td class="tg-0p91">10</td>
                    <td class="tg-0p91"><?= $data->nilai_pendahuluan; ?></td>
                </tr>
                <tr>
                    <td class="tg-iucd">Tinjauan Pustaka</td>
                    <td class="tg-0p91">10</td>
                    <td class="tg-0p91"><?= $data->nilai_tinjauan_pustaka; ?></td>
                </tr>
                <tr>
                    <td class="tg-iucd">Hasil dan Pembahasan</td>
                    <td class="tg-0p91">10</td>
                    <td class="tg-0p91"><?= $data->nilai_hasil_pembahasan; ?></td>
                </tr>
                <tr>
                    <td class="tg-iucd">Kesimpulan dan Saran</td>
                    <td class="tg-0p91">10</td>
                    <td class="tg-0p91"><?= $data->nilai_kesimpulan_dan_saran; ?></td>
                </tr>
                <tr>
                    <td class="tg-iucd">Daftar Pustaka</td>
                    <td class="tg-0p91">10</td>
                    <td class="tg-0p91"><?= $data->nilai_daftar_pustaka; ?></td>
                </tr>
                <tr>
                    <td class="tg-no tg-0p91">4</td>
                    <td class="tg-53v8">Argumentasi Penyaji</td>
                    <td class="tg-0p91">10</td>
                    <td class="tg-0p91"><?= $data->nilai_argumentasi_penyaji; ?></td>
                </tr>
                <tr>
                    <td class="tg-no tg-0p91">5</td>
                    <td class="tg-53v8">Penguasaan Materi/Konsep/Teori/Produk</td>
                    <td class="tg-0p91">20</td>
                    <td class="tg-0p91"><?= $data->nilai_penguasaan_materi; ?></td>
                </tr>
                <tr>
                    <td class="tg-no tg-0p91" colspan="2">Total</td>
                    <td class="tg-0p91">100</td>
                    <td class="tg-0p91"><?= $data->total_nilai; ?></td>
                </tr>
            </tbody>
        </table>

        <p style='line-height:150%'><b><span lang=IN style='font-family:
"Times New Roman",serif'>&nbsp;</span></b></p>

        <p><span style='font-family:"Times New Roman",serif'>Nilai mutu : <?= $data->nilai_mutu ?><br>
                Status Ujian :
                <?= $data->status_ujian ? 'Lulus' : 'Tidak Lulus' ?></span></p>

        <p style='line-height:150%'><b><span style='font-family:"Times New Roman",serif'>Catatan
                    :</span></b></p>

        <p style='line-height:150%'><span style='font-family:"Times New Roman",serif'><?= $data->catatan ?></span></p>
        <p style='margin-left:354.8pt'>
            <span style='font-family:"Times New Roman",serif'>
                <?php function date_format_id($date)
                {
                    $formatter = new IntlDateFormatter(
                        'id_ID',
                        IntlDateFormatter::FULL,
                        IntlDateFormatter::NONE
                    );

                    // Convert date string to a DateTime object
                    $dateTime = new DateTime($date);

                    // Format the date using the Indonesian locale
                    return $formatter->format($dateTime);
                }

                ?>
                <?= date_format_id($data->tanggal); ?>
            </span>
        </p>


        <p style='margin-left:354.8pt'><span style='font-family:"Times New Roman",serif'>&nbsp;</span></p>

        <p style='margin-left:354.8pt'><span lang=IN style='font-family:
"Times New Roman",serif'>&nbsp;</span></p>

        <p style='margin-left:354.8pt'><span lang=IN style='font-family:
"Times New Roman",serif'>&nbsp;</span></p>
        <p style='margin-left:354.8pt'><span lang=IN style='font-family:
"Times New Roman",serif'>&nbsp;</span></p>

        <p style='margin-left:354.8pt'><u><span lang=IN style='font-family:"Times New Roman",serif'><?= $data->dospeng ?></span></u></p>

        <p style='margin-left:354.8pt'><span style='font-family:"Times New Roman",serif'>NIDN.
            </span><span lang=IN style='font-family:"Times New Roman",serif'><?= $data->nidn ?></span></p>


        <p class=MsoNormal align=center style='text-align:center'><span style='font-size:9.0pt'>&nbsp;</span></p>


    </div>

</body>

</html>