
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-5">
                        <div class="card card-user">
                            <div class="image">
                                <img src="<?php echo base_url('assets/image/city-wallpaper-18.jpg');?>"  alt="..."/>
                            </div>
                            <div class="content">
                                <div class="author">
                                  <img class="avatar border-white" src="<?php echo base_url('assets/image/profil.png');?>" alt="..."/>
                                  <h4 class="title">Cv Trans Jogja<br />
                                     <a href="#"><small>Admin</small></a>
                                  </h4>
                                </div>
                                <p class="description text-center">
                                    <?php foreach ($super_usr as $admin ) {
                                      echo $admin->nama;
                                    }  ?>
                                </p>
                            </div>
                            <hr>
                            <div class="text-center">
                                <div class="row">
                                    <div class="col-md-12">
                                      <?php foreach ($jml_kar as $jml): ?>
                                        <h5> <?php echo $jml->total; ?> <br /><small>Jumlah Pegawai</small></h5>
                                      <?php endforeach; ?>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-8 col-md-7">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Edit Setting</h4>
                            </div>
                            <div class="content">
                                <form action="<?php echo base_url().'index.php/Admin/crud/edit_super_usr';?>" method="post">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Company</label>
                                                <input type="text" class="form-control border-input" disabled placeholder="Company" value="Cv Trans Jogja">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" class="form-control border-input" required placeholder="Nama" value="" name="nama_su" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Username</label>
                                                <input type="text" class="form-control border-input" required placeholder="Username" name="username" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Password Lama</label>
                                                <input type="password" class="form-control border-input" required placeholder="******" value="" name="pasword_lama" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Password Baru</label>
                                                <input type="password" class="form-control border-input" required placeholder="*****" value="" name="Password_baru" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-info btn-fill btn-wd">Edit Setting</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
