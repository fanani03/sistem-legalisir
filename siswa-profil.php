<?php
require 'functions.php';
$nis = $_GET['nis'];
$data = mysqli_query($koneksi, "SELECT * FROM tbl_user
WHERE nis = '$nis'");
$row = mysqli_fetch_assoc($data);

?>


<html>

<head></head>

<body>
    <h1>Profil Siswa</h1>
    <h3>
        Username : <?= $row['username']?> <br>
        Password :  <?= $row['password']?> <br>
        Nama :  <?= $row['nama']?> <br>
        NIS : <?= $row['nis']?> <br>
        Alamat : <?= $row['alamat']?>
    </h3>
</body>
</html>