<!DOCTYPE html>
<html lang ="en">
<head>
    <meta charset= "UTF-8">
    <title> Tombol Hitung Sederhana </title>
    <link rel="stylesheet" href="https://bootswatch.com/4/cosmo/bootstrap.min.css">
</head>
<body>
<div class ="m-5">
    <button class="btn btn-primary" id="tambah"> Tambah </button>
    <button class="btn btn-success" id="kurang"> Kurangi </button>
    <div class="m-4">
        Hasil : <span class= "bg-success text-white font-weight-bold p-2" id="hasil"> 0</span>
    </div>
</div>

<script>
    var tambah = document.getElementById('tambah');
    var kurang = document.getElementById("kurang");
    var hasil = document.getElementById("hasil");
    var no = 1;
    tambah.onclick = function(){
        hasil.innerHTML = no++;
    };
    kurang.onclick = function(){
        hasil.innerHTML = no--;
    };

</script>

</body>
</html>