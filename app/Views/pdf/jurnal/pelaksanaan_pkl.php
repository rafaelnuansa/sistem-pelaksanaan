<!DOCTYPE html>  
<html lang="en">  

<head>  
    <meta charset="UTF-8">  
    <meta http-equiv="X-UA-Compatible" content="IE=edge">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title><?= $title ?></title>  
<style>
    body{
        font-family: Arial, Helvetica, sans-serif;
    }
</style>
</head>  

<body>  
<h2><?= $title ?></h2>
<table border=1 width=100% cellpadding=2 cellspacing=0 style="margin-top: 5px; text-align:center">  
    <thead>    
        <tr bgcolor=silver align=center>  
            <th>No</th>
            <th>Nama Mahasiswa</th>
            <th>Hari/Tanggal</th>
            <th>Jam</th>
            <th>Keterangan Kegiatan PKL</th>
        </tr>    
    </thead>    
    <tbody>
        <?php foreach($data as $i => $row): ?>
        <tr>
            <td><?= ++$i ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['hari'] ?></td>
            <td><?= $row['jam'] ?></td>
            <td><?= $row['keterangan'] ?></td>
        </tr>
        <?php endforeach; ?>   
    </tbody>
</table>  
<p>Jumlah data : <?= $total ?></p>  
</body>  

</html>