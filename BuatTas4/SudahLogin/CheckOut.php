<?php
//PERCOBAAN SISTEM BARU

session_start();

if (!isset($_SESSION['Username'])) {
    header("Location: ../index.php");
}

include '../Function/config.php';

//$id = $_GET['id'] ;
$id = $_SESSION['Username'];

if(isset($_POST['btnPesanan'])) {
    date_default_timezone_set('Asia/Jakarta');
//    $IDProduk = $_POST['IDProduk'];
    $NamaProduk = implode(",", $_POST['NamaProduk']);
    $OpsiPembayaran = $_POST['OpsiPembayaran'];
    $Variasi = implode(",", $_POST['Variasi']);
    $TglTransaksi = date( 'Y-m-d h:i:sa' );
    $TotalHargaBelanjaan = $_POST['TotalHargaBelanjaan'];
    $StatusPembayaran = 'Belum Bayar';
    $Alamat = $_POST['Alamat'];
    $NmrHp = $_POST['NmrHP'];
    $Kota = $_POST['Kota'];

    $TotalBerat = $_POST['TotalBerat'];
    $OpsiPengiriman = $_POST['kurir'];

    if ($OpsiPengiriman == "jne"){
        $ongkir = $_POST['ongkir2'];
        $Tampillayanan = $_POST['Tampillayanan2'];
    } elseif ($OpsiPengiriman == "tiki"){
        $ongkir = $_POST['ongkir3'];
        $Tampillayanan = $_POST['Tampillayanan3'];
    } else if ($OpsiPengiriman == "pos"){
        $ongkir= $_POST['ongkir3'];
        $Tampillayanan = $_POST['Tampillayanan3'];
    }



    $JumlahBarang = implode(",", $_POST['JumlahBarang']);

//    $query5 = "SELECT Harga FROM Pengiriman WHERE NamaEkspedisi = '$OpsiPengiriman'";
//    $hasil5 = mysqli_query($conn, $query5);
//    while ($e = mysqli_fetch_array($hasil5)) {
//        $OngkosKirim = $e['Harga'];
//        $HargaTotal = $TotalHargaBelanjaan + $ongkir;
        $id = $_SESSION['Username'];

        $query6 = "SELECT IDUser FROM User WHERE Username = '$id'";
        $hasil6 = mysqli_query($conn, $query6);
        while ($f = mysqli_fetch_array($hasil6)) {
            $IDUser = $f['IDUser'];


            if ($Alamat == null OR $NmrHp == null OR $Kota == null ) {
                echo "<script>alert('Alamat dan No. HP tidak boleh kosong')</script>";
            } elseif ($OpsiPengiriman == null OR $Tampillayanan == null ){
                echo "<script>alert('Pilih Opsi Pengiriman!')</script>";
            } else {

                $sql7 = "INSERT INTO Transaksi (TglTransaksi, JasaPengiriman, OngkosKirim, 
            MetodePembayaran, StatusPembayaran, LayananJasaKirim)
            VALUES ('$TglTransaksi', '$OpsiPengiriman', $ongkir, '$OpsiPembayaran',
                    '$StatusPembayaran', '$Tampillayanan')";
                $result7 = mysqli_query($conn, $sql7);

                if ($result7) {
                    $query9 = "SELECT k.JumlahBarang, k.IDProduk, k.IDUser, k.IDTransaksi, p.IDProduk
                           FROM Keranjang as k
                           JOIN Produk as p
                           ON p.IDProduk = k.IDProduk
                           WHERE k.IDUser = $IDUser AND k.IDTransaksi IS NULL";
                    $result9 = mysqli_query($conn, $query9);
//                    $g = mysqli_fetch_array($result9);
                    while ($g = mysqli_fetch_array($result9)) {

                        $IDproduk = $g['IDProduk'];
                        $JumlahBarang = $g['JumlahBarang'];

                        $query10 = "UPDATE Produk SET Stock = Stock - $JumlahBarang WHERE IDProduk = $IDproduk";
                        $result10 = mysqli_query($conn, $query10);
                    }

                    $query8 = "UPDATE Keranjang SET IDTransaksi =
                (SELECT IDTransaksi FROM Transaksi WHERE TglTransaksi = '$TglTransaksi') 
                WHERE IDUser = $IDUser AND IDTransaksi IS NULL ";
                    $result8 = mysqli_query($conn, $query8);

                    if ($result8 && $result9) {
                        echo "<script> window.location.href = 'TampilRincianBayar.php?id=" . $TglTransaksi . "'; </script>";
                    } else {
                        echo "<script>alert('CheckOut MUNGKIN BERHASIL Lagi')</script>";
                    }
                } else {
                    echo "<script>alert('CheckOut Gagal')</script>";
                }

            }
        }
