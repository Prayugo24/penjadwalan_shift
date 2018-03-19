<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class crud_m extends CI_Model {

// untuk cek button meu nav aktif
  function tampil_data_pegawai(){
  return $this->db->get('tb_karyawan');
  }
  function tampil_data_pegawai2($where,$tabel){
    return $this->db->get_where($tabel,$where);
  }

// untuk input data pegawai
  function input_data($data,$table){
    $this->db->insert($table,$data);

  }
//untuk mencari kode unik pegawai
  function cari_kode_pegawai(){
    $this->db->select('RIGHT(tb_karyawan.kd_kar,4) as kode',false );
    $this->db->order_by('kd_kar','DESC');
    $this->db->limit(1);
    $query=$this->db->get('tb_karyawan');//cek apakah id atau tidak
    if ($query->num_rows()<>0) {
      // jika kode ternyata sudah add
      $data=$query->row();
      $kode=intval($data->kode)+1;
    }else {
      // jika kode bl ada
      $kode=1;
    }

     $kodeMax=str_pad($kode,4,"0",STR_PAD_LEFT);//angka 4 menunjukan jumlah angka digit 0
    $kodeJadi="KD_KAR-".$kodeMax;
    return $kodeJadi;
  }
// untuk mengedit data pegawai
  function edit_data_pegawai($where,$data,$tabel){
    $this->db->where($where);
		$this->db->update($tabel,$data);
  }
// untuk menghapus data pegawai
  function hapus_data_pegawai($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}

}
