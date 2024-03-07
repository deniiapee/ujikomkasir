<?php
include '../koneksi.php';
$sql = "SELECT * FROM toko";
$result = mysqli_query($koneksi, $sql);
$sql = "SELECT * FROM user";
$result1 = mysqli_query($koneksi, $sql);
$sql = "SELECT * FROM pelanggan";
$result2 = mysqli_query($koneksi, $sql);
$sql = "SELECT * FROM produk";
$result3 = mysqli_query($koneksi, $sql);
$tanggal_awal = '';
$tanggal_akhir = '';

// Cek apakah form filter tanggal telah disubmit
if (isset($_POST['submit'])) {
    // Ambil nilai tanggal awal dan tanggal akhir dari form
    $tanggal_awal = $_POST['tanggal_awal'];
    $tanggal_akhir = $_POST['tanggal_akhir'];

    // Modifikasi format tanggal agar sesuai dengan format di dalam database (YYYY-MM-DD)
    $tanggal_awal = date('Y-m-d', strtotime($tanggal_awal));
    $tanggal_akhir = date('Y-m-d', strtotime($tanggal_akhir));

   
}
?>
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
                    <div class="sidebar-brand-text mx-3">kasir</div>
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
                        <a class="collapse-item" href="stock.php">stock</a>

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




<?php
// Query untuk mengambil data penjualan_detail beserta informasi harga beli dari tabel produk
$sql = "SELECT * FROM penjualan 
    INNER JOIN toko ON toko.toko_id = penjualan.toko_id
    INNER JOIN pelanggan ON penjualan.pelanggan_id = pelanggan.pelanggan_id";
