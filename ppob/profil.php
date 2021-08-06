<?php  
	if (!isset($_GET['menu'])) {
	 	header('location:menu_utama.php?menu=profil');
	}

	$manager = $aksi->caridata("manager WHERE id_manager = '$_SESSION[id_manager]'");
	$field = array(
		'username'=>@$_POST['username'],
		'password'=>@$_POST['password'],
		'nama_mgr'=>@$_POST['nama_mgr'],
		'alamat_mgr'=>@$_POST['alamat_mgr'],
		'no_telp'=>@$_POST['no'],
		'gender'=>@$_POST['gender'],
	);
	
	@$cek_user = $aksi->cekdata("manager WHERE username = '$_POST[username]' AND username != '$_SESSION[username_manager]'");
	if (isset($_POST['ubah'])) {
		if ($cek_user > 0) {
			$aksi->pesan("username sudah ada !!!");
		}else{
			$aksi->update("manager",$field,"id_manager = '$_SESSION[id_manager]'");
			$aksi->alert("Data Berhasil diubah","?menu=profil");
			$_SESSION['nama_mgr']=@$_POST['nama_mgr'];
			$_SESSION['username_manager']=@$_POST['username'];
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>AKUN</title>
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
	<div class="container" style="color: black;font-family: Myriad Pro Light">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<div class="panel panel-default">
						<div class="panel-heading"><center><h4>UBAH DATA DIRI ANDA</h4></center></div>
						<div class="panel-body">
							<div class="col-md-12">
								<form method="post">
									<div class="form-group">
										<label>ID MANAGER</label>
										<input type="text" name="id" class="form-control" value="<?php echo $manager['id_manager'] ?>" readonly>
									</div>
									<div class="form-group">
										<label>USERNAME</label>
										<input type="text" name="username" class="form-control" value="<?php echo $manager['username'] ?>" required placeholder="Masukan username Anda"> 
									</div>
									<div class="form-group">
										<label>PASSWORD</label>
										<input type="password" name="password" class="form-control" value="<?php echo $manager['password'] ?>" required placeholder="Masukan password Anda"> 
									</div>
									<div class="form-group">
										<label>AKSI</label>
										<input type="text" name="aksi" class="form-control" value="<?php echo $manager['aksi'] ?>" required readonly> 
									</div>
									<div class="form-group">
										<label>NAMA MANAGER</label>
										<input type="text" name="nama_mgr" class="form-control" value="<?php echo $manager['nama_mgr'] ?>" required placeholder="Masukan nama_mgr Anda"> 
									</div>
									<div class="form-group">
										<label>JENIS KELAMIN</label>
										<select name="gender" class="form-control" required>
											<option value="L" <?php if($manager['gender']=="L"){ echo "selected"; } ?>>Laki-Laki</option>
											<option value="P" <?php if($manager['gender']=="P"){ echo "selected"; } ?>>Perempuan</option>
										</select>
									</div>
									<div class="form-group">
										<label>ALAMAT MANAGER</label>
										<textarea class="form-control" name="alamat_mgr" rows="3" required><?php echo $manager['alamat_mgr']; ?></textarea>
									</div>
									<div class="form-group">
										<label>NOMOR TELEPON</label>
										<input type="text" name="no" class="form-control" value="<?php echo $manager['no_telp']; ?>" required placeholder="Masukan No.Telepon Anda" onkeypress="return event.charCode >=48 && event.charCode <= 57">
									</div>
									<div class="form-group">
										<input type="submit" name="ubah" class="btn btn-primary btn-block btn-lg" value="UBAH DATA" style="background: #9e6bff;">
									</div>
								</form>
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