<?php
session_start();
//koneksi ke databse
include 'koneksi.php';

$datakategori=array();

$ambil=$koneksi->query("SELECT * FROM kategori");
while($tiap=$ambil->fetch_assoc()) {
    $datakategori[]=$tiap;
}

//echo"<pre>";
//print_r($datakategori);
//echo "</pre>";

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/50a6b5ed9d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style.css">

    <title>Alphabet Store</title>
</head>
<body>

<?php include 'menu.php'; ?>

<div class="row mt-5 no-gutters">
    <div class="col-md-2 bg-light">
        <ul class="list-group list-group-flush p-2 pt-4">
            <li class="list-group-item bg-warning"> <i class="fas fa-list"></i> KATEGORI BUKU</li>
            <?php foreach ($datakategori as $key => $value): ?>
            <a class="list-group-item text-dark" href="kategori.php?id=<?php echo $value['id_kategori'] ?>"><i class="fas fa-angle-right"></i> <?php echo $value['kategori']; ?></a>
            <?php endforeach ?>
        </ul>
    </div>
    <div class="col-md-10">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/slide1.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="img/slide2.png" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
              <img src="img/slide3.png" class="d-block w-100" alt="...">
          </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    </div>

    <h4 class="text-center font-wight-bold m-4">Produk Terbaru</h4>
    <div class="row mx-auto">
        <?php $ambil=$koneksi->query("SELECT * FROM buku");?>
        <?php while ($perproduk=$ambil->fetch_assoc()) { ?>
        <div class="col-md-3">
        <div class="card mr-2 ml-4 mt-5" style="width: 16rem;">
          <img src="admin/foto_produk/<?php echo $perproduk['foto'];?>" class="card-img-top" alt="...">
          <div class="card-body bg-light">
            <h5 class="card-title"><?php echo $perproduk['judul'];?></h5>
            <h6><?php echo $perproduk['penulis'];?></h6>
            <h7>Rp <?php echo number_format($perproduk['harga']);?></h7><br>
            <a href="beli.php?id=<?php echo $perproduk['id_buku'];?>" class="btn btn-primary">Beli</a>
            <a href="detail.php?id=<?php echo $perproduk['id_buku'];?>" class="btn btn-default">Detail</a>
          </div>
        </div>
    </div> <?php }?>
    </div>
</div>

</div>

<?php include 'footer.php'; ?>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
-->
</body>
</html>