<?php  
	if (!isset($_GET['menu'])) {
		header("location:hal_utama.php?menu=manager");
	}

	$table ="manager";
	$id = @$_GET['id'];
	$where = "md5(sha1(id_manager)) = '$id'";
	$redirect = "?menu=manager";

	//autocode
	$today = date("Ymd");
	$manager = $aksi->caridata("manager WHERE id_manager LIKE '%$today%' ORDER BY id_manager DESC");
	$kode = substr($manager['id_manager'], 9,3)+1;
	$id_manager = sprintf("P".$today.'%03s',$kode);

	// cek username
	@$cek_user = $aksi->cekdata("manager WHERE username = '$_POST[username]'");
	$field = array(
		'id_manager'=>@$_POST['id'],
		'username'=>@$_POST['username'],
		'password'=>@$_POST['password'],
		'aksi'=>@$_POST['aksi'],
		'nama_mgr'=>@$_POST['nama_mgr'],
		'alamat_mgr'=>@$_POST['alamat_mgr'],
		'no_telp'=>@$_POST['no'],
		'aksi'=>"manager",
		'gender'=>@$_POST['gender'],
	);

	$field_ubah = array(
		'username'=>@$_POST['username'],
		'password'=>@$_POST['password'],
		'nama_mgr'=>@$_POST['nama_mgr'],
		'alamat_mgr'=>@$_POST['alamat_mgr'],
		'no_telp'=>@$_POST['no'],
		'gender'=>@$_POST['gender'],
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
		@$cek_user = $aksi->cekdata("manager WHERE username = '$_POST[username]' AND username != '$edit[username]'");
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
	<title>manager</title>
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
									echo "INPUT DATA MANAGER";
								}else{
									echo "UBAH MANAGER";
								} 
							?>
						</div>
						<div class="panel-body" >
							<div class="col-md-12">
								<form method="post">
									<div class="form-group">
										<label>ID MANAGER</label>
										<input type="text" name="id" class="form-control" value="<?php if(@$_GET['id']==""){echo @$id_manager; }else{ echo $edit['id_manager'];} ?>" readonly required>
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
										<label>JENIS KELAMIN</label>
										<select name="gender" class="form-control" required>
											<option value="L" <?php if(@$edit['gender']=="L"){echo "selected";} ?>>Laki-Laki</option>
											<option value="P" <?php if(@$edit['gender']=="P"){echo "selected";} ?>>Perempuan</option>
										</select>
									</div>
									<div class="form-group">
										<label>NAMA MANAGER</label>
										<input type="text" name="nama_mgr" class="form-control" value="<?php echo @$edit['nama_mgr'] ?>" required placeholder="Masukkan Nama " maxlength="50"> 
									</div>
									<div class="form-group">
										<label>ALAMAT MANAGER</label>
										<textarea class="form-control" name="alamat_mgr" rows="3" required><?php echo @$edit['alamat_mgr']; ?></textarea>
									</div>
									<div class="form-group">
										<label>NO.TELEPON</label>
										<input type="text" name="no" class="form-control" value="<?php echo @$edit['no_telp']; ?>" required placeholder="Masukkan No.Telepon " onkeypress="return event.charCode >=48 && event.charCode <= 57" maxlength="15">
									</div>
									<div class="form-group">
										<label>FOTO</label>
										<input type="file" name="foto" class="form-control">
									</div>
									<div class="form-group">
										<?php 
										if (@$_GET['id']=="") {?>
											<input type="submit" name="simpan" class="btn btn-primary btn-block btn-lg" value="SIMPAN" style="background: #9e6bff;">
										 <?php }else{?>
											<input type="submit" name="ubah" class="btn btn-success btn-block btn-lg" value="UBAH" style="background: #00cc4c;">
										 <?php } ?>
										<a href="?menu=manager" class="btn btn-danger btn-lg btn-block" style="background: #ff693b;">RESET</a>
									</div>
								</form>
							</div>
						</div>
						<div class="panel-footer">&nbsp;</div>
					</div>
				</div>
				<div class="col-md-9">
					<div class="panel panel-default">
						<div class="panel-heading">DAFTAR MANAGER</div>
						<div class="panel-body">
							<div class="col-md-12">
								<?php  
									if (isset($_POST['bcari'])) {
										@$text = $_POST['tcari'];
										@$cari = "WHERE id_manager LIKE '%$text%' OR nama_mgr LIKE '%$text%' OR alamat_mgr LIKE '%$text%' OR no_telp LIKE '%$text%' OR gender LIKE '%$text%' OR username LIKE '%$text%'";
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
											<th>ID Manager</th>
											<th>Nama</th>
											<th>No.Telepon</th>
											<th>Alamat</th>
											<th>Gender</th>
											<th>Username</th>
											<th>Password</th>
											<th>Status</th>
											<th colspan="2">Aksi</th>
										</thead>
										<tbody>
											<?php  
												$no = 0;
												$a = $aksi->tampil($table,$cari,"ORDER BY id_manager DESC");
												if ($a=="") {
													$aksi->no_record(11);
												}else{
													foreach ($a as $r) {
														$cek = $aksi->cekdata(" penggunaan WHERE id_manager = '$r[id_manager]'");
														if($r['id_manager']!=$_SESSION['id_manager']){
															$no++;

												?>

												<tr>
													<td align="center"><?php echo $no; ?>.</td>
													<td><?php echo $r['id_manager']; ?></td>
													<td><?php echo $r['nama_mgr']; ?></td>
													<td><?php echo $r['no_telp']; ?></td>
													<td><?php echo $r['alamat_mgr']; ?></td>
													<td><?php if($r['gender']=="L"){echo "Laki-Laki";}else{echo "Perempuan";} ?></td>
													<td><?php echo $r['username']; ?></td>
													<td><?php echo substr(($r['password']), 0,10); ?></td>
													<td><?php echo $r['aksi']; ?></td>
													<?php  
														if ($cek == 0) { ?>
															<td align="center">
																<a href="?menu=manager&hapus&id=<?php echo md5(sha1($r['id_manager'])); ?>" onclick="return confirm('Yakin Akan hapus data ini ?')">
																	<span class="glyphicon glyphicon-trash"></span>
																</a>
															</td>
													<?php }else{ ?>
														<td>&nbsp;</td>
													<?php } ?>
													<td align="center">
														<a href="?menu=manager&edit&id=<?php echo md5(sha1($r['id_manager'])); ?>">
																<span class="glyphicon glyphicon-edit"></span>
														</a>
													</td>
												</tr>

										<?php	} } } ?>
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