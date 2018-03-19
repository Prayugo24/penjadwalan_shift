<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cek_session extends CI_Model {

// untuk cek button meu nav aktif
	 function cek_session_dasboard(){
		 if ($this->session->set_userdata('class0')=='') {
 			$this->session->set_userdata('class0','active');
 			$this->session->unset_userdata('class2');
 			$this->session->unset_userdata('class1');
 			$this->session->unset_userdata('class3');
 			$this->session->unset_userdata('class4');
 		}elseif ($this->session->set_userdata('class1')=='active') {
			$this->session->unset_userdata('class2');
			$this->session->unset_userdata('class1');
			$this->session->unset_userdata('class3');
			$this->session->unset_userdata('class4');
			$this->session->set_userdata('class0','active');
		}elseif ($this->session->set_userdata('class2')=='active') {
			$this->session->unset_userdata('class2');
			$this->session->unset_userdata('class1');
			$this->session->unset_userdata('class3');
			$this->session->unset_userdata('class4');
			$this->session->set_userdata('class0','active');
		}elseif ($this->session->set_userdata('class3')=='active') {
			$this->session->unset_userdata('class2');
			$this->session->unset_userdata('class1');
			$this->session->unset_userdata('class3');
			$this->session->unset_userdata('class4');
			$this->session->set_userdata('class0','active');
		}elseif ($this->session->set_userdata('class4')=='active') {
			$this->session->unset_userdata('class2');
			$this->session->unset_userdata('class1');
			$this->session->unset_userdata('class3');
			$this->session->unset_userdata('class4');
			$this->session->set_userdata('class0','active');
		}

	}
  function cek_session_pegawai(){
		if ($this->session->set_userdata('class1')=='') {
		 $this->session->set_userdata('class1','active');
		 $this->session->unset_userdata('class2');
		 $this->session->unset_userdata('class0');
		 $this->session->unset_userdata('class3');
		 $this->session->unset_userdata('class4');
	 }elseif ($this->session->set_userdata('class0')=='active') {
 			$this->session->unset_userdata('class2');
 			$this->session->unset_userdata('class0');
 			$this->session->unset_userdata('class3');
 			$this->session->unset_userdata('class4');
 			$this->session->set_userdata('class1','active');
 		}elseif ($this->session->set_userdata('class2')=='active') {
  			$this->session->unset_userdata('class2');
  			$this->session->unset_userdata('class0');
  			$this->session->unset_userdata('class3');
  			$this->session->unset_userdata('class4');
  			$this->session->set_userdata('class1','active');
  		}elseif ($this->session->set_userdata('class3')=='active') {
	  			$this->session->unset_userdata('class2');
	  			$this->session->unset_userdata('class0');
	  			$this->session->unset_userdata('class3');
	  			$this->session->unset_userdata('class4');
	  			$this->session->set_userdata('class1','active');
	  		}
				elseif ($this->session->set_userdata('class4')=='active') {
		  			$this->session->unset_userdata('class2');
		  			$this->session->unset_userdata('class0');
		  			$this->session->unset_userdata('class3');
		  			$this->session->unset_userdata('class4');
		  			$this->session->set_userdata('class1','active');
		  		}
  }

	function cek_session_jadwal(){
		if ($this->session->set_userdata('class2')=='') {
			$this->session->set_userdata('class2','active');
			$this->session->unset_userdata('class0');
			$this->session->unset_userdata('class1');
			$this->session->unset_userdata('class3');
			$this->session->unset_userdata('class4');
		}elseif ($this->session->set_userdata('class0')=='active') {
			$this->session->unset_userdata('class0');
			$this->session->unset_userdata('class1');
			$this->session->unset_userdata('class3');
			$this->session->unset_userdata('class4');
			$this->session->set_userdata('class2','active');
		}elseif ($this->session->set_userdata('class1')=='active') {
			$this->session->unset_userdata('class0');
			$this->session->unset_userdata('class1');
			$this->session->unset_userdata('class3');
			$this->session->unset_userdata('class4');
			$this->session->set_userdata('class2','active');
		}elseif ($this->session->set_userdata('class3')=='active') {
			$this->session->unset_userdata('class0');
			$this->session->unset_userdata('class1');
			$this->session->unset_userdata('class3');
			$this->session->unset_userdata('class4');
			$this->session->set_userdata('class2','active');
		}
		elseif ($this->session->set_userdata('class4')=='active') {
			$this->session->unset_userdata('class0');
			$this->session->unset_userdata('class1');
			$this->session->unset_userdata('class3');
			$this->session->unset_userdata('class4');
			$this->session->set_userdata('class2','active');
		}

	}
	function cek_session_cetak(){
		if ($this->session->set_userdata('class3')=='') {
			$this->session->set_userdata('class3','active');
			$this->session->unset_userdata('class0');
			$this->session->unset_userdata('class1');
			$this->session->unset_userdata('class2');
			$this->session->unset_userdata('class4');
		}elseif ($this->session->set_userdata('class0')=='active') {
			$this->session->unset_userdata('class0');
			$this->session->unset_userdata('class1');
			$this->session->unset_userdata('class2');
			$this->session->unset_userdata('class4');
			$this->session->set_userdata('class3','active');
		}elseif ($this->session->set_userdata('class1')=='active') {
			$this->session->unset_userdata('class0');
			$this->session->unset_userdata('class1');
			$this->session->unset_userdata('class2');
			$this->session->unset_userdata('class4');
			$this->session->set_userdata('class3','active');
		}elseif ($this->session->set_userdata('class2')=='active') {
			$this->session->unset_userdata('class0');
			$this->session->unset_userdata('class1');
			$this->session->unset_userdata('class2');
			$this->session->unset_userdata('class4');
			$this->session->set_userdata('class3','active');
		}elseif ($this->session->set_userdata('class4')=='active') {
			$this->session->unset_userdata('class0');
			$this->session->unset_userdata('class1');
			$this->session->unset_userdata('class2');
			$this->session->unset_userdata('class4');
			$this->session->set_userdata('class3','active');
		}
	}

  function cek_session_setting(){
		if ($this->session->set_userdata('class4')=='') {
			$this->session->set_userdata('class4','active');
			$this->session->unset_userdata('class0');
			$this->session->unset_userdata('class1');
			$this->session->unset_userdata('class2');
			$this->session->unset_userdata('class3');
		}elseif ($this->session->set_userdata('class0')=='active') {
			$this->session->unset_userdata('class0');
			$this->session->unset_userdata('class1');
			$this->session->unset_userdata('class2');
			$this->session->unset_userdata('class3');
			$this->session->set_userdata('class4','active');
		}elseif ($this->session->set_userdata('class1')=='active') {
			$this->session->unset_userdata('class0');
			$this->session->unset_userdata('class1');
			$this->session->unset_userdata('class2');
			$this->session->unset_userdata('class3');
			$this->session->set_userdata('class4','active');
		}elseif ($this->session->set_userdata('class2')=='active') {
			$this->session->unset_userdata('class0');
			$this->session->unset_userdata('class1');
			$this->session->unset_userdata('class2');
			$this->session->unset_userdata('class3');
			$this->session->set_userdata('class4','active');
		}elseif ($this->session->set_userdata('class3')=='active') {
			$this->session->unset_userdata('class0');
			$this->session->unset_userdata('class1');
			$this->session->unset_userdata('class2');
			$this->session->unset_userdata('class3');
			$this->session->set_userdata('class4','active');
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
