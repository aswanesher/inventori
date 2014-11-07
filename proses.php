<?php
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";
$proses=$_POST['proses'];
$hapus=$_GET['proses'];
$url="";
//fungsi insert
	function insert($nama_tabel,$values)
	{
		$sql="INSERT INTO ".$nama_tabel." VALUES(".$values.")";
		mysql_query($sql);	
	}
//fungsi update
	function update($nama_tabel,$values,$kondisi)
	{
		$sql="UPDATE ".$nama_tabel." SET ".$values." WHERE ".$kondisi;
		mysql_query($sql);
	}
//fungsi delete
	function delete($nama_tabel,$kondisi)
	{
		$sql="DELETE FROM ".$nama_tabel." WHERE ".$kondisi;
		mysql_query($sql);
	}
//pilih fungsi
	switch($proses){
		//pemilihan fungsi insert
		case "akun_insert":
		{
			$nama_tabel="account";
			$username=md5($_POST["username"]);
			$password=md5($_POST["password"]);
			$values="'$username', '$password', '$_POST[nama]', '$_POST[level]'";
			$hal="data_akun";
			insert($nama_tabel,$values);
			break;
		}
		case "barang_insert":
			{
				$brgKode=$_POST['Barang_Kode'];
				$barangKode=str_ireplace(" ",_,$brgKode);
				$nama_tabel="barang";
				$values="'$_POST[inc]', '$barangKode', '$_POST[nmBarang]', '$_POST[kategori]', '$_POST[packing]', '$_POST[satuan]'";
				$hal="data_barang";
				insert($nama_tabel,$values);
				break;
			}
		case "supplier_insert":
			{
				$supID=str_ireplace(" ",_,$_POST['supplier_id']);
				$nama_tabel="supplier";
				$values="'$_POST[supplier_inc]', '$supID', '$_POST[nmSupplier]', 
				'$_POST[alamatSup]', '$_POST[kotaSup]', '$_POST[emailSup]', '$_POST[kontakSup]'";
				$hal="data_supplier";
				insert($nama_tabel,$values);
				break;
			}
		case "pelanggan_insert":
			{
				$pelID=str_ireplace(" ",_,$_POST['pelanggan_id']);
				$nama_tabel="pelanggan";
				$values="'$_POST[pelanggan_inc]', '$pelID', '$_POST[nmPelanggan]', 
				'$_POST[alamatPel]', '$_POST[kotaPel]', '$_POST[emailPel]', '$_POST[kontakPel]'";
				$hal="data_pelanggan";
				insert($nama_tabel,$values);
				break;
			}
		//insert beli
		case "beli_insert":
		{
			//menjumlahkan semua harga_total dari temp_beli_detail
			$sum="SELECT SUM(harga_total) AS total FROM temp_beli_detail WHERE beli_id='$_POST[beli_id]'";
			$qsum=mysql_query($sum);
			$dsum=mysql_fetch_array($qsum);
			//insert ke tabel beli
			$beli="INSERT INTO beli(inc, beli_id, no_fak, tgl_trans, supplier_nama, biaya_kirim, total)
			VALUES('$_POST[inc]', '$_POST[beli_id]', '$_POST[no_fak]', '$_POST[tgl_trans]', '$_POST[pilih_supplier]', 
			'$_POST[ongkos]', '$dsum[total]')";
			mysql_query($beli);
			//insert data hutang
			$hutang="INSERT INTO hutang(beli_id, sisa_bayar, keterangan)
			VALUES('$_POST[beli_id]', '$dsum[total]', 'blm lunas')";
			mysql_query($hutang);
			//insert data hutang_detail
			$hutang_detail="INSERT INTO hutang_detail(beli_id, tgl_bayar, sisa_bayar, inc)
			VALUES('$_POST[beli_id]', '$_POST[tgl_trans]', '$dsum[total]', '1')";
			mysql_query($hutang_detail);
			//ambil data dari temp_beli_detail
			$tmp="SELECT * FROM temp_beli_detail WHERE beli_id='$_POST[beli_id]'";
			$qtmp=mysql_query($tmp);
			while($dtmp=mysql_fetch_array($qtmp))
			{
				//insert ke tabel beli_detail
				
				$beli_detail="INSERT INTO beli_detail(beli_id, barang_id, barang_nama, kategori, qty, satuan, harga_satuan, harga_total, packing, barang_inc)
				VALUES('$dtmp[beli_id]', '$dtmp[barang_id]', '$dtmp[barang_nama]', '$dtmp[kategori]', '$dtmp[qty]', 
				'$dtmp[satuan]', '$dtmp[harga_satuan]', '$dtmp[harga_total]', '$dtmp[packing]', '$dtmp[barang_inc]')";
				mysql_query($beli_detail);
				
				//insert ke tabel packing barang
				echo $pkqry="insert into stock_kemasan (id, barang_id, jen_pack, satuan) values (null, '$dtmp[barang_id]', '$dtmp[packing]', '$dtmp[satuan]')";
				$rspk=mysql_query($pkqry);
				
				//proses cek stok
				$cek="SELECT * FROM stok WHERE barang_id='$dtmp[barang_id]' and barang_inc='$dtmp[barang_inc]'";
				$qcek=mysql_query($cek);
				$dcek=mysql_fetch_array($qcek);
				$nbaris=mysql_num_rows($qcek);
				if ($nbaris==0)
				{
					//insert data
					$stok="INSERT INTO stok(barang_id, barang_nama, kategori, qty, satuan, packing, barang_inc)
					VALUES('$dtmp[barang_id]', '$dtmp[barang_nama]', '$dtmp[kategori]', '$dtmp[qty]', '$dtmp[satuan]', '$dtmp[packing]', '$dtmp[barang_inc]')";
					mysql_query($stok);
				}
				else
				{
					if (($dcek['barang_id']==$dtmp['barang_id'])&&($dcek['barang_inc']==$dtmp['barang_inc']))
					{
						//update qty stok barang
						$qty=$dcek['qty']+$dtmp['qty'];
						$upstok="UPDATE stok SET qty='$qty' WHERE barang_id='$dtmp[barang_id]' and barang_inc='$dtmp[barang_inc]'";
						mysql_query($upstok);
					}
					else
					{
						//insert data
						$stok="INSERT INTO stok(barang_id, barang_nama, kategori, qty, satuan, packing, barang_inc)
						VALUES('$dtmp[barang_id]', '$dtmp[barang_nama]', '$dtmp[kategori]', '$dtmp[qty]', '$dtmp[satuan]', '$dtmp[packing]', '$dtmp[barang_inc]')";
						mysql_query($stok);	
					}
				}
			}	
			//hapus data temp_beli_detil
			mysql_query("DELETE FROM temp_beli_detail WHERE beli_id='$_POST[beli_id]'");
			$hal="beli_detail&id=$_POST[beli_id]";
			break;
		}
		
		case "jual_insert":
		{
			//insert ke tabel jual
			$jual="INSERT INTO jual(inc, jual_id, no_nota, tgl_jual, username, pelanggan_nama, total, jml_bayar, tgl_jatuh_tempo)
			VALUES('$_POST[inc]', '$_POST[jual_id]', '$_POST[no_nota]', '$_POST[tgl_jual]', '$_POST[username]',
			'$_POST[pelanggan_nama]', '$_POST[total]', '$_POST[jml_bayar]', '$_POST[tgl_jatuh_tempo]')";
			mysql_query($jual);
			//select temp_jual_detail
			$tmp="SELECT * FROM temp_jual_detail";
			$qtmp=mysql_query($tmp);
			while($dtmp=mysql_fetch_array($qtmp))
			{
				$detail="INSERT INTO jual_detail(jual_id, barang_id, barang_nama, kategori, qty, satuan, harga_satuan, harga_total)
				VALUES('$_POST[jual_id]', '$dtmp[barang_id]', '$dtmp[barang_nama]', '$dtmp[kategori]', '$dtmp[qty]', 
				'$dtmp[satuan]', '$dtmp[harga_satuan]', '$dtmp[harga_total]')";
				mysql_query($detail);
			}
			//proses masuk ke piutang
			$sisa_piutang=$_POST['total']-$_POST['jml_bayar'];
			if($sisa_piutang!=0)
			{
				//insert ke piutang
				$piutang="INSERT INTO piutang(jual_id, no_nota, tgl_jual, pelanggan_nama, piutang_awal, 
				jml_bayar, piutang_sisa, tgl_jatuh_tempo, keterangan)
				VALUES('$_POST[jual_id]', '$_POST[no_nota]', '$_POST[tgl_jual]', '$_POST[pelanggan_nama]', 		
				'$sisa_piutang', '$_POST[jml_bayar]', '$sisa_piutang', '$_POST[tgl_jatuh_tempo]', 'blm lunas')";
				mysql_query($piutang);
				//insert ke piutang_detail
				$rinci="INSERT INTO piutang_detail(jual_id, tgl_bayar, jml_bayar, sisa_bayar, inc)
				VALUES('$_POST[jual_id]', '$_POST[tgl_jual]', '$_POST[jml_bayar]', '$sisa_piutang', '1')";
				mysql_query($rinci);
			}
			//hapus data temp_jual_detail
			$hapus="DELETE FROM temp_jual_detail WHERE jual_id='$_POST[jual_id]'";
			mysql_query($hapus);
			//halaman
			$hal="jual_detail&id=$_POST[jual_id]";
			break;
		}
		
		//akhir pemilihan fungsi insert
		case "bayar_hutang":
		{
			//cari sisa bayar
			$cek="SELECT * FROM hutang_detail WHERE beli_id='$_POST[beli_id]' ORDER BY inc DESC";
			$qcek=mysql_query($cek);
			$dcek=mysql_fetch_array($qcek);
			$sisa_bayar=$dcek['sisa_bayar']-$_POST['jml_bayar'];
			if($sisa_bayar==0)
			{
				$ket="lunas";
			}
			else
			{
				$ket="blm lunas";
			}
			$uphutang="UPDATE hutang SET sisa_bayar='$sisa_bayar', keterangan='$ket' WHERE beli_id='$_POST[beli_id]'";
			mysql_query($uphutang);
			//increment inc
			$a="SELECT * FROM hutang_detail";
			$b="SELECT inc FROM hutang_detail WHERE beli_id='$_POST[beli_id]' ORDER BY inc DESC LIMIT 1";
			$inc=penambahan($a, $b);
			//insert data
			$sql="INSERT INTO hutang_detail(beli_id, tgl_bayar, jml_bayar, sisa_bayar, inc)VALUES('$_POST[beli_id]', 
				'$_POST[tgl_bayar]', '$_POST[jml_bayar]', '$sisa_bayar', '$inc')";
			mysql_query($sql);
			$hal="hutang_rinci&id=$_POST[beli_id]";
			break;
		}
		///
		case "piutang_bayar":
		{
			//cari sisa bayar
			$cek="SELECT * FROM piutang_detail WHERE jual_id='$_POST[jual_id]' ORDER BY inc DESC";
			$qcek=mysql_query($cek);
			$dcek=mysql_fetch_array($qcek);
			$sisa_bayar=$dcek['sisa_bayar']-$_POST['jml_bayar'];
			if($sisa_bayar==0)
			{
				$ket="lunas";
			}
			else
			{
				$ket="blm lunas";
			}
			//sum jml_bayar
			$jmlB="SELECT SUM(jml_bayar) AS jmlB FROM piutang_detail WHERE jual_id='$_POST[jual_id]'";
			$qjmlB=mysql_query($jmlB);
			$djmlB=mysql_fetch_array($qjmlB);
			$jml_bayar=$djmlB['jmlB']+$_POST['jml_bayar'];
			//update ke piutang
			$uppiutang="UPDATE piutang SET jml_bayar='$jml_bayar', piutang_sisa='$sisa_bayar', keterangan='$ket' 
			WHERE jual_id='$_POST[jual_id]'";
			mysql_query($uppiutang);
			//increment inc
			$a="SELECT * FROM piutang_detail";
			$b="SELECT inc FROM piutang_detail WHERE jual_id='$_POST[jual_id]' ORDER BY inc DESC LIMIT 1";
			$inc=penambahan($a, $b);
			//insert data
			$sql="INSERT INTO piutang_detail(jual_id, tgl_bayar, jml_bayar, sisa_bayar, inc)VALUES('$_POST[jual_id]', 
				'$_POST[tgl_bayar]', '$_POST[jml_bayar]', '$sisa_bayar', '$inc')";
			mysql_query($sql);
			$hal="piutang_rinci&id=$_POST[jual_id]";
			break;
		}
		//pemilihan fungsi update
		case "barang_update":
			{
				$nama_tabel="barang";
				$values="barang_id='$_POST[Barang_Kode]', barang_nama='$_POST[nmBarang]', barang_kategori='$_POST[kategori]'";
				$kondisi="inc='$_POST[inc]'";
				$hal="data_barang";
				update($nama_tabel,$values,$kondisi);
				break;
			}	
		case "supplier_update":
			{
				$nama_tabel="supplier";
				$values="supplier_nama='$_POST[nmSupplier]', supplier_alamat='$_POST[alamatSup]', 
				supplier_kota='$_POST[kotaSup]', supplier_email='$_POST[emailSup]', supplier_kontak='$_POST[kontakSup]'";
				$kondisi="supplier_id='$_POST[supplier_id]'";
				$hal="data_supplier";
				update($nama_tabel,$values,$kondisi);
				break;
			}
		case "pelanggan_update":
			{
				$nama_tabel="pelanggan";
				$values="pelanggan_nama='$_POST[nmPelanggan]', pelanggan_alamat='$_POST[alamatPel]', 
				pelanggan_kota='$_POST[kotaPel]', pelanggan_email='$_POST[emailPel]', pelanggan_kontak='$_POST[kontakPel]'";
				$kondisi="pelanggan_id='$_POST[pelanggan_id]'";
				$hal="data_pelanggan";
				update($nama_tabel,$values,$kondisi);
				break;
			}
		case "ubah_stok":
		{
				$sql="UPDATE stok SET qty='$_POST[qty]' WHERE barang_id='$_POST[barang_id]'";
				mysql_query($sql);
				$hal="stok";
				break;
		}
		case "ubah_akun":
		{
			$sql="UPDATE account SET password='$_POST[password]', nama='$_POST[nama]', level='$_POST[level]' WHERE username='$_POST[username]'";
			mysql_query($sql);
			$hal="data_akun";
			break;
		}
	}//end switch
	
