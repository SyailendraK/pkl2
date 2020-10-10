<?php require_once('tgl.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title></title>
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
		/* @media print {
			@page {
				size: landscape
			}
		} */

		body {
			font-size: 1rem;
			font-family: Arial, Helvetica, sans-serif;
			/* transform: rotate(90deg); */
		}

		.A6-landscape {
			margin-top: 0.3%;
			margin-bottom: 1.5%;
			overflow: hidden;
			width: 99%;
			height: 100%;
			border: 1px black;
			border-width: 2px;
			border-color: black;
			border-style: solid;
			/* background-color: rgb(238, 76, 165); */
		}

		.pt-2cm {
			padding-top: 2cm;
		}

		.pb-0_8 {
			margin-bottom: 0%;
			padding-bottom: 1cm;
		}

		.tab {
			padding-left: 1.2cm;
		}

		.jarak-0 {
			margin-bottom: 0%;
			padding-bottom: 0.2cm;
		}

		.img {
			width: 2.4cm;
			height: 1.5cm;
		}

		.bg-black {
			background-color: black;
			color: white;
			font-size: 0.5rem;
			min-width: 100%;
		}

		.dotted {
			/* border-bottom: 1px dotted #000;
			text-decoration: none; */
			text-decoration-line: underline;
			text-decoration-style: dotted;
		}

		.nota-no {
			text-align: left !important;
			padding-left: -1cm;
			margin-left: -1cm;
			font-size: 0.7rem;
		}

		.tables {
			min-width: 100%;
			/* border-left: none !important;
			border-right: none !important; */
		}

		.font-table {
			font-size: 0.8rem;
		}

		.lebar-table {
			margin-left: 1cm;
			margin-right: 1cm;
		}

		.border-tabel-kiri {
			border-right: 1px solid black;
			border-top: 1px solid black;
			border-bottom: 1px solid black;
			border-left: 1px solid black;
		}

		.border-tabel-kanan {
			border-bottom: 1px solid black;
			border-top: 1px solid black;
			border-left: 1px solid black;
			border-right: 1px solid black;
		}

		.border-tabel-bawah-kanan {
			border: 1px solid black;
			/* border-right: none; */
		}

	</style>
</head>

<body>
	<div class="A6-landscape ml-1">
		<div class="row pt-3 ml-1 mb-0 pb-0">
			<?php if($data['pt'] == 'NOAH'): ?>
			<div class="col-sm-3 text-center mt-1">
				<img src="<?= base_url() ?>assets/images/noah.png" alt="logo" width="160" class="mt-3 pt-2 ml-3">
			</div>
			<div class="col-sm-7 pl-1 mb-0" style="text-align: center;">
				<p style="font-size: 1.2rem;" class="mb-0"><b>PT. NOOR AL HAYED</b></p>
				<p style="font-size: 1rem;" class="mb-0"><b>AGEN GAS LPG 3 KG</b></p>
				<p style="font-size: 0.8rem;" class="mb-0">Jl. Babakan RT. 001/001 Desa Babakan Kec. Cisaat Kab.
					Sukabumi</p>
				<p style="font-size: 0.8rem;" class="mb-0"><u>Telepon/Fax : (0266) 6247040</u></p>
			</div>
			<div class="col-sm-1 mb-0"></div>
			<?php else: ?>
			<div class="col-sm-2 text-center mt-1">
				<img src="<?= base_url() ?>assets/images/GAP_logo.png" alt="logo" width="200" class="mt-3 pt-2 ml-3">
			</div>
			<div class="col-sm-9 pl-1 mb-0" style="text-align: center;">
				<p style="font-size: 1.2rem;" class="mb-0"><b>PT. GAS ALAM PUTRA</b></p>
				<p style="font-size: 1rem;" class="mb-0"><b>AGEN GAS LPG 3 KG</b></p>
				<p style="font-size: 0.8rem;" class="mb-0">Jl. Babakan Limusnunggal No. 8 Rt. 01/06 Kel. Limusnunggal
					Kec. Cibeureum Kota Sukabumi</p>
				<p style="font-size: 0.8rem;" class="mb-0"><u>(Telepon/Fax) : (0266) 232627</u></p>
			</div>
			<div class="col-sm-1 mb-0"></div>
			<?php endif; ?>
		</div>

		<div style="font-size: 0.8rem;" class="row ml-4 mt-0 pt-0">
			<div class="col-sm-8">
				<p class="mb-0">Surat Jalan Nomor&emsp;: <?= $data['nomor_jalan'] ?></p>
				<p>Nomor Kendaraan&emsp; : <?= $nopol['nomor_polisi'] ?></p>
				<p class="mb-0">Bersama ini kami kirimkan barang-barang sebagai berikut :</p mb>
			</div>
			<div class="col-sm-4">
				<p class="mb-0">Sukabumi, <?= tgl($data['tanggal']); ?></p>
				<p class="mb-0">Kepada Yth : </p>
				<p><?= $data['kepada'] ?></p>
			</div>
		</div>

		<div class="row lebar-table text-center pt-1">

			<table class="tables">
				<tr style="font-size: 0.8rem;">
					<th style="width: 7%;" class="border-tabel-kiri">Nomor</th>
					<th class="border-tabel-kanan">Jumlah</th>
					<th class="border-tabel-kanan">Nama Barang</th>
					<th class="border-tabel-kanan">Keterangan</th>
				</tr>
				<?php for($i=1;$i<=6;$i++) :?>
				<tr class="font-table">
					<td class="border-tabel-kiri"><?= $i; ?></td>
					<td class="border-tabel-kanan"><?php if($i == 2){
						echo $data['jumlah'];
					} ?></td>
					<td class="border-tabel-kanan"><?php if($i == 2){
						echo "LPG 3 kg";
					} ?></td>
					<td class="border-tabel-kanan"><?php if($i == 2){
						echo $data['keterangan'];
					} ?></td>
				</tr>
				<?php endfor ?>
				<br>
				<!-- <tr class="font-table">
					<td colspan="3" style="text-align: right;" class="border-tabel-bawah-kiri"><b>JUMLAH Rp.</b></td>
					<td style="border-bottom: 1px solid black;" class="border-tabel-bawah-kanan">
						<?= number_format($data['keterangan']); ?>
					</td>
				</tr> -->
			</table>
		</div>

		<div class="row lebar-table mt-4 pt-3 pb-0 mb-0" style="font-size: 0.8rem;text-align: center;">
			<div class="col-sm-4">
				<p class="mb-4">Penerima,</p>
				<p>(<?= $data['kepada'] ?>)</p>
			</div>
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<p class="mb-4">Pengemudi,</p>
				<p>(<?= $nopol['nama_pengirim']; ?>)</p>
			</div>
		</div>

		<!-- <link media="print" rel="Alternate" href="print.pdf"> -->
	</div>

</body>
<script>
	window.print();

</script>

</html>
