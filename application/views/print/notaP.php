<?php require_once('tgl.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Nota</title>
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
			font-size: 1rem;
		}

		/* @page {
			size: A4;
			margin: 0;
		}

		@media print {

			html,
			body {
				width: 210mm;
				height: 297mm;
			}

		} */

		.A6 {
			padding-top: 5% !important;
			width: 13cm;
			/* height: 18.2cm; */
			height: 19.7cm;

			border: 1px black;
			border-width: 2px;
			border-color: black;
			border-style: solid;
			font-family: Arial, Helvetica, sans-serif;
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
			padding-left: 3cm;
		}

		.jarak-0 {
			margin-bottom: 0%;
			padding-bottom: 0.2cm;
		}

		.img {
			width: 2.4cm;
			height: 1.5cm;
		}

		.img2 {
			width: 60%;
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
			/* width: 100%; */
			/* padding-left: -3cm; */
			margin-left: -3cm;
			font-size: 0.7rem;
		}

		.tables {
			min-width: 100%;
			/* border-left: none !important;
			border-right: none !important; */
		}

		.font-table {
			font-size: 0.7rem;
		}

		.lebar-table {
			margin-left: 0.8cm;
			margin-right: 1cm;
		}

		.border-tabel-kiri {
			border-right: 1px solid black;
			border-top: 1px solid black;
			border-bottom: 1px solid black;
		}

		.border-tabel-kanan {
			border-bottom: 1px solid black;
			border-top: 1px solid black;
			border-left: 1px solid black;
		}

		.border-tabel-bawah-kanan {
			border: 1px solid black;
			border-right: none;
		}

		.white {
			color: white;
		}

	</style>
</head>

