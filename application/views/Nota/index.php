<!-- End Navbar -->
<div class="panel-header panel-header-sm">
	<!-- <canvas id="bigDashboardChart"></canvas> -->
</div>
<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card" style="border-radius: 20px !important;">
				<div class="card-header">
					<h3 class="text-center">Nota</h3>
				</div>
				<div class="card-body pt-0">
					<!-- <a href="Printf/nota" target="_blank"
									class="btn btn-success d-flex justify-content-center mx-auto wide-full">buat</a> -->
					<button type="button" class="btn btn-primary  wide-full" data-toggle="modal" data-target="#nota">
						<h5 class="mb-0">Buat nota</h5>
					</button>
					<!-- <button class="btn btn-success d-flex justify-content-center mx-auto wide-full">Buat</button> -->
				</div>
				<?= $this->session->flashdata('notif') ?>
			</div>
		</div>


		<!-- Modal -->
		<div class="modal fade" id="nota" tabindex="-1" role="dialog" aria-labelledby="notaLabel" aria-hidden="true">
			<div class="modal-dialog" role="document" style="font-size: 1.2rem;">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="notaLabel">Form Nota</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="<?= base_url(); ?>Nota/submit/<?= $this->uri->segment(3); ?>" method="POST">
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
								<!-- <label for="tanggal">Agen :</label>
								<input class="form-control" list="agenp" id="agen" name="agen">
								<datalist id="agenp">
									<option value="NOAH">
									<option value="GAP">
								</datalist> -->
								<label for="agen">Agen :</label>
								<select class="custom-select" id="agen" name="agen">
									<option value="GAP">GAP</option>
									<option value="NOAH">NOAH</option>
								</select>
							</div>
							<div class="form-group">
								<label for="banyak">Nomor nota :</label>
								<input type="number" class="form-control" id="nomor" placeholder="*Nomor nota"
									name="nomor" required>
							</div>
							<div class="form-group">
								<label for="pangkalan">Kepada :</label>
								<select class="custom-select" id="kepada" name="kepada">
									<?php foreach($kepada as $p => $val): ?>
									<option value="<?= $val['id'] ?>">
										<?= $val['nama_pangkalan'] ?></option>
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
									value="LPG 3 KG" name="nama" required>
							</div>
							<div class="form-group">
								<label for="harga">Harga :</label>
								<input type="number" class="form-control" id="harga" placeholder="*Harga barang"
									name="harga" required value="<?= $harga['harga'] ?>" readonly>
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


		<div class="modal fade" id="notaU" tabindex="-1" role="dialog" aria-labelledby="notaULabel" aria-hidden="true">
			<div class="modal-dialog" role="document" style="font-size: 1.2rem;">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="notaULabel">Form Perbarui Nota</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="<?= base_url(); ?>Nota/update/<?= $this->uri->segment(3); ?>" method="POST">
						<div class="modal-body" id="updateModalNota">
							<div class="form-group">
								<label for="tanggal">Tanggal :</label>
								<input type="date" class="form-control" data-date="" data-date-format="MM DD YYYY"
									value="<?=  date('Y-m-d')?>" name="tanggalU" required>
							</div>
							<div class="form-group">
								<label for="agen">Agen :</label>
								<select class="custom-select" id="agenU" name="agenU">
									<option value="GAP">GAP</option>
									<option value="NOAH">NOAH</option>
								</select>
							</div>
							<div class="form-group">
								<label for="banyak">Nomor nota :</label>
								<input type="number" class="form-control" id="nomorU" placeholder="*Nomor nota"
									name="nomorU" required>
							</div>
							<div class="form-group">
								<label for="pangkalan">Kepada :</label>
								<select class="custom-select" id="kepadaU" name="kepadaU">
									<?php foreach($kepada as $p => $val): ?>
									<option value="<?= $val['id'] ?>">
										<?= $val['nama_pangkalan'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group">
								<label for="banyak">Jumlah barang :</label>
								<input type="number" class="form-control" id="banyakU" placeholder="*Banyaknya barang"
									name="jumlahU" required>
							</div>
							<div class="form-group">
								<label for="nama">Nama barang :</label>
								<input type="text" class="form-control" id="namaU" placeholder="*Nama barang"
									value="LPG 3 KG" name="namaU" required>
							</div>
							<div class="form-group">
								<label for="harga">Harga :</label>
								<input type="number" class="form-control" id="hargaU" placeholder="*Harga barang"
									name="hargaU" required value="<?= $harga['harga'] ?>" readonly>
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
	<?php if($nota != null): ?>
	<div class="row">
		<div class="col-md-12">
			<div class="card" style="border-radius: 20px !important;">
				<div class="card-header">
					<h5 class="text-center">Daftar nota</h5>
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

						<?php foreach($nota as $n): ?>
						<tr>
							<td scope="row"><?= $i; ?></td>
							<td><?= $n['pt'] ?></td>
							<td><?= $n['kepada2'] ?></td>
							<td><?= tgl($n['tanggal']) ?></td>
							<td>
								<!-- <a class="btn <?php 
								// $idT = $n['id'];
								if(in_array($n['id'],$_SESSION['print'])){
									echo "btn-secondary"; 
								}else{
									echo "btn-success";
								}
								?>" href="<?= base_url(); ?>Nota/addListPrint/<?= $n['id'] ?>/<?= $this->uri->segment(3); ?>">Tambah
									ke list print</a> -->
								<a <?php $idT = $n['id']; if(in_array($n['id'],$_SESSION['print'])){
						echo 'class="btn btn-secondary" href="'.base_url().'Nota/hapusPrint/'.$idT.'/'.$this->uri->segment(3).'"';
						}else{
							echo 'class="btn btn-success" href="'.base_url().'Nota/addListPrint/'.$idT.'/'.$this->uri->segment(3).'"';
						} ?>><?php if(in_array($n['id'],$_SESSION['print'])){
							echo 'Hapus dari list print';
							}else{
								echo 'Tambah ke list print';
								} ?></a>
								<?php $confirm = $n['kepada2']; ?>
								<button class="btn btn-warning" data-toggle="modal" data-target="#notaU"
									onclick="javascript:view_input_post_nota('<?= $n['id'] ?>')">Perbarui</button>
								<a class="btn btn-danger"
									href="<?= base_url(); ?>Nota/hapus/<?= $n['id'] ?>/<?= $this->uri->segment(3); ?>"
									onclick="return confirm('Ingin menghapus nota nomor <?= $i ?> ?');">Hapus</a>
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
