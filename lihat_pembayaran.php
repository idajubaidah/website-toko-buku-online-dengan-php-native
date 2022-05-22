<?php
session_start();
//koneksi ke databse
include 'koneksi.php';

$id_pembelian = $_GET['id'];
$ambil=$koneksi->query("SELECT * FROM pembayaran LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian WHERE pembelian.id_pembelian='$id_pembelian'");
$detail_pembayaran=$ambil->fetch_assoc();
//echo "<pre>";
//print_r($detail_pembayaran);
//echo "</pre>";
//jika belum ada data pembayaran
if (empty($detail_pembayaran)) {
	echo "<script>alert('anda belum melakukan pembayaran');</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}

//jika data pelanggan yang bayar tidak sesuai dengann yang login
if ($_SESSION['customer']['id_customer']!==$detail_pembayaran['id_customer']) {
	echo "<script>alert('anda belum melakukan pembayaran');</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}

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

    <title>Pembayaran</title>
</head>
<body>
<?php include 'menu.php'; ?>
<div class="container mt-5 p-5">
	<h3>Lihat Pembayaran</h3>
	<div class="row">
		<div class="col-md-6">
			<table class="table">
				<tr>
					<td>Nama</td>
					<td><?php echo $detail_pembayaran['nama']; ?></td>
				</tr>
				<tr>
					<td>Bank</td>
					<td><?php echo $detail_pembayaran['bank']; ?></td>
				</tr>
				<tr>
					<td>Tanggal</td>
					<td><?php echo $detail_pembayaran['tanggal']; ?></td>
				</tr>
				<tr>
					<td>Jumlah</td>
					<td>Rp <?php echo number_format($detail_pembayaran['jumlah']); ?></td>
				</tr>
			</table>
		</div>
		<div class="col-md-6">
			<div class="card mr-2 ml-4" style="width: 12rem;">
			<img src="bukti_pembayaran/<?php echo $detail_pembayaran['bukti'] ?>" class="card-img-top">
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php'; ?>
</body>
</html>