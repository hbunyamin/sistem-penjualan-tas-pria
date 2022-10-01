<?php
//START KODE LOGIN
include 'Function/config.php';

error_reporting(0);

session_start();

if (isset($_SESSION['Username'])) {
    header("Location: SudahLogin/berhasil_login.php");
} elseif (isset($_SESSION['Username2'])) {
    header("Location: HalamanAdmin/berhasil_login.php");
}

if (isset($_POST['Submit'])) {
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    $Role1 = "Member";
    $Role2 = "Admin";

    $sql = "SELECT * FROM User WHERE Email='$email' AND Password='$password' AND Role ='$Role1' ";
    $result = mysqli_query($conn, $sql);

    $sql2 = "SELECT * FROM User WHERE Email='$email' AND Password='$password' AND Role ='$Role2' ";
    $result2 = mysqli_query($conn, $sql2);


    if ($result->num_rows > 0  ) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['Username'] = $row['Username'];
        header("Location: SudahLogin/berhasil_login.php");
    } elseif ($result2->num_rows > 0 ){
        $row2 = mysqli_fetch_assoc($result2);
        $_SESSION['Username2'] = $row2['Username'];
        header("Location: HalamanAdmin/berhasil_login.php");
    } else {
        echo "<script>alert('Email atau password Anda salah. Silahkan coba lagi!')</script>";
    }
}
//END KODE LOGIN


//START KODE REGISTRASI
if (isset($_POST['SubmitRegistrasi'])) {
    $NamaDepan = $_POST['namaDepan'];
    $NamaBelakang = $_POST['namaBelakang'];
    $EmailRegistrasi = $_POST['EmailRegistrasi'];
    $UsernameInput = $_POST['UsernameInput'];
    $Password1 = $_POST['password1'];
    $Password2 = $_POST['password2'];

    $sql = "INSERT INTO User (NamaDepan, NamaBelakang, Email, Username, Password, Role)
            VALUES ('$NamaDepan', '$NamaBelakang', '$EmailRegistrasi', '$UsernameInput','$Password1', 'Member')";
    $result = mysqli_query($conn, $sql);

    if ($result){
        echo "<script>alert('Registrasi Berhasil')</script>";
    } else{
        echo "<script>alert('Registrasi Gagal')</script>";
    }
}
//END KODE REGISTRASI
?>

