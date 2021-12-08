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
$pengajuan = query("SELECT * FROM tbl_transaksi");

// tombol cari ditekan

if (isset($_POST["cari"])) {
    // ambil apapun dari yang ditekan user masukkan ke function cari
    $pengajuan = cari($_POST["keyword"]);

}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Admin</title>
</head>
<body>
    <h1>Dashboard Admin</h1>

    <h3>
        <nav>
        <a href="admin-list-siswa.php">Siswa</a>|
        <a href="admin-simpan.php">List Sertifikat</a>|
        <a href="admin-logout.php">Logout</a>
        </nav>
        <h2>List Daftar Transaksi Siswa</h2>
        <form action="" method="post">
        <input type="text" name="keyword" size="30" placeholder="masukkan keyword pencarian...">
        <button type="submit" name="cari">CARI</button><br><br>
        </form>
        <table border="5" cellpadding="10" cellspacing="1">
            <tr>
                <td>No.</td>
                <td>NIS</td>
                <td>Nama</td>
                <td>Nama File</td>
                <td>Berkas</td>
                <td>Status</td>
                <td>Download</td>
                <td>Aksi</td>
            </tr>
            <tr>
            <?php $angka = 1; ?>
            <?php foreach($pengajuan as $row): ?>
            <td><?= $angka ?></td>
            <td><?php $nis= $row["nis"] ?><?= $row["nis"] ?></td>
            <td><?= $row["nama"] ?></td>
            <td><?= $row["nama_file"] ?></td>
            <td><?= $row["berkas"] ?></td>
            <td><?= $row["status"] ?></td>
            <td><a href="download.php?berkas=<?=$row['berkas']?>&nama=<?=$row['nama']?>">Download</a></td>
            
            <td>
            <?php
                if ($row['status'] == 'pending') {
                    echo "<a href='update-status.php?id=$row[id_transaksi]&stat=pending'>Proses </a>";
                    echo "<a href='update-status.php?id=$row[id_transaksi]&stat=tolak'>| Tolak</a>";
                } 
                else if ($row['status'] == 'proses') {
                    echo "<a href='#'>Proses </a>";
                    echo "<a href='update-status.php?id=$row[id_transaksi]&stat=tolak'>| Tolak</a>";
                    echo "<a href='admin-kirim-file.php?id=$row[id_transaksi]'>| Kirim File </a>";
                } else {
                    echo "Proses | Tolak";
                }
            ?>

            </td>
            </tr>
            <?php $angka++;?>
            <?php endforeach;?>
        </table>
    </h3>
</body>
</html>