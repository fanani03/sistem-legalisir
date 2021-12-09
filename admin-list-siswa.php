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

//$user = $_SESSION["logged_in_user"];
require 'functions.php';
$pengajuan = query("SELECT * FROM tbl_user");
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Admin</title>
</head>
<body>
    <header>
        <h1>List Siswa</h1>
    </header>
    <h3>
        <nav>
        <a href="admin-dashboard.php">Dashboard</a><br>
        <a href="admin-list-siswa-register.php">Tambah Siswa</a><br><br>
        </nav>
        <table border="5" cellpadding="10" cellspacing="1">
            <tr>
                <td>No.</td>
                <td>NIS</td>
                <td>Username</td>
                <td>Nama</td>
                <td>Alamat</td>
                <td>Aksi</td>
            </tr>
            <tr>
            <?php $angka = 1; ?>
            <?php foreach($pengajuan as $row): ?>

            <td><?= $angka ?></td>
            <td><?= $row["nis"] ?></td>
            <td><?= $row["username"] ?></td>
            <td><?= $row["nama"] ?></td>
            <td><?= $row["alamat"] ?></td>
            <td> 
            <a href="hapus-siswa.php?nis=<?=$row['nis']?>" onclick="return confirm('yakin??')";>Hapus</a>
            </td>
            <tr>
            <?php $angka++;?>
            <?php endforeach;?>
        </table>
    </h3>
</body>
</html>