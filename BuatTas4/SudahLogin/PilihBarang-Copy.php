<?php
include '../Function/config.php';


session_start();

if (!isset($_SESSION['Username'])) {
    header("Location: ../index.php");
}

$id = $_GET['id'] ;

$sql = "SELECT * FROM Produk WHERE IDProduk = ". $id;
$result = mysqli_query($conn, $sql);

while ($a = mysqli_fetch_array($result)){

//START TAMBAH KE KERANJANG

if (isset($_POST['SubmitKeranjang'])) {
    if (isset($_POST['Warna'])) {
        if ($_POST['Jumlah'] == null ){
            echo "<script>alert('Jumlah tidak boleh dikosongkan')</script>";
        } else{

            $Username = $_SESSION['Username'];
            $sql2 = "SELECT * FROM User WHERE Username = '$Username'";
            $result2 = mysqli_query($conn, $sql2);

            while ($b = mysqli_fetch_array($result2)) {
                $KodeProduk = $a['KodeBarang'];
                $IDUser = $b['IDUser'];
                $Jumlah = $_POST['Jumlah'];
                $Warna = $_POST['Warna'];

                $sql3 = "SELECT * FROM Produk WHERE KodeBarang = '$KodeProduk' AND Variasi = '$Warna'";
                $result3 = mysqli_query($conn, $sql3);
                while ($c = mysqli_fetch_array($result3)) {

                    $Berat = $c['Berat'];
                    $Harga = $c['Harga'];
                    $TotalBelanjaan = $Harga * $Jumlah;
                    $IDProduk = $c['IDProduk'];

                    $sql4 = "SELECT * FROM Keranjang WHERE IDProduk = $IDProduk";
                    $result4 = mysqli_query($conn, $sql4);
                    $JumlahData = mysqli_num_rows($result4);
                    //            Kalau Jumlah data keranjang dengan Kode produk $KodeProduk dan Variasi $Variasi kurang dari 1... INSERT ...
                    if ($JumlahData < 1) {

                        $sql5 = "INSERT INTO Keranjang (IDProduk, IDUser, JumlahBarang, TotalBelanjaan, JumlahBerat)
                    VALUES ($IDProduk, $IDUser, $Jumlah, $TotalBelanjaan, ($Berat * $Jumlah))";
                        $result5 = mysqli_query($conn, $sql5);

                        if ($result5) {
                            echo "<script>alert('Berhasil Tambah ke Keranjang')</script>";
                        } else {
                            echo "<script>alert('Gagal Tambah ke Keranjang')</script>";
                        }
                    } else {
                        $sql6 = "SELECT * FROM Keranjang 
                WHERE IDProduk = $IDProduk AND IDTransaksi IS NULL AND IDUser = $IDUser";
                        $result6 = mysqli_query($conn, $sql6);

                        $JumlahData2 = mysqli_num_rows($result6);
                        //            Kalau barang dgn id tertentu ada warna yg dimaksud  lebih dari 1 di tabel...
                        if ($JumlahData2 >= 1) {
                            $query = "UPDATE Keranjang SET JumlahBarang = (JumlahBarang + $Jumlah), 
                    TotalBelanjaan = ($Harga * JumlahBarang), JumlahBerat = ($Berat * JumlahBarang )
                    WHERE IDProduk = $IDProduk AND IDTransaksi IS NULL AND IDUser = $IDUser";
                            $hasil = mysqli_query($conn, $query);

                            if ($hasil) {
                                echo "<script>alert('Berhasil Tambah ke Keranjang')</script>";
                            } else {
                                echo "<script>alert('Gagal Tambah ke Keranjang')</script>";
                            }
                        } else {
                            $sql7 = "INSERT INTO Keranjang (IDProduk, IDUser, JumlahBarang, TotalBelanjaan, JumlahBerat)
                    VALUES ($IDProduk, $IDUser, $Jumlah, $TotalBelanjaan, ($Berat * $Jumlah))";
                            $result7 = mysqli_query($conn, $sql7);
                            if ($result7) {
                                echo "<script>alert('Berhasil Tambah ke Keranjang')</script>";
                            } else {
                                echo "<script>alert('Gagal Tambah ke Keranjang')</script>";
                            }
                        }
                    }



                }
            }

        }
    }else {
        echo "<script>alert('Warna harus dipilih')</script>";
    }
}

//END TAMBAH KE KERANJANG

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <style type="text/css">
        body {
            background: radial-gradient(circle at top left, #E0FFFF, #AFEEEE);
            font-family: "Comic Sans MS";
        }


        /*CSS OVERLAY LOGIN*/
        #container1 {
            position: absolute;
            top: 0px;
            left: 0px;
            right: 0px;
            height: 100%;
            width: 100%;
            /*height: 2880px;*/
            z-index: 9999;
            visibility: hidden;
            background: rgba(0, 0, 0, .3);
        }

        #container1:target {
            visibility: visible;
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
            font-size: 30px;
        }

        .login-container {
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

        #output {
            position: absolute;
            width: 300px;
            top: -75px;
            left: 0;
            color: #fff;
        }

        #output.alert-success {
            background: rgb(25, 204, 25);
        }

        #output.alert-danger {
            background: rgb(228, 105, 105);
        }


        .login-container::before, .login-container::after {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            top: 3.5px;
            left: 0;
            background: #fff;
            z-index: -1;
            -webkit-transform: rotateZ(4deg);
            -moz-transform: rotateZ(4deg);
            -ms-transform: rotateZ(4deg);
            border: 1px solid #ccc;
        }

        .login-container::after {
            top: 5px;
            z-index: -2;
            -webkit-transform: rotateZ(-2deg);
            -moz-transform: rotateZ(-2deg);
            -ms-transform: rotateZ(-2deg);
        }

        #avatar1 {
            margin: 0px 0px 0px 70px; /*batas atas, batas kanan, batas bawah, batas kiri*/
            width: 100px;
            height: 100px;
            border-radius: 100%;
            background-color: white;
            border: 2px solid #155799;
        }

        #avatar2 {
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

        .form-box {
            margin-top: 140px;
        }

        .form-box input {
            width: 100%;
            /*padding: 10px;*/
            text-align: center;
            height: 60px;
            border: 1px solid #ccc;;
            background: #fafafa;
            transition: 0.2s ease-in-out;
        }

        .form-box input:focus {
            outline: 0;
            background: #eee;
        }

        .form-box input[type="text"] {
            border-radius: 5px 5px 0 0;
            text-transform: lowercase;
        }

        .form-box input[type="password"] {
            border-radius: 0 0 5px 5px;
            border-top: 0;
        }

        .form-box button.login {
            margin-top: 15px;
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
        #container2 {
            position: absolute;
            top: 0px;
            left: 0px;
            right: 0px;
            width: 100%;
            height: 100%;
            /*height: 2880px;*/
            z-index: 9999;
            visibility: hidden;
            background: rgba(0, 0, 0, .3);
        }

        #container2:target {
            visibility: visible;
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
            font-size: 30px;
        }

        .login-container2 {
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

        #output2 {
            position: absolute;
            width: 300px;
            top: -75px;
            left: 0;
            color: #fff;
        }

        #output2.alert-success {
            background: rgb(25, 204, 25);
        }

        #output2.alert-danger {
            background: rgb(228, 105, 105);
        }


        .login-container2::before, .login-container2::after {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            top: 3.5px;
            left: 0;
            background: #fff;
            z-index: -1;
            -webkit-transform: rotateZ(4deg);
            -moz-transform: rotateZ(4deg);
            -ms-transform: rotateZ(4deg);
            border: 1px solid #ccc;
        }

        .login-container2::after {
            top: 5px;
            z-index: -2;
            -webkit-transform: rotateZ(-2deg);
            -moz-transform: rotateZ(-2deg);
            -ms-transform: rotateZ(-2deg);
        }


        .form-box2 input {
            width: 100%;
            padding: 10px;
            text-align: center;
            height: 20px;
            border: 1px solid #ccc;;
            background: #fafafa;
            transition: 0.2s ease-in-out;
        }

        .form-box2 input:focus {
            outline: 0;
            background: #eee;
        }

        .form-box2 input[type="text"] {
            border-radius: 5px 5px 0 0;
            text-transform: lowercase;
        }

        .form-box2 input[type="password"] {
            border-radius: 0 0 5px 5px;
            border-top: 0;
        }

        .form-box2 button.login {
            margin-top: 15px;
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
        #SearchBar {
            position: absolute;
            top: 25px;
            left: 230px;
        }

        #SearchBar:hover {
            box-shadow: 3px 3px 5px #155799; /*  x y z warna;  X horizontal y vertikal z blur*/
        }

        #btnSearch {
            position: absolute;
            top: 22px;
            left: 650px;
        }

        #btnSearch:hover {
            opacity: 0.7;
        }

        /*CSS UNTUK SEARCH*/


        #tabelAtas {
            position: absolute;
            /*top: 3px;*/
            right: 50px;
            /*border: 2px solid #155799;*/
            height: 35px;
            max-width: 600px;
        }

        #keranjang {
            margin-top: 5px;
            margin-right: 10px;
            /*position: absolute;*/
            /*left: 900px;*/
            /*top: 10px;*/
        }

        #keranjang:hover {
            opacity: 0.7;
        }

        /*CSS BUTTON LOGIN DAN SIGN IN*/
        #btnLogin {
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

        #btnLogin:hover {
            background-color: #155799;
            color: white;
            font-family: "Comic Sans MS";
        }

        #btnDaftar {
            border: 2px solid #155799;
            width: 100px;
            height: 30px;
            /*position: absolute;*/
            /*top: 10px;*/
            /*right: 50px;*/
            color: #155799;
            font-family: "Comic Sans MS";
        }

        #btnDaftar:hover {
            background-color: #155799;
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
            .overlay a {
                font-size: 20px
            }

            .overlay .closebtn {
                font-size: 40px;
                top: 15px;
                right: 35px;
            }
        }


        #kotakbiru {
            position: absolute;
            top: 0px;
            left: 0px;
            right: 0px;
            /*width: auto;*/
            height: 100px;
            border: 2px solid #155799;
        }


        #foto1 {
            position: absolute;
            top: 200px;
            left: 160px;
            height: 370px;
            width: 270px;
            background-color: #edf5f4;
            border-radius: 3%;
            border: 2px solid #155799;
            text-align: center;
        }

        #TabelBeli {
            position: absolute;
            top: 200px;
            left: 460px;
            height: 370px;
            width: 600px;
            padding-left: 30px;
            background-color: #edf5f4;
            border-radius: 3%;
            border: 2px solid #155799;
            font-family: "Comic Sans MS";
            color: #155799;
            /*text-align: center;*/
        }

        #TabelDeskripsi {
            position: absolute;
            top: 650px;
            left: 160px;
            height: 370px;
            width: 900px;
            padding-top: 30px;
            padding-bottom: 30px;
            padding-left: 30px;
            padding-right: 30px;
            border-radius: 3%;
            background-color: #edf5f4;
            border: 2px solid #155799;
            color: #155799;
        }

        .lihatproduk {
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

        .lihatproduk:hover {
            background-color: #155799;
            color: white;
        }


        /*CSS FOOTER*/
        #footerbawah {
            background-color: black;
            width: 100%;
            position: absolute;
            right: 0px;
            left: 0px;
            top: 1200px;
        }

        #tblFooter {
            /*#bdbebd*/
            color: white;
        }

        #tombolsubscribe {
            resize: none;
            width: 250px;
            height: 35px;
            /*box-shadow: 3px 8px 6px 8px #888888; !*batas atas, batas kanan, batas bawah, batas kiri*!*/
            font-family: "Segoe UI";
        }

        /*END CSS FOOTER*/

        #Back {
            position: absolute;
            top: 20px;
            left: 50px;
        }


        .btnJumlah {
            margin-top: 50px;
            border: 2px solid #155799;
            text-align: center;
            width: 40px;
            height: 40px;
            font-family: "Comic Sans MS";
        }

        .btnJumlah:hover {
            background-color: #155799;
            color: white;
        }


        .slideshow *{box-sizing:border-box}

        /* GAMBAR */
        .slideshow .gambar{position:relative}
        .slideshow .gambar .mySlides {position:relative;display: none}
        .slideshow .gambar .mySlides img{max-width:100%}

        /* PREV-NEXT */
        .slideshow .prev,
        .slideshow .next {position:absolute; top:50%; cursor:pointer;
            width:auto; margin-top:-22px; padding:16px; color: black;
            font-weight:bold; font-size:18px; transition:0.6s ease;
            border-radius:0 3px 3px 0; user-select:none}
        .slideshow .prev:before {content:"\276E"}
        .slideshow .next:before {content:"\276F"}
        .slideshow .next{right:0;border-radius:3px 0 0 3px}
        .slideshow .prev{left:0;border-radius:3px 0 0 3px}
        .slideshow .prev:hover,
        .slideshow .next:hover {background-color:rgba(0,0,0,0.8)}
        /*    END CSS SLIDE SHOW PERTAMA*/


        a:link {
            color: white
        }
        a:visited {
            color: #E0FFFF
        }
    </style>