<html>
<head>
    <style type="text/css">
        body{
            /*background: linear-gradient(to right, rgba(57, 106, 252, 0.5), rgba(41, 72, 255, 0.2)),  url(https://bg.jpg);*/
            /*background: radial-gradient(circle at top left, #E0FFFF, #22c1c3);*/
            /*background: radial-gradient(circle at top left, #E0FFFF, #87CEFA);*/
            background: radial-gradient(circle at top left, #E0FFFF, #AFEEEE);
            /*background: radial-gradient(circle at top left, #E0FFFF,  #F0FFFF);*/
            /*background: radial-gradient(circle at top left, #E0FFFF,  #B0E0E6);*/
            /*background-color: #155799;*/
            font-family: "Comic Sans MS";
        }

        #kotakHiasan1{
            position: absolute;
            height: 250px;
            top: 40px;
            right: 0px;
            left: 40px;
            background-color: white;
            border: 2px solid #155799;
        }
        #kotakHiasan2{
            position: absolute;
            height: 680px;
            top: 400px;
            right: 40px;
            left: 40px;
            background-color: white;
            border: 2px solid #155799;
        }
        #kotakHiasan3{
            position: absolute;
            height: 320px;
            top: 1520px;
            right: 0px;
            left: 100px;
            background-color: #87CEFA;
            border: 2px solid #155799;
        }
        #kotakHiasan4{
            position: absolute;
            height: 320px;
            top: 1550px;
            right: 30px;
            left: 70px;
            background-color: #E0FFFF;
            border: 2px solid #155799;
        }
        #kotakHiasan5{
            position: absolute;
            height: 330px;
            top: 1580px;
            right: 80px;
            left: 30px;
            background-color: white;
            border: 2px solid #155799;
        }
        #kotakHiasan6{
            position: absolute;
            height: 450px;
            top: 2070px;
            right: 200px;
            left: 200px;
            background-color: white;
            border: 2px solid #155799;
            transform: rotate(5deg);
        }
        #kotakHiasan7{
            position: absolute;
            height: 450px;
            top: 2070px;
            right: 200px;
            left: 200px;
            background-color:  #155799;
            border: 2px solid white;
            transform: rotate(-5deg);
        }
        #header{
            position: absolute;
            width: 100%;
            top: 0px;
            left: 0px;
        }

        #btnLogin{
            border: 2px solid #155799;
            width: 100px;
            height: 30px;
            position: absolute;
            top: 8px;
            right: 170px;
            color: #155799;
            font-family: "Comic Sans MS";
        }
        #btnLogin:hover{
            background-color:  #155799;
            color: white;
            font-family: "Comic Sans MS";
        }

        /*CSS OVERLAY LOGIN*/
        #container1{
            position: absolute;
            top: 0px;
            left: 0px;
            right: 0px;
            width: 100%;
            height: 2880px;
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
            width: 100%;height: 100%;
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

        .avatar{
            width: 100px;height: 100px;
            margin: 10px auto 30px;
            border-radius: 100%;
            /*border: 2px solid #aaa;*/
            border: 2px solid #155799;
            background-size: cover;
        }

        .form-box input{
            width: 100%;
            padding: 10px;
            text-align: center;
            height:40px;
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
            /*text-transform: lowercase;*/
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
            height: 2880px;
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
            width: 100%;height: 100%;
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
            height:40px;
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
            /*text-transform: lowercase;*/
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


        #btnDaftar{
            border: 2px solid #155799;
            width: 100px;
            height: 30px;
            position: absolute;
            top: 8px;
            right: 70px;
            color: #155799;
            font-family: "Comic Sans MS";
        }
        #btnDaftar:hover{
            background-color:  #155799;
            color: white;
            font-family: "Comic Sans MS";
        }
        #btnMenu{
            position: absolute;
            left: 280px;
        }
        .btnMenu{
            float:left;
            width: 300px;
            margin: 30px 0px 0px 70px; /*batas atas, batas kanan, batas bawah, batas kiri*/
        }
        #menu1, #menu2, #menu3, #menu4, #menu5{
            width: 60px;
            height: 60px;
            border: 2px solid #155799;
            background-color:  white;
            border-radius: 100%;
        }
        #menu1:hover, #menu2:hover, #menu3:hover, #menu4:hover , #menu5:hover{
            opacity: 0.7;
        }
        #tblMenu1{
            position: absolute;
            top: 160px;
            left: 360px;
            color: #155799;
        }
        #tblMenu2{
            position: absolute;
            top: 160px;
            left: 490px;
            color: #155799;
        }
        #tblMenu3{
            position: absolute;
            top: 160px;
            left: 635px;
            color: #155799;
        }
        #tblMenu4{
            position: absolute;
            top: 160px;
            left: 765px;
            color: #155799;
        }
        #tblMenu5{
            position: absolute;
            top: 160px;
            left: 887px;
            color: #155799;
        }

        #SearchBar{
            position: absolute;
            top: 220px;
            left: 430px;
        }
        #SearchBar:hover{
            box-shadow: 3px 3px 5px #155799;  /*  x y z warna;  X horizontal y vertikal z blur*/
        }

        #btnSearch{
            position: absolute;
            top: 214px;
            left: 830px;
        }
        #btnSearch:hover{
            opacity: 0.7;
        }

        /*CSS UNTUK SLIDE SHOW PERTAMA*/
        #SlideShow1 {position: absolute; top: 430px; left: 70px; right: 70px;}
        #SlideShow2 {position: absolute; top:1610px; left: 8%; width: 80%; }
        #SlideShow3 {position: absolute; top:2100px; left: 15%; width: 70%; }
        .slideshow *{box-sizing:border-box}

        /* GAMBAR */
        .slideshow .gambar{position:relative}
        .slideshow .gambar .mySlides {position:relative;display: none}
        .slideshow .gambar .mySlides img{max-width:100%}

        /* PREV-NEXT */
        .slideshow .prev,
        .slideshow .next {position:absolute;top:50%;cursor:pointer;width:auto;margin-top:-22px;padding:16px;color:white;font-weight:bold;font-size:18px;transition:0.6s ease;border-radius:0 3px 3px 0;user-select:none}
        .slideshow .prev:before {content:"\276E"}
        .slideshow .next:before {content:"\276F"}
        .slideshow .next{right:0;border-radius:3px 0 0 3px}
        .slideshow .prev:hover,
        .slideshow .next:hover {background-color:rgba(0,0,0,0.8)}
        /*    END CSS SLIDE SHOW PERTAMA*/

        /*CSS UNTUK QUOTES*/
        #Quotes{
            position: absolute;
            top: 1300px;
            left: 350px;
            width: 600px;
            text-align: center;
            text-shadow: 3px 2px 5px #155799;  /*  x y z warna;  X horizontal y vertikal z blur*/
            font-size: 20px;
            color: dimgray;
        }
        #Quotes:hover{
            color: #155799;
            text-shadow: 3px 2px 5px #155799;  /*  x y z warna;  X horizontal y vertikal z blur*/
            font-size: 20px;
        }
        /*END CSS UNTUK QUOTES*/

        /*CSS TOMBOL BIRU*/
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
        /*END CSS TOMBOL BIRU*/

        /*CSS FOOTER*/
        #footerbawah{
            background-color: black;
            width: 100%;
            /*height: auto;*/
            position: absolute;
            right: 0px;
            left: 0px;
            top:2650px;
            /*bottom: 0;*/
            /*text-align: center;*/
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


        a:link {color:white}
        a:visited {color: #E0FFFF}
    </style>
</head>

<body>

<!--Div kotak putihnya-->
<div id="kotakHiasan1"> </div>

<!--Isinya Logo + Tombol menu-->
<div id="header">
    <a href="#">
        <!--        <img src="Gambar/Logo1.jpg" width="170px" height="60px">-->
        <img src="Gambar/#" width="170px" height="60px">
    </a>

    <a href="#container1">
        <button id="btnLogin">Login</button>
    </a>

    <a href="#container2">
        <button id="btnDaftar">Sign In</button>
    </a>

    <!--    5 tombol menu bentuk bulat-->
    <div id="btnMenu">
        <div id="menu1" class="btnMenu">
            <a href="#">
                <img src="Gambar/Home.png" width="60px"; height="60px" align="center">
            </a>
        </div>
        <div id="menu2" class="btnMenu">
            <a href="BelumLogin/Kategori.php">
                <img src="Gambar/Kategori.png" width="60px"; height="60px" align="center">
            </a>
        </div>
        <div id="menu3" class="btnMenu">
            <a href="BelumLogin/Shop.php">
                <img src="Gambar/Shop.png" width="60px"; height="60px" align="center">
            </a>
        </div>
        <div id="menu4" class="btnMenu">
            <a href="#">
                <img src="Gambar/News.png" width="60px"; height="60px" align="center">
            </a>
        </div>
        <div id="menu5" class="btnMenu">
            <a href="#">
                <img src="Gambar/Lamp.png" width="60px"; height="60px" align="center">
            </a>
        </div>
    </div>

    <!--    Keterangan di bawah tombol menu yang bulat-->
    <div id="tblMenu1"> Home </div>
    <div id="tblMenu2"> Kategori </div>
    <div id="tblMenu3"> Shop</div>
    <div id="tblMenu4"> Berita </div>
    <div id="tblMenu5"> Tips & Trik </div>

    <!--    Kotak Search dan tombolnya-->
    <div id="SearchBar">
        <input type="text" class="searchTerm" placeholder="What are you looking for?"
               style="width: 400px; height: 30px; border: 2px solid  #87CEFA;">
    </div>
    <div id="btnSearch">
        <a href="#">
            <img src="Gambar/Search.jpg" width="40px" height="40px">
        </a>
    </div>
</div>

<!--Garis biru paling atas-->
<hr style="border: 2px solid #155799; height: 240px">


<div id="kotakHiasan2"> </div>

<!--SLIDE SHOW BESAR-->
<div class="slideshow" id="SlideShow1">
    <div class="gambar">
        <div class="mySlides Show1">
            <!--            <img src="Gambar/Slide0.jpg">-->
            <img src="Gambar/8.png" height="640px">
        </div>
        <div class="mySlides Show1">
            <!--            <img src="Gambar/Slide1.jpg">-->
            <img src="Gambar/9.png" height="640px">
        </div>
        <div class="mySlides Show1">
            <!--            <img src="Gambar/Slide2.jpg">-->
            <img src="Gambar/10.png" height="640px">
        </div>
        <div class="mySlides Show1">
            <!--            <img src="Gambar/Slide3.jpg">-->
            <img src="Gambar/8.png" height="640px">
        </div>
        <div class="mySlides Show1">
            <!--            <img src="Gambar/Slide4.jpg">-->
            <img src="Gambar/9.png" height="640px">
        </div>
        <a class="prev" onclick="plusSlides(-1,0)"></a>
        <a class="next" onclick="plusSlides(1,0)"></a>
    </div>
</div>
<!--END SLIDE SHOW BESAR-->

<div id="Quotes">
    If you feel like giving up,
    just remember that most important things in the world exist
    because people who invented them did not stop trying.
    <br><br>
</div>


<!--Slide Show kedua-->
<div id="kotakHiasan3"> </div>
<div id="kotakHiasan4"> </div>
<div id="kotakHiasan5"> </div>

<br>
<div class="slideshow" id="SlideShow2">
    <div class="gambar">
        <div class="mySlides Show2">
            <table align="center">
                <tr>
                    <td>
                        <!--                        <img src="Gambar/Soobin.jpg" class="d-block w-100" alt="gambar" height="250px">-->
                        <img src="Gambar/1.jpg" class="d-block w-100" alt="gambar" height="250px">
                    </td>
                    <td> </td>
                    <td>
                        <!--                        <img src="Gambar/Yeonjun.jpg" class="d-block w-100" alt="gambar" height="250px">-->
                        <img src="Gambar/2.jpg" class="d-block w-100" alt="gambar" height="250px">
                    </td>
                    <td> </td>
                    <td>
                        <!--                        <img src="Gambar/Beomgyu.jpg" class="d-block w-100" alt="gambar" height="250px">-->
                        <img src="Gambar/3.jpg" class="d-block w-100" alt="gambar" height="250px">
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <!--                        <text>Soobin</text><br>-->
                        <text>Tas Selempang</text><br>
                        <text>Rp 999.999.999</text>
                    </td>
                    <td align="center">

                    </td>
                    <td align="center">
                        <!--                        <text>Yeonjun</text><br>-->
                        <text>Backpack</text><br>
                        <text>Rp 999.999.999</text>
                    </td>
                    <td align="center">

                    </td>
                    <td align="center">
                        <!--                        <text>Beomgyu</text><br>-->
                        <text>Tas Carrier</text><br>
                        <text>Rp 999.999.999</text>
                    </td>
                </tr>
            </table>
        </div>
        <div class="mySlides Show2">
            <table align="center">
                <tr>
                    <td> </td>
                    <td>
                        <!--                        <img src="Gambar/Taehyun.jpg" class="d-block w-100" alt="gambar" height="250px">-->
                        <img src="Gambar/4.jpg" class="d-block w-100" alt="gambar" height="250px">
                    </td>
                    <td> </td>
                    <td>
                        <!--                        <img src="Gambar/Hueningkai.jpg" class="d-block w-100" alt="gambar" height="250px">-->
                        <img src="Gambar/5.jpg" class="d-block w-100" alt="gambar" height="250px">
                    </td>
                </tr>
                <tr>
                    <td align="center">

                    </td>
                    <td align="center">
                        <!--                        <text>Taehyun</text><br>-->
                        <text>Tas Laptop</text><br>
                        <text>Rp 999.999.999</text>
                    </td>
                    <td align="center">

                    </td>
                    <td align="center">
                        <!--                        <text>Hueningkai</text><br>-->
                        <text>Tas Kantor</text><br>
                        <text>Rp 999.999.999</text>
                    </td>
                </tr>
            </table>
        </div>
        <a class="prev" onclick="plusSlides(-1,1)"></a>
        <a class="next" onclick="plusSlides(1,1)"></a>
    </div>
</div>
<!--END SLIDE SHOW KEDUA -->



<!--SLIDE SHOW KETIGA-->

<!--Urutannya jangan diubah-->
<div id="kotakHiasan7"> </div>
<div id="kotakHiasan6"> </div>

<br>
<div class="slideshow" id="SlideShow3">
    <div class="gambar">
        <div class="mySlides Show3">
            <table align="center">
                <tr>
                    <td>
                        <!--                        <img src="Gambar/Soobin.jpg" class="d-block w-100" alt="gambar" width="465px" height="350px">-->
                        <img src="Gambar/1.jpg" class="d-block w-100" alt="gambar" width="465px" height="350px">
                    </td>
                    <td>
                        <text>
                            <!--                            CHOI SOOBIN <br>-->
                            <!--                            5 Desember 2001 <br>-->
                            Tas Selempang <br>
                            Rp 999.999.999 <br>
                            <a href="#"> <button class="lihatproduk">VIEW THIS PRODUCT</button> </a>
                        </text>
                    </td>
                </tr>
            </table>
        </div>

        <div class="mySlides Show3">
            <table align="center">
                <tr>
                    <td>
                        <img src="Gambar/Yeonjun.jpg" class="d-block w-100" alt="gambar" width="465px" height="350px">
                    </td>
                    <td>
                        <text>
                            CHOI YEONJUN <br>
                            13 SEPTEMBER 1999 <br>
                            Rp 999.999.999 <br>
                            <a href="#"> <button class="lihatproduk">VIEW THIS PRODUCT</button> </a>
                        </text>
                    </td>
                </tr>
            </table>
        </div>

        <div class="mySlides Show3">
            <table align="center">
                <tr>
                    <td>
                        <img src="Gambar/Beomgyu.jpg" class="d-block w-100" alt="gambar" width="465px" height="350px">
                    </td>
                    <td>
                        <text>
                            CHOI BEOMGYU <br>
                            13 MARET 2001 <br>
                            Rp 999.999.999 <br>
                            <a href="#"> <button class="lihatproduk">VIEW THIS PRODUCT</button> </a>
                        </text>
                    </td>
                </tr>
            </table>
        </div>

        <div class="mySlides Show3">
            <table align="center">
                <tr>
                    <td>
                        <img src="Gambar/Taehyun.jpg" class="d-block w-100" alt="gambar" width="465px" height="350px">
                    </td>
                    <td>
                        <text>
                            KANG TAEHYUN <br>
                            5 FEBUARI 2002 <br>
                            Rp 999.999.999 <br>
                            <a href="#"> <button class="lihatproduk">VIEW THIS PRODUCT</button> </a>
                        </text>
                    </td>
                </tr>
            </table>
        </div>

        <div class="mySlides Show3">
            <table align="center">
                <tr>
                    <td>
                        <img src="Gambar/Hueningkai.jpg" class="d-block w-100" alt="gambar" width="465px" height="350px">
                    </td>
                    <td>
                        <text>
                            KAI KAMAL HUENING <br>
                            14 AGUSTUS 2002 <br>
                            Rp 999.999.999 <br>
                            <a href="#"> <button class="lihatproduk">VIEW THIS PRODUCT</button> </a>
                        </text>
                    </td>
                </tr>
            </table>
        </div>
        <a class="prev" onclick="plusSlides(-1,2)"></a>
        <a class="next" onclick="plusSlides(1,2)"></a>
    </div>
</div>
<!--END SLIDE SHOW KETIGA-->


<!--SCRIPT SLIDE SHOW-->
<script>
    var slideIndex = [1,1,1]; // TAMBAH "1" SETIAP ADA TAMBAHAN SLIDESHOW
    var slideId = ["Show1", "Show2","Show3"] // TAMBAH "Show[no]" SETIAP ADA TAMBAHAN SLIDESHOW
    showSlides(1, 0);
    showSlides(1, 1);
    showSlides(1, 2);
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


<!-- OVERLAY LOGIN -->
<div class="container" id="container1">
    <div class="login-container">
        <a href="#" class="close"> X </a>
        <div id="output"></div>
        <div class="avatar"></div>
        <div class="form-box">
            <form method="POST">
                <input name="Email" type="text" placeholder="username">
                <input name="Password" type="password" placeholder="password">
                <button class="btn btn-info btn-block login" name="Submit" type="submit">Login</button>
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
            <form method="POST">
                <input name="namaDepan" type="text" placeholder="Nama Depan">
                <input name="namaBelakang" type="text" placeholder="Nama Belakang">
                <input name="EmailRegistrasi" type="text" placeholder="Email">
                <input name="UsernameInput" type="text" placeholder="Username">
                <input name="password1" type="password" placeholder="Password">
                <input name="password2" type="password" placeholder="Ketik Ulang Password">
                <button name="SubmitRegistrasi" class="btn btn-info btn-block login" type="submit">Sign In</button>
            </form>
        </div>
    </div>
</div>
<!-- END OVERLAY DAFTAR-->



<!--SCRIPT UNTUK LOGIN CARD-->
<!--<script>-->
<!--    $(function(){-->
<!--        var textfield = $("input[name=user]");-->
<!--        $('button[type="submit"]').click(function(e) {-->
<!--            e.preventDefault();-->
<!--            //little validation just to check username-->
<!--            if (textfield.val() != "") {-->
<!--                //$("body").scrollTo("#output");-->
<!--                $("#output").addClass("alert alert-success animated fadeInUp").html("Welcome back " + "<span style='text-transform:uppercase'>" + textfield.val() + "</span>");-->
<!--                $("#output").removeClass(' alert-danger');-->
<!--                $("input").css({-->
<!--                    "height":"0",-->
<!--                    "padding":"0",-->
<!--                    "margin":"0",-->
<!--                    "opacity":"0"-->
<!--                });-->
<!--                //change button text-->
<!--                $('button[type="submit"]').html("continue")-->
<!--                    .removeClass("btn-info")-->
<!--                    .addClass("btn-default").click(function(){-->
<!--                    $("input").css({-->
<!--                        "height":"auto",-->
<!--                        "padding":"10px",-->
<!--                        "opacity":"1"-->
<!--                    }).val("");-->
<!--                });-->
<!---->
<!--                //show avatar-->
<!--                $(".avatar").css({-->
<!--                    "background-image": "url('http://api.randomuser.me/0.3.2/portraits/women/35.jpg')"-->
<!--                });-->
<!--            } else {-->
<!--                //remove success mesage replaced with error message-->
<!--                $("#output").removeClass(' alert alert-success');-->
<!--                $("#output").addClass("alert alert-danger animated fadeInUp").html("sorry enter a username ");-->
<!--            }-->
<!--            //console.log(textfield.val());-->
<!---->
<!--        });-->
<!--    });-->
<!---->
<!--</script>-->
<!--END SCRIPT UNTUK LOGIN CARD-->


</body>
</html>