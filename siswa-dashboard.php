<?php

session_start();

if ( !isset($_SESSION["login"]) ) {
    header("Location: index.php");
    exit;
}


//set session hanya untuk user saja
$user = $_SESSION["logged_in_user"];

require 'functions.php';
$pengajuan = query("SELECT * FROM tbl_transaksi
WHERE tbl_transaksi.nis = '$user'");


$namauser = $_SESSION["logged_in_nama"];


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Siswa</title>
</head>
<body>
    <h1>Selamat Datang, <?= $namauser?></h1>

    <h3>
        <nav>
        <a href="siswa-profil.php?nis=<?= $user?>">Profil</a>|
        <a href="siswa-pengajuan.php">Pengajuan</a>|
        <a href="siswa-logout.php">Logout</a>
        </nav><br>

        <table border="5" cellpadding="10" cellspacing="1">
            <tr>
                <td>No.</td>
                <td>NIS</td>
                <td>Nama</td>
                <td>Nama Berkas</td>
                <td>Status</td>
                <td>Aksi</td>
            </tr>
            <tr>
            <?php $angka = 1; ?>
            
            <?php foreach($pengajuan as $row): ?>
                
        
                <td><?= $angka?></td>

                <td><?= $row["nis"] ?></td>
                <td><?= $row["nama"] ?></td>
                <td><?= $row["nama_file"] ?></td>
                <td><?= $row["status"] ?></td>
            
                <?php
                    if($row['status'] == 'selesai'){
                        //mendapatkan database dari simpan dimana diambil tbl transaksi
                        $sql = mysqli_query($koneksi, "SELECT tbl_simpan.*, tbl_transaksi.id_transaksi FROM tbl_simpan 
                        JOIN tbl_transaksi ON tbl_transaksi.id_transaksi=tbl_simpan.id_transaksi 
                        ");
                    //var_dump($row['id_transaksi']);
                   
                   
                   //mendapatkan berkas yang diambil
                   foreach($sql as $data) :
                        if ($data['id_transaksi'] == $row['id_transaksi']) {
                            //var_dump($data);
                            echo "<td><a href='download.php?berkas=$data[berkas]&nama=$user'>Download | </a>";
                            echo "<a href='hapus-transaksi.php?id=$row[id_transaksi]' onclick='return confirm('yakin??')' style='color:red;'>Hapus</a></td>";
                        }
                    endforeach;
                    }
                else{
                    //var_dump($row);die;
                    echo "<td><a href='hapus-transaksi.php?id=$row[id_transaksi]' onclick='return confirm('yakin??')' style='color:red;'>Batalkan</a></td>";
                }
                ?>
        
                <tr>

            <?php $angka++;?>
            <?php endforeach;?>
        </table>
    </h3>
</body>
</html>