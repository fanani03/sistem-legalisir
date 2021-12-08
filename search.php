<?php
require 'functions.php';

if ( isset($_GET['cari']) ) {
    $cari = $_GET["no"];
    $query = "SELECT tbl_simpan.no_sertifikat, tbl_simpan.nis, tbl_simpan.nama_file, tbl_user.nama, tbl_user.nis
    FROM tbl_user JOIN tbl_simpan ON tbl_simpan.nis=tbl_user.nis 
    WHERE no_sertifikat='$cari'";
    
    $result = mysqli_query($koneksi, $query);
    // var_dump($data);die;
    if ( mysqli_affected_rows($koneksi) > 0 ) {
        echo "<script>  
                alert('Sertifikat ASLI');
                </script>";
                $row = mysqli_fetch_assoc($result);
                // var_dump($row);die;
                $ada = true;
    } else {
        echo "<script>
            alert('Sertifikat SALAH');   
            </script>";
            $ada = false;
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian</title>
</head>
<body>
    <h1>Masukkan Nomor Sertifikat</h1>
    <form action="" method="get">
        <label for="no">Nomor Sertifikat :</label>
        <input type="text" name="no" id="no"></input>
        <button type="submit" name="cari">CARI</button>
    </form>

    <?php if ( isset($cari) ) {
        if ($ada) {?>
        <h3>INFORMASI</h3>
        NIS : <?= $row["nis"];?><br>
        Nama : <?= $row["nama"];?><br>
        Nama File : <?= $row["nama_file"];?>
    <?php }};?>
</body>
</html>