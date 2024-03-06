<?php
// include file koneksi database
include '../koneksi.php';

// tangkap id_suplier yang dikirim via AJAX
$id_suplier = $_POST['id_suplier'];

// buat query untuk mengambil produk berdasarkan id_suplier
$sql = "SELECT produk_id, nama_produk, harga_jual FROM produk WHERE suplier_id = $id_suplier";
$result = $koneksi->query($sql);

// inisialisasi variabel untuk menampung hasil query
$output = '';

// cek apakah query berhasil dieksekusi
if ($result->num_rows > 0) {
    // looping untuk membentuk baris tabel produk
    while($row = $result->fetch_assoc()) {
        $output .= '<tr>';
        $output .= '<td>' . $row['nama_produk'] . '</td>';
        $output .= '<td><input type="text" id="hargaJual' . $row['nama_produk'] . '" value="' . $row['harga_jual'] . '" readonly></td>';
        $output .= '<td><input type="number" id="qty' . $row['nama_produk'] . '" oninput="updateQty(this)" min="0"></td>';
        $output .= '<td><label class="checkbox-label"><input type="checkbox" class="selectProduct" value="' . $row['nama_produk'] . '" onchange="updateQty(this)"> <span class="checkmark"></span></label></td>';
        $output .= '</tr>';
    }
} else {
    // jika tidak ada produk yang ditemukan
    $output .= '<tr><td colspan="4">Tidak ada produk yang tersedia untuk supplier ini</td></tr>';
}

// kirim output sebagai respons AJAX
echo $output;

// tutup koneksi database
$koneksi->close();
?>
