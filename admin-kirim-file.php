<?php

session_start();

// set yang bisa masuk hanya admin
if (!isset($_SESSION["login"]) ) {
    $_SESSION["logged_in_user"] = '';
    if ($_SESSION["logged_in_user"] != 'admin') {
        header("Location: login.php");
        exit;
    }
} elseif($_SESSION["logged_in_user"] != 'admin') {
    header("Location: login.php");
    exit;
}


require 'functions.php';

$koneksi = mysqli_connect("localhost", "root", "", "db_sekolah");

if ( isset($_POST["simpan"]) ) {


    if (update($_POST)) {
        echo "<script>
        alert('Berkas Berhasil Disimpan!!!');
        document.location.href = 'admin-dashboard.php';
        </script>
        ";
    } else {
        echo "<script>
                alert('Berkas Gagal Disimpan');
            </script>";
        }
}

$data_trans = mysqli_query($koneksi,"SELECT * FROM tbl_transaksi WHERE id_transaksi = '$_GET[id]'");
$d = mysqli_fetch_array($data_trans);

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simpan Data | Admin</title>
</head>
<body>
    <h1>Simpan Data</h1>
    <a href="admin-dashboard.php">Dashboard</a><br>
    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            
                <input type="hidden" name="idtrans" id="idtrans" value="<?= $d['id_transaksi'];?>"></input>
        
            <li>
                <label for="nis">NIS : </label>
                <input type="text" name="nis" id="nis" value="<?php echo $d['nis']; ?>" readonly></input>
            </li>
            <li>
                <label for="namaFile">Nama File : </label>
                <input type="text" name="namaFile" id="namaFile" value="<?php echo $d['nama_file']; ?>" readonly></input>
            </li>
            <!-- <li>
                <label for="nosertif">Nomor Sertifikat : </label>
                <input type="text" name="nosertif" id="nosertif" disabled></input>
            </li> -->
            <li>
                <input type="file" name="berkas" id="">
            </li>
            <li>
                <button type="submit" name="simpan">KIRIM!!</button>
            </li>
        </ul>
    </form>

</body>
</html>