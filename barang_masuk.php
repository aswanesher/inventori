
<?php
require_once "library/fungsi_standar.php";

$self 			= $_SERVER['PHP_SELF'];
$page			= $_REQUEST['module'];
$page			= $_REQUEST['page']?$_REQUEST['page']:"1";
$maxrow			= $_REQUEST['maxrow']?$_REQUEST['maxrow']:"10";
$tcari			= $_REQUEST['tcari'];

$pesan="SELECT * FROM beli";
		$pesan.=" ORDER BY inc DESC ";
		$sqlnav=$pesan;
		$pesan.=$page?" LIMIT ".$maxrow." offset ".(($page-1)*$maxrow)."":"";

	$warna1="#FEEBFD";
	$warna2="#FFFFFF";
	$warna=$warna1;
?>
	<a href="form_beli.php">
    <div id="tombolAdd">tambah data</div>
	</a>
    <form id="form1" name="form1" method="post" action="index.php?halaman=barang_masuk_cari">
    <input name="proses" type="hidden" value="form1" />
      <table border="0">
        <tr>
          <td>tanggal awal</td>
          <td>tanggal akhir</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><input name="tgl_awal" id="datepicker" type="text" /></td>
          <td><input name="tgl_akhir" id="datepicker1" type="text" /></td>
          <td><input name="tampil" id="tombol" type="submit" value="tampilkan" /></td>
        </tr>
      </table>
    </form> 
    <table width="100%">
    <tr class="kecil">
      <td>Halaman</td>
      <td>:</td>
      <td><input name="page" type="text" id="page" size="5" value="<?=$page?>" />
      <?php _navpage($koneksi,$sqlnav,$maxrow,$page,"?halaman=barang_masuk&maxrow=$maxrow&$start=$start&end=$end&show=barang_masuk.php");?></td>
    </tr>
    </table>	
<table cellpadding="0" cellspacing="1">
  <tr>
    <td id="namaField">No.Trans</td>
    <td id="namaField">No.Fak</td>
    <td id="namaField">Tgl. Trans</td>
    <td id="namaField">Nama Supplier</td>
    <td id="namaField">Biaya kirim/Ongkos truk</td>
    <td id="namaField">Total Harga</td>
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
?>
  <tr bgcolor=<?php echo $warna; ?>>
    <td><a href="#" onclick="javascript:wincal=window.open('beli_detail.php?id=<?php echo $row['beli_id']; ?>','Lihat 		Data','width=790,height=400,scrollbars=1');">
    <?php echo $row['beli_id']; ?></a>
    </td>
    <td><?php echo "$row[no_fak]"; ?></td>
    <td><?php echo "$row[tgl_trans]"; ?></td>
    <td><?php echo "$row[supplier_nama]"; ?></td>
    <td align="right"><?php echo "Rp "; echo digit($row['biaya_kirim']); ?></td>
    <td align="right"><?php echo "Rp "; echo digit($row['total']); ?></td>
  </tr>
  <?php } ?>
</table>