<body>
	<div class="row pt-3" <?php if($margin != null){
		print_r('style="margin-top: ').$margin.'cm;"';
	} ?>>
		<div class="col-sm-6 pr-1">
			<div class="A6 ml-1 mt-1">
				<div class="row pt-2cm mx-0">
					<div class="col-sm-6 text-center pr-0" style="margin-top: -0.5cm;">
						<?php if($data[0]['pt'] == 'GAP'): ?>
						<img class="img2" src="<?= base_url() ?>assets/images/GAP_logo.png" alt="logo"><br>
						<b style="font-size: 1rem;">PT. GAS ALAM PUTRA</b><br>
						<b class="bg-black py-1 px-4 mx-0" style="font-size: 0.6rem;">AGEN GAS LPG 3 KG PERTAMINA</b>
						<p class="text-center pt-1 mb-1" style="font-size: 0.71rem;">Gg.Manggis I No. 1 RT.01
							RW.02<br>Telp.(0266)7044378 Sukabumi 43112 <br> Gudang : Bbk. Limus Nunggal
							<br> RT.09 RW.05 Sukabumi</p>
						<?php else: ?>
						<img class="img" src="<?= base_url() ?>assets/images/noah2.png" alt="logo"
							style="margin-top: -10%;"><br>
						<b style="font-size: 1rem;">PT. NOOR AL HAYED</b><br>
						<b class="bg-black py-1 px-4 mx-0" style="font-size: 0.6rem;">AGEN GAS LPG 3 KG PERTAMINA</b>
						<p class="text-center pt-1 mb-1" style="font-size: 0.71rem;">Jl. Babakan RT.01/01 <br> Desa
							Babakan Kec.
							Cisaat
							<br> Kabupaten Sukabumi <br> Telpon/Fax. : 0266-232627</p>
						<?php endif; ?>
						<b class="nota-no">NOTA NO. <?= $data[0]['nomor_nota'] ?></b>
					</div>
					<div class="col-sm-6" style="font-size: 0.8rem;">
						<p class="pb-0_8">Smi, <?= tgl($data[0]['tanggal']); ?></p>
						<p class="jarak-0">Kepada Yth. :</p>
						<p class="jarak-0"><?= $kepada1 ?></p>
						<p class="jarak-0"></p>
						<br>
						<u class="tab jarak-0">SUKABUMI</u>
					</div>
				</div>
				<div class="row lebar-table text-center pt-1">
					<table class="tables">
						<tr style="font-size: 0.9rem;">
							<td style="width: 7%;" class="border-tabel-kiri">Banyak<br>nya</td>
							<td class="border-tabel-kanan">Nama Barang</td>
							<td class="border-tabel-kanan">Harga</td>
							<td class="border-tabel-kanan">Jumlah</td>
						</tr>
						<tr class="font-table">
							<td class="border-tabel-kiri"><?= $data[0]['jumlah'] ?></td>
							<td class="border-tabel-kanan"><?= $data[0]['nama_barang'] ?></td>
							<td class="border-tabel-kanan"><?= number_format($data[0]['harga']); ?></td>
							<td class="border-tabel-kanan">
								<?= 'Rp.'. number_format(intval($data[0]['jumlah'])*$data[0]['harga']) ?></td>
						</tr>
						<?php for($i=0;$i<14;$i++) :?>
						<tr class="font-table">
							<td class="border-tabel-kiri white">AA</td>
							<td class="border-tabel-kanan white">AA</td>
							<td class="border-tabel-kanan white">AA</td>
							<td class="border-tabel-kanan white">AA</td>
						</tr>
						<?php endfor ?>
						<tr class="font-table">
							<td colspan="3" style="text-align: right;" class="border-tabel-bawah-kiri"><b>JUMLAH Rp.</b>
							</td>
							<td style="border-bottom: 1px solid black;font-size: 0.9rem;"
								class="border-tabel-bawah-kanan">
								<?= number_format(intval($data[0]['jumlah'])*$data[0]['harga']) ?>
							</td>
						</tr>
					</table>
				</div>

				<div class="row lebar-table" style="font-size: 0.8rem;">
					<div class="col-sm-12">
						<p class="pl-4 mb-0 pt-1">Tanda Terima.</p>
						<br>
						<p style="text-align: right;">Hormat kami.</p>
					</div>

				</div>
			</div>
		</div>
		<div class="col-sm-6 pl-0">
			<div class="A6 ml-1 mt-1">
				<div class="row pt-2cm mx-0">
					<div class="col-sm-6 text-center pr-0" style="margin-top: -0.5cm;">
						<?php if($data[1]['pt'] == 'GAP'): ?>

						<img class="img2" src="<?= base_url() ?>assets/images/GAP_logo.png" alt="logo"><br>
						<b style="font-size: 1rem;">PT. GAS ALAM PUTRA</b><br>
						<b class="bg-black py-1 px-4 mx-0" style="font-size: 0.6rem;">AGEN GAS LPG 3 KG PERTAMINA</b>
						<p class="text-center pt-1 mb-1" style="font-size: 0.71rem;">Gg.Manggis I No. 1 RT.01
							RW.02<br>Telp.(0266)7044378 Sukabumi 43112 <br> Gudang : Bbk. Limus Nunggal
							<br> RT.09 RW.05 Sukabumi</p>
						<?php else: ?>
						<img class="img" src="<?= base_url() ?>assets/images/noah2.png" alt="logo"
							style="margin-top: -10%;"><br>
						<b style="font-size: 1rem;">PT. NOOR AL HAYED</b><br>
						<b class="bg-black py-1 px-4 mx-0">AGEN GAS LPG 3 KG PERTAMINA</b>
						<p class="text-center pt-1 mb-1" style="font-size: 0.71rem;">Jl. Babakan RT.01/01 <br> Desa
							Babakan Kec.
							Cisaat
							<br> Kabupaten Sukabumi <br> Telpon/Fax. : 0266-232627</p>
						<?php endif; ?>
						<b class="nota-no">NOTA NO. <?= $data[1]['nomor_nota'] ?></b>
					</div>
					<div class="col-sm-6 " style="font-size: 0.8rem;">
						<p class="pb-0_8">Smi, <?= tgl($data[1]['tanggal']); ?></p>
						<p class="jarak-0">Kepada Yth. :</p>
						<p class="jarak-0"><?= sanitize_text_field($kepada2) ?></p>
						<p class="jarak-0"></p>
						<br>
						<u class="tab jarak-0">SUKABUMI</u>
					</div>
				</div>
				<div class="row lebar-table text-center pt-1">
					<table class="tables">
						<tr style="font-size: 0.9rem;">
							<td style="width: 7%;" class="border-tabel-kiri">Banyak<br>nya</td>
							<td class="border-tabel-kanan">Nama Barang</td>
							<td class="border-tabel-kanan">Harga</td>
							<td class="border-tabel-kanan">Jumlah</td>
						</tr>
						<tr class="font-table">
							<td class="border-tabel-kiri"><?= $data[1]['jumlah'] ?></td>
							<td class="border-tabel-kanan"><?= $data[1]['nama_barang'] ?></td>
							<td class="border-tabel-kanan"><?= number_format($data[1]['harga']) ?></td>
							<td class="border-tabel-kanan">
								<?= 'Rp.'. number_format(intval($data[1]['jumlah'])*$data[1]['harga']) ?></td>
						</tr>
						<?php for($i=0;$i<14;$i++) :?>
						<tr class="font-table">
							<td class="border-tabel-kiri white">AA</td>
							<td class="border-tabel-kanan white">AA</td>
							<td class="border-tabel-kanan white">AA</td>
							<td class="border-tabel-kanan white">AA</td>
						</tr>
						<?php endfor ?>
						<tr class="font-table">
							<td colspan="3" style="text-align: right;" class="border-tabel-bawah-kiri"><b>JUMLAH Rp.</b>
							</td>
							<td style="border-bottom: 1px solid black;font-size: 0.9rem;"
								class="border-tabel-bawah-kanan">
								<?= number_format(intval($data[1]['jumlah'])*$data[1]['harga']); ?>
							</td>
						</tr>
					</table>
				</div>

				<div class="row lebar-table" style="font-size: 0.8rem;">
					<div class="col-sm-12">
						<p class="pl-4 mb-0 pt-1">Tanda Terima.</p>
						<br>
						<p style="text-align: right;">Hormat kami.</p>
					</div>

				</div>
			</div>
		</div>
	</div>

	</div>


</body>
<script>
	window.print();

</script>

</html>
