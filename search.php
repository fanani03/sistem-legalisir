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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Cek Sertifikat</title>
    <!-- Bootstrap Core CSS -->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="assets/plugins/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="assets/plugins/chartist-js/dist/chartist-init.css" rel="stylesheet">
    <link href="assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <!--This page css - Morris CSS -->
    <link href="assets/plugins/c3-master/c3.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- Sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 col-12 align-self-center">
                    <h3 class="text-themecolor"><a href="index.php">Legalisir App</a></h3>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row">
                <!-- Column -->
                <div class="col-lg-8 col-sm-6" style="margin:auto;">
                    <div class="card">
                        <div class="card-block">
                            <form method="get" action="" enctype="multipart/form-data" class="form-horizontal form-material">
                                <div class="col-12">
                                    <p style="font-size: 2rem; font-weight: 700; text-align:center; margin-bottom: 20px;">Cari Sertifikat</p>
                                </div>
                                <div class="form-group">
                                    <label for="no" class="col-md-6" style="font-size:1rem;">Masukkan Nomor Sertifikat</label>
                                    <div class="col-md-6">
                                        <input type="text" name="no" id="no" class="form-control form-control-line" required>
                                    </div>
                                </div>
                                    <div class="col-md-4">
                                        <button type="submit" name="cari" class="btn btn-success">Cari Sertifikat</button>
                                    </div>
                                </div>
                            </form>

                            <?php if ( isset($cari) ) {
                                if ($ada) {?>
                                <div class="col-lg-12">
                                    <div class="card-block">
                                        <h4 class="card-title" style="text-align: center;">Informasi Sertifikat</h4>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>NIS</th>
                                                        <th>Nama</th>
                                                        <th>Nama File</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><?= $row["nis"];?></td>
                                                        <td><?= $row["nama"];?></td>
                                                        <td><?= $row["nama_file"];?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>       
                                    </div>
                                </div>
                            <?php }};?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <footer class="footer" style="text-align:center; margin-left: -240px;"> Copyright &copy; Legalisir App | 2021 </footer>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/plugins/bootstrap/js/tether.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!-- chartist chart -->
    <script src="assets/plugins/chartist-js/dist/chartist.min.js"></script>
    <script src="assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
    <!--c3 JavaScript -->
    <script src="assets/plugins/d3/d3.min.js"></script>
    <script src="assets/plugins/c3-master/c3.min.js"></script>
    <!-- Chart JS -->
    <script src="js/dashboard1.js"></script>
</body>
</html>