<div class="panel-header panel-header-sm">
	<!-- <canvas id="bigDashboardChart"></canvas> -->
</div>
<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card" style="border-radius: 20px !important;">
				<div class="card-header">
					<h3 class="text-center wide-full">Profile</h3>
					<?= $this->session->flashdata('notif') ?>
				</div>
				<div class="card-body pt-0">
					<div class="row">
						<div class="col-md-4"></div>
						<div class="col-md-4">
							<form action="<?= base_url() ?>CHeader/updateProfile" method="POST">
								<div class="form-group">
									<label for="keterangan">Username :</label>
									<input type="text" class="form-control" id="Username" placeholder="*Username"
										name="username" value="<?= $profile['username'] ?>" required>
								</div>
								<div class="form-group">
									<label for="passLama">Password lama :</label>
									<input type="password" class="form-control" id="passLama" placeholder="*Password lama"
										name="passLama" required>
                                </div>
                                <div class="form-group">
									<label for="pass">Password baru :</label>
									<input type="password" class="form-control" id="pass" placeholder="*Password baru"
										name="pass" required>
                                </div>
                                <div class="form-group">
									<label for="pass2">Konfirmasi password :</label>
									<input type="password" class="form-control" id="pass2" placeholder="*Ulang password baru"
										name="pass2" required>
								</div>
								<button type="submit" class="btn btn-primary">Perbarui</button>
							</form>
						</div>
						<div class="col-md-4"></div>
					</div>
				</div>
			</div>
		</div>
