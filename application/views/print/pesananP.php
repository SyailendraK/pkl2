<?php require_once('tgl.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Pesanan</title>
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
			font-family: Tahoma, Helvetica, sans-serif;
			font-size: 1.15rem;
			/* overflow-y: hidden; */
		}

		.A5 {
			height: 101% !important;
			border: 1px solid black;
			padding-top: 0.7%;
		}

		.font-judul {
			font-family: "Forte", Arial, sans;
			font-size: 1.25rem;
		}

		.tables {
			width: 100%;
			text-align: center;
			font-size: 1.1rem;
		}

		.p-9 {
			font-size: 1rem;
		}

		.p-11 {
			font-size: 1.1rem;
		}

		.tables {
			font-weight: bold;
			text-align: center;
			width: 100%;
		}

		.border-tabel-top-kiri {
			border-top: 1px solid black;
			border-right: 1px solid black;
			border-bottom: 1px solid black;
		}

		.border-tabel-top-kanan {
			border-top: 1px solid black;
			border-left: 1px solid black;
			border-bottom: 1px solid black;
		}

		.border-tabel-kiri {
			border-right: 1px solid black;
			border-bottom: 1px solid black;
		}

		.border-tabel-kanan {
			border-bottom: 1px solid black;
			border-left: 1px solid black;
		}

		.border-tabel-bawah-kanan {
			border: 1px solid black;
			border-right: none;
		}

		.up {
			font-size: 1.1rem;
		}

		.white {
			color: rgba(255, 255, 255, 0);
		}

	</style>
</head>

