<?php
session_start();
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";
$a="SELECT * FROM jual";
$b="SELECT inc FROM jual ORDER BY inc DESC LIMIT 1";
$inc=penambahan($a, $b);
if (isset($_POST['run'])and($_POST['run']=="form2"))
{
	$cekQty="SELECT * FROM stok WHERE barang_nama='$_POST[pilih_barang]'";
	$qcekQty=mysql_query($cekQty);
	$dcekQty=mysql_fetch_array($qcekQty);
	if (!empty($_POST['qty'])and(!empty($_POST['harga'])))
	{
		//ambil dari stok
		$buah="SELECT * FROM stok WHERE barang_nama='$_POST[pilih_barang]'";
		$qbuah=mysql_query($buah);
		$dbuah=mysql_fetch_array($qbuah);
		$sisa_qty=$dbuah['qty']-$_POST['qty'];
		if ($sisa_qty >= 0)
		{
			//insert ke temp_beli_detail
			$pack_a=$_REQUEST['pack_a'];
			$pack_b=$_REQUEST['pack_b'];
			
			//$hsl=($pack_a*$pack_b);
			//$harga_total=$hsl*$_POST['harga'];
			
			$harga_total=$_POST['qty']*$_POST['harga'];
			
			$input="INSERT INTO temp_jual_detail(jual_id, barang_id, barang_nama, kategori, qty, satuan, harga_satuan, harga_total)
			VALUES('JL-$inc', '$dbuah[barang_id]', '$_POST[pilih_barang]', '$dbuah[kategori]', '$_POST[qty]', '".$pack_a."x".$pack_b." Kg', 
			'$_POST[harga]', '$harga_total')";
			mysql_query($input);
			//update tabel stok
			$upstok="UPDATE stok SET qty='$sisa_qty' WHERE barang_id='$dbuah[barang_id]'";
			mysql_query($upstok);
		}
		else
		{
			echo "
			<script type=text/javascript>";
			echo "alert('Qty yang diambil melebihi stok')";
			echo "</script>";
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="style/style_form_transaksi.css" type="text/css"  />
<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/development-bundle/themes/ui-lightness/jquery.ui.all.css">
<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/development-bundle/demos/demos.css">
<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/validationEngine/css/validationEngine.jquery.css" type="text/css"/>
<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/validationEngine/css/template.css" type="text/css"/>
	<script src="JQuery-UI-1.8.17.custom/validationEngine/js/jquery-1.4.4.min.js" type="text/javascript"></script>
    <script src="JQuery-UI-1.8.17.custom/validationEngine/js/jquery.validationEngine-id.js" type="text/javascript" charset="utf-8"></script>
	<script src="JQuery-UI-1.8.17.custom/validationEngine/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
	jQuery(document).ready( function() {
                // binds form submission and fields to the validation engine
                jQuery("#formID").validationEngine();

            });
    </script>  

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
<style type="text/css">
#formID
{
	border:none;
	margin:0px;
	padding:0px;
}
#formID1
{
	border:none;
	margin:0px;
	padding:0px;
}
td
{
	padding:5px 9px;
	border:1px solid #c0d3e2;
}
#namaField{
	color:#FFF;
	background-color:#333;
	text-align:center;
	padding-top:7px;
	border:none;
}
body {
	color:#315567;
	background-color:#e9e9e9;
	font-size:11px;
	font-family:Verdana, Geneva, sans-serif;
}
#datepicker{
	padding:3px 5px;
	margin:0px 3px;
	border:1px solid #c0d3e2;
	border-radius:3px;
}
#datepicker1{
	padding:3px 5px;
	margin:0px 3px;
	border:1px solid #c0d3e2;
	border-radius:3px;
}
#noborder
{
	border:none;
}
</style>
</head>

<body>
<div id="page"> 
<a href="index.php?halaman=barang_masuk"><div id="keluar">close</div></a>
<div class="header"><h1>Transaksi Penjualan</h1></div>
<div class="halaman">
  <div class="tengah">
	<div class="batas_isi">
    <div class="isi">
