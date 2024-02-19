<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $no_faktur = $_POST["no_faktur"];
    $tanggal_pembelian = $_POST["tanggal_pembelian"];
    $total = $_POST["total"];

    $sql = "INSERT INTO pembelian (no_faktur, tanggal_pembelian, total) 
            VALUES ('$no_faktur', '$tanggal_pembelian', '$total')";

    if (mysqli_query($koneksi, $sql)) {
        echo "Pembelian berhasil disimpan.";
        header("Location: pembelian_detail.php"); 
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
} else {
    echo "Metode request tidak valid.";
}
?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>pembelian</title>

    <!-- Custom fonts for this template-->
    <link href="SBAdmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Custom styles for this template-->
    <link href="SBAdmin/css/sb-admin-2.min.css" rel="stylesheet">
    
    <style>
        .table thead th{
            border-bottom:0px;
        }
        th{
            border:2px solid #eeeeee;
            background-color: white;
            color: black;
        }
        tr, td{
            border:2px solid #eeeeee;
            color: #000000;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="SBAdmin/index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fa-solid fa-cash-register"></i>
                </div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="SBAdmin/index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
                    aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Data Master</span>
                </a>
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Data Master:</h6>
                        <a class="collapse-item active" href="toko.php">Toko</a>
                        <a class="collapse-item" href="kategori.php">Kategori</a>
                        <a class="collapse-item" href="list_produk.php">Produk</a>
                        <a class="collapse-item" href="pengguna.php">Pengguna</a>
                        <a class="collapse-item" href="pelanggan.php">Pelanggan</a>
                        <a class="collapse-item" href="supplier.php">Supplier</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Transaksi</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Transaksi</h6>
                        <a class="collapse-item" href="penjualan.php">penjualan</a>
                        <a class="collapse-item" href="pembelian.php">pembelian</a>
                        <a class="collapse-item" href="detail_penjualan.php">detail penjualan</a>
                        <a class="collapse-item" href="detail_pembelian.php">detail pembelian</a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>data user</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                <i class="fa-solid fa-right-from-bracket"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div class="container-fluid">
                    <h2>Form Pembelian</h2>
                    <form action="proses_pembelian.php" method="post">
                        <label for="no_faktur">Nomor Faktur:</label>
                        <input type="text" id="no_faktur" name="no_faktur" required><br><br>
                        <label for="tanggal_pembelian">Tanggal Pembelian:</label>
                        <input type="date" id="tanggal_pembelian" name="tanggal_pembelian" required><br><br>
                        <label for="total">Total:</label>
                        <input type="number" id="total" name="total" required><br><br>
                        <table id="detail_pembelian">
                            <tr>
                                <th>Produk</th>
                                <th>Qty</th>
                                <th>Harga Beli</th>
                            </tr>
                            <tr>
                                <td><input type="text" name="produk[]" required></td>
                                <td><input type="number" name="qty[]" required></td>
                                <td><input type="number" name="harga_beli[]" required></td>
                            </tr>
                        </table><br>
                        <button type="button" onclick="tambahBaris()">Tambah Produk</button><br><br>
                        <input type="submit" value="Simpan">
                    </form>
                    <script>
                        function tambahBaris() {
                            var table = document.getElementById("detail_pembelian");
                            var row = table.insertRow();
                            row.innerHTML = '<td><input type="text" name="produk[]" required></td>' +
                                            '<td><input type="number" name="qty[]" required></td>' +
                                            '<td><input type="number" name="harga_beli[]" required></td>';
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">saya akan log out</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <script src="SBAdmin/vendor/jquery/jquery.min.js"></script>
    <script src="SBAdmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="SBAdmin/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="SBAdmin/js/sb-admin-2.min.js"></script>
</body>

</html>
