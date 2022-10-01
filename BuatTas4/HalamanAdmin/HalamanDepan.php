<?php

session_start();

if (!isset($_SESSION['Username2'])) {
    header("Location: ../index.php");
}

include '../Function/config.php';
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


        /*START CSS BUTTON LOGIN DAN SIGN IN*/
        #btnLogin{
            border: 2px solid #155799;
            width: 100px;
            height: 30px;
            position: absolute;
            top: 25px;
            right: 150px;
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
            position: absolute;
            top: 25px;
            right: 50px;
            color: #155799;
            font-family: "Comic Sans MS";
        }
        #btnDaftar:hover{
            background-color:  #155799;
            color: white;
            font-family: "Comic Sans MS";
        }
        /*END CSS BUTTON LOGIN DAN SIGN IN*/



        .overlay {
            height: 100%;
            width: 0;
            position: absolute;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0, 0.9);
            overflow-x: hidden;
            transition: 0.5s;
        }

        .overlay-content {
            position: absolute;
            top: 13%;
            width: 100%;
            text-align: center;
            margin-top: 30px;
        }

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
        .btnMenu {
            float:left;
            width: 300px;
            margin: 0px 30px 0px 40px; /*batas atas, batas kanan, batas bawah, batas kiri*/
            /* }*/
            /*#menu1, #menu2, #menu3, #menu4, #menu5{*/
            width: 60px;
            height: 60px;
            border: 2px solid #155799;
            background-color:  white;
            border-radius: 100%;
        }
        .TulisanMenu{
            float:left;
            margin: 20px 0px 0px 0px; /*batas atas, batas kanan, batas bawah, batas kiri*/
            color: white;
        }
        #menu1{
            background: url("../Gambar/Home.png");
            border-radius: 100%;
            background-size: 100%;
        }
        #menu2{
            background: url("../Gambar/Kategori.png");
            border-radius: 100%;
            background-size: 100%;
        }
        #menu3{
            background: url("../Gambar/Shop.png");
            border-radius: 100%;
            background-size: 100%;
        }
        #menu4{
            background: url("../Gambar/News.png");
            border-radius: 100%;
            background-size: 100%;
        }
        #menu5{
            background: url("../Gambar/Lamp.png");
            border-radius: 100%;
            background-size: 100%;
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

        /*h2{*/
        /*    position: absolute;*/
        /*    top: 140px;*/
        /*    left: 600px;*/
        /*    text-align: center;*/
        /*}*/

        /*MULAI CSS KOTAK BARANG*/
        #kotakbesarbarang{
            position: absolute;
            top: 250px;
            right: 0px;
            left: 150px;
            width: 990px;
            max-height: 2800px;
            /*border: 2px solid #155799;*/
        }

        #kotakkecilbarang{
            Position: relative;
            width: 180px;
            height: 280px;
            border-radius: 5%;
            color: #155799;
            font-size: 13px;
            text-align: center;
            border: 2px solid #155799;
            float: left;
            margin-right: 12px;
            margin-bottom: 12px;
        }
        /*SELESAI KOTAK BARANG*/

        #Back{
            position: absolute;
            top: 20px;
            left: 50px;
        }

        h2{
            position: absolute;
            top: 140px;
            left: 430px;
            text-align: center;
            color: #155799;
        }


        #tabelBelanjaan{
            width: 750px;
            color: #155799;
            border: 2px solid #155799;
            background-color: #edf5f4;
            /*text-align: center;*/
            margin-left: 20px;
        }

        #spasi{
            position: absolute;
            top: 250px;
            left: 260px;
            width: 800px;
        }


        .lihatproduk2{
            background-color: white;
            color: #155799;
            border: 2px solid #155799;
            /*border-radius: 5px;*/
            box-shadow: 0px 2px 8px 0px rgba(0, 0, 0, 0.2);
            text-align: center;
            margin: -3px -3px;
            padding: 10px 15px;
            cursor: pointer;
        }
        .lihatproduk2:hover{
            background-color: #155799;
            color: white;
        }

        .lihatproduk3{
            background-color: white;
            color: #155799;
            border: 2px solid #155799;
            /*border-radius: 5px;*/
            box-shadow: 0px 2px 8px 0px rgba(0, 0, 0, 0.2);
            text-align: center;
            margin: -5px -5px;
            padding: 10px 15px;
        }

        .lihatproduk4{
            background-color: white;
            color: #155799;
            border: 2px solid #155799;
            /*border-radius: 5px;*/
            box-shadow: 0px 2px 8px 0px rgba(0, 0, 0, 0.2);
            text-align: center;
            margin: -5px -5px;
            padding: 5px 5px;
        }



        /*a:link {color:white}*/
        /*a:visited {color: #E0FFFF}*/
    </style>

