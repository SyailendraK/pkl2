<!-- End Navbar -->
<div class="panel-header panel-header-sm">
	<!-- <canvas id="bigDashboardChart"></canvas> -->
</div>
<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card" style="border-radius: 20px !important;">
				<div class="card-header">
					<h3 class="text-center">Surat Jalan</h3>
				</div>
				<div class="card-body pt-0">
					<!-- <a href="Printf/nota" target="_blank"
									class="btn btn-success d-flex justify-content-center mx-auto wide-full">buat</a> -->
					<button type="button" class="btn btn-primary wide-full" data-toggle="modal" data-target="#jalan">
						<h5 class="mb-0">Buat surat jalan</h5>
					</button>
					<!-- <button class="btn btn-success d-flex justify-content-center mx-auto wide-full">Buat</button> -->
				</div>
				<?= $this->session->flashdata('notif') ?>
			</div>
		</div>


		<!-- Modal -->
		<div class="modal fade" id="jalan" tabindex="-1" role="dialog" aria-labelledby="jalanLabel" aria-hidden="true">
			<div class="modal-dialog" role="document" style="font-size: 1.2rem;">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="jalanLabel">Form Surat Jalan</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="<?= base_url(); ?>Jalan/submit/<?= $this->uri->segment(3) ?>" method="POST">
						<div class="modal-body">
							<div class="form-group">
								<label for="tanggal">Tanggal :</label>
								<input type="date" class="form-control" data-date="" data-date-format="MM DD YYYY"
									value="<?=  date('Y-m-d')?>" name="tanggal" required>
							</div>
							<div class="form-group">

								<label for="agen">Agen :</label>
								<select class="custom-select" id="agen" name="agen">
									<option value="GAP">GAP</option>
									<option value="NOAH">NOAH</option>
								</select>
							</div>
							<div class="form-group">
								<label for="kepada">No jalan :</label>
								<input type="text" class="form-control" id="no_jalan" placeholder="*Nomor jalan"
									name="no_jalan" required>
							</div>
							<div class="form-group">
								<label for="pangkalan">Kepada :</label>
								<select class="custom-select" id="kepada" name="kepada">
									<?php foreach($kepada as $p => $val): ?>
									<option value="<?= $val['id'] ?>">
										<?= $val['nama_pangkalan']."(".$val['agen'].")" ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group">
								<label for="pangkalan">Nomor polisi :</label>
								<select class="custom-select" id="nomor_polisi" name="nomor_polisi">
									<?php foreach($nomor_polisi as $p => $val): ?>
									<option value="<?= $val['id'] ?>">
										<?= $val['nomor_polisi'].' ('.$val['nama_pengirim'].')' ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group">
								<label for="banyak">Jumlah barang :</label>
								<input type="number" class="form-control" id="banyak" placeholder="*Banyaknya barang"
									name="jumlah" required>
							</div>
							<div class="form-group">
								<label for="nama">Nama barang :</label>
								<input type="text" class="form-control" id="nama" placeholder="*Nama barang"
									value="<?= $keterangan['barang'] ?>" name="nama" required>
							</div>
							<div class="form-group">
								<label for="harga">keterangan :</label>
								<input type="text" class="form-control" id="keterangan" placeholder="*Keterangan barang"
									name="keterangan" value="<?= $keterangan['keterangan'] ?>" required>
							</div>
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

		<!-- updatemodal -->

		<!-- Modal -->
		<div class="modal fade" id="ujalan" tabindex="-1" role="dialog" aria-labelledby="ujalanLabel"
			aria-hidden="true">
			<div class="modal-dialog" role="document" style="font-size: 1.2rem;">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="ujalanLabel">Form Perbarui Surat Jalan</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="<?= base_url(); ?>Jalan/update/<?= $this->uri->segment(3) ?>" method="POST">
						<div class="modal-body" id="updateModalJalan">
							<div class="form-group">
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
								<label for="kepada">No jalan :</label>
								<input type="text" class="form-control" id="uno_jalan" placeholder="*Nomor jalan"
									name="uno_jalan" required>
							</div>
							<div class="form-group">
								<label for="pangkalan">Kepada :</label>
								<select class="custom-select" id="ukepada" name="ukepada">
									<?php foreach($kepada as $p => $val): ?>
									<option value="<?= $val['id'] ?>">
										<?= $val['nama_pangkalan']."(".$val['agen'].")" ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group">
								<label for="pangkalan">Nomor polisi :</label>
								<select class="custom-select" id="unomor_polisi" name="unomor_polisi">
									<?php foreach($nomor_polisi as $p => $val): ?>
									<option value="<?= $val['id'] ?>">
										<?= $val['nomor_polisi'].' ('.$val['nama_pengirim'].')' ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group">
								<label for="banyak">Jumlah barang :</label>
								<input type="number" class="form-control" id="ubanyak" placeholder="*Banyaknya barang"
									name="ujumlah" required>
							</div>
							<div class="form-group">
								<label for="nama">Nama barang :</label>
								<input type="text" class="form-control" id="unama" placeholder="*Nama barang"
									value="<?= $keterangan['barang'] ?>" name="unama" required>
							</div>
							<div class="form-group">
								<label for="harga">keterangan :</label>
								<input type="text" class="form-control" id="uketerangan"
									placeholder="*Keterangan barang" name="uketerangan"
									value="<?= $keterangan['keterangan'] ?>" required>
							</div>
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
	</div>
	<?php if($jalan != null): ?>
	<div class="row">
		<div class="col-md-12">
			<div class="card" style="border-radius: 20px !important;">
				<div class="card-header">
					<h5 class="text-center">Daftar jalan</h5>
				</div>
				<table class="table table-hover text-center">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Agen</th>
							<th scope="col">Kepada</th>
							<th scope="col">Tanggal</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1+$page; ?>

						<?php foreach($jalan as $n): ?>
						<tr>
							<td scope="row"><?= $i; ?></td>
							<td><?= $n['pt'] ?></td>
							<td><?= $n['kepada2'] ?></td>
							<td><?= tgl($n['tanggal']) ?></td>
							<td>
								<!-- <a class="btn <?php 
								if(in_array($n['id'],$_SESSION['print'])){
									echo "btn-secondary"; 
								}else{
									echo "btn-success";
								}
								?>" href="<?= base_url(); ?>Jalan/addListPrint/<?= $n['id'] ?>">Tambah
									ke list print</a> -->
								<a <?php $idT = $n['id']; if(in_array($n['id'],$_SESSION['print'])){
						echo 'class="btn btn-secondary" href="'.base_url().'Jalan/hapusPrint/'.$idT.'/'.$this->uri->segment(3).'"';
						}else{
							echo 'class="btn btn-success" href="'.base_url().'Jalan/addListPrint/'.$idT.'/'.$this->uri->segment(3).'"';
						} ?>><?php if(in_array($n['id'],$_SESSION['print'])){
							echo 'Hapus dari list print';
							}else{
								echo 'Tambah ke list print';
								} ?></a>
								<button class="btn btn-warning" data-toggle="modal" data-target="#ujalan"
									onclick="javascript:view_input_post_jalan('<?= $n['id'] ?>')">Perbarui</button>
								<a class="btn btn-danger"
									href="<?= base_url(); ?>Jalan/hapus/<?= $n['id'].'/'.$this->uri->segment(3) ?>"
									onclick="return confirm('Ingin menghapus surat jalan nomor <?= $i ?> ?');">Hapus</a>
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
