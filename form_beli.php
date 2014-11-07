<?php
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";

$a="SELECT * FROM beli";
$b="SELECT inc FROM beli ORDER BY inc DESC LIMIT 1";
$inc=penambahan($a, $b);
if (isset($_POST['proses'])and($_POST['proses']=="form2"))
{
	if (!empty($_POST['qty'])and(!empty($_POST['harga'])))
	{
		$buah="SELECT * FROM barang WHERE inc='$_POST[pilih_barang]'";
		$qbuah=mysql_query($buah);
		$dbuah=mysql_fetch_array($qbuah);
		//insert ke temp_beli_detail
		
		//ambil satuan dan packing dari barang
		//$exp=explode('$_POST[pilih_barang]', "/");
		$nmbarang=$dbuah['barang_nama'];
		$packing=$dbuah['packing'];
		$satuan=$dbuah['satuan'];
		
		//perkalian packing
		$exp2=explode("x", $packing);
		$pack_a=$exp2[0];
		$pack_b=$exp2[1];
		
		$packings=$pack_a*$pack_b;
		$harga_total=$packings*$_POST['harga'];
		//$harga_total=$_POST['qty']*$_POST['harga'];
		
		$input="INSERT INTO temp_beli_detail(beli_id, barang_id, barang_nama, kategori, qty, satuan, harga_satuan, harga_total, packing, barang_inc)
		VALUES('BM-$inc', '$dbuah[barang_id]', '$nmbarang', '$dbuah[barang_kategori]', '$_POST[qty]', '$satuan', 
		'$_POST[harga]', '$harga_total', '$packing', '$dbuah[inc]')";
		mysql_query($input);
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pembelian</title>
<link rel="stylesheet" href="style/style_form_transaksi.css" type="text/css"  />
<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/development-bundle/demos/demos.css">
<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/development-bundle/themes/ui-lightness/jquery.ui.all.css">
<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/validationEngine/css/validationEngine.jquery.css" type="text/css"/>
<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/validationEngine/css/template.css" type="text/css"/>
	<script src="JQuery-UI-1.8.17.custom/validationEngine/js/jquery-1.4.4.min.js" type="text/javascript"></script>
    <script src="JQuery-UI-1.8.17.custom/validationEngine/js/jquery.validationEngine-id.js" type="text/javascript" charset="utf-8"></script>
	<script src="JQuery-UI-1.8.17.custom/validationEngine/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
    </script>    
    <script src="JQuery-UI-1.8.17.custom/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="JQuery-UI-1.8.17.custom/development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="JQuery-UI-1.8.17.custom/development-bundle/ui/jquery.ui.datepicker.js"></script>
    <script src="JQuery-UI-1.8.17.custom/development-bundle/ui/i18n/jquery.ui.datepicker-id.js"></script>
        <script>
            jQuery(document).ready( function() {
                // binds form submission and fields to the validation engine
                jQuery("#formID").validationEngine();
            });
			///
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
#noborder
{
	border:none;
}
</style>
</head>

<body>
<div id="page"> 
<a href="index.php?halaman=barang_masuk"><div id="keluar">close</div></a>
<div class="header"><h1>Transaksi Barang Masuk</h1></div>
<div class="halaman">
  <div class="tengah">
	<div class="batas_isi">
    <div class="isi">

<table border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td>
    	<form id="form1" name="form1" method="post" action="proses.php">
        <input name="proses" type="hidden" value="beli_insert" />
        <input name="inc" type="hidden" value="<?php echo "$inc"; ?>" />
			<table border="0" cellspacing="1" cellpadding="0">
  				<tr>
    				<td id="noborder">No. Transaksi</td>
    				<td id="noborder">:</td>
    				<td id="noborder"><?php echo "BM-$inc" ?><input name="beli_id" type="hidden" value="<?php echo "BM-$inc"; ?>" /></td>
  				</tr>
  				<tr>
    				<td id="noborder">No. Faktur</td>
    				<td id="noborder">:</td>
    				<td id="noborder"><input name="no_fak" type="text" id="input" value="<?php echo "FAK-$inc" ?>" /></td>
  				</tr>
  				<tr>
    				<td id="noborder">Tgl. Transaksi</td>
    				<td id="noborder">:</td>
    				<td id="noborder"><input name="tgl_trans" type="text" id="datepicker" value="<?php echo date(d)."/".date(m)."/".date(Y);?>" /></td>
  				</tr>
  				<tr>
    				<td id="noborder">Supplier</td>
    				<td id="noborder">:</td>
    				<td id="noborder">
    				<select name="pilih_supplier" id="input">
                    <?php
						$supplier="SELECT * FROM supplier ORDER BY supplier_nama ASC";
						$qsupplier=mysql_query($supplier);
						while($dsupplier=mysql_fetch_array($qsupplier))
						{
							echo "<option>$dsupplier[supplier_nama]</option>";
						}
					?>
    				</select>
    				</td>
  				</tr>
  				<tr>
    				<td id="noborder">Ongkos Truk</td>
    				<td id="noborder">:</td>
    				<td id="noborder"><input name="ongkos" type="text" id="input" /></td>
  				</tr>
			</table>
            
            <table border="0" cellspacing="1" cellpadding="0">
              <tr>
                <td id="noborder" colspan="8"><h3>Barang yang dibeli :</h3></td>
              </tr>
              <tr>
                <td id="namaField">ID</td>
                <td id="namaField">Nama Barang</td>
                <td id="namaField">Kategori</td>
                <td id="namaField">Qty</td>
                <td id="namaField">Packing</td>
                <td id="namaField">Satuan</td>
                <td id="namaField">Harga Satuan</td>
                <td id="namaField">Harga Total</td>
                <td style="background-color:#CCC">
				<?php echo "<a href=proses.php?proses=hapus_item_beli&status=all&id=BM-$inc><div id=tombol>Hapus Semua</div></a>"; ?>
                </td>
              </tr>
              <?php
			  	$rinci="SELECT * FROM temp_beli_detail WHERE beli_id='BM-$inc'";
				$qrinci=mysql_query($rinci);
				while($drinci=mysql_fetch_array($qrinci))
				{
			  ?>
              <tr>
                <td><?php echo $drinci['barang_id']; ?></td>
                <td><?php echo $drinci['barang_nama']; ?></td>
                <td><?php echo $drinci['kategori']; ?></td>
                <td><?php echo $drinci['qty']; ?></td>
                <td><?php echo $drinci['packing']; ?></td>
                <td><?php echo $drinci['satuan']; ?></td>
                <td align="right"><?php echo digit($drinci['harga_satuan']); ?></td>
                <td align="right"><?php echo digit($drinci['harga_total']); ?></td>
               <td><?php echo "<a href=proses.php?proses=hapus_item_beli&status=satu&id=$drinci[barang_id]><div id=tombol>hapus</div></a>"; ?></td>
              </tr>
              <?php } ?>
              <tr>
                <td style="color:#FFF; background-color:#333; border:none" colspan="7" align="right">total :</td>
                <td style="color:#FFF; background-color:#333; border:none" align="right">
					<?php
						$sum="SELECT SUM(harga_total)AS total FROM temp_beli_detail WHERE beli_id='BM-$inc'";
						$qsum=mysql_query($sum);
						$dsum=mysql_fetch_array($qsum);
						echo digit($dsum['total']);
					?>
                </td>
                <td style="color:#FFF; background-color:#333; border:none">&nbsp;</td>
              </tr>
            </table>

            <table border="0" cellspacing="1" cellpadding="0">
              <tr>
                <td><input type="submit" name="simpan" id="tombol" value="simpan" /></td>
				<td><input type="reset" name="batal" id="tombol" value="batal" /></td>
              </tr>
            </table>

		</form>
	</td>
    <td valign="top">
    	<form id="formID"  name="form2" method="post" action="form_beli.php">
        <input name="proses" type="hidden" value="form2" />
        <table border="0" cellspacing="1" cellpadding="0">
  			<tr>
    			<td>Nama Barang</td>
    			<td>Qty</td>
    			<td>Harga</td>
    			<td>Menu</td>
  			</tr>
  			<tr>
    			<td>
    			  <select name="pilih_barang" id="input">
                  <?php
						$barang="SELECT * FROM barang ORDER BY barang_nama ASC";
						$qbarang=mysql_query($barang);
						while($dbarang=mysql_fetch_array($qbarang))
						{
							echo "<option value='$dbarang[inc]'>$dbarang[barang_nama]/$dbarang[packing]/$dbarang[satuan]</option>";
						}
					?>
  			      </select>
  			  	</td>
    			<td>
                <input type="text" name="qty" id="input" class="validate[required]" size="3" />
  			  	</td>
    			<td><label>
    			  <input name="harga" type="text" id="input" class="validate[required]" size="9" />
  			  </label></td>
   				<td><label>
   				  <input type="submit" name="add" id="tombol" value="add" />
			    </label></td>
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