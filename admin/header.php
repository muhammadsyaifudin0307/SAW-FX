<?php
session_start();
include "../asset/conn/config.php";
include "../asset/conn/cek.php";

$query = "SELECT * FROM tbl_akun WHERE id_akun ='$_SESSION[id_akun]'";
$stm = $conn->query($query);
$row = $stm->fetch_assoc();
?>


















<!Doctype html>
<html lang="en">

<head>
	<title>SAW</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="../asset/img/spk-icon.png" sizes="16x16" type="image/png">


	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../asset/sidebar/css/style.css">
</head>

<body>
	<style>
		.user-icon-container {
			display: flex;
			flex-direction: column;
			align-items: center;
			margin: 20px;
		}

		.user-icon {
			width: 50px;
			height: 50px;
			background-color: #fff;
			border-radius: 50%;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 25px;
			color: #555;
		}

		.user-text {
			margin-top: 10px;
			font-size: 20px;
			text-align: center;
		}

		.logo {
			text-align: center;
			display: block;
			margin: 0 auto;
		}

		h1 {
			text-align: center;

		}

		.logo span {
			display: block;
			font-size: 16px;
		}
	</style>
	<div class="wrapper d-flex align-items-stretch">
		<nav id="sidebar">
			<div class="custom-menu">
				<button type="button" id="sidebarCollapse" class="btn btn-primary">
					<i class="fa fa-bars"></i>
					<span class="sr-only">Toggle Menu</span>
				</button>
			</div>
			<div class="p-4">
				<h1><a href="index.php" class="logo">SPK <span>SISTEM PENDUKUNG KEPUTUSAN SAW</span>
					</a></h1>

				<ul class="list-unstyled components mb-5">
					<li>
						<a href="index.php" class="font-weight-bolder"><span class="fa fa-home mr-3"></span> Dashboard</a>
					</li>
					<li>
						<a id="dataDropdown" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle font-weight-bolder">
							<span class="fa fa-database mr-3"></span> Data
						</a>
						<ul class="collapse list-unstyled" id="dataSubmenu">
							<li>
								<a href="alternatif.php" class="font-weight-bolder"><span class="fa fa-user mr-3"></span> Alternatif</a>
							</li>
							<li>
								<a href="kriteria.php" class="font-weight-bolder"><span class="fa fa-briefcase mr-3"></span> Kriteria</a>
							</li>
							<li>
								<a href="nilai.php" class="font-weight-bolder"><span class="fa fa-sticky-note mr-3"></span> Nilai</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="metode.php" class="font-weight-bolder"><span class="fa fa-table mr-3"></span> Metode</a>
					</li>
					<li>
						<a href="rank.php" class="font-weight-bolder"><span class="fa fa-trophy mr-3"></span> Rank</a>
					</li>
					<li>
						<a href="logout.php" class="font-weight-bolder"><span class="fa fa-sign-out mr-3"></span> LogOut</a>
					</li>
				</ul>

				<!-- Add this script to handle the dropdown toggle -->
				<script>
					document.getElementById('dataDropdown').addEventListener('click', function() {
						var submenu = document.getElementById('dataSubmenu');
						submenu.classList.toggle('collapse');
					});
				</script>





			</div>
		</nav>

		<!-- Page Content  -->
		<div id="content" class="p-4 p-md-5 pt-5">



			<script src="../asset/sidebar/js/jquery.min.js"></script>
			<script src="../asset/sidebar/js/popper.js"></script>
			<script src="../asset/sidebar/js/bootstrap.min.js"></script>
			<script src="../asset/sidebar/js/main.js"></script>
</body>

</html>