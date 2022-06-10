<?php include 'config_connect.php';
$search = $_GET['search'];
$forward = $_GET['forward'];
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$forward.xls");

?>
<?php if($forward == 'bayar'){ ?>
      <table class="table">
                                        <thead>
                                            <tr>
                                              <th>No</th>
                                              <th>No Nota</th>
                                              <th>Tanggal</th>
                                              <th>Pelanggan</th>
                                              <th>Total Pembayaran</th>
                                              <th>Deadline</th>
                                              <th>Cc</th>
                                            </tr>
                                        </thead>
										  <?php
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

					$query1="SELECT * FROM  bayar where nota like '%$search%' or tglmasuk like '%$search%' or kasir like '%$search%' order by no ";
				$hasil = mysqli_query($conn,$query1);
				$no = 1;
				while ($fill = mysqli_fetch_assoc($hasil)){
					?>
                     <tbody>
<tr>
  <td><?php echo ++$no_urut;?></td>
  <td><?php  echo mysqli_real_escape_string($conn, $fill['nota']); ?></td>
  <td><?php  echo mysqli_real_escape_string($conn, $fill['tglmasuk'].' / '.date('H:i', strtotime($fill['jammasuk']))); ?></td>
  <?php
 $pelanggan = $fill['pelanggan'];
 $sqle="SELECT nama FROM pelanggan WHERE kode ='$pelanggan'";
 $hasile=mysqli_query($conn,$sqle);
 $rowa=mysqli_fetch_assoc($hasile);
 $namapelanggan=$rowa['nama'];
   ?>
  <td><?php  echo mysqli_real_escape_string($conn, $namapelanggan); ?></td>
  <td><?php  echo mysqli_real_escape_string($conn, $fill['total']); ?></td>
  <td><?php  echo mysqli_real_escape_string($conn, $fill['tgldeadline'].' / '.date('H:i', strtotime($fill['jamdeadline']))); ?></td>
  <td><?php  echo mysqli_real_escape_string($conn, $fill['kasir']); ?></td>
					  </tr><?php
					;
				}

				?>
                  </tbody></table>
<?php } ?>


<?php if($forward == 'barang'){ ?>
      <table class="table">
                                        <thead>
                                            <tr>
                                              <th>No</th>
                                              <th>Kode Barang</th>
                                              <th>Nama Barang</th>
                                              <th>Kategori</th>
                                              <th>Stok Terjual</th>
                                              <th>Stok Terbeli</th>
                                              <th>Stok Tersedia</th>
                                            </tr>
                                        </thead>
										  <?php
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

  $query1="select barang.kode as kode, barang.nama as nama, terjual, terbeli, sisa, kategori.nama as kategori from $forward inner join kategori on kategori.kode = barang.kategori where barang.kode like '%$search%' or barang.nama like '%$search%' or kategori.nama like '%$search%' order by barang.no";
				$hasil = mysqli_query($conn,$query1);
				$no = 1;
				while ($fill = mysqli_fetch_assoc($hasil)){
					?>
                     <tbody>
<tr>
  <td><?php echo ++$no_urut;?></td>
  <td><?php  echo mysqli_real_escape_string($conn, $fill['kode']); ?></td>
  <td><?php  echo mysqli_real_escape_string($conn, $fill['nama']); ?></td>
  <td><?php  echo mysqli_real_escape_string($conn, $fill['kategori']); ?></td>
  <td><?php  echo mysqli_real_escape_string($conn, $fill['terjual']); ?></td>
  <td><?php  echo mysqli_real_escape_string($conn, $fill['terbeli']); ?></td>
  <td><?php  echo mysqli_real_escape_string($conn, $fill['sisa']); ?></td>
					  </tr><?php
					;
				}

				?>
                  </tbody></table>
<?php } ?>

<?php if($forward == 'revenue'){

  $forward = 'bayar';
  $bulan = $_GET['bulan'];
  $tahun = $_GET['tahun'];

  ?>

      <table class="table">
                                        <thead>
                                            <tr>
                                              <th>No</th>
                                              <th>No Nota</th>
                                              <th>Tanggal</th>
                                              <th>Pelanggan</th>
                                              <th>Total Pembayaran</th>
                                              <th>Deadline</th>
                                              <th>Cc</th>
                                            </tr>
                                        </thead>
										  <?php
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if($tahun == null || $tahun == ""){
  $query1="SELECT * FROM  $forward where nota IN (SELECT nota FROM transaksimasuk) order by no ";
}else{
  $query1="SELECT * FROM  $forward where nota IN (SELECT nota FROM transaksimasuk) and tglmasuk like '$tahun-$bulan-%' order by no ";
}
				$hasil = mysqli_query($conn,$query1);
				$no = 1;
				while ($fill = mysqli_fetch_assoc($hasil)){
					?>
                     <tbody>
                       <tr>
                         <td><?php echo ++$no_urut;?></td>
                         <td><?php  echo mysqli_real_escape_string($conn, $fill['nota']); ?></td>
                         <td><?php  echo mysqli_real_escape_string($conn, $fill['tglmasuk'].' / '.date('H:i', strtotime($fill['jammasuk']))); ?></td>
                         <?php
                        $pelanggan = $fill['pelanggan'];
                        $sqle="SELECT nama FROM pelanggan WHERE kode ='$pelanggan'";
                        $hasile=mysqli_query($conn,$sqle);
                        $rowa=mysqli_fetch_assoc($hasile);
                        $namapelanggan=$rowa['nama'];
                          ?>
                         <td><?php  echo mysqli_real_escape_string($conn, $namapelanggan); ?></td>
                         <td><?php  echo mysqli_real_escape_string($conn, $fill['total']); ?></td>
                         <td><?php  echo mysqli_real_escape_string($conn, $fill['tgldeadline'].' / '.date('H:i', strtotime($fill['jamdeadline']))); ?></td>
                         <td><?php  echo mysql_real_escape_string($fill['kasir']); ?></td>
                       					  </tr><?php
					;
				}

				?>
                  </tbody></table>
<?php } ?>


