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
            <th>Hari/Tanggal</th>
          <th>NIM</th>
          <th>Nama mahasiswa</th>
          <th>Keterangan</th>
          <th>Dospem</th>
          <th>Dospeng</th>
          <th>Tempat</th>
        </tr>    
    </thead>    
    <tbody>
        <?php foreach($data as $row): ?>
        <tr>
            <td><?= $row['tanggal'] ?></td>
            <td><?= $row['nim'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['keterangan'] ?></td>
            <td><?= $row['dospem'] ?></td>
            <td><?= $row['dospeng'] ?></td>
            <td><?= $row['tempat'] ?></td>
        </tr>
        <?php endforeach; ?>   
    </tbody>
</table>  
<p>Jumlah data : <?= $total ?></p>  
</body>  

</html>