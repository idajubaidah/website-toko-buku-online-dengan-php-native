<?php
session_start();
//mendapatkan id produk dari url
$id_produk = $_GET['id'];

// jika sudah ada produk di keranjang, maka produk ditambah 1
if (isset($_SESSION ['keranjang'][$id_produk]))
{
	$_SESSION['keranjang'][$id_produk]+=1;
}

// selain itu belum ada di keranjang, maka produk dibeli 1
else
{
	$_SESSION['keranjang'][$id_produk] = 1;
}


//echo "<pre>";
//print_r($_SESSION);
//echo "</pre>";
//larikan kehalaman keranjang
echo "<script>alert('Produk telah masuk ke dalam keranjang belanja');</script>";
echo "<script>location='keranjang.php';</script>";
?>