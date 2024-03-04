<?php 
 include "../koneksi.php";

 if(isset($_POST['id_suplier'])){
    $id_suplier = $_POST['id_suplier'];

    $result = mysqli_query($koneksi,"SELECT * FROM produk WHERE suplier_id = '$id_suplier'");

    if($result){
        while($data = mysqli_fetch_assoc($result)){
            echo "<tr>
            <td>{$data['nama_produk']}</td>
            <td>{$data['harga_jual']}</td>
            <td><input type='number' id='qtyEkonomi' name='qtyEkonomi' min='0' style='width:60px;' oninput='hitungSisa()'></td>
            <td><input type='checkbox' class='selectProduct' id='chkEkonomi' name='selectProduct[]' value='Ekonomi' onchange='updateQty(this)'></td>
            </tr>";
        }
    }
 }

?>