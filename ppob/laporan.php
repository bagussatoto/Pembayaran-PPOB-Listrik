<?php  
	if (!isset($_GET['menu'])) {
	 	header('location:hal_utama.php?menu=laporan');

	$bulanini = $_POST['bulan'];
	$tahunini = $_POST['tahun'];

	$cari = "WHERE MONTH(tgl_bayar) = '$bulanini' AND YEAR(tgl_bayar) ='$tahunini' AND id_teller = '$_SESSION[id_teller]'";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>LAPORAN</title>
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
<!-- INI LAPORAN TARIF -->
				<?php  
					if (isset($_GET['tarif'])) { 
						$table = "tarif";
						$cari = "";
						$link_print = "print.php?tarif";
						$judul = "LAPORAN DAFTAR TARIF";
					?>
						<div class="panel panel-default">
							<div class="panel-heading">
								LAPORAN DAFTAR TARIF
								<div class="pull-right">
									<a href="<?php echo $link_print ?>" target="_blank">
									<div class="glyphicon glyphicon-print"></div>&nbsp;&nbsp;
									<label>CETAK</label></a>
									&nbsp;&nbsp;
								</div>
							</div>
							<div class="panel-body">
										<center><label><?php echo @$judul; ?></label></center>
								<div class="table-responsive">
									<table class="table table-bordered table-striped table-hover">
										<thead>
											<th><center>No.</center></th>
											<th><center>Kode Tarif</center></th>
											<th><center>Golongan</center></th>
											<th><center>Daya</center></th>
											<th><center>Tarif/Kwh</center></th>
										</thead>
										<tbody>
											<?php  
												$no=0;
												$data = $aksi->tampil($table,$cari,"ORDER BY golongan ASC");
												if ($data=="") {
													$aksi->no_record(5);
												}else{
													foreach ($data as $r) {
														$no++; ?>

													<tr>
														<td align="center"><?php echo $no; ?>.</td>
														<td align="center"><?php echo $r['no_tarif'] ?></td>
														<td align="center"><?php echo $r['golongan'] ?></td>
														<td align="center"><?php echo $r['daya'] ?></td>
														<td align="right"><?php $aksi->rupiah($r['tarif_perkwh']) ?></td>
													</tr>

											<?php } } ?>
										 </tbody>
									</table>
								</div>
							</div>
						</div>
<!-- INI END LAPORAN TARIF -->

<!-- INI LAPORAN PELANGGAN -->
					<?php }elseif(isset($_GET['pelanggan'])){ 
						$table = "pelanggan";
						$cari = "";
						$link_print = "print.php?pelanggan";
						$judul = "LAPORAN DAFTAR PELANGGAN";
					?>
						<div class="panel panel-default">
							<div class="panel-heading">
								LAPORAN DAFTAR PELANGGAN
								<div class="pull-right">
									<a href="<?php echo $link_print ?>" target="_blank">
									<div class="glyphicon glyphicon-print"></div>&nbsp;&nbsp;
									<label>CETAK</label></a>
									&nbsp;&nbsp;
								</div>
							</div>
							<div class="panel-body">
										<center><label><?php echo @$judul; ?></label></center>
								<div class="table-responsive">
									<table class="table table-bordered table-striped table-hover">
										<thead>
											<th><center>No.</center></th>
											<th><center>ID Pelanggan</center></th>
											<th><center>No.Meter</center></th>
											<th><center>Nama Pelanggan</center></th>
											<th><center>Alamat Pelanggan</center></th>
											<th><center>Batas Waktu</center></th>
											<th><center>Nomor Tarif</center></th>
										</thead>
										<tbody>
											<?php  
												$no=0;
												$data = $aksi->tampil($table,$cari,"ORDER BY id_pelanggan");
												if ($data=="") {
													$aksi->no_record(9);
												}else{
													foreach ($data as $r) {
														$a = $aksi->caridata("tarif WHERE id_tarif = '$r[id_tarif]'");
													$no++; ?>
													<tr>
														<td align="center"><?php echo $no; ?>.</td>
														<td align="center"><?php echo $r['id_pelanggan'] ?></td>
														<td align="center"><?php echo $r['no_seri'] ?></td>
														<td><?php echo $r['nama_plgn'] ?></td>
														<td><?php echo $r['alamat_plgn'] ?></td>
														<td align="center"><?php echo $r['batas_waktu'] ?></td>
														<td align="center"><?php echo $a['no_tarif'] ?></td>
													</tr>

											<?php } } ?>
										 </tbody>
									</table>
								</div>
							</div>
						</div>
<!-- INI END LAPORAN PELANGGAN -->

<!-- INI LAPORAN teller -->
					<?php }elseif(isset($_GET['teller'])){ 
						$table = "teller";
						$cari = "";
						$link_print = "print.php?teller";
						$judul = "LAPORAN DAFTAR teller";
					?>
						<div class="panel panel-default">
							<div class="panel-heading">
								LAPORAN DAFTAR TELLER
								<div class="pull-right">
									<a href="<?php echo $link_print ?>" target="_blank">
									<div class="glyphicon glyphicon-print"></div>&nbsp;&nbsp;
									<label>CETAK</label></a>
									&nbsp;&nbsp;
								</div>
							</div>
							<div class="panel-body">
										<center><label><?php echo @$judul; ?></label></center>

								<div class="table-responsive">
									<table class="table table-bordered table-striped table-hover">
										<thead>
											<th width="5%"><center>No.</center></th>
											<th width="13%"><center>ID Teller</center></th>
											<th width="20%"><center>Nama</center></th>
											<th width="12%"><center>NoomorTelepon</center></th>
											<th><center>Alamat</center></th>
											<th width="12%"><center>Biaya Admin</center></th>
										</thead>
										<tbody>
											<?php  
												$no = 0;
												$a = $aksi->tampil($table,$cari,"ORDER BY id_teller DESC");
												if ($a=="") {
													$aksi->no_record(7);
												}else{
													foreach ($a as $r) {
														$cek = $aksi->cekdata(" pembayaran WHERE id_teller = '$r[id_teller]'");
														$no++;
												?>
												<tr>
													<td align="center"><?php echo $no; ?>.</td>
													<td align="center"><?php echo $r['id_teller']; ?></td>
													<td><?php echo $r['nama']; ?></td>
													<td align="center"><?php echo $r['no_telp']; ?></td>
													<td><?php echo $r['alamat']; ?></td>
													<td align="right"><?php $aksi->rupiah($r['biaya_admin']); ?></td>
												</tr>

										<?php	} } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
<!-- INI END LAPORAN teller -->

<!-- INI LAPORAN TAGIHAN BULAN -->
					<?php }elseif(isset($_GET['tagihan_bulan'])){ 
						$data ="";
						if(isset($_POST['bcari'])){
						$table = "v_tagihan";
                            $status = $_POST['status'];
                            $bulanini = $_POST['bulan'];
                            $tahunini = $_POST['tahun'];

                            @$cari = "WHERE status = '$status' AND bulan = '$bulanini' AND tahun ='$tahunini'";

                            $data = $aksi->tampil($table,$cari,"");
                            $judul = "LAPORAN TAGIHAN ".strtoupper($status)." BULAN ".strtoupper($bulanini)." TAHUN $tahunini";
                        }else{
                        	@$data ="";
                        }
					?>
						<div class="panel panel-default">
							<div class="panel-heading">
								LAPORAN TAGIHAN PER-BULAN
							</div>
							<div class="panel-body">
								<div class="col-md-12">
									<form method="post">
										<div class="input-group">
											<div class="input-group-addon">STATUS</div>
											<select name="status" class="form-control" required>
												<option></option>
												<option value="Terbayar" <?php if(@$status == "Terbayar"){echo "selected";} ?>>Terbayar</option>
												<option value="Belum Bayar" <?php if(@$status == "Belum Bayar"){echo "selected";} ?>>Belum Bayar</option>
											</select>
											<div class="input-group-addon">Bulan</div>
											<select name="bulan" class="form-control">
												<option></option>
												<?php  
													for ($a=1; $a <=12 ; $a++) { 
														if ($a<10) {
															$b = "0".$a;
														}else{
															$b = $a;
														} ?>
														<option value="<?php echo $b; ?>" <?php if(@$b==@$bulanini){echo "selected";} ?>><?php $aksi->bulan($b); ?></option>
														
													<?php } ?>
											</select>
											<div class="input-group-addon" id="pri">Tahun</div>
											<select name="tahun" class="form-control">
												<option></option>
												<?php 
												for ($a=2018; $a < 2031; $a++) {
												?>
												<option value="<?php echo $a; ?>" <?php if(@$a==@$tahunini){echo "selected";} ?>><?php echo @$a; ?></option>
												<?php } ?>
											</select>
											<div class="input-group-btn">
												<button type="submit" name="bcari" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>&nbsp;</button>
												<a href="?menu=laporan&tagihan_bulan" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span>&nbsp;</a>
											</div>
										</div>
									</form>
								</div>
										<center><label>LAPORAN TAGIHAN <?php echo strtoupper(@$status)." BULAN ";$aksi->bulan(@$bulanini);echo " TAHUN ".@$tahunini; ?></label></center>
                             	<div class="col-md-12">
                           			<div class="table-responsive">
										<table class="table table-bordered table-striped table-hover">
											<thead>
												<th><center>No.</center></th>
												<th><center>ID Pelanggan</center></th>
												<th><center>Nama Pelanggan</center></th>
												<th><center>Bulan</center></th>
												<th><center>Jumlah Meter</center></th>
												<th><center>Jumlah Bayar</center></th>
												<th><center>Status</center></th>
												<th><center>manager</center></th>
											</thead>
											<tbody>
												<?php  
													$no=0;
													if ($data=="") {
														$aksi->no_record(8);
													}else{
														foreach ($data as $r) {
															$no++; 
														?>

														<tr>
															<td align="center"><?php echo $no; ?>.</td>
															<td align="center"><?php echo $r['id_pelanggan'] ?></td>
															<td><?php echo $r['nama_plgn'] ?></td>
															<td><?php $aksi->bulan($r['bulan']);echo " ".$r['tahun'];?></td>
															<td align="center"><?php echo $r['jumlah_meter'] ?></td>
															<td align="right"><?php $aksi->rupiah($r['jumlah_bayar'])?></td>
															<td align="center"><?php echo $r['status']; ?></td>
															<td align="center"><?php echo $r['nama_mgr']; ?></td>
														</tr>

												<?php } } ?>
											 </tbody>
										</table>
									</div>
                           		</div>
		                   </div>
						</div>
<!-- INI END LAPORAN TAGIHAN BULAN -->

<!-- INI LAPORAN TUNGGAKAN -->
					<?php }elseif(isset($_GET['tunggakan'])){ 
							$table = "v_tagihan";
							$cari = "WHERE status = 'Belum Bayar'";
							$link_print = "print.php?tunggakan";
							$judul = "LAPORAN PELANGGAN YANG MEMILIKI TUNGGAKAN LEBIH DARI 3 BULAN";
						?>
						<div class="panel panel-default">
							<div class="panel-heading">
								LAPORAN DAFTAR PELANGGAN YANG MEMILIKI TUNGGAKAN
								<div class="pull-right">
									<a href="<?php echo $link_print ?>" target="_blank"><div class="glyphicon glyphicon-print"></div>&nbsp;&nbsp;<label>CETAK</label></a>
									&nbsp;&nbsp;
								</div>
							</div>
							<div class="panel-body">
                             	<div class="col-md-12">
										<center><label><?php echo @$judul; ?></label></center>
                           			<div class="table-responsive">
										<table class="table table-bordered table-striped table-hover">
											<thead>
												<th><center>No.</center></th>
												<th><center>ID Pelanggan</center></th>
												<th><center>Nama Pelanggan</center></th>
												<th><center>Alamat</center></th>
												<th><center>Banyak Tunggakan</center></th>
												<th><center>Bulan</center></th>
												<th><center>Total Meter</center></th>
												<th><center>Tarif/Kwh</center></th>
												<th><center>Total Tunggakan</center></th>
											</thead>
											
											<tbody>
												<?php  
													$no=0;
													$data = $aksi->tampil("pelanggan","","ORDER BY nama_plgn ASC");
													if ($data=="") {
														$aksi->no_record(8);
													}else{
														foreach ($data as $r) {
															$cek = $aksi->cekdata("tagihan WHERE id_pelanggan = '$r[id_pelanggan]' AND status = 'Belum Bayar'");
															?>
														<?php  
															if($cek >= 3){
																$no++; 
																$sum = mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT id_pelanggan,COUNT(bulan) as bln_tunggak,sum(jumlah_bayar) jml_bayar,SUM(jumlah_meter) as jml_meter,tarif_perkwh FROM tagihan WHERE id_pelanggan = '$r[id_pelanggan]' AND status = 'Belum Bayar'"));
																$bulan = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM tagihan WHERE id_pelanggan = '$r[id_pelanggan]' AND status = 'Belum Bayar' ");
																?>
																<tr>
																	<td align="center"><?php echo $no; ?>.</td>
																	<td align="center"><?php echo $r['id_pelanggan'] ?></td>
																	<td><?php echo $r['nama_plgn'] ?></td>
																	<td align="left"><?php echo $r['alamat_plgn'] ?></td>
																	<td align="center"><?php echo $sum['bln_tunggak']; ?>&nbsp;Bulan</td>
																	<td align="center">
																		<?php while($bln = mysqli_fetch_array($bulan)){
																			$aksi->bulan_substr($bln['bulan']);echo substr($bln['tahun'], 2,2).",";
																		} ?>
																			
																	</td>
																	<td align="center"><?php echo $sum['jml_meter'] ?></td>
																	<td align="right"><?php $aksi->rupiah($sum['tarif_perkwh']); ?></td>
																	<td align="right"><?php $aksi->rupiah($sum['jml_bayar']); ?></td>
																</tr>
														<?php } }  }?>
											</tbody>
										</table>
									</div>
                           		</div>
		                   </div>
						</div>
<!-- INI END LAPORAN TUNGGAKAN -->

<!-- INI LAPORAN RIWAYAT PENGGUNAAN -->
					<?php }elseif(isset($_GET['riwayat_penggunaan'])){ 
							if (isset($_POST['bcari'])) {
								$table = "v_tagihan";
								$id_pelanggan = $_POST['id_pelanggan'];
								$pelanggan = $aksi->caridata("pelanggan WHERE id_pelanggan = '$id_pelanggan'");
								$tahun = $_POST['tahun'];

								$cari = "WHERE id_pelanggan = '$id_pelanggan' AND tahun = '$tahun'";
								$data = $aksi->tampil($table,$cari,"ORDER BY bulan ASC");

								$judul = "LAPORAN RIWAYAT PENGGUNNAN $id_pelanggan - ".strtoupper($pelanggan['nama_plgn'])." PADA TAHUN $tahun";
							}else{
								$data ="";
							}
						?>
						<div class="panel panel-default">
							<div class="panel-heading">
								LAPORAN RIWAYAT PENGGUNNAN PERTAHUN
							</div>
							<div class="panel-body">
								<div class="col-md-12">
									<form method="post">
										<div class="input-group">
											<div class="input-group-addon">ID PELANGGAN</div>
											<input type="text" name="id_pelanggan" class="form-control" placeholder="Masukan ID Pelanggan" value="<?php echo @$id_pelanggan ?>" list="id_pel" onkeypress='return event.charCode >=48 && event.charCode <=57' <?php if(@$_GET['id']){echo "readonly";} ?>>
											<datalist id="id_pelanggan">
												<?php  
													$a = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM pelanggan");
													while ($b = mysqli_fetch_array($a)) { ?>
														<option value="<?php echo $b['id_pelanggan'] ?>"><?php echo $b['nama_plgn']; ?></option>
												<?php } ?>
											</datalist>
											<div class="input-group-addon" id="pri">Tahun</div>
											<select name="tahun" class="form-control">
												<option></option>
												<?php 
												for ($a=2018; $a < 2031; $a++) {
												?>
												<option value="<?php echo $a; ?>" <?php if(@$a==@$tahun){echo "selected";} ?>><?php echo @$a; ?></option>
												<?php } ?>
											</select>
											<div class="input-group-btn">
												<button type="submit" name="bcari" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>&nbsp;</button>
												<a href="?menu=laporan&riwayat_penggunaan" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span>&nbsp;</a>
											</div>
										</div>
									</form>
								</div>
										<center><label><?php echo @$judul; ?></label></center>
								<div class="col-md-12">
									<div class="table-responsive">
										<table class="table table-bordered table-striped table-hover">
											<thead>
												<th><center>No.</center></th>
												<th><center>ID Pelanggan</center></th>
												<th><center>Nama Pelanggan</center></th>
												<th><center>Bulan</center></th>
												<th><center>Meter Awal</center></th>
												<th><center>Meter Akhir</center></th>
												<th><center>Jumlah Meter</center></th>
												<th><center>Tarif/KWh</center></th>
												<th><center>Jumlah Bayar</center></th>
											</thead>
											<tbody>
												<?php  
													$no = 0;
													if ($data=="") {
														$aksi->no_record(9);
													}else{
														foreach ($data as $r) {
															$no++;
															$penggunaan = $aksi->caridata("penggunaan WHERE id_pelanggan = '$r[id_pelanggan]' AND bulan = '$r[bulan]' AND tahun = '$r[tahun]'");
													?>
														<tr>
															<td align="center"><?php echo $no; ?>.</td>
															<td align="center"><?php echo $r['id_pelanggan']; ?></td>
															<td align="left"><?php echo $r['nama_plgn']; ?></td>
															<td align="center"><?php $aksi->bulan($r['bulan']);echo " ".$r['tahun']; ?></td>
															<td align="center"><?php echo $penggunaan['meter_awal']; ?></td>
															<td align="center"><?php echo $penggunaan['meter_akhir']; ?></td>
															<td align="center"><?php echo $r['jumlah_meter']; ?></td>
															<td align="right"><?php $aksi->rupiah($r['tarif_perkwh']); ?></td>
															<td align="right"><?php $aksi->rupiah($r['jumlah_bayar']); ?></td>
														</tr>
												<?php } } 
													@$sum = mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT SUM(jumlah_meter) as meter,SUM(jumlah_bayar) as bayar FROM tagihan WHERE id_pelanggan = '$id_pelanggan' AND tahun = '$tahun'"));
												?>
											</tbody>
											<tfoot>
												<tr>
													<td colspan="6" align="right">TOTAL METER :</td>
													<td align="center"><?php echo $sum['meter'] ; ?></td>
													<td align="right">TOTAL BAYAR :</td>
													<td align="right"><?php $aksi->rupiah($sum['bayar']); ?></td>
												</tr>
											</tfoot>
										</table>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
<!-- INI END LAPORAN RIWAYAT PENGGUNAAN -->
				
			</div>
		</div>
	</div>
</body>
</html>