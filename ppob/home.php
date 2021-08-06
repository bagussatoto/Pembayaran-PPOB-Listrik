<br>
<?php
if (!isset($_GET['menu'])) {
	header('location:menu_utama.php?menu=home');
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>HOME</title>
</head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<style type="text/css">
	.middle {
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		text-align: center;
	}
</style>

<body>
	<div style="color: black;font-family: Myriad Pro Light">
		<img src="../images/main.jpg" width="100%" style="margin-top: -50px">
		<div class="middle" style="color: white;font-size: 80px">
			<h1>PPOB LISTRIK</h1>

			<hr>
			<p>PAYMENT POINT ONLINE BEST</p>
		</div>
	</div>
</body>

</html>