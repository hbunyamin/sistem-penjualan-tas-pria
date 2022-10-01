<?php
include '../Function/config.php';

$NamaProduk = $_POST['NamaProduk'];
$KodeProduk = $_POST['KodeProduk'];
$Harga = $_POST['Harga'];
$Berat = $_POST['Berat'];
$Kategori = $_POST['Kategori'];
$Warna = $_POST['Warna'];
//$Warna = implode(",", $_POST['Warna']);
if ($_POST['Stock'] != null){
    $Stock = $_POST['Stock'];
}
//$Stock = $_POST['Stock'];
$Deskripsi = $_POST['Deskripsi'];

$Foto1 = $_FILES['UploadFoto1']['name'];
$Foto2 = $_FILES['UploadFoto2']['name'];
$Foto3 = $_FILES['UploadFoto3']['name'];
$Foto4 = $_FILES['UploadFoto4']['name'];
$Foto5 = $_FILES['UploadFoto5']['name'];
$Foto6 = $_FILES['UploadFoto6']['name'];
$Foto7 = $_FILES['UploadFoto7']['name'];
$Foto8 = $_FILES['UploadFoto8']['name'];
$Foto9 = $_FILES['UploadFoto9']['name'];
$Foto10 = $_FILES['UploadFoto10']['name'];

$tmp_file1 = $_FILES['UploadFoto1']['tmp_name'];
$tmp_file2 = $_FILES['UploadFoto2']['tmp_name'];
$tmp_file3 = $_FILES['UploadFoto3']['tmp_name'];
$tmp_file4 = $_FILES['UploadFoto4']['tmp_name'];
$tmp_file5 = $_FILES['UploadFoto5']['tmp_name'];
$tmp_file6 = $_FILES['UploadFoto6']['tmp_name'];
$tmp_file7 = $_FILES['UploadFoto7']['tmp_name'];
$tmp_file8 = $_FILES['UploadFoto8']['tmp_name'];
$tmp_file9 = $_FILES['UploadFoto9']['tmp_name'];
$tmp_file10 = $_FILES['UploadFoto10']['tmp_name'];


if ($Foto1 != null) {
    $Nama1 = $NamaProduk . 1 . ".jpg";
} else{
    $Nama1 = null;
}

if ($Foto2 != null) {
    $Nama2 = $NamaProduk . 2 . ".jpg";
} else{
    $Nama2 = null;
}

if ($Foto3 != null) {
    $Nama3 = $NamaProduk . 3 . ".jpg";
} else{
    $Nama3 = null;
}

if ($Foto4 != null){
    $Nama4 = $NamaProduk. 4 . ".jpg";
} else{
    $Nama4 = null;
}

if ($Foto5 != null){
    $Nama5 = $NamaProduk. 5 . ".jpg";
} else{
    $Nama5 = null;
}

if ($Foto6 != null) {
    $Nama6 = $NamaProduk . 6 . ".jpg";
} else{
    $Nama6 = null;
}

if ($Foto7 != null) {
    $Nama7 = $NamaProduk . 7 . ".jpg";
} else{
    $Nama7 = null;
}

if ($Foto8 != null) {
    $Nama8 = $NamaProduk . 8 . ".jpg";
} else{
    $Nama8 = null;
}

if ($Foto9 != null) {
    $Nama9 = $NamaProduk . 9 . ".jpg";
} else{
    $Nama9 = null;
}

if ($Foto10 != null) {
    $Nama10 = $NamaProduk . 10 . ".jpg";
} else{
    $Nama10 = null;
}

$path1 = "../GambarProduk/".$Nama1;
$path2 = "../GambarProduk/".$Nama2;
$path3 = "../GambarProduk/".$Nama3;
$path4 = "../GambarProduk/".$Nama4;
$path5 = "../GambarProduk/".$Nama5;
$path6 = "../GambarProduk/".$Nama6;
$path7 = "../GambarProduk/".$Nama7;
$path8 = "../GambarProduk/".$Nama8;
$path9 = "../GambarProduk/".$Nama9;
$path10 = "../GambarProduk/".$Nama10;

//if(move_uploaded_file($tmp_file1, $path1) AND move_uploaded_file($tmp_file2, $path2)) {
move_uploaded_file($tmp_file1, $path1);
move_uploaded_file($tmp_file2, $path2);
move_uploaded_file($tmp_file3, $path3);
move_uploaded_file($tmp_file4, $path4);
move_uploaded_file($tmp_file5, $path5);
move_uploaded_file($tmp_file6, $path6);
move_uploaded_file($tmp_file7, $path7);
move_uploaded_file($tmp_file8, $path8);
move_uploaded_file($tmp_file9, $path9);
move_uploaded_file($tmp_file10, $path10);

$jml_dipilih = count($Warna);
for($x=0;$x<$jml_dipilih;$x++) {
//        $sql = "INSERT INTO Produk (Variasi) VALUES ('$Warna[$x]')";
    $sql = "INSERT INTO Produk (NamaProduk, KodeBarang, Harga, Kategori, Deskripsi, Variasi, Berat, Stock,
            Foto1, Foto2, Foto3, Foto4, Foto5, Foto6, Foto7, Foto8, Foto9, Foto10)
            VALUES ('$NamaProduk', '$KodeProduk', $Harga, '$Kategori', '$Deskripsi', '$Warna[$x]', $Berat, '$Stock[$x]',
            '$Nama1', '$Nama2', '$Nama3', '$Nama4', '$Nama5', '$Nama6', '$Nama7', '$Nama8', '$Nama9', '$Nama10')";

    $result = mysqli_query($conn, $sql);
}

//    $sql = "INSERT INTO Produk (NamaProduk, Harga, Kategori, Deskripsi, Variasi, Berat,
//    Foto1, Foto2, Foto3, Foto4, Foto5, Foto6, Foto7, Foto8, Foto9, Foto10)
//VALUES ('$NamaProduk', '$Harga', '$Kategori', '$Deskripsi', '$Warna', '$Berat',
//'$Nama1', '$Nama2', '$Nama3', '$Nama4', '$Nama5', '$Nama6', '$Nama7', '$Nama8', '$Nama9', '$Nama10')";
//    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('Tambah Barang Berhasil')</script>";
    } else {
        echo "<script>alert('Tambah Barang Gagal')</script>";
    }
//} else{
//    echo "<script>alert('Maaf, Gambar gagal untuk diupload');</script>";
//}

?>

<script>
    history.go(-1);
</script>
