<?php

session_start();

if (!isset($_SESSION['Username2'])) {
    header("Location: ../index.php");
}

include '../Function/config.php';

//$id = $_GET['id'] ;
$SelectWarna = $_POST['SelectWarna'];
//if ($SelectWarna == null){
//    echo "<script>alert('Warna belum dipilih');history.go(-1);</script>";
//}
//$SelectWarnaaa = $_POST['SelectWarnaaa'];

$sql = "SELECT * FROM Produk WHERE IDProduk = $SelectWarna";
$result = mysqli_query($conn, $sql);

while ($a = mysqli_fetch_array($result)){


//if (isset($_POST['SubmitPilihBarang'])) {
//
//    if ($SelectWarna == $c['MIN(IDProduk)']) {
//        $NamaProduk = $_POST['NamaProduk'];
//        $Harga = $_POST['Harga'];
//        $Berat = $_POST['Berat'];
//        $Stock = $_POST['Stock'];
//        $Kategori = $_POST['Kategori'];
//        $Deskripsi = $_POST['Deskripsi'];
////        $Warna = implode(",", $_POST['Warna']);
//
//        $Foto1 = $_FILES['UploadFoto1']['name'];
//        $Foto2 = $_FILES['UploadFoto2']['name'];
//        $Foto3 = $_FILES['UploadFoto3']['name'];
//        $Foto4 = $_FILES['UploadFoto4']['name'];
//        $Foto5 = $_FILES['UploadFoto5']['name'];
//        $Foto6 = $_FILES['UploadFoto6']['name'];
//        $Foto7 = $_FILES['UploadFoto7']['name'];
//        $Foto8 = $_FILES['UploadFoto8']['name'];
//        $Foto9 = $_FILES['UploadFoto9']['name'];
//        $Foto10 = $_FILES['UploadFoto10']['name'];
//
//        $tmp_file1 = $_FILES['UploadFoto1']['tmp_name'];
//        $tmp_file2 = $_FILES['UploadFoto2']['tmp_name'];
//        $tmp_file3 = $_FILES['UploadFoto3']['tmp_name'];
//        $tmp_file4 = $_FILES['UploadFoto4']['tmp_name'];
//        $tmp_file5 = $_FILES['UploadFoto5']['tmp_name'];
//        $tmp_file6 = $_FILES['UploadFoto6']['tmp_name'];
//        $tmp_file7 = $_FILES['UploadFoto7']['tmp_name'];
//        $tmp_file8 = $_FILES['UploadFoto8']['tmp_name'];
//        $tmp_file9 = $_FILES['UploadFoto9']['tmp_name'];
//        $tmp_file10 = $_FILES['UploadFoto10']['tmp_name'];
//
//        if ($Foto1 != null) {
//            $Nama1 = $NamaProduk . 1 . ".jpg";
//        } else {
//            $Nama1 = null;
//        }
//
//        if ($Foto2 != null) {
//            $Nama2 = $NamaProduk . 2 . ".jpg";
//        } else {
//            $Nama2 = null;
//        }
//
//        if ($Foto3 != null) {
//            $Nama3 = $NamaProduk . 3 . ".jpg";
//        } else {
//            $Nama3 = null;
//        }
//
//        if ($Foto4 != null) {
//            $Nama4 = $NamaProduk . 4 . ".jpg";
//        } else {
//            $Nama4 = null;
//        }
//
//        if ($Foto5 != null) {
//            $Nama5 = $NamaProduk . 5 . ".jpg";
//        } else {
//            $Nama5 = null;
//        }
//
//        if ($Foto6 != null) {
//            $Nama6 = $NamaProduk . 6 . ".jpg";
//        } else {
//            $Nama6 = null;
//        }
//
//        if ($Foto7 != null) {
//            $Nama7 = $NamaProduk . 7 . ".jpg";
//        } else {
//            $Nama7 = null;
//        }
//
//        if ($Foto8 != null) {
//            $Nama8 = $NamaProduk . 8 . ".jpg";
//        } else {
//            $Nama8 = null;
//        }
//
//        if ($Foto9 != null) {
//            $Nama9 = $NamaProduk . 9 . ".jpg";
//        } else {
//            $Nama9 = null;
//        }
//
//        if ($Foto10 != null) {
//            $Nama10 = $NamaProduk . 10 . ".jpg";
//        } else {
//            $Nama10 = null;
//        }
//
//        $path1 = "../GambarProduk/" . $Nama1;
//        $path2 = "../GambarProduk/" . $Nama2;
//        $path3 = "../GambarProduk/" . $Nama3;
//        $path4 = "../GambarProduk/" . $Nama4;
//        $path5 = "../GambarProduk/" . $Nama5;
//        $path6 = "../GambarProduk/" . $Nama6;
//        $path7 = "../GambarProduk/" . $Nama7;
//        $path8 = "../GambarProduk/" . $Nama8;
//        $path9 = "../GambarProduk/" . $Nama9;
//        $path10 = "../GambarProduk/" . $Nama10;
//
//        move_uploaded_file($tmp_file1, $path1);
//        move_uploaded_file($tmp_file2, $path2);
//        move_uploaded_file($tmp_file3, $path3);
//        move_uploaded_file($tmp_file4, $path4);
//        move_uploaded_file($tmp_file5, $path5);
//        move_uploaded_file($tmp_file6, $path6);
//        move_uploaded_file($tmp_file7, $path7);
//        move_uploaded_file($tmp_file8, $path8);
//        move_uploaded_file($tmp_file9, $path9);
//        move_uploaded_file($tmp_file10, $path10);
//
//        $query = "UPDATE Produk SET NamaProduk = '$NamaProduk', Harga = $Harga, Stock = '$Stock',
//            Kategori = '$Kategori', Deskripsi = '$Deskripsi', Berat = $Berat,
//            Foto1 = '$Nama1', Foto2 = '$Nama2', Foto3 = '$Nama3', Foto4 = '$Nama4', Foto5 = '$Nama5', Foto6 = '$Nama6',
//            Foto7 = '$Nama7', Foto8 = '$Nama8', Foto9 = '$Nama9', Foto10 = '$Nama10'
//            WHERE IDProduk = $SelectWarna";
//        $hasil = mysqli_query($conn, $query);
//
//        if ($hasil) {
//            echo "<script>alert('Update Barang Berhasil')</script>";
//        } else {
//            echo "<script>alert('Update Barang Gagal')</script>";
//        }
//
//    } else {
////        $NamaProduk = $_POST['NamaProduk1'];
////        $Harga = $_POST['Harga1'];
////        $Berat = $_POST['Berat1'];
//        $Stock = $_POST['Stock1'];
////        $Kategori = $_POST['Kategori1'];
////        $Deskripsi = $_POST['Deskripsi1'];
//
//        $query = "UPDATE Produk SET Stock = '$Stock' WHERE IDProduk = $SelectWarna";
//        $hasil = mysqli_query($conn, $query);
//
//        if ($hasil) {
//            echo "<script>alert('Update Barang Berhasil')</script>";
//        } else {
//            echo "<script>alert('Update Barang Gagal')</script>";
//        }
//
//    }
//
//}

$Variasi = explode(',', $a['Variasi']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style type="text/css">
        body{
            background: radial-gradient(circle at top left, #E0FFFF, #AFEEEE);
            font-family: "Comic Sans MS";
        }


        /*CSS OVERLAY LOGIN*/
        #container1{
            position: absolute;
            top: 0px;
            left: 0px;
            right: 0px;
            height: 100%;
            width: 100%;
            /*height: 2880px;*/
            z-index: 9999;
            visibility:hidden;
            background: rgba(0,0,0,.3);
        }
        #container1:target{
            visibility:visible;
        }
        .close {
            width: 30px;
            height: 30px;
            background: #000;
            border-radius: 50%;
            border: 3px solid #fff;
            display: block;
            text-align: center;
            color: #fff;
            text-decoration: none;
            position: absolute;
            top: -10px;
            right: -10px;
            font-size:30px;
        }
        .login-container{
            position: absolute;
            width: 300px;
            height: 300px; /**/
            right: 160px;
            top: 40px;
            /*margin: 80px auto;*/
            padding: 20px 40px 40px;
            text-align: center;
            background: #fff;
            border: 1px solid #ccc;
        }

        #output{
            position: absolute;
            width: 300px;
            top: -75px;
            left: 0;
            color: #fff;
        }

        #output.alert-success{
            background: rgb(25, 204, 25);
        }

        #output.alert-danger{
            background: rgb(228, 105, 105);
        }


        .login-container::before,.login-container::after{
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            top: 3.5px;left: 0;
            background: #fff;
            z-index: -1;
            -webkit-transform: rotateZ(4deg);
            -moz-transform: rotateZ(4deg);
            -ms-transform: rotateZ(4deg);
            border: 1px solid #ccc;
        }

        .login-container::after{
            top: 5px;
            z-index: -2;
            -webkit-transform: rotateZ(-2deg);
            -moz-transform: rotateZ(-2deg);
            -ms-transform: rotateZ(-2deg);
        }

        #avatar1{
            margin: 0px 0px 0px 70px; /*batas atas, batas kanan, batas bawah, batas kiri*/
            width: 100px;
            height: 100px;
            border-radius: 100%;
            background-color:  white;
            border: 2px solid #155799;
        }
        #avatar2{
            position: absolute;
            top: 30px;
            left: 140px;
            width: 100px;
            height: 100px;
            /*margin: 10px auto 30px;*/
            border-radius: 100%;
            /*border: 2px solid #aaa;*/
            border: 2px solid #155799;
            background-size: cover;
        }

        .form-box{
            margin-top: 140px;
        }

        .form-box input{
            width: 100%;
            /*padding: 10px;*/
            text-align: center;
            height:60px;
            border: 1px solid #ccc;;
            background: #fafafa;
            transition:0.2s ease-in-out;
        }

        .form-box input:focus{
            outline: 0;
            background: #eee;
        }

        .form-box input[type="text"]{
            border-radius: 5px 5px 0 0;
            text-transform: lowercase;
        }

        .form-box input[type="password"]{
            border-radius: 0 0 5px 5px;
            border-top: 0;
        }

        .form-box button.login{
            margin-top:15px;
            padding: 10px 20px;

        }

        .animated {
            -webkit-animation-duration: 1s;
            animation-duration: 1s;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
        }

        @-webkit-keyframes fadeInUp {
            0% {
                opacity: 0;
                -webkit-transform: translateY(20px);
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                -webkit-transform: translateY(0);
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                -webkit-transform: translateY(20px);
                -ms-transform: translateY(20px);
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                -webkit-transform: translateY(0);
                -ms-transform: translateY(0);
                transform: translateY(0);
            }
        }

        .fadeInUp {
            -webkit-animation-name: fadeInUp;
            animation-name: fadeInUp;
        }
        /*END CSS OVERLAY LOGIN*/


        /* CSS OVERLAY DAFTAR */
        #container2{
            position: absolute;
            top: 0px;
            left: 0px;
            right: 0px;
            width: 100%;
            height: 100%;
            /*height: 2880px;*/
            z-index: 9999;
            visibility:hidden;
            background: rgba(0,0,0,.3);
        }
        #container2:target{
            visibility:visible;
        }
        .close2 {
            width: 30px;
            height: 30px;
            background: #000;
            border-radius: 50%;
            border: 3px solid #fff;
            display: block;
            text-align: center;
            color: #fff;
            text-decoration: none;
            position: absolute;
            top: -10px;
            right: -10px;
            font-size:30px;
        }
        .login-container2{
            position: absolute;
            width: 300px;
            right: 80px;
            top: 40px;
            /*margin: 80px auto;*/
            padding: 20px 40px 40px;
            text-align: center;
            background: #fff;
            border: 1px solid #ccc;
        }

        #output2{
            position: absolute;
            width: 300px;
            top: -75px;
            left: 0;
            color: #fff;
        }

        #output2.alert-success{
            background: rgb(25, 204, 25);
        }

        #output2.alert-danger{
            background: rgb(228, 105, 105);
        }


        .login-container2::before,.login-container2::after{
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            top: 3.5px;left: 0;
            background: #fff;
            z-index: -1;
            -webkit-transform: rotateZ(4deg);
            -moz-transform: rotateZ(4deg);
            -ms-transform: rotateZ(4deg);
            border: 1px solid #ccc;
        }

        .login-container2::after{
            top: 5px;
            z-index: -2;
            -webkit-transform: rotateZ(-2deg);
            -moz-transform: rotateZ(-2deg);
            -ms-transform: rotateZ(-2deg);
        }


        .form-box2 input{
            width: 100%;
            padding: 10px;
            text-align: center;
            height:20px;
            border: 1px solid #ccc;;
            background: #fafafa;
            transition:0.2s ease-in-out;
        }

        .form-box2 input:focus{
            outline: 0;
            background: #eee;
        }

        .form-box2 input[type="text"]{
            border-radius: 5px 5px 0 0;
            text-transform: lowercase;
        }

        .form-box2 input[type="password"]{
            border-radius: 0 0 5px 5px;
            border-top: 0;
        }

        .form-box2 button.login{
            margin-top:15px;
            padding: 10px 20px;

        }

        .animated {
            -webkit-animation-duration: 1s;
            animation-duration: 1s;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
        }

        @-webkit-keyframes fadeInUp {
            0% {
                opacity: 0;
                -webkit-transform: translateY(20px);
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                -webkit-transform: translateY(0);
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                -webkit-transform: translateY(20px);
                -ms-transform: translateY(20px);
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                -webkit-transform: translateY(0);
                -ms-transform: translateY(0);
                transform: translateY(0);
            }
        }

        .fadeInUp {
            -webkit-animation-name: fadeInUp;
            animation-name: fadeInUp;
        }
        /* END CSS OVERLAY DAFTAR*/


        /*CSS UNTUK SEARCH*/
        #SearchBar{
            position: absolute;
            top: 25px;
            left: 230px;
        }
        #SearchBar:hover{
            box-shadow: 3px 3px 5px #155799;  /*  x y z warna;  X horizontal y vertikal z blur*/
        }
        #btnSearch{
            position: absolute;
            top: 22px;
            left: 650px;
        }
        #btnSearch:hover{
            opacity: 0.7;
        }
        /*CSS UNTUK SEARCH*/


        #tabelAtas{
            position: absolute;
            /*top: 3px;*/
            right: 50px;
            /*border: 2px solid #155799;*/
            height: 35px;
            max-width: 600px;
        }

        #keranjang{
            margin-top: 5px;
            margin-right: 10px;
            /*position: absolute;*/
            /*left: 900px;*/
            /*top: 10px;*/
        }
        #keranjang:hover{
            opacity: 0.7;
        }

        /*CSS BUTTON LOGIN DAN SIGN IN*/
        #btnLogin{
            border: 2px solid #155799;
            max-width: 300px;
            height: 30px;
            margin-right: -5px;
            /*position: absolute;*/
            /*top: 10px;*/
            /*right: 150px;*/
            color: #155799;
            font-family: "Comic Sans MS";
        }
        #btnLogin:hover{
            background-color:  #155799;
            color: white;
            font-family: "Comic Sans MS";
        }
        #btnDaftar{
            border: 2px solid #155799;
            width: 100px;
            height: 30px;
            /*position: absolute;*/
            /*top: 10px;*/
            /*right: 50px;*/
            color: #155799;
            font-family: "Comic Sans MS";
        }
        #btnDaftar:hover{
            background-color:  #155799;
            color: white;
            font-family: "Comic Sans MS";
        }
        /*CSS BUTTON LOGIN DAN SIGN IN*/



        .overlay a {
            padding: 8px;
            text-decoration: none;
            /*font-size: 36px;*/
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .overlay .closebtn {
            position: absolute;
            top: 20px;
            right: 45px;
            font-size: 60px;
        }

        @media screen and (max-height: 450px) {
            .overlay a {font-size: 20px}
            .overlay .closebtn {
                font-size: 40px;
                top: 15px;
                right: 35px;
            }
        }


        #kotakbiru{
            position: absolute;
            top: 0px;
            left: 0px;
            right: 0px;
            /*width: auto;*/
            height: 100px;
            border: 2px solid #155799;
        }

        /*Start CSS Div Profil*/
        h2{
            position: absolute;
            top: 180px;
            left: 550px;
            text-align: center;
            color: #155799;
        }
        #TabelProfil{
            position: absolute;
            top: 280px;
            left: 300px;
            height: 410px;
            width: 670px;
            background-color: #edf5f4;
            border: 2px solid #155799;
            color: #155799;
        }
        .lihatproduk{
            background-color: white;
            color: black;
            border: 2px solid #155799;
            border-radius: 5px;
            box-shadow: 0px 2px 8px 0px rgba(0, 0, 0, 0.2);
            text-align: center;
            margin: 5px 2px;
            padding: 10px 15px;
            cursor: pointer;
        }
        .lihatproduk:hover{
            background-color: #155799;
            color: white;
        }
        /*End CSS Div Profil*/


        /*CSS FOOTER*/
        #footerbawah{
            background-color: black;
            width: 100%;
            position: absolute;
            right: 0px;
            left: 0px;
            top:1150px;
        }
        #tblFooter{
            /*#bdbebd*/
            color: white;
        }
        #tombolsubscribe{
            resize:none;
            width:250px;
            height:35px;
            /*box-shadow: 3px 8px 6px 8px #888888; !*batas atas, batas kanan, batas bawah, batas kiri*!*/
            font-family: "Segoe UI";
        }
        /*END CSS FOOTER*/

        #Back{
            position: absolute;
            top: 20px;
            left: 50px;
        }

        #btnHapus{
            position: absolute;
            top: 130px;
            right: 130px;
            border: 2px solid #155799;
            font-family: "Comic Sans MS";
        }



        a:link {color:white}
        a:visited {color: #E0FFFF}
    </style>

</head>
<body>



<div id="kotakbiru">
<!--    <a href="UpdateBarang.php">-->
        <img src="../Gambar/Back.png" width="55px" height="55px" id="Back" onclick="history.go(-1);">
<!--    </a>-->
</div>


<!--    FUNGSI SEARCH-->
<div id="SearchBar">
    <input type="text" class="searchTerm" placeholder="What are you looking for?"
           style="width: 400px; height: 30px; border: 2px solid  #87CEFA;">
</div>
<div id="btnSearch">
    <a href="#">
        <img src="../Gambar/Search.jpg" width="40px" height="40px">
    </a>
</div>
<!--    FUNGSI SEARCH-->


<table id="tabelAtas">
    <tr>
        <td>
            <!--    Keranjang Belanja-->
<!--            <a href="#">-->
<!--                <img src="../Gambar/Cart.png" width="40px" height="40px" id="keranjang">-->
<!--            </a>-->
            <!--    Keranjang Belanja-->
        </td>
        <td>
            <!--    Login dan Sign In-->
            <a href="#">
                <button id="btnLogin"> <?php echo $_SESSION['Username2']; ?> </button>
            </a>

            <!--                <a href="logout.php">-->
            <button onclick="konfirmasi()" id="btnDaftar">Log out</button>
            <!--                </a>-->
            <!--    Login dan Sign In-->
        </td>
    </tr>
</table>


<a href="HapusBarang.php?id=<?php echo $a['IDProduk']; ?>"
   onclick="return confirm('Yakin Ingin menghapus barang?')">
    <button id="btnHapus" name="HapusBarang" class="lihatproduk"> Hapus </button>
</a>


<h2> UPDATE BARANG </h2>


<!--tr itu baris, td itu kolom-->
<!--2 / 3 kolom, sekian baris-->
<!--Start tabel profil-->


<table id="TabelProfil">
    <form method="POST" enctype="multipart/form-data" action="UpdatePilihBarangLanjutan.php">
        <tr>
            <td>
                <input name="SelectWarna123" id="IDProduk" type="text" value="<?php echo $a['KodeBarang']; ?>" hidden>
<!--                <input name="SelectWarnaaa" id="IDProduk" type="text" value="--><?php //echo $SelectWarna ?><!--">?-->
            </td>
            <td>

            <?php
            $KodeBarang = $a['KodeBarang'];

            $sql3 = "SELECT MIN(IDProduk) FROM Produk WHERE KodeBarang = '$KodeBarang'";
            $result3 = mysqli_query($conn, $sql3);
            $c = mysqli_fetch_array($result3);


            if ($SelectWarna == $c['MIN(IDProduk)']) {

            ?>

<!--                <input id="IDProdukKecil" type="number" value="--><?php //echo $c['MIN(IDProduk)']; ?><!--">-->

            </td>

        </tr>
        <tr>
            <td align="center">
<!--            START TABEL UNTUK ID PRODUK YANG KECIL -->
                <table style="width: 360px; height: 300px; ">
                    <tr>
                        <td>
                            Nama produk
                        </td>
                        <td align="left">
                            :
                        </td>
                        <td>
                            <input name="IDProduk" id="IDProduk" type="number" value="<?php echo $a['IDProduk']; ?>" hidden>
                            <input name="NamaProduk" id="NamaProduk" type="text" value="<?php echo $a['NamaProduk']; ?>"
                                   placeholder="Masukan Nama Produk"
                                   style="border: 2px solid #155799; text-align: left; color: #155799;
                                    font-family: 'Comic Sans MS'; width: 200px; height: 33px;">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Kode barang
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            <input name="KodeProduk" id="KodeProduk" type="text" value="<?php echo $a['KodeBarang']; ?>"
                                   placeholder="Masukan Kode Produk" disabled
                                   style="border: 2px solid #155799; text-align: left; color: #155799; background-color: #cccccc;
                                    font-family: 'Comic Sans MS'; width: 200px; height: 33px;">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Harga
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            <input name="Harga" type="number" value="<?php echo $a['Harga']; ?>" min="1"
                                   placeholder="Masukan Harga Produk"
                                   style="border: 2px solid #155799; text-align: left; color: #155799;
                                    font-family: 'Comic Sans MS'; width: 200px; height: 33px;">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Berat (gram)
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            <input name="Berat" type="number" value="<?php echo $a['Berat']; ?>" min="100"
                                   placeholder="Masukan Berat Produk"
                                   style="border: 2px solid #155799; text-align: left; color: #155799;
                                    font-family: 'Comic Sans MS'; width: 200px; height: 33px;">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Stock
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            <input name="Stock" type="text" value="<?php echo $a['Stock']; ?>" min="100"
                                   placeholder="Masukan Stock Produk"
                                   style="border: 2px solid #155799; text-align: left; color: #155799;
                                    font-family: 'Comic Sans MS'; width: 200px; height: 33px;">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Kategori
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            <select name="Kategori" class="kotakInput"
                                    style="border: 2px solid #155799; text-align: left; color: #155799;
                                    font-family: 'Comic Sans MS'; width: 200px; height: 33px;">
                                <option value="Tas Selempang"> Tas Selempang </option>
                                <option value="Backpack"> Backpack </option>
                                <option value="Tas Pinggang"> Tas Pinggang </option>
                                <option value="Tote Bag"> Tote Bag </option>
                                <option value="Tas Carrier"> Tas Carrier </option>
                                <option value="Travel"> Travel </option>
                                <option value="Tas Laptop"> Tas Laptop </option>
                                <option value="Tas Kantor"> Tas Kantor </option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Variasi
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            <?php
                            $sql9 = "SELECT Variasi FROM Produk WHERE IDProduk = '$SelectWarna'";
                            $result9 = mysqli_query($conn, $sql9);
                            while ($f = mysqli_fetch_array($result9)) {

                            ?>

                                <input type="checkbox" name="Warna" value="<?php echo $f['Variasi']; ?>" checked disabled> <?php echo $f['Variasi']; ?>

                            <?php
                            }

                            ?>
                        </td>
<!--                        <td>-->
<!--                            <input type="checkbox" name="Warna[]" value="Hitam"-->
<!--                                --><?php //if (in_array("Hitam", $Variasi)){echo 'checked';}?><!-- > Hitam <br>-->
<!--                            <input type="checkbox" name="Warna[]" value="Abu"-->
<!--                                --><?php //if (in_array("Abu", $Variasi)){echo 'checked';}?><!-- > Abu <br>-->
<!--                            <input type="checkbox" name="Warna[]" value="Putih"-->
<!--                                --><?php //if (in_array("Putih", $Variasi)){echo 'checked';}?><!-- > Putih <br>-->
<!--                            <input type="checkbox" name="Warna[]" value="Coklat Tua"-->
<!--                                --><?php //if (in_array("Coklat Tua", $Variasi)){echo 'checked';}?><!-- > Coklat Tua <br>-->
<!--                            <input type="checkbox" name="Warna[]" value="Coklat Muda"-->
<!--                                --><?php //if (in_array("Coklat Muda", $Variasi)){echo 'checked';}?><!-- > Coklat Muda <br>-->
<!--                            <input type="checkbox" name="Warna[]" value="Biru Tua"-->
<!--                                --><?php //if (in_array("Biru Tua", $Variasi)){echo 'checked';}?><!-- > Biru Tua <br>-->
<!--                            <input type="checkbox" name="Warna[]" value="Biru Muda"-->
<!--                                --><?php //if (in_array("Biru Muda", $Variasi)){echo 'checked';}?><!-- > Biru Muda <br>-->
<!--                        </td>-->
<!--                        <td>-->
<!--                            <input type="checkbox" name="Warna[]" value="Merah"-->
<!--                                --><?php //if (in_array("Merah", $Variasi)){echo 'checked';}?><!-- > Merah <br>-->
<!--                            <input type="checkbox" name="Warna[]" value="Kuning"-->
<!--                                --><?php //if (in_array("Kuning", $Variasi)){echo 'checked';}?><!-- > Kuning <br>-->
<!--                            <input type="checkbox" name="Warna[]" value="Hijau Tua"-->
<!--                                --><?php //if (in_array("Hijau Tua", $Variasi)){echo 'checked';}?><!-- > Hijau Tua <br>-->
<!--                            <input type="checkbox" name="Warna[]" value="Hijau Muda"-->
<!--                                --><?php //if (in_array("Hijau Muda", $Variasi)){echo 'checked';}?><!-- > Hijau Muda <br>-->
<!--                            <input type="checkbox" name="Warna[]" value="Pink"-->
<!--                                --><?php //if (in_array("Pink", $Variasi)){echo 'checked';}?><!-- > Pink <br>-->
<!--                            <input type="checkbox" name="Warna[]" value="Ungu"-->
<!--                                --><?php //if (in_array("Ungu", $Variasi)){echo 'checked';}?><!-- > Ungu <br>-->
<!--                            <input type="checkbox" name="Warna[]" value="Orange"-->
<!--                                --><?php //if (in_array("Orange", $Variasi)){echo 'checked';}?><!-- > Orange <br>-->
<!--                        </td>-->
                    </tr>
                    <tr>
                        <td>
                            Deskripsi
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            <textarea name="Deskripsi" type="text" placeholder="Masukan Deskripsi Produk"
                                   style="border: 2px solid #155799; text-align: left; color: #155799;
                                    font-family: 'Comic Sans MS'; width: 200px; height: 33px;"> <?php echo $a['Deskripsi']; ?> </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><br>
                            <input name="UploadFoto1" type="file" class="lihatproduk">
                            <input name="UploadFoto2" type="file" class="lihatproduk">
                            <input name="UploadFoto3" type="file" class="lihatproduk">
                            <input name="UploadFoto4" type="file" class="lihatproduk">
                            <input name="UploadFoto5" type="file" class="lihatproduk">
                        </td>
                        <td colspan="4"><br>
                            <input name="UploadFoto6" type="file" class="lihatproduk">
                            <input name="UploadFoto7" type="file" class="lihatproduk">
                            <input name="UploadFoto8" type="file" class="lihatproduk">
                            <input name="UploadFoto9" type="file" class="lihatproduk">
                            <input name="UploadFoto10" type="file" class="lihatproduk">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            Catatan: <br>
                            Foto harus diupload ulang jika ingin mengupdate data barang. <br>
                            Ekstensi file yang diperbolehkan hanya JPG dan PNG. <br>
                            Ukuran file tidak bisa lebih dari 1 MB. <br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" align="center">
                            <br>
                            <button name="SubmitPilihBarang" type="submit" class="lihatproduk"> Submit </button>
                        </td>
                    </tr>
                </table>
<!--            END TABEL UNTUK ID PRODUK YANG KECIL -->

                <?php
                } else {
                ?>

<!--            START TABEL UNTUK ID YANG BESAR -->
                    <table style="width: 500px; height: 300px; margin-left: 100px;">
                        <tr>
                            <td colspan="3">
                                <p>Perhatian: Admin hanya dapat mengedit jumlah stock di halaman ini. Silakan periksa
                                warna lain dengan kode barang yang sama untuk mengedit informasi lain ! </p>
<!--                                <input name="SelectWarna123" id="IDProduk" type="number" value="--><?php //echo $a['KodeBarang']; ?><!--" hidden>-->
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Nama Produk
                            </td>
                            <td align="left">
                                :
                            </td>
                            <td>
                                <input name="IDProduk" id="IDProduk" type="number" value="<?php echo $a['IDProduk']; ?>" hidden>
                                <input name="NamaProduk1" id="NamaProduk" type="text" value="<?php echo $a['NamaProduk']; ?>"
                                       placeholder="Masukan Nama Produk" disabled
                                       style="border: 2px solid #155799; text-align: left; color: #155799; background-color: #cccccc;
                                    font-family: 'Comic Sans MS'; width: 200px; height: 33px;">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Kode Barang
                            </td>
                            <td>
                                :
                            </td>
                            <td>
                                <input name="KodeProduk" id="KodeProduk" type="text" value="<?php echo $a['KodeBarang']; ?>"
                                       placeholder="Masukan Nama Produk" disabled
                                       style="border: 2px solid #155799; text-align: left; color: #155799; background-color: #cccccc;
                                    font-family: 'Comic Sans MS'; width: 200px; height: 33px;">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Harga
                            </td>
                            <td>
                                :
                            </td>
                            <td>
                                <input name="Harga1" type="number" value="<?php echo $a['Harga']; ?>" min="1"
                                       placeholder="Masukan Harga Produk" disabled
                                       style="border: 2px solid #155799; text-align: left; color: #155799; background-color: #cccccc;
                                    font-family: 'Comic Sans MS'; width: 200px; height: 33px;">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Berat (gram)
                            </td>
                            <td>
                                :
                            </td>
                            <td>
                                <input name="Berat1" type="number" value="<?php echo $a['Berat']; ?>" min="100"
                                       placeholder="Masukan Berat Produk" disabled
                                       style="border: 2px solid #155799; text-align: left; color: #155799; background-color: #cccccc;
                                    font-family: 'Comic Sans MS'; width: 200px; height: 33px;">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Stock
                            </td>
                            <td>
                                :
                            </td>
                            <td>
                                <input name="Stock" type="text" value="<?php echo $a['Stock']; ?>" min="100"
                                       placeholder="Masukan Stock Produk"
                                       style="border: 2px solid #155799; text-align: left; color: #155799;
                                    font-family: 'Comic Sans MS'; width: 200px; height: 33px;">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Kategori
                            </td>
                            <td>
                                :
                            </td>
                            <td>
                                <select name="Kategori1" class="kotakInput" disabled
                                        style="border: 2px solid #155799; text-align: left; color: #155799; background-color: #cccccc;
                                    font-family: 'Comic Sans MS'; width: 200px; height: 33px;">
                                    <option value="Tas Selempang"> Tas Selempang </option>
                                    <option value="Backpack"> Backpack </option>
                                    <option value="Tas Pinggang"> Tas Pinggang </option>
                                    <option value="Tote Bag"> Tote Bag </option>
                                    <option value="Tas Carrier"> Tas Carrier </option>
                                    <option value="Travel"> Travel </option>
                                    <option value="Tas Laptop"> Tas Laptop </option>
                                    <option value="Tas Kantor"> Tas Kantor </option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Variasi
                            </td>
                            <td>
                                :
                            </td>
                            <td>
                                <?php
                                $sql9 = "SELECT Variasi FROM Produk WHERE IDProduk = '$SelectWarna'";
                                $result9 = mysqli_query($conn, $sql9);
                                while ($f = mysqli_fetch_array($result9)) {

                                    ?>

                                    <input type="checkbox" name="Warna1" value="<?php echo $f['Variasi']; ?>" checked disabled> <?php echo $f['Variasi']; ?>

                                    <?php
                                }

                                ?>
                            </td>
                            <!--                        <td>-->
                            <!--                            <input type="checkbox" name="Warna[]" value="Hitam"-->
                            <!--                                --><?php //if (in_array("Hitam", $Variasi)){echo 'checked';}?><!-- > Hitam <br>-->
                            <!--                            <input type="checkbox" name="Warna[]" value="Abu"-->
                            <!--                                --><?php //if (in_array("Abu", $Variasi)){echo 'checked';}?><!-- > Abu <br>-->
                            <!--                            <input type="checkbox" name="Warna[]" value="Putih"-->
                            <!--                                --><?php //if (in_array("Putih", $Variasi)){echo 'checked';}?><!-- > Putih <br>-->
                            <!--                            <input type="checkbox" name="Warna[]" value="Coklat Tua"-->
                            <!--                                --><?php //if (in_array("Coklat Tua", $Variasi)){echo 'checked';}?><!-- > Coklat Tua <br>-->
                            <!--                            <input type="checkbox" name="Warna[]" value="Coklat Muda"-->
                            <!--                                --><?php //if (in_array("Coklat Muda", $Variasi)){echo 'checked';}?><!-- > Coklat Muda <br>-->
                            <!--                            <input type="checkbox" name="Warna[]" value="Biru Tua"-->
                            <!--                                --><?php //if (in_array("Biru Tua", $Variasi)){echo 'checked';}?><!-- > Biru Tua <br>-->
                            <!--                            <input type="checkbox" name="Warna[]" value="Biru Muda"-->
                            <!--                                --><?php //if (in_array("Biru Muda", $Variasi)){echo 'checked';}?><!-- > Biru Muda <br>-->
                            <!--                        </td>-->
                            <!--                        <td>-->
                            <!--                            <input type="checkbox" name="Warna[]" value="Merah"-->
                            <!--                                --><?php //if (in_array("Merah", $Variasi)){echo 'checked';}?><!-- > Merah <br>-->
                            <!--                            <input type="checkbox" name="Warna[]" value="Kuning"-->
                            <!--                                --><?php //if (in_array("Kuning", $Variasi)){echo 'checked';}?><!-- > Kuning <br>-->
                            <!--                            <input type="checkbox" name="Warna[]" value="Hijau Tua"-->
                            <!--                                --><?php //if (in_array("Hijau Tua", $Variasi)){echo 'checked';}?><!-- > Hijau Tua <br>-->
                            <!--                            <input type="checkbox" name="Warna[]" value="Hijau Muda"-->
                            <!--                                --><?php //if (in_array("Hijau Muda", $Variasi)){echo 'checked';}?><!-- > Hijau Muda <br>-->
                            <!--                            <input type="checkbox" name="Warna[]" value="Pink"-->
                            <!--                                --><?php //if (in_array("Pink", $Variasi)){echo 'checked';}?><!-- > Pink <br>-->
                            <!--                            <input type="checkbox" name="Warna[]" value="Ungu"-->
                            <!--                                --><?php //if (in_array("Ungu", $Variasi)){echo 'checked';}?><!-- > Ungu <br>-->
                            <!--                            <input type="checkbox" name="Warna[]" value="Orange"-->
                            <!--                                --><?php //if (in_array("Orange", $Variasi)){echo 'checked';}?><!-- > Orange <br>-->
                            <!--                        </td>-->
                        </tr>
                        <tr>
                            <td>
                                Deskripsi
                            </td>
                            <td>
                                :
                            </td>
                            <td>
                            <textarea name="Deskripsi1" type="text" placeholder="Masukan Deskripsi Produk" disabled
                                      style="border: 2px solid #155799; text-align: left; color: #155799; background-color: #cccccc;
                                    font-family: 'Comic Sans MS'; width: 200px; height: 33px;"> <?php echo $a['Deskripsi']; ?> </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" align="center">
                                <br>
                                <button name="SubmitPilihBarang" type="submit" class="lihatproduk"> Submit </button>
                            </td>
                        </tr>
                    </table>
<!--            END TABEL UNTUK ID YANG BESAR -->

                <?php
                }
                ?>
            </td>
        </tr>
    </form>
</table>

<?php
}
?>
<!--End tabel profil-->



