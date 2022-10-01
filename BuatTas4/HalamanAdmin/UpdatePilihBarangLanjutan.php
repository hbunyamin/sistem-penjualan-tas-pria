<?php
include '../Function/config.php';


$SelectWarna = $_POST['SelectWarna123'];
//$KodeBarang = $_POST['KodeProduk'];

$sql3 = "SELECT MIN(IDProduk) FROM Produk WHERE KodeBarang = '$SelectWarna'";
$result3 = mysqli_query($conn, $sql3);
$c = mysqli_fetch_array($result3);


    if ($SelectWarna == $c['MIN(IDProduk)']) {
        $IDProduk = $_POST['IDProduk'];
        $NamaProduk = $_POST['NamaProduk'];
        $Harga = $_POST['Harga'];
        $Berat = $_POST['Berat'];
        $Stock = $_POST['Stock'];
        $Kategori = $_POST['Kategori'];
        $Deskripsi = $_POST['Deskripsi'];
//        $Warna = implode(",", $_POST['Warna']);

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
        } else {
            $Nama1 = null;
        }

        if ($Foto2 != null) {
            $Nama2 = $NamaProduk . 2 . ".jpg";
        } else {
            $Nama2 = null;
        }

        if ($Foto3 != null) {
            $Nama3 = $NamaProduk . 3 . ".jpg";
        } else {
            $Nama3 = null;
        }

        if ($Foto4 != null) {
            $Nama4 = $NamaProduk . 4 . ".jpg";
        } else {
            $Nama4 = null;
        }

        if ($Foto5 != null) {
            $Nama5 = $NamaProduk . 5 . ".jpg";
        } else {
            $Nama5 = null;
        }

        if ($Foto6 != null) {
            $Nama6 = $NamaProduk . 6 . ".jpg";
        } else {
            $Nama6 = null;
        }

        if ($Foto7 != null) {
            $Nama7 = $NamaProduk . 7 . ".jpg";
        } else {
            $Nama7 = null;
        }

        if ($Foto8 != null) {
            $Nama8 = $NamaProduk . 8 . ".jpg";
        } else {
            $Nama8 = null;
        }

        if ($Foto9 != null) {
            $Nama9 = $NamaProduk . 9 . ".jpg";
        } else {
            $Nama9 = null;
        }

        if ($Foto10 != null) {
            $Nama10 = $NamaProduk . 10 . ".jpg";
        } else {
            $Nama10 = null;
        }

        $path1 = "../GambarProduk/" . $Nama1;
        $path2 = "../GambarProduk/" . $Nama2;
        $path3 = "../GambarProduk/" . $Nama3;
        $path4 = "../GambarProduk/" . $Nama4;
        $path5 = "../GambarProduk/" . $Nama5;
        $path6 = "../GambarProduk/" . $Nama6;
        $path7 = "../GambarProduk/" . $Nama7;
        $path8 = "../GambarProduk/" . $Nama8;
        $path9 = "../GambarProduk/" . $Nama9;
        $path10 = "../GambarProduk/" . $Nama10;

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

        $query = "UPDATE Produk SET NamaProduk = '$NamaProduk', Harga = $Harga, Stock = '$Stock',
            Kategori = '$Kategori', Deskripsi = '$Deskripsi', Berat = $Berat,
            Foto1 = '$Nama1', Foto2 = '$Nama2', Foto3 = '$Nama3', Foto4 = '$Nama4', Foto5 = '$Nama5', Foto6 = '$Nama6',
            Foto7 = '$Nama7', Foto8 = '$Nama8', Foto9 = '$Nama9', Foto10 = '$Nama10'
            WHERE IDProduk = $IDProduk";
        $hasil = mysqli_query($conn, $query);

        if ($hasil) {
            echo "<script>alert('Update Barang Berhasil'); history.go(-2);</script>";
        } else {
            echo "<script>alert('Update Barang Gagal')</script>";
        }

    } else if ($SelectWarna != $c['MIN(IDProduk)'] ){
        $IDProduk = $_POST['IDProduk'];
////        $NamaProduk = $_POST['NamaProduk1'];
////        $Harga = $_POST['Harga1'];
////        $Berat = $_POST['Berat1'];
        $Stock = $_POST['Stock'];
////        $Kategori = $_POST['Kategori1'];
////        $Deskripsi = $_POST['Deskripsi1'];
//
        $query = "UPDATE PRODUK SET Stock = '$Stock' WHERE IDProduk = $IDProduk";
        $hasil = mysqli_query($conn, $query);
//
        if ($hasil) {
            echo "<script>alert('Update Barang Berhasil'); history.go(-2);</script>";
        } else {
            echo "<script>alert('Update Barang Gagal')</script>";
        }

    }

