<?php 
include '../koneksi.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $toko = $_POST['toko'];
    $kategori = $_POST['kategori'];
    $satuan = $_POST['satuan'];
    $produk = $_POST['nama_produk'];
    $harga_jual = $_POST['harga_jual'];

    // Parameterized query
    $sql = "INSERT INTO produk (toko_id, nama_produk, kategori_id, harga_jual, satuan) VALUES (?, ?, ?, ?, ?)";
    
    // Persiapkan statement
    $stmt = mysqli_prepare($koneksi, $sql);

    // Bind parameter ke statement
    mysqli_stmt_bind_param($stmt, "sssss", $toko, $produk, $kategori, $harga_jual, $satuan);

    // Eksekusi statement
    if (mysqli_stmt_execute($stmt)) {
        header("location: ../admin/list_produk.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }

    // Tutup statement
    mysqli_stmt_close($stmt);
    // Tutup koneksi ke database
    mysqli_close($koneksi);
}
?>
