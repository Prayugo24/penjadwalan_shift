<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- konten modal-->
			<div class="modal-content">
				<!-- heading modal -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Tambah Data Pegawai</h4>
				</div>
				<!-- body modal -->
				<div class="modal-body">
          <div class="content">
              <form action="<?php echo base_url().'index.php/Admin/crud/tambah_pegawai';?>" method="post">
                  <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label>Kode Karyawan</label>
                              <input type="text" class="form-control border-input" disabled placeholder="kode" value="<?php echo $kodeunik; ?>" name="kode_kar">
                          </div>
                      </div>
                      <div class="col-md-8">
                        <div class="form-group">
                            <label>Nama Karyawan</label>
                            <input type="text" required class="form-control border-input" placeholder="nama" name="nama">
                        </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label>Jenis Kelamin</label>
                              <select class="form-control" name="jns">
                                <option>Laki-Laki</option>
                                <option>Perempuan</option>
                              </select>
                          </div>
                      </div>
                      <div class="col-md-8">
                          <div class="form-group">
                              <label>No Hp</label>
                              <input type="number" required class="form-control border-input" placeholder="No Hp" value="" name="no_hp">
                          </div>
                      </div>
                  </div>
									<div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label>Status Perkawinan</label>
                              <select class="form-control" name="stts_prkwnan" required>
                                <option>Kawin</option>
                                <option>Belum Kawin</option>
																<option>Duda</option>
																<option>Janda</option>
                              </select>
                          </div>
                      </div>
                      <div class="col-md-8">
                          <div class="form-group">
                              <label>Alamat</label>
                              <textarea name="alamat" required rows="8" class="form-control border-input" cols="80"></textarea>
                          </div>
                      </div>
                  </div>
									<div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label>Tanggal lahir</label>
                              <input required type="date" name="tgl_lhr" value="" class="form-control border-input">
                          </div>
                      </div>
                      <div class="col-md-8">
                          <div class="form-group">
                              <label>Status Kerja</label>
															<select class="form-control" name="stts_kerja" required>
                                <option>Kontrak</option>
                                <option>Tetap</option>
																<option>Training</option>
                              </select>
                          </div>
                      </div>
                  </div>
									<!-- status -->
									<input type="hidden" name="status" value="Active">
                  <!-- <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <label>Status</label>
                              <select class="form-control" name="status" disabled>
                                <option>Aktif</option>
                                <option>Tidak Aktif</option>
                              </select>
                          </div>
                      </div>
                  </div> -->
                  <div class="text-center">
                      <input type="submit" class="btn btn-info btn-fill btn-wd" value="Tambah Data"  >
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
