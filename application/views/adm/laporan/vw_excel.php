<?php

 header("Content-type: application/vnd-ms-excel");

 header("Content-Disposition: attachment; filename=$title.xls");

 header("Pragma: no-cache");

 header("Expires: 0");

 ?>

 <div class="table-responsive">
 <table class="table table-condensed text-centered order-table" style="text-align: center;">
   <thead>
     <tr >
       <!--untuk nampilin nama karyawan -->
       <?php  ?>
       <th rowspan="2"><b>Nama</b></th>
       <?php for($i=0;$i<7;$i++){
        if(empty($tanggal[$i])){?>
          <th> <b><?php echo "-"; ?></b> </th>
        <?php }else{ ?>
       <th class="success"> <b><?php echo $tanggal[$i]; ?></b> </th>
       <?php }} ?>
     </tr>
     <tr>
       <!--untuk nampilin nama hari -->
       <?php for ($i=0; $i <7 ; $i++) { ?>
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
       <?php for ($j=0; $j <$jum_jad ; $j++) {?>
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
