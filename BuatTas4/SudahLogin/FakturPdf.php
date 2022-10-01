<?php
require('../fpdf184/fpdf.php');
include '../Function/config.php';

$id = $_GET['id'] ;

$pdf = new FPDF('P', 'mm','Letter');

$pdf->AddPage();

$sql = "SELECT SUM(k.TotalBelanjaan), k.IDTransaksi, t.TglTransaksi, t.JasaPengiriman,
            t.OngkosKirim, t.MetodePembayaran, t.BuktiPembayaran, t.ResiPengiriman,
            t.StatusPembayaran, u.Username, u.Alamat, u.NmrHP, t.LayananJasaKirim
        FROM Keranjang as k 
        JOIN Transaksi as t
        ON k.IDTransaksi = t.IDTransaksi
        JOIN User as u
        ON k.IDUser = u.IDUser
        JOIN Produk as p
        ON k.IDProduk = p.IDProduk
        WHERE k.IDTransaksi = $id";
$result = mysqli_query($conn, $sql);
$a = mysqli_fetch_array($result);


//START NAMA TOKO
    $pdf->SetFont('arial', 'B', '20');
    $pdf->SetTextColor(21, 87, 153);
$pdf->Cell(0, 11, '', 0, 1, 'C');
//    $pdf->Cell(0, 11, 'Nama Toko', 0, 1, 'C');
//END NAMA TOKO

    $pdf->Cell(10, 7, '', 0, 1);

    $pdf->SetFont('Times', '', 10);

    $pdf->Cell(25, 15, 'Pembeli', 0, 0, 'L');
    $pdf->Cell(10, 15, ':', 0, 0, 'R');
    $pdf->Cell(25, 15, $a['Username'], 0, 0, 'L');

    $pdf->Cell(10, 7, '', 0, 1);

    $pdf->SetFont('Times', '', 10);

    $pdf->Cell(25, 15, 'Tanggal Transaksi', 0, 0, 'L');
    $pdf->Cell(10, 15, ':', 0, 0, 'R');
    $pdf->Cell(25, 15, date('d F Y h:i:sa', strtotime($a['TglTransaksi'])), 0, 0, 'L');

    $pdf->Cell(10, 7, '', 0, 1);

    $pdf->SetFont('Times', '', 10);

    $pdf->Cell(25, 15, 'Alamat', 0, 0, 'L');
    $pdf->Cell(10, 15, ':', 0, 0, 'R');
    $pdf->Cell(25, 15, $a['Alamat'], 0, 0, 'L');

    $pdf->Cell(10, 7, '', 0, 1);

    $pdf->SetFont('Times', '', 10);

    $pdf->Cell(25, 15, 'No. HP', 0, 0, 'L');
    $pdf->Cell(10, 15, ':', 0, 0, 'R');
    $pdf->Cell(25, 15, $a['NmrHP'], 0, 0, 'L');

//START TABEL PRODUK
    $pdf->Cell(10, 20, '', 0, 1);

    $pdf->SetFont('Times', '', 10);
    $pdf->setDrawColor(21, 87, 153);
    $pdf->SetLineWidth(0.7);
    $pdf->Line(10, 69, 205, 69);

    $pdf->Cell(85, 7, 'Produk', 0, 0, 'C');
    $pdf->Cell(40, 7, 'Variasi', 0, 0, 'C');
    $pdf->Cell(30, 7, 'Jumlah', 0, 0, 'C');
    $pdf->Cell(40, 7, 'Harga', 0, 0, 'C');
    $pdf->Line(10, 76, 205, 76);

    $pdf->Cell(10, 3, '', 0, 1);

$sql2 = "SELECT k.TotalBelanjaan, k.JumlahBarang, p.Variasi, k.IDTransaksi, k.IDProduk, p.NamaProduk
                FROM Keranjang as k
                JOIN Produk as p
                ON k.IDProduk = p.IDProduk
                WHERE k.IDTransaksi = $id";
$result2 = mysqli_query($conn, $sql2);
while ($b = mysqli_fetch_array($result2)) {

    $pdf->Cell(10, 5, '', 0, 1);

    $pdf->Cell(85, 7, $b['NamaProduk'], 0, 0, 'C');
    $pdf->Cell(40, 7, $b['Variasi'], 0, 0, 'C');
    $pdf->Cell(30, 7, $b['JumlahBarang'], 0, 0, 'C');
    $pdf->Cell(40, 7, number_format($b['TotalBelanjaan'],0,'','.'), 0, 0, 'C');
}
//END TABEL PRODUK
    $pdf->Cell(10, 27, '', 0, 1);

    $pdf->SetFont('Times', '', 10);


    $TotalBelanjaan= "Rp  " . number_format($a['SUM(k.TotalBelanjaan)'],0,'','.');
    $pdf->Cell(165, 7, 'Total Belanjaan : ', 0, 0, 'R');
    $pdf->Cell(30, 7, $TotalBelanjaan, 0, 0, 'R');

    $pdf->Cell(10, 5, '', 0, 1);
    $pdf->Cell(10, 5, '', 0, 1);
    $pdf->Cell(165, 7, 'Jasa Pengiriman : ', 0, 0, 'R');
    $pdf->Cell(30, 7, ($a['JasaPengiriman']. ' - ' .$a['LayananJasaKirim']), 0, 0, 'R');


    $OngkosKirim = "Rp  " . number_format($a['OngkosKirim'],0,'','.');
    $pdf->Cell(10, 5, '', 0, 1);
    $pdf->Cell(165, 7, 'Ongkos Kirim : ', 0, 0, 'R');
    $pdf->Cell(30, 7, $OngkosKirim, 0, 0, 'R');

    $pdf->Cell(10, 5, '', 0, 1);
    $pdf->Cell(165, 7, 'Metode Pembayaran : ', 0, 0, 'R');
    $pdf->Cell(30, 7, $a['MetodePembayaran'], 0, 0, 'R');


    $TotalSeluruhnya = "Rp  " . number_format($a['SUM(k.TotalBelanjaan)'] + $a['OngkosKirim'],0,'','.');
    $pdf->SetFont('Times', 'B', 14);
    $pdf->Cell(10, 17, '', 0, 1);
    $pdf->Cell(117, 7, 'TOTAL SELURUHNYA : ', 0, 0, 'R');
    $pdf->Cell(68, 7, $TotalSeluruhnya, 0, 0, 'L');

$pdf->Output();
