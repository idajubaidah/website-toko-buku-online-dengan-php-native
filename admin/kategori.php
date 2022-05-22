<h3>Data Kategori</h3>
<hr>
<?php
$semuadata=array();
$ambil=$koneksi->query("SELECT * FROM kategori");
while($pecah=$ambil->fetch_assoc())
{
	$semuadata[]=$pecah;
}

//echo"<pre>";
//print_r($semuadata);
//echo "</pre>";
?>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Kategori</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($semuadata as $key => $value) : ?>
		<tr>
			<th><?php echo $key+1; ?></th>
			<th><?php echo $value['kategori']; ?></th>
			<th>
				<a href="index.php?halaman=hapuskategori&id=<?php echo $value['id_kategori'];?>" class="btn btn-danger btn-sm">Hapus</a>
			</th>
		</tr>
	<?php endforeach ?>
	</tbody>
</table>

<a href="index.php?halaman=tambahkategori" class="btn btn-default">Tambah Data</a>