//    }
//    }
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
            left: 600px;
            text-align: center;
            color: #155799;
        }
        #TabelProfil{
            position: absolute;
            top: 250px;
            left: 160px;
            height: 410px;
            width: 970px;
            background-color: #edf5f4;
            border: 2px solid #155799;
        }
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
        }
        .lihatproduk:hover{
            background-color: #155799;
            color: white;
        }
        .lihatproduk2{
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
        #footerbawah{
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

        #Back{
            position: absolute;
            top: 20px;
            left: 50px;
            cursor: pointer;
        }

        #tabelAlamat{
            position: absolute;
            top: 250px;
            left: 260px;
            width:800px;
            height: 125px;
            color: #155799;
            border: 2px solid #155799;
            background-color: #edf5f4;
            font-family: "Comic Sans MS";
        }

        #tabelBelanjaan{
            width: 800px;
            color: #155799;
            border: 2px solid #155799;
            background-color: #edf5f4;
            text-align: center;
        }
        #kotakBelanjaan{
            position: absolute;
            top: 450px;
            left: 260px;
            width: 800px;
            margin-bottom: 150px;
            /*height: 125px;*/
            /*max-height: max-content;*/
            /*color: #155799;*/
            /*border: 2px solid #155799;*/
            /*background-color: #edf5f4;*/
            /*font-family: "Comic Sans MS";*/
            /*text-align: center;*/
        }


        a:link {color:white}
        a:visited {color: #E0FFFF}
    </style>

    <script type="text/javascript">


        function yesnoCheck() {
            if (document.getElementById('jne').selected) {
                document.getElementById('SembunyikanJNE').style.display = 'INLINE-BLOCK';
                document.getElementById('SembunyikanTIKI').style.display = 'none';
                document.getElementById('SembunyikanPOS').style.display = 'none';

            } if (document.getElementById('tiki').selected) {
                document.getElementById('SembunyikanTIKI').style.display = 'INLINE-BLOCK';
                document.getElementById('SembunyikanJNE').style.display = 'none';
                document.getElementById('SembunyikanPOS').style.display = 'none';

            } if (document.getElementById('pos').selected){
                document.getElementById('SembunyikanPOS').style.display = 'INLINE-BLOCK';
                document.getElementById('SembunyikanJNE').style.display = 'none';
                document.getElementById('SembunyikanTIKI').style.display = 'none';
            }

        }
    </script>

    <script src="asset/jquery-3.6.0.min.js"></script>

</head>
<body>



<div id="kotakbiru">
    <!--    <a href="">-->
    <img src="../Gambar/Back.png" width="55px" height="55px" id="Back" onclick="history.go(-1);">
    <!--    </a>-->
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



<h2> CHECKOUT </h2>

<?php
$sql = "SELECT k.IDKeranjang, k.JumlahBarang, k.IDProduk, k.IDUser, p.Variasi, p.NamaProduk, p.Harga, 
            u.Username, u.Alamat, u.NamaDepan, u.NamaBelakang, u.NmrHP, u.Kota
            FROM Keranjang as k
            JOIN Produk as p
            ON k.IDProduk = p.IDProduk
            JOIN User as u
            ON k.IDUser = u.IDUser
            WHERE u.Username = '$id'";
$result = mysqli_query($conn, $sql);

$a = mysqli_fetch_array($result);
//while ($a = mysqli_fetch_array($result)) {

//    START UNTUK MEMUNCULKAN NAMA KOTA DI ALAMAT
    $kota_asal1 = 23;
    $kota_tujuan1 = $a['Kota'];
    $kurir1 = "jne";
    $berat1 = 1*1000;

    if ($kota_tujuan1 != null) {
        $curl1 = curl_init();
        curl_setopt_array($curl1, array(
            CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //	  CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=" . $kota_asal1 . "&destination=" . $kota_tujuan1 . "&weight=" . $berat1 . "&courier=" . $kurir1 . "",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: 346f196e1c7a87d972d5f18ac622986b"
            ),
        ));
        $response1 = curl_exec($curl1);
        $err1 = curl_error($curl1);
        curl_close($curl1);
        $data1 = json_decode($response1, true);
        $kurir1 = $data1['rajaongkir']['results'][0]['name'];
        $kotaasal1 = $data1['rajaongkir']['origin_details']['city_name'];
        $provinsiasal1 = $data1['rajaongkir']['origin_details']['province'];
        $kotatujuan1 = $data1['rajaongkir']['destination_details']['city_name'];
        $provinsitujuan1 = $data1['rajaongkir']['destination_details']['province'];
        $berat1 = $data1['rajaongkir']['query']['weight'] / 1000;

    }
