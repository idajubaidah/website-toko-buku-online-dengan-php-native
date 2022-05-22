<?php include 'koneksi.php'; ?>
<?php
$keyword = $_GET['keyword'];

$semuadata=array();
$ambil=$koneksi->query("SELECT * FROM buku WHERE judul LIKE '%$keyword%' OR penulis LIKE '%$keyword%'");
while ($pecah = $ambil->fetch_assoc()) {
	$semuadata[]=$pecah;
}

//echo "<pre>";
//print_r($semuadata);
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
	<h5>Hasil Pencarian : <?php echo $keyword ?></h5>
	<?php if (empty($semuadata)): ?>
		<div class="alert alert-danger">Pencarian tidak ditemukan</div>
	<?php endif ?>
	<div class="row">
		<?php foreach ($semuadata as $key => $value): ?>
		<div class="col-md-3">
			<div class="card mr-2 ml-4 mt-5" style="width: 16rem;">
				<img src="admin/foto_produk/<?php echo $value['foto'] ?>" class = "card-img-top">
				<div class="card-body bg-light">
					<h3 class="card-title"><?php echo $value['judul'] ?></h3>
					<h5>Rp <?php echo number_format($value['harga']) ?></h5>
					<a href="beli.php?id=<?php echo $value['id_buku'] ?>" class = "btn btn-primary">Beli</a>
					<a href="detail.php?id=<?php echo $value['id_buku'] ?>" class = "btn btn-default">Detail</a>
				</div>
			</div>
		</div>
		<?php endforeach ?>
	</div>
	
</div>

<?php include 'footer.php'; ?>
</body>
</html>