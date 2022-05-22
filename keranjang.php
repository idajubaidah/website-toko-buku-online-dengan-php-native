<?php
session_start();
//echo "<pre>";
//print_r($_SESSION['keranjang']);
//echo "</pre>";

//koneksi ke databse
include 'koneksi.php';
if (!isset($_SESSION['customer']))
{
    echo "<script>alert('Silahkan Login');</script>";
    echo "<script>location='login.php';</script>";
}
if(empty($_SESSION['keranjang']) OR !isset($_SESSION['keranjang']))
{
	echo "<script>alert('keranjang kosong, silahkan pesan dulu');</script>";
	echo "<script>location='index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/50a6b5ed9d.js" crossorigin="anonymous"></script>

	<title>Keranjang Belanja</title>
</head>
<body>
<?php include 'menu.php'; ?>

<section class="konten">
	<div class="container mt-5 p-5">
		<h1>Keranjang Belanja</h1>
		<hr>
		<table class="table table-bordered mt-5">
			<thead>
				<tr>
					<th>No</th>
					<th>Judul</th>
					<th>Penulis</th>
					<th>Harga</th>
					<th>Jumlah</th>
					<th>Subharga</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $nomor=1; ?>
				<?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah): ?>
				<!--menampilkan produk yang diperulang berdasarkan id produk-->
				<?php
				$ambil = $koneksi->query("SELECT * FROM buku WHERE id_buku='$id_produk'");
				$pecah = $ambil->fetch_assoc();
				$subharga=$pecah['harga']*$jumlah;
				?>
				<tr>
					<td><?php echo $nomor;?></td>
					<td><?php echo $pecah['judul'];?></td>
					<td><?php echo $pecah['penulis'];?></td>
					<td>Rp <?php echo number_format($pecah['harga']);?></td>
					<td><?php echo $jumlah;?></td>
					<td>Rp <?php echo number_format($subharga);?></td>
					<td>
						<a href="hapuskeranjang.php?id=<?php echo $id_produk ?>" class="btn btn-danger btn-xs">Hapus</a>
					</td>
				</tr>
				<?php $nomor++;?>
				<?php endforeach ?>
			</tbody>
		</table>

		<a href="index.php" class="btn btn-primary">Lanjutkan Belanja</a>
		<a href="checkout.php" class="btn btn-primary">Checkout</a>
	</div>
</section>

<?php include 'footer.php'; ?>
</body>
</html>