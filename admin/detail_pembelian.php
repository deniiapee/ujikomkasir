<?php
include '../koneksi.php';

if(isset($_POST['submit_detail_pembelian'])) {
    // Ambil data dari form
    $pembelian_id = $_POST['pembelian_id'];
    // Ambil data lainnya sesuai kebutuhan

    // Simpan data detail pembelian ke database
    $sql = "INSERT INTO detail_pembelian (pembelian_id, ...) VALUES ('$pembelian_id', ...)";
    if(mysqli_query($koneksi, $sql)) {
        // Redirect kembali ke form detail pembelian
        header("Location: form_detail_pembelian.php?pembelian_id=$pembelian_id");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pembelian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            margin-bottom: 10px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Detail Pembelia</h2>
    <table>
        <thead>
            <tr>
                <th>Beli Detail ID</th>
                <th>Pembelian ID</th>
                <th>Produk ID</th>
                <th>Qty</th>
                <th>Harga Beli</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <!-- Isi tabel akan di-generate dinamis menggunakan PHP -->
          
        </tbody>
    </table>
</body>
</html>
