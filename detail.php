<?php session_start(); ?>
<?php include 'koneksi.php';?>
<?php
//medapatkan id produk dari url
$id_produk = $_GET["id"];

//query ambil data di database
$ambil = $koneksi->query("SELECT * FROM buku WHERE id_buku='$id_produk'");
$detail = $ambil->fetch_assoc();

//echo "<pre>";
//print_r($detail);
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

    <title>Detail Produk</title>
</head>
<body>
<?php include 'menu.php'; ?>
<section class="konten">
	<div class="container mt-5 p-5">
		<div class="row">
			<div class="col-md-6">
				<div class="card" style="width: 16rem;">
				<img src="admin/foto_produk/<?php echo $detail['foto'];?>" class = "card-img-top">
			</div>
		</div>
			<div class="col-md-6">
				<h2><?php echo $detail['judul'];?></h2>
				<h4>Rp <?php echo number_format($detail['harga']);?></h4>
				<h5>Stok : <?php echo $detail['stok']; ?></h5>

				<form method="post">
					<div class="form-group">
						<div class="input-group">
							<input type="number" min="1" name="jumlah" max="<?php echo $detail['stok'] ?>" class="form-control">
							<button class="btn btn-primary" name = "beli">Beli</button>
						</div>
					</div>
				</form>

				<?php 
				if (isset($_POST['beli'])) {
					//mendapatkan jumlah yang diinput
					$jumlah=$_POST['jumlah'];
					//memasukan produk ke keranjang belanja
					$_SESSION['keranjang'][$id_produk] = $jumlah;

					echo "<script>alert('Produk telah masuk ke keranjang belanja');</script>";
					echo "<script>location='keranjang.php';</script>";
				}
				?>
				<h5>Deskripsi Produk : </h5>
				<p><?php echo $detail['deskripsi'];?></p>
			</div>
		</div>
	</div>
</section>

<?php echo include 'footer.php' ?>;