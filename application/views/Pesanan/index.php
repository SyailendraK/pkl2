<!-- End Navbar -->
<div class="panel-header panel-header-sm">
	<!-- <canvas id="bigDashboardChart"></canvas> -->
</div>
<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card" style="border-radius: 20px !important;">
				<div class="card-header">
					<h3 class="text-center">Surat Pesanan</h3>
				</div>
				<div class="card-body pt-0">
					<!-- <a href="Printf/nota" target="_blank"
									class="btn btn-success d-flex justify-content-center mx-auto wide-full">buat</a> -->
					<button type="button" class="btn btn-primary wide-full" data-toggle="modal" data-target="#pesanan">
						<h5 class="mb-0">Buat surat pesanan</h5>
					</button>
					<!-- <button class="btn btn-success d-flex justify-content-center mx-auto wide-full">Buat</button> -->
				</div>
				<?= $this->session->flashdata('notif') ?>
			</div>
		</div>


		<!-- Modal -->
		<div class="modal fade" id="pesanan" tabindex="-1" role="dialog" aria-labelledby="pesananLabel"
			aria-hidden="true">
			<div class="modal-dialog" role="document" style="font-size: 1.2rem;">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="pesananLabel">Form Surat Pesanan</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="<?= base_url(); ?>Pesanan/submit/<?= $this->uri->segment(3) ?>" method="POST">
						<div class="modal-body">
							<div class="form-group">
								<label for="tanggal">Tanggal :</label>
								<input type="date" class="form-control" data-date="" data-date-format="MM DD YYYY"
									value="<?=  date('Y-m-d')?>" name="tanggal" required>
								<!-- <input type="text" class="form-control" id="tanggal"
												aria-describedby="emailHelp" placeholder="*Tanggal sekarang"
												value="<?= tgl(date('Y-m-d')); ?>" name="tanggal"> -->
							</div>
							<div class="form-group">
								<!-- <label for="tanggal">Agen :</label> -->
								<!-- <input type="text" class="form-control" id="tanggal" placeholder="*Agen" value="NOAH"
									name="agen"> -->
								<label for="agen">Agen :</label>
								<select class="custom-select" id="agen" name="agen">
									<option value="GAP">GAP</option>
									<option value="NOAH">NOAH</option>
								</select>
							</div>
							<div class="form-group">
								<label for="pesanan">Nomor pesanan :</label>
								<input type="number" class="form-control" id="pesanan" placeholder="*Nomor pesanan"
									name="nomor_pesanan" required>
							</div>
							<div class="form-group">
								<label for="trip">Trip :</label>
								<input type="number" class="form-control" id="trip" placeholder="*Jumlah trip"
									name="trip" min="0" required>
							</div>
							<div class="form-group">
								<label for="do">Nomor DO :</label>
								<input type="number" class="form-control" id="do" placeholder="*Nomor DO"
									name="nomor_do" min="0" required>
							</div>
							<div class="form-group">
								<label for="sa">Nomor SA :</label>
								<input type="number" class="form-control" id="sa" placeholder="*Nomor SA"
									name="nomor_sa" min="0" required>
							</div>
							<!-- <div class="form-check">
										<input type="checkbox" class="form-check-input pl-1" id="exampleCheck1">
										<label class="form-check-label pl-1" for="exampleCheck1">Check me out</label>
									</div> -->
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</form>
				</div>
			</div>
			<!-- end modal -->
		</div>

		<!-- update pesanan -->

		<div class="modal fade" id="upesanan" tabindex="-1" role="dialog" aria-labelledby="upesananLabel"
			aria-hidden="true">
			<div class="modal-dialog" role="document" style="font-size: 1.2rem;">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="upesananLabel">Form Perbarui Surat Pesanan</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="<?= base_url(); ?>Pesanan/update/<?= $this->uri->segment(3) ?>" method="POST">
						<div class="modal-body" id="updateModalPesanan">
							<div class="form-group" >
								<label for="tanggal">Tanggal :</label>
								<input type="date" class="form-control" data-date="" data-date-format="MM DD YYYY"
									value="<?=  date('Y-m-d')?>" name="utanggal" required>
							</div>
							<div class="form-group">
								<label for="agen">Agen :</label>
								<select class="custom-select" id="uagen" name="uagen">
									<option value="GAP">GAP</option>
									<option value="NOAH">NOAH</option>
								</select>
							</div>
							<div class="form-group">
								<label for="pesanan">Nomor pesanan :</label>
								<input type="number" class="form-control" id="upesanan" placeholder="*Nomor pesanan"
									name="unomor_pesanan" required>
							</div>
							<div class="form-group">
								<label for="trip">Trip :</label>
								<input type="number" class="form-control" id="utrip" placeholder="*Jumlah trip"
									name="utrip" min="0" required>
							</div>
							<div class="form-group">
								<label for="do">Nomor DO :</label>
								<input type="number" class="form-control" id="udo" placeholder="*Nomor DO"
									name="unomor_do" min="0" required>
							</div>
							<div class="form-group">
								<label for="sa">Nomor SA :</label>
								<input type="number" class="form-control" id="usa" placeholder="*Nomor SA"
									name="unomor_sa" min="0" required>
									
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Perbarui</button>
						</div>
					</form>
				</div>
			</div>
			<!-- end modal -->
		</div>
	</div>
	<?php if($pesanan != null): ?>
	<div class="row">
		<div class="col-md-12">
			<div class="card" style="border-radius: 20px !important;">
				<div class="card-header">
					<h5 class="text-center">Daftar pesanan</h5>
				</div>
				<table class="table table-hover text-center">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Agen</th>
							<th scope="col">Nomor DO</th>
							<th scope="col">Tanggal</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1+$page; ?>

						<?php foreach($pesanan as $n): ?>
						<tr>
							<td scope="row"><?= $i; ?></td>
							<td><?= $n['pt'] ?></td>
							<td><?= $n['nomor_do'] ?></td>
							<td><?= tgl($n['tanggal']) ?></td>
							<td>
								<!-- <a class="btn <?php 
								if(in_array($n['id'],$_SESSION['print'])){
									echo "btn-secondary"; 
								}else{
									echo "btn-success";
								}
								?>" href="<?= base_url(); ?>Pesanan/addListPrint/<?= $n['id'] ?>">Tambah
									ke list print</a> -->
									<a <?php $idT = $n['id']; if(in_array($n['id'],$_SESSION['print'])){
						echo 'class="btn btn-secondary" href="'.base_url().'Pesanan/hapusPrint/'.$idT.'/'.$this->uri->segment(3).'"';
						}else{
							echo 'class="btn btn-success" href="'.base_url().'Pesanan/addListPrint/'.$idT.'/'.$this->uri->segment(3).'"';
						} ?>><?php if(in_array($n['id'],$_SESSION['print'])){
							echo 'Hapus dari list print';
							}else{
								echo 'Tambah ke list print';
								} ?></a>
									<?php $confirm = $n['nomor_do']; ?>
									<button class="btn btn-warning" data-toggle="modal" data-target="#upesanan"
									onclick="javascript:view_input_post_pesanan('<?= $n['id'] ?>')">Perbarui</button>
								<a class="btn btn-danger"
									href="<?= base_url(); ?>Pesanan/hapus/<?= $n['id'].'/'.$this->uri->segment(3) ?>" onclick="return confirm('Ingin menghapus surat pesanan nomor <?= $i ?> ?');">Hapus</a>
							</td>
						</tr>
						<?php $i = $i+1; endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
		<?= $this->pagination->create_links(); ?>
	</div>
	<?php else: ?>
		<div class="row">
			<div class="col-md-12 d-flex justify-content-center mx-auto">
				<h3 style="color: gray;">Data tidak ditemukan</h3>
			</div>
		</div>
		<?php endif; ?>
</div>
