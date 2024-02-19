<?php
include "../koneksi.php";

// Lakukan proses edit data kategori di sini
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nama_kategori = $_POST["nama_kategori"];
    
    $sql = "UPDATE produk_kategori SET nama_kategori = '$nama_kategori' WHERE kategori_id = '$id'";
    $result = mysqli_query($koneksi, $sql);

    if($result) {
        // Jika proses edit berhasil, arahkan kembali ke halaman kategori
        header("location: ../kategori.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($koneksi);
        exit();
    }
} else {
    // Jika tidak ada data POST, arahkan kembali ke halaman edit
    header("location: ../edit_kategori.php");
    exit();
}
?>
