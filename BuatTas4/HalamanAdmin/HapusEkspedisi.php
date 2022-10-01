<?php
include_once '../Function/config.php';

$id = $_GET['id'];
$query = "DELETE FROM Pengiriman WHERE IDPengiriman = $id";
mysqli_query($conn, $query);


?>

<script>
    history.go(-1);
</script>

