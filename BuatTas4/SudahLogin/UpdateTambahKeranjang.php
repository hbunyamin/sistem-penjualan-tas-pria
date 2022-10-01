<?php
include '../Function/config.php';

$id1 = $_GET['id'];


$sql = "SELECT k.IDKeranjang, k.JumlahBarang, k.IDProduk, k.IDUser, k.IDProduk, p.NamaProduk, 
            p.Harga, u.Username, p.Berat, p.Stock
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
    $JumlahBarang = $a['JumlahBarang'];
    $Stock = $a['Stock'];

    if ($JumlahBarang < (int)$Stock) {

        $query = "UPDATE Keranjang SET JumlahBarang = (JumlahBarang + 1), 
              TotalBelanjaan = ($Harga * JumlahBarang), JumlahBerat = ($Berat * JumlahBarang)
                    WHERE IDKeranjang = $id1";
        $hasil = mysqli_query($conn, $query);

    } else{
        echo "<script>alert('Anda tidak bisa menambah barang melebihi jumlah stock, periksa kembali keranjang anda!')</script>";
    }


}
?>
<script>
    history.go(-1);
</script>
