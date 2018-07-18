<!-- ini bagian modal inputan jadwal yang tadi di klik -->
<!-- Modal -->

	<div id="myModalEditAllJAdwal" class="modal fade" role="dialog">
		<div class="modal-dialog" style="width:75%;">
			<!-- konten modal-->
			<div class="modal-content">
				<!-- heading modal -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Input Jadwal Pegawai</h4>
				</div>




				<!-- body modal -->
				<div class="modal-body" >
          <div class="content">
              <form action="<?php echo base_url().'index.php/Admin/crud/edit_all_jadwal';?>" method="post">


                  <div class="row">
                      <div class="col-md-2">
                          <div class="form-group">
                              <label>Pagi</label>
                              <select class="form-control" name="jns_jdwl" id="jdwll_pgi" onChange="pilih_jadwal_1()">
																	<?php for ($i=0; $i <=$jum_kar ; $i++) : ?>
		                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
																	<?php endfor; ?>
                              </select>
                          </div>
                      </div>
											<div class="col-md-2">
												<div class="form-group">
														<label>Siang</label>
														<select class="form-control" name="jns_jdwl" id="jdwll_siang" onChange="pilih_jadwal_2()">
															<?php for ($i=0; $i <=$jum_kar ; $i++) : ?>
																<option value="<?php echo $i; ?>"><?php echo $i ?></option>
															<?php endfor; ?>
														</select>
												</div>
											</div>
                      <div class="col-md-4">
                          <div class="form-group">

																<label>Bulan</label>
																<select class="form-control" id="blaan"  name="bulan" disabled="">
																	<option data-info="">---Pilih Bulan---</option>
																</select>

                          </div>
                      </div>

                      <div class="col-md-4">
                          <div class="form-group">
														<label>Tahun</label>
														<select class="form-control" id="thuun" name="tahun" >
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
															<select class="form-control" name="tgl_awl" id="tgll_awl" disabled="">
																<option data-info="">---Pilih Tanggal---</option>
															</select>
                          </div>
                      </div>

                      <div class="col-md-4">
                          <div class="form-group">
                              <label>Tanggal Akhir</label>
															<select class="form-control" name="tgl_akhr" id="tgll_akhr" disabled="" >
																<option data-info="">---Pilih Tanggal---</option>
															</select>
                          </div>
                      </div>
                  </div>
									<div class="row">
										<div class="col-md-12">

											<table class="table">
												<thead>
													<tr>
														<td></td>
														<td>Nama</td>
														<td class="text-center">Jadwal</td>
													</tr>
												</thead>
												<tbody>
													<?php for ($i=0; $i <$jum_kar ; $i++) : ?>
													<tr>
														<td><input type="button" class="btn btn-danger" name="" value="Hapus" onClick="Hapus_jadwall(<?php echo $i?>)"> </td>
														<td><select class="form-control" name="nama_karya3-<?php echo $i;?>" id="nama_karyaa-<?php echo $i;?>">
															<option  value=""></option>
															<?php for($h=0;$h<$jum_kar;$h++) {?>
															<option  value=" <?php echo $kd_karya[$h]; ?>"><?php echo $nama_kary[$h]; ?></option>
															  <?php } ?>
														</select></td>
														<?php for ($j=1; $j <=7 ; $j++) : ?>
														<td><select class="form-control" name="jadwl-<?php echo "A-".$i."-".$j;  ?>" id="jadwll-<?php echo "A-".$i."-".$j;  ?>">
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
	<script type="text/javascript">
	function pilih_jadwal_1(){
		var jum_kar=<?php echo $jum_kar; ?>;

		var pilih_jum_jad=$("#jdwll_pgi").val();
		var jadwlPagi=[
							["Pagi","Lembur","Siang","Pagi","Libur","Pagi","Siang","Siang"],
							["Pagi","Libur","Pagi","Siang","Siang","Pagi","Lembur","Siang"],
							["Pagi","Siang","Siang","Pagi","Lembur","Siang","Pagi","Libur"]
						];
		var jadwlSiang=[
								["Siang","Pagi","Libur","Pagi","Siang","Siang","Pagi","Lembur"],
								["Siang","Siang","Pagi","Lembur","Siang","Pagi","Libur","Pagi"],
								["Siang","Pagi","Lembur","Siang","Pagi","Libur","Pagi","Siang"]
									];
		var total=jum_kar-pilih_jum_jad;

		$('#jdwll_siang').val(total).trigger("chosen:updated");
		var m=0;
		var l=0;
		var h=0;
		var g=0;


			for (var i = 0; i <pilih_jum_jad ; i++) {
					var h=m++;
					if(h>2){
						h=0;
					}
					var w=1;
				for (var j =0 ; j < 7; j++) {
					var t=w++;
					// document.getElementById('jadwll-A-'+i+'-'+j).options[0].text = jadwlPagi[h][j];
					// var tgl_akhr=document.getElementById('jadwll-A-'+i+'-'+j).options[0].value = jadwlPagi[h][j];
					 $('#jadwll-A-'+i+'-'+t).val(jadwlPagi[h][j]).trigger("chosen:updated");

					 // alert(jadwlPagi[h][j]);

				}
			}
			for (var y = 0; y <total ; y++) {
					var g=l++;
					if(g>2){
						g=0;
					}
					var a=i++;
					var u=1;
				for (var j = 0; j < 7; j++) {
					var v=u++;
					// document.getElementById('jadwl-A-'+a+'-'+j).options[0].text = jadwlSiang[g][j];
					// var tgl_akhr=document.getElementById('jadwl-A-'+a+'-'+j).options[0].value = jadwlSiang[g][j];
						$('#jadwll-A-'+a+'-'+v).val(jadwlSiang[g][j]).trigger("chosen:updated");
				}
			}
	}
	function pilih_jadwal_2(){
		var jum_kar=<?php echo $jum_kar; ?>;
		var total="";
		var pilih_jum_jad=$("#jdwll_siang").val();
		total=jum_kar-pilih_jum_jad;
		//document.getElementById('jdwl_siang').options[total-1].text = total;
		$('#jdwll_pgi').val(total).trigger("chosen:updated");
		var jadwlPagi=[
							["Pagi","Lembur","Siang","Pagi","Libur","Pagi","Siang","Siang"],
							["Pagi","Libur","Pagi","Siang","Siang","Pagi","Lembur","Siang"],
							["Pagi","Siang","Siang","Pagi","Lembur","Siang","Pagi","Libur"]
						];
		var jadwlSiang=[
								["Siang","Pagi","Libur","Pagi","Siang","Siang","Pagi","Lembur"],
								["Siang","Siang","Pagi","Lembur","Siang","Pagi","Libur","Pagi"],
								["Siang","Pagi","Lembur","Siang","Pagi","Libur","Pagi","Siang"]
									];
		var m=0;
		var l=0;
		var h=0;
		var g=0;
		for (var i = 0; i <pilih_jum_jad ; i++) {
		var h=m++;
		if(h>2){
			h=0;
		}
		for (var j = 0; j < 7; j++) {
		// document.getElementById('jadwl-A-'+i+'-'+j).options[0].text = jadwlSiang[h][j];
		// var tgl_akhr=document.getElementById('jadwl-A-'+i+'-'+j).options[0].value = jadwlSiang[h][j];
			$('#jadwll-A-'+i+'-'+j).val(jadwlSiang[h][j]).trigger("chosen:updated");
		}
		}
		for (var y = 0; y <total ; y++) {
		var g=l++;
		if(g>2){
		g=0;
		}
		var a=i++;
		for (var j = 0; j < 7; j++) {
		// document.getElementById('jadwl-A-'+a+'-'+j).options[0].text = jadwlPagi[g][j];
		// var tgl_akhr=document.getElementById('jadwl-A-'+a+'-'+j).options[0].value = jadwlPagi[g][j];
		$('#jadwll-A-'+a+'-'+j).val(jadwlPagi[g][j]).trigger("chosen:updated");
		}
		}
	}

	function Hapus_jadwall(myForm){
		for (var j = 1; j <= 7; j++) {
			$('#jadwll-A-'+myForm+'-'+j).val("").trigger("chosen:updated");
		}
		$('#nama_karyaa-'+myForm).val("").trigger("chosen:updated");


	}
	</script>
