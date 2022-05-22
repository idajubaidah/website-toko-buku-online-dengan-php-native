<h2>Detail Pembelian</h2>
<?php
$ambil=$koneksi->query("SELECT * FROM pembelian JOIN customer ON pembelian.id_customer=customer.id_customer WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>
<!--<pre><?php print_r($detail); ?></pre>-->


<div class="row">
	<div class="col-md-4">
		<h3>Pembelian</h3>
		<p>
			Tanggal : <?php echo $detail['tanggal'];?><br>
			Total Pembelian : Rp <?php echo number_format($detail['total_pembelian']); ?> <br>
			Status Pesanan : <?php echo $detail['status_pembelian']; ?>
		</p>
	</div>
	<div class="col-md-4">
		<h3>Pelanggan</h3>
		<strong><?php echo $detail['nama'];?></strong> <br>
		<p>
			<?php echo $detail['no_hp'];?> <br>
			<?php echo $detail['email'];?> <br>
		</p>
	</div>
	<div class="col-md-4">
		<h3>Pengiriman</h3>
		<strong><?php echo $detail['nama_kota']; ?></strong> <br>
		<p>
			Ongkos Kirim : Rp <?php echo number_format($detail['tarif']); ?> <br>
			Alamat Pengiriman: <?php echo $detail['alamat']; ?>
		</p>
	</div>
</div>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>NO</th>
			<th>Judul Buku</th>
			<th>Harga</th>
			<th>Jumlah</th>
			<th>Subtotal</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1;?>
		<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk JOIN buku ON pembelian_produk.id_buku=buku.id_buku WHERE pembelian_produk.id_pembelian='$_GET[id]'");?>
		<?php while($pecah=$ambil->fetch_assoc()){?>
		<tr>
			<td><?php echo $nomor;?></td>
			<td><?php echo $pecah['judul'];?></td>
			<td>Rp <?php echo number_format($pecah['harga']);?></td>
			<td><?php echo $pecah['jumlah'];?></td>
			<td>
				Rp <?php echo number_format($pecah['harga']*$pecah['jumlah']);?>
			</td>
		</tr>
		<?php $nomor++; ?>
		<?php }?>
	</tbody>
</table>
