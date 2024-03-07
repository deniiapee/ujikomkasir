<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Connect to your database
        $pdo = new PDO("mysql:host=localhost;dbname=kasir", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Get values from the form
        $no_faktur = $_POST['no_faktur'];
        $tanggal_pembelian = $_POST['tanggal_pembelian'];
        $suplier_id = $_POST['suplier_id'];
        $total = $_POST['total'];
        $bayar = $_POST['bayar'];
        $sisa = $_POST['sisa'];
        $stock = $_POST['stock']; // Ambil nilai stok dari formulir
        $keterangan = $_POST['keterangan'];

        // Prepare SQL statement for inserting data
        $stmt = $pdo->prepare("INSERT INTO pembelian (no_faktur, tanggal_pembelian, suplier_id, total, bayar, sisa, stock, keterangan) 
                               VALUES (:no_faktur, :tanggal_pembelian, :suplier_id, :total, :bayar, :sisa, :stock, :keterangan)");

        // Bind parameters
        $stmt->bindParam(':no_faktur', $no_faktur);
        $stmt->bindParam(':tanggal_pembelian', $tanggal_pembelian);
        $stmt->bindParam(':suplier_id', $suplier_id);
        $stmt->bindParam(':total', $total);
        $stmt->bindParam(':bayar', $bayar);
        $stmt->bindParam(':sisa', $sisa);
        $stmt->bindParam(':stock', $stock); // Bind nilai stok ke dalam parameter
        $stmt->bindParam(':keterangan', $keterangan);

        // Execute the statement
        $stmt->execute();

        $pembelian_id = $pdo->lastInsertId();

        // Prepare SQL statement for inserting data into pembelian_detail table
        $stmtDetail = $pdo->prepare("INSERT INTO pembelian_detail (pembelian_id, produk_id, qty) 
                                     VALUES (:pembelian_id, :produk_id, :qty)");

        // Loop through the products and quantities submitted in the form
        foreach ($_POST['produk'] as $index => $produk) {
            // Get the corresponding quantity for the product
            $qty = $_POST['qty'][$index];

            // Bind parameters
            $stmtDetail->bindParam(':pembelian_id', $pembelian_id);
            $stmtDetail->bindParam(':produk_id', $produk);
            $stmtDetail->bindParam(':qty', $qty);

            // Execute the statement to insert data into pembelian_detail table
            $stmtDetail->execute();
        }

        // Redirect back to the pembelian.php page after successful addition
        header("Location:../admin/pembelian.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    }
    ?>