<!-- End Navbar -->
<div class="panel-header panel-header-sm">
	<!-- <canvas id="bigDashboardChart"></canvas> -->
</div>
<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card" style="border-radius: 20px !important;">
				<div class="card-header">
					<h3 class="text-center">Tambah Akun</h3>
				</div>
				<div class="card-body pt-0">
					<!-- <a href="Printf/nota" target="_blank"
									class="btn btn-success d-flex justify-content-center mx-auto wide-full">buat</a> -->
					<button type="button" class="btn btn-primary  wide-full" data-toggle="modal" data-target="#tambah">
						<h5 class="mb-0">Buat akun</h5>
					</button>

					<!-- <button class="btn btn-success d-flex justify-content-center mx-auto wide-full">Buat</button> -->
				</div>
				<?= $this->session->flashdata('notif') ?>
			</div>
		</div>


		<!-- Modal -->
		<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="tambahLabel"
			aria-hidden="true">
			<div class="modal-dialog" role="document" style="font-size: 1.2rem;">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="tambahLabel">Form Tambah Akun</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="<?= base_url(); ?>MAkun/tambahAkun/<?= $this->uri->segment(3) ?>" method="POST">
						<div class="modal-body">
							<div class="form-group">
								<label for="username">Username :</label>
								<input type="text" class="form-control" id="username" placeholder="*Username"
									name="username" required>
							</div>
							<div class="form-group">
								<label for="pass">Password :</label>
								<input type="password" class="form-control" id="pass" placeholder="*Password"
									name="pass" required>
							</div>
							<div class="form-group">
								<label for="pass2">Verifikasi Password :</label>
								<input type="password" class="form-control" id="pass2"
									placeholder="*Masukan ulang password" name="pass2" required>
							</div>

							<div class="form-group">
								<label for="level">Level :</label>
								<select class="custom-select" id="level" name="level" required>
									<option value="1">Administrasi</option>
									<option value="2">Manager</option>
								</select>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Buat</button>
						</div>
					</form>
				</div>
			</div>
			<!-- end modal -->
		</div>
	</div>
	<?php if($tambah != null): ?>
	<div class="row">
		<div class="col-md-12">
			<div class="card" style="border-radius: 20px !important;">
				<div class="card-header">
					<h5 class="text-center">Daftar Akun</h5>
				</div>
				<table class="table table-hover text-center">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Username</th>
							<th scope="col">Level</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1+$page;foreach($tambah as $t => $val): ?>
						<tr>
							<td><?= $i ?></td>
							<td><?= $val['username'] ?></td>
							<td><?php 
							if($val['level'] == 1){
								echo 'Administrasi';
							}else{
								echo 'Manager';
							}
							$id = $val['id'];
							?></td>
							<td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#update"
									onclick="javascript:view_input_post_tambah('<?= $id ?>')">
									Update
								</button>
								<a <?php if($id == "ia-Z4gDs8HJb6" || $id == "ia-F4rW1c67x5" || $_SESSION['id'] == $id){
									echo 'class="btn btn-secondary" href="#"';
								}else{
									echo 'class="btn btn-danger" href="'.base_url().'MAkun/hapusAkun/'.$id.'/'.$this->uri->segment(3).'"';
								}?> onclick="return confirm('Ingin menghapus akun nomor <?= $i ?> ?');">Hapus</a></td>
						</tr>
						<?php $i++; endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
		<?php else: ?>
		<div class="row">
			<div class="col-md-12 d-flex justify-content-center mx-auto">
				<h3 style="color: gray;">Data tidak ditemukan</h3>
			</div>
		</div>
		<?php endif; ?>
		<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="updateLabel"
			aria-hidden="true">
			<div class="modal-dialog" role="document" style="font-size: 1.2rem;">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="updateLabel">Form Perbarui Akun</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="<?= base_url(); ?>MAkun/updateAkun/<?= $this->uri->segment(3) ?>" method="POST">
						<div class="modal-body" id="updateModel">
							<input type="hidden" value="" name="idU">
							<div class="form-group">
								<label for="username">Username :</label>
								<input type="text" class="form-control" id="usernameU" placeholder="*Dikirim Username"
									name="usernameU" required>
							</div>
							<div class="form-group">
								<label for="pass">Password :</label>
								<input type="password" class="form-control" id="passU" placeholder="*Password"
									name="passU" required>
							</div>
							<div class="form-group">
								<label for="pass2">Verifikasi Password :</label>
								<input type="password" class="form-control" id="pass2U"
									placeholder="*Masukan ulang password" name="pass2U" required>
							</div>
							<?php if($_SESSION['id'] != "ia-Z4gDs8HJb6" && $_SESSION['id'] != "ia-F4rW1c67x5"):?>
							<div class="form-group">
								<label for="level">Level :</label>
								<select class="custom-select" id="levelU" name="levelU" required>
									<option value="1">Administrasi</option>
									<option value="2">Manager</option>
								</select>
							</div>
							<?php endif; ?>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
							<button type="submit" class="btn btn-primary">Update</button>
						</div>
					</form>
				</div>
			</div>
			<!-- end modal -->
		</div>
		<?= $this->pagination->create_links(); ?>

	</div>

</div>
