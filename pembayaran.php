<?php
session_start();
//koneksi ke databse
include 'koneksi.php';

if (!isset($_SESSION['customer']))
{
    echo "<script>alert('Anda harus login');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}

//mendapatkan id pembelian dari url
$id_pembelian = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$id_pembelian'");
$detail_pembelian = $ambil->fetch_assoc();

//mendapatkan di customer yang beli
$id_customer_beli = $detail_pembelian['id_customer'];

//mendapatkan id customer yang login
$id_customer_login = $_SESSION['customer']['id_customer'];

if ($id_customer_login !== $id_customer_beli) {
	echo "<script>alert('Anda harus login');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/50a6b5ed9d.js" crossorigin="anonymous"></script>

    <title>Pembayaran</title>
</head>
<body>
<?php include 'menu.php'; ?>
<div class="container mt-5 p-5">
	<h2>Konfirmasi Pembayaran</h2>
	<p>Kirim bukti pembayaran Anda disini</p>
	<div class="alert alert-info">Total tagihan Anda sebesar <strong>Rp <?php echo number_format($detail_pembelian['total_pembelian']);?></strong></div>

	<form method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label>Nama</label>
			<input type="text" name="nama" class="form-control">
		</div>
		<div class="form-group">
			<label>Bank</label>
			<input type="text" name="bank" class="form-control">
		</div>
		<div class="form-group">
			<label>Jumlah</label>
			<input type="number" name="jumlah" class="form-control" min="1">
		</div>
		<div class="form-group">
			<label>Bukti Transfer</label>
			<input type="file" name="bukti" class="form-control">
			<p class="text-danger">Foto bukti transfer harus JPG maksimal 2MB</p>
		</div>
		<button class="btn btn-primary" name="kirim">Kirim</button>
	</form>
</div>

<?php 
//jika ada tombol kirim
if (isset($_POST['kirim'])) {
	$namabukti = $_FILES['bukti']['name'];
	$lokasibukti = $_FILES['bukti']['tmp_name'];
	$namabukti_tgl = date("YmdHis").$namabukti;
	move_uploaded_file($lokasibukti, "bukti_pembayaran/$namabukti_tgl");
	$nama = $_POST['nama'];
	$bank = $_POST['bank'];
	$jumlah = $_POST['jumlah'];
	$tanggal = date("Y-m-d");

	$koneksi->query("INSERT INTO pembayaran(id_pembelian, nama, bank, jumlah, tanggal, bukti) VALUES ('$id_pembelian','$nama', '$bank','$jumlah','$tanggal','$namabukti_tgl')");
	//update status pembayaran
	$koneksi->query("UPDATE pembelian SET status_pembelian='sudah kirim pembayaran' WHERE id_pembelian='$id_pembelian'");
	echo "<script>alert('Terimakasih sudah mengirimkan bukti pembayaran');</script>";
	echo "<script>location='riwayat.php'</script>";
}
?>

<?php include 'footer.php'; ?>
</body>
</html>