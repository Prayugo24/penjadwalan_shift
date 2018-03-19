<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class auth extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
    $this->load->library('session');
		$this->load->model('cek_login');

	}

	function index(){
		$this->load->view('lgn');

	}

	function cekLogin(){
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		 $cekLoginn=$this->cek_login->cekLogin($username,$password);
		//$cekUser=$this->cek_login->login_cek_nama($username);
		if ($cekLoginn) {
				foreach ($cekLoginn as $rows) ;
					$this->session->set_userdata('username',$rows->username);
					$this->session->set_userdata('level',$rows->level);

					if($this->session->userdata('level')=='admin'){
						redirect('Admin/dashboard/index');
					}else if($this->session->userdata('level')=='member'){
						redirect('member/index');
					}
		}else {
			$data['pesan']="username atau password tidak sesuai";
			$this->load->view('lgn',$data);
		}



	}
	function logout(){
		$this->session->sess_destroy();
	}

}
