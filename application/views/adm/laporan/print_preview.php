
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <!-- Bootstrap core CSS     -->
    <link href=<?php  echo base_url("assets/css/bootstrap.min.css"); ?> rel="stylesheet" />


    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <style media="print">

        table{
          border-collapse: collapse;
        }
        .jadwal td{
          padding: 20px;
        }
        .jadwal th{
          background-color: rgb(137, 196, 120)!important;
          text-align: center;
          vertical-align: middle !important;
          padding: 5px;
        }

    </style>
    <style media="screen">
        body{
          margin: 100px 100px;
        }
        table{
          border-collapse: collapse;
        }
        .jadwal td{
          text-align: center;
          padding: 20px;
        }
        .jadwal th{
          background-color: rgb(137, 196, 120)!important;
          vertical-align: middle !important;
          text-align: center;
          padding: 5px;
        }
    </style>


  </head>
  <body onload="window.print()" >

    <table  width="100%"  >
      <tr >
        <td align="center"><b><h2>JADWAL DRIVER OPERSIONAL</h2></b></td>
      </tr>
      <tr>
        <td align="center"><b><h3>CV. JOGJATRANSPORT REST CAR</h3></b></td>
      </tr>
      <tr>
        <td align="center"><b><h4>PERIODE <?php echo $bulan." ".$tahun; ?></b></h4></td>
      </tr>
    </table>
    <br>
    <br>
    <?php $nm=0;
        $tgl=0;
        $hari=0;
    ?>
    <?php for ($u=0; $u <=$jadwl_jum ; $u++) { ?>
      <?php $jum_tabl_tgl=$jum_tabl_tgl+7; ?>
      <div class="jadwal">

    <table class="table table-bordered table-striped " align="Justify" >

      <thead align="center">

        <tr align="center">
          <th rowspan="2" align="center">No</th>
          <th rowspan="2" align="center"><b>Nama</b></th>
            <?php for ($i=0; $i <$jum_row ; $i++) {?>
          <th align="center"><?php echo $tanggal[$tgl++]; ?></th>
            <?php } ?>
        </tr>


        <tr >
          <?php for ($i=0; $i <$jum_row ; $i++) {?>
          <th align="center"><?php echo $data_hari[$hari++]; ?></th>
        <?php } ?>
        </tr>
      </thead>

    <tbody>
      <?php $no=1; ?>
      <?php  for ($i=0; $i <$jum_kd_kar ; $i++) { ?>

      <tr align="center">
        <td><?php echo $no++; ?></td>
        <td><?php echo $nam_karya[$i]; ?></td>

        <?php for ($j=$nm; $j <$jum_tabl_tgl ; $j++) { ?>
          <?php if($jadwal_pgw[$i][$j]=="Libur"){
            $color="#ed8b8b";
          }elseif ($jadwal_pgw[$i][$j]=="Pagi") {
            $color="#d9edf7";
          }elseif ($jadwal_pgw[$i][$j]=="Siang") {
            $color="#f4d341";
          }elseif ($jadwal_pgw[$i][$j]=="Lembur") {
            $color="#8bed90";
          }
          else {
            $color="";
          }?>
           <td style="background:<?php echo $color; ?> !important;"><?php echo $jadwal_pgw[$i][$j]; ?><br>
             <?php echo $jadwal_jam[$i][$j]; ?>
           </td>

      <?php } ?>
      </tr>
      <?php } ?>
    </tbody>
    <tfoot>

    </tfoot>
    </table>

    <br>
    <br>
    <br>
    <?php  $nm=$nm+7; ?>
    </div>
  <?php } ?>

  </body>

</html>
