<div class="panel-header panel-header-sm">
	<!-- <canvas id="bigDashboardChart"></canvas> -->
</div>
<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card" style="border-radius: 20px !important;">
				<div class="card-header">
					<h3 class="text-center wide-full">Perbarui Nilai Default</h3>
					<?= $this->session->flashdata('notif') ?>
				</div>
				<div class="card-body pt-0">
					<div class="row">
						<div class="col-md-4"></div>
						<div class="col-md-4">
							<form action="<?= base_url() ?>MDefault/updateDefault" method="POST">
								<div class="form-group">
									<label for="harga">Harga :</label>
									<input type="number" class="form-control" id="harga" placeholder="*harga dafault"
										name="harga" value="<?= $default['harga'] ?>" required>
								</div>

								<div class="form-group">
									<label for="harga_faktur">Harga faktur :</label>
									<input type="number" class="form-control" id="harga_faktur"
										placeholder="*harga faktur dafault" name="harga_faktur"
										value="<?= $default['harga_faktur'] ?>" required>
								</div>

								<div class="form-group">
									<label for="pph">Pph :</label>
									<input type="number" class="form-control" id="pph" placeholder="*pph dafault"
										name="pph" value="<?= $default['pph'] ?>" required>
								</div>
								<div class="form-group">
									<label for="keterangan">keterangan :</label>
									<input type="text" class="form-control" id="keterangan" placeholder="*keterangan dafault"
										name="keterangan" value="<?= $default['keterangan'] ?>" required>
								</div>
								<div class="form-group">
									<label for="barang">barang :</label>
									<input type="text" class="form-control" id="barang" placeholder="*barang dafault"
										name="barang" value="<?= $default['barang'] ?>" required>
								</div>
								<button type="submit" class="btn btn-primary">Perbarui</button>
							</form>
						</div>
						<div class="col-md-4"></div>
					</div>
				</div>
			</div>
		</div>