<table border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td>
      <form id="form1" name="form1" method="post" action="proses.php">
            <input type="hidden" name="proses" id="proses" value="jual_insert" />
          <table border="0" cellspacing="1" cellpadding="0">
            <tr><input name="inc" type="hidden" value="<?php echo "$inc"; ?>" />
              <td id="noborder">No. Transaksi</td>
              <td id="noborder">:</td>
              <td id="noborder"><input name="jual_id" type="hidden" value="<?php echo "JL-$inc"; ?>" /><?php echo "JL-$inc"; ?></td>
            </tr>
            <tr>
              <td id="noborder">No. Nota</td>
              <td id="noborder">:</td>
              <td id="noborder">
                <input type="text" name="no_nota" id="input" value="<?php echo "nota-$inc"; ?>" />
              </td>
            </tr>
            <tr>
              <td id="noborder">Tgl. Transaksi</td>
              <td id="noborder">:</td>
              <td id="noborder">
                <input type="text" name="tgl_jual" id="datepicker" value="<?php echo date(d)."/".date(m)."/".date(Y);?>" />
              </td><input type="hidden" name="username" id="username" value="<?php echo $_SESSION['username']; ?>" />
            </tr>
            <tr>
              <td id="noborder">Pembeli</td>
              <td id="noborder">:</td>
              <td id="noborder"><select name="pelanggan_nama" id="input">
                <option>umum</option>
                <?php
                $pel="SELECT * FROM pelanggan ORDER BY inc ASC";
                $qpel=mysql_query($pel);
                while ($dtpel=mysql_fetch_array($qpel)){
              echo "
                <option>$dtpel[pelanggan_nama]</option>";
                }
                ?>
              </select></td>
            </tr>
          </table>
        
        <!--tabel item barang -->
        <h3>Barang yg dibeli :</h3>
        <table border="0" cellspacing="1" cellpadding="0">
          <tr>
            <td id="namaField">ID</td>
            <td id="namaField">Nama Barang</td>
            <td id="namaField">Kategori</td>
            <td id="namaField">Packing</td>
            <td id="namaField">Qty</td>
            <td id="namaField">Harga Satuan</td>
            <td id="namaField">Harga Total</td>
            <td id="namaField">Menu</td>
          </tr>
          <?php
          $tmp="SELECT * FROM temp_jual_detail WHERE jual_id='JL-$inc'";
          $qtmp=mysql_query($tmp);
          while ($dtmp=mysql_fetch_array($qtmp))
          {
          echo "
          <tr>
            <td>$dtmp[barang_id]</td>
            <td>$dtmp[barang_nama]</td>
            <td>$dtmp[kategori]</td>
            <td>$dtmp[satuan]</td>
            <td>$dtmp[qty]</td>
            <td align=right>".digit($dtmp['harga_satuan'])."</td>
            <td align=right>".digit($dtmp['harga_total'])."</td>
            <td><a href=proses.php?proses=hapus_item_jual&id=$dtmp[barang_id]><div id=tombol>hapus</div></a></td>
          </tr>";
          }
          ?>
          <tr>
            <td id="namaField" colspan="5">&nbsp;</td>
            <td style="color:#FFF; border:none; background-color:#333" align="right">total:</td>
            <td style="color:#FFF; border:none; background-color:#333" align="right">
                <?php
                    $jml="SELECT SUM(harga_total) AS htotal FROM temp_jual_detail WHERE jual_id='JL-$inc'";
                    $qjml=mysql_query($jml);
                    $djml=mysql_fetch_array($qjml);
                    echo digit($djml['htotal']);
                ?>
            </td>
            <td id="namaField"><input name="total" type="hidden" value="<?php echo $djml['htotal'] ?>" /></td>
          </tr>
        </table>
        <!--tabel pembayaran-->
        <table border="0" cellspacing="1" cellpadding="0">
          <tr>
            <td id="noborder">Total Bayar</td>
            <td id="noborder">:</td>
            <td id="noborder"><label>
              <input type="text" name="jml_bayar" id="input" class="validate[required]" />
            </label></td>
          </tr>
          <tr>
            <td id="noborder">Tgl jatuh tempo</td>
            <td id="noborder">:</td>
            <td id="noborder"><label>
              <input type="text" name="tgl_jatuh_tempo" id="datepicker1" />
            </label></td>
          </tr>
          <tr>
            <td id="noborder">&nbsp;</td>
            <td id="noborder">&nbsp;</td>
            <td id="noborder">
              <input type="submit" name="simpan" id="tombol" value="simpan" />
              <input type="reset" name="batal" id="tombol" value="batal" />
            </td>
          </tr>
        </table>
      </form>
    </td>
    <td valign="top">
      	<form id="formID" name="form2" method="post" action="">
        <input name="run" type="hidden" value="form2" />
        <table border="0" cellspacing="1" cellpadding="0">
          <tr>
            <td id="namaField">Pilih Barang</td>
            <td id="namaField">Qty</td>
            <td id="namaField">Packing</td>
            <td id="namaField">Harga</td>
            <td id="namaField">add</td>
          </tr>
          <tr>
            <td>
              <select name="pilih_barang" id="input">
              <?php
			  	$stok="SELECT * FROM stok ORDER BY barang_nama ASC";
				$qstok=mysql_query($stok);
				while($dstok=mysql_fetch_array($qstok))
				{
					echo "<option>$dstok[barang_nama]</option>";
				}
			  ?>
              </select>
            </td>
            <td>
              <input name="qty" type="text" id="input" class="validate[required]" size="5" />
            </td>
            <td>
            	<input name="pack_a" type="text" id="input" class="validate[required]" size="5" />
                <input name="pack_b" type="text" id="input" class="validate[required]" size="5" />
            </td>
            <td>
              <input name="harga" type="text" id="input" class="validate[required]" size="9" />
            </td>
            <td>
              <input type="submit" name="add" id="tombol" value="add" />
            </td>
          </tr>
        </table>
    	</form>
    </td>
  </tr>
</table>
		</div>
    </div>
    </div>  
  </div>
</div>
</body>
</html>