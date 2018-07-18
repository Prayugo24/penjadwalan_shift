<div class="content">
    <div class="container-fluid">
<div class="col-lg-12 col-md-12 ">
    <div class="card">
        <div class="header">
            <h4 class="title"><b>Data Pegawai</b></h4>
        </div>
        <div class="content">
          <div class="row">
            <div class="col-md-4">
              <a href="" class="btn btn-primary btn-fill" data-toggle="modal" data-target="#myModal">
                <span class="glyphicon glyphicon-pencil"></span>
                <b>Tambah Data</b>
                </a>
            </div>

          <div class="col-md-3">
            <!-- biar kosong -->
          </div>
          <div class="col-md-5">
            <input type="text" class="light-table-filter form-control border-input" data-table="order-table"  placeholder="Cari..." >
          </div>
          </div>
          <br>
          <div class="table-responsive">

            <table class="table table-striped  table-condensed order-table" >
              <thead>
                <tr>
                  <th class="info"><b>No</b></th>

                  <th class="info"><b>Nama</b></th>
                  <th class="info"><b>jenis Kelamin</b></th>
                  <th class="info"><b>No Hp</b></th>
                  <th class="info"><b>Status</b></th>
                  <th class="info"><b>Alamat</b></th>
                  <th class="info"><b>Status Kerja</b></th>
                  <th class="info"><b>Tanggal lahir</b></th>
                  <th class="info"><b>Status Perkawinan</b></th>
                  <th class="info"><b>Replace</b></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no=1;
                foreach ($data_pegawai as $pegawai) {
                ?>
                <tr>

                  <td class="danger"><?php echo $no++; ?></td>

                  <td><?php echo $pegawai->nam_kar; ?></td>
                  <td><?php echo $pegawai->jns_kel; ?></td>
                  <td><?php echo $pegawai->no_hp; ?></td>
                  <td><?php echo $pegawai->status; ?></td>
                  <td><?php echo $pegawai->alamat; ?></td>
                  <td><?php echo $pegawai->status_kerja; ?></td>
                  <td><?php echo $pegawai->tgl_lahir; ?></td>
                  <td><?php echo $pegawai->status_perkawinan; ?></td>
                  <?php $data=$pegawai->kd_kar; ?>
                  <td><button class="btn btn-warning btn-fill" onclick="modal_edit_pegawai('<?php echo $data;?>')">

                       <span class="glyphicon glyphicon-edit"></span>
                       Edit
                     </button>
                     <button href="" class="btn btn-danger btn-fill" onclick="Swall_Delete('<?php echo $data;?>')" >

                       <span class="glyphicon glyphicon-trash">
                         Hapus
                       </span>
                     </button>
                  </td>

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
