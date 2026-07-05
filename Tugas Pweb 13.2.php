<?php

// =======================
// ARRAY DATA BARANG
// =======================

$barang = [
    "Laptop" => 8500000,
    "Mouse" => 150000,
    "Keyboard" => 300000,
    "Headset" => 450000,
    "Flashdisk" => 100000
];

// =======================
// FUNCTION
// =======================

function hitungSubtotal($harga, $jumlah)
{
    return $harga * $jumlah;
}

function hitungDiskon($subtotal)
{
    if ($subtotal >= 10000000) {
        return $subtotal * 0.15;
    } elseif ($subtotal >= 5000000) {
        return $subtotal * 0.10;
    } elseif ($subtotal >= 1000000) {
        return $subtotal * 0.05;
    } else {
        return 0;
    }
}

function hitungPPN($subtotal, $diskon)
{
    return ($subtotal - $diskon) * 0.11;
}

function hitungTotal($subtotal, $diskon, $ppn)
{
    return ($subtotal - $diskon) + $ppn;
}

function rupiah($angka)
{
    return "Rp " . number_format($angka, 0, ',', '.');
}

$hasil = false;

if(isset($_POST['proses'])){

    $nama = $_POST['nama'];
    $pilihBarang = $_POST['barang'];
    $jumlah = $_POST['jumlah'];

    $harga = $barang[$pilihBarang];

    $subtotal = hitungSubtotal($harga,$jumlah);
    $diskon = hitungDiskon($subtotal);
    $ppn = hitungPPN($subtotal,$diskon);
    $total = hitungTotal($subtotal,$diskon,$ppn);

    $hasil = true;

}

?>

<!DOCTYPE html>
<html>
<head>

<title>Aplikasi Penjualan Barang</title>

<style>

body{
    margin:0;
    padding:0;
    background:#ececec;
    font-family:Arial;
}

.container{
    width:700px;
    margin:40px auto;
    background:white;
    padding:30px;
    border-radius:10px;
    box-shadow:0px 0px 10px gray;
}

h2{
    text-align:center;
    color:#0066cc;
}

table{
    width:100%;
    border-collapse:collapse;
}

td{
    padding:10px;
}

input,select{
    width:100%;
    padding:8px;
}

button{
    width:100%;
    padding:10px;
    background:#0066cc;
    color:white;
    border:none;
    cursor:pointer;
    font-size:16px;
}

button:hover{
    background:#004999;
}

.hasil{
    margin-top:30px;
}

.hasil table,
.hasil th,
.hasil td{
    border:1px solid #999;
}

.hasil th{
    background:#0066cc;
    color:white;
}

.hasil td{
    padding:10px;
}

</style>

</head>

<body>

<div class="container">

<h2>APLIKASI PENJUALAN BARANG</h2>

<form method="POST">

<table>

<tr>
<td>Nama Pembeli</td>
<td>
<input type="text" name="nama" required>
</td>
</tr>

<tr>
<td>Pilih Barang</td>
<td>

<select name="barang">

<?php

foreach($barang as $namaBarang=>$harga){

?>

<option value="<?php echo $namaBarang;?>">
<?php echo $namaBarang;?> - <?php echo rupiah($harga);?>
</option>

<?php
}
?>

</select>

</td>
</tr>

<tr>
<td>Jumlah Barang</td>
<td>
<input type="number" name="jumlah" min="1" required>
</td>
</tr>

<tr>
<td colspan="2">
<button type="submit" name="proses">
Hitung Total
</button>
</td>
</tr>

</table>

</form>

<?php

if($hasil){

?>

<div class="hasil">

<h3 align="center">HASIL TRANSAKSI</h3>

<table>

<tr>
<th>Data</th>
<th>Hasil</th>
</tr>

<tr>
<td>Nama Pembeli</td>
<td><?php echo $nama;?></td>
</tr>

<tr>
<td>Barang</td>
<td><?php echo $pilihBarang;?></td>
</tr>

<tr>
<td>Harga</td>
<td><?php echo rupiah($harga);?></td>
</tr>

<tr>
<td>Jumlah</td>
<td><?php echo $jumlah;?></td>
</tr>

<tr>
<td>Subtotal</td>
<td><?php echo rupiah($subtotal);?></td>
</tr>

<tr>
<td>Diskon</td>
<td><?php echo rupiah($diskon);?></td>
</tr>

<tr>
<td>PPN 11%</td>
<td><?php echo rupiah($ppn);?></td>
</tr>

<tr>
<td><b>Total Bayar</b></td>
<td><b><?php echo rupiah($total);?></b></td>
</tr>

</table>

</div>

<?php

}

?>

</div>

</body>
</html>
