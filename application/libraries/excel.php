<?php
 if (!defined('BASEPATH'))  exit('No direct script access allowed');
/*
* ===========================================
* Author      : Prayugo Dwi S
* License     : Protected
* Email       :--------
* Dilarang merubah, mengganti dan mendistribusikan
* ulang tanpa sepengetahuan Author
* ===========================================

*/

// require_once APPPATH."/third_party/PHPExcel.php";
 require_once APPPATH.'/third_party/PHPExcel.php';

class Excel extends PHPExcel
{

public function __construct()
  {
    parent::__construct();

        //$this->excel = new PHPExcel();
  }
}



 ?>
