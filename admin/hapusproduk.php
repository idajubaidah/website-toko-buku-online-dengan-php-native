<?php
$ambil=$koneksi->query("SELECT * FROM buku WHERE id_buku='$_GET[id]'");
$pecah=$ambil->fetch_assoc();
$fotoproduk=$pecah['foto'];
if (file_exists("foto_produk/$fotoproduk"))
{
	unlink("foto_produk/$fotoproduk");
}


$koneksi->query("DELETE FROM buku WHERE id_buku='$_GET[id]'");

echo "<script>alert('Produk Terhapus');</script>";
echo "<script>location='index.php?halaman=produk';</script>";

?>