<?php 
$datakategori=array();

$ambil=$koneksi->query("SELECT * FROM kategori");
while($tiap=$ambil->fetch_assoc()) {
	$datakategori[]=$tiap;
}

//echo"<pre>";
//print_r($datakategori);
//echo "</pre>";
?>

<h2>Tambah Produk</h2>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Kategori</label>
		<select class="form-control" name="id_kategori">
			<option value="">Pilih Kategori</option>
			<?php foreach ($datakategori as $key => $value): ?>
			<option value="<?php echo $value['id_kategori'] ?>"><?php echo $value['kategori']; ?></option>
		<?php endforeach ?>
		</select>
	</div>
	<div class="form-group">
		<label>Judul</label>
		<input type="text" class="form-control" name="judul">
	</div>
	<div class="form-group">
		<label>Harga (Rp)</label>
		<input type="number" class="form-control"name="harga">
	</div>
	<div class="form-group">
		<label>Penulis</label>
		<input type="text" class="form-control" name="penulis">
	</div>
	<div class="form-group">
		<label>Penerbit</label>
		<input type="text" class="form-control" name="penerbit">
	</div>
	<div class="form-group">
		<label>Stok</label>
		<input type="number" class="form-control" name="stok">
	</div>
	<div class="form-group">
		<label>Deskripsi</label>
		<input type="text" class="form-control" name="deskripsi">
	</div>
	<div class="form-group">
		<label>Foto</label>
		<input type="file" class="form-control" name="foto">
	</div>
	<button class="btn btn-primary" name="save">Simpan</button>
</form>
<?php
if (isset($_POST['save']))
{
	$nama=$_FILES['foto']['name'];
	$lokasi=$_FILES['foto']['tmp_name'];
	$nama_folder="foto_produk/";
	move_uploaded_file($lokasi, $nama_folder.$nama);
	$koneksi->query("INSERT INTO buku (judul, penerbit, penulis, harga, stok, foto, id_kategori, deskripsi)
		VALUES('$_POST[judul]','$_POST[penerbit]','$_POST[penulis]','$_POST[harga]','$_POST[stok]','$nama','$_POST[id_kategori]','$_POST[deskripsi]')");
	echo "<div class='alert alert-info'>Data Tersimpan</div>";
	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";

}
?>
