<?php
// buat buat khusus modal untuk jadwalnya
defined('BASEPATH') OR exit('No direct script access allowed');

class crud_j extends CI_Model {

// untuk cek button meu nav aktif
  function tampil_data_jadwal(){
  return $this->db->get('tv_jadwal');
  }
  function tampil_data_pegawai2($where,$tabel){
    return $this->db->get_where($tabel,$where);
  }

// untuk input data jadwal/ data waktu
  function input_data($data,$table){
    $this->db->insert($table,$data);
  }
// ------------untuk mencari data jadwal----------------
  function cari_jadwal_kar($where1,$where2,$where3,$where4){
    $this->db->select('jadwal,kd_jdwl');
    $this->db->from('tv_jadwal');
    $this->db->where('kd_kar',$where1);
    $this->db->where('tanggal',$where2);
    $this->db->where('bulan',$where3);
    $this->db->where('tahun',$where4);
    $query=$this->db->get();

    return $query;
  }


  // function cari_jumlah_kar(){
  //   $this->db->select('COUNT(kd_kar) as total');
  //   $this->db->from('tb_karyawan');
  //   $query =$this->db->get();
  //   return $query;
  // }
  // ------------untuk mencari kode karyawan----------------
  function cari_kode_kar(){
    $this->db->distinct();
    $this->db->select('kd_kar');
    $this->db->from('tv_jadwal');
    $query =$this->db->get();
    return $query;
  }
  // ------------untuk mencari jumlah karyawan di tabl tv_jadwal----------------
  function cari_jml_kd_kary(){
    $this->db->select('count(distinct(kd_kar)) as jml_kar');
    $this->db->from('tv_jadwal');
    $query =$this->db->get();
    return $query;
  }
// ------------untuk mencari jumlah tanggal di tv_jadwal dan di saring----------------
  function cari_jml_tanggal($where1,$where2){
    $this->db->select('count(distinct(tanggal)) as jml_tanggal');
    $this->db->from('tv_jadwal');
    $this->db->where('bulan',$where1);
    $this->db->where('bulan',$where1);
    $query =$this->db->get();
    return $query;
  }
  // ------------untuk mencari tahun di tv_jadwal dan disaring----------------
  function cari_tahun(){
    $this->db->select('distinct(tahun) as tahun');
    $this->db->from('tv_jadwal');
    $query=$this->db->get();
    return $query;
  }
  // ------------untuk mencari data bulan di tv_jadwal dan disaring---------------
  function cari_bulan($tahun){
    $this->db->select('distinct(bulan) as bulan');
    $this->db->from('tv_jadwal');
    $this->db->where('tahun',$tahun);
    $query=$this->db->get();
    return $query;
  }
// ------------untuk mencari data tanggal di tv_jadwal dan di saring----------------
  function tanggal_cari($kd_kar,$bulan,$tahun){
    $this->db->select('tanggal');
    $this->db->from('tv_jadwal');
    $this->db->where('kd_kar',$kd_kar);
    $this->db->where('bulan',$bulan);
    $this->db->where('tahun',$tahun);
    $query=$this->db->get();
    return $query->result();
  }
// ------------untuk mengedit data di tv_jadwal ----------------
  function edit_jadwal($where,$data){
    $this->db->where($where);
    $this->db->update('tv_jadwal',$data);
    }
// ------------untuk menghapus data di tv_jadwal ----------------
    function hapus_data_jadwal($where,$table){
  		$this->db->where($where);
  		$this->db->delete($table);
  	}

    // function cari_password_lama($pass){
    //   $this->db->select('password');
    //   $this->db->From('super_user');
    //   $this->db->where('password',$pass);
    //   $this->db->limit(1);
    //
    //   $query=$this->db->get();
    //
    //   if($query->num_rows()==1){
    //     return $query->result();
    //   }else {
    //     return false;
    //   }
    // }
// ------------untuk mencari nama karyawan dan di samakan dng tv_jadwal----------------
  function cari_nama_karyawan($where){
    $this->db->select("nam_kar,kd_kar");
    $this->db->from("tb_karyawan");
    $this->db->where("kd_kar",$where);
    $query=$this->db->get();
    return $query;
  }


//   function cari_tanggal_kode($where1,$where2,$where3){
//     $this->db->select('kd_waktu');
//     $this->db->from('tb_waktuu');
//     $this->db->where('tanggal',$where1);
//     $this->db->where('bulan',$where2);
//     $this->db->where('tahun',$where3);
//
//     $query=$this->db->get();
//     return $query;
//   }


  //untuk mencari kode unik jadwal
    function cari_kode_jadwal(){
      $this->db->select('RIGHT(tv_jadwal.kd_jdwl,4) as kode',false );
      $this->db->order_by('kd_jdwl','DESC');
      $this->db->limit(1);
      $query=$this->db->get('tv_jadwal');//cek apakah id atau tidak
      if ($query->num_rows()<>0) {
        // jika kode ternyata sudah add
        $data=$query->row();
        $kode=intval($data->kode)+1;
      }else {
        // jika kode bl ada
        $kode=1;
      }

       $kodeMax=str_pad($kode,4,"0",STR_PAD_LEFT);//angka 4 menunjukan jumlah angka digit 0
      $kodeJadi="KD_JAD-".$kodeMax;
      return $kodeJadi;
    }
    //untuk mencari kode unik tb_waktu
      // function cari_kode_waktu(){
      //   $this->db->select('RIGHT(tb_waktuu.kd_waktu,4) as kode',false );
      //   $this->db->order_by('kd_waktu','DESC');
      //   $this->db->limit(1);
      //   $query=$this->db->get('tb_waktuu');//cek apakah id atau tidak
      //   if ($query->num_rows()<>0) {
      //     // jika kode ternyata sudah add
      //     $data=$query->row();
      //     $kode=intval($data->kode)+1;
      //   }else {
      //     // jika kode bl ada
      //     $kode=1;
      //   }
      //
      //    $kodeMax=str_pad($kode,4,"0",STR_PAD_LEFT);//angka 4 menunjukan jumlah angka digit 0
      //   $kodeJadi="WT-".$kodeMax;
      //   return $kodeJadi;
      // }
// ------------untuk mengecek waktu pada tv_jadwal ada atau tidak----------------
      function cekWaktu($tanggl,$buln,$tahn,$kd_kary){

   		$this->db->select('tanggal,bulan,tahun,kd_kar');
   		$this->db->from('tv_jadwal');
   		$this->db->where('tanggal',$tanggl);
   		$this->db->where('bulan',$buln);
      $this->db->where('tahun',$tahn);
      $this->db->where('kd_kar',$kd_kary);
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
