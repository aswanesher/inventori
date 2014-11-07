<?php
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="style/style_index.css" type="text/css">
<style type="text/css">
#noBorder
{
	border:none;	
}
table
{
	margin:5px 9px;
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
</style>

</head>

<body>
<?php
	$warna1="#c0d3e2";
	$warna2="#cfdde7";
	$warna=$warna1;

	$jual="SELECT * FROM jual WHERE jual_id='$_GET[id]' order by inc asc";
	$qjual=mysql_query($jual);
	$data=mysql_fetch_array($qjual);
		

?>
<table cellspacing="0" cellpadding="0">
  <tr>
    <td id="noBorder">No. Transaksi</td>
    <td id="noBorder">:</td>
    <td id="noBorder"><?php echo "$data[jual_id]"; ?></td>
  </tr>
  <tr>
    <td id="noBorder">No. Nota</td>
    <td id="noBorder">:</td>
    <td id="noBorder"><?php echo "$data[no_nota]"; ?></td>
  </tr>
  <tr>
    <td id="noBorder">Tgl Transaksi</td>
    <td id="noBorder">:</td>
    <td id="noBorder"><?php echo "$data[tgl_jual]"; ?></td>
  </tr>
  <tr>
    <td id="noBorder">Nama Pelanggan</td>
    <td id="noBorder">:</td>
    <td id="noBorder"><?php echo "$data[pelanggan_nama]"; ?></td>
  </tr>
  <tr>
    <td id="noBorder">Tanggal Jatuh Tempo</td>
    <td id="noBorder">:</td>
    <td id="noBorder"><?php echo "$data[tgl_jatuh_tempo]"; ?></td>
  </tr>
</table>
    <table cellspacing="1" cellpadding="0">
      <tr>
        <td id="namaField">Barang ID</td>
        <td id="namaField">Nama Buah</td>
        <td id="namaField">Kategori</td>
        <td id="namaField">Qty</td>
        <td id="namaField">Packing</td>
        <td id="namaField">Harga satuan</td>
        <td id="namaField">Harga total</td>
      </tr>
      <?php 
		$pesan="SELECT * FROM jual_detail WHERE jual_id='$_GET[id]'";
		$query=mysql_query($pesan);
		
		while($row=mysql_fetch_array($query)){
			if ($warna==$warna1){
				$warna=$warna2;
			}
			else{
				$warna=$warna1;
			}
		?>
      <tr bgcolor=<?php echo $warna; ?>>
        <td><?php echo "$row[barang_id]"; ?></td>
        <td><?php echo "$row[barang_nama]"; ?></td>
        <td><?php echo "$row[kategori]"; ?></td>
        <td><?php echo "$row[qty]"; ?></td>
        <td><?php echo "$row[satuan]"; ?></td>
        <td align="right"><?php echo digit($row['harga_satuan']);?></td>
        <td align="right"><?php echo digit($row['harga_total']); ?></td>
      </tr>
      <?php } ?>
      <tr>
        <td colspan="3" style="color:#FFF; background-color:#333; border:none;" align="right">Total Qty :</td>
        
        <td style="color:#FFF; background-color:#333; border:none;">
        	<?php
				$sumQty="SELECT SUM(qty) AS totalQty FROM jual_detail WHERE jual_id='$_GET[id]'";
				$qsumQty=mysql_query($sumQty);
				$dsumQty=mysql_fetch_array($qsumQty);
				echo $dsumQty['totalQty'];
			?>
        </td>
        <td style="color:#FFF; background-color:#333; border:none;">&nbsp;</td>
        <td style="color:#FFF; background-color:#333; border:none;" align="right">Total =</td>
        <td style="color:#FFF; background-color:#333; border:none;" align="right">
        	<?php
				$jual="SELECT * FROM jual WHERE jual_id='$_GET[id]'";
				$qjual=mysql_query($jual);
				$djual=mysql_fetch_array($qjual);
				echo "Rp ".digit($djual['total']);
			?>
        </td>
      </tr>
      <tr>
      	<td colspan="6" style="color:#FFF; background-color:#333; border:none;" align="right">Bayar =</td>
        <td style="color:#FFF; background-color:#333; border:none;" align="right"><?php echo "Rp ".digit($djual['jml_bayar']); ?></td>
      </tr>
      <tr>
      	<td colspan="6" style="color:#FFF; background-color:#333; border:none;" align="right">Piutang =</td>
        <td style="color:#FFF; background-color:#333; border:none;" align="right">
		<?php  
		$piutang=$djual['total']-$djual['jml_bayar'];
		echo "Rp ".digit($piutang);
		?>
        </td>
      </tr>
    </table>
</body>
</html>