<!-- ini edit jadwalnya -->

<!-- Modal -->
	<div id="myModalHapusJadwal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- konten modal-->
			<div class="modal-content">
				<!-- heading modal -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Hapus Jadwal Pegawai</h4>
				</div>
				<!-- body modal -->
				<div class="modal-body">
          <div class="content">
              <form action="<?php echo base_url().'index.php/Admin/crud/hapus_jadwal';?>" method="post">
								<div class="row">
										<div class="col-md-6">
												<div class="form-group">
														<label>kd karyawan</label>
														<?php //foreach ($kd_kar as $kd_karyawan) { ?>
														<input id="kd_kary" type="text" class="form-control border-input" readonly placeholder="kd_jadwal" name="kd_kary" value="">
													<?php //} ?>
												</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
													<label>Nama Karyawan</label>
													<select class="form-control" name="nama" id="nama_kary"  >
														<option>---Pilih karyawan---</option>
														<?php for($i=0;$i<$jum_kar;$i++) { ?>
														<option data-info="<?php  echo $kd_karya[$i];?>" value=" <?php echo $kd_karya[$i];?>"><?php echo $nama_kary[$i]; ?></option>
														<?php ?>
													<?php  }?>
													</select>
											</div>
										</div>
								</div>

                  <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label>Tanggal</label>
                              <select class="form-control" id="tanggl" name="tanggal" disabled="">
                                <option value=""></option>
                              </select>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label>Bulan</label>
                              <select class="form-control" id="buln"  name="bulan" disabled="">
                                <option value=""></option>
                              </select>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label>Tahun</label>
                              <select class="form-control" id="tahn" name="tahun" disabled="">
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
                              <label>Waktu</label>
															<select class="form-control" id="wakt" name="waktu" disabled="">
																<option></option>
															</select>
                          </div>
                      </div>
                  </div>

                  <div class="text-center">
                      <button type="submit" class="btn btn-warning btn-fill btn-wd">Hapus Data</button>
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
