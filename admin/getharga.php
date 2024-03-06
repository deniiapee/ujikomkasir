<?php
// include file koneksi database
include '../koneksi.php';

// tangkap namaProduk yang dikirim via AJAX
$namaProduk = $_POST['namaProduk'];

// buat query untuk mengambil harga jual produk berdasarkan nama produk
$sql = "SELECT harga_jual FROM produk WHERE nama_produk = '$namaProduk'";
$result = $koneksi->query($sql);

// cek apakah query berhasil dieksekusi
if ($result->num_rows > 0) {
    // ambil data harga jual dari hasil query
    $row = $result->fetch_assoc();
    $hargaJual = $row['harga_jual'];
    // kirim harga jual sebagai respons AJAX
    echo $hargaJual;
} else {
    // jika produk tidak ditemukan
    echo "0"; // atau response lainnya sesuai kebutuhan Anda
}

// tutup koneksi database
$koneksi->close();
?>
