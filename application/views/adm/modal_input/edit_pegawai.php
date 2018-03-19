<!-- Modal -->
	<div id="myModaledit" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- konten modal-->
			<div class="modal-content">
				<!-- heading modal -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" onclick="closeModal()">&times;</button>
					<h4 class="modal-title">Edit Data Pegawai</h4>
				</div>
				<!-- body modal -->
				<div class="modal-body">
          <div class="content">
						<?php foreach ($pegawai as $pegawaii) {?>
              <form action="<?php echo base_url().'index.php/Admin/crud/edit_pegawai';?>" method="post">
                  <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label>Kode Karyawan</label>
                              <input type="text"  class="form-control border-input" readonly value="<?php echo $pegawaii->kd_kar;?>" name="kd_pegawai" >
                          </div>
                      </div>
                      <div class="col-md-8">
                        <div class="form-group">
                            <label>Nama Karyawan</label>
                            <input type="text" name="nama" class="form-control border-input" placeholder="nama" required value="<?php echo $pegawaii->nam_kar;?>">
                        </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label>Jenis Kelamin</label>
                              <select class="form-control" name="jns" value="<?php echo $pegawaii->jns_kel;?>">
                                <option>Laki-Laki</option>
                                <option>Perempuan</option>
                              </select>
                          </div>
                      </div>
                      <div class="col-md-8">
                          <div class="form-group">
                              <label>No Hp</label>
                              <input type="text" name="no_hp" class="form-control border-input" placeholder="No Hp" value="<?php echo $pegawaii->no_hp;?>" required>
                          </div>
                      </div>
                  </div>
									<!-- status -->
									<input type="hidden" name="status" value="Actif">
                  <!-- <div class="row">
                      <div class="col-md-12">
                          <div class="form-group" style="visibility: hidden">
                              <label>Status</label>
                              <select class="form-control" >
                                <option>Aktif</option>
                                <option>Tidak Aktif</option>
                              </select>
                          </div>
                      </div>
                  </div> -->
                  <div class="text-center">
                      <button type="submit" class="btn btn-warning btn-fill btn-wd">Edit Data</button>
                  </div>
                  <div class="clearfix"></div>
              </form>
						<?php } ?>
          </div>
				</div>
				<!-- footer modal -->
				<div class="modal-footer">
					<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Tutup Modal</button> -->
				</div>
			</div>
		</div>
	</div>
