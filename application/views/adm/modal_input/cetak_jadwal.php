<!-- ini bagian modal inputan jadwal yang tadi di klik -->
<!-- Modal -->
	<div id="myModalCetakJadwal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- konten modal-->
			<div class="modal-content">
				<!-- heading modal -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Input Jadwal Pegawai</h4>
				</div>
				<!-- body modal -->
				<div class="modal-body">
          <div class="content">
              <form action="<?php echo base_url().'index.php/Admin/crud/tambah_jadwal';?>" method="post">
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label>kd_jadwal</label>
                              <input type="text" class="form-control border-input" readonly placeholder="kd_jadwal" value="<?php echo $kd_unik_jd;?>" name="kd_jadwal">
                          </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Karyawan</label>
														<select class="form-control" name="kd_kar">
															<?php foreach ($nama_pgw as $nam_pgw) { ?>
															<option value="<?php echo $nam_pgw->kd_kar;?>"><?php echo $nam_pgw->nam_kar; ?></option>
														<?php  }?>
														</select>
                        </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label>Jadwal</label>
                              <select class="form-control" name="jns_jdwl">
                                <option value="jdwl-1">Jadwal 1</option>
                                <option value="jdwl-2">Jadwal 2</option>
                                <option value="jdwl-3">Jadwal 3</option>
                                <option value="jdwl-4">Jadwal 4</option>
                                <option value="jdwl-5">Jadwal 5</option>
                                <option value="jdwl-6">Jadwal 6</option>
                                <option value="jdwl-7">Jadwal 7</option>
                                <option value="jdwl-8">Jadwal 8</option>
                              </select>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label>Bulan</label>
															<input name="bulan" type="text" class="form-control border-input" readonly placeholder="bulan" value="<?php echo $bln_skrg;?>">
                          </div>
                      </div>

                      <div class="col-md-4">
                          <div class="form-group">
                              <label>Tahun</label>
                              <input name="tahun" type="text" class="form-control border-input" readonly placeholder="tahun" value="<?php echo $thn_skrg;?>">
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label>Tanggal Mulai</label>
															<select class="form-control" name="tgl_awl">
																<?php for($i=$tgl_awl;$i<=$tgl_akhr;$i++){ ?>
																<option value="<?php echo $i;?>"><?php echo $i; ?></option>
															<?php } ?>
															</select>
                          </div>
                      </div>

                      <div class="col-md-4">
                          <div class="form-group">
                              <label>Tanggal Akhir </label>
															<select class="form-control" name="tgl_akhr">
																<?php for($i=$tgl_awl;$i<=$tgl_akhr;$i++){ ?>
																<option value="<?php echo $i;?>"><?php echo $i; ?></option>
															<?php } ?>
															</select>
                          </div>
                      </div>
                  </div>
                  <div class="text-center">
                      <button type="submit" class="btn btn-info btn-fill btn-wd">Tambah Data</button>
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
