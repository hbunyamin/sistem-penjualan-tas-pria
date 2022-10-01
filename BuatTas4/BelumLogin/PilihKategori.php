<?php
//START KODE LOGIN
include '../Function/config.php';

error_reporting(0);

session_start();

if (isset($_SESSION['Username'])) {
    header("Location: ../SudahLogin/berhasil_login.php");
} elseif (isset($_SESSION['Username2'])) {
    header("Location: ../HalamanAdmin/berhasil_login.php");
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
        header("Location: ../SudahLogin/berhasil_login.php");
    } elseif ($result2->num_rows > 0 ){
        $row2 = mysqli_fetch_assoc($result2);
        $_SESSION['Username2'] = $row2['Username'];
        header("Location: ../HalamanAdmin/berhasil_login.php");
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

    if ($NamaDepan == null OR $NamaBelakang == null OR $EmailRegistrasi == null
        OR $UsernameInput == null OR $Password1 == null OR $Password2 == null){
        echo "<script>alert('Registrasi Gagal, periksa kembali data anda')</script>";
    } else {
        $sql = "INSERT INTO User (NamaDepan, NamaBelakang, Email, Username, Password, Role)
            VALUES ('$NamaDepan', '$NamaBelakang', '$EmailRegistrasi', '$UsernameInput','$Password1', 'Member')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "<script>alert('Registrasi Berhasil')</script>";
        } else {
            echo "<script>alert('Registrasi Gagal')</script>";
        }
    }
}
//END KODE REGISTRASI


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
            /*background-color:  white;*/
            border: 2px solid #155799;
            background: url("../Gambar/User3.png");
            background-size: 100%;
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


        #keranjang{
            position: absolute;
            left: 960px;
            top: 20px;
        }
        #keranjang:hover{
            opacity: 0.7;
        }

        /*CSS BUTTON LOGIN DAN SIGN IN*/
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
        /*CSS BUTTON LOGIN DAN SIGN IN*/



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
            left: 160px;
            right: 0px;
            /*width: auto;*/
            height: 100px;
            border: 2px solid #155799;
        }
        #kotakhitam{
            position: fixed;
            top: 0px;
            left: 0px;
            bottom: 0px;
            width: 160px;
            /*max-height: 20000px;*/
            background-color: black;
        }
        h2{
            position: absolute;
            top: 140px;
            left: 600px;
            text-align: center;
        }

        /*MULAI CSS KOTAK BARANG*/
        #kotakbesarbarang{
            position: absolute;
            top: 170px;
            right: 0px;
            left: 230px;
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


        a:link {color:white}
        a:visited {color: #E0FFFF}
    </style>

</head>
<body>


<!--START MENU BURGER DAN ISINYA-->
<div id="myNav" class="overlay">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="overlay-content">

        <div id="avatar1"></div>
        <br>

        <!--        Tombol Menu 1 -->
        <a href="../index.php">
            <div id="menu1" class="btnMenu"> </div>
            <div class="TulisanMenu"> <b> Home </b> </div>
        </a>
        <!--        Tombol Menu 1 -->


        <!--        Tombol Menu 2 -->
        <a href="Kategori.php">
            <div id="menu2" class="btnMenu"> </div>
            <div class="TulisanMenu"> <b> Kategori </b> </div>
        </a>
        <!--        Tombol Menu 2 -->


        <!--        Tombol Menu 3 -->
        <a href="Shop.php">
            <div id="menu3" class="btnMenu"> </div>
            <div class="TulisanMenu"> <b> Shop </b> </div>
        </a>
        <!--        Tombol Menu 3 -->


        <!--        Tombol Menu 4 -->
        <a href="#">
            <div id="menu4" class="btnMenu"> </div>
            <div class="TulisanMenu"> <b> Berita </b> </div>
        </a>
        <!--        Tombol Menu 4 -->


        <!--        Tombol Menu 5 -->
        <a href="#">
            <div id="menu5" class="btnMenu"> </div>
            <div class="TulisanMenu"> <b> Tips&Trik </b> </div>
        </a>
        <!--        Tombol Menu 5 -->

    </div>
</div>
<!--END MENU BURGER DAN ISINYA-->


<div id="kotakhitam"> </div>


<span style="position:absolute; color: white; top:20px; font-size:30px; cursor:pointer" onclick="openNav()" >
            &#9776; Menu </span>
<div id="kotakbiru"> </div>
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


<!--    Keranjang Belanja-->
<a href="#">
    <img onclick="alert('Silakan Login untuk menggunakan keranjang')" src="../Gambar/Cart.png" width="40px" height="40px" id="keranjang">
</a>
<!--    Keranjang Belanja-->


<!--    Login dan Sign In-->
<a href="#container1">
    <button id="btnLogin">Login</button>
</a>

<a href="#container2">
    <button id="btnDaftar">Sign Up</button>
</a>
<!--    Login dan Sign In-->



<!--Tampilan barang (kotak)-->
<div id="kotakbesarbarang">
    <!--    Kotak yang besar untuk mengatur dimana letak kotak kecilnya nanti-->

    <?php
    $id = $_GET['id'] ;

    $sql = "SELECT * FROM Produk WHERE Kategori = $id GROUP BY KodeBarang";
    $result = mysqli_query($conn, $sql);

    $jumlah = mysqli_num_rows($result);
    if ($jumlah < 1){
        echo '<p style="color: #155799;"> Tidak ada barang dalam kategori ini </p>';
    }

    while ($a = mysqli_fetch_array($result)){
    ?>

        <a href="PilihBarang.php?id=<?php echo $a['IDProduk']; ?>">
            <table id="kotakkecilbarang" >
                <tr>
                    <td>
                        <?php
                        echo "<img src='../GambarProduk/".$a['Foto1']."' style='max-width: 150px; max-height: 230px;' ><br>";
                        echo $a['NamaProduk'];
                        ?>
                        <br>
                        <?php echo "Rp". number_format($a['Harga'],0,'','.') ?>
                    </td>
                </tr>
            </table>
        </a>

        <?php
    }
    ?>

</div>
<!--Tampilan barang (kotak)-->




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
            <form method="POST">
                <input name="Email" type="text" placeholder="username" style="height: 35px">
                <input name="Password" type="password" placeholder="password" style="height: 35px">
                <button name="Submit" class="btn btn-info btn-block login" type="Submit">Login</button>
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
                <button name="SubmitRegistrasi" class="btn btn-info btn-block login" type="submit">Sign Up</button>
            </form>
        </div>
    </div>
</div>
<!-- END OVERLAY DAFTAR-->

</body>
</html>