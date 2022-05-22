<?php
session_start();
include 'koneksi.php';
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
	<title>Nota Pembelian</title>
</head>
<body>
<?php include 'menu.php'; ?>
<section class="konten">
	<div class="container mt-2 p-5">
		
		<center><h2>Detail Pembelian</h2></center>
		<?php
		$ambil=$koneksi->query("SELECT * FROM pembelian JOIN customer ON pembelian.id_customer=customer.id_customer WHERE pembelian.id_pembelian='$_GET[id]'");
		$detail = $ambil->fetch_assoc();
		?>

		<!--jika pelanggan yang beli tidak sama dengan yang login, maka dilarikan ke riwayat.php-->
		<!--pelanggan yang beli harus pelanggan yang login-->
		<?php 
		//mendapatkan id customer yang beli
		$id_customer_beli = $detail['id_customer'];

		//mendapatkan id customer yang login
		$id_customer_login = $_SESSION['customer']['id_customer'];

		if ($id_customer_beli!==$id_customer_login) {
			echo "<script>alert('anda harus login');</script>";
			echo "<script>location='riwayat.php';</script>";
			exit();
		}
		?>

		<div class="row">
			<div class="col-md-4">
				<h3>Pembelian</h3>
				<strong>No. Pembelian : <?php echo $detail['id_pembelian'];?></strong><br>
				Tanggal : <?php echo $detail['tanggal'];?><br>
				Total : <?php echo number_format($detail['total_pembelian']);?>
			</div>
			<div class="col-md-4">
				<h3>Pelanggan</h3>
				<strong><?php echo $detail['nama'];?></strong><br>
				<p>
					<?php echo $detail['no_hp'];?> <br>
					<?php echo $detail['email'];?> <br>
				</p>
			</div>
			<div class="col-md-4">
				<h3>Pengiriman</h3>
				<strong><?php echo $detail['nama_kota']; ?></strong><br>
				Ongkos Kirim : Rp <?php echo number_format($detail['tarif']);?><br>
				Alamat : <?php echo $detail['alamat_pengiriman']; ?>
			</div>
		</div>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>NO</th>
					<th>Judul Buku</th>
					<th>Harga</th>
					<th>Jumlah</th>
					<th>Subtotal</th>
				</tr>
			</thead>
			<tbody>
				<?php $nomor=1;?>
				<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]'");?>
				<?php while($pecah=$ambil->fetch_assoc()){?>
				<tr>
					<td><?php echo $nomor;?></td>
					<td><?php echo $pecah['judul'];?></td>
					<td>Rp <?php echo number_format($pecah['harga']);?></td>
					<td><?php echo $pecah['jumlah'];?></td>
					<td>Rp <?php echo number_format($pecah['subharga']);?></td>
				</tr>
				<?php $nomor++; ?>
				<?php }?>
			</tbody>
		</table>

		<div class="row">
			<div class="col-md-7">
				<div class="alert alert-info">
					<p>Silahkan Melakukan Pembayaran Sebesar Rp <?php echo number_format($detail['total_pembelian']);?> melalui <br>
					<strong>Bank BCA 7518519900 a/n Ida Jubaidah</strong>
					</p>
				</div>
			</div>
		</div>

	</div>
</section>
<?php include 'footer.php'; ?>
</body>
</html>