<?php
include '../Function/config.php';

$id = $_GET['id'] ;

$StatusPembayaran = "Sudah Bayar";

$query = "UPDATE Transaksi SET StatusPembayaran = '$StatusPembayaran' WHERE IDTransaksi = $id";
$hasil = mysqli_query($conn, $query);

if ($hasil){
    echo "<script>alert('Konfirmasi Pembayaran Berhasil')</script>";
} else{
    echo "<script>alert('Konfirmasi Pembayaran Gagal')</script>";
}

header("Location: berhasil_login.php");
?>

<!--<script>-->
<!--history.go(-2);-->
<!--</script>-->
