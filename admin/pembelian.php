<?php
include '../koneksi.php';
$sql="SELECT * FROM suplier";
$result=mysqli_query($koneksi,$sql);

$result1=mysqli_query($koneksi,$sql);
$sql="SELECT * FROM penjualan";

$sql="SELECT * FROM produk";
$result2=mysqli_query($koneksi,$sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    

    <!-- Custom fonts for this template-->
    <link href="../SBAdmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Custom styles for this template-->
    <link href="../SBAdmin/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
    .table thead th {
        border-bottom: 0px;
    }

    th {
        border: 2px solid #000000; /* Ubah warna border menjadi hitam */
        background-color: white;
        color: #000000;
    }

    tr,
    td {
        border: 2px solid #eeeeee;
        color: #000000;
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
                <div class="sidebar-brand-text mx-3">admin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
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
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Data Master</span>
                </a>
                <div id="collapseTwo" class="collapse " aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item " href="toko.php">Toko</a>
                        <a class="collapse-item " href="kategori.php">Kategori</a>
                        <a class="collapse-item " href="list_produk.php">Produk</a>
                        <a class="collapse-item " href="pelanggan.php">Pelanggan</a>
                        <a class="collapse-item" href="supplier.php">Supplier</a>
                        <a class="collapse-item" href="stock.php">stok</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fa-solid fa-money-bill"></i>
                    <span>Transaksi</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="pembelian.php">pembelian</a>
                        <a class="collapse-item" href="tabel_penjualan.php">Tabel penjualan</a>
                        <a class="collapse-item" href="detail_pembelian.php">Detail pembelian</a>

                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="pengguna.php">
                <i class="fa-regular fa-user"></i>
                    <span>Data user</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../Logout.php">
                <i class="fa-solid fa-right-from-bracket"></i>
                    <span>log out</span></a>
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
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
                    

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->


</head>
<body>    
    <div class="container">
    <h2 class="text-center  ">Pembelian</h2>

        <!-- Add a form for adding a new purchase -->
        <form action="../Proses/proses_tambah_pembelian.php" method="post">
            <!-- Include necessary input fields -->
            <label for="no_faktur">No. Faktur:</label>
            <input type="text" id="no_faktur" name="no_faktur" required readonly>

            <label for="tanggal_pembelian">Tanggal Pembelian:</label>
            <input type="date" id="tanggal_pembelian" name="tanggal_pembelian" required>
    
            <label for="suplier">Suplier:</label>
            <select class="form-control mb-2" id="suplier" name="suplier_id" required>
                <?php 
                    if($result){
                        while($row = mysqli_fetch_assoc($result)){
                            $nama_suplier = $row['nama_suplier'];
                            $id = $row['suplier_id'];
                            echo "<option value='$id'>$nama_suplier</option>";
                        }
                    } else {
                        echo "<option value='' disabled selected>Gagal mengambil data</option>";
                    }
                ?>
            </select>
            
            <label for="produk">Barang:</label>
            <select class="form-control mb-2" id="produk" name="produk_id" required onchange="updateHarga()">
    <?php 
    if($result2){
        while($row = mysqli_fetch_assoc($result2)){
            $nama_produk = $row['nama_produk'];
            $id = $row['produk_id'];
            echo "<option value='$id'>$nama_produk</option>";
        }
    } else {
        echo "<option value='' disabled selected>Gagal mengambil data</option>";
    }
    ?>
</select>
         
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" min="1" required onchange="updateTotal()">
            
            <label for="total">Total:</label>
            <input type="text" id="total" name="total" required>

            <label for="bayar">Bayar:</label>
            <input type="text" id="bayar" name="bayar" required>

            <label for="sisa">Sisa:</label>
            <input type="text" id="sisa" name="sisa" required>

            <label for="stock">Stok:</label>
            <input type="text" id="stock" name="stock" required>

            <label for="keterangan">Keterangan:</label>
            <textarea id="keterangan" name="keterangan"></textarea>



            <button type="submit">Tambah Pembelian</button>
        </form>
        </table>
    </div>

    <div class="container ">        
    <table class="table table-bordered table-sm ">
            <!-- Include a table to display existing purchases -->
            <thead>
                <tr class="text-center">
                    <th>No. Faktur</th>
                    <th>Tanggal Pembelian</th>
                    <th>Supplier ID</th>
                    <th>Total</th>
                    <th>Bayar</th>
                    <th>Sisa</th>
                    <th>Stok</th>
                    <th>Keterangan</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Connect to your database and fetch data to display in the table
                // Use a PDO connection or any database connection method you prefer
                try {
                    $pdo = new PDO("mysql:host=localhost;dbname=kasir", "root", "");
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmt = $pdo->prepare("SELECT * FROM pembelian");
                    $stmt->execute();
                    $pembelianData = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($pembelianData as $pembelian) {
                        echo "<tr>";
                        echo "<td>{$pembelian['no_faktur']}</td>";
                        echo "<td>{$pembelian['tanggal_pembelian']}</td>";
                        echo "<td>{$pembelian['suplier_id']}</td>";
                        echo "<td>{$pembelian['total']}</td>";
                        echo "<td>{$pembelian['bayar']}</td>";
                        echo "<td>{$pembelian['sisa']}</td>";
                        echo "<td>{$pembelian['stock']}</td>"; // Ini akan menampilkan nilai stok dari database
                        echo "<td>{$pembelian['keterangan']}</td>";
                        echo "<td>{$pembelian['created_at']}</td>";
                        echo "</tr>";
                    }
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
                // Close the database connection
                $pdo = null;
                ?>
            </tbody>
    </div>

    <!-- Add your JavaScript code here -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Generate a unique value for No. Faktur
            var uniqueNoFaktur = 'F' + Date.now();
            document.getElementById('no_faktur').value = uniqueNoFaktur;

            // Fetch supplier data from the server (adjust the URL accordingly)
            fetch('get_supplier_data.php')
                .then(response => response.json())
                .then(data => {
                    // Assuming data contains an array of suppliers
                    // You can customize this based on your actual data structure
                    if (data.length > 0) {
                        document.getElementById('suplier_id').value = data[0].supplier_id;
                    }
                })
                .catch(error => console.error('Error fetching supplier data:', error));
        });
       
        // Mendapatkan tanggal hari ini dalam format YYYY-MM-DD
        function getTodayDate() {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
            var yyyy = today.getFullYear();

            return yyyy + '-' + mm + '-' + dd;
        }

    // Memasukkan tanggal hari ini ke input tanggal_pembelian
    document.addEventListener('DOMContentLoaded', function () {
        var tanggal_pembelian = document.getElementById('tanggal_pembelian');
        tanggal_pembelian.value = getTodayDate();
    });

    </script>
<script>
    // Function to update total price based on selected product and quantity
    function updateTotal() {
        var selectedProdukId = $('#produk').val();
        var quantity = $('#quantity').val();

        // AJAX request to fetch the price of the selected product
        $.ajax({
            url: 'get_harga.php',
            type: 'GET',
            data: { produk_id: selectedProdukId },
            success: function(response) {
                var hargaJual = parseFloat(response);
                var total = hargaJual * quantity;
                $('#harga_jual').val(hargaJual.toFixed(2));
                $('#total').val(total.toFixed(2));

                // Calculate and display the remaining balance
                var bayar = parseFloat($('#bayar').val());
                var sisa = total - bayar;
                $('#sisa').val(sisa.toFixed(2));
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }

    // Function to update remaining balance based on the amount paid
    function updateSisa() {
        var total = parseFloat($('#total').val());
        var bayar = parseFloat($('#bayar').val());
        var sisa = total - bayar;
        $('#sisa').val(sisa.toFixed(2));
    }

    // Call the updateTotal function when the page loads and when the quantity or product selection changes
    $(document).ready(function() {
        $('#quantity, #produk').change(function() {
            updateTotal();
        });

        // Call the updateSisa function when the amount paid changes
        $('#bayar').change(function() {
            updateSisa();
        });
    });
</script>



</body>

</html>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pembelian</title>

    <!-- Add your CSS link or include styles here -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fc;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
            color: #007bff;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>

<body>
    <!-- Rest of your HTML content -->
</body>

</html>


                        <!-- Earnings (Monthly) Card Example -->
                        
                       

                        <!-- Pending Requests Card Example -->
                     

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
                    <h5 class="modal-title" id="exampleModalLabel">Anda Yakin Ingin Keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Jika logout anda harus login kembali!</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php">Logout</a>
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
    <!-- Custom styles for this template-->
    <link href="../SBAdmin/css/sb-admin-2.min.css" rel="stylesheet">
</head>