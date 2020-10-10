<?php 
	function tgl($tgl){
		$bulan = explode("-",$tgl); 
		if($bulan[1] == '01'){
			$bulan[1] = "Januari";
		}elseif ($bulan[1] == '02'){
			$bulan[1] = "Februari";
		}elseif ($bulan[1] == '03'){
			$bulan[1] = "Maret";
		}elseif ($bulan[1] == '04'){
			$bulan[1] = "April";
		}elseif ($bulan[1] == '05'){
			$bulan[1] = "Mei";
		}elseif ($bulan[1] == '06'){
			$bulan[1] = "Juni";
		}elseif ($bulan[1] == '07'){
			$bulan[1] = "Juli";
		}elseif ($bulan[1] == '08'){
			$bulan[1] = "Agustus";
		}elseif ($bulan[1] == '09'){
			$bulan[1] = "September";
		}elseif ($bulan[1] == '10'){
			$bulan[1] = "Oktober";
		}elseif ($bulan[1] == '11'){
			$bulan[1] = "November";
		}elseif ($bulan[1] == '12'){
			$bulan[1] = "Desember";
		}
		return $bulan[2]."-".$bulan[1]."-".$bulan[0];
	}

	function hari(){
		$hari = date("w");
		if($hari == 0){
			echo "Minggu";
		}elseif($hari == 1){
			echo "Senin";
		}elseif($hari == 2){
			echo "Selasa";
		}elseif($hari == 3){
			echo "Rabu";
		}elseif($hari == 4){
			echo "Kamis";
		}elseif($hari == 5){
			echo "Jum'at";
		}elseif($hari == 6){
			echo "Sabtu";
		}
	}

	function hello(){
		$h = explode(':',date("H:i:s"))[0]+6;
		// var_dump($h);die;
		if($h >= 0 && $h < 10){
			echo "Selamat pagi";
		}elseif($h >= 10 && $h < 15){
			echo "Selamat siang";
		}elseif($h >= 15 && $h < 19){
			echo "Selamat sore";
		}else{
			echo "Selamat malam";
		}
	}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="<?= base_url() ?>assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>
		<?= $judul; ?>
	</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
		name='viewport' />
	<!--     Fonts and icons     -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
		integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<!-- CSS Files -->
	<link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?= base_url() ?>assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link href="<?= base_url() ?>assets/demo/demo.css" rel="stylesheet" />

	<style>
		body {
			font-size: 1.2rem;
		}

		.wide-full {
			min-width: 100% !important;
			min-height: 100% !important;
		}

		.btn-primary {
			background-color: #0069d9 !important;
		}

		.form-check-input {
			visibility: visible !important;
			opacity: 1 !important;
		}

		input[type=checkbox] {
			transform: scale(1.5);
			margin-left: -15px;
			margin-top: 7px;
		}

		.modal {
			font-size: 1.1rem;
		}


		.custom-pagination {
			margin-top: 10px;
			text-align: center;
		}

		.custom-pagination a {
			background: #DEDEDE;
			color: #444;
			padding: 7px;
			transition: 0.5s;
		}

		.custom-pagination a:hover {
			background: #999;
			color: #FFF;
			padding: 9px;
			text-decoration: none;
		}

		.custom-pagination strong {
			background: #444;
			color: #FFF;
			padding: 7px;
		}

		input::-webkit-outer-spin-button,
		input::-webkit-inner-spin-button {
			-webkit-appearance: none;
			margin: 0;
		}

		/* Firefox */
		input[type=number] {
			-moz-appearance: textfield;
		}

	</style>
</head>

