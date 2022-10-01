<?php

session_start();

if (!isset($_SESSION['Username'])) {
    header("Location: ../index.php");
}

include '../Function/config.php';

$id = $_GET['id'] ;

$sql = "SELECT * FROM User WHERE Username = '$id'";
$result = mysqli_query($conn, $sql);

while ($a = mysqli_fetch_array($result)){


if (isset($_POST['UbahPassword'])) {

    $PasswordLama1 = $_POST['PasswordLama'];
    $PasswordLama2 = $a['Password'];

    $PasswordBaru1 = $_POST['PasswordBaru1'];
    $PasswordBaru2 = $_POST['PasswordBaru2'];


    if ($PasswordLama1 == $PasswordLama2 ){

        if ($PasswordBaru1 == $PasswordBaru2){
            $query = "UPDATE User SET Password = '$PasswordBaru1' WHERE Username = '$id'";
            $hasil = mysqli_query($conn, $query);

            if ($hasil){
                echo "<script>alert('Ubah Password Berhasil')</script>";
            } else{
                echo "<script>alert('Ubah Password Gagal')</script>";
            }
        } else{
            echo "<script>alert('Ubah Password Gagal, Password baru tidak sama')</script>";
        }
    } else {
        echo "<script>alert('Ubah Password Gagal, Password Lama salah')</script>";
    }

}

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
            top: 140px;
            left: 540px;
            text-align: center;
            color: #155799;
        }
        #TabelProfil{
            position: absolute;
            top: 250px;
            left: 410px;
            height: 410px;
            width: 470px;
            background-color: #edf5f4;
            border: 2px solid #155799;
            text-align: center;
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
            top:800px;
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


        a:link {color:white}
        a:visited {color: #E0FFFF}
    </style>

</head>
<body>



<div id="kotakbiru">
    <a href="Profil.php">
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


<table id="tabelAtas">
    <tr>
        <td>
            <!--    Keranjang Belanja-->
            <a href="Keranjang.php?id=<?php echo $_SESSION['Username']; ?>">
                <img src="../Gambar/Cart.png" width="40px" height="40px" id="keranjang">
            </a>
            <!--    Keranjang Belanja-->
        </td>
        <td>
            <!--    Login dan Sign In-->
            <a href="Profil.php">
                <button id="btnLogin"> <?php echo $_SESSION['Username']; ?> </button>
            </a>

            <!--                <a href="logout.php">-->
            <button onclick="konfirmasi()" id="btnDaftar">Log out</button>
            <!--                </a>-->
            <!--    Login dan Sign In-->
        </td>
    </tr>
</table>



<h2> UBAH PASSWORD </h2>


<div id="TabelProfil">
    <form method="POST">

        <div style="margin-top: 50px;">
            Password lama: <br>
            <input name="PasswordLama" type="password" placeholder="Masukan Password Lama"
                   style="border: 2px solid #155799; text-align: center; width: 200px; height: 33px;">
        </div>


        <div style="margin-top: 80px">
            Password baru: <br>
            <input name="PasswordBaru1" type="password" placeholder="Masukan Password Baru"
                   style="border: 2px solid #155799; text-align: center; width: 200px; height: 33px;">
            <br>

            <input name="PasswordBaru2" type="password" placeholder="Ulangi Password Baru"
                   style="border: 2px solid #155799; text-align: center; width: 200px; height: 33px;">
            <br><br>

            <button name="UbahPassword" type="submit" class="lihatproduk"> Ubah password </button>
        </div>
    </form>
</div>


<?php
}
?>


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