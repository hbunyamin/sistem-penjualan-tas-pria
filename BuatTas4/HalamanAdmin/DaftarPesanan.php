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


        /*.form-box2 input{*/
        /*    width: 100%;*/
        /*    padding: 10px;*/
        /*    text-align: center;*/
        /*    height:20px;*/
        /*    border: 1px solid #ccc;;*/
        /*    background: #fafafa;*/
        /*    transition:0.2s ease-in-out;*/
        /*}*/

        .form-box2 input:focus {
            outline: 0;
            background: #eee;
        }

        .form-box2 input[type="text"] {
            border-radius: 5px 5px 0 0;
            /*text-transform: lowercase;*/
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


        #tabelAtas {
            position: absolute;
            top: 15px;
            right: 50px;
            /*border: 2px solid #155799;*/
            max-height: 45px;
            max-width: 600px;
        }

        /*CSS BUTTON LOGIN DAN SIGN IN*/
        #btnLogin {
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
            /*top: 25px;*/
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


        /*START CSS FOOTER*/
        #footerbawah {
            background-color: black;
            width: 100%;
            height: 50px;
            position: absolute;
            right: 0px;
            left: 0px;
            top: 600px;
            color: white;
            vertical-align: center;
            text-align: center;
            font-size: 20px;
        }

        /*END CSS FOOTER*/


        /*START CSS FORM*/
        #formInput {
            position: absolute;
            top: 230px;
            left: 390px;
            width: 550px;
            /*height: 350px;*/
            font-family: "Comic Sans MS";
            color: #155799;
        }

        #tabelInput {
            width: 550px;
            background-color: #edf5f4;
            border: 2px solid #155799;
            border-radius: 3%;
        }

        /*END CSS FORM*/


        /*CSS TOMBOL BIRU*/
        .lihatproduk {
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

        .lihatproduk:hover {
            font-family: "Comic Sans MS";
            background-color: #155799;
            color: white;
        }

        /*END CSS TOMBOL BIRU*/

        #Back {
            position: absolute;
            top: 20px;
            left: 50px;
        }
        h2{
            position: absolute;
            top: 140px;
            left: 500px;
            text-align: center;
            color: #155799;
        }


        a:link {
            color: white
        }

        a:visited {
            color: #E0FFFF
        }
    </style>

</head>
<body>


<div id="kotakbiru"></div>

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


<h2> KONFIRMASI PESANAN </h2>

<?php
$sql = "SELECT k.IDKeranjang, k.IDUser, k.IDTransaksi, t.TglTransaksi, t.StatusPembayaran, u.Username
        FROM Keranjang as k 
        JOIN Transaksi as t 
        ON k.IDTransaksi = t.IDTransaksi
        JOIN User as u
        ON k.IDUser = u.IDUser
        WHERE t.StatusPembayaran = 'Pembayaran belum di konfirmasi admin'
        GROUP BY k.IDTransaksi";
$result = mysqli_query($conn, $sql);

while ($a = mysqli_fetch_array($result)) {
?>


<div id="formInput">
    <table id="tabelInput">
        <tr>
            <td>
                ID Transaksi
            </td>
            <td>
                :
            </td>
            <td>
                <?php echo $a['IDTransaksi']; ?>
            </td>
        </tr>
        <tr>
            <td>
                Tanggal Transaksi
            </td>
            <td>
                :
            </td>
            <td>
                <?php echo date('d F Y h:i:sa', strtotime($a['TglTransaksi'])); ?>
            </td>
        </tr>
        <tr>
            <td>
                Username
            </td>
            <td>
                :
            </td>
            <td>
                <?php echo $a['Username']; ?>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <a href="KonfirmasiPesanan.php?id=<?php echo $a['IDTransaksi']; ?>">
                    <button class="lihatproduk"> LIHAT PESANAN </button>
                </a>
            </td>
        </tr>
        <br>
        <?php
        }
        ?>
    </table>
    <br><br><br><br><br>
</div>


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