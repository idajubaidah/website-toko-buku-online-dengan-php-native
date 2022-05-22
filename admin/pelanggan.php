<h2>Data Pelanggan</h2>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Email</th>
			<th>No Handphone</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1;?>
		<?php $ambil=$koneksi->query("SELECT * FROM customer");?>
		<?php while($pecah = $ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor;?></td>
			<td><?php echo $pecah['nama'] ?></td>
			<td><?php echo $pecah['email'] ?></td>
			<td><?php echo $pecah['no_hp'] ?></td>
		</tr>
	<?php $nomor++; ?>
	<?php } ?>
	</tbody>
</table>
