<?php
include '../koneksi.php';

// Tangani data POST
$namaProduk = $_POST['namaProduk'];

// Query untuk mengambil harga jual produk berdasarkan nama produk
$sql = "SELECT harga_jual FROM produk WHERE nama_produk = '$namaProduk'";
$result = $koneksi->query($sql);

// Ambil hasil query
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hargaJual = $row['harga_jual'];
    echo $hargaJual; // Mengirimkan harga jual sebagai respons
} else {
    echo "0"; // Jika tidak ada hasil, kirimkan 0 sebagai respons
}

// Tutup koneksi database
$koneksi->close();
?>
