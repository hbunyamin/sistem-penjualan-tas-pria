<?php
include_once '../Function/config.php';

$id = $_GET['id'];
$query = "DELETE FROM DataPembayaran WHERE IDBayar= $id";
mysqli_query($conn, $query);


?>

<script>
    history.go(-1);
</script>

