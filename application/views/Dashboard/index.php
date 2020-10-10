
			<div class="panel-header panel-header-sm">
				<!-- <canvas id="bigDashboardChart"></canvas> -->
			</div>
			<div class="content">
				<div class="row">
					<div class="col-md-12">
						<div class="card" style="border-radius: 20px !important;">
							<div class="card-header">
								<h3 class="text-center wide-full"><?= hello(); ?>, Admin</h3>
							</div>
							<div class="card-body pt-0">
								<!-- <a href="Printf/nota" target="_blank"
									class="btn btn-success d-flex justify-content-center mx-auto wide-full">buat</a> -->
								<!-- <button type="button" class="btn btn-success" data-toggle="modal"
									data-target="#nota">
									<h5 class="mb-0">Buat</h5>
								</button> -->
								<!-- <button class="btn btn-success d-flex justify-content-center mx-auto wide-full">Buat</button> -->
							</div>
						</div>
					</div>


					<!-- Modal -->
					<div class="modal fade" id="nota" tabindex="-1" role="dialog" aria-labelledby="notaLabel"
						aria-hidden="true">
						<div class="modal-dialog" role="document" style="font-size: 1.2rem;">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="notaLabel">Form Nota</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<form action="<?= base_url(); ?>Nota/submit" method="POST">
									<div class="modal-body">
										<div class="form-group">
											<label for="tanggal">Tanggal :</label>
											<input type="text" class="form-control" id="tanggal"
												aria-describedby="emailHelp" placeholder="*Tanggal sekarang"
												value="<?= tgl(date('Y-m-d')); ?>" name="tanggal">
										</div>
										<div class="form-group">
											<label for="kepada">Kepada :</label>
											<input type="text" class="form-control" id="kepada"
												placeholder="*Dikirim kepada" name="kepada">
										</div>
										<div class="form-group">
											<label for="banyak">Jumlah barang :</label>
											<input type="number" class="form-control" id="banyak"
												placeholder="*Banyaknya barang" name="jumlah">
										</div>
										<div class="form-group">
											<label for="nama">Nama barang :</label>
											<input type="text" class="form-control" id="nama" placeholder="*Nama barang"
												value="LPG 3 KG" name="nama">
										</div>
										<div class="form-group">
											<label for="harga">Harga :</label>
											<input type="number" class="form-control" id="harga"
												placeholder="*Harga barang" name="harga">
										</div>
										<!-- <div class="form-check">
										<input type="checkbox" class="form-check-input pl-1" id="exampleCheck1">
										<label class="form-check-label pl-1" for="exampleCheck1">Check me out</label>
									</div> -->
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary"
											data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Simpan</button>
									</div>
								</form>
							</div>
						</div>
						<!-- end modal -->
					</div>
				</div>
				
				