<?php  
	if (!isset($_GET['menu'])) {
		header("location:hal_utama.php?menu=teller");
	}

	$table ="teller";
	$id = @$_GET['id'];
	$where = "md5(sha1(id_teller)) = '$id'";
	$redirect = "?menu=teller";

	//autocode
	$today = date("Ymd");
	$teller = $aksi->caridata("teller WHERE id_teller LIKE '%$today%' ORDER BY id_teller DESC");
	if (empty($teller)) {
		$id_teller="T".$today."001";
	}else{
		$kode = substr($teller['id_teller'], 9,3)+1;
		$id_teller = sprintf("T".$today.'%03s',$kode);
	}

	// cek username
	@$cek_user = $aksi->cekdata("teller WHERE username = '$_POST[username]'");
	$field = array(
		'id_teller'=>@$_POST['id'],
		'username'=>@$_POST['username'],
		'password'=>@$_POST['password'],
		'aksi'=>@$_POST['aksi'],
		'nama'=>@$_POST['nama'],
		'alamat'=>@$_POST['alamat'],
		'no_telp'=>@$_POST['no'],
		'aksi'=>"teller",
		'biaya_admin'=>@$_POST['admin'],
	);

	$field_ubah = array(
		'username'=>@$_POST['username'],
		'password'=>@$_POST['password'],
		'nama'=>@$_POST['nama'],
		'alamat'=>@$_POST['alamat'],
		'no_telp'=>@$_POST['no'],
		'biaya_admin'=>@$_POST['admin'],
	);
	//crud
	if (isset($_POST['simpan'])) {
		if ($cek_user > 0) {
			$aksi->pesan("username sudah ada !!!");
		}else{
			$aksi->simpan($table,$field);
			$aksi->alert("Data berhasil disimpan",$redirect);
		}
	}


	if (isset($_GET['edit'])) {
		$edit = $aksi->edit($table,$where);
	}

	if (isset($_POST['ubah'])) {
		if ($cek_user > 0) {
			$aksi->pesan("username sudah ada !!!");
		}else{
			$aksi->update($table,$field_ubah,$where);
			$aksi->alert("Data berhasil diubah",$redirect);
		}
	}

	if (isset($_GET['hapus'])) {
		$aksi->hapus($table,$where);
		$aksi->alert("Data berhasil dihapus",$redirect);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>teller</title>
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
				<div class="col-md-3">
					<div class="panel panel-default">
						<div class="panel-heading">
							<?php 
								if (@$_GET['id']=="") {
									echo "INPUT DATA TELLER";
								}else{
									echo "UBAH TELLER";
								} 
							?>
						</div>
						<div class="panel-body">
							<div class="col-md-12">
								<form method="post">
									<div class="form-group">
										<label>ID TELLER</label>
										<input type="text" name="id" class="form-control" value="<?php if(@$_GET['id']==""){echo @$id_teller; }else{ echo $edit['id_teller'];} ?>" readonly required>
									</div>
									<div class="form-group">
										<label>USERNAME</label>
										<input type="text" name="username" class="form-control" value="<?php echo @$edit['username'] ?>" required placeholder="Masukkan Username " maxlength="30"> 
									</div>
									<div class="form-group">
										<label>PASSWORD</label>
										<input type="password" name="password" class="form-control" value="<?php echo @$edit['password'] ?>" required placeholder="Masukkan Password " maxlength="30"> 
									</div>
									<div class="form-group">
										<label>BIAYA ADMIN</label>
										<input type="text" name="admin"  class="form-control" value="<?php echo @$edit['biaya_admin']; ?>" placeholder="Masukkan Biaya" required onkeypress="return event.charCode >=48 && event.charCode <= 57" maxlength="5">
									</div>
									<div class="form-group">
										<label>NAMA</label>
										<input type="text" name="nama" class="form-control" value="<?php echo @$edit['nama'] ?>" required placeholder="Masukkan Nama " maxlength="50"> 
									</div>
									<div class="form-group">
										<label>ALAMAT</label>
										<textarea class="form-control" name="alamat" rows="3" required><?php echo @$edit['alamat']; ?></textarea>
									</div>
									<div class="form-group">
										<label>NOMOR TELEPON</label>
										<input type="text" name="no" class="form-control" value="<?php echo @$edit['no_telp']; ?>" required placeholder="Masukkan No.Telepon" onkeypress="return event.charCode >=48 && event.charCode <= 57" maxlength="15">
									</div>
									<div class="form-group">
										<?php 
										if (@$_GET['id']=="") {?>
											<input type="submit" name="simpan" class="btn btn-primary btn-block btn-lg" value="SIMPAN" style="background: #9e6bff;">
										 <?php }else{?>
											<input type="submit" name="ubah" class="btn btn-success btn-block btn-lg" value="UBAH" style="background: #00cc4c;">
										 <?php } ?>
										<a href="?menu=teller" class="btn btn-danger btn-lg btn-block" style="background: #ff693b;">RESET</a>
									</div>
								</form>
							</div>
						</div>
						<div class="panel-footer">&nbsp;</div>
					</div>
				</div>
				<div class="col-md-9">
					<div class="panel panel-default">
						<div class="panel-heading">DAFTAR TELLER</div>
						<div class="panel-body">
							<div class="col-md-12">
								<?php  
									if (isset($_POST['bcari'])) {
										@$text = $_POST['tcari'];
										@$cari = "WHERE id_teller LIKE '%$text%' OR nama LIKE '%$text%' OR alamat LIKE '%$text%' OR no_telp LIKE '%$text%' OR biaya_admin LIKE '%$text%' OR username LIKE '%$text%'";
									}else{
										$cari = "";
									}
								?>
								<form method="post">
									<div class="input-group">
										<input type="text" name="tcari" class="form-control" value="<?php echo @$text; ?>" placeholder="Masukkan Kata Kunci Pencarian...">
										<div class="input-group-btn">
											<button type="submit" name="bcari" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>&nbsp;</button>
											<button type="submit" name="refresh" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span>&nbsp;</button>
										</div>
									</div>
								</form>
							</div>
							<div class="col-md-12">
								<div class="table-responsive">
									<table class="table table-bordered table-striped table-hover">
										<thead>
											<th>No.</th>
											<th>ID Teller</th>
											<th>Nama</th>
											<th>Nomor Telepon</th>
											<th>Alamat</th>
											<th>Biaya<br>Admin</th>
											<th>Username</th>
											<th>Password</th>
											<th>Status</th>
											<th colspan="2">Aksi</th>
										</thead>
										<tbody>
											<?php  
												$no = 0;
												$a = $aksi->tampil($table,$cari,"ORDER BY id_teller DESC");
												if ($a=="") {
													$aksi->no_record(11);
												}else{
													foreach ($a as $r) {
														$cek = $aksi->cekdata(" pembayaran WHERE id_teller = '$r[id_teller]'");
														$no++;
												?>
												<tr>
													<td align="center"><?php echo $no; ?>.</td>
													<td><?php echo $r['id_teller']; ?></td>
													<td><?php echo $r['nama']; ?></td>
													<td><?php echo $r['no_telp']; ?></td>
													<td><?php echo $r['alamat']; ?></td>
													<td><?php $aksi->rupiah($r['biaya_admin']); ?></td>
													<td><?php echo $r['username']; ?></td>
													<td><?php echo substr(($r['password']), 0,10); ?></td>
													<td><?php echo $r['aksi']; ?></td>
													<?php  
														if ($cek == 0) { ?>
															<td align="center">
																<a href="?menu=teller&hapus&id=<?php echo md5(sha1($r['id_teller'])); ?>" onclick="return confirm('Yakin Akan hapus data ini ?')">
																	<span class="glyphicon glyphicon-trash"></span>
																</a>
															</td>
													<?php }else{ ?>
														<td>&nbsp;</td>
													<?php } ?>
													<td align="center">
														<a href="?menu=teller&edit&id=<?php echo md5(sha1($r['id_teller'])); ?>">
																<span class="glyphicon glyphicon-edit"></span>
														</a>
													</td>
												</tr>

										<?php	} } ?>
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
	</div>
</body>
</html>