$result = mysqli_query($koneksi, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>KASIR</title>

    <!-- Custom fonts for this template-->
    <link href="../sbadmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../sbadmin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">
                <form method="filter_penjualan.php" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <label for="tanggal_awal">Tanggal Awal</label>
                    <input type="date" name="tanggal-awal" id="tanggal-awal" class="form-control" value="<?php echo $tanggal_awal; ?>">
                </div>
                <div class="col-md-4">
                    <label for="tanggal_akhir">Tanggal Akhir</label>
                    <input type="date" name="tanggal-akhir" id="tanggal-akhir" class="form-control" value="<?php echo $tanggal_akhir; ?>">
                </div>
                <div class="col-md-4">
                    <button onclick="filterTanggal()"class="btn btn-primary mt-4">Filter</button>
                </div>
            </div>
        </form>

                    <!-- Page Heading -->
                    <h2 class="text-center mb-5" style="font-weight: bold;">Penjualan</h2>
                   <!-- Tabel rekap penjualan -->
        <div class="table-responsive">
            <table class="table table-bordered" id = "bookTable">
                <thead>
                    <tr>
                        <th>Toko</th>
                        <th>Nama Pelanggan</th>
                        <th>Total</th>
                        <th>Bayar</th>
                        <th>Sisa</th>
                        <th>Keterangan</th>
                        <th>Tanggal Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
 <tbody>
                            <?php
                    // Cek apakah query berhasil dieksekusi dan mengembalikan data
                    if (isset($result) && mysqli_num_rows($result) > 0) {
                        // Output data dari setiap baris
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row["nama_toko"] . "</td>"; // Output nama toko
                            echo "<td>" . $row["nama_pelanggan"] . "</td>"; // Output nama pelanggan
                            echo "<td>" . $row["total"] . "</td>";
                            echo "<td>" . $row["bayar"] . "</td>"; 
                            echo "<td>" . $row["sisa"] . "</td>";
                            echo "<td>" . $row["keterangan"] . "</td>"; // Output keterangan penjualan
                            echo "<td>" . $row["created_at"] . "</td>"; // Output tanggal dibuat
                            echo "<td style='text-align: center;'>" . "<a href='detail_penjualan.php?id=". $row["penjualan_id"] ."' class='btn btn-primary'>Detail Penjualan</a>
                                  <a class='btn btn-danger' href='delete_penjualan.php?id=". $row['penjualan_id'] ."'>Hapus</a>
                                  </td>"; // Output aksi (link detail dan hapus)
                            echo "</tr>";
                        }
                    } else {
                        // Tampilkan pesan jika tidak ada data yang ditemukan
                        echo "<tr><td colspan='8'>Tidak ada data</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
                    </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../sbadmin/vendor/jquery/jquery.min.js"></script>
    <script src="../sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../sbadmin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../sbadmin/js/sb-admin-2.min.js"></script>

</body>

</html>

<?php
// Tutup koneksi database
$koneksi->close();
?>

    <!-- Include Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>

 <!-- Bootstrap JS (optional, jika diperlukan) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Begin Page Content -->

<script>
  document.getElementById('bayar').addEventListener('click', function() {
    var produk = document.getElementById('produk').value;
    var jumlah = document.getElementById('jumlah').value;
    var table = document.getElementById('transaksi');
    var newRow = table.insertRow();
    var cell1 = newRow.insertCell(0);
    var cell2 = newRow.insertCell(1);
    var cell3 = newRow.insertCell(2);
    var cell4 = newRow.insertCell(3);
    cell1.innerHTML = produk;
    cell2.innerHTML = ''; // Tambahkan nama produk
    cell3.innerHTML = ''; // Tambahkan harga produk
    cell4.innerHTML = jumlah;
  });
</script>
</body>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Anda Yakin Ingin Keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Jika logout anda harus login kembali!</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../sbadmin/vendor/jquery/jquery.min.js"></script>
    <script src="../sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../sbadmin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../sbadmin/js/sb-admin-2.min.js"></script> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mendapatkan elemen select
        var select = document.getElementById('produk_id');

        // Mendapatkan elemen input total
        var totalInput = document.getElementById('total');

        // Menambahkan event listener untuk perubahan pada elemen select
        select.addEventListener('change', function() {
            // Mendapatkan harga dari opsi yang dipilih
            var harga = parseFloat(select.options[select.selectedIndex].getAttribute('data-harga'));
            
            // Memperbarui nilai input total dengan harga yang dipilih
            totalInput.value = harga;
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var totalInput = document.getElementById('total');
        var bayarInput = document.getElementById('bayar');
        var sisaInput = document.getElementById('sisa');

        totalInput.addEventListener('input', function() {
            calculateSisa();
        });

        bayarInput.addEventListener('input', function() {
            calculateSisa();
        });

        function calculateSisa() {
            var total = parseFloat(totalInput.value);
            var bayar = parseFloat(bayarInput.value);
            
            // Pastikan kedua nilai adalah angka dan bayar lebih besar dari total
            if (!isNaN(total) && !isNaN(bayar) && bayar > total) {
                var sisa = bayar - total;
                sisaInput.value = sisa;
            } else {
                sisaInput.value = '';
            }
        }
    });
</script>
<script>
        function filterTanggal() {
            var start = document.getElementById("tanggal-awal").value;
            var end = document.getElementById("tanggal-akhir").value;
            var table = document.getElementById("bookTable");
            var rows = table.getElementsByTagName("tr");
            
            for (var i = 1; i < rows.length; i++) {
                var row = rows[i];
                var borrowCell = row.getElementsByTagName("td")[6]; // Mengubah index menjadi 1 karena kita ingin memeriksa tanggal pinjam
                var borrowDate = new Date(borrowCell.textContent);
                var rowVisible = true;
                
                if (start) {
                    if (borrowDate < new Date(start)) {
                        rowVisible = false;
                    }
                }
                
                if (end) {
                    if (borrowDate > new Date(end)) {
                        rowVisible = false;
                    }
                }
                
                // Menambahkan kondisi untuk memeriksa apakah tanggal pinjam sama dengan tanggal awal atau akhir
                if (borrowDate.toDateString() === new Date(start).toDateString() || borrowDate.toDateString() === new Date(end).toDateString()) {
                    rowVisible = true;
                }
                
                if (rowVisible) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            }
        }
    </script>



</body>

</html>