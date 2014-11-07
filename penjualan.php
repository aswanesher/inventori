
<?php
require_once "library/fungsi_standar.php";

$self 			= $_SERVER['PHP_SELF'];
$page			= $_REQUEST['module'];
$page			= $_REQUEST['page']?$_REQUEST['page']:"1";
$maxrow			= $_REQUEST['maxrow']?$_REQUEST['maxrow']:"10";
$tcari			= $_REQUEST['tcari'];

$pesan="SELECT * FROM jual";
$pesan.=" ORDER BY inc DESC ";
$sqlnav=$pesan;
$pesan.=$page?" LIMIT ".$maxrow." offset ".(($page-1)*$maxrow)."":"";

	$warna1="#FEEBFD";
	$warna2="#FFFFFF";
	$warna=$warna1;
?>
<?php echo "<a href=form_jual.php>"; ?>
<div id="tombolAdd">tambah data</div>
<?php echo "</a>"; ?>
    <form id="form1" name="form1" method="post" action="index.php?halaman=jual_cari">
    <input name="proses" type="hidden" value="form1" />
      <table border="0">
        <tr>
          <td>tanggal awal</td>
          
          <td>tanggal akhir</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><input name="tgl_awal" type="text" id="datepicker" /></td>
          <td><input name="tgl_akhir" type="text" id="datepicker1" /></td>
          <td><input name="tampil" id="tombol" type="submit" value="tampilkan" /></td>
        </tr>
      </table>
    </form> 
    <table width="100%">
    <tr class="kecil">
      <td>Halaman</td>
      <td>:</td>
      <td><input name="page" type="text" id="page" size="5" value="<?=$page?>" />
      <?php _navpage($koneksi,$sqlnav,$maxrow,$page,"?halaman=penjualan&maxrow=$maxrow&$start=$start&end=$end&show=penjualan.php");?></td>
    </tr>
    </table>
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
  		
		$query=mysql_query($pesan);
		while($row=mysql_fetch_array($query)){
			if ($warna==$warna1){
				$warna=$warna2;
			}
			else{
				$warna=$warna1;
			}
		$piutang=$row['total']-$row['jml_bayar'];
		?>
  <tr bgcolor=<?php echo $warna; ?>>
    <td><a href="#" onclick="javascript:wincal=window.open('jual_detail.php?id=<?php echo $row['jual_id']; ?>','Lihat Data','width=790,height=400,scrollbars=1');">
    <?php echo $row['jual_id']; ?></a></td>
    <td><?php echo "$row[no_nota]"; ?></td>
    <td><?php echo "$row[tgl_jual]"; ?></td>
    <td><?php echo "$row[pelanggan_nama]"; ?></td>
    <td align="right"><?php echo "Rp "; echo digit($row['total']); ?></td>
    <td align="right"><?php echo "Rp "; echo digit($row['jml_bayar']); ?></td>
    <td align="right"><?php echo "Rp "; echo digit($piutang); ?></td>
    <td><?php echo "$row[tgl_jatuh_tempo]"; ?></td>
  </tr>
  <?php } ?>
</table>
