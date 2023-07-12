<!DOCTYPE html>  
<html lang="en">  

<head>  
    <meta charset="UTF-8">  
    <meta http-equiv="X-UA-Compatible" content="IE=edge">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title><?= $title ?></title>  

</head>  

<body>  
<h2><?= $title ?></h2>
<table border=1 width=80% cellpadding=2 cellspacing=0 style="margin-top: 5px; text-align:center">  
    <thead>    
        <tr bgcolor=silver align=center>  
            <th>No</th>
            <th>Hari/Tanggal</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Jurusan</th>
            <th>Catatan Bimbingan</th>
        </tr>    
    </thead>    
    <tbody>
        <?php foreach($data as $row): ?>
        <tr>
            <td><?= $row['id_jurnal'] ?></td>
            <td><?= $row['tanggal'] ?></td>
            <td><?= $row['nim'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['nama_jurusan'] ?></td>
            <td><?= $row['catatan'] ?></td>
        </tr>
        <?php endforeach; ?>   
    </tbody>
</table>  
<p>Jumlah data : <?= $total ?></p>  
</body>  

</html>