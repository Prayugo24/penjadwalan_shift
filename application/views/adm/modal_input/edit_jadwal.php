<!-- ini edit jadwalnya -->

<!-- Modal -->
	<div id="myModaleditJadwal" class="modal fade" role="dialog">
		<div class="modal-dialog" >
			<!-- konten modal-->
			<div class="modal-content">
				<!-- heading modal -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Edit Jadwal Pegawai</h4>
				</div>
				<!-- body modal -->
				<div class="modal-body">
          <div class="content">
              <form action="<?php echo base_url().'index.php/Admin/crud/edit_jadwal';?>" method="post">


                  <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label>Tanggal</label>
                              <select class="form-control" id="tanggal" name="tanggal" disabled="">
                                <option value=""></option>
                              </select>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label>Bulan</label>
                              <select class="form-control" id="bulan"  name="bulan" disabled="">
                                <option value=""></option>
                              </select>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label>Tahun</label>
                              <select class="form-control" id="tahun" name="tahun" >
																<option data-info="">---Pilih Tahun---</option>
																<?php foreach ($cari_tahun as $tahun) {?>
                                <option value="<?php echo $tahun->tahun; ?>"> <?php echo $tahun->tahun; ?> </option>
															<?php } ?>
                              </select>
                          </div>
                      </div>
                  </div>


									<div class="row">
										<div class="col-md-12">

											<table class="table">
												<thead>
													<input type="text" name="jml_edit" id="jml_edit" hidden>
													<tr>

														<td>Nama</td>
														<td class="text-center">Jadwal</td>
													</tr>
												</thead>
												<tbody>
													<?php for ($i=0; $i <$jum_kary ; $i++) : ?>
													<tr>

														<td><select class="form-control" name="nama_karya2-<?php echo $i;?>" id="nama_karya2-<?php echo $i;?>" readonly>
															<option  value=""></option>
															<?php foreach ($nama_pgw as $nama): ?>
															<option  value="<?php echo $nama->kd_kar;?>"><?php echo $nama->nam_kar ?></option>
															<?php endforeach; ?>
														</select></td>
														<?php for ($j=0; $j <1 ; $j++) : ?>
														<td><select class="form-control" name="jadwll-<?php echo "A-".$i."-".$j;  ?>" id="jadwll-<?php echo "A-".$i."-".$j;  ?>">
															<option value=""></option>
															<option value="Siang">Siang</option>
															<option value="Pagi">Pagi</option>
															<option value="Lembur">Lembur</option>
															<option value="Libur">Libur</option>

														</select> </td>
															<?php endfor; ?>
													</tr>
													<?php endfor; ?>
												</tbody>

											</table>

										</div>


										</div>




                  <div class="text-center">
                      <button type="submit" class="btn btn-warning btn-fill btn-wd">Simpan Data</button>
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
<script type="text/javascript">
$(document).ready(function(){
	$('#tanggal').on('change',function(){
		var jum_kary= <?php echo  $jum_kary;?> ;
		var bulan=$("#bulan").val();
		var tahun=$('#tahun').val();
	//  var kd_kar=$('#kd_kar').val();
		var base_url2='/kp/codeigneter/Admin/crud/';
		var tanggal=$(this).val();
		if (tanggal=='') {

		}else {

			$.ajax({
				url:base_url2+"edit_waktu",
				type:"POST",
				data:{'bulan':bulan,
							'tahun':tahun,
							'tanggal':tanggal},
				dataType:'json',
				success:function(data){
					var html = '';
					for (var i = 0; i <data.length; i++) {
						$('#jadwll-A-'+i+'-0').val(data[i][0][0].jadwal);
						$('#nama_karya2-'+i).val(data[i][1][0].kd_kar);
					}
					// $('#nama_karya2-0').val("latif");
				 // $('#waktu').html(data);
				 $('#jml_edit').val(data.length);
					 // alert(data.length);

				},
				error:function(data){
					alert('error waktu'+data);
				}

			});
		}
	});
	});



</script>
