<?php include 'koneksi.php';?>
<?php
//medapatkan id produk dari url
$id_kategori = $_GET["id"];

$kategori=array();
//query ambil data di database
$ambil = $koneksi->query("SELECT * FROM buku WHERE id_kategori='$id_kategori'");
while($pecah = $ambil->fetch_assoc()){
	$kategori[]=$pecah;
}

//echo "<pre>";
//print_r($kategori);
//echo "</pre>";
?>

<?php 
$datakategori=$koneksi->query("SELECT * FROM kategori WHERE id_kategori='$id_kategori'");
$array=$datakategori->fetch_assoc();

//echo "<pre>";
//print_r($array);
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

    <title>Alphabet Store</title>
</head>
<body>

<?php include 'menu.php'; ?>

<div class="container mt-5 p-5">
	<h3>Produk berdasarkan kategori : <?php echo $array['kategori']; ?></h3>
		<div class="row">
			<?php foreach ($kategori as $key => $value): ?>
			<div class="col-md-3">
	        <div class="card mr-2 ml-4 mt-5" style="width: 16rem;">
	          <img src="admin/foto_produk/<?php echo $value['foto'];?>" class="card-img-top" alt="...">
	          <div class="card-body bg-light">
	            <h5 class="card-title"><?php echo $value['judul'];?></h5>
	            <h6><?php echo $value['penulis'];?></h6>
	            <h7>Rp <?php echo number_format($value['harga']);?></h7><br>
	            <a href="beli.php?id=<?php echo $value['id_buku'];?>" class="btn btn-primary">Beli</a>
	            <a href="detail.php?id=<?php echo $value['id_buku'];?>" class="btn btn-default">Detail</a>
	          </div>
	        </div>
	    </div>
			<?php endforeach ?>
		</div>
	
</div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>