</head>
<body>


<div id="kotakbiru">
    <a href="Shop.php">
        <img src="../Gambar/Back.png" width="55px" height="55px" id="Back">
    </a>
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

<?php
//$Username10 = $_SESSION['Username'];
//
//$sql10 = "SELECT * FROM User WHERE Username = '$Username10'";
//$result10 = mysqli_query($conn, $sql10);
//
//while ($z = mysqli_fetch_array($result10)){

?>
<table id="tabelAtas">
    <tr>
        <td>
            <!--    Keranjang Belanja-->
            <a href="Keranjang.php?id=<?php echo $_SESSION['Username']; ?>">
                <img src="../Gambar/Cart.png" width="40px" height="40px" id="keranjang">
            </a>
            <!--    Keranjang Belanja-->

            <?php
            //            }
            ?>
        </td>
        <td>
            <!--    Login dan Sign In-->
            <a href="Profil.php">
                <button id="btnLogin"> <?php echo $_SESSION['Username']; ?> </button>
            </a>

            <!--                <a href="logout.php">-->
            <button onclick="konfirmasi()" id="btnDaftar">LOG OUT</button>
            <!--                </a>-->
            <!--    Login dan Sign In-->
        </td>
    </tr>
</table>


<!--START FOTO BESAR-->
<table id="foto1">
    <tr>
        <td>
            <div class="slideshow" id="SlideShow1">
                <div class="gambar">
                    <?php
                    if (!empty($a['Foto1'])) {
                        ?>
                        <div class="mySlides Show1">
                            <img src="../GambarProduk/<?php echo $a['Foto1']; ?>"
                                 style="max-width: 230px; max-height: 330px;">
                        </div>
                        <?php
                    }


                    if (!empty($a['Foto2'])) {
                        ?>
                        <div class="mySlides Show1">
                            <img src="../GambarProduk/<?php echo $a['Foto2']; ?>"
                                 style="max-width: 230px; max-height: 330px;">
                        </div>
                        <?php
                    }


                    if (!empty($a['Foto3'])) {
                        ?>
                        <div class="mySlides Show1">
                            <img src="../GambarProduk/<?php echo $a['Foto3']; ?>"
                                 style="max-width: 230px; max-height: 330px;">
                        </div>
                        <?php
                    }


                    if (!empty($a['Foto4'])) {
                        ?>
                        <div class="mySlides Show1">
                            <img src="../GambarProduk/<?php echo $a['Foto4']; ?>"
                                 style="max-width: 230px; max-height: 330px;">
                        </div>
                        <?php
                    }


                    if (!empty($a['Foto5'])) {
                        ?>
                        <div class="mySlides Show1">
                            <img src="../GambarProduk/<?php echo $a['Foto5']; ?>"
                                 style="max-width: 230px; max-height: 330px;">
                        </div>
                        <?php
                    }


                    if (!empty($a['Foto6'])) {
                        ?>
                        <div class="mySlides Show1">
                            <img src="../GambarProduk/<?php echo $a['Foto6']; ?>"
                                 style="max-width: 230px; max-height: 330px;">
                        </div>
                        <?php
                    }


                    if (!empty($a['Foto7'])) {
                        ?>
                        <div class="mySlides Show1">
                            <img src="../GambarProduk/<?php echo $a['Foto7']; ?>"
                                 style="max-width: 230px; max-height: 330px;">
                        </div>
                        <?php
                    }


                    if (!empty($a['Foto8'])) {
                        ?>
                        <div class="mySlides Show1">
                            <img src="../GambarProduk/<?php echo $a['Foto8']; ?>"
                                 style="max-width: 230px; max-height: 330px;">
                        </div>
                        <?php
                    }


                    if (!empty($a['Foto9'])) {
                        ?>
                        <div class="mySlides Show1">
                            <img src="../GambarProduk/<?php echo $a['Foto9']; ?>"
                                 style="max-width: 230px; max-height: 330px;">
                        </div>
                        <?php
                    }


                    if (!empty($a['Foto10'])) {
                        ?>
                        <div class="mySlides Show1">
                            <img src="../GambarProduk/<?php echo $a['Foto10']; ?>"
                                 style="max-width: 230px; max-height: 330px;">
                        </div>
                        <?php
                    }
                    ?>

                    <a class="prev" onclick="plusSlides(-1,0)"></a>
                    <a class="next" onclick="plusSlides(1,0)"></a>
                </div>
            </div>
        </td>
    </tr>
