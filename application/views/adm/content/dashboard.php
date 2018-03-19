<!--  ini bagian tampilan isi jadwal-->
<div class="content">
    <div class="container-fluid">
<div class="col-lg-12 col-md-12">
  <div class="row">
    <div class="col-lg-4 col-md-5">
      <br><br>
      <a href="<?php echo base_url().'index.php/nex_page/pegawai';?>">
        <div class="card card-user">
            <div class="content">
                <div class="author">
                  <img class="avatar border-white" src="<?php echo base_url('assets/image/pegawai.png');?>" alt="..."/>
                  <h4 class="title">Data Pegawai<br />
                  </h4>
                </div>
            </div>
        </div>
        </a>
    </div>


    <div class="col-lg-4 col-md-5">
      <br><br>
      <a href="<?php echo base_url().'index.php/nex_page/jadwal';?>">
        <div class="card card-user">
            <div class="content">
                <div class="author">
                  <img class="avatar border-white" src="<?php echo base_url('assets/image/jadwal.png');?>" alt="..."/>
                  <h4 class="title">Jadwal Pegawai<br />
                  </h4>
                </div>

            </div>
        </div>
        </a>
    </div>

    <div class="col-lg-4 col-md-5">
      <br><br>
      <a href="" data-toggle="modal" data-target="#myModalCetakJadwal">
        <div class="card card-user">
            <div class="content">
                <div class="author">
                  <img class="avatar border-white" src="<?php echo base_url('assets/image/print.png');?>" alt="..."/>
                  <h4 class="title">Cetak Jadwal<br />
                  </h4>
                </div>

            </div>
        </div>
        </a>
    </div>

  </div>
    <div class="card">
        <div class="content">
          <div class="row">
            <div class="row">
              <div class="col-md-6">
              </div>
              <div class="col-md-6">
                <h4 class="title" style="float:right; margin-right:50px;"><b><?php echo $bulan." ".$tahun; ?></b></h4>
              </div>
            </div>
            <div class="col-md-6">
                <h3 class="title" style="margin-left:50px;"><b>Jadwal Pegawai</b></h3>
            </div>

          <div class="col-md-6">
            <input type="text" class="light-table-filter form-control border-input " data-table="order-table" placeholder="Cari..." >
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
