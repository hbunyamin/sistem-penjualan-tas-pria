<?php

session_start();

if (!isset($_SESSION['Username'])) {
    header("Location: ../index.php");
}

include '../Function/config.php';

$id = $_GET['id'] ;
$Username = $_SESSION['Username'];


//START KODE GANTI METODE BAYAR
if (isset($_POST['SubmitGantiMetode'])) {
    $OpsiPembayaran = $_POST['OpsiPembayaran'];

    $query = "UPDATE Transaksi SET MetodePembayaran = '$OpsiPembayaran'
                        WHERE TglTransaksi = '$id'";
    $hasil = mysqli_query($conn, $query);

    if ($hasil){
        echo "<script>alert('Berhasil mengubah metode pembayaran')</script>";
    } else{
        echo "<script>alert('Gagal mengubah metode pembayaran')</script>";
    }
}
//END KODE GANTI METODE BAYAR


//START UPLOAD BUKTI
if (isset($_POST['SubmitBuktiBayar'])) {
    $BuktiPembayaran =$_FILES['UploadFoto']['name'];
    $tmp_file = $_FILES['UploadFoto']['tmp_name'];
    $path = "../GambarBukti/".$BuktiPembayaran;
    $StatusPembayaran = 'Pembayaran belum di konfirmasi admin';

    move_uploaded_file($tmp_file, $path);

    $query2 = "UPDATE Transaksi SET BuktiPembayaran = '$BuktiPembayaran', StatusPembayaran = '$StatusPembayaran'
            WHERE TglTransaksi = '$id'";
    $hasil2 = mysqli_query($conn, $query2);

    if ($hasil2){
        echo "<script>alert('Upload Bukti Pembayaran Berhasil'); history.go(-2);</script>";
    } else{
        echo "<script>alert('Upload Bukti Pembayaran Gagal')</script>";
    }

}
//END UPLOAD BUKTI


//START KODE TAMPILKAN DATA
$sql = "SELECT * FROM Transaksi WHERE TglTransaksi = '$id'";
$result = mysqli_query($conn, $sql);
while ($a = mysqli_fetch_array($result)){

$MetodePembayaran = $a['MetodePembayaran'];

$sql2 = "SELECT k.IDKeranjang, SUM(k.TotalBelanjaan), k.JumlahBarang, k.Variasi,
            p.IDProduk, u.IDUser, u.Username, t.IDTransaksi, t.TglTransaksi
    FROM Keranjang as K
    JOIN Produk as p
    ON k.IDProduk = p.IDProduk
    JOIN User as u
    ON k.IDUser = u.IDUser
    JOIN Transaksi as t 
    ON k.IDTransaksi = t.IDTransaksi
    WHERE t.TglTransaksi = '$id' AND u.Username = '$Username'";
$result2 = mysqli_query($conn, $sql2);
while ($b = mysqli_fetch_array($result2)){

$sql3 = "SELECT * FROM DataPembayaran WHERE NamaBank = '$MetodePembayaran'";
$result3 = mysqli_query($conn, $sql3);
while ($c = mysqli_fetch_array($result3)){

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

        /*Start CSS Div Profil*/
        h2 {
            position: absolute;
            top: 140px;
            left: 500px;
            text-align: center;
            color: #155799;
        }

        #TabelProfil {
            position: absolute;
            top: 250px;
            left: 160px;
            height: 410px;
            width: 970px;
            background-color: #edf5f4;
            border: 2px solid #155799;
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
            color: #155799;
        }

        .lihatproduk:hover {
            background-color: #155799;
            color: white;
        }

        .lihatproduk2 {
            background-color: #155799;
            color: white;
            border: 2px solid black;
            border-radius: 5px;
            box-shadow: 0px 2px 8px 0px rgba(0, 0, 0, 0.2);
            text-align: center;
            margin: 5px 2px;
            padding: 10px 15px;
            cursor: pointer;
        }

        /*End CSS Div Profil*/


        /*CSS FOOTER*/
        #footerbawah {
            position: fixed;
            width: 100%;
            right: 0px;
            left: 0px;
            bottom: 0px;

            background-color: black;
            /*top:800px;*/
            color: white;
            text-align: center;
        }

        /*END CSS FOOTER*/

        #Back {
            position: absolute;
            top: 20px;
            left: 50px;
            cursor: pointer;
        }

        #tabelAlamat {
            position: absolute;
            top: 250px;
            left: 260px;
            width: 800px;
            height: 125px;
            color: #155799;
            border: 2px solid #155799;
            background-color: #edf5f4;
            font-family: "Comic Sans MS";
        }

        #tabelBank {
            width: 650px;
            color: #155799;
            border: 2px solid #155799;
            background-color: #edf5f4;
            /*text-align: center;*/
        }

        #kotakBank {
            position: absolute;
            top: 250px;
            left: 320px;
            width: 650px;
            margin-bottom: 150px;
            /*height: 125px;*/
            /*max-height: max-content;*/
            /*color: #155799;*/
            /*border: 2px solid #155799;*/
            /*background-color: #edf5f4;*/
            /*font-family: "Comic Sans MS";*/
            /*text-align: center;*/
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


