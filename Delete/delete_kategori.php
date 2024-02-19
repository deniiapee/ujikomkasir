<?php

// Memastikan parameter 'id' tersedia dan tidak kosong
if (isset($_GET['id']) && !empty($_GET['id'])) {
    include '../koneksi.php';

    // Mendapatkan nilai 'id' dari URL
    $id = $_GET['id'];

    // Query untuk menghapus data kategori berdasarkan id
    $query = "DELETE FROM produk_kategori WHERE kategori_id = $id";

    // Mengeksekusi query
    if ($koneksi->query($query) === TRUE) {
        // Jika query berhasil dieksekusi
        echo "Data berhasil dihapus.";
    } else {
        // Jika terjadi error dalam query
        echo "Error: " . $query . "<br>" . $koneksi->error;
    }

    // Menutup koneksi
    $koneksi->close();
} else {
    // Jika id tidak valid
    echo "ID tidak valid.";
}

// Mengarahkan kembali ke halaman kategori setelah penghapusan
header("Location: ../kategori.php");
exit();
?>
