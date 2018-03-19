<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


	public function index()
	{
		// $data=$this->db->query('select * from mahasiswa');
		// foreach ($data ->result_array() as $d) {
		// 	echo "nama : ".$d['nama'].'<br>';
		// }
		//
		// // $data=array(
		// // 	'nama'=>'prayugo',
		// // 	'alamat'=>'jogja'
		// //
		// // );
		// //  $this->load->view('Welcome_message',$data);
		//
		// //echo "Saya controler Welcome";
	}
	public function cetak($satu='ahmad',$dua='dua'){
		echo $satu.'<br>';
		echo $dua.'<br>';
	}
}
