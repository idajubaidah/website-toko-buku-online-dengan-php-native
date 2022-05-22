<h2>Data Produk</h2>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Harga</th>
			<th>Foto</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1;?>
		<?php $ambil=$koneksi->query("SELECT * FROM buku");?>
		<?php while($pecah = $ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor;?></td>
			<td><?php echo $pecah['judul'] ?></td>
			<td><?php echo $pecah['harga'] ?></td>
			<td><?php echo $pecah['gambar'] ?></td>
			<td>
				<a href="" class="btn-danger btn">hapus</a>
				<a href="" class="btn btn-warning">ubah</a>
			</td>
		</tr>
	<?php $nomor++; ?>
	<?php } ?>
	</tbody>
</table>