////    END UNTUK MEMUNCULKAN NAMA KOTA DI ALAMAT

    ?>


    <!--START KOTAK ALAMAT-->
    <table id="tabelAlamat">
        <tr>
            <td align="center" colspan="2">
                <b> ALAMAT </b> <br>
                <hr color="#155799">
            </td>
        </tr>
        <tr>
            <td>
                <form method="POST">
                    <?php echo $a['NamaDepan']?>
                    <?php echo $a['NamaBelakang']?>
                    <input name="NmrHP" type="text" value="<?php echo $a['NmrHP']?>" hidden>
                    <?php
                    if ($a['NmrHP'] != null) {
                        echo $a['NmrHP'];
                    } else{
                        echo "(No. Hp Kosong)";
                    }
                    ?> <br>
                    <input name="Alamat" type="text" value="<?php echo $a['Alamat']?>" hidden>
                    <input name="Kota" id="Kota" type="number" value="<?php echo $a['Kota']?>" hidden>
                    <?php
                    if ($a['Alamat'] != null AND $a['Kota'] != null ) {
                        echo $a['Alamat']. " Kota ". $kotatujuan1;
                    } elseif ($a['Alamat'] != null AND $a['Kota'] == null) {
                        echo $a['Alamat'];
                    } elseif ($a['Alamat'] == null AND $a['Kota'] != null){
                        echo $kotatujuan1;
                    }else {
                        echo "(Alamat kosong)";
                    }
                    ?>
            </td>
            <td>
                <a href="UbahProfil.php?id=<?php echo $_SESSION['Username'] ?>">
                    <button name="GantiAlamat" type="button" class="lihatproduk"> Lengkapi profil </button>
                </a>
            </td>
        </tr>
    </table>
    <!--END KOTAK ALAMAT-->
    <?php
//}
?>

