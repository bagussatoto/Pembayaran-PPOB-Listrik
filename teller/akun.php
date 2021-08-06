<?php  
	if (!isset($_GET['menu'])) {
	 	header('location:hal_utama.php?menu=profil');
	}

	$teller = $aksi->caridata("teller WHERE id_teller = '$_SESSION[id_teller]'");
	$field = array(
		'username'=>@$_POST['username'],
		'password'=>@$_POST['password'],
		'nama'=>@$_POST['nama'],
		'alamat'=>@$_POST['alamat'],
		'no_telepon'=>@$_POST['no'],
		'biaya_admin'=>@$_POST['admin'],
	);

	@$cek_user = $aksi->cekdata("teller WHERE username = '$_POST[username]' AND username != '$_SESSION[username_teller]'");
	if (isset($_POST['ubah'])) {
		if($cek_user > 0){
			$aksi->pesan("username sudah ada !!!");
		}else{
			$aksi->update("teller",$field,"id_teller = '$_SESSION[id_teller]'");
			$aksi->alert("Data Berhasil diubah","?menu=profil");
			$_SESSION['nama_teller']=@$_POST['nama'];
			$_SESSION['username_teller']=@$_POST['username'];
			$_SESSION['biaya_admin']=@$_POST['admin'];
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>PROFIL</title>
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
										<label>ID TELLER</label>
										<input type="text" name="id" class="form-control" value="<?php echo $teller['id_teller'] ?>" readonly>
									</div>
									<div class="form-group">
										<label>USERNAME</label>
										<input type="text" name="username" class="form-control" value="<?php echo $teller['username'] ?>" required placeholder="Masukan username Anda" maxlength="30"> 
									</div>
									<div class="form-group">
										<label>PASSWORD</label>
										<input type="password" name="password" class="form-control" value="<?php echo $teller['password'] ?>" required placeholder="Masukan password Anda" maxlength="30"> 
									</div>
									<div class="form-group">
										<label>BIAYA ADMIN</label>
										<input type="text" name="admin"  class="form-control" value="<?php echo $teller['biaya_admin']; ?>" placeholder="Masukan Biaya Admin" required onkeypress="return event.charCode >=48 && event.charCode <= 57" maxlength="5">
									</div>
									<div class="form-group">
										<label>AKSI</label>
										<input type="text" name="aksi" class="form-control" value="<?php echo $teller['aksi'] ?>" required readonly> 
									</div>
									<div class="form-group">
										<label>NAMA</label>
										<input type="text" name="nama" class="form-control" value="<?php echo $teller['nama'] ?>" required placeholder="Masukan nama Anda" maxlength="50"> 
									</div>
									<div class="form-group">
										<label>ALAMAT</label>
										<textarea class="form-control" name="alamat" rows="3" required><?php echo $teller['alamat']; ?></textarea>
									</div>
									<div class="form-group">
										<label>NOMOR TELEPON</label>
										<input type="text" name="no" class="form-control" value="<?php echo $teller['no_telp']; ?>" required placeholder="Masukan No.Telepon Anda" onkeypress="return event.charCode >=48 && event.charCode <= 57" maxlength="15">
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