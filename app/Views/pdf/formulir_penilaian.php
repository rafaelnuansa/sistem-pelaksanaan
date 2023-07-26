<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style type="text/css">
        body {
            line-height: 1.5;
        }

        .tg {
            border-collapse: collapse;
            border-spacing: 0;
        }

        .tg td {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            overflow: hidden;
            padding: 7px;
            word-break: normal;
        }

        .tg th {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-weight: normal;
            overflow: hidden;
            padding: 7px;
            word-break: normal;
        }

        .tg .tg-s1ip {
            border-color: inherit;
            font-family: "Times New Roman", Times, serif !important;
            font-size: 100%;
            font-weight: bold;
            text-align: center;
            vertical-align: middle
        }

        .tg .tg-r5wu {
            border-color: inherit;
            font-family: "Times New Roman", Times, serif !important;
            font-size: 100%;
            text-align: left;
            vertical-align: top
        }

        .tg .tg-1hn3 {
            border-color: inherit;
            font-family: "Times New Roman", Times, serif !important;
            font-size: 100%;
            font-weight: bold;
            text-align: center;
            vertical-align: top
        }
    </style>
</head>

<body>

    <div>
        <p>Formulir Penilaian Praktek Kerja Lapangan<br>
            Dengan ini kami menyatakan bahwa mahasiswa berikut:
        </p>
        <div style="font-weight: bold;">
            <p>Nama Pembimbing Lapangan : <?= $data->nama_pl ?? ''; ?></p>
       <p>     Nama Instansi : <?= $data->nama_perusahaan ?? ''; ?> </p>
           <p> Nama mahasiswa : <?= $data->nama ?? ''; ?> </p>
        <p>    NIM : <?= $data->nim ?? ''; ?></p>
        </div>
        <p>
            Dinyatakan telah menyelesaikan praktek kerja lapangan di instansi kami sesuai dengan kerangka acuan tertanggal di atas. Dengan mempertimbangkan segala aspek, baik dari segi bobot pekerjaan maupun pelaksanaan praktek kerja lapangan, maka kami memutuskan bahwa yang bersangkutan telah menyelesaikan kewajibannya dengan hasil sebagai berikut:
        </p>
    </div>
    <table class="tg" style="width: 100%">
        <thead>
            <tr>
                <th class="tg-s1ip" rowspan="2">No</th>
                <th class="tg-s1ip" rowspan="2">Kriteria penilaian</th>
                <th class="tg-1hn3" colspan="3">Nilai</th>
            </tr>
            <tr>
                <th class="tg-1hn3">SB</th>
                <th class="tg-1hn3">B</th>
                <th class="tg-1hn3">TO</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="tg-r5wu">1</td>
                <td class="tg-r5wu">Keputusan pemberi praktek kerja lapangan</td>
                <td class="tg-r5wu"></td>
                <td class="tg-r5wu"></td>
                <td class="tg-r5wu"></td>
            </tr>
            <tr>
                <td class="tg-r5wu">2</td>
                <td class="tg-r5wu">Disiplin</td>
                <td class="tg-r5wu"></td>
                <td class="tg-r5wu"></td>
                <td class="tg-r5wu"></td>
            </tr>
            <tr>
                <td class="tg-r5wu">3</td>
                <td class="tg-r5wu">Kemampuan memiliki prioritas</td>
                <td class="tg-r5wu"></td>
                <td class="tg-r5wu"></td>
                <td class="tg-r5wu"></td>
            </tr>
            <tr>
                <td class="tg-r5wu">4</td>
                <td class="tg-r5wu">Tepat waktu</td>
                <td class="tg-r5wu"></td>
                <td class="tg-r5wu"></td>
                <td class="tg-r5wu"></td>
            </tr>
            <tr>
                <td class="tg-r5wu">5</td>
                <td class="tg-r5wu">Kemampuan bekerja sama</td>
                <td class="tg-r5wu"></td>
                <td class="tg-r5wu"></td>
                <td class="tg-r5wu"></td>
            </tr>
            <tr>
                <td class="tg-r5wu">6</td>
                <td class="tg-r5wu">Kemampuan bekerja mandiri</td>
                <td class="tg-r5wu"></td>
                <td class="tg-r5wu"></td>
                <td class="tg-r5wu"></td>
            </tr>
        </tbody>
    </table>

    <div>
        <p>
            <b>
                Keterangan:</b>
            <br>
            <b>SB</b> = Sangat baik <br>
            <b>B</b> = Baik <br>
            <b>TO</b> = Tanpa opini
        </p>
    </div>
    <div style="float:right;margin-right:100px">
        <p style="margin-top: 50px;">
            Pembimbing
        </p>
        <p style="margin-top: 100px;"><?= $data->nama_pl ?? ''; ?></p>
    </div>
</body>

</html>