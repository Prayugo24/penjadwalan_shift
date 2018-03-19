<?php
// buat buat khusus modal untuk jadwalnya
defined('BASEPATH') OR exit('No direct script access allowed');

class cetak_jadwal extends CI_Model {


  function cari_waktu_tanggal($where1,$where2){
    $this->db->select("distinct(tanggal) as tanggal");
    $this->db->from('tv_jadwal');
    $this->db->where('bulan',$where1);
    $this->db->where('tahun',$where2);
    $query=$this->db->get();

    return $query;
  }

  


}
?>
