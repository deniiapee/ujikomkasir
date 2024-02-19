<?php
include 'koneksi.php';

session_start();
$sql = "SELECT pelanggan.*, toko.nama_toko  FROM pelanggan INNER JOIN toko ON pelanggan.toko_id=toko.toko_id;";
$result = mysqli_query($koneksi, $sql);
$sql = "SELECT *
FROM penjualan.penjualan AS p
JOIN penjualan_detail.penjualan_detail AS pd ON p.penjualan_id = pd.penjualan_id
WHERE p.penjualan_id = 1";



$query1 = "SELECT * FROM user WHERE role='kasir'";
$view1 = mysqli_query($koneksi, $query1);

$query2 = "SELECT * FROM pelanggan";
$view2 = mysqli_query($koneksi, $query2);

$query3 = "SELECT * FROM produk";
$view3 = mysqli_query($koneksi, $query3);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Memperbaiki error Undefined index: harga_beli
    $harga_beli = isset($_POST["harga_beli"]) ? $_POST["harga_beli"] : null;

    try {
        // Replace the following lines with your actual database insertion logic
        $pdo = new PDO("mysql:host=localhost;dbname=kasir", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Begin a transaction
        $pdo->beginTransaction();

        // Definisi variabel yang diperlukan
        $toko_id = $_POST['toko_id'] ?? null;
        $user_id = $_POST['user_id'] ?? null;
        $tanggal_penjualan = date('Y-m-d'); // Tanggal penjualan diambil dari waktu saat ini
        $pelanggan_id = $_POST['pelanggan_id'] ?? null;
        $total = $_POST['total'] ?? null;
        $bayar = $_POST['bayar'] ?? null;
        $sisa = $_POST['sisa'] ?? null;
        $keterangan = $_POST['keterangan'] ?? null;
        $create = date('Y-m-d H:i:s'); // Waktu saat ini

        // Insert into penjualan table
        $sql = "INSERT INTO penjualan (toko_id, user_id, tanggal_penjualan, pelanggan_id, total, bayar, sisa, keterangan, created_at)
                VALUES (:toko_id, :user_id, :tanggal_penjualan, :pelanggan_id, :total, :bayar, :sisa, :keterangan, :created_at)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':toko_id' => $toko_id,
            ':user_id' => $user_id,
            ':tanggal_penjualan' => $tanggal_penjualan,
            ':pelanggan_id' => $pelanggan_id,
            ':total' => $total,
            ':bayar' => $bayar,
            ':sisa' => $sisa,
            ':keterangan' => $keterangan,
            ':created_at' => $create
        ));

        // Get the penjualan_id of the inserted row
        $penjualan_id = $pdo->lastInsertId();

        // Insert into penjualan_detail table
        $produk_id = $_POST["produk_id"] ?? null;
        $qty = 1; // For now, let's assume the quantity is 1

        // Menangani Undefined index: harga_beli
        if (!is_null($harga_beli)) {
            $sql = "INSERT INTO penjualan_detail (penjualan_id, produk_id, qty, harga_beli, harga_jual, created_at)
            VALUES (:penjualan_id, :produk_id, :qty, :harga_beli, :harga_jual, :created_at)";
    
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':penjualan_detail_id' => $penjualan_detail_id,
                ':penjualan_id' => $penjualan_id,
                ':produk_id' => $produk_id,
                ':qty' => $qty,
                ':harga_beli' => $harga_beli,
                ':harga_jual' => $total, // Assuming the total is the selling price
                ':created_at' => $create
            ));
        } else {
            echo "Harga beli tidak tersedia.";
        }

        // Commit the transaction
        $pdo->commit();

        // Redirect to detail_penjualan.php with penjualan_id as parameter
        header("Location: detail_penjualan.php?penjualan_id=$penjualan_id");
        exit();
    } catch (PDOException $e) {
        // Rollback the transaction if an error occurred
        $pdo->rollback();
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pelanggan</title>

    <!-- Custom fonts for this template-->
    <link href="SBAdmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
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
            color: black;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
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
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Data Master:</h6>
                        <a class="collapse-item " href="toko.php">Toko</a>
                        <a class="collapse-item " href="kategori.php">Kategori</a>
                        <a class="collapse-item " href="list_produk.php">Produk</a>
                        <a class="collapse-item " href="pengguna.php">Pengguna</a>
                        <a class="collapse-item active" href="pelanggan.php">Pelanggan</a>
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
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
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

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
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
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                            alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                            alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php if(isset($_SESSION['username'])){
                                        echo $_SESSION['username'];
                                        }?>
                                </span>
                                <i class="fa-solid fa-right-from-bracket"></i>
                            </a>
                            <!-- Dropdown - User Information -->
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
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

            <!-- Page Heading -->
            <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            margin-bottom: 10px;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        textarea,
        button {
            margin-bottom: 10px;
            padding: 5px;
            width: 300px;
        }

        button {
            width: auto;
            padding: 8px 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>


<body>
<div class="container text">
        <h2 class="text-center">Form Transaksi Penjualan</h2>
        <form action="" method="POST">
            <div class="row">
                <div class="offset-md-3 col-md-6 mb-3">
                    <div class="form-group">
                        <label for="toko">Toko:</label>
                        <select class="form-control" id="toko_id" name="toko_id">
                        <option value="" disabled selected>toko...</option>
                            <?php 
                                if($result){
                                    while($row = mysqli_fetch_assoc($result)){
                                        $nama_toko = $row['nama_toko'];
                                        $id = $row['toko_id'];
                                        echo "<option value='$id' >$nama_toko</option>";
                                    }
                                } else {
                                    echo "<option value=''>Gagal mengambil data</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="offset-md-3 col-md-6 mb-3">
                    <div class="form-group">
                        <label for="user">user:</label>
                        <select class="form-control" id="user_id" name="user_id">
                        <option value="" disabled selected>user...</option>
                            <?php 
                                if($view1){
                                    while($row = mysqli_fetch_assoc($view1)){
                                        $username = $row['username'];
                                        $id = $row['user_id'];
                                        echo "<option value='$id'>$username</option>";
                                    }
                                } else {
                                    echo "<option value=''>Gagal mengambil data</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="offset-md-3 col-md-6 mb-3">
                    <div class="form-group">
                        <label for="pelanggan">pelanggan:</label>
                        <select class="form-control" id="pelanggan_id" name="pelanggan_id">
                        <option value="" disabled selected>Pilih Pelanggan...</option>
                            <?php 
                                if($view2){
                                    while($row = mysqli_fetch_assoc($view2)){
                                        $nama_pelanggan = $row['nama_pelanggan'];
                                        $id = $row['pelanggan_id'];
                                        echo "<option value='$id'>$nama_pelanggan</option>";
                                    }
                                } else {
                                    echo "<option value=''>Gagal mengambil data</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="offset-md-3 col-md-6 mb-3">
                <div class="form-group">
                    <label for="searchBarang">BARANG</label>
                    <input type="text" class="form-control" id="searchBarang" placeholder="Cari barang...">
                </div>

                <div class="form-group" id="daftarBarang">
                    <?php 
                        if($view3){
                            while($row = mysqli_fetch_assoc($view3)){
                                $nama_produk = $row['nama_produk'];
                                $id = $row['produk_id'];
                                $harga = $row['harga_jual'];
                    ?>
                                <div class='form-check barang' data-nama='<?php echo $nama_produk; ?>' style="display: none;">
                                    <input class='form-check-input' type='checkbox' name='produk_id[]' value='<?php echo $id; ?>' data-harga='<?php echo $harga; ?>' id='produk_<?php echo $id; ?>'>
                                    <label class='form-check-label' for='produk_<?php echo $id; ?>'><?php echo $nama_produk; ?></label>
                                    <div class='form-group'>
                                        <label for='jumlah_<?php echo $id; ?>'>JUMLAH</label>
                                        <input type='number' class='form-control' name='jumlah_<?php echo $id; ?>' id='jumlah_<?php echo $id; ?>' value='1' min='1'>
                                    </div>
                                </div>
                    <?php
                            }
                        } else {
                            echo "<p>Gagal mengambil data</p>";
                        }
                    ?>
                </div>
                </div>
                <div class="offset-md-3 col-md-6 mb-3">
                    <label for="tanggal_penjualan" class="form-label">tanggal_penjualan:</label>
                    <input type="date" class="form-control" id="tanggal_penjualan" name="tanggal_penjualan">
                </div>
                <div class="offset-md-3 col-md-6 mb-3">
                    <label for="bayar" class="form-label">total:</label>
                    <input type="text" class="form-control" id="total" name="total">
                </div>
                <div class="offset-md-3 col-md-6 mb-3">
                    <label for="bayar" class="form-label">Bayar:</label>
                    <input type="text" class="form-control" id="bayar" name="bayar">
                </div>
                <div class="offset-md-3 col-md-6 mb-3">
                    <label for="sisa" class="form-label">Sisa:</label>
                    <input type="text" class="form-control" id="sisa" name="sisa">
                </div>
                <div class="offset-md-3 col-md-6 mb-3">
                    <label for="keterangan" class="form-label">Keterangan:</label>
                    <input type="text" class="form-control" id="keterangan" name="keterangan">
                </div>
                <div class="offset-md-3 col-md-6 mb-3">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    
                </div>
            </div>
        </form>
    </div>
</body>

</html>

    </table>
    </div>
    </div>
          </div>                      
             </div>
                </div>
                </div>
            <!-- End of Main Content -->

           

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
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
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="SBAdmin/vendor/jquery/jquery.min.js"></script>
    <script src="SBAdmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="SBAdmin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="SBAdmin/js/sb-admin-2.min.js"></script>
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
    // search barang
    document.getElementById('searchBarang').addEventListener('input', function() {
        var keyword = this.value.toLowerCase();
        var barangs = document.querySelectorAll('.barang');
        
        if (keyword.trim() === '') { // Jika input pencarian kosong
            barangs.forEach(function(barang) {
                barang.style.display = 'none'; // Semua barang disembunyikan
            });
        } else {
            barangs.forEach(function(barang) {
                var nama = barang.getAttribute('data-nama').toLowerCase();
                var checkbox = barang.querySelector('.form-check-input');
                if (nama.includes(keyword)) {
                    barang.style.display = 'block';
                } else if (!checkbox.checked) {
                    barang.style.display = 'none';
                }
            });
        }
    });
</script>
<script>
    // Fungsi untuk mengupdate total harga
    function updateTotal() {
        var total = 0;

        // Loop melalui semua barang yang dipilih
        document.querySelectorAll('.form-check-input:checked').forEach(function(checkbox) {
            var id = checkbox.value;
            var harga = parseInt(checkbox.dataset.harga);
            var jumlah = parseInt(document.getElementById('jumlah_' + id).value);
            
            total += harga * jumlah;
        });

        // Update tampilan total harga
        document.getElementById('total').value = total;

        // Hitung sisa pembayaran jika input bayar diisi
        var bayar = parseInt(document.getElementById('bayar').value);
        var sisa = bayar - total;
        if (!isNaN(sisa)) {
            document.getElementById('sisa').value = sisa;
        }
    }

    // Event listener untuk checkbox dan input jumlah
    document.querySelectorAll('.form-check-input, .jumlah').forEach(function(element) {
        element.addEventListener('change', function() {
            updateTotal();
        });
    });

    // Event listener untuk input bayar
    document.getElementById('bayar').addEventListener('input', function() {
        updateTotal();
    });
</script>

</body>
</html>