<br> <br>
<?php
include '../config/koneksi.php';
include '../library/fungsi.php';

session_start();
date_default_timezone_set("Asia/Jakarta");

$aksi = new oop();
if (empty($_SESSION['username_teller'])) {
	$aksi->alert("Harap Login Dulu !!!", "login.php");
}

if (isset($_GET['logout'])) {
	unset($_SESSION['username_teller']);
	unset($_SESSION['id_teller']);
	unset($_SESSION['nama_teller']);
	unset($_SESSION['biaya_admin']);
	unset($_SESSION['aksi_teller']);
	$aksi->alert("logout Berhasil !!!", "login.php");
}

?>
<!DOCTYPE html>
<html>

<head>
	<title>PPOB LISTRIK</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<style type="text/css">
		.navbar-collapse {
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
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" id="?transaksi">
									<strong style="color: black;font-family: Myriad Pro Light">TRANSAKSI</strong>&nbsp;
									<span class="caret" style="color: black"></span>
								</a>
								<ul class="dropdown-menu" aria-labelledbay="?menu=transaksi">
									<li>
										<a href="?menu=history">
											<strong style="color: black;font-family: Myriad Pro Light">HISTORY PEMBAYARAN</strong>
										</a>
									</li>
									<li>
										<a href="?menu=pembayaran">
											<strong style="color: black;font-family: Myriad Pro Light">KELOLA PEMBAYARAN</strong>
										</a>
									</li>
								</ul>
							</li>

							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" id="?menu=laporan">
									<strong style="color: black;font-family: Myriad Pro Light">LAPORAN</strong>&nbsp;
									<span class="caret" style="color: black"></span>
								</a>
								<ul class="dropdown-menu" arai-labelledby="laporan">
									<li>
										<a href="?menu=laporan">
											<strong style="color: black;font-family: Myriad Pro Light">LAPORAN PEMBAYARAN</strong>
										</a>
									</li>
								</ul>
							</li>
						</ul>

						<ul class="nav navbar-nav navbar-right" style="margin-right: 50px;">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" id="akun">
									<strong style="color: black;font-family: Myriad Pro Light"><?php echo $_SESSION['nama_teller']; ?></strong>&nbsp;
									<span class="caret" style="color: black"></span>
								</a>
								<ul class="dropdown-menu" aria-labelledby="akun">
									<li>
										<a href="?menu=akun">
											<strong style="color: black;font-family: Myriad Pro Light">AKUN</strong>
										</a>
									</li>
									<li>
										<a href="?logout" onclick="return conf">
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
		case 'history':
			echo "<br> <br>";
			include 'history.php';
			break;
		case 'pembayaran':
			echo "<br> <br>";
			include 'pembayaran.php';
			break;
		case 'laporan':
			echo "<br> <br>";
			include 'laporan.php';
			break;
		case 'akun':
			echo "<br> <br>";
			include 'akun.php';
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

	<script type="text/javascript">
		$("#tbayar").keyup(function() {
			var totalakhir = parseInt($("#ttotalakhir").val());
			var bayar = parseInt($("#tbayar").val());
			var kembalian = 0;
			if (bayar < totalakhir) {
				kembalian = "";
			};
			if (bayar > totalakhir) {
				kembalian = bayar - totalakhir;
			};
			$("#tkembalian").val(kembalian);
		});
	</script>
</body>

</html>