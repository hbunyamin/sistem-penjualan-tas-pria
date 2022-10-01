<?php
include "../Function/config.php";

$Username = $_POST['Username'];

// Ambil Data yang Dikirim dari Form
$nama_file = $_FILES['UploadFoto']['name'];
$ukuran_file = $_FILES['UploadFoto']['size'];
$tipe_file = $_FILES['UploadFoto']['type'];
$tmp_file = $_FILES['UploadFoto']['tmp_name'];
$x = explode('.', $nama_file);
$ekstensi = strtolower(end($x));
$ekstensi_diperbolehkan	= array('png','jpg');

// Set path folder tempat menyimpan gambarnya
$path = "../GambarProfil/".$nama_file;

if (in_array($ekstensi, $ekstensi_diperbolehkan) === true){
//if($tipe_file == "image/jpeg" || $tipe_file == "image/png"){ // Cek apakah tipe file yang diupload adalah JPG / JPEG / PNG
    // Jika tipe file yang diupload JPG / JPEG / PNG, lakukan :
    if($ukuran_file <= 1000000){ // Cek apakah ukuran file yang diupload kurang dari sama dengan 1MB
        // Jika ukuran file kurang dari sama dengan 1MB, lakukan :
        // Proses upload
        if(move_uploaded_file($tmp_file, $path)){ // Cek apakah gambar berhasil diupload atau tidak
            // Jika gambar berhasil diupload, Lakukan :
            // Proses simpan ke Database
            $query = "UPDATE User SET Foto = ('$nama_file') WHERE Username = '$Username'";
            $sql = mysqli_query($conn, $query); // Eksekusi/ Jalankan query dari variabel $query

            if($sql){ // Cek jika proses simpan ke database sukses atau tidak
                // Jika Sukses, Lakukan :
//                header("location: Profil.php"); // Redirectke halaman index.php
                echo "<script>alert('Upload Foto Berhasil'); history.go(-1);</script>";
            }else{
                // Jika Gagal, Lakukan :
//                echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
//                echo "<br><a href='Profil.php'>Kembali Ke Form</a>";
                echo "<script>alert('Terjadi kesalahan saat mencoba untuk menyimpan data ke database');</script>";
            }
        }else{
            // Jika gambar gagal diupload, Lakukan :
//            echo "Maaf, Gambar gagal untuk diupload.";
//            echo "<br><a href='Profil.php'>Kembali Ke Form</a>";
            echo "<script>alert('Maaf, Gambar gagal untuk diupload');</script>";
        }
    }else{
        // Jika ukuran file lebih dari 1MB, lakukan :
//        echo "Maaf, Ukuran gambar yang diupload tidak boleh lebih dari 1MB";
//        echo "<br><a href='Profil.php'>Kembali Ke Form</a>";
        echo "<script>alert('Ukuran gambar yang diupload tidak boleh lebih dari 1MB'); history.go(-1);</script>";
    }
}else{
    // Jika tipe file yang diupload bukan JPG / JPEG / PNG, lakukan :
//    echo "Maaf, Tipe gambar yang diupload harus JPG / JPEG / PNG.";
//    echo "<br><a href='Profil.php'>Kembali Ke Form</a>";
    echo "<script>alert('Tipe gambar yang diupload harus JPG / JPEG / PNG'); history.go(-1);</script>";
}
?>