<div id="kotakBelanjaan">
    <!--START TABEL BELANJAAN-->
    <!--    <form method="POST">-->
    <table id="tabelBelanjaan">
        <tr>
            <th> produk </th>
            <th> variasi </th>
            <th> jumlah </th>
            <th> harga </th>
        </tr>
        <?php
        $id = $_SESSION['Username'];

        $sql2 = "SELECT k.IDKeranjang, k.JumlahBarang, k.IDProduk, k.IDUser, p.Variasi, k.IDTransaksi, p.IDProduk,
                    p.NamaProduk, p.Harga, u.Username, k.TotalBelanjaan, p.Foto1, k.JumlahBerat
                FROM Keranjang as k
                JOIN Produk as p
                ON k.IDProduk = p.IDProduk
                JOIN User as u
                ON k.IDUser = u.IDUser
                WHERE u.Username = '$id' AND k.IDTransaksi IS NULL";
        $result2 = mysqli_query($conn, $sql2);

        while ($b = mysqli_fetch_array($result2)){
            ?>
            <tr>
                <td>
                    <?php
                    echo "<img src='../GambarProduk/".$b['Foto1']."' style='max-width: 100px; max-height: 100px;' ><br>";
                    ?>
                    <input type="text" name="IDProduk[]"
                           value="<?php echo $b['IDProduk']; ?>" hidden>
<!--                    --><?php //echo $b['IDProduk']; ?>

                    <input type="text" name="NamaProduk[]"
                           value="<?php echo $b['NamaProduk']; ?>" hidden>
                    <?php echo $b['NamaProduk']; ?>
                </td>
                <td>
                    <input type="text" name="Variasi[]"
                           value="<?php echo $b['Variasi']; ?>" hidden>
                    <?php echo $b['Variasi']; ?>
                </td>
                <td>
                    <input type="number" name="JumlahBarang[]"
                           value="<?php echo $b['JumlahBarang']; ?>" hidden>
                    <?php echo $b['JumlahBarang']; ?>
                </td>
                <td>
                    <input type="number" name="TotalBelanjaan"
                           value="<?php echo $b['TotalBelanjaan']; ?>" hidden>
                    <?php echo "Rp" . number_format($b['TotalBelanjaan'],0,'','.'); ?>
                </td>
            </tr>
            <?php

        }
        ?>
        <tr>
            <td colspan="2" >
                <br><br>
                TOTAL BELANJAAN:
            </td>
            <td colspan="2">
                <br><br>
                <?php
                $sql3 = "SELECT k.IDKeranjang, k.JumlahBarang, k.IDProduk, k.IDUser, p.Variasi, p.NamaProduk, 
                        p.Harga, u.Username, SUM(k.TotalBelanjaan), SUM(k.JumlahBerat)
                FROM Keranjang as k
                JOIN Produk as p
                ON k.IDProduk = p.IDProduk
                JOIN User as u
                ON k.IDUser = u.IDUser
                WHERE u.Username = '$id' AND k.IDTransaksi IS NULL";
                $result3 = mysqli_query($conn, $sql3);

                $ccc = mysqli_fetch_array($result3);
//                while ($c = mysqli_fetch_array($result3)) {

                    ?>

                    <input type="number" name="TotalHargaBelanjaan" value="<?php echo $ccc['SUM(k.TotalBelanjaan)']?>" hidden>
                    <input type="number" name="TotalBerat" value="<?php echo $ccc['SUM(k.JumlahBerat)']?>" hidden>

                    <?php
                    echo "Rp " . number_format($ccc['SUM(k.TotalBelanjaan)'],0,'','.') ;
                    echo "<br> (Belum termasuk ongkos kirim)";
//                }
                ?>
            </td>
        </tr>
        <tr >
            <td colspan="2">
