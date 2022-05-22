<h2>Ubah Produk</h2>
<?php
$ambil=$koneksi->query("SELECT * FROM buku WHERE id_buku='$_GET[id]'");
$pecah=$ambil->fetch_assoc();

//echo "<pre>";
//print_r($pecah);
//echo "</pre>";
?>

<?php
$datakategori=array();

$ambildata=$koneksi->query("SELECT * FROM kategori");
while($tiap=$ambildata->fetch_assoc()) {
	$datakategori[]=$tiap;
}

//echo "<pre>";
//print_r($datakategori);
//echo "</pre>";
?>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Kategori</label>
		<select class="form-control" name="id_kategori">
			<option value="">Pilih Kategori</option>
			<?php foreach ($datakategori as $key => $value): ?>
			<option value="<?php echo $value['id_kategori'] ?>" <?php if($pecah['id_kategori']==$value['id_kategori']){echo "selected";} ?> >
			 <?php echo $value['kategori'] ?>
			 	
			</option>
		<?php endforeach ?>
		</select>
	</div>
	<div class="form-group">
		<label>Nama Produk</label>
		<input type="text" name="judul" class="form-control" value="<?php echo $pecah['judul'];?>">
	</div>
	<div class="form-group">
		<label>Penerbit</label>
		<input type="text" name="penerbit" class="form-control" value="<?php echo $pecah['penerbit'];?>">
	</div>
	<div class="form-group">
		<label>Penulis</label>
		<input type="text" name="penulis" class="form-control" value="<?php echo $pecah['penulis'];?>">
	</div>
	<div class="form-group">
		<label>Harga Produk</label>
		<input type="number" class = "form-control" name="harga" value="<?php echo $pecah['harga'];?>">		
	</div>
	<div class="form-group">
		<label>Stok</label>
		<input type="number" class = "form-control" name="stok" value="<?php echo $pecah['stok'];?>">		
	</div>
	<div class="form-group">
		<label>Deskripsi</label>
		<input type="text" class = "form-control" name="deskripsi" value="<?php echo $pecah['deskripsi'];?>">		
	</div>
	<div class="form-group">
		<img src="foto_produk/<?php echo $pecah['foto']?>" width="100">
	</div>
	<div class="form-group">
		<label>Ubah Foto</label>
		<input type="file" name="foto" class="form-control">
	</div>
	<button class="btn btn-primary" name="ubah"><i class="glyphicon glyphicon-saved"></i> Ubah</a> </button>
</form>

<?php
if (isset($_POST['ubah'])) 
{
	$namafoto=$_FILES['foto']['name'];
	$lokasifoto=$_FILES['foto']['tmp_name'];
	//jika foto diubah
	if (!empty($lokasifoto))
	{
		move_uploaded_file($lokasifoto,"foto_produk/$namafoto");

		$koneksi->query("UPDATE buku SET judul='$_POST[judul]',penerbit='$_POST[penerbit]',penulis='$_POST[penulis]',harga='$_POST[harga]',foto='$namafoto',stok='$_POST[stok]',deskripsi='$_POST[deskripsi]',id_kategori=$_POST[id_kategori] 
			WHERE id_buku='$_GET[id]'");
	}
	else
	{
		$koneksi->query("UPDATE buku SET judul='$_POST[judul]',penerbit='$_POST[penerbit]',penulis='$_POST[penulis]',harga='$_POST[harga]',stok='$_POST[stok]',deskripsi='$_POST[deskripsi]',id_kategori=$_POST[id_kategori] WHERE id_buku='$_GET[id]'");
	}	
	echo "<script>alert('Data telah diubah');</script>";
	echo "<script>location='index.php?halaman=produk';</script>";
}