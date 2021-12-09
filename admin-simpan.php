<?php

session_start();

// set yang bisa masuk hanya admin
if (!isset($_SESSION["login"]) ) {
    $_SESSION["logged_in_user"] = '';
    if ($_SESSION["logged_in_user"] != 'admin') {
        header("Location: index.php");
        exit;
    }
} elseif($_SESSION["logged_in_user"] != 'admin') {
    header("Location: index.php");
    exit;
}

require 'functions.php';

$koneksi = mysqli_connect("localhost", "root", "", "db_sekolah");

$data = query("SELECT tbl_simpan.*, tbl_user.nama
                    FROM tbl_simpan INNER JOIN tbl_user ON
                    tbl_simpan.nis=tbl_user.nis");
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simpan Data | Admin</title>
</head>
<body>
    <h1>List Sertifikat</h1>
    
    <table border="5" cellpadding="10" cellspacing="1">
    <tr>
        <td>No.</td>
        <td>NIS</td>
        <td>Nama</td>
        <td>Nama File</td>
        <td>No Sertifikat</td>
        <td>Berkas</td>
    </tr>

    <?php $angka = 1; ?>
    <tr>
        <?php foreach($data as $row): ?>
        <td><?= $angka ?></td>
        <td><?= $row["nis"] ?></td>
        <td><?= $row["nama"] ?> </td>
        <td><?= $row["nama_file"] ?> </td>
        <td><?= $row["no_sertifikat"] ?></td>
        <td><?= $row["berkas"] ?></td>
    </tr>
    
    <?php $angka++; ?>
    <?php endforeach; ?>
    </table>
</body>
</html>