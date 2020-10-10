<!-- End Navbar -->
<div class="panel-header panel-header-sm">
	<!-- <canvas id="bigDashboardChart"></canvas> -->
</div>
<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card" style="border-radius: 20px !important;">
				<div class="card-header">
					<h3 class="text-center">Surat Rencana</h3>
				</div>
				<div class="card-body pt-0">
					<!-- <a href="Printf/nota" target="_blank"
									class="btn btn-success d-flex justify-content-center mx-auto wide-full">buat</a> -->
					<button type="button" class="btn btn-primary wide-full" data-toggle="modal" data-target="#rencana">
						<h5 class="mb-0">Buat rencana</h5>
					</button>
					<!-- <button class="btn btn-success d-flex justify-content-center mx-auto wide-full">Buat</button> -->
				</div>
				<?= $this->session->flashdata('notif') ?>
			</div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="rencana" tabindex="-1" role="dialog" aria-labelledby="rencanaLabel"
			aria-hidden="true">
			<div class="modal-dialog" role="document" style="font-size: 1.2rem;">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="rencanaLabel">Form Rencana</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true" >&times;</span>
						</button>
					</div>
					<form action="<?= base_url(); ?>Rencana/submit/<?=$this->uri->segment(3) ?>" method="POST">
						<div class="modal-body">
							<div class="form-group">
								<label for="tanggal">Tanggal :</label>
								<input type="date" class="form-control" data-date="" data-date-format="MM DD YYYY"
									value="<?=  date('Y-m-d')?>" name="tanggal" required>
							</div>
							<div class="form-group">
								<label for="agen">Agen :</label>
								<select class="custom-select" id="agen" name="agen">
									<option value="NOAH">NOAH</option>
									<option value="GAP">GAP</option>
								</select>
							</div>
							<div class="form-group">
								<label for="lo">Loading order :</label>
								<input type="number" class="form-control" id="lo" placeholder="*Nomor LO" name="lo"
									required>
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

							<div id="tambah">
								<div class="form-group">
									<label for="pangkalan">Data pangkalan 1 :</label>
									<select class="custom-select" id="pangkalan-1" name="pangkalan-1"
										onclick="javascript:setSession('1')" required>
										<?php foreach($pangkalan as $p => $val): ?>
										<option value="<?= $val['id'] ?>"><?= $val['nama_pangkalan'] ?></option>
										<?php endforeach; ?>
									</select>
									<div class="row pt-2">
										<div class="col-md-6" id="setVal">
											<input type="number" class="form-control" id="banyak-1"
												placeholder="*Banyaknya barang" name="jumlah-1"
												onkeyup="javascript:setTimeout(cekJumlah('1'), 500); pengurang('1');setSession('1')"
												value="0" min="0" required>
										</div>
										<dib class="col-md-6">
											<input type="number" class="form-control" id="faktur-1"
												placeholder="*Nomor faktur" name="faktur-1" min="0" required
												onkeyup="javascript:setSession('1')">
										</dib>
									</div>
								</div>
							</div>

							<div class="form-group">
								<a class="btn btn-success" style="width: 100%;border-radius: 15px;color: white;"
									id="tbh" onclick="javascript:view_input_post_add()">Tambah data</a>
							</div>

						</div>
						<div class="modal-footer">
							<p class="mr-5" id="jumBarang">Jumlah barang : <span id="jumlah">0</span></p>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</form>
				</div>
			</div>
			<!-- end modal -->
		</div>

		<!-- perbarui rencana -->

		<div class="modal fade" id="urencana" tabindex="-1" role="dialog" aria-labelledby="urencanaLabel"
			aria-hidden="true">
			<div class="modal-dialog" role="document" style="font-size: 1.2rem;">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="urencanaLabel">Form Perbarui Rencana</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true" >&times;</span>
						</button>
					</div>
					<form action="<?= base_url(); ?>Rencana/update/<?=$this->uri->segment(3) ?>" method="POST"
						id="updateRencana">
						<div class="modal-body">
							<div class="form-group">
								<label for="tanggal">Tanggal :</label>
								<input type="date" class="form-control" data-date="" data-date-format="MM DD YYYY"
									value="<?=  date('Y-m-d')?>" name="utanggal" required>
							</div>
							<div class="form-group">
								<label for="agen">Agen :</label>
								<select class="custom-select" id="uagen" name="uagen">
									<option value="NOAH">NOAH</option>
									<option value="GAP">GAP</option>
								</select>
							</div>
							<div class="form-group">
								<label for="lo">Loading order :</label>
								<input type="number" class="form-control" id="ulo" placeholder="*Nomor LO" name="ulo"
									required>
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

							<div id="utambah">
								<div class="form-group">
									<label for="pangkalan">Data pangkalan 1 :</label>
									<select class="custom-select" id="upangkalan-1" name="upangkalan-1"
										onclick="javascript:usetSession('1')" required>
										<?php foreach($pangkalan as $p => $val): ?>
										<option value="<?= $val['id'] ?>"><?= $val['nama_pangkalan'] ?></option>
										<?php endforeach; ?>
									</select>
									<div class="row pt-2">
										<div class="col-md-6" id="setVal">
											<input type="number" class="form-control" id="ubanyak-1"
												placeholder="*Banyaknya barang" name="ujumlah-1"
												onkeyup="javascript:setTimeout(ucekJumlah('1'), 500); upengurang('1');usetSession('1')"
												value="0" min="0" required>
										</div>
										<dib class="col-md-6">
											<input type="number" class="form-control" id="ufaktur-1"
												placeholder="*Nomor faktur" name="ufaktur-1" min="0" required
												onkeyup="javascript:usetSession('1')">
										</dib>
									</div>
								</div>
							</div>

							<div class="form-group">
								<a class="btn btn-success" style="width: 100%;border-radius: 15px;color: white;"
									id="utbh" onclick="javascript:uview_input_post_add()">Tambah data</a>
							</div>

						</div>
						<div class="modal-footer">
							<p class="mr-5" id="ujumBarang">Jumlah barang : <span id="ujumlah">0</span></p>
							<button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
							<button type="submit" class="btn btn-primary">Perbarui</button>
						</div>
					</form>
				</div>
			</div>
			<!-- end modal -->
		</div>
	</div>
	<?php if($rencana != null): ?>
	<div class="row">
		<div class="col-md-12">
			<div class="card" style="border-radius: 20px !important;">
				<div class="card-header">
					<h5 class="text-center">Daftar rencana</h5>
				</div>
				<table class="table table-hover text-center">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Agen</th>
							<th scope="col">Pangkalan</th>
							<!-- <th scope="col">Alamat pangkalan</th> -->
							<th scope="col">Tanggal</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php if($rencana != null): ?>
						<?php $i=1+$page; ?>

						<?php foreach($rencana as $n): ?>
						<tr>
							<td scope="row"><?= $i; ?></td>
							<td><?= $n['agen'] ?></td>
							<td style="font-size: 1rem; text-align: left;"><?php
							$no=1;
							foreach($n['nama_pangkalan'] as $v => $val){
								echo $no.'. '.$val['nama_pangkalan']. '('.$val['alamat'].')<br>';
								$no++;
							} 
							?></td>
							<!-- <td><?= $n['alamat'] ?></td> -->
							<td><?= tgl($n['tanggal']) ?></td>
							<td>
								<!-- <a class="btn <?php 
								if(in_array($n['id'],$_SESSION['print'])){
									echo "btn-secondary"; 
								}else{
									echo "btn-success";
								}
								?>" href="<?= base_url(); ?>Rencana/addListPrint/<?= $n['id'] ?>">Tambah
									ke list print</a> -->
								<a <?php $idT = $n['id']; if(in_array($n['id'],$_SESSION['print'])){
						echo 'class="btn btn-secondary" href="'.base_url().'Rencana/hapusPrint/'.$idT.'/'.$this->uri->segment(3).'"';
						}else{
							echo 'class="btn btn-success" href="'.base_url().'Rencana/addListPrint/'.$idT.'/'.$this->uri->segment(3).'"';
						} ?>><?php if(in_array($n['id'],$_SESSION['print'])){
							echo 'Hapus dari list print';
							}else{
								echo 'Tambah ke list print';
								} ?></a>
								<button type="button" class="btn btn-warning" data-toggle="modal"
									data-target="#urencana"
									onclick="javascript:view_input_post_rencana('<?= $n['id'] ?>')">
									Perbarui
								</button>
								<a class="btn btn-danger"
									href="<?= base_url(); ?>Rencana/hapus/<?= $n['id'].'/'.$this->uri->segment(3) ?>"
									onclick="return confirm('Ingin menghapus surat jalan nomor <?= $i ?> ?');">Hapus</a>
							</td>
						</tr>
						<?php $i = $i+1; endforeach; endif; ?>
					</tbody>
				</table>
			</div>
		</div>
		<?= $this->pagination->create_links() ?>
	</div>
	<?php else: ?>
		<div class="row">
			<div class="col-md-12 d-flex justify-content-center mx-auto">
				<h3 style="color: gray;">Data tidak ditemukan</h3>
			</div>
		</div>
		<?php endif; ?>
	<!-- Modal -->
