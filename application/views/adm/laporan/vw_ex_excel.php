<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 ?><!DOCTYPE html>
 <html lang="en">
 <head>
      <meta charset="utf-8">
      <title><?php echo $title ?></title>
      <style>
           ::selection { background-color: #E13300; color: white; }
           ::-moz-selection { background-color: #E13300; color: white; }

           body {
                background-color: #fff;
                margin: 40px;
                font: 13px/20px normal Helvetica, Arial, sans-serif;
                color: #4F5155;
           }

           main {
                width: 80%;
                padding: 20px;
                background-color: white;
                min-height: 300px;
                border-radius: 5px;
                margin: 30px auto;
                box-shadow: 0 0 8px #D0D0D0;
           }
           table {
                border-top: solid thin #000;
                border-collapse: collapse;
           }
           th, td {
                border-top: border-top: solid thin #000;
                padding: 6px 12px;
           }

           a {
                color: #003399;
                background-color: transparent;
                font-weight: normal;
           }
      </style>
 </head>

 <body>
      <main>
           <h1>Laporan Excel</h1>
           <!-- <p><a href="<?php echo base_url('c_excel/export_excel') ?>">Export ke Excel</a></p> -->
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
      </main>
 </body>
 </html>
