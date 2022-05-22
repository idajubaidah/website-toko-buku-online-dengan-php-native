<?php
$semuadata=array();
$tgl_mulai='-';
$tgl_selesai='-';
if (isset($_POST['kirim'])) {
	$tgl_mulai = $_POST['tglm'];
	$tgl_selesai = $_POST['tgls'];
	$ambil = $koneksi->query("SELECT * FROM pembelian pm LEFT JOIN customer cs ON pm.id_customer=cs.id_customer WHERE tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai'");
	while ($pecah = $ambil->fetch_assoc()) {
		$semuadata[]=$pecah;
	}

	//echo "<pre>";
	//print_r($semuadata);
	//echo "</pre>";
}

?>



<h2>Laporan Pembelian dari <?php echo $tgl_mulai ?> hingga <?php echo $tgl_selesai?></h2>
<hr>

<form method="post">
	<div class="row">
		<div class="col-md-5">
			<div class="form-group">
				<label>Tanggal Mulai</label>
				<input type="date" name="tglm" class="form-control" value="<?php echo $tgl_mulai ?>">
			</div>
		</div>
		<div class="col-md-5">
			<div class="form-group">
				<label>Tanggal Selesai</label>
				<input type="date" name="tgls" class="form-control" value="<?php echo $tgl_selesai ?>">
			</div>
		</div>
		<div class="col-md-2">
			<label>&nbsp;</label> <br>
			<button class="btn btn-primary" name="kirim">Lihat</button>
		</div>
	</div>
</form>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Pelanggan</th>
			<th>Tanggal</th>
			<th>Status</th>
			<th>Jumlah</th>
			
		</tr>
	</thead>
	<tbody>
		<?php $total=0; ?>
		<?php foreach ($semuadata as $key => $value): ?>
		<?php $total+=$value['total_pembelian']; ?>
		<tr>
			<td><?php echo $key+1; ?></td>
			<td><?php echo $value['nama']; ?></td>
			<td><?php echo $value['tanggal']; ?></td>
			<td><?php echo $value['status_pembelian']; ?></td>
			<td>Rp <?php echo number_format($value['total_pembelian']); ?></td>
			
		</tr>
	<?php endforeach ?>
	</tbody>
	<tfoot>
		<tr>
			<th colspan="4">Total</th>
			<th>Rp <?php echo number_format($total); ?></th>
		</tr>
	</tfoot>
</table>