<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class crud_s extends CI_Model {

// untuk cek button meu nav aktif
  function tampil_data_super_user(){
  return $this->db->get('super_user');
  }
// untuk input data pegawai


  function cari_jumlah_kar(){
    $this->db->select('COUNT(kd_kar) as total');
    $this->db->from('tb_karyawan');
    $query =$this->db->get();
    return $query;
    }

    function edit_data_super_usr($where,$data){
      $this->db->where($where);
      $this->db->update('super_user',$data);
      }

      function cari_password_lama($pass){
        $this->db->select('password');
        $this->db->From('super_user');
        $this->db->where('password',$pass);
        $this->db->limit(1);

        $query=$this->db->get();

        if($query->num_rows()==1){
          return $query->result();
        }else {
          return false;
        }
      }

}
?>
