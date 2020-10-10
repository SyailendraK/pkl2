<?php require_once('tgl.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Rencana</title>
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
		* {
			-webkit-print-color-adjust: exact !important;
		}

		body {
			font-family: Arial, Helvetica, sans-serif;
			font-size: 1rem !important;
			overflow-x: hidden !important;
			/* margin-top: 20px; */
			/* margin-top: 10px; */
		}

		.A5 {
			/* height: 375mm; */
			height: 100%;
			overflow-y: hidden !important;
			overflow-x: hidden !important;

		}

		.font-judul {
			font-size: 1.2rem;
			font-family: Arial, Helvetica, sans-serif !important;
		}

		.tables {
			width: 100%;
			text-align: center;
			font-size: 0.9rem;
			font-weight: normal;
		}

	</style>
</head>

<body>

	<div class="A5 mx-3">
		<div class="row">
			<div class="col-sm-12 text-center font-judul">
				<b><u>RENCANA/REALISASI PENYALURAN KE PANGKALAN LPG 3 KG</u></b>
			</div>
		</div>
		<br>
		<div class="row" style="line-height: 100%;">
			<div class="col-sm-6">
				<p class="mb-0">Kepada Yth :</p>
				<?php if($data[0]['pt'] == 'GAP'): ?>
				<p class="mb-0">Manajer SP(P)BE PT. SPEKTRA</p>
				<p class="mb-0">Jalan Cemerlang</p>
				<p>Kota Sukabumi</p>
				<?php else: ?>
				<p class="mb-0">Manajer SP(P)BE PT. LADANG NANAS</p>
				<p class="mb-0">Jalan Perbawati Desa Warnasari Kec. Sukabumi</p>
				<p>Kabupaten Sukabumi</p>
				<?php endif; ?>

				<p>Dengan Hormat,</p>
			</div>
		</div>

		<div class="row" style="line-height: 100%;">
			<div class="col-sm-7">
				<p class="mb-0">Agar dilakukan pengisian LPG 3 KG :</p>
				<p class="mb-0">Loading Order (LO) Nomor : <?= $data[0]['loading_order'] ?></p>
				<p>Truck Nomor Polisi : <?= $data[0]['nomor_polisi'] ?></p>
			</div>

			<div class="col-sm-5 pl-4">
				<br>
				<p class="mb-0">Tanggal pembelian (GI) : <?= tgl($data[0]['tanggal']); ?></p>
				<p>untuk disalurkan kepada pangkalan sbb : </p>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<table class="tables" border="1">
					<tr style="line-height: 0.7cm;">
						<td>NO.</td>
						<td>NAMA PANGKALAN</td>
						<td>ALAMAT PANGKALAN</td>
						<td>JUMLAH<br>(TABUNG)</td>
						<td>NOMOR FAKTUR</td>
					</tr>
					<?php $i=1;foreach($data[1] as $v => $val):?>
					<tr style="line-height: 0.8cm;">
						<td><?= $i; ?></td>
						<td><?= $val['nama_pangkalan'] ?></td>
						<td><?= $val['alamat'] ?></td>
						<td><?= $val['jumlah'] ?></td>
						<td><?= $val['nomor_faktur'] ?></td>
					</tr>
					<?php $i++; endforeach; ?>

					<?php for($x = 1; $x <= 9-$i; $x++): ?>
					<tr style="line-height: 0.8cm; color: white;">
						<td>A</td>
						<td>A</td>
						<td>A</td>
						<td>A</td>
						<td>A</td>
					</tr>
					<?php endfor; ?>
				</table>
			</div>
		</div>

		<div class="row mt-3 mr-2">
			<div class="col-sm-8"></div>
			<div class="col-sm-4 text-center">
				<p class="mb-0">Sukabumi, <?= tgl($data[0]['tanggal']); ?></p>
				<?php if($data[0]['pt'] == 'GAP'): ?>
				<p class="mb-5">PT. GAS ALAM PUTRA</p>
				<?php else: ?>
				<p class="mb-5">PT. NOOR AL HAYED</p>
				<?php endif; ?>
				<b><u>H. YEDI NURHAYADI</u></b>
			</div>
		</div>
	</div>
</body>
<script>
	window.print();

</script>

</html>