<?php if($forward == 'income'){

  $forward = 'bayar';
  $bulan = $_GET['bulan'];
  $tahun = $_GET['tahun'];

  ?>

      <table class="table">
                                        <thead>
                                            <tr>
                                              <th>No</th>
                                              <th>No Nota</th>
                                              <th>Tanggal</th>
                                              <th>Jumlah Item</th>
                                              <th>Total Masuk</th>
                                              <th>Total Keluar</th>
                                              <th>Income</th>
                                              <th>Cc</th>
                                            </tr>
                                        </thead>
										  <?php
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if($tahun == null || $tahun == ""){
  $query1="SELECT * FROM  $forward where nota IN (SELECT nota FROM transaksimasuk) order by no ";
}else{
  $query1="SELECT * FROM  $forward where nota IN (SELECT nota FROM transaksimasuk) and tglbayar like '$tahun-$bulan-%' order by no ";
}
				$hasil = mysqli_query($conn,$query1);
				$no = 1;
				while ($fill = mysqli_fetch_assoc($hasil)){
					?>
                     <tbody>
<tr>
  <td><?php echo ++$no_urut;?></td>
  <td><?php  echo mysqli_real_escape_string($conn, $fill['nota']); ?></td>
  <td><?php  echo mysqli_real_escape_string($conn, $fill['tglbayar']); ?></td>
  <?php
$nota = $fill['nota'];
$sqle="SELECT COUNT( nota ) AS data FROM transaksimasuk WHERE nota ='$nota'";
$hasile=mysqli_query($conn,$sqle);
$rowa=mysqli_fetch_assoc($hasile);
$jumlahbayar=$rowa['data'];
   ?>
  <td><?php  echo mysqli_real_escape_string($conn, $jumlahbayar); ?></td>
  <td><?php  echo mysqli_real_escape_string($conn, $fill['total']); ?></td>
  <td><?php  echo mysqli_real_escape_string($conn, $fill['keluar']); ?></td>
  <td><?php  echo mysqli_real_escape_string($conn, $fill['total']-$fill['keluar']); ?></td>
  <td><?php  echo mysqli_real_escape_string($conn, $fill['kasir']); ?></td>
  <td>
					  </tr><?php
					;
				}

				?>
                  </tbody></table>
<?php } ?>


<?php if($forward == 'operasional'){ ?>

      <table class="table">
                                        <thead>
                                            <tr>
                                              <th>No</th>
                                              <th>Kode</th>
                                              <th>Nama</th>
                                              <th>Tanggal</th>
                                              <th>Biaya</th>
                                              <th>Keterangan</th>
                                              <th>Cc</th>
                                            </tr>
                                        </thead>
										  <?php
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if($tahun == null || $tahun == ""){
  $query1="SELECT * FROM  $forward order by no ";
}else{
  $query1="SELECT * FROM  $forward where tanggal like '$tahun-$bulan-%' order by no ";
}
				$hasil = mysqli_query($conn,$query1);
				$no = 1;
				while ($fill = mysqli_fetch_assoc($hasil)){
					?>
                     <tbody>
<tr>
  <td><?php echo ++$no_urut;?></td>
  <td><?php  echo mysqli_real_escape_string($conn, $fill['kode']); ?></td>
  <td><?php  echo mysqli_real_escape_string($conn, $fill['nama']); ?></td>
  <td><?php  echo mysqli_real_escape_string($conn, $fill['tanggal']); ?></td>
  <td><?php  echo mysqli_real_escape_string($conn, number_format($fill['biaya'], $decimal, $a_decimal, $thousand).',-'); ?></td>
  <td><?php  echo mysqli_real_escape_string($conn, $fill['keterangan']); ?></td>
  <td><?php  echo mysqli_real_escape_string($conn, $fill['kasir']); ?></td>
					  </tr><?php
					;
				}

				?>
                  </tbody></table>
<?php } ?>
