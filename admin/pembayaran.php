<h2>Data Pembayaran</h2>

<?php 
//mendapatkan id dari url
$id_pembelian = $_GET['id'];

//mengambil data pembayaran berdasarkan id_pembelian

$ambil=$koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian='$id_pembelian'");
$detail = $ambil->fetch_assoc();
?>

<div class="row">
	<div class="col-md-6">
		<table class="table">
		<tr>
			<th>Nama</th>
			<td><?php echo $detail['nama']; ?></td>
		</tr>
		<tr>
			<th>Bank</th>
			<td><?php echo $detail['bank']; ?></td>
		</tr>
		<tr>
			<th>Jumlah</th>
			<td>Rp <?php echo number_format($detail['jumlah']); ?></td>
		</tr>
		<tr>
			<th>Tanggal</th>
			<td><?php echo $detail['tanggal']; ?></td>
		</tr>
		</table>
	</div>
	<div class="col-md-6">
		<div class="card mr-2 ml-2 mt-5" style="width: 18rem;">
		<img src="../bukti_pembayaran/<?php echo $detail['bukti']?>" alt="" class="img-responsive">
	</div>
	</div>
</div>

<form method="post">
	<div class="form-group">
		<label>No Resi Pengiriman</label>
		<input type="text" name="resi" class="form-control">
	</div>
	<div class="form-group">
		<label>Status Pesanan</label>
		<select class="form-control" name="status">
			<option value="">Pilih Status Pesanan</option>
			<option value="lunas">Pesanan Sudah Lunas</option>
			<option value="barang dikirim">Barang sudah dikirim</option>
			<option value="batal">Pesanan dibatalkan</option>
		</select>
	</div>
	<button class="btn btn-primary" name="proses">Proses</button>
</form>

<?php
if (isset($_POST['proses'])) {
	$resi = $_POST['resi'];
	$status = $_POST['status'];
	$koneksi->query("UPDATE pembelian SET no_resi='$resi', status_pembelian='$status' WHERE id_pembelian='$id_pembelian'");

	echo "<script>alert('data pembelian diperbaharui');</script>";
	echo "<script>location='index.php?halaman=pembelian'</script>";
}