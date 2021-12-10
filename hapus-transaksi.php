<?php
session_start();

// set yang bisa masuk hanya admin

if ( !isset($_SESSION["login"]) ) {
    header("Location: index.php");
    exit;
}

//set session hanya untuk user saja
$user = $_SESSION["logged_in_user"];

require 'functions.php';
$id= $_GET["id"];
// var_dump($nis);die;
if (hapus_transaksi($id) > 0) {
    echo "
        <script>
            alert('data berhasil di hapus!');
            document.location.href = 'siswa-dashboard.php';
        </script>
        ";
} else{
    echo "
        <script>
            alert('data gagal dihapus!!!');
            document.location.href = 'siswa-dashboard.php';
        </script>
        ";
}
?>