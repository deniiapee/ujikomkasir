<?php
include '../koneksi.php';

// Check if the produk_id is set and is not empty
if(isset($_GET['produk_id']) && !empty($_GET['produk_id'])) {
    // Sanitize the input
    $produk_id = mysqli_real_escape_string($koneksi, $_GET['produk_id']);

    // Query to fetch the harga_jual from the produk table based on the selected produk_id
    $sql = "SELECT harga_jual FROM produk WHERE produk_id = '$produk_id'";

    // Execute the query
    $result = mysqli_query($koneksi, $sql);

    // Check if the query was successful
    if($result) {
        // Fetch the price from the result
        $row = mysqli_fetch_assoc($result);
        $harga_jual = $row['harga_jual'];

        // Check if the harga_jual is greater than zero
        if($harga_jual > 0) {
            // Return the harga_jual as the response
            echo $harga_jual;
        } else {
            // If harga_jual is zero or negative, return an error message
            echo "Error: Harga jual is invalid";
        }
    } else {
        // If the query fails, return an error message
        echo "Error: Unable to fetch price from database";
    }
} else {
    // If produk_id is not set or empty, return an error message
    echo "Error: Produk ID is missing";
}
?>
