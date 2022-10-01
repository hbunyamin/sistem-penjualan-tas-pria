<?php
include '../Function/config.php';

session_start();

if (!isset($_SESSION['Username2'])) {
    header("Location: ../index.php");
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


        /*.form-box2 input{*/
        /*    width: 100%;*/
        /*    padding: 10px;*/
        /*    text-align: center;*/
        /*    height:20px;*/
        /*    border: 1px solid #ccc;;*/
        /*    background: #fafafa;*/
        /*    transition:0.2s ease-in-out;*/
        /*}*/

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


        #tabelAtas{
            position: absolute;
            top: 15px;
            right: 50px;
            /*border: 2px solid #155799;*/
            max-height: 45px;
            max-width: 600px;
        }

        /*CSS BUTTON LOGIN DAN SIGN IN*/
        #btnLogin{
            border: 2px solid #155799;
            max-width: 300px;
            height: 30px;
            margin-right: -5px;
            /*position: absolute;*/
            /*top: 25px;*/
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
            /*top: 25px;*/
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


        /*START CSS FOOTER*/
        #footerbawah{
            background-color: black;
            width: 100%;
            height: 50px;
            position: absolute;
            right: 0px;
            left: 0px;
            top: 1270px;
            color: white;
            vertical-align: center;
            text-align: center;
            font-size: 20px;
        }
        /*END CSS FOOTER*/


        /*START CSS FORM*/
        #formInput{
            position: absolute;
            top: 170px;
            left: 250px;
            width: 800px;
            height: 1020px;
            font-family: "Comic Sans MS";
            color: #155799;
            background-color: #edf5f4;
            border: 2px solid #155799;
            border-radius: 3%;
        }
        .kotakInput{
            width: 400px;
            height: 30px;
            border: 1.5px solid #155799;
            font-family: "Comic Sans MS";
            color: #155799;
        }
        #tabelInput{
            margin-top: 40px;
            margin-left: 120px;
        }
        /*END CSS FORM*/


        /*CSS TOMBOL BIRU*/
        .lihatproduk{
            background-color: white;
            color: #155799;
            border: 2px solid #155799;
            border-radius: 5px;
            box-shadow: 0px 2px 8px 0px rgba(0, 0, 0, 0.2);
            text-align: center;
            margin: 5px 2px;
            padding: 10px 15px;
            cursor: pointer;
            font-family: "Comic Sans MS";
        }

        .lihatproduk:hover{
            font-family: "Comic Sans MS";
            background-color: #155799;
            color: white;
        }
        /*END CSS TOMBOL BIRU*/

        #Back{
            position: absolute;
            top: 20px;
            left: 50px;
        }


        a:link {color:white}
        a:visited {color: #E0FFFF}
    </style>

</head>
<body>



<div id="kotakbiru"> </div>

<a href="berhasil_login.php">
    <img src="../Gambar/Back.png" width="55px" height="55px" id="Back">
</a>

<table id="tabelAtas">
    <tr>
        <td>
            <!--    Login dan Sign In-->
            <a href="#">
                <button id="btnLogin"> <?php echo $_SESSION['Username2']; ?> </button>
            </a>

<!--            <a href="logout.php">-->
                <button onclick="konfirmasi()" id="btnDaftar">Log out</button>
<!--            </a>-->
            <!--    Login dan Sign In-->
        </td>
    </tr>
</table>


<form method="POST" id="formInput" enctype="multipart/form-data" action="TambahBarangFunc.php">
    <table id="tabelInput">
        <tr>
            <td>
                Nama barang
            </td>
            <td>
                :
            </td>
            <td colspan="2">
                <input name="NamaProduk" class="kotakInput" type="text" maxlength="300">
            </td>
        </tr>
        <tr>
            <td>
                Kode barang
            </td>
            <td>
                :
            </td>
            <td colspan="2">
                <input name="KodeProduk" class="kotakInput" type="text" maxlength="300">
            </td>
        </tr>
        <tr>
            <td>
                Harga
            </td>
            <td>
                :
            </td>
            <td colspan="2">
                <input name="Harga" class="kotakInput" type="number" maxlength="45">
            </td>
        </tr>
        <tr>
            <td>
                Berat (gram)
            </td>
            <td>
                :
            </td>
            <td colspan="2">
                <input name="Berat" class="kotakInput" type="number" maxlength="45">
            </td>
        </tr>
        <tr>
            <td>
                Kategori
            </td>
            <td>
                :
            </td>
            <td colspan="2">
                <select name="Kategori" class="kotakInput">
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
            <td> <br>
                <input type="checkbox" name="Warna[]" value="Hitam" onclick="myFunction()" id="HitamCheck"> Hitam
                <input type="text" name="Stock[]" disabled="disabled" id="HitamInput" placeholder="Stock" class="kotakInput" style="width: 40px; height: 23px"> <br>
                <input type="checkbox" name="Warna[]" value="Abu" onclick="myFunction()" id="AbuCheck"> Abu
                <input type="text" name="Stock[]" disabled="disabled" id="AbuInput" placeholder="Stock" class="kotakInput" style="width: 40px; height: 23px"> <br>
                <input type="checkbox" name="Warna[]" value="Putih" onclick="myFunction()" id="PutihCheck"> Putih
                <input type="text" name="Stock[]" disabled="disabled" id="PutihInput" placeholder="Stock" class="kotakInput" style="width: 40px; height: 23px"> <br>
                <input type="checkbox" name="Warna[]" value="Coklat Tua" onclick="myFunction()" id="CoklatTuaCheck"> Coklat Tua
                <input type="text" name="Stock[]" disabled="disabled" id="CoklatTuaInput" placeholder="Stock" class="kotakInput" style="width: 40px; height: 23px"> <br>
                <input type="checkbox" name="Warna[]" value="Coklat Muda" onclick="myFunction()" id="CoklatMudaCheck"> Coklat Muda
                <input type="text" name="Stock[]" disabled="disabled" id="CoklatMudaInput" placeholder="Stock" class="kotakInput" style="width: 40px; height: 23px"> <br>
                <input type="checkbox" name="Warna[]" value="Biru Tua" onclick="myFunction()" id="BiruTuaCheck"> Biru Tua
                <input type="text" name="Stock[]" disabled="disabled" id="BiruTuaInput" placeholder="Stock" class="kotakInput" style="width: 40px; height: 23px"> <br>
                <input type="checkbox" name="Warna[]" value="Biru Muda" onclick="myFunction()" id="BiruMudaCheck"> Biru Muda
                <input type="text" name="Stock[]" disabled="disabled" id="BiruMudaInput" placeholder="Stock" class="kotakInput" style="width: 40px; height: 23px"> <br>
                <br>
            </td>
            <td>
                <br>
                <input type="checkbox" name="Warna[]" value="Merah" onclick="myFunction()" id="MerahCheck"> Merah
                <input type="text" name="Stock[]" disabled="disabled" id="MerahInput" placeholder="Stock" class="kotakInput" style="width: 40px; height: 23px"> <br>
                <input type="checkbox" name="Warna[]" value="Kuning" onclick="myFunction()" id="KuningCheck"> Kuning
                <input type="text" name="Stock[]" disabled="disabled" id="KuningInput" placeholder="Stock" class="kotakInput" style="width: 40px; height: 23px"> <br>
                <input type="checkbox" name="Warna[]" value="Hijau Tua" onclick="myFunction()" id="HijauTuaCheck"> Hijau Tua
                <input type="text" name="Stock[]" disabled="disabled" id="HijauTuaInput" placeholder="Stock" class="kotakInput" style="width: 40px; height: 23px"> <br>
                <input type="checkbox" name="Warna[]" value="Hijau Muda" onclick="myFunction()" id="HijauMudaCheck"> Hijau Muda
                <input type="text" name="Stock[]" disabled="disabled" id="HijauMudaInput" placeholder="Stock" class="kotakInput" style="width: 40px; height: 23px"> <br>
                <input type="checkbox" name="Warna[]" value="Pink" onclick="myFunction()" id="PinkCheck"> Pink
                <input type="text" name="Stock[]" disabled="disabled" id="PinkInput" placeholder="Stock" class="kotakInput" style="width: 40px; height: 23px"> <br>
                <input type="checkbox" name="Warna[]" value="Ungu" onclick="myFunction()" id="UnguCheck"> Ungu
                <input type="text" name="Stock[]" disabled="disabled" id="UnguInput" placeholder="Stock" class="kotakInput" style="width: 40px; height: 23px"> <br>
                <input type="checkbox" name="Warna[]" value="Orange" onclick="myFunction()" id="OrangeCheck"> Orange
                <input type="text" name="Stock[]" disabled="disabled" id="OrangeInput"placeholder="Stock" class="kotakInput" style="width: 40px; height: 23px"> <br>
                <br>
            </td>
        </tr>
        <tr>
            <td>
                Deskripsi
            </td>
            <td>
                :
            </td>
            <td colspan="2">
                <textarea name="Deskripsi" class="kotakInput" type="text" maxlength="2000"></textarea>
            </td>
        </tr>
        <tr>
            <td colspan="3"><br>
                <input name="UploadFoto1" type="file" class="lihatproduk">
                <input name="UploadFoto2" type="file" class="lihatproduk">
                <input name="UploadFoto3" type="file" class="lihatproduk">
                <input name="UploadFoto4" type="file" class="lihatproduk">
                <input name="UploadFoto5" type="file" class="lihatproduk">
            </td>
            <td colspan="1"><br>
                <input name="UploadFoto6" type="file" class="lihatproduk">
                <input name="UploadFoto7" type="file" class="lihatproduk">
                <input name="UploadFoto8" type="file" class="lihatproduk">
                <input name="UploadFoto9" type="file" class="lihatproduk">
                <input name="UploadFoto10" type="file" class="lihatproduk">
            </td>
        </tr>
        <tr>
            <td colspan="4">
                Catatan: Ekstensi file yang diperbolehkan hanya JPG dan PNG. Ukuran file tidak <br> bisa lebih dari 1 MB.
            </td>
        </tr>
        <tr>
            <td colspan="3" align="right">
                <br><br>
                <button name="SubmitTambahBarang" class="lihatproduk" type="submit">Tambah barang</button>
                <button class="lihatproduk" type="reset">Reset form</button>
            </td>
        </tr>
    </table>
</form>


<!--Start Script untuk undisable check box-->
<script>
    var HitamCheck = document.getElementById("HitamCheck");
    var HitamInput = document.getElementById("HitamInput");

    var AbuCheck = document.getElementById("AbuCheck");
    var AbuInput = document.getElementById("AbuInput");

    var PutihCheck = document.getElementById("PutihCheck");
    var PutihInput = document.getElementById("PutihInput");

    var CoklatTuaCheck = document.getElementById("CoklatTuaCheck");
    var CoklatTuaInput = document.getElementById("CoklatTuaInput");

    var CoklatMudaCheck = document.getElementById("CoklatMudaCheck");
    var CoklatMudaInput = document.getElementById("CoklatMudaInput");

    var BiruTuaCheck = document.getElementById("BiruTuaCheck");
    var BiruTuaInput = document.getElementById("BiruTuaInput");

    var BiruMudaCheck = document.getElementById("BiruMudaCheck");
    var BiruMudaInput = document.getElementById("BiruMudaInput");

    var MerahCheck = document.getElementById("MerahCheck");
    var MerahInput = document.getElementById("MerahInput");

    var KuningCheck = document.getElementById("KuningCheck");
    var KuningInput = document.getElementById("KuningInput");

    var HijauTuaCheck = document.getElementById("HijauTuaCheck");
    var HijauTuaInput = document.getElementById("HijauTuaInput");

    var HijauMudaCheck = document.getElementById("HijauMudaCheck");
    var HijauMudaInput = document.getElementById("HijauMudaInput");

    var PinkCheck = document.getElementById("PinkCheck");
    var PinkInput = document.getElementById("PinkInput");

    var UnguCheck = document.getElementById("UnguCheck");
    var UnguInput = document.getElementById("UnguInput");

    var OrangeCheck = document.getElementById("OrangeCheck");
    var OrangeInput = document.getElementById("OrangeInput");

    // Jika checkbox telah dicentang, tampilkan teks keluaran
    function myFunction()
    {
        if (HitamCheck.checked == true) {
            HitamInput.disabled = false;
        }
        if (AbuCheck.checked == true) {
            AbuInput.disabled = false;
        }
        if (PutihCheck.checked == true) {
            PutihInput.disabled = false;
        }
        if (CoklatTuaCheck.checked == true) {
            CoklatTuaInput.disabled = false;
        }
        if (CoklatMudaCheck.checked == true) {
            CoklatMudaInput.disabled = false;
        }
        if (BiruTuaCheck.checked == true) {
            BiruTuaInput.disabled = false;
        }
        if (BiruMudaCheck.checked == true) {
            BiruMudaInput.disabled = false;
        }
        if (MerahCheck.checked == true) {
            MerahInput.disabled = false;
        }
        if (KuningCheck.checked == true) {
            KuningInput.disabled = false;
        }
        if (HijauTuaCheck.checked == true) {
            HijauTuaInput.disabled = false;
        }
        if (HijauMudaCheck.checked == true) {
            HijauMudaInput.disabled = false;
        }
        if (PinkCheck.checked == true) {
            PinkInput.disabled = false;
        }
        if (UnguCheck.checked == true) {
            UnguInput.disabled = false;
        }
        if (OrangeCheck.checked == true) {
            OrangeInput.disabled = false;
        }
    }
</script>
<!--End Script untuk undisable check box-->
<!--https://dosenit.com/how-to/cara-membuat-checkbox-is-checked-->



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


<!--FOOTER YANG PALING BAWAH-->
<footer>
    <div id="footerbawah">
        &copy;2021
    </div>
</footer>
<!--END FOOTER YANG PALING BAWAH-->


<!-- OVERLAY LOGIN -->
<!--<div class="container" id="container1">-->
<!--    <div class="login-container">-->
<!--        <a href="#" class="close"> X </a>-->
<!--        <div id="output"></div>-->
<!--        <div id="avatar2"> </div>-->
<!--        <div class="form-box">-->
<!--            <form action="" method="">-->
<!--                <input name="username" type="text" placeholder="username" style="height: 35px">-->
<!--                <input type="password" placeholder="password" style="height: 35px">-->
<!--                <button class="btn btn-info btn-block login" type="submit">Login</button>-->
<!--            </form>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!-- END OVERLAY LOGIN-->


<!-- OVERLAY DAFTAR-->
<!--<div class="container2" id="container2">-->
<!--    <div class="login-container2">-->
<!--        <a href="#" class="close2"> X </a>-->
<!--        <div id="output2"></div>-->
<!--        <div class="form-box2">-->
<!--            <form action="" method="">-->
<!--                <input name="namaDepan" type="text" placeholder="Nama Depan">-->
<!--                <input name="namaBelakang" type="text" placeholder="Nama Belakang">-->
<!--                <input name="email" type="email" placeholder="Email">-->
<!--                <input name="password1" type="password" placeholder="Password">-->
<!--                <input name="password2" type="password" placeholder="Ketik Ulang Password">-->
<!--                <button class="btn btn-info btn-block login" type="submit">Login</button>-->
<!--            </form>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!-- END OVERLAY DAFTAR-->


</body>
</html>