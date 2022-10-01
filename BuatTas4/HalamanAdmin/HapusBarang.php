<?php
include_once '../Function/config.php';

$id = $_GET['id'];
$query = "DELETE FROM Produk WHERE IDProduk=". $id;
mysqli_query($conn, $query);


//header('Location: UpdateBarang.php');
?>

<script>
history.go(-3);
</script>
