<?php
session_start();
//koneksi ke databse
include 'koneksi.php';

if (!isset($_SESSION['customer']))
{
    echo "<script>alert('Anda harus login');</script>";
    echo "<script>location='login.php';</script>";
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

    <title>Riwayat Pembelian</title>
</head>
<body>
<?php include 'menu.php'; ?>
<!--<pre><?php print_r($_SESSION)?></pre>-->
<section class="riwayat">
    <div class="container mt-5 p-5">
        <h3>Riwayat Pembelian <?php echo $_SESSION['customer']['nama']; ?></h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $nomor=1;
                //mendapatkan id customer yang login
                $id_customer = $_SESSION['customer']['id_customer'];
                $ambil=$koneksi->query("SELECT * FROM pembelian WHERE id_customer='$id_customer'");
                while ($pecah = $ambil->fetch_assoc()) {?>
                <tr>
                    <td><?php echo $nomor;?></td>
                    <td><?php echo $pecah['tanggal'];?></td>
                    <td><?php echo $pecah['status_pembelian'];?>
                        <br>
                        <?php if (!empty($pecah['no_resi'])): ?>
                        No. Resi : <?php echo $pecah['no_resi']; ?>
                    <?php endif ?>
                    </td>
                    <td>Rp <?php echo number_format($pecah['total_pembelian']);?></td>
                    <td>
                        <a href="nota.php?id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-info">Nota</a>

                        <?php if ($pecah['status_pembelian']=="pending"): ?>
                        <a href="pembayaran.php?id=<?php echo $pecah['id_pembelian'];?>" class="btn btn-success"> Input Pembayaran</a>
                        <?php else: ?>
                        <a href="lihat_pembayaran.php?id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-warning">Lihat Pembayaran</a>
                    <?php endif ?>
                    </td>
                </tr>
                <?php $nomor++; ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>

<?php include 'footer.php'; ?>

</body>
</html>