<?php
session_start();
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";
?>
<html>
<head>
	<title>UAS WEB PROGRAMMING</title> 
</head>
<body>
<table class="sirah" cellspacing="1" cellpading="1" align="center" border="1" width="900px">
	<tr>
		<td align="center" height="49" bgcolor="#FF6699">
        
        
  <div id="box">
	<div id="tgl"><?php echo tanggal();?></div>
	<div id="akun"><?php echo $_SESSION['nama']; ?></div>
  
  </div>
        
        </td>
	</tr>
    <tr>
    <td align="center" height="10"><marquee>UAS WEB PROGRAMMING SISTEM INVENTORI || UAS WEB PROGRAMMING SISTEM INVENTORI || UAS WEB PROGRAMMING SISTEM INVENTORI ||</marquee></td></tr>
	<tr>
		<td align="center" bgcolor="#FFCCCC">
              <a href="index.php?menu=1">Home||</a>
        &nbsp;<a href="index.php?menu=2">About Me ||</a>
  <?php  
// cek level user apakah admin atau bukan

	echo 
	"<ul id=main>
      <a href=index.php?halaman=data_barang>Barang||</a>
	  <a href=index.php?halaman=data_supplier>Supplier||</a>
	  <a href=index.php?halaman=data_pelanggan>Pelanggan||</a>
      <a href=index.php?halaman=barang_masuk>Barang masuk||</a>
      <a href=index.php?halaman=penjualan>Penjualan||</a>
      <a href=index.php?halaman=stok>Stok Barang||</a>
	  <a href=index.php?halaman=data_akun>Data Akun||</a>
      <a href=logout.php>Keluar</a>
    </ul>";

?>      
        
        </td>
       
              
	</tr>
    
</table>

