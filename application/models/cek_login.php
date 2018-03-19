<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cek_login extends CI_Model {


	 function cekLogin($user,$pass){
		$username=$this->db->escape_like_str($user);
		$password=$this->db->escape_like_str($pass);
		$this->db->select('username,password,level');
		$this->db->from('super_user');
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		$this->db->limit(1);

		$query=$this->db->get();

		if($query->num_rows()==1){
			return $query->result();
		}else {
			return false;
		}



	}
  //
  // // menguji namaa
	// public function login_cek_nama($user){
	// 		$query="SELECT * From super_user where username=".$this->db->escape_like_str($user);
	// 		$select=$this->db->query($query);
	// 		if($select){
	// 			if($select->num_rows()!=0)return true;
	// 			else {
	// 				return false;
	// 			}
	// 		}
	// }
  //
	// public function cekSeason($user,$pass,$cekLogin,$cekNama){
	// 	if(!empty(trim($user))&&!empty(trim($pass))){
	// 		if($ceknama){
	// 			if(count($cekLogin)>0){
	// 				$this->session->set_userdata('jmlLogin',0);
	// 				//redirect();
	// 			}else {
	// 				$jmlLogn=$this->session->set_userdata('jmlLogin',++);
	// 				if ($jmlLogn<3) {
  //           // masuk
	// 				}else {
	// 					//blokir
	// 				}
  //
	// 			}
	// 		}else {
	// 			$this->session->set_userdata('peringatan2','akun belum terdaftar');
	// 		}else {
	// 			$this->session->set_userdata('peringatan','username dan password tidak boleh kosong');
	// 		}
	// 	}
	// }



}
