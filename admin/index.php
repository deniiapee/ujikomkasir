<?php
include '../koneksi.php';

session_start();

// Query untuk mengambil total stok barang
$sqlTotalStok = "SELECT SUM(stock) AS total_stok FROM produk";
$resultTotalStok = mysqli_query($koneksi, $sqlTotalStok);

if (!$resultTotalStok) {
    die("Error: " . mysqli_error($koneksi));
}

$rowTotalStok = mysqli_fetch_assoc($resultTotalStok);
$totalStok = $rowTotalStok['total_stok'];

// Query untuk mengambil total penjualan
$sqlTotalPenjualan = "SELECT COUNT(*) AS total_penjualan FROM penjualan";
$resultTotalPenjualan = mysqli_query($koneksi, $sqlTotalPenjualan);

if (!$resultTotalPenjualan) {
    die("Error: " . mysqli_error($koneksi));
}

$rowTotalPenjualan = mysqli_fetch_assoc($resultTotalPenjualan);
$totalPenjualan = $rowTotalPenjualan['total_penjualan'];

// if(!$_SESSION ["id"]){
//     header('location:../login.php');
//  }
$sqlproduk = "SELECT * FROM produk";
$result = mysqli_query($koneksi, $sqlproduk);

$sqlkategori = "SELECT * FROM produk_kategori";
$result1 = mysqli_query($koneksi, $sqlkategori);

$sqlpenjualan = "SELECT * FROM penjualan";
$result2 = mysqli_query($koneksi, $sqlpenjualan);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../SBAdmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Custom styles for this template-->
    <link href="../SBAdmin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fa-solid fa-cash-register"></i>
                </div>
                <div class="sidebar-brand-text mx-3">admin</div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->


            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Data Master</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="toko.php">Toko</a>
                        <a class="collapse-item" href="kategori.php">Kategori</a>
                        <a class="collapse-item" href="list_produk.php">Produk</a>
                        <a class="collapse-item" href="pelanggan.php">Pelanggan</a>
                        <a class="collapse-item" href="supplier.php">Supplier</a>
                        <a class="collapse-item" href="stock.php">stok</a>

                    </div>
                </div>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Transaksi Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fa-solid fa-money-bill"></i>
                    <span>Transaksi</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="pembelian.php">Pembelian</a>
                        <a class="collapse-item" href="tabel_penjualan.php">Tabel penjualan</a>
                        <a class="collapse-item" href="detail_pembelian.php">Detail pembelian</a>

                    </div>
                </div>
            </li>

            </li>

            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="pengguna.php">
                    <i class="fa-regular fa-user"></i>
                    <span>Data User</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../Logout.php">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>log out</span></a>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>



        </ul>

        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->



                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <!-- Dropdown - Alerts -->

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class='mr-2 d-none d-lg-inline text-gray-600 small'>
                                    <i class="fa-solid fa-right-from-bracket"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="Logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <!-- /.container-fluid -->

                    </div>
                    <!-- End of Main Content -->
                </div>
                <!-- End of Content Wrapper -->
                <!-- Books Card Example -->
                <div class="row mx-auto col-lg-auto" style="width:1000px;">

                    <!-- Barang Card Example -->
                    <div class="col-lg-3 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-3">
                                        <a class="text-xs font-weight-bold text-success text-uppercase mb-1" href="list_produk.php">Data Barang</a>

                                        <!-- Replace the content below with relevant book information -->
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Data Barang</div>
                                        <span class="info-box-number"><br><?php echo mysqli_num_rows($result) ?></br></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stok Barang Card Example -->
                    <div class="col-lg-3 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2" style="width:190px;">
                                    <a class="text-xs font-weight-bold text-success text-uppercase mb-1" href="kategori.php">kategori</a>

                                        <!-- Replace the content below with relevant borrowing information -->
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">kategori</div>
                                        <span class="info-box-number"><br><?php echo mysqli_num_rows($result1) ?></br></span>

                                        <div class="number"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2" style="width:190px;">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            stok
                                        </div>
                                        <!-- Replace the content below with relevant borrowing information -->
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Stok Barang</div>
                                        <span class="info-box-number"><br><?php echo $totalStok; ?></br></span>
                                        <div class="number"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Barang Terjual Card Example -->
                    <div class="col-lg-3 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                    <a class="text-xs font-weight-bold text-success text-uppercase mb-1" href="tabel_penjualan.php">Barang terjual</a>

                                        <!-- Replace the content below with relevant user information -->
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Barang Terjual</div>
                                        <span class="info-box-number"><br><?php echo $totalPenjualan; ?></br></span>

                                    </div>
                                    <div class="col-auto">
                                        <!-- Add any additional content (e.g., an icon) here if needed -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- End of Page Wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-primary" href="../login.php">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bootstrap core JavaScript-->
            <script src="../SBAdmin/vendor/jquery/jquery.min.js"></script>
            <script src="../SBAdmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="../SBAdmin/vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="../SBAdmin/js/sb-admin-2.min.js"></script>

            <!-- Page level plugins -->
            <script src="../SBAdmin/vendor/chart.js/Chart.min.js"></script>

            <!-- Page level custom scripts -->
            <script src="../SBAdmin/js/demo/chart-area-demo.js"></script>
            <script src="../SBAdmin/js/demo/chart-pie-demo.js"></script>

</body>

</html>
