<!--  ini bagian tampilan isi jadwal-->
<div class="content">
    <div class="container-fluid">
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="header">
          <div class="row">
            <div class="col-md-6">
              <h4 class="title" ><b>Jadwal Pegawai</b></h4>
            </div>
            <div class="col-md-6">
              <h4 class="title" style="float:right;"><b><?php echo $bulan." ".$tahun; ?></b></h4>
            </div>
          </div>

        </div>
        <div class="content">
          <div class="row">
            <div class="col-md-6">
              <a href="" class="btn btn-primary btn-fill" data-toggle="modal" data-target="#myModalInputJadwal">
                <span class="glyphicon glyphicon-pencil"></span>
                <b>Tambah Data</b>
              </a>

              <a href="" class="btn btn-warning btn-fill" data-toggle="modal" data-target="#myModaleditJadwal">
                <span class="glyphicon glyphicon-edit"></span>
                <b>Edit</b>
              </a>
              <a href="" class="btn btn-danger btn-fill" data-toggle="modal" data-target="#myModalHapusJadwal">
                <span class="glyphicon glyphicon-trash"></span>
                <b>Hapus</b>
              </a>
              <a href="" data-toggle="modal" data-target="#myModalCetakJadwal" class="btn btn-success btn-fill btn-wd" data-toggle="modal" >
                <span class="ti-printer"></span>
                <b>Cetak</b>
              </a>
            </div>

          <div class="col-md-6">
            <input type="text" class="light-table-filter form-control border-input" data-table="order-table" placeholder="Cari..." >
          </div>

          </div>
          <br>
            <div class="table-responsive">
            <table class="table table-condensed text-centered order-table" style="text-align: center;">
              <thead>
                <tr >
                  <!--untuk nampilin nama karyawan -->
                  <?php  ?>
                  <th rowspan="2"><b>Nama</b></th>
                  <?php for($i=0;$i<$jum_row_tgl;$i++){
                   if(empty($tanggal[$i])){?>
                     <th> <b><?php echo "-"; ?></b> </th>
                   <?php }else{ ?>
                  <th class="success"> <b><?php echo $tanggal[$i]; ?></b> </th>
                  <?php }} ?>
                </tr>
                <tr>
                  <!--untuk nampilin nama hari -->
                  <?php for ($i=0; $i <$jum_row_tgl ; $i++) { ?>
                    <?php if(empty($nama_hari[$i])){ ?>
                      <th> <b><?php echo "-"; ?> </b> </th>
                    <?php }else{ ?>
                  <th class="danger"> <b><?php echo $nama_hari[$i]; ?> </b> </th>
                <?php }} ?>
                </tr>
              </thhead>
              <tbody>
                <tr>
                </tr>
                <!--nampilin nama karyawan  -->
                <?php for($i=0;$i<$jum_kar;$i++) {?>
                <tr>
                  <?php if (empty($nama_kary[$i])) {?>
                  <td> <?php //echo "-"; ?> </td>
                <?php }else {?>
                  <td class="info"> <?php echo $nama_kary[$i]; ?> </td>
                <?php } ?>

                  <!--untuk nampilin jadwal -->
                  <?php for ($j=0; $j <$jum_row_tgl ; $j++) {?>
                    <?php

                    // $tbl_season="";
                    // if ($jadwal[$i][$j]=="Pagi") {
                    //   $tbl_season="info";
                    // }elseif ($jadwall=="Siang"){
                    //   $tbl_season="warning";
                    // }elseif ($jadwall=="Libur"){
                    //   $tbl_season="danger";
                    // }elseif ($jadwall=="Lembur"){
                    //   $tbl_season="active";
                    // } ?>
                  <td class="<?php //echo $tbl_season; ?>"><?php if (empty($jadwal[$i][$j])) {

          				}else {
          					echo "</br>";
          					echo $jadwal[$i][$j];
          					echo "</br>";
          				} ?></td>

                <?php } ?>

                </tr>
              <?php } ?>

              </tbody>
              <tfoot>
                <tr>

                </tr>
              </tfoot>
            </table>
            </div>
        </div>
    </div>
</div>
</div>
</div>
