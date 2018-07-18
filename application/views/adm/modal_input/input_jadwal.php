<!-- ini bagian modal inputan jadwal yang tadi di klik -->
<!-- Modal -->

	<div id="myModalInputJadwal" class="modal fade" role="dialog">
		<div class="modal-dialog" style="width:75%;">
			<!-- konten modal-->
			<div class="modal-content">
				<!-- heading modal -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Input Jadwal Pegawai</h4>
				</div>


				<script type="text/javascript">
				function pilih_bulan(myForm){
					var selIndex=myForm.ListBulan.selectedIndex;

					var tgl=0;
					var j=0
					if (selIndex==0) {
						var tanggal_awl=<?php echo $tgl_awl;?>;
						var tanggal_akhr=<?php echo $tgl_akhr;?>;
						for (var i = tanggal_awl; i <= tanggal_akhr; i++) {

						// alert(t++);
						tgl=j++;
						//document.getElementsByName('tgl_awl')[0].options[tgl].innerHTML = i;
						//document.getElementsByName('tgl_akhr')[0].options[tgl].innerHTML = i;
						document.getElementById('tgl_awl').options[tgl].text = i;
						document.getElementById('tgl_awl').options[tgl].value = i;
						document.getElementById('tgl_akhr').options[tgl].text = i;
						document.getElementById('tgl_akhr').options[tgl].value = i;

						}
					}else if (selIndex==1) {
						var tanggal_awl=1;
						var tanggal_akhr=<?php echo $tgl_akhr_dpn;?>;
						var option = document.createElement("option");
						for (var i = tanggal_awl; i <=tanggal_akhr ; i++) {
							tgl=j++;
							document.getElementById('tgl_awl').options[tgl].text = i;
							var tgl_awl=document.getElementById('tgl_awl').options[tgl].value = i;
							document.getElementById('tgl_akhr').options[tgl].text = i;
							var tgl_akhr=document.getElementById('tgl_akhr').options[tgl].value = i;
							//if()

						}
					//alert($("#tgl_awl")[0].selectedIndex);
						// var selectedValue=document.getElementById('tgl_awl').options[0].value = 'box';
						// alert(selectedValue);
						// document.getElementsByName('tgl_awl')[0].options[3].innerHTML = "Water";


					}
				}

				</script>

				<!-- body modal -->
				<div class="modal-body" >
          <div class="content">
              <form action="<?php echo base_url().'index.php/Admin/crud/tambah_jadwal';?>" method="post">


                  <div class="row">
                      <div class="col-md-2">
                          <div class="form-group">
                              <label>Pagi</label>
                              <select class="form-control" name="jns_jdwl" id="jdwl_pgi" onChange="pilih_jadwal1()">
																	<?php for ($i=0; $i <=$jum_kary ; $i++) : ?>
		                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
																	<?php endfor; ?>
                              </select>
                          </div>
                      </div>
											<div class="col-md-2">
												<div class="form-group">
														<label>Siang</label>
														<select class="form-control" name="jns_jdwl" id="jdwl_siang" onChange="pilih_jadwal2()">
															<?php for ($i=0; $i <=$jum_kary ; $i++) : ?>
																<option value="<?php echo $i; ?>"><?php echo $i ?></option>
															<?php endfor; ?>
														</select>
												</div>
											</div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label>Bulan</label>
															<?php if (count($bulan)<2) {?>
															<input name="bulan" type="text" class="form-control border-input" readonly placeholder="bulan" value="<?php echo $bln_skrg;?>">
															<?php }elseif (count($bulan)>=2) { ?>
															<select class="form-control" name="bulan" id="ListBulan" onChange="pilih_bulan(this.form)">
																<?php foreach ($bulan as $bulan): ?>
                                <option value="<?php echo $bulan;?>"><?php echo $bulan;?></option>
																<?php endforeach; ?>
                              </select>
														<?php } ?>
                          </div>
                      </div>

                      <div class="col-md-4">
                          <div class="form-group">
                              <label>Tahun</label>
                              <input name="tahun" type="text" class="form-control border-input" readonly placeholder="tahun" value="<?php echo $tahun;?>">
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label>Tanggal Mulai</label>
															<select class="form-control" name="tgl_awl" id="tgl_awl">
																<?php for($i=$tgl_awl;$i<=$tgl_akhr;$i++){ ?>
																<option value="<?php echo $i;?>"><?php echo $i; ?></option>
															<?php } ?>
															</select>
                          </div>
                      </div>

                      <div class="col-md-4">
                          <div class="form-group">
                              <label>Tanggal Akhir</label>
															<select class="form-control" name="tgl_akhr" id="tgl_akhr">
																<?php for($i=$tgl_awl;$i<=$tgl_akhr;$i++){ ?>
																<option value="<?php echo $i;?>"><?php echo $i; ?></option>
															<?php } ?>
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
													<?php for ($i=0; $i <$jum_kary ; $i++) : ?>
													<tr>
														<td><input type="button" class="btn btn-danger" name="" value="Hapus" onClick="Hapus_jadwall(<?php echo $i?>)"> </td>
														<td><select class="form-control" name="nama_karya-<?php echo $i;?>" id="nama_karya-<?php echo $i;?>">
															<option  value=""></option>
															<?php foreach ($nama_pgw as $nama): ?>
															<option  value="<?php echo $nama->kd_kar;?>"><?php echo $nama->nam_kar ?></option>
															<?php endforeach; ?>
														</select></td>
														<?php for ($j=0; $j <7 ; $j++) : ?>
														<td><select class="form-control" name="jadwl-<?php echo "A-".$i."-".$j;  ?>" id="jadwl-<?php echo "A-".$i."-".$j;  ?>">
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
	function pilih_jadwal1(){
		var jum_kar=<?php echo $jum_kary; ?>;

		var pilih_jum_jad=$("#jdwl_pgi").val();
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

		$('#jdwl_siang').val(total).trigger("chosen:updated");
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

					// document.getElementById('jadwl-A-'+i+'-'+j).options[0].text = jadwlPagi[h][j];
					// var tgl_akhr=document.getElementById('jadwl-A-'+i+'-'+j).options[0].value = jadwlPagi[h][j];
					$('#jadwl-A-'+i+'-'+j).val(jadwlPagi[h][j]).trigger("chosen:updated");
				}
			}
			for (var y = 0; y <total ; y++) {
					var g=l++;
					if(g>2){
						g=0;
					}
					var a=i++;
				for (var j = 0; j < 7; j++) {
					// document.getElementById('jadwl-A-'+a+'-'+j).options[0].text = jadwlSiang[g][j];
					// var tgl_akhr=document.getElementById('jadwl-A-'+a+'-'+j).options[0].value = jadwlSiang[g][j];
						$('#jadwl-A-'+a+'-'+j).val(jadwlSiang[g][j]).trigger("chosen:updated");
				}
			}
	}
	function pilih_jadwal2(){
		var jum_kar=<?php echo $jum_kary; ?>;
		var total="";
		var pilih_jum_jad=$("#jdwl_siang").val();
		total=jum_kar-pilih_jum_jad;
		//document.getElementById('jdwl_siang').options[total-1].text = total;
		$('#jdwl_pgi').val(total).trigger("chosen:updated");
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
			$('#jadwl-A-'+i+'-'+j).val(jadwlSiang[h][j]).trigger("chosen:updated");
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
		$('#jadwl-A-'+a+'-'+j).val(jadwlPagi[g][j]).trigger("chosen:updated");
		}
		}
	}

	function Hapus_jadwall(myForm){
		for (var j = 0; j < 7; j++) {
			$('#jadwl-A-'+myForm+'-'+j).val("").trigger("chosen:updated");
		}
		$('#nama_karya-'+myForm).val("").trigger("chosen:updated");


	}
	</script>