</table>
<!--END FOTO BESAR-->


<!--START tabel beli-->
<div id="TabelBeli">
    <?php


    echo "<h2>" . $a['NamaProduk'] . "</h2>" ;
    echo "<h3>" . "Rp" . number_format($a['Harga'],0,'','.') . "</h3>"  ;
    echo "Berat:  " . $a['Berat'] . " gram <br><br>";
    //    echo "<caption> Kategori: " . $a['Kategori'] . "</caption>";
    //    echo "<input type='checkbox' name='Warna[]' value=''>";
    //    echo "Warna: <div>" . $a['Variasi'];
//    $Variasi = explode(',', $a['Variasi']);
    $Variasi = $a['Variasi'];
    ?>
    <form method="POST">

        <?php
        //    $Warna1 = ($_POST['Warna'] == 'checked');
        //
        //    if ($Warna1 > 2){
        //        echo "<script>alert('Tidak bisa memilih lebih dari 1')</script>";
        //    }
        $sql9 = "SELECT Variasi FROM Produk";
        $result9 = mysqli_query($conn, $sql9);
        while ($f = mysqli_fetch_array($result9)) {

        ?>
            <input type="checkbox" name="Warna" value="<?php echo $f['Variasi']; ?>"> <?php echo $f['Variasi']; ?>

        <?php
        }

        ?>
        <br>

        <button name="TambahJumlah" id="TambahJumlah" class="btnJumlah" type="button"> +</button>
        <input name="Jumlah" type="number" id="Jumlah" min="1"
               style="border: 2px solid #155799; text-align: center; width: 43px; height: 33px;">
        <button name="KurangJumlah" id="KurangJumlah" class="btnJumlah" type="button"> -</button>
        <br>

        <button name="SubmitKeranjang" id="SubmitKeranjang" class="lihatproduk"
                style="margin-top: 20px" type="submit" > TAMBAH KE KERANJANG
        </button>

    </form>
