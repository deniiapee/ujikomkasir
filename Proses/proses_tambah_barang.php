<?php 
include '../koneksi.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $toko = $_POST['toko'];
    $kategori = $_POST['kategori'];
    $satuan = $_POST['satuan'];
    $produk = $_POST['nama_produk'];
    $harga_jual = $_POST['harga_jual'];
    $stock = $_POST['stock'];


    $sql = "INSERT INTO produk (toko_id, nama_produk, kategori_id, harga_jual, stock ,satuan) VALUES ('$toko', '$produk', '$kategori', '$harga_jual', '$stock','$satuan')";

    if (mysqli_query($koneksi, $sql)) {
        header("location: ../admin/list_produk.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }

    // Tutup koneksi ke database
    mysqli_close($koneksi);
}
?>