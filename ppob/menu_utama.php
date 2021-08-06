<br> <br> <br><br>
<?php
include '../config/koneksi.php';
include '../library/fungsi.php';

session_start();
date_default_timezone_set("Asia/Jakarta");

$aksi = new oop();
if (empty($_SESSION['username_manager'])) {
	$aksi->alert("Harap Login Dulu !!!", "login.php");
}

if (isset($_GET['logout'])) {
	unset($_SESSION['username_manager']);
	unset($_SESSION['id_manager']);
	unset($_SESSION['nama_manager']);
	unset($_SESSION['aksi_manager']);
	$aksi->alert("logout Berhasil !!!", "login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>PPOB LISTRIK</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<style type="text/css">
		.navbar-fixed-top {
			background-color: #6bcfff;
		}

		.footer {
			left: 0;
			bottom: 0;
			width: 100%;
			background-color: #6bcfff;
			color: white;
			text-align: center;
			margin-top: -40px;
			padding: 10px
		}
	</style>
</head>
<link rel="stylesheet" type="text/css" href="css/style.css">

<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="navbar navbar-fixed-top navbar-default">
					<div class="navbar-header">
						<a href="?home" class="navbar-brand">
							<p style="color: black;font-family: Myriad Pro Light">PT. ELECTRICITYPAY</p>
						</a>
					</div>
					<div class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" id="?kelola">
									<strong style="color: black;font-family: Myriad Pro Light">DATA UMUM</strong>&nbsp;
									<span class="caret" style="color: black"></span>
								</a>
								<ul class="dropdown-menu" aria-labelledby="?menu=kelola">
									<li>
										<a href="?menu=tarif"><strong style="color: black;font-family: Myriad Pro Light">PENGELOLAAN DATA TARIF</strong></a>
									</li>
									<li>
										<a href="?menu=pelanggan"><strong style="color: black;font-family: Myriad Pro Light">PENGELOLAAN DATA PELANGGAN</strong></a>
									</li>
									<li>
										<a href="?menu=teller"><strong style="color: black;font-family: Myriad Pro Light">PENGELOLAAN DATA TELLER</strong></a>
									</li>
									<li>
										<a href="?menu=manager"><strong style="color: black;font-family: Myriad Pro Light">PENGELOLAAN DATA MANAGER</strong></a>
									</li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" id="transaksi">
									<strong style="color: black;font-family: Myriad Pro Light">TRANSAKSI</strong>&nbsp;
									<span class="caret" style="color: black"></span>
								</a>
								<ul class="dropdown-menu" aria-labelledby="transaksi">
									<li>
										<a href="?menu=tagihan"><strong style="color: black;font-family: Myriad Pro Light">DAFTAR TAGIHAN PELANGGAN</strong></a>
									</li>
									<li>
										<a href="?menu=penggunaan"><strong style="color: black;font-family: Myriad Pro Light">PENGELOLAAN PENGGUNAAN</strong></a>
									</li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" id="laporan">
									<strong style="color: black;font-family: Myriad Pro Light">LAPORAN DATA</strong>&nbsp;
									<span class="caret" style="color: black"></span>
								</a>
								<ul class="dropdown-menu" aria-labelledby="laporan">
									<li>
										<a href="?menu=laporan&tarif"><strong style="color: black;font-family: Myriad Pro Light">LAPORAN DATA TARIF</strong></a>
									</li>
									<li>
										<a href="?menu=laporan&pelanggan"><strong style="color: black;font-family: Myriad Pro Light">LAPORAN DATA PELANGGAN</strong></a>
									</li>
									<li>
										<a href="?menu=laporan&teller"><strong style="color: black;font-family: Myriad Pro Light">LAPORAN DATA TELLER</strong></a>
									</li>
									<li>
										<div class="divider"></div>
									</li>
									<li>
										<a href="?menu=laporan&tagihan_bulan"><strong style="color: black;font-family: Myriad Pro Light">LAPORAN TAGIHAN PELANGGAN (PERBULAN)</strong></a>
									</li>
									<li>
										<a href="?menu=laporan&tunggakan"><strong style="color: black;font-family: Myriad Pro Light">LAPORAN TUNGGAKAN</strong></a>
									</li>
									<li>
										<a href="?menu=laporan&riwayat_penggunaan"><strong style="color: black;font-family: Myriad Pro Light">LAPORAN RIWAYAT PENGGUNAAN (PERTAHUN)</strong></a>
									</li>
								</ul>
							</li>
						</ul>

						<ul class="nav navbar-nav navbar-right" style="margin-right: 40px;">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" id="akun">
									<strong style="color: black;font-family: Myriad Pro Light"><?php echo $_SESSION['nama_manager']; ?></strong>&nbsp;
									<span class="caret" style="color: black"></span>
								</a>
								<ul class="dropdown-menu" aria-labelledby="akun">
									<li>
										<a href="?menu=profil">
											<strong style="color: black;font-family: Myriad Pro Light">AKUN</strong>
										</a>
									</li>
									<li>
										<a href="?logout" onclick="return confirm('Yakin akan keluar dari aplikasi ini ?')">
											<strong style="color: black;font-family: Myriad Pro Light">KELUAR</strong>
										</a>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	switch (@$_GET['menu']) {
		case 'home':
			include 'home.php';
			break;
		case 'tarif':
			include 'tarif.php';
			break;
		case 'pelanggan':
			include 'pelanggan.php';
			break;
		case 'manager':
			include 'manager.php';
			break;
		case 'teller':
			include 'teller.php';
			break;
		case 'penggunaan':
			include 'penggunaan.php';
			break;
		case 'tagihan':
			include 'tagihan.php';
			break;
		case 'laporan':
			include 'laporan.php';
			break;
		case 'profil':
			include 'profil.php';
			break;
		default:
			$aksi->redirect("?menu=home");
			break;
	}
	?>

	<br><br>
	<div class="footer">
		<p>
			<strong style="color: black;font-family: Myriad Pro Light">Copyright&nbsp;&copy;&nbsp;2021

		</p>
	</div>

	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/jquery-ui.min.js"></script>
</body>

</html>