<body>
	<div class="A5 mx-2 mb-2" style="margin-top: <?= $pad ?>% !important;">
		<div class="row px-1">
			<div class="col-sm-8">
				<?php if($data['pt'] == 'NOAH'): ?>
				<b class="font-judul" style="color: blue;">PT. N<b style="color: red;">OO</b>R AL HAYED</b>
				<br>
				<b class="p-11 up">AGEN GAS LPG 3 KG</b>
				<p class="mb-0 up">Jl. Babakan RT. 001/001 Desa Babakan Kec. Cisaat</p>
				<p class="mb-0 up">Kabupaten Sukabumi</p>
				<p class="mb-0 up">Telpon/Fax&nbsp;&nbsp; : &nbsp;&nbsp;(0266) 6247040</p>
				<p class="mb-0 up">Sukabumi 43152</p>
				<?php else: ?>
				<img src="<?= base_url() ?>assets/images/GAP_logo_warna.png" alt="logo" width="250" height="40"><br>
				<b class="p-11 up">KANTOR DAN GUDANG AGEN GAS LPG 3 KG</b>
				<p class="mb-0 up">Jl. Babakan Limusnunggal No. 8 RT. 01/06 Limusnunggal Cibeureum</p>
				<p class="mb-0 up">Telpon &nbsp;&nbsp; : &nbsp;&nbsp;(0266) 232627</p>
				<p class="mb-0 up">Faxmile&nbsp;&nbsp; : &nbsp;&nbsp;(0266) 232627</p>
				<p class="mb-0 up">Sukabumi 43165</p>
				<?php endif; ?>
			</div>
			<div class="col-sm-4">
				<b class="font-judul">NO. : </b><b><?= $data['nomor_pesanan']; ?></b>
				<br><br>
				<p class="p-9 mb-0 white">Gudang :</p>
				<p class="p-9 mb-0 white">Kp. Babakan Desa Babakan Kec. Cisaat</p>
				<p class="p-9 mb-0 white">Kab. Sukabumi</p>

			</div>
		</div>

		<div class="row px-1">
			<div class="col-sm-12 text-center">
				<b style="font-size: 1.4rem;"><u>SURAT PESANAN</u></b>
			</div>
		</div>

		<div class="row px-1">
			<?php if($data['pt'] == 'NOAH'): ?>
			<div class="col-sm-8">
				<p class="mb-0">KODE LANGGANAN&emsp;: <b><u>841078 / 841909</u></b></p>
				<p class="mb-0">DEPOT SERAH&emsp;&emsp;&emsp;: <b><u>LADANG NANAS MAS</u></b></p>
				<P class="MB-0">NO. DO&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;: <b><u><?= $data['nomor_do'] ?></u></b>
				</p>
			</div>
			<div class="col-sm-4">
				<p class="mb-0">NO. SA&emsp;&emsp;&emsp;&emsp;: <b><u><?= $data['nomor_sa'] ?></u></b></p>
				<p class="mb-0">KODE PLANT&emsp; : <b><u>G28V</u></b></p>
			</div>
			<?php else: ?>
			<div class="col-sm-8">
				<p class="mb-0">KODE LANGGANAN&emsp;: <b><u>766818&nbsp; 831174</u></b></p>
				<p class="mb-0">DEPOT SERAH&emsp;&emsp;&emsp;: <b><u>SPEKTRA ENERGY</u></b></p>
				<P class="MB-0">NO. DO&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;: <b><u><?= $data['nomor_do'] ?></u></b>
				</p>
			</div>
			<div class="col-sm-4">
				<p class="mb-0">NO. SA&emsp;&emsp;&emsp;&emsp;: <b><u><?= $data['nomor_sa'] ?></u></b></p>
				<p class="mb-0">KODE PLANT&emsp; : <b><u>G28J</u></b></p>
			</div>
			<?php endif; ?>

		</div>

		<div class="row">
			<div class="col-sm-12">
				<table class="tables">
					<tr>
						<td class="border-tabel-top-kiri">KODE MATERIAL</td>
						<td class="border-tabel-top-kiri">TRIP / DO</td>
						<td class="border-tabel-top-kiri">KWANTITAS</td>
						<td class="border-tabel-top-kiri">SATUAN</td>
						<td class="border-tabel-top-kiri">TANGGAL<br>KIRIM</td>
						<td class="border-tabel-top-kiri">SLOC/SPPDE</td>
						<td class="border-tabel-top-kanan">HARGA FAKTUR</td>
					</tr>
					<tr>
						<td class="border-tabel-kiri white">AAAAAAA</td>
						<td class="border-tabel-kiri white">AAAAAAA</td>
						<td class="border-tabel-kiri white">AAAAAAA</td>
						<td class="border-tabel-kiri white">AAAAAAA</td>
						<td class="border-tabel-kiri white">AAAAAAA</td>
						<td class="border-tabel-kiri white">AAAAAAA</td>
						<td class="border-tabel-kanan white">AAAAAAA</td>
					</tr>
					<tr>
						<td class="border-tabel-kiri">8708551005</td>
						<td class="border-tabel-kiri"></td>
						<td class="border-tabel-kiri"></td>
						<td class="border-tabel-kiri">PCS</td>
						<td class="border-tabel-kiri"></td>
						<td class="border-tabel-kiri">LCCN</td>
						<td class="border-tabel-kanan" style="text-align: left;">Rp.</td>
					</tr>
					<tr>
						<td class="border-tabel-kiri white">AAAAAAA</td>
						<td class="border-tabel-kiri white">AAAAAAA</td>
						<td class="border-tabel-kiri white">AAAAAAA</td>
						<td class="border-tabel-kiri white">AAAAAAA</td>
						<td class="border-tabel-kiri white">AAAAAAA</td>
						<td class="border-tabel-kiri white">AAAAAAA</td>
						<td class="border-tabel-kanan white">AAAAAAA</td>
					</tr>
					<tr>
						<td class="border-tabel-kiri">870857003</td>
						<td class="border-tabel-kiri"><?= $data['trip'] ?></td>
						<td class="border-tabel-kiri"><?= 560 * $data['trip'] ?></td>
						<td class="border-tabel-kiri">B03</td>
						<td class="border-tabel-kiri"><?= tglNumber($data['tanggal']); ?></td>
						<td class="border-tabel-kiri">LCCN</td>
						<td class="border-tabel-kanan" style="text-align: left;">Rp.
							<?= number_format(intval($harga_faktur['harga_faktur']) * $data['trip'],0,".",".") ?></td>
					</tr>
					<tr>
						<td class="border-tabel-kiri white">AAAAAAA</td>
						<td class="border-tabel-kiri white">AAAAAAA</td>
						<td class="border-tabel-kiri white">AAAAAAA</td>
						<td class="border-tabel-kiri white">AAAAAAA</td>
						<td class="border-tabel-kiri white">AAAAAAA</td>
						<td class="border-tabel-kiri white">AAAAAAA</td>
						<td class="border-tabel-kanan white">AAAAAAA</td>
					</tr>
					<tr>
						<td class="border-tabel-kiri white">AAAAAAA</td>
						<td class="border-tabel-kiri white">AAAAAAA</td>
						<td class="border-tabel-kiri white">AAAAAAA</td>
						<td class="border-tabel-kiri white">AAAAAAA</td>
						<td class="border-tabel-kiri white">AAAAAAA</td>
						<td class="border-tabel-kiri">PPH</td>
						<td class="border-tabel-kanan" style="text-align: left;">Rp.
							<?= number_format($harga_faktur['pph'],0,".","."); ?></td>
					</tr>

					<tr>
						<td colspan="6" style="background-color: #bbb;" class="border-tabel-kiri">JUMLAH YANG
							HARUS
							DIBAYAR</td>
						<td class="border-tabel-kanan" style="text-align: left;">Rp.
							<?= number_format(intval($harga_faktur['harga_faktur']) * $data['trip'] + intval($harga_faktur['pph']),0,".",".") ?>
						</td>
					</tr>
				</table>
			</div>
		</div>

		<div class="row px1 mt-3">
			<div class="col-sm-8">

			</div>
			<div class="col-sm-4 text-center">
				<p class="mb-0">Sukabumi, <?= tgl($data['tanggal']) ?></p>
				<?php if($data['pt'] == 'NOAH'): ?>
				<p class="mb-2"><b>PT. NOOR AL HAYED</b></p>
				<?php else: ?>
				<p class="mb-2"><b>PT. GAS ALAM PUTRA</b></p>
				<?php endif; ?>
				<br>
				<p class="mb-0"><b><u>H. YEDI NURHAYADI</u></b></p>
			</div>
		</div>
	</div>
</body>
<script>
	window.print();

</script>

</html>
