<!-- End Navbar -->
<div class="panel-header panel-header-sm">
	<!-- <canvas id="bigDashboardChart"></canvas> -->
</div>
<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card" style="border-radius: 20px !important;">
				<div class="card-header">
					<h3 class="text-center">Tambah Pangkalan</h3>
				</div>
				<div class="card-body pt-0">
					<!-- <a href="Printf/nota" target="_blank"
									class="btn btn-success d-flex justify-content-center mx-auto wide-full">buat</a> -->
					<button type="button" class="btn btn-primary  wide-full" data-toggle="modal"
						data-target="#pangkalan">
						<h5 class="mb-0">Buat pangkalan</h5>
					</button>
					<!-- <button class="btn btn-success d-flex justify-content-center mx-auto wide-full">Buat</button> -->
				</div>
				<?= $this->session->flashdata('notif') ?>

			</div>
		</div>


		<!-- Modal -->
		<div class="modal fade" id="pangkalan" tabindex="-1" role="dialog" aria-labelledby="pangkalanLabel"
			aria-hidden="true">
			<div class="modal-dialog" role="document" style="font-size: 1.2rem;">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="pangkalanLabel">Form Tambah Pangkalan</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="<?= base_url(); ?>MPangkalan/tambahPangkalan/<?= $this->uri->segment(3) ?>"
						method="POST">
						<div class="modal-body">
							<div class="form-group">
								<label for="username">Pt :</label>
								<select id="pt" name="pt" class="custom-select" required>
									<option value="GAP">GAP</option>
									<option value="NOAH">NOAH</option>
								</select>
							</div>
							<div class="form-group">
								<label for="nama">Nama pangkalan :</label>
								<input type="text" class="form-control" id="nama" placeholder="*Nama pangkalan"
									name="nama" required>
							</div>
							<div class="form-group">
								<label for="alamat">Alamat :</label>
								<textarea class="form-control"
									style="border: 1px solid rgb(200, 200, 200); border-radius: 10px;" name="alamat"
									id="alamat" name="alamat" cols="30" rows="10" required></textarea>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</form>
				</div>
			</div>
			<!-- end modal -->
		</div>
	</div>
	<?php if($pangkalan != null): ?>
	<div class="row">
		<div class="col-md-12">
			<div class="card" style="border-radius: 20px !important;">
				<div class="card-header">
					<h5 class="text-center">Daftar Pangkalan</h5>
				</div>
				<table class="table table-hover text-center">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Agen</th>
							<th scope="col">Nama Pangkalan</th>
							<th scope="col">Alamat</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1+$page;foreach($pangkalan as $t => $val): ?>
						<tr>
							<td><?= $i ?></td>
							<td><?= $val['agen'] ?></td>
							<td><?php 
							echo $val['nama_pangkalan'];
							$id = $val['id'];
                            ?></td>
							<td><?= $val['alamat'] ?></td>
							<td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#update"
									onclick="javascript:view_input_post_mpangkalan('<?= $id ?>')">
									Perbarui
								</button>
								<a class="btn btn-danger"
									href="<?= base_url(); ?>MPangkalan/hapusPangkalan/<?= $val['id'] ?>/<?= $this->uri->segment(3) ?>" onclick="return confirm('Ingin menghapus pangkalan nomor <?= $i ?> ?');">Hapus</a>
							</td>
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
						<h5 class="modal-title" id="updateLabel">Form Perbarui Pangkalan</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="<?= base_url(); ?>MPangkalan/updatePangkalan/<?= $this->uri->segment(3) ?>"
						method="POST">
						<div class="modal-body" id="updateModal">
							<div class="form-group">
								<label for="username">Pt :</label>
								<select id="ptU" name="ptU" class="custom-select" required>
									<option value="GAP">GAP</option>
									<option value="NOAH">NOAH</option>
								</select>
							</div>
							<div class="form-group">
								<label for="pass">Nama pangkalan :</label>
								<input type="text" class="form-control" id="namaU" placeholder="*Nama pangkalan"
									name="namaU" required>
							</div>
							<div class="form-group">
								<label for="alamat">Alamat :</label>
								<textarea class="form-control"
									style="border: 1px solid rgb(200, 200, 200); border-radius: 10px;" name="alamat"
									id="alamatU" name="alamatU" cols="30" rows="10" required></textarea>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">tutup</button>
							<button type="submit" class="btn btn-primary">Perbarui</button>
						</div>
					</form>
				</div>
			</div>
			<!-- end modal -->
		</div>
		<?= $this->pagination->create_links(); ?>

	</div>

</div>
