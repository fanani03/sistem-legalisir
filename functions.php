<?php

// koneksi ke database  dengan parameter nama host, username, paswd, nama dabatase
$koneksi = mysqli_connect("localhost", "root", "", "db_sekolah");

// proses mengambil tiap isi di database
function query($query) {
    global $koneksi;

    // lemari
    $result = mysqli_query($koneksi, $query);
    //menyiapkan data kosong
    $rows = [];

    // Proses memasukkan tiap isi kedalam $rows
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

function ajukan($data) {
    global $koneksi;
    $nama = $data["nama"];
    $nis = $data["nis"];
    $namaFile = $data["namaFile"];
    $status = 'pending';
    $berkas = upload();
    if ( !$berkas) {
        return false;
    }
    // var_dump($status);die;

    //query insert data
    $query = "INSERT INTO tbl_transaksi
                VALUES
                ('','$nis', '$nama', '$namaFile', '$status', '$berkas')
            ";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

function upload() {
    // ambil isi dari $_FILES masukkan ke variabel
    $namaFile = $_FILES['berkas']['name'];
    $ukuranFile = $_FILES['berkas']['size'];
    $error = $_FILES['berkas']['error'];
    $tmpName = $_FILES['berkas']['tmp_name'];

    // cek apakah tidak ada file yang di upload
    if ($error === 4) {
        echo "<script>
                alert('pilih berkas terlebih dahulu');
            </script>";
        return false;
    }

    // lolos pengecekan 
    move_uploaded_file($tmpName, 'berkas/'.$namaFile);
    return $namaFile;
}

function simpan($data) {
    global $koneksi;
    $nis = $data["nis"];
    $namaFile = $data["namaFile"];
    $nosertif = $data["nosertif"];
    $berkas = upload_simpan();
    if ( !$berkas) {
        return false;
    }
    // var_dump($status);die;
    $querysertifikat = "SELECT no_sertifikat FROM tbl_simpan
                        WHERE no_sertifikat=$nosertif";
    mysqli_query($koneksi, $querysertifikat);
    if ( mysqli_affected_rows($koneksi) > 0 ) {
        echo "<script>
            alert('Nomor Sertifikat Telah Ada')
        </script>";
        return false;
    }
    //query insert data
    $query = "INSERT INTO tbl_simpan
                VALUES
                ('','$nis','$namaFile','$nosertif', '$berkas')
            ";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

function upload_simpan() {
    // ambil isi dari $_FILES masukkan ke variabel
    $namaFile = $_FILES['berkas']['name'];
    $ukuranFile =$_FILES['berkas']['size'];
    $error = $_FILES['berkas']['error'];
    $tmpName = $_FILES['berkas']['tmp_name'];

    // cek apakah tidak ada file yang di upload
    if ($error === 4) {
        echo "<script>
                alert('pilih berkas terlebih dahulu');
            </script>";
        return false;
    }

    // lolos pengecekan 
    move_uploaded_file($tmpName, 'berkas_jadi/'.$namaFile);
    return $namaFile;
}

function hapus($id) {
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM tbl_user WHERE nis=$id");
    //mengembalikan nilai apakah ada perubahan atau tidak
    return mysqli_affected_rows($koneksi);
}

function hapus_transaksi($id) {
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM tbl_transaksi WHERE id_transaksi=$id");
    //mengembalikan nilai apakah ada perubahan atau tidak
    return mysqli_affected_rows($koneksi);
}

function tambah($data) {
    global $koneksi;
    // ambil data tiap elemen
    $nis = $data["nis"];
    $username = $data["username"];
    $pass = $data["password"];
    $nama = $data["nama"];
    $alamat = $data["alamat"];

    //query insert data
    $query = "INSERT INTO tbl_user
            VALUES
            ('$nis', '$username', '$pass', '$nama', '$alamat')
        ";
    mysqli_query($koneksi, $query);
    //mengembalikan nilai apakah ada perubahan atau tidak
    return mysqli_affected_rows($koneksi);
}

function update($data){
    global $koneksi;
    $nis = $data["nis"];
    $idtrans = $data["idtrans"];
    $namaFile = $data["namaFile"];
    $nosertif = $data["nosertif"];

    $berkas = upload_simpan();
    if ( !$berkas) {
        return false;
    }
    // $src = mysqli_query($koneksi, "SELECT max(id_simpan) AS idmax FROM tbl_simpan");
    // $srcMax = mysqli_fetch_array($src);
    // $srcMaxNext = (int)$srcMax['idmax'] + 1;
    // $nosertif = $nis.$srcMaxNext.substr(getdate()['0'], -6);
    // echo $nosertif;
    $edit_simpan = mysqli_query($koneksi, "INSERT INTO tbl_simpan
    VALUES
    ('','$nis','$idtrans', '$namaFile','$nosertif', '$berkas')");
    $edit_trans = mysqli_query($koneksi, "UPDATE tbl_transaksi SET status ='selesai' WHERE id_transaksi = '$_GET[id]'");
    return mysqli_affected_rows($koneksi);    
}

function cari($keyword) {
    $query = "SELECT * FROM tbl_transaksi
                WHERE
                nama LIKE '%$keyword%' OR
                nama_file LIKE '%$keyword%' OR
                nis LIKE '%$keyword%' OR
                berkas LIKE '%$keyword%'
            ";

    return query($query);
}

?>