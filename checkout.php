<?php
session_start();
include 'koneksi.php';

//jk tidak ada session customer, maka dilarikan ke login php
if (!isset($_SESSION['customer']))
{
    echo "<script>alert('Silahkan Login');</script>";
    echo "<script>location='login.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/50a6b5ed9d.js" crossorigin="anonymous"></script>
	<title>Checkout</title>
</head>
<body>
<?php include 'menu.php'; ?>
<section class="konten">
    <div class="container mt-5 p-5">
        <h1>Checkout</h1>
        <hr>
        <table class="table table-bordered mt-5">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subharga</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor=1; ?>
                <?php $totalbelanja = 0; ?>
                <?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah): ?>
                <!--menampilkan produk yang diperulang berdasarkan id produk-->
                <?php
                $ambil = $koneksi->query("SELECT * FROM buku WHERE id_buku='$id_produk'");
                $pecah = $ambil->fetch_assoc();
                $subharga=$pecah['harga']*$jumlah;
                ?>
                <tr>
                    <td><?php echo $nomor;?></td>
                    <td><?php echo $pecah['judul'];?></td>
                    <td><?php echo $pecah['penulis'];?></td>
                    <td>Rp <?php echo number_format($pecah['harga']);?></td>
                    <td><?php echo $jumlah;?></td>
                    <td>Rp <?php echo number_format($subharga);?></td>
                </tr>
                <?php $nomor++;?>
                <?php $totalbelanja+=$subharga;?>
                <?php endforeach ?>
            </tbody>
            <tfoot>
                <th colspan="5">Total Belanja</th>
                <th>Rp <?php echo number_format($totalbelanja) ?></th>
            </tfoot>
        </table>

        <form method="post">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" readonly value="<?php echo $_SESSION['customer']['nama']?>" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" readonly value="<?php echo $_SESSION['customer']['no_hp']?>" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <select class="form-control" name="id_ongkir">
                        <option value="">Pilih Ongkos Kirim</option>
                        <?php
                        $ambil = $koneksi->query("SELECT * FROM ongkir");
                        while ($perongkir = $ambil->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $perongkir['id_ongkir'] ?>">
                            <?php echo $perongkir['nama_kota'] ?> -
                            Rp <?php echo number_format($perongkir['tarif']) ?>
                        </option>
                    <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label>Alamat Lengkap Pengiriman</label>
                <textarea class="form-control" name="alamat_pengiriman" placeholder="masukan alamat lengkap pengiriman (termasuk kode pos)"></textarea>
            </div>
            <button class="btn btn-primary" name="checkout">Checkout</button>
        </form>
        <?php
        if (isset($_POST['checkout']))
        {
            $id_customer = $_SESSION['customer']['id_customer'];
            $id_ongkir = $_POST['id_ongkir'];
            $tanggal_pembelian = date("Y-m-d");
            $alamat=$_POST['alamat_pengiriman'];

            $ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
            $arrayongkir = $ambil->fetch_assoc();
            $namakota = $arrayongkir['nama_kota'];
            $tarif = $arrayongkir['tarif'];

            $totalpembelian = $totalbelanja + $tarif;

            //simpan data ke tabel pembelian
            $koneksi->query("INSERT INTO pembelian (id_customer, id_ongkir, tanggal, total_pembelian, nama_kota, tarif, alamat_pengiriman) VALUES ('$id_customer','$id_ongkir','$tanggal_pembelian','$totalpembelian','$namakota','$tarif','$alamat')");

            //mendapatkan id pembelian yang baru terjadi
            $id_pembelian_baru = $koneksi->insert_id;

            foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) 
            {

                //mendapatkan data produk berdasarkan id produk
                $ambil=$koneksi->query("SELECT * FROM buku WHERE id_buku='$id_produk'");
                $perproduk = $ambil->fetch_assoc();

                $judul = $perproduk['judul'];
                $harga = $perproduk['harga'];
                $penulis = $perproduk['penulis'];

                $subharga = $perproduk['harga']*$jumlah;
                $koneksi->query("INSERT INTO pembelian_produk(id_pembelian, id_buku, judul, harga, penulis, subharga, jumlah) VALUES ('$id_pembelian_baru','$id_produk','$judul','$harga','$penulis','$subharga','$jumlah')");

                //skrip update stok
                $koneksi->query("UPDATE buku SET stok =stok -$jumlah WHERE id_buku='$id_produk'");
            }

            //mengkosongkan keranjang belanja

            unset($_SESSION['keranjang']);

            //tampilan dialihkan ke halaman nota pembelian yang terjadi
            echo "<script>alert('pembelian sukses');</script>";
            echo "<script>location='nota.php?id=$id_pembelian_baru';</script>";
        }
        ?>
    </div>
</section>

<!--<pre><?php print_r($_SESSION['customer']) ?></pre>
<pre><?php print_r($_SESSION['keranjang']) ?></pre> -->

<?php include 'footer.php' ?>
</body>
</html>