</head>
<body>

<div id="kotakbiru">
    <a href="berhasil_login.php">
        <img src="../Gambar/Back.png" width="55px" height="55px" id="Back">
    </a>
</div>


<table id="tabelAtas">
    <tr>

        <td>
            <!--    Login dan Sign In-->
            <a href="#">
                <button id="btnLogin"> <?php echo $_SESSION['Username2']; ?> </button>
            </a>

            <!--                <a href="">-->
            <button onclick="konfirmasi()" id="btnDaftar">Log out</button>
            <!--                </a>-->
            <!--    Login dan Sign In-->
        </td>
    </tr>
</table>

<h2> ATUR HALAMAN DEPAN (Slide Show) </h2>


<form method="POST">
    <div id="spasi">

        <?php
        //        SUM(k.TotalBelanjaan),
        $sql = "SELECT IDProduk, NamaProduk, Harga, Kategori, Deskripsi, Variasi, 
                    Foto1, Foto2, Foto3, Foto4, Foto5, Foto6, Foto7, Foto8, Foto9, Foto10
                FROM Produk
                GROUP BY KodeBarang";
        $result = mysqli_query($conn, $sql);


        while ($a = mysqli_fetch_array($result)){

            ?>
            <table id="tabelBelanjaan" class="tabelBelanjaan">
                <tr>
                    <td align="Right">
                        <button class="lihatproduk3" type="button"> Rp <?php echo number_format($a['Harga'],0,'','.'); ?> </button>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <b> <?php echo $a['NamaProduk']; ?> </b>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <?php
                    if (!empty($a['Foto1'])) {
                        ?>
                            <img src="../GambarProduk/<?php echo $a['Foto1']; ?>"
                                 style="max-width: 130px; max-height: 230px;">
                    <?php
                    }


                    if (!empty($a['Foto2'])) {
                        ?>

                            <img src="../GambarProduk/<?php echo $a['Foto2']; ?>"
                                 style="max-width: 130px; max-height: 230px;">
                    <?php
                    }


                    if (!empty($a['Foto3'])) {
                        ?>

                            <img src="../GambarProduk/<?php echo $a['Foto3']; ?>"
                                 style="max-width: 130px; max-height: 230px;">
                    <?php
                    }
                    ?>
                    </td>
                </tr>
                <tr>
                    <td> Variasi: <?php echo $a['Variasi']; ?></td>
                </tr>
                <tr>
                    <td align="center">
                        <br>

<!--                        <button class="lihatproduk3" type="button" onclick="yesnoCheck()">-->
<!--                            Atur Sebagai Slide Show </button>-->

<!--                        <br><br>-->
                        <a href="AturSlideShow1.php?id=<?php echo $a['IDProduk']; ?>">
                            <button class="lihatproduk4" id="SS1" type="button">
                                Slide Show 1 </button> &nbsp;
                        </a>

                        <a href="AturSlideShow2.php?id=<?php echo $a['IDProduk']; ?>">
                            <button class="lihatproduk4" id="SS2" type="button" >
                                Slide Show 2 </button> &nbsp;
                        </a>

                        <a href="AturSlideShow3.php?id=<?php echo $a['IDProduk']; ?>">
                            <button class="lihatproduk4" id="SS3" type="button">
                                Slide Show 3 </button> &nbsp;
                        </a>

                    </td>
                </tr>
            </table>

            <?php
        }
        ?>

        <!--END TABEL BELANJAAN-->
        <br><br><br>


    </div>
</form>


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


<!--START SEMBUNYIKAN BTN SLIDE SHOW-->
<!--<script type="text/javascript">-->
<!--    function yesnoCheck() {-->
<!--        document.getElementById('SS1').style.display = 'INLINE-BLOCK';-->
<!--        document.getElementById('SS2').style.display = 'INLINE-BLOCK';-->
<!--        document.getElementById('SS3').style.display = 'INLINE-BLOCK';-->
<!--    }-->
<!--</script>-->
<!--START SEMBUNYIKAN BTN SLIDE SHOW-->


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


</body>
</html>