switch($hapus){
	//pemilihan fungsi delete
	case "barang_delete":
			{
				$nama_tabel="barang";
				$kondisi="inc='$_GET[id]'";
				$hal="data_barang";
				delete($nama_tabel,$kondisi);
				break;
			}
	case "supplier_delete":
			{
				$nama_tabel="supplier";
				$kondisi="supplier_id='$_GET[id]'";
				$hal="data_supplier";
				delete($nama_tabel,$kondisi);
				break;
			}
	case "pelanggan_delete":
			{
				$nama_tabel="pelanggan";
				$kondisi="pelanggan_id='$_GET[id]'";
				$hal="data_pelanggan";
				delete($nama_tabel,$kondisi);
				break;
			}
	case "hapus_item_beli":
	{
		if ($_GET['status']=="satu"){
			$pesan="DELETE FROM temp_beli_detail WHERE barang_id='$_GET[id]'";
			mysql_query($pesan);
		}else{
			$pesan="DELETE FROM temp_beli_detail WHERE beli_id='$_GET[id]'";
			mysql_query($pesan);
		}
		$url="transaksi";
		$hal="form_beli.php";
		break;
	}

	case "hapus_item_jual":
	{
		//select stok
		$stok="SELECT * FROM stok WHERE barang_id='$_GET[id]'";
		$qstok=mysql_query($stok);
		$dstok=mysql_fetch_array($qstok);
		//select temp_jual_detail
		$jual="SELECT * FROM temp_jual_detail WHERE barang_id='$_GET[id]'";
		$qjual=mysql_query($jual);
		$djual=mysql_fetch_array($qjual);
		//hasil stok sekarang
		$qty=$dstok['qty']+$djual['qty'];
		//update stok
		$upstok="UPDATE stok SET qty='$qty' WHERE barang_id='$_GET[id]'";
		mysql_query($upstok);
		//hapus barang dari temp_jual_detail
		$hapus="DELETE FROM temp_jual_detail WHERE barang_id='$_GET[id]'";
		mysql_query($hapus);
		$url="transaksi";
		$hal="form_jual.php";
		break;
	}
	case "hapus_stok":
	{
		$sql="DELETE FROM stok WHERE barang_id='$_GET[id]'";
		mysql_query($sql);
		$hal="stok";
		break;
	}
	case "hapus_akun":
	{
		$sql="DELETE FROM account WHERE username='$_GET[id]'";
		mysql_query($sql);
		$hal="data_akun";
		break;
	}
}
	if ($url=="transaksi")
	{
		lompat_ke($hal);
	}
	else
	{
		lompat_ke("index.php?halaman=".$hal);
	}
?>