<!--                <input type="text" id="berat" name="berat" required="" value="--><?php //echo $ccc['SUM(k.JumlahBerat)']; ?><!--" hidden>-->

                <br>
                Opsi Pengiriman: <br>
                <?php
                if ($a['Kota'] != null) {
                ?>
<!--                    <select class="lihatproduk" id="kurir" name="kurir" onchange="pilihkurir()" required="">-->
                    <select class="lihatproduk" id="kurir" name="kurir" onclick="yesnoCheck()">
                        <option value="">Pilih Opsi Pengiriman</option>
                        <option value="jne" id="jne">JNE</option>
                        <option value="tiki" id="tiki">TIKI</option>
                        <option value="pos" id="pos">POS INDONESIA</option>
                    </select>
                <?php
                } else{
                    echo "<input class='lihatproduk2' value='Lengkapi Alamat terlebih dahulu!' 
                            style='width: 200px' disabled>";
                }
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="3">
<!--            START TABEL JNE-->
                <div id="SembunyikanJNE" style="display: none;">

                <?php
                $kota_asal2 = 23;
                $kota_tujuan2 = $a['Kota'];
                $berattt2 = $ccc['SUM(k.JumlahBerat)'];
                $kurirr2 = "jne";

                if ($kota_tujuan2 != null) {
                    $curl2 = curl_init();
                    curl_setopt_array($curl2, array(
                        CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => "origin=".$kota_asal2."&destination=".$kota_tujuan2."&weight=".$berattt2."&courier=".$kurirr2."",
                        CURLOPT_HTTPHEADER => array(
                            "content-type: application/x-www-form-urlencoded",
                            "key: 346f196e1c7a87d972d5f18ac622986b"
                        ),
                    ));
                    $response2 = curl_exec($curl2);
                    $err2 = curl_error($curl2);
                    curl_close($curl2);
                    $data2= json_decode($response2, true);
                    $kurir2=$data2['rajaongkir']['results'][0]['name'];
                    $kotaasal2=$data2['rajaongkir']['origin_details']['city_name'];
                    $provinsiasal2=$data2['rajaongkir']['origin_details']['province'];
                    $kotatujuan2=$data2['rajaongkir']['destination_details']['city_name'];
                    $provinsitujuan2=$data2['rajaongkir']['destination_details']['province'];
                    $berat2=$data2['rajaongkir']['query']['weight']/1000;

                ?>
                    <table class="table table-striped table-bordered ">
                        <thead>
                        <tr>
                            <th>Nama Layanan</th>
                            <th>Tarif</th>
                            <th>ETD(Estimates Days)</th>
                            <th>Pilih </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($data2['rajaongkir']['results'][0]['costs'] as $value2) {
                            echo "<tr>";
                            echo "<td>".$value2['service']."</td>";

                            foreach ($value2['cost'] as $tarif2) {
                                echo "<td align='right'>Rp " . number_format($tarif2['value'],2,',','.')."</td>";
                                echo "<td>".$tarif2['etd']." D</td>";
                        ?>
                                <td>
                                    <div class="radio">
                                        <label><input type="radio"
                                                      namaekspedisi2="<?php echo $kurirr2; ?>"
                                                      tarif2="<?php echo $tarif2['value']; ?>"
                                                      layanan2="<?php echo $value2['service']; ?>"
                                                      name="pilih_ongkir2" class="pilih_ongkir2"></label>

                                    </div>
                                </td>
                        <?php
                            }

                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>

                    <input name="ongkir2" type="number" id="ongkir2" hidden>
                    <input name="Tampillayanan2" type="text" id="Tampillayanan2" hidden>
                    <input name="TampilKurir2" type="text" id="TampilKurir2" hidden>

                <?php
                }
                ?>

                </div>
<!--            END TABEL JNE-->


<!--            START TABEL TIKI-->
                <div id="SembunyikanTIKI" style="display: none;">

                <?php
                $kota_asal3 = 23;
                $kota_tujuan3 = $a['Kota'];
                $berattt3 = $ccc['SUM(k.JumlahBerat)'];
                $kurirr3 = "tiki";

                if ($kota_tujuan3 != null) {
                    $curl3 = curl_init();
                    curl_setopt_array($curl3, array(
                        CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => "origin=" . $kota_asal3 . "&destination=" . $kota_tujuan3 . "&weight=" . $berattt3 . "&courier=" . $kurirr3 . "",
                        CURLOPT_HTTPHEADER => array(
                            "content-type: application/x-www-form-urlencoded",
                            "key: 346f196e1c7a87d972d5f18ac622986b"
                        ),
                    ));

                    $response3 = curl_exec($curl3);
                    $err3 = curl_error($curl3);
                    curl_close($curl3);
                    $data3= json_decode($response3, true);
                    $kurir3=$data3['rajaongkir']['results'][0]['name'];
                    $kotaasal3=$data3['rajaongkir']['origin_details']['city_name'];
                    $provinsiasal3=$data3['rajaongkir']['origin_details']['province'];
                    $kotatujuan3=$data3['rajaongkir']['destination_details']['city_name'];
                    $provinsitujuan3=$data3['rajaongkir']['destination_details']['province'];
                    $berat3=$data3['rajaongkir']['query']['weight']/1000;

                    ?>
                    <table class="table table-striped table-bordered ">
                        <thead>
                        <tr>
                            <th>Nama Layanan</th>
                            <th>Tarif</th>
                            <th>ETD(Estimates Days)</th>
                            <th>Pilih </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($data3['rajaongkir']['results'][0]['costs'] as $value3) {
                            echo "<tr>";
                            echo "<td>".$value3['service']."</td>";

                            foreach ($value3['cost'] as $tarif3) {
                                echo "<td align='right'>Rp " . number_format($tarif3['value'],2,',','.')."</td>";
                                echo "<td>".$tarif3['etd']." D</td>";
                                ?>
                                <td>
                                    <div class="radio">
                                        <label><input type="radio"
                                                      namaekspedisi3="<?php echo $kurirr3; ?>"
                                                      tarif3="<?php echo $tarif3['value']; ?>"
                                                      layanan3="<?php echo $value3['service']; ?>"
                                                      name="pilih_ongkir3" class="pilih_ongkir3"></label>

                                    </div>
                                </td>
                                <?php
                            }

                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>

                    <input name="ongkir3" type="number" id="ongkir3" hidden>
                    <input name="Tampillayanan3" type="text" id="Tampillayanan3" hidden>
                    <input name="TampilKurir3" type="text" id="TampilKurir3" hidden>

                    <?php
                }

                ?>

                </div>
<!--            END TABEL TIKI-->


<!--            START TABEL POS-->
                <div id="SembunyikanPOS" style="display: none;">

                <?php
                $kota_asal4 = 23;
                $kota_tujuan4 = $a['Kota'];
                $berattt4 = $ccc['SUM(k.JumlahBerat)'];
                $kurirr4 = "pos";

                if ($kota_tujuan4 != null) {
                    $curl4 = curl_init();
                    curl_setopt_array($curl4, array(
                        CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => "origin=" . $kota_asal4 . "&destination=" . $kota_tujuan4 . "&weight=" . $berattt4 . "&courier=" . $kurirr4 . "",
                        CURLOPT_HTTPHEADER => array(
                            "content-type: application/x-www-form-urlencoded",
                            "key: 346f196e1c7a87d972d5f18ac622986b"
                        ),
                    ));

                    $response4 = curl_exec($curl4);
                    $err4 = curl_error($curl4);
                    curl_close($curl4);
                    $data4= json_decode($response4, true);
                    $kurir4=$data4['rajaongkir']['results'][0]['name'];
                    $kotaasal4=$data4['rajaongkir']['origin_details']['city_name'];
                    $provinsiasal4=$data4['rajaongkir']['origin_details']['province'];
                    $kotatujuan4=$data4['rajaongkir']['destination_details']['city_name'];
                    $provinsitujuan4=$data4['rajaongkir']['destination_details']['province'];
                    $berat4=$data4['rajaongkir']['query']['weight']/1000;

                    ?>
                    <table class="table table-striped table-bordered ">
                        <thead>
                        <tr>
                            <th>Nama Layanan</th>
                            <th>Tarif</th>
                            <th>ETD(Estimates Days)</th>
                            <th>Pilih </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($data4['rajaongkir']['results'][0]['costs'] as $value4) {
                            echo "<tr>";
                            echo "<td>".$value4['service']."</td>";

                            foreach ($value4['cost'] as $tarif4) {
                                echo "<td align='right'>Rp " . number_format($tarif4['value'],2,',','.')."</td>";
                                echo "<td>".$tarif4['etd']." D</td>";
                                ?>
                                <td>
                                    <div class="radio">
                                        <label><input type="radio"
                                                      namaekspedisi4="<?php echo $kurirr4; ?>"
                                                      tarif4="<?php echo $tarif4['value']; ?>"
                                                      layanan4="<?php echo $value4['service']; ?>"
                                                      name="pilih_ongkir4" class="pilih_ongkir4"></label>

                                    </div>
                                </td>
                                <?php
                            }

                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>

                    <input name="ongkir4" type="number" id="ongkir4" hidden>
                    <input name="Tampillayanan4" type="text" id="Tampillayanan4" hidden>
                    <input name="TampilKurir4" type="text" id="TampilKurir4" hidden>

                <?php
                }

                ?>

                </div>
<!--            END TABEL POS-->
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <br>
                Opsi Pembayaran: <br>
                <select name="OpsiPembayaran" class="lihatproduk">
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
            </td>
        </tr>
        <tr>
            <td> </td>
            <td> </td>
            <td align="right">
                <br>
                <a href="TampilRincianBayar.php?id=<?php echo $_SESSION['Username'] ?>">
                    <button name="btnPesanan" style="margin-top: 30px;" class="lihatproduk"> BUAT PESANAN </button>
                </a>
                <br>
            </td>
            <td> </td>
        </tr>
    </table>
    </form>
    <!--END TABEL BELANJAAN-->
    <br><br><br><br><br><br>
</div>


<!--START SCRIPT MEMUNCULKAN KE FORM INPUT JNE-->
<script type="text/javascript">
    $('.pilih_ongkir2').on('click',function(){

        var tarif2 = parseInt($(this).attr("tarif2"));
        var layanan2 = $(this).attr("layanan2");
        var namaekspedisi2 = $(this).attr("namaekspedisi2");
        var ongkir2 = document.getElementById("ongkir2");
        var Tampillayanan2 = document.getElementById("Tampillayanan2");
        var TampilKurir2 = document.getElementById("TampilKurir2");


        ongkir2.value = tarif2;
        Tampillayanan2.value = layanan2;
        TampilKurir2.value = namaekspedisi2;

    });
</script>
<!--END SCRIPT MEMUNCULKAN KE FORM INPUT JNE-->


<!--START SCRIPT MEMUNCULKAN KE FORM INPUT TIKI-->
<script type="text/javascript">
    $('.pilih_ongkir3').on('click',function(){

        var tarif3 = parseInt($(this).attr("tarif3"));
        var layanan3 = $(this).attr("layanan3");
        var namaekspedisi3 = $(this).attr("namaekspedisi3");
        var ongkir3 = document.getElementById("ongkir3");
        var Tampillayanan3 = document.getElementById("Tampillayanan3");
        var TampilKurir3 = document.getElementById("TampilKurir3");


        ongkir3.value = tarif3;
        Tampillayanan3.value = layanan3;
        TampilKurir3.value = namaekspedisi3;

    });
</script>
<!--END SCRIPT MEMUNCULKAN KE FORM INPUT TIKI-->


<!--START SCRIPT MEMUNCULKAN KE FORM INPUT POS-->
<script type="text/javascript">
    $('.pilih_ongkir4').on('click',function(){

        var tarif4 = parseInt($(this).attr("tarif4"));
        var layanan4 = $(this).attr("layanan4");
        var namaekspedisi4 = $(this).attr("namaekspedisi4");
        var ongkir4 = document.getElementById("ongkir4");
        var Tampillayanan4 = document.getElementById("Tampillayanan4");
        var TampilKurir4 = document.getElementById("TampilKurir4");


        ongkir4.value = tarif4;
        Tampillayanan4.value = layanan4;
        TampilKurir4.value = namaekspedisi4;

    });
</script>
<!--END SCRIPT MEMUNCULKAN KE FORM INPUT POS-->



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