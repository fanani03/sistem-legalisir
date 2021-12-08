<?php

session_start();

// if ( isset($_SESSION["login"]) ) {
//     header("Location: index.php");
// }

require 'functions.php';
if ( isset($_POST["login"]) ) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username='$username'");
    
    //cek username ada di database apa tidak
    if( mysqli_num_rows($result) === 1 ) {
        //cek password
        $row = mysqli_fetch_assoc($result);
        if ($password === $row["password"]) {
            //set session
            $_SESSION["login"] = true;
            $_SESSION["logged_in_user"] = $row["nis"];
            $_SESSION["logged_in_nama"] = $row["nama"];
            header("Location: siswa-dashboard.php");
            exit;
        }
    // jika admin yang masuk
    } elseif ($password === '123' && $username === 'admin') {
        $_SESSION["login"] = true;
        $_SESSION["logged_in_user"] = 'admin';
        header("Location: admin-dashboard.php");
    }
    $error = true;
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
</head>
<body>
    <h1>LOGIN</h1>
    <?php if (isset($error)) :?>
        <p style="color:red; font-style:italic;">username / password salah</p>
    <?php endif; ?>
    <form method="post" action="">
        <ul>
        <li>
            <label for="username">Username : </label>
            <input type="text" name="username" id="username">
        </li>
        <li>
            <label for="password">Password : </label>
            <input type="password" name="password" id="password">
        </li>
        <li>
            <button type="submit" name="login">LOGIN!!!</button>
        </li>
        </ul>
    </form>
</body>
</html>