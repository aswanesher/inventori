<div id="wrapper">
<?php error_reporting(0);?>
<?php 
session_start();
include "kepala.php";
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";

$hal=$_GET['halaman'];
	if (empty($hal)){
			$hal="index";

}

if (isset($_SESSION['level']) && isset($_SESSION['username']))
{

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>UAS WEB PROGRAMMING</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/development-bundle/themes/ui-lightness/jquery.ui.all.css">
	<script src="JQuery-UI-1.8.17.custom/development-bundle/jquery-1.7.1.js"></script>
	<script src="JQuery-UI-1.8.17.custom/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="JQuery-UI-1.8.17.custom/development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="JQuery-UI-1.8.17.custom/development-bundle/ui/jquery.ui.datepicker.js"></script>
    <script src="JQuery-UI-1.8.17.custom/development-bundle/ui/i18n/jquery.ui.datepicker-id.js"></script>
	
	<script>
	$(function() {
		$( "#datepicker" ).datepicker();
	});
	$(function() {
		$( "#datepicker1" ).datepicker();
	});
	</script>
</head>
<body>


<?php 

//Kalo yang ini untuk menampilkan gambar//
if ($_GET['menu'] == '1'){
	echo"<center><img src='1.gif'></center>" ;
	
	echo"<Center><H5>SELAMAT DATANG</h5></center>" ; 
}


if ($_GET['menu'] == '2'){
	echo"<center><h1>About Programmer</h1></center>" ;
	echo"
	<div id='about_photos'>
	<img src='2.jpg'><br><br>";
	echo '</div>'; 
	echo"
	<center>
	<table>
						<tr>
							<td>Nama</td>
							<td><input type='text' value='Sigit Dwi Prasetyo' disabled='disabled'></td>
						</tr>
						<tr>
							<td>Tempat/ tgl Lahir</td>
							<td><input type='text' value='Yogyakarta, 06 Des' disabled='disabled'></td>
						</tr>
						<tr>
							<td>Kewarganegaraan</td>
							<td><input type='text' value='Indonesia' disabled='disabled'></td>
						</tr>
                        <tr>
							<td>Etnis</td>
							<td><input type='text' value='Javanesse' disabled='disabled'></td>
						</tr>
                         <tr>
							<td>Kegemaran</td>
							<td><input type='text' value='Media Social Society' disabled='disabled'></td>
						</tr>
                        <tr>
							<td>Status</td>
							<td><input type='text' value='Single' disabled='disabled'></td>
						</tr>
						
					</table></center><br>
	" ;}?>


   	<?php
		require_once $hal.".php";
		}
else
{
	lompat_ke("form_login.php");
}
	?>
    

<?php include "kaki.php"; ?>

</div>
</body>
</html>