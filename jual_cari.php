<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="style/data.css" type="text/css">

</head>

<body>
<div id="judulHalaman"><strong><?php echo "Data Penjualan: tanggal ".$_POST['tgl_awal']." sampai dengan ".$_POST['tgl_akhir'];?></strong></div>
<?php
	$warna1="#c0d3e2";
	$warna2="#cfdde7";
	$warna=$warna1;
?>
<?php echo "<a href=index.php?halaman=penjualan>"; ?><div id="tombolAdd">kembali</div><?php echo "</a>"; ?>
<table cellpadding="0" cellspacing="1">
  <tr>
    <td id="namaField">No.Trans</td>
    <td id="namaField">No.Nota</td>
    <td id="namaField">Tgl. Trans</td>
    <td id="namaField">Nama Pembeli</td>
    <td id="namaField">Total Harga</td>
    <td id="namaField">Jumlah Bayar</td>
    <td id="namaField">Piutang</td>
    <td id="namaField">Tanggal Jatuh Tempo</td>
  </tr>
  <?php 
  		$total_piutang=0;
  		$pesan="SELECT * FROM jual WHERE tgl_jual BETWEEN '$_POST[tgl_awal]' AND '$_POST[tgl_akhir]' ORDER BY jual_id DESC";
		$sum_jml_bayar="SELECT SUM(jml_bayar) AS total_jml_bayar FROM jual WHERE tgl_jual BETWEEN '$_POST[tgl_awal]' 
		AND '$_POST[tgl_akhir]' ORDER BY jual_id DESC";
		$query=mysql_query($pesan);
		
		while($row=mysql_fetch_array($query)){
			if ($warna==$warna1){
				$warna=$warna2;
			}
			else{
				$warna=$warna1;
			}
		$piutang=$row['total']-$row['jml_bayar'];
		$total_piutang=$total_piutang+$piutang;
		?>
  <tr bgcolor=<?php echo $warna; ?>>
    <td><a href="#" onclick="javascript:wincal=window.open('jual_detail.php?id=<?php echo $row['jual_id']; ?>','Lihat Data','width=790,height=400,scrollbars=1');">
    <?php echo $row['jual_id']; ?></a></td>
    <td><?php echo "$row[no_nota]"; ?></td>
    <td><?php echo "$row[tgl_jual]"; ?></td>
    <td><?php echo "$row[pelanggan_nama]"; ?></td>    
    <td align="right"><?php echo digit($row['total']); ?></td>
    <td align="right"><?php echo digit($row['jml_bayar']); ?></td>
    <td align="right"><?php echo digit($piutang); ?></td>
    <td><?php echo "$row[tgl_jatuh_tempo]"; ?></td>
  </tr>
  <?php } 

	$sum2="SELECT SUM(total) AS ttotal FROM jual WHERE tgl_jual BETWEEN '$_POST[tgl_awal]' 
		  AND '$_POST[tgl_akhir]' ORDER BY jual_id DESC";
	$qsum2=mysql_query($sum2);
	$dsum2=mysql_fetch_array($qsum2);
  ?>
  <tr>
    <td colspan="4" align="right" style="color:#FFF; border:none; background-color:#333">Total =</td>
    <td align="right" style="color:#FFF; border:none; background-color:#333"><?php echo "Rp ". digit($dsum2['ttotal']); ?></td>
    <td align="right" style="color:#FFF; border:none; background-color:#333">
	<?php $qsum_jml_bayar=mysql_query($sum_jml_bayar);
		  $dsum_jml_bayar=mysql_fetch_array($qsum_jml_bayar);
		  echo "Rp ". digit($dsum_jml_bayar['total_jml_bayar']); 
	?></td>
    <td align="right" style="color:#FFF; border:none; background-color:#333"><?php echo "Rp ". digit($total_piutang); ?></td>
    <td align="right" style="color:#FFF; border:none; background-color:#333"></td>
  </tr>
</table>
</body>
</html>