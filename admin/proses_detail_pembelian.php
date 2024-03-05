<?php
include '../koneksi.php';

// Tangani data POST
$pembelianId = $_POST['pembelianId'];
$produkIds = $_POST['produkId'];
$qtys = $_POST['qty'];
$hargaBelis = $_POST['hargaBeli'];

for ($i = 0; $i < count($produkIds); $i++) {
    $produkId = $produkIds[$i];
    $qty = $qtys[$i];
    $hargaBeli = $hargaBelis[$i];

    // Lakukan operasi penyimpanan ke dalam database sesuai dengan struktur tabel detail pembelian
    // Contoh:
    // $sqlInsertDetail = "INSERT INTO detail_pembelian (pembelian_id, produk_id, qty, harga_beli, created_at) VALUES ('$pembelianId', '$produkId', '$qty', '$hargaBeli', NOW())";
    // $resultInsertDetail = $koneksi->query($sqlInsertDetail);
}

// Simpan data ke dalam database
// Code untuk menyimpan data ke database di sini
// Pastikan untuk mengganti bagian ini dengan logika penyimpanan ke database sesuai dengan struktur tabel Anda

// Tutup koneksi database
$koneksi->close();
?>
