<?php

if (isset($_GET['id']) && !empty($_GET['id'])) {

    include '../../koneksi.php';

    $id = $_GET['id'];

    $query = "DELETE FROM pelanggan WHERE pelanggan_id = $id";
    if ($koneksi->query($query) === TRUE) {
        echo "Data berhasil dihapus.";
    } else {
        echo "Error: " . $query . "<br>" . $koneksi->error;
    }
    $koneksi->close();
} else {
    echo "ID tidak valid.";
}

header("Location: ../pelanggan.php");
exit();
?>