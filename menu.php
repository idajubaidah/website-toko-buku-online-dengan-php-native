<nav class="navbar navbar-expand-lg navbar-light bg-warning fixed-top">
    <div class="container">
      <h3><a class="fas fa-cart-plus text-success mr-2"></a></h3>
      <a class="navbar-brand font-wight-bold" href="index.php">Alphabet Store</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto mr-4">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="keranjang.php">Keranjang <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="checkout.php">Checkout <span class="sr-only">(current)</span></a>
            </li>
            <!--jika sudah login, maka akan tampil menu logout-->
            <?php if (isset($_SESSION['customer'])) : ?>
                <li class="nav-item active">
                    <a class="nav-link" href="riwayat.php">Riwayat Pembelian <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="logout.php">Logout <span class="sr-only">(current)</span></a>
                </li>
                <!--jika belum login, akan tampil menu login-->
                <?php else: ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="login.php">Login <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="registeration.php">Daftar <span class="sr-only">(current)</span></a>
                    </li>
                <?php endif ?>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="pencarian.php" method="get">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="keyword">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
          <div class="icon mt-2">
            <h5><a class="fas fa-cart-plus ml-3 mr-3 text-dark" href="keranjang.php"></a>
                <a class="fas fa-history mr-3 text-dark" href="riwayat.php"></a>
                <a class="fas fa-sign-out-alt mr-3 text-dark" href="logout.php"></a></h5>

            </div>
        </div>
    </div>
</nav>