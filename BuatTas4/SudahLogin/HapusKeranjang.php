<?php
include_once '../Function/config.php';

$id = $_GET['id'];
$query = "DELETE FROM Keranjang WHERE IDKeranjang = $id";
mysqli_query($conn, $query);

//header('Location: UpdateBarang.php');
?>
<script>
    history.go(-1);
</script>

