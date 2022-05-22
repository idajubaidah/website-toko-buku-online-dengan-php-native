<?php
session_start();
//skrip koneksi
include 'koneksi.php';

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	 <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/50a6b5ed9d.js" crossorigin="anonymous"></script>
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
  <link rel="stylesheet" type="text/css" href="login.css">


</head>
<body>

<body background="img/lib.jpg">
  <div class="container">
    <div class="row text-center ">
      <div class="col-md-12">
        <br /><br />
        
        <br />
      </div>
    </div>
    <div class="row ">
      <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
        <div class="panel panel-default mt-5">
          <div class="panel-heading">
            <h5>Login Customer </h5>
            <h5 id="pertama">( Login yourself to get access )</h5>  
          </div>
          <div class="panel-body">
            <form role="form" method="POST">
             <br />
             <div class="form-group input-group">
              <span class="input-group-addon">@</span>
              <input type="text" class="form-control" name="user" />
            </div>
            <div class="form-group input-group">
              <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
              <input type="password" class="form-control"  name="pass" />
            </div>

           <button class="btn btn-primary" name="login">Login</button>
           <hr />
           Belum punya akun? <a href="registeration.php" >click here </a> 
         </form>
         <?php
         if (isset($_POST['login']))
         {
          $ambil = $koneksi->query("SELECT * FROM customer WHERE email ='$_POST[user]'
            AND password='$_POST[pass]'");
          $yangcocok=$ambil->num_rows;
          if ($yangcocok==1) 
          {
            $_SESSION['customer'] = $ambil->fetch_assoc();
            echo "<div class = 'alert alert-info'>Login Sukses</div>";
            echo "<meta http-equiv='refresh' content='1;url=index.php'>";

            //jika sudah belanja
            if(isset($_SESSION['keranjang']) OR !empty($_SESSION['keranjang']))
            {
              echo "<script>location='checkout.php';</script>";
            }
            else
            {
              echo "<script>location='index.php';</script>";
            }
          }else
          {
            echo "<div class = 'alert alert-danger'>Username atau Password yang Anda Masukan Salah</div>";
            echo "<meta http-equiv='refresh' content='1;url=login.php'>";
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
