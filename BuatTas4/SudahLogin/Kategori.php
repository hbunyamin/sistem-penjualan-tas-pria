<?php
include '../Function/config.php';


session_start();

if (!isset($_SESSION['Username'])) {
    header("Location: ../index.php");
}

?>

<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
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
        .avatar{
            margin: 0px 0px 0px 70px; /*batas atas, batas kanan, batas bawah, batas kiri*/
            width: 100px;
            height: 100px;
            border-radius: 100%;
            background-color:  white;
            border: 2px solid #155799;
        }

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


        #header{
            position: absolute;
            top: 0px;
            left: 0px;
            right: 0px;
            width: 1276px;
            height: 100px;
            /*border: 2px solid #155799;*/
        }

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
        #dropdown {
            display: inline-block;
        }
        #dropdown-child {
            position: absolute;
            top: 40px;
            right: 100px;
            font-family: "Comic Sans MS";
            display: none;
        }
        #dropdown-child button {
            text-decoration: none;
            display: block;
            width: 150px;
            height: 30px;
            color: #155799;
            background-color: #edf5f4;
            border: 2px solid #155799;
            text-align: center;
            cursor: pointer;
        }
        #dropdown:hover #dropdown-child {
            display: block;
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


        #kotakhitam{
            position: absolute;
            top: 0px;
            left: 0px;
            bottom: 0px;
            width: 160px;
            background-color: black;
        }

        #kotakbiru{
            position: absolute;
            top: 0px;
            left: 160px;
            right: 0px;
            width: 1116px;
            height: 50px;
            border: 2px solid #155799;
        }

        /* START KOTAK KATEGORI*/
        #kategori1{
            position: absolute;
            /*background-color: #fafcfc;*/
            /*background-color: #dcf2ef;*/
            background-color: #edf5f4;
            color: black;
            font-family: "Segoe Print";
            font-size: 20px;
            border-radius: 10%;
            text-align: center;
            height: 130px;
            width: 240px;
            top: 100px;
            left: 190px;
        }
        #kategori1:hover{
            background-color: #AFEEEE;
            color: #155799;
        }
        #kategori2{
            position: absolute;
            /*background-color: #155799;*/
            background-color: #edf5f4;
            color: black;
            font-family: "Segoe Print";
            font-size: 20px;
            border-radius: 10%;
            text-align: center;
            height: 130px;
            width: 240px;
            top: 100px;
            left: 460px;
        }
        #kategori2:hover{
            background-color: #AFEEEE;
            color: #155799;
        }
        #kategori3{
            position: absolute;
            background-color: #edf5f4;
            color: black;
            font-family: "Segoe Print";
            font-size: 20px;
            border-radius: 10%;
            text-align: center;
            height: 130px;
            width: 240px;
            top: 100px;
            left: 730px;
        }
        #kategori3:hover{
            background-color: #AFEEEE;
            color: #155799;
        }
        #kategori4{
            position: absolute;
            background-color: #edf5f4;
            color: black;
            font-family: "Segoe Print";
            font-size: 20px;
            border-radius: 10%;
            text-align: center;
            height: 130px;
            width: 240px;
            top: 100px;
            left: 1000px;
        }
        #kategori4:hover{
            background-color: #AFEEEE;
            color: #155799;
        }
        #kategori5{
            position: absolute;
            background-color: #edf5f4;
            color: black;
            font-family: "Segoe Print";
            font-size: 20px;
            border-radius: 10%;
            text-align: center;
            height: 130px;
            width: 240px;
            top: 260px;
            left: 190px;
        }
        #kategori5:hover{
            background-color: #AFEEEE;
            color: #155799;
        }
        #kategori6{
            position: absolute;
            background-color: #edf5f4;
            color: black;
            font-family: "Segoe Print";
            font-size: 20px;
            border-radius: 10%;
            text-align: center;
            height: 130px;
            width: 240px;
            top: 260px;
            left: 730px;
        }
        #kategori6:hover{
            background-color: #AFEEEE;
            color: #155799;
        }
        #kategori7{
            position: absolute;
            background-color: #edf5f4;
            color: black;
            font-family: "Segoe Print";
            font-size: 20px;
            border-radius: 10%;
            text-align: center;
            height: 130px;
            width: 240px;
            top: 260px;
            left: 460px;
        }
        #kategori7:hover{
            background-color: #AFEEEE;
            color: #155799;
        }
        #kategori8{
            position: absolute;
            background-color: #edf5f4;
            color: black;
            font-family: "Segoe Print";
            font-size: 20px;
            border-radius: 10%;
            text-align: center;
            height: 130px;
            width: 240px;
            top: 260px;
            left: 1000px;
        }
        #kategori8:hover{
            background-color: #AFEEEE;
            color: #155799;
        }

        a:link {color:white}
        a:visited {color: #E0FFFF}
        /* END KOTAK KATEGORI*/
    </style>

</head>
<body>

<!--START MENU BURGER DAN ISINYA-->
<div id="myNav" class="overlay">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="overlay-content">

        <?php
        $Username = $_SESSION['Username'];
        $sql2 = "SELECT * FROM User WHERE Username = '$Username'";
        $result2 = mysqli_query($conn, $sql2);
        $b=mysqli_fetch_array($result2);

        if($b['Foto'] == null) {
            echo "<div id='avatar1'></div>";
        } else {
        ?>

        <div style="margin: 0px 0px 0px 70px; width: 100px; height: 100px; border: 2px solid #155799;
                    border-radius: 100%;">
            <?php echo "<img src='../GambarProfil/".$b['Foto']."' 
            style='width: 100px; height: 100px; border-radius: 100%;' >"; ?>
        </div>

        <?php
        }
        ?>

<!--        <div id="avatar1"></div>-->
        <br>

        <!--        Tombol Menu 1 -->
        <a href="berhasil_login.php">
            <div id="menu1" class="btnMenu"> </div>
            <div class="TulisanMenu"> <b> Home </b> </div>
        </a>
        <!--        Tombol Menu 1 -->


        <!--        Tombol Menu 2 -->
        <a href="">
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
            <div class="TulisanMenu"> <b> Tips & Trik </b> </div>
        </a>
        <!--        Tombol Menu 5 -->

    </div>
</div>
<!--END MENU BURGER DAN ISINYA-->


<div id="kotakhitam"> </div>

<div id="header">
        <span style="position:absolute; color: white; top:20px; font-size:30px; cursor:pointer" onclick="openNav()" >
            &#9776; Menu </span>

    <div id="kotakbiru"> </div>


    <table id="tabelAtas">
        <tr>
            <td>
                <!--    Keranjang Belanja-->
                <a href="Keranjang.php?id=<?php echo $_SESSION['Username']; ?>">
                    <img src="../Gambar/Cart.png" width="35px" height="35px" id="keranjang">
                </a>
                <!--    Keranjang Belanja-->
            </td>
            <td>
                <!--    Login dan Sign In-->
                <div id="dropdown">
                    <button id="btnLogin"> <?php echo $_SESSION['Username']; ?> </button>

                    <div id="dropdown-child">
                        <a href="Profil.php"> <button> Profil </button> </a>
                        <a href="History.php"> <button> History Transaksi </button> </a>
                    </div>
                </div>

<!--                <a href="logout.php">-->
                    <button onclick="konfirmasi()" id="btnDaftar">Log out</button>
<!--                </a>-->
                <!--    Login dan Sign In-->
            </td>
        </tr>
    </table>
</div>


<?php
$sql = "SELECT * FROM Produk ";
$result = mysqli_query($conn, $sql);

while($a=mysqli_fetch_array($result)) {
?>


<!--KOTAK KATEGORI-->
<a href="PilihKategori.php?id='Tas Selempang'">
    <div id="kategori1">
        <table align="center" style="margin-top: 10px">
            <tr>
                <td>
                    <img src="../Gambar/selempang.png" style="height: 100px; width: 80px">
                </td>
                <td>
                    Tas <br>
                    Selempang
                </td>
            </tr>
        </table>
    </div>
</a>


<a href="PilihKategori.php?id='Backpack'">
    <div id="kategori2">
        <table align="center" style="margin-top: 10px">
            <tr>
                <td>
                    <img src="../Gambar/backpack.png" style="height: 100px; width: 90px">
                </td>
                <td>
                    Backpack
                </td>
            </tr>
        </table>
    </div>
</a>


<a href="PilihKategori.php?id='Tas Pinggang'">
    <div id="kategori3">
        <table align="center" style="margin-top: 10px">
            <tr>
                <td>
                    <img src="../Gambar/pinggang.png" style="height: 100px; width: 100px">
                </td>
                <td>
                    Tas<br>
                    Pinggang
                </td>
            </tr>
        </table>
    </div>
</a>


<a href="PilihKategori.php?id='Tote Bag'">
    <div id="kategori4">
        <table align="center" style="margin-top: 10px">
            <tr>
                <td>
                    <img src="../Gambar/totebag.png" style="height: 90px; width: 80px">
                </td>
                <td>
                    Tote Bag
                </td>
            </tr>
        </table>
    </div>
</a>


<a href="PilihKategori.php?id='Tas Carrier'">
    <div id="kategori5">
        <table align="center" style="margin-top: 10px">
            <tr>
                <td>
                    <img src="../Gambar/Carrier.png" style="height: 100px; width: 110px">
                </td>
                <td>
                    Tas<br>
                    Carrier
                </td>
            </tr>
        </table>
    </div>
</a>


<a href="PilihKategori.php?id='Tas Laptop'">
    <div id="kategori6">
        <table align="center" style="margin-top: 10px">
            <tr>
                <td>
                    <img src="../Gambar/laptop.png" style="height: 80px; width: 80px">
                </td>
                <td>
                    Tas<br>
                    Laptop
                </td>
            </tr>
        </table>
    </div>
</a>


<a href="PilihKategori.php?id='Travel'">
    <div id="kategori7">
        <table align="center" style="margin-top: 10px">
            <tr>
                <td>
                    <img src="../Gambar/travel.png" style="height: 100px; width: 80px">
                </td>
                <td>
                    Travel
                </td>
            </tr>
        </table>
    </div>
</a>


<a href="PilihKategori.php?id='Tas Kantor'">
    <div id="kategori8">
        <table align="center" style="margin-top: 10px">
            <tr>
                <td>
                    <img src="../Gambar/bisnis.png" style="height: 100px; width: 80px">
                </td>
                <td>
                    Tas<br>
                    Kantor
                </td>
            </tr>
        </table>
    </div>
</a>

<?php
}
?>
<!--KOTAK KATEGORI-->



<!--START KOTAK MENU KATEGORI-->
<div>

</div>
<!--START KOTAK MENU KATEGORI-->


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




</body>
</html>