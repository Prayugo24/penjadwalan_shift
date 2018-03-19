<!-- ini bagian modal inputan jadwal yang tadi di klik -->
<!-- Modal -->
	<div id="myModalCetakJadwal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- konten modal-->
			<div class="modal-content">
				<!-- heading modal -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Cetak Jadwal Pegawai</h4>
				</div>
				<!-- body modal -->
				<div class="modal-body">
          <div class="content">
              <form action="<?php echo base_url().'index.php/Admin/crud/downloadExcel';?>" method="post">

                  <div class="row">
                      <div class="col-md-6">
												<div class="form-group">
														<label>Bulan</label>
														<select class="form-control" id="bln"  name="bulan" disabled="">
															<option value=""></option>
														</select>
												</div>
                      </div>

                      <div class="col-md-6">
												<div class="form-group">
														<label>Tahun</label>
														<select class="form-control" id="thn" name="tahun" >
															<option data-info="">---Pilih Tahun---</option>
															<?php foreach ($cari_tahun as $tahun) {?>
															<option value="<?php echo $tahun->tahun; ?>"> <?php echo $tahun->tahun; ?> </option>
														<?php } ?>
														</select>
												</div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label>Tanggal Mulai</label>
															<select class="form-control" name="tgl_awl" id="tgl_awl" disabled="">
																 <option value=""></option>
															</select>
                          </div>
                      </div>

                      <div class="col-md-4">
                          <div class="form-group">
                              <label>Tanggal Akhir</label>
															<select class="form-control" name="tgl_akhr" id="tgl_akhr" disabled="">
																<option value=""></option>
															</select>
                          </div>
                      </div>

											<div class="col-md-4">
                          <div class="form-group">
                              <label>Export Data</label>
															<select class="form-control" name="export_data" id="export_data" disabled>
																<option value="Excel">Excel</option>
																<option value="PDF">PDF</option>
															</select>
                          </div>
                      </div>
                  </div>
									<div class="row">
										<div class="col-md-12">
											<div class="text-center">
													<button type="submit" class="btn btn-success btn-fill btn-wd">Export Data</button>
											</div>
										</div>
									</div>
                  <div class="clearfix"></div>
              </form>
          </div>
				</div>
				<!-- footer modal -->
				<div class="modal-footer">
					<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Tutup Modal</button> -->
				</div>
			</div>
		</div>
	</div>