</div>
<!--END tabel beli-->


<!--START tabel deskripsi-->
<div id="TabelDeskripsi">
    <h3> DESKRIPSI </h3>
    <?php

    echo nl2br($a['Deskripsi']);

    }
    ?>
</div>
<!--END tabel deskripsi-->


<script>
    function openNav() {
        document.getElementById("myNav").style.width = "20%";
    }

    function closeNav() {
        document.getElementById("myNav").style.width = "0%";
    }
</script>


<!--SCRIPT SLIDE SHOW-->
<script>
    var slideIndex = [1]; // TAMBAH "1" SETIAP ADA TAMBAHAN SLIDESHOW
    var slideId = ["Show1"] // TAMBAH "Show[no]" SETIAP ADA TAMBAHAN SLIDESHOW
    showSlides(1, 0);
    // TAMBAH "showSlides(1,[no])" SETIAP ADA TAMBAHAN SLIDESHOW

    function plusSlides(n, no) {
        showSlides(slideIndex[no] += n, no);
    }

    function showSlides(n, no) {
        var i;
        var x = document.getElementsByClassName(slideId[no]);
        if (n > x.length) {slideIndex[no] = 1}
        if (n < 1) {slideIndex[no] = x.length}
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        x[slideIndex[no]-1].style.display = "block";
    }
