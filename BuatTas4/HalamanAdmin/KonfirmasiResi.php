<?php
include '../Function/config.php';

session_start();

if (!isset($_SESSION['Username2'])) {
    header("Location: ../index.php");
}

if (isset($_POST['SubmitResi'])) {
    $ResiPengiriman = $_POST['ResiPengiriman'];
    $IDTransaksi = $_POST['IDTransaksi'];
    $StatusPembayaran = 'Sudah Dikirim';
    $query = "UPDATE Transaksi SET ResiPengiriman = '$ResiPengiriman', StatusPembayaran = '$StatusPembayaran'
            WHERE IDTransaksi = $IDTransaksi";
    $hasil = mysqli_query($conn, $query);

    if ($hasil){
        echo "<script>alert('Update Resi Berhasil'); history.go(-2);</script>";
    } else{
        echo "<script>alert('Update Resi Gagal')</script>";
    }
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
            top: 170px;
            left: 270px;
            width: 800px;
            /*height: 350px;*/
            font-family: "Comic Sans MS";
            color: #155799;
        }

        #tabelInput {
            width: 800px;
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

        .lihatproduk2 {
            background-color: white;
            color: #155799;
            border: 2px solid #155799;
            box-shadow: 0px 2px 8px 0px rgba(0, 0, 0, 0.2);
            text-align: center;
            margin: -5px -5px;
            padding: 10px 15px;
            font-family: "Comic Sans MS";
        }
        /*END CSS TOMBOL BIRU*/

        #Back {
            position: absolute;
            top: 20px;
            left: 50px;
            cursor: pointer;
        }
        h2{
            position: absolute;
            top: 140px;
            left: 530px;
            text-align: center;
            color: #155799;
        }



        /*CSS OVERLAY BUKTI PEMBAYARAN*/
        #container1{
            position: absolute;
            top: 0px;
            left: 0px;
            right: 0px;
            width: 100%;
            height: 1010px;
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
            right: 460px;
            top: 40px;
            /*margin: 80px auto;*/
            padding: 20px 40px 40px;
            text-align: center;
            /*background: #fff;*/
            /*border: 1px solid #ccc;*/
        }


        .login-container::before,.login-container::after{
            content: "";
            position: absolute;
            width: 100%;height: 100%;
            top: 3.5px;left: 0;
            z-index: -1;
            -webkit-transform: rotateZ(4deg);
            -moz-transform: rotateZ(4deg);
            -ms-transform: rotateZ(4deg);
            /*background: #fff;*/
            /*border: 1px solid #ccc;*/
        }

        .login-container::after{
            top: 5px;
            z-index: -2;
            -webkit-transform: rotateZ(-2deg);
            -moz-transform: rotateZ(-2deg);
            -ms-transform: rotateZ(-2deg);
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

        /*END CSS OVERLAY BUKTI PEMBAYARAN*/



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

<a href="DaftarSudahBayar.php">
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


<?php
$id = $_GET['id'] ;

$sql = "SELECT SUM(k.TotalBelanjaan), k.IDTransaksi, t.TglTransaksi, t.JasaPengiriman,
            t.OngkosKirim, t.MetodePembayaran, t.BuktiPembayaran, t.LayananJasaKirim,
            t.StatusPembayaran, u.Username
        FROM Keranjang as k 
        JOIN Transaksi as t
        ON k.IDTransaksi = t.IDTransaksi
        JOIN User as u
        ON k.IDUser = u.IDUser
        JOIN Produk as p
        ON k.IDProduk = p.IDProduk
        WHERE k.IDTransaksi = $id";
$result = mysqli_query($conn, $sql);

while ($a = mysqli_fetch_array($result)) {
?>

<form method="POST">
    <div id="formInput">
        <table id="tabelInput">
            <tr>
                <td colspan="3">
                    <button class="lihatproduk2" type="button"> USERNAME: <?php echo $a['Username']; ?> </button>
                    <button class="lihatproduk2" type="button">
                        <?php echo date('d F Y h:i:sa', strtotime($a['TglTransaksi'])); ?> </button>
                    <input name="IDTransaksi" type="number" value="<?php echo $a['IDTransaksi']; ?>" hidden>
                </td>
            </tr>
            <?php
            $sql2 = "SELECT k.TotalBelanjaan, k.JumlahBarang, p.Variasi, k.IDTransaksi,k.IDProduk, 
                    p.NamaProduk, p.Foto1, p.Berat
            FROM Keranjang as k
            JOIN Produk as p
            ON k.IDProduk = p.IDProduk
            WHERE k.IDTransaksi = $id";
            $result2 = mysqli_query($conn, $sql2);

            while ($b = mysqli_fetch_array($result2)) {
            ?>
            <tr>
                <td style="width: 120px; padding-left: 20px" align="center">
                    <br>
                    <?php
                    echo "<img src='../GambarProduk/".$b['Foto1']."' style='max-width: 100px; max-height: 100px;' >";
                    ?>
                </td>
                <td>
                    <br>
                    <div style="font-size: 22px;"> <?php echo $b['NamaProduk']; ?> </div>
                    <div style="font-size: 12px;"> <?php echo $b['Variasi']; ?>
                        (Jumlah: <?php echo $b['JumlahBarang']; ?>) <br>
                        Berat: <?php echo $b['Berat']; ?> gram
                    </div>
                </td>
                <td style="width: 170px; padding-left: 20px" align="center">
                    <br>
                    Rp <?php echo number_format($b['TotalBelanjaan'],0,'','.');

                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <br><br>
                    Jasa Pengiriman: <?php echo $a['JasaPengiriman'] . " - " . $a['LayananJasaKirim']; ?> <br>
                    Ongkos Kirim: Rp <?php echo number_format($a['OngkosKirim'],0,'','.'); ?>
                </td>
                <td style="width: 320px;" align="center">
                    <br><br>

                    <a href="#container1">
                        <button class="lihatproduk" type="button"> Lihat Bukti Pembayaran</button>
                    </a>

                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <br>
                    Metode Pembayaran: <?php echo $a['MetodePembayaran']; ?>
                </td>
            </tr>
            <tr>
                <td colspan="3" align="center">
                    <br>
                    <?php
                    $TotalBelanjaan = $a['SUM(k.TotalBelanjaan)'];
                    $OngkosKirim = $a['OngkosKirim'];
                    ?>
                    <B>TOTAL BELANJAAN DAN ONGKOS KIRIM: RP <?php echo number_format(($TotalBelanjaan + $OngkosKirim),0,'','.'); ?> </B>
                </td>

            </tr>
            <tr>
                <td colspan="3" align="center">
                    <br>

                    <input name="ResiPengiriman" class="lihatproduk2" type="text" placeholder="Masukan Resi Pengiriman">

                    <button name="SubmitResi" class="lihatproduk"> Update Resi Pengiriman</button>
                </td>
            </tr>
        </table>
        <br><br><br><br>
    </div>
</form>


<!--START OVERLAY BUKTI EMBAYARAN-->
<div class="container" id="container1">
    <div class="login-container">
        <a href="#" class="close"> X </a>
        <?php
        if (!empty($a['BuktiPembayaran'])) {
            echo "<img src='../GambarBukti/" . $a['BuktiPembayaran'] . "' style='max-width: 550px; max-height: 580px;'>";
        } else{
            echo "<div style='width: 400px; height: 300px; background-color: white; font-size: 36px; color: #155799'>
                    <br>Pengguna belum mengunggah bukti pembayaran</div>";
        }
        }
        ?>
    </div>
</div>
<!-- END OVERLAY BUKTI EMBAYARAN-->



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