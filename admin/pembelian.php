<h2>Data Pembelian</h2>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Customer</th>
			<th>Total</th>
			<th>Tanggal</th>
			<th>Status Pembelian</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1;?>
		<?php $ambil=$koneksi->query("SELECT * FROM pembelian JOIN customer ON pembelian.id_customer=customer.id_customer");?>
		<?php while($pecah = $ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor;?></td>
			<td><?php echo $pecah['nama'] ?></td>
			<td><?php echo $pecah['total_pembelian'] ?></td>
			<td><?php echo $pecah['tanggal'] ?></td>
			<td><?php echo $pecah['status_pembelian']; ?></td>
			<td>
				<a href="index.php?halaman=detail&id=<?php echo $pecah['id_pembelian'];?>" class="btn btn-info">Detail</a>

				<?php if ($pecah['status_pembelian']!=="pending"): ?>
				<a href="index.php?halaman=pembayaran&id=<?php echo $pecah['id_pembelian'] ?>" class="btn btn-success">Pembayaran </a>
			<?php endif ?>
			</td>
		</tr>
	<?php $nomor++; ?>
	<?php } ?>
	</tbody>
</table>