</script>
<!--END SCRIPT SLIDE SHOW-->


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


<!--START SCRIPT TOMBOL TAMBAH KURANG-->
<script>
    var tambah = document.getElementById('TambahJumlah');
    var kurang = document.getElementById("KurangJumlah");
    var hasil = document.getElementById("Jumlah");
    var no = 1;
    tambah.onclick = function(){
        hasil.value = no++;
    };
    kurang.onclick = function(){
        hasil.value = no--;
    };

</script>
<!--END SCRIPT TOMBOL TAMBAH KURANG-->


<!--START SCRIPT MEMBATASI JUMLAH CHECKBOX-->
<script>
    $(document).ready(function(){
        // paket sesuai yang diambil dari name pada input
        $("input[name='Warna[]']").change(function() {
            // variable untuk jumlah limit sesuaikan saja dengan keinginan
            var maxpil = 1;
            // variable untuk jumlah data yang dipilih atau di checklist
            // jika melebihi dari variable limit maka akan diberikan warning
            var jml = $("input[name='Warna[]']:checked").length;
            if(jml > maxpil){
                $(this).prop("checked","");
                alert('Anda dapat memilih maksimal '+ maxpil +' warna, input ulang jika ingin memilih warna lain');
            }

        });
    });
</script>
<!--END SCRIPT MEMBATASI JUMLAH CHECKBOX-->


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