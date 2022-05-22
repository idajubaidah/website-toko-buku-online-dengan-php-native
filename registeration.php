<?php
session_start();
//skrip koneksi
include 'koneksi.php';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Alphabet Store</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="admin/assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="admin/assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="admin/assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
    <div class="container">
        <div class="row text-center  ">
            <div class="col-md-12">
                <br /><br />
                <h2> Register Customer</h2>

                <h5>( Register yourself to get access )</h5>
                <br />
            </div>
        </div>
        <div class="row">

            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>  New User ? Register Yourself </strong>  
                    </div>
                    <div class="panel-body">
                        <form method="post" role="form">
                            <br/>
                            <label class="control-label">Nama Lengkap</label> <br>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-circle-o-notch"  ></i></span>
                                <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" required />
                            </div>
                            <label class="control-label">Email</label>
                            <div class="form-group input-group">
                                <span class="input-group-addon">@</span>
                                <input type="text" class="form-control" name="email" placeholder="Email" required />
                            </div>
                            <label class="control-label">Password</label>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                <input type="password" class="form-control" name="password" placeholder="Password" required />
                            </div>
                            <label class="control-label">No Handphone</label>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-mobile-phone"></i></span>
                                <input type="text" class="form-control" name="no_hp" placeholder="No Handphone" required />
                            </div>
                            <label class="control-label">Alamat</label>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"  ></i></span>
                                <textarea class="form-control" name="alamat" placeholder="Alamat" required></textarea>
                            </div>
                            <div class="form-group input-group">
                            <button class="btn btn-primary" name="daftar">Daftar</button>
                            Sudah memiliki akun?  <a href="login.php" >Login</a>
                            </div>
                        </form>
                        <?php
                        //jika button daftar diklik
                        if(isset($_POST['daftar'])) {
                            //mengambil isian nama, email, password, no hp dan alamat
                            $nama = $_POST["nama"];
                            $email = $_POST["email"];
                            $password = $_POST["password"];
                            $no_hp = $_POST["no_hp"];
                            $alamat = $_POST["alamat"];

                            //cek apakah email sudah digunakan
                            $ambil=$koneksi->query("SELECT * FROM customer WHERE email = '$email'");
                            $yangcocok = $ambil->num_rows;
                            if ($yangcocok==1)
                            {
                                echo "<script>alert('Pendaftaran gagal, email sudah digunakan');</script>";
                                echo "<script>location='registeration.php';</script>";
                            } else
                            {
                                //query insert ke database
                                $koneksi->query("INSERT INTO customer (nama, email, password, no_hp, alamat) VALUES ('$nama','$email', '$password','$no_hp','$alamat')");

                                echo "<script>alert('Pendaftaran sukses, silahkan login');</script>";
                                echo "<script>location='login.php';</script>";
                            }

                        }
                        ?>
                    </div>

                </div>
            </div>


        </div>
    </div>


    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>

</body>
</html>
