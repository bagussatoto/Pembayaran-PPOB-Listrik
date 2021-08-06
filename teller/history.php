<?php  
	if (!isset($_GET['menu'])) {
	 	header('location:hal_utama.php?menu=history');
	}

	//dasar
	$table = "pembayaran";
	$redirect = "?menu=history";

	if (isset($_POST['bcari'])) {
		$text = $_POST['tcari'];
		$cari = "WHERE id_teller = '$_SESSION[id_teller]' AND id_pelanggan LIKE '%$text%' OR id_pembayaran LIKE '%$text%' OR jumlah_pembayaran LIKE '%$text%' OR nama_teller LIKE '%$text%' OR tahun_pembayaran LIKE '%$text%' OR nama_pelanggan LIKE '%$text%' OR bulan_pembayaran LIKE '%$text%' OR total LIKE '%$text%' OR bayar LIKE '%$text%' OR kembali LIKE '%$text%' ";
	}else{
		$cari=" WHERE id_teller = '$_SESSION[id_teller]'";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>HISTORY</title>
</head>
<style type="text/css">
  .panel-heading{
    background: #cceeff	 !important;
  }
  .panel-body{
	  background: #f7f8f7 !important;
  }
</style>
<body>
	<div class="container-fluid" style="color: black;font-family: Myriad Pro Light">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading"><b>HISTORY PEMBAYARAN</b></div>
					<div class="panel-body">
						<div class="col-md-12">
							<form method="post">
								<div class="input-group">
									<input type="text" name="tcari" class="form-control" value="<?php echo @$text ?>" placeholder="Masukkan Keyword Pencarian...">
									<div class="input-group-btn">
										<button type="submit" name="bcari" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>&nbsp;</button>
										<button type="submit"  name="brefresh" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span>&nbsp;</button>
									</div>
								</div>
							</form>
						</div>
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-bordered table-striped table-hover">
									<thead>
										<th>No.</th>
										<th>ID Pembayaran</th>
										<th>ID Pelanggan</th>
										<th>Nama Pelanggan</th>
										<th>Waktu Pembayaran</th>
										<th>Bulan Pembayaran</th>
										<th><center>Jumlah Pembayaran</center></th>
										<th><center>Biaya Admin</center></th>
										<th><center>Total Akhir</center></th>
										<th><center>Bayar</center></th>
										<th><center>Kembali</center></th>
										<th><center>Petugas</center></th>
										<th><center>Cetak<br>Bukti</center></th>
									</thead>
									<tbody>
										<?php  
											$no=0;
											$data = $aksi->tampil("v_pembayaran",$cari," order by id_pembayaran desc");
											if ($data=="") {
												$aksi->no_record(13);
											}else{
												foreach ($data as $r) {
												$no++; ?>
													<tr>
														<td><?php echo $no; ?>.</td>
														<td><?php echo $r['id_pembayaran']; ?></td>
														<td><?php echo $r['id_pelanggan']; ?></td>
														<td><?php echo $r['nama_pelanggan']; ?></td>
														<td><?php echo $r['waktu_pembayaran']; ?></td>
														<td><?php $aksi->bulan($r['bulan_pembayaran']);echo " ".$r['tahun_pembayaran']; ?></td>
														<td><?php $aksi->rupiah($r['jumlah_pembayaran']); ?></td>
														<td><?php $aksi->rupiah($r['biaya_admin']); ?></td>
														<td><?php $aksi->rupiah($r['total']); ?></td>
														<td><?php $aksi->rupiah($r['bayar']); ?></td>
														<td><?php $aksi->rupiah($r['kembali']); ?></td>
														<td><?php echo $r['nama_teller']?></td>
														<td><a href="struk.php?id_pelanggan=<?php echo $r['id_pelanggan']; ?>&bulan=<?php echo $r['bulan_pembayaran']; ?>&tahun=<?php echo $r['tahun_pembayaran']; ?>" target="_blank" class="btn btn-primary">CETAK</a></td>
													</tr>
		
											<?php }} ?>
								 	</tbody>
								</table>
							</div>	
						</div>
					</div>
					<div class="panel-footer">&nbsp;</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>