<div id="kotakbiru">
    <a href="berhasil_login.php">
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
            <div id="dropdown">
                <button id="btnLogin"> <?php echo $_SESSION['Username']; ?> </button>

                <div id="dropdown-child">
                    <a href="Profil.php">
                        <button> Profil</button>
                    </a>
                    <a href="History.php">
                        <button> History Transaksi</button>
                    </a>
                </div>
            </div>

            <!--                <a href="logout.php">-->
            <button onclick="konfirmasi()" id="btnDaftar">LOG OUT</button>
            <!--                </a>-->
            <!--    Login dan Sign In-->
        </td>
    </tr>
</table>


<h2> INFORMASI PEMBAYARAN </h2>


<div id="kotakBank">
    <!--START TABEL BELANJAAN-->
    <form method="POST" enctype="multipart/form-data">
        <table id="tabelBank">
            <tr>
                <td align="right">
                    Nama Bank
                </td>
                <td>
                    :
                </td>
                <td align="center">
                    <?php echo $c['NamaBank']; ?>
                </td>
            </tr>
            <tr>
                <td align="right">
                    No. Rekening
                </td>
                <td>
                    :
                </td>
                <td align="center">
                    <?php echo $c['NoRek']; ?>
                </td>
            </tr>
            <tr>
                <td align="right">
                    Atas Nama
                </td>
                <td>
                    :
                </td>
                <td align="center">
                    <?php echo $c['NamaPemilik']; ?>
                </td>
            </tr>
            <tr>
                <td colspan="3" align="center">
                    <br> Jumlah yang harus dibayar: Rp
                    <?php
                    $TotalBelanjaan = $b['SUM(k.TotalBelanjaan)'];
                    $OngkosKirim = $a['OngkosKirim'];
                    echo $TotalBelanjaan + $OngkosKirim;
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="3" align="center">
                    <br><br>
                    <form method="POST">
                        <button name="GantiMetode" id="btnGanti" class="lihatproduk" type="button"
                                onclick="yesnoCheck()"> Ganti Metode Pembayaran
                        </button>
                        <br>
                        <select name="OpsiPembayaran" id="SelectBank" class="lihatproduk" style="display: none">
                            <?php

                            $query2 = "SELECT NamaBank FROM DataPembayaran";
                            $hasil2 = mysqli_query($conn, $query2);
                            while ($row = mysqli_fetch_array($hasil2)) {
                                ?>
                                <option value="<?php echo $row['NamaBank'] ?>"><?php echo $row['NamaBank'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <button name="SubmitGantiMetode" id="SubmitBank" class="lihatproduk"
                                style="display: none"> Submit
                        </button>
                    </form>
                </td>
            </tr>
            <tr>
                <td colspan="3" align="center">
                    <input name='UploadFoto' type='file' class='lihatproduk' style='margin-top: 30px; margin-right: 23px;'>
                    <button name="SubmitBuktiBayar" class="lihatproduk"> Unggah Bukti Pembayaran</button>
                </td>
            </tr>
        </table>
    </form>
    <!--END TABEL BELANJAAN-->
    <br><br>
</div>

<?php
}
}
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


<!--START HALAMAN MUNDUR SELANGKAH-->
<script>
    function mundur{
        history.go(-1);
    }
</script>
<!--END HALAMAN MUNDUR SELANGKAH-->


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


<!--START SEMBUNYIKAN SELECT BANK-->
<script type="text/javascript">
    function yesnoCheck() {
        document.getElementById('SelectBank').style.display = 'INLINE-BLOCK';
        document.getElementById('SubmitBank').style.display = 'INLINE-BLOCK';
    }
</script>
<!--START SEMBUNYIKAN SELECT BANK-->


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