<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class nex_page extends CI_Controller {


  function dashboard(){
    redirect('Admin/dashboard/index');
  }
function pegawai(){
  redirect('Admin/dashboard/pegawai');
}
function setting(){
	redirect('Admin/dashboard/setting');
}
function jadwal(){
	redirect('Admin/dashboard/jadwal');
}

function logOut(){
  $this->session->sess_destroy();
  redirect('auth/index');
}


}