<script>
    function openNav() {
        document.getElementById("myNav").style.width = "20%";
    }

    function closeNav() {
        document.getElementById("myNav").style.width = "0%";
    }
</script>



<!--START SCRIPT ALERT KONFIRM-->
<script>
    function konfirmasi(){
        var tanya = confirm("Apakah Anda yakin ingin Logout ?");

        if(tanya == true) {
            window.location.href = "logout.php";
        }else{
            location.reload();
        }
    }
</script>
<!--END SCRIPT ALERT KONFIRM-->



<!-- OVERLAY LOGIN -->
<div class="container" id="container1">
    <div class="login-container">
        <a href="#" class="close"> X </a>
        <div id="output"></div>
        <div id="avatar2"> </div>
        <div class="form-box">
            <form action="" method="">
                <input name="username" type="text" placeholder="username" style="height: 35px">
                <input type="password" placeholder="password" style="height: 35px">
                <button class="btn btn-info btn-block login" type="submit">Login</button>
            </form>
        </div>
    </div>
</div>
<!-- END OVERLAY LOGIN-->


<!-- OVERLAY DAFTAR-->
<div class="container2" id="container2">
    <div class="login-container2">
        <a href="#" class="close2"> X </a>
        <div id="output2"></div>
        <div class="form-box2">
            <form action="" method="">
                <input name="namaDepan" type="text" placeholder="Nama Depan">
                <input name="namaBelakang" type="text" placeholder="Nama Belakang">
                <input name="email" type="email" placeholder="Email">
                <input name="password1" type="password" placeholder="Password">
                <input name="password2" type="password" placeholder="Ketik Ulang Password">
                <button class="btn btn-info btn-block login" type="submit">Login</button>
            </form>
        </div>
    </div>
</div>
<!-- END OVERLAY DAFTAR-->



<!--FOOTER YANG PALING BAWAH-->
<footer>
    <div id="footerbawah">
        <table id="tblFooter">
            <tr>
                <td width="30%" align="center">
                    Hotline: 1234567890 <br>
                    Email: abc@gmail.com

                </td>
                <td width="35%">
                    <a href=""> CARA MEMESAN </a><br><br>
                    <a href=""> INFORMASI PENGIRIMAN </a><br><br>
                    <a href=""> GARANSI </a><br><br>
                    <a href=""> KONFIRMASI PEMBAYARAN </a><br><br>
                </td>
                <td>
                    <br>
                    Newsletter
                    <br><br>
                    Jadilah orang pertama yang mendapatkan penawaran eksklusif dan produk terbaru.
                    <br><br>
                    <textarea placeholder="YOUR EMAIL ADRESS" rows="3" id="tombolsubscribe"></textarea>
                    <br><br>
                    <a href=""> <button class="lihatproduk"> SUBSCRIBE </button></a>
                    <br><br>
                </td>
            </tr>
        </table>
    </div>
</footer>
<!--END FOOTER YANG PALING BAWAH-->


</body>
</html>