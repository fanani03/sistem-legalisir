<?php

session_start();
if ( !isset($_SESSION["login"]) ) {
    header("Location: index.php");
    exit;
}

require 'functions.php';

$koneksi = mysqli_connect("localhost", "root", "", "db_sekolah");

if ( isset($_POST["ajukan"]) ) {


    if ( ajukan($_POST) > 0 ) {
        echo "<script>
            alert('Berkas Berhasil Diajukan!!!');
            document.location.href = 'siswa-dashboard.php';
        </script>
        ";
    } else {
        echo "<script>
                alert('Berkas Gagal Diajukan');
            </script>";
        }
}
$user = $_SESSION["logged_in_user"];
$sql = mysqli_query($koneksi,"SELECT * FROM tbl_user WHERE nis = '$user'");
$siswa = mysqli_fetch_array($sql);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan | Siswa</title>
</head>
<body>
    <h1>Pengajuan Legalisir</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <ul>
        <li>
            <label for="nama">Nama : </label>
            <input type="text" name="nama" id="nama" value="<?= $siswa['nama']; ?>" readonly></input>
            </li>
            <li>
                <label for="nis">NIS : </label>
                <input type="text" name="nis" id="nis" value="<?= $siswa['nis']; ?>" readonly></input>
            </li>
            <li>
                <label for="namaFile">Nama File : </label>
                <input type="text" name="namaFile" id="namaFile" required></input>
            </li>
            <li>
                <label for="berkas">Berkas : </label>
                <input type="file" name="berkas" id="berkas" required></input>
            </li>
            <li>
                <button type="submit" name="ajukan">KIRIM!!</button>
            </li>

        </ul>
    </form>
</body>
</html>