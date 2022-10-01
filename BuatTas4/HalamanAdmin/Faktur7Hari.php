<?php
require('../fpdf184/fpdf.php');
include '../Function/config.php';


$pdf = new FPDF('P', 'mm','Letter');

$pdf->AddPage();

date_default_timezone_set('Asia/Jakarta');
$TglHariIni = date( 'd F Y' );

$pdf->SetFont('times', '', '12');
$pdf->SetTextColor(21, 87, 153);
$pdf->Cell(125, 5, '', 0, 0, 'R');
$pdf->setDrawColor(21, 87, 153);
$pdf->Cell(70, 5, "Tanggal hari ini: $TglHariIni", 1, 0, 'R');


$pdf->SetFont('times', 'B', '18');
$pdf->SetTextColor(21, 87, 153);
$pdf->Cell(10, 15, '', 0, 1);
$pdf->Cell(195, 10, "Transaksi 7 hari terakhir", 0, 0, 'C');

$pdf->Cell(10, 22, '', 0, 1);


$nows=strtotime(date('Y-m-d'));
$start=date('Y-m-d',strtotime('-7 day',$nows));
//$end=date('Y-m-d');
$end=date('Y-m-d',strtotime('+1 day',$nows));
$sql = "SELECT k.IDTransaksi, t.TglTransaksi, t.JasaPengiriman, t.OngkosKirim, t.MetodePembayaran, 
            t.BuktiPembayaran, t.ResiPengiriman, t.StatusPembayaran, u.Username, u.Alamat, u.NmrHP,
            p.NamaProduk, p.Variasi, p.Harga, k.JumlahBarang, k.TotalBelanjaan
        FROM Keranjang as k 
        JOIN Transaksi as t
        ON k.IDTransaksi = t.IDTransaksi
        JOIN User as u
        ON k.IDUser = u.IDUser
        JOIN Produk as p
        ON k.IDProduk = p.IDProduk
        WHERE t.TglTransaksi between '$start' AND '$end' AND t.StatusPembayaran = 'Transaksi Selesai'";
$result = mysqli_query($conn, $sql);
while ($a = mysqli_fetch_array($result)) {

    $pdf->SetFont('times', 'B', '11');
    $pdf->SetTextColor(21, 87, 153);
    $pdf->setDrawColor(21, 87, 153);
//$pdf->Line(10, 47, 205, 47);
    $pdf->Cell(30, 7, $a['Username'], 1, 0, 'C');
    $pdf->Cell(65, 7, date('d F Y  h:i:sa', strtotime($a['TglTransaksi'])), 1, 0, 'C');
    $pdf->Cell(40, 7, $a['NmrHP'], 1, 0, 'C');
    $pdf->Cell(10, 7, '', 0, 1);

    $pdf->SetFont('times', '', '11');
    $pdf->Cell(195, 7, $a['Alamat'], 1, 1, 'L');


    $pdf->SetFont('times', 'B', '11');
    $pdf->Cell(85, 7, 'Produk', 1, 0, 'C');
    $pdf->Cell(40, 7, 'Variasi', 1, 0, 'C');
    $pdf->Cell(30, 7, 'Jumlah', 1, 0, 'C');
    $pdf->Cell(40, 7, 'Harga', 1, 0, 'C');


    $pdf->SetFont('times', '', '9');
    $pdf->Cell(15, 7, '', 0, 1);
    $pdf->Cell(0.01, 7, '', 1, 0);
    $pdf->Cell(85, 7, $a['NamaProduk'], 0, 0, 'C');
    $pdf->Cell(40, 7, $a['Variasi'], 0, 0, 'C');
    $pdf->Cell(30, 7, $a['JumlahBarang'], 0, 0, 'C');
    $pdf->Cell(40, 7, $a['Harga'], 0, 0, 'C');
    $pdf->Cell(0.01, 7, '', 1, 1);

    $pdf->Cell(0.01, 13, '', 1, 0);
    $pdf->Cell(195, 13, '', 0, 0);
    $pdf->Cell(0.01, 13, '', 1, 1);
    $pdf->SetFont('times', '', '11');


    $TotalBelanjaan= "Rp  " . ($a['TotalBelanjaan']);
    $pdf->Cell(0.01, 7, '', 1, 0);
    $pdf->Cell(165, 7, 'Total Belanjaan : ', 0, 0, 'R');
    $pdf->Cell(30, 7, $TotalBelanjaan, 0, 0, 'R');
    $pdf->Cell(0.01, 7, '', 1, 1);

    $pdf->Cell(0.01, 7, '', 1, 0);
    $pdf->Cell(195, 5, '', 0, 0);
    $pdf->Cell(0.01, 5, '', 1, 1);
    $pdf->Cell(0.01, 5, '', 1, 0);
    $pdf->Cell(165, 7, 'Jasa Pengiriman : ', 0, 0, 'R');
    $pdf->Cell(30, 7, $a['JasaPengiriman'], 0, 0, 'R');
    $pdf->Cell(0.01, 7, '', 1, 0);


    $OngkosKirim = "Rp  " . ($a['OngkosKirim']);
    $pdf->Cell(10, 5, '', 0, 1);
    $pdf->Cell(0.01, 7, '', 1, 0);
    $pdf->Cell(165, 7, 'Ongkos Kirim : ', 0, 0, 'R');
    $pdf->Cell(30, 7, $OngkosKirim, 0, 0, 'R');
    $pdf->Cell(0.01, 7, '', 1, 0);

    $pdf->Cell(0.01, 5, '', 1, 1);
    $pdf->Cell(0.01, 7, '', 1, 0);
    $pdf->Cell(165, 7, 'Metode Pembayaran : ', 0, 0, 'R');
    $pdf->Cell(30, 7, $a['MetodePembayaran'], 0, 0, 'R');
    $pdf->Cell(0.01, 3, '', 1, 1);


    $TotalSeluruhnya = "Rp  " . ($a['TotalBelanjaan'] + $a['OngkosKirim']);
    $pdf->SetFont('Times', 'B', 14);
    $pdf->Cell(0.01, 7, '', 1, 0);
    $pdf->Cell(195, 7, '', 0, 0);
    $pdf->Cell(0.01, 7, '', 1, 1);
    $pdf->Cell(195, 0.2, '', 1, 1);
    $pdf->Cell(0.01, 7, '', 1, 0);
    $pdf->Cell(117, 7, 'TOTAL SELURUHNYA : ', 0, 0, 'R');
    $pdf->Cell(78, 7, $TotalSeluruhnya, 0, 0, 'L');
    $pdf->Cell(0.01, 7, '', 1, 0);
    $pdf->Cell(10, 7, '', 0, 1);
    $pdf->Cell(195, 0.2, '', 1, 1);

    $pdf->Cell(15, 15, '', 0, 1);
}

$pdf->Output();
