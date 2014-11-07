<?php
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";

$self 			= $_SERVER['PHP_SELF'];
$page			= $_REQUEST['module'];
$page			= $_REQUEST['page']?$_REQUEST['page']:"1";
$maxrow			= $_REQUEST['maxrow']?$_REQUEST['maxrow']:"10";
$tcari			= $_REQUEST['tcari'];

$qtmpil_barang="select * from barang where true";
if($tcari!="") {
	$qtmpil_barang.=" and barang_nama like '$tcari%'";	
}
$qtmpil_barang.=" order by inc asc";
$sqlnav=$qtmpil_barang;
$qtmpil_barang.=$page?" LIMIT ".$maxrow." offset ".(($page-1)*$maxrow)."":"";
//print $sql;
	
?>

<div id="judulHalaman"><strong>Data Barang</strong></div>
<form id="form1" name="form1" method="post" action="index.php?halaman=data_barang">
<input name="proses" type="hidden" value="form1" />
<table>
  <tr>
    <td>Pencarian barang</td>
  </tr>
  <tr>
    <td><input name="tcari" id="input" type="text" size="25" /><input name="bcari" id="tombol" type="submit" value="cari" /></td>
  </tr>
</table>
</form>
<?php
	$warna1="#FEEBFD";
	$warna2="#FFFFFF";
	$warna=$warna1;
	?>

	<table width="100%">
    <tr class="kecil">
      <td>Halaman</td>
      <td>:</td>
      <td><input name="page" type="text" id="page" size="5" value="<?=$page?>" />
      <?php _navpage($koneksi,$sqlnav,$maxrow,$page,"?halaman=data_barang&maxrow=$maxrow&$start=$start&end=$end&show=data_barang.php");?></td>
    </tr>
    </table>	
      <table width="100%">
        <tr>
          <td id="namaField">No</td>
          <td id="namaField">Barang Kode</td>
          <td id="namaField">Barang nama</td>
          <td id="namaField">Barang Kategori</td>
          <td id="namaField">Packing/Kemasan</td>
          <td id="namaField">Satuan</td>
          <td colspan="2" id="namaField">
          <?php echo "<a href=index.php?halaman=form_data_master&kode=barang_insert>"; ?>
            <div id="tombol">tambah data</div>
          <?php echo "</a>"; ?>
          </td>
        </tr>
        <?php 
		
		$qp_brg=mysql_query($qtmpil_barang);
		$no=1;
		while($row1=mysql_fetch_array($qp_brg)){
			if ($warna==$warna1){
				$warna=$warna2;
			}
			else{
				$warna=$warna1;
			}
		?>
        <tr bgcolor=<?php echo $warna; ?>>
          <td><?php echo "$no"; ?></td>
          <td><?php echo "$row1[barang_id]"; ?></td>
          <td><?php echo "$row1[barang_nama]"; ?></td>
          <td><?php echo "$row1[barang_kategori]"; ?></td>
          <td><?php echo "$row1[packing]"; ?></td>
          <td><?php echo "$row1[satuan]"; ?></td>
          <td><?php echo "<a href=index.php?halaman=form_ubah_data&kode=barang_update&id=$row1[inc]>"; ?>
          	 <div id="tombol">ubah</div>
			 <?php echo "</a>"; ?>
          </td>
          <td>
          <a href="<?php echo "proses.php?proses=barang_delete&id=$row1[inc]>"; ?>" onclick="return confirm('Apakah Anda akan menghapus data buah ini ?')">
          <div id="tombol">hapus</div>
		  </a>
          </td>
        </tr>
        <?php	$no++; } 
		
	
		?>
      </table>
