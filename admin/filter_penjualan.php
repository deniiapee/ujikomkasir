<?php
// Include file koneksi.php untuk menghubungkan ke database
include '../koneksi.php';

// Ambil tanggal awal dan tanggal akhir dari form filter
$tanggal_awal = $_POST['tanggal_awal'];
$tanggal_akhir = $_POST['tanggal_akhir'];

// Modifikasi format tanggal agar sesuai dengan format di dalam database (YYYY-MM-DD)
$tanggal_awal = date('Y-m-d', strtotime($tanggal_awal));
$tanggal_akhir = date('Y-m-d', strtotime($tanggal_akhir));

// Query SQL untuk mengambil data penjualan berdasarkan rentang tanggal
$sql = "SELECT * FROM penjualan 
        INNER JOIN toko ON toko.toko_id = penjualan.toko_id
        INNER JOIN pelanggan ON penjualan.pelanggan_id = pelanggan.pelanggan_id
        WHERE DATE(penjualan.created_at) BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
$result = mysqli_query($koneksi, $sql);

// Buat variabel untuk menyimpan hasil HTML
$html = '';

// Cek apakah terdapat data penjualan yang ditemukan
if (mysqli_num_rows($result) > 0) {
    // Output data dari setiap baris
    while ($row = mysqli_fetch_assoc($result)) {
        $html .= '<tr>';
        $html .= '<td>' . $row["nama_toko"] . '</td>'; // Output nama toko
        $html .= '<td>' . $row["nama_pelanggan"] . '</td>'; // Output nama pelanggan
        $html .= '<td>' . $row["total"] . '</td>';
        $html .= '<td>' . $row["bayar"] . '</td>'; 
        $html .= '<td>' . $row["sisa"] . '</td>';
        $html .= '<td>' . $row["keterangan"] . '</td>'; // Output keterangan penjualan
        $html .= '<td>' . $row["created_at"] . '</td>'; // Output tanggal dibuat
        $html .= '<td style="text-align: center;">';
        $html .= '<a href="detail_penjualan.php?id='. $row["penjualan_id"] .'" class="btn btn-primary">Detail Penjualan</a>';
        $html .= '<a class="btn btn-danger" href="delete_penjualan.php?id='. $row['penjualan_id'] .'">Hapus</a>';
        $html .= '</td>'; // Output aksi (link detail dan hapus)
        $html .= '</tr>';
    }
} else {
    // Tampilkan pesan jika tidak ada data yang ditemukan
    $html .= '<tr><td colspan="8">Tidak ada data</td></tr>';
}

// Kembalikan hasil HTML
echo $html;
?>
