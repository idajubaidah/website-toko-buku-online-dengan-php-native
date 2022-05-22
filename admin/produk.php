<h2>Data Produk</h2>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Kategori</th>
			<th>Nama</th>
			<th>Harga</th>
			<th>Penulis</th>
			<th>Penerbit</th>
			<th>Stok</th>
			<th>Deskripsi</th>
			<th>Foto</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1;?>
		<?php $ambil=$koneksi->query("SELECT * FROM buku LEFT JOIN kategori ON buku.id_kategori=kategori.id_kategori");?>
		<?php while($pecah = $ambil->fetch_assoc()){ ?>
			<tr>
				<td><?php echo $nomor;?></td>
				<td><?php echo $pecah['kategori'] ?></td>
				<td><?php echo $pecah['judul'] ?></td>
				<td><?php echo $pecah['harga'] ?></td>
				<td><?php echo $pecah['penulis'] ?></td>
				<td><?php echo $pecah['penerbit']?></td>
				<td><?php echo $pecah['stok']; ?></td>
				<td><?php echo $pecah['deskripsi']; ?></td>
				<td>
					<img src="foto_produk/<?php echo $pecah['foto'] ?>" width="100">
				</td>
				<td>
					<center>
						<p>
							<a href="index.php?halaman=hapusproduk&id=<?php echo $pecah['id_buku'];?>" class="btn-danger btn">Hapus</a> &nbsp; <br>
							<a href="index.php?halaman=ubahproduk&id=<?php echo $pecah['id_buku'];?>" class="btn btn-warning">Ubah</a></p>
						</center>
					</td>
				</tr>
				<?php $nomor++; ?>
			<?php } ?>
		</tbody>
	</table>
	<a href="index.php?halaman=tambahproduk" class="btn btn-primary">Tambah Produk</a>

