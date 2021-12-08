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
// koneksi database
$koneksi = mysqli_connect("localhost", "root", "", "db_sekolah");

// cek apakah tombol submit sudah ditekan


if (isset($_POST["submit"])) {

    //cek apakah data berhasil ditambahkan
    if (tambah($_POST) > 0) {
        echo "<script>
                alert('Data berhasil dimasukkan')
                document.location.href = 'admin-list-siswa.php';
                </script>
                ";
    } else {
        echo "<script>
                    alert('Data gagal dimasukkan')
                    document.location.href = 'admin-list-siswa.php';
              </script>
            ";
    }
}


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN | Tambah Siswa</title>
</head>
<body>
    <h1>Tambah Data Siswa</h1>
    <ul>
        <form method="post" action="" enctype="multipart/form-data">
        <li>
            <label for="nis">NIS : </label>
            <input type="text" name="nis" id="nis" required>
        </li>
        <li>
            <label for="username">Username : </label>
            <input type="text" name="username" id="username" required>
        </li>
        <li>
            <label for="password">Password : </label>
            <input type="password" name="password" id="password" required>
        </li>
        <li>
            <label for="nama">Nama : </label>
            <input type="text" name="nama" id="nama" required>
        </li>
        <li>
            <label for="alamat">Alamat : </label>
            <input type="text" name="alamat" id="alamat">      
        </li>
        <li>
            <button type="submit" name="submit">KIRIM!!!</button>
        </li>
    <ul>
</form>
</body>
</html>