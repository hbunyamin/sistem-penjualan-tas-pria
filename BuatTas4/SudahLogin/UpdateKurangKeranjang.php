<?php
include '../Function/config.php';

$id1 = $_GET['id'];


$sql = "SELECT k.IDKeranjang, k.JumlahBarang, k.IDProduk, k.IDUser, k.IDProduk, p.NamaProduk, 
            p.Harga, u.Username, p.Berat
            FROM Keranjang as k
            JOIN Produk as p
            ON k.IDProduk = p.IDProduk
            JOIN User as u
            ON k.IDUser = u.IDUser
            WHERE IDKeranjang = $id1";
$result = mysqli_query($conn, $sql);
while ($a = mysqli_fetch_array($result)) {

    $Harga = $a['Harga'];
    $Berat = $a['Berat'];

    $query = "UPDATE Keranjang SET JumlahBarang = (JumlahBarang - 1), 
          TotalBelanjaan = ($Harga * JumlahBarang), JumlahBerat = ($Berat * JumlahBarang)
                WHERE IDKeranjang = $id1";
    $hasil = mysqli_query($conn, $query);


}
?>
<script>
    history.go(-1);
</script>