<body class="" onload="startTime()">
	<div class="wrapper ">
		<div class="sidebar" data-color="blue">
			<!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
			<div class="logo">
				<a href="#" class="simple-text logo-mini">
					PT.
				</a>
				<a href="#" class="simple-text logo-normal">
					Gas Alam Putra
				</a>
			</div>
			<div class="sidebar-wrapper" id="sidebar-wrapper">
				<ul class="nav">
					<li class="pil <?php
						if($this->uri->segment(1) == 'MDashboard'){
							echo "active";
						}	
					?>">
						<a href="<?= base_url(); ?>MDashboard/index">
							<i class="now-ui-icons design_app"></i>
							<p>Dashboard</p>
						</a>
					</li>
					<li class="pil <?php
						if($this->uri->segment(1) == 'MAkun'){
							echo "active";
						}	
					?>">
						<a href="<?= base_url(); ?>MAkun/index/0">
							<i class="now-ui-icons education_atom"></i>
							<p>Tambah akun</p>
						</a>
					</li>
					<li class="pil <?php
						if($this->uri->segment(1) == 'MPangkalan'){
							echo "active";
						}	
					?>">
						<a href="<?= base_url(); ?>MPangkalan/index/0">
							<i class="now-ui-icons education_atom"></i>
							<p>Tambah pangkalan</p>
						</a>
					</li>
					<li class="pil <?php
						if($this->uri->segment(1) == 'MDefault'){
							echo "active";
						}	
					?>">
						<a href="<?= base_url(); ?>MDefault/index/0">
							<i class="now-ui-icons education_atom"></i>
							<p>Edit default</p>
						</a>
					</li>
					<!-- <li class="active-pro pl-3 mb-5 pb-2">
						<button class="btn"
							style="border-radius: 20px;background-color: white;color: #F96332;font-size: 0.9rem;width: 90%;"
							type="button" data-toggle="modal" data-target="#list">
							<b>List print
								<?php if(isset($list)): ?>
								<span class="pl-2 pr-2 pt-1 pb-1"
									style="background-color: red;color: white;border-radius: 100%;;"><?php
                                
                                    echo sizeof($list); 
                                
                            ?></span>
								<?php endif; ?></b>
						</button>
					</li>
					<li class="active-pro pl-3">
						<button onclick="launchFullScreen();" class="btn"
							style="border-radius: 20px;background-color: white;color: #F96332;font-size: 0.9rem;width: 90%;">
							<b>Fullscreen</b>
						</button>
					</li> -->
				</ul>
			</div>
		</div>
		<div class="main-panel" id="main-panel">
			<!-- Navbar -->
			<nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
				<div class="container-fluid">
					<div class="navbar-wrapper">
						<div class="navbar-toggle">
							<button type="button" class="navbar-toggler">
								<span class="navbar-toggler-bar bar1"></span>
								<span class="navbar-toggler-bar bar2"></span>
								<span class="navbar-toggler-bar bar3"></span>
							</button>
						</div>
						<a class="navbar-brand" href="#pablo"><?= hari(); ?> | <?= tgl(date('Y-m-d')); ?> | <span
								id="timestamp2"> <?= date("H:i:s") ?> </span></a>
						<!-- [tambah loading pas submit refreash] -->
					</div>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
						aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-bar navbar-kebab"></span>
						<span class="navbar-toggler-bar navbar-kebab"></span>
						<span class="navbar-toggler-bar navbar-kebab"></span>
					</button>
					<div class="collapse navbar-collapse justify-content-end" id="navigation">
						<?php if($this->uri->segment(1) == "MAkun"): ?>
						<form action="<?= base_url() ?>/MAkun/search" method="GET">
							<div class="input-group no-border">
								<input type="text" value="" class="form-control" placeholder="Pencarian akun"
									id="search" name="search">
								<div class="input-group-append">
									<button class="input-group-text" type="submit">
										<i class="now-ui-icons ui-1_zoom-bold"></i>
									</button>
								</div>
							</div>
						</form>
						<?php elseif($this->uri->segment(1) == "MPangkalan"): ?>
						<form action="<?= base_url() ?>/MPangkalan/search" method="GET">
							<div class="input-group no-border">
								<input type="text" value="" class="form-control" placeholder="Pencarian pangkalan"
									id="search" name="search">
								<div class="input-group-append">
									<button class="input-group-text" type="submit">
										<i class="now-ui-icons ui-1_zoom-bold"></i>
									</button>
								</div>
							</div>
						</form>
						<?php endif; ?>
						<ul class="navbar-nav">
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
									aria-haspopup="true" aria-expanded="false">
									<i class="now-ui-icons users_single-02"></i>
									<p>
										<span class="d-lg-none d-md-block">Some Actions</span>
									</p>
								</a>
								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
									<a class="dropdown-item" href="<?= base_url(); ?>Auth/logout"
										style="color: #F96332;"><b>Logout</b></a>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</nav>

			<div class="modal fade" id="list" tabindex="-1" role="dialog" aria-labelledby="listLabel"
				aria-hidden="true">
				<div class="modal-dialog" role="document" style="font-size: 1.2rem;">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="listLabel">List Print(<span style="color: red;"><?php
                                            if(isset($list)){
                                                echo sizeof($list); 
                                            }
                                        ?></span>)
							</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

						<form action="<?= base_url(); ?>Nota/submit" method="POST">
							<div class="modal-body">
								<table style="width: 100%;" class="text-center">

									<?php if(isset($list)): ?>
									<tr>
										<th>Jenis</th>
										<!-- <th>pangkalan</th> -->
										<th>tanggal</th>
										<th>hapus</th>
									</tr>
									<?php 
                                        foreach($list as $n => $val): 
                                        ?>

									<tr>
										<td><?php  
												$temp = explode("-",$val[0]['id']);
												// var_dump($_SESSION['print']);
                                                if($temp[0] == "rc"){
                                                    echo "Rencana";
                                                }elseif ($temp[0] == "nt"){
													echo "Nota";
												}elseif ($temp[0] == "jl"){
													echo "Jalan";
												}elseif ($temp[0] == "ps"){
													echo "Pesanan";
												}
                                            ?></td>
										<td><?= tgl($val[0]['tanggal']); ?></td>
										<td><a href="<?php
									echo base_url(). "CHeader/hapusPrint/".$val[0]['id']."~".$this->uri->segment(1);
								?>" class="btn btn-danger" style="color: white;">Hapus</a></td>
									</tr>
									<?php endforeach;
                                        else: ?>
									<p>Daftar print kosong, silahkan menambahkan data</p>

									<?php endif; ?>
								</table>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<a type="submit" class="btn btn-primary" href="<?php
									if($this->session->userdata("print") != null){
										echo base_url()."Printf/printAll";
									}else{
										echo "#";
									}
									?>">Print</a>
							</div>
						</form>
					</div>
				</div>
				<!-- end modal -->
			</div>
