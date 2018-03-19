<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
    $this->load->library('session');

		$this->load->model('cek_session');
		$this->load->model('crud_m');
		$this->load->model('crud_j');
		$this->load->model('crud_s');

    if ($this->session->userdata('level')!='admin') {
			redirect('auth/index');
		}
	}

  function index(){
		// ceksession panah menu
		$tahun= Date("Y");
		$bulan= Date("n");
		
	$this->cek_session->cek_session_dasboard();
	// untuk menyesuaikan waktu zona indonesia
	date_default_timezone_set('Asia/Jakarta');
// ----------------------------------------------------------------------
	// meng generate tanggal sekarang sampai tanggal akhir bulan
	// mencari hari
	$dayList = array(
		'Sun' => 'Minggu',
		'Mon' => 'Senin',
		'Tue' => 'Selasa',
		'Wed' => 'Rabu',
		'Thu' => 'Kamis',
		'Fri' => 'Jumat',
		'Sat' => 'Sabtu'
	);
	$tgl_hari_ini=Date("j");
	$tgl_terakhir=Date("t");
	$tgl=0;
	$hr=1;
	for ($i=$tgl_hari_ini; $i<=$tgl_terakhir ; $i++) {
	$tanggal[$tgl++]=$i	;
	// menentukan jumlah hari pada tgl sekarang sampai tanggal terakhir
	$jml_hri=$hr++;
	}
	$jum_tabl_tgl=$jml_hri;
	if ($jum_tabl_tgl>7) {
		$jum_tabl_tgl=7;
	}elseif ($jum_tabl_tgl<7) {
		$jum_tabl_tgl=$jml_hri;
	}elseif (empty($jum_tabl_tgl)) {
		$jum_tabl_tgl=1;
	}

	// untuk mencari nama hari di tampung di data_hari
	for($i=0;$i<$jml_hri;$i++){
		$time[$i] = mktime(0, 0, 0, date("m"), date("d")+$i,  date("Y"));
	 $hari[$i]=date("D", $time[$i]);
	 $data_hari[$i]=$dayList[$hari[$i]];
	}
// --------------------------------------------------------------------------
	// mencari kode tanggal pada tabel waktu
	$tahun= Date("Y");
	$bulan= Date("n");
	$bulanList=array(
		"1"=>"januari",
		"2"=>"Februari",
		"3"=>"Maret",
		"4"=>"April",
		"5"=>"Mei",
		"6"=>"Juni",
		"7"=>"Juli",
		"8"=>"Agustus",
		"9"=>"September",
		"10"=>"Oktober",
		"11"=>"November",
		"12"=>"Desember",
	);
	$kod=0;
	$jum_jad=0;

		// mencari kode tanggal pada tabel waktu
// 		$kde_tgl=array();
// 	for ($i=0; $i<7 ; $i++) {
// 	$kode_tgl=($this->crud_j->cari_tanggal_kode($tanggal[$i],$bulanList[$bulan],$tahun)->result());
// 	foreach ($kode_tgl as $kd_tgl) {
// 		$kde_tgl[$i]=$kd_tgl->kd_waktu;
// 		if(empty($kde_tgl[$i])){
// 		$jum_jad=0;
// 	}elseif (count($kde_tgl[$i])>7) {
// 		$jum_jad=7;
// 	}else {
// 		$jum_jad=count($kde_tgl);
// 	}
// 	}
// }
// print_r($kde_tgl);
	// untuk membatasi jumlah jadwal yang tampil kekiri


// ----------------------------------------------------------
	// mencari kode karyawan di tabel jadwal
	$kar=0;
	$kd_kary=array();
	$kd_karya=$this->crud_j->cari_kode_kar()->result();
	foreach ($kd_karya as $karyawan) {
		$kd_kary[$kar++]=$karyawan->kd_kar;
	}
	// mencari jumlah kode karyawan di tabel jadwal untuk di tampilkan di looping
	$jml_kar=$this->crud_j->cari_jml_kd_kary()->result();
	foreach ($jml_kar as $jml) {
		$jum_kd_kar=$jml->jml_kar;
	}
// ---------------------------------------------------------
	//menacri nama karyawan berdasarkan kode karyawan yang ada di tabel jadwal di arrayy
	$nam=0;
	$nam_karya=array();
	$kd_karyaa=array();
	for ($i=0; $i<$jum_kd_kar ; $i++) {
		$nam_kary=$this->crud_j->cari_nama_karyawan($kd_kary[$i])->result();
		foreach ($nam_kary as $nama ) {
			$nam_karya[$i]=$nama->nam_kar;
			$kd_karyaa[$i]=$nama->kd_kar;
			if (empty($nam_karya[$i])||empty($kd_karyaa[$i])) {
				$nam_karya[$i]="-";
				$kd_karyaa[$i]="-";
			}
		}
	}


	$jum_tgl=0;
	$jml_tgl=$this->crud_j->cari_jml_tanggal($bulanList[$bulan],$tahun)->result();
	foreach ($jml_tgl as $jml) {
		$jum_tanggal=$jml->jml_tanggal;
	}
	$juml_tgl=$jum_tanggal;
	if ($jum_tgl>7) {
		$jum_tgl=7;
	}elseif (empty($jum_tgl)) {
		$jum_tgl=1;
	}elseif ($jum_tgl<7) {
		$jum_tgl=$jum_tanggal;
	}
	$data1=0;
	$jadwal_pgw=array();
	for ($i=0; $i <$jum_kd_kar ; $i++) {
		for ($j=0; $j <$jum_tabl_tgl ; $j++) {
			$jadwal=$this->crud_j->cari_jadwal_kar($kd_kary[$i],$tanggal[$j],$bulanList[$bulan],$tahun)->result();
			foreach ($jadwal as $jadwl_pgw) {

				$jadwal_pgw[$i][$j]=$jadwl_pgw->jadwal;

			}
		}
	}

	//echo $jadwal_pgw[1][5];
	//  print_r($jadwal_pgw);
	//  for ($i=0; $i <$jum_kd_kar ; $i++) {
	// 	for ($j=0; $j <$jum_tanggal ; $j++) {
	// 		if (empty($jadwal_pgw[$i][$j])) {
	//
	// 		}else {
	// 			echo "</br>";
	// 			echo $jadwal_pgw[$i][$j];
	// 			echo "</br>";
	// 		}
	//
	// 	}
	// }
	// 	echo "</br>";
	// 	print_r($kd_kary);

	// for ($i=0; $i <3 ; $i++) {
	// 	echo $kde_tgl[$i];
	// 	echo "</br>";
	// 	echo $kd_kary[$i];
	// 	echo "</br>";
	// }





		//echo $jum_jad;
	 //  echo "</br>";
		// echo $jum_jad;
	// print_r($kde_tgl);

	// --------------------------------kusus CRUD--------------------


	// ceksession panah menu


	// pengiriman data tampilan
	$data['tanggal']=$tanggal;

	$data['jum_kar']=$jum_kd_kar;
	$data['nama_hari']=$data_hari;
	$data['jum_jad']=$jum_tgl;
	$data['jadwal']=$jadwal_pgw;
	$data['bulan']=$bulanList[$bulan];
	$data['tahun']=$tahun;
	$data['jum_row_tgl']=$jum_tabl_tgl;
	// -------------pengiriman data crud----------------

	// $data['kd_unik_jd']=$this->crud_j->cari_kode_jadwal();
	 $data['nama_kary']=$nam_karya;
	// $data['nama_pgw']=$this->crud_m->tampil_data_pegawai()->result();//untuk form input
	// $data['kd_karya']=$kd_karyaa;
	// $data['tgl_awl']=$tgl_hari_ini;
	// $data{'tgl_akhr'}=$tgl_terakhir;
	// $data['bln_skrg']=$bulanList[$bulan];
	// $data['thn_skrg']=$tahun;
	 $data['cari_tahun']=$this->crud_j->cari_tahun()->result();

	//$data['cari_bulan']=$this->crud_j->cari_bulan()->result();
	//$data['kd_kar']=$this->db->crud_j->cari_kd_kar2($nama)->result();
	// untuk menampilkan halaman\
	$this->load->view('adm/nav_content/header');
	$this->load->view('adm/content/dashboard',$data);
	$this->load->view('adm/nav_content/footer');
	$this->load->view('adm/modal_input/input_cetak_jadwal',$data);




}
	function pegawai(){
    // kd_edit karyawan
		$kd_kar['kd_kar']=$this->input->post('kd_kar');
    // cari kode karyawan
		$data['kodeunik']=$this->crud_m->cari_kode_pegawai();
    // tampil Pegawai
		$data['data_pegawai']=$this->crud_m->tampil_data_pegawai()->result();
    // ceksession panah menu
		$this->cek_session->cek_session_pegawai();
    // untuk menampilkan halaman
		$this->load->view('adm/nav_content/header');
		$this->load->view('adm/content/data_pegawai',$data);
		$this->load->view('adm/nav_content/footer');
		$this->load->view('adm/modal_input/input_pegawai',$data);
		$this->load->view('adm/modal_input/modal_info_jdwl');

// untuk mengecek pesan konfirmasi input pegawai
		if ($this->session->userdata('inputPegawai')=='berhasil') {
			$this->load->view('adm/modal_input/sweet-alert-input');
			$this->session->unset_userdata('inputPegawai');
		}else {
		}
// untuk mengecek pesan konfirmasi edit pegawai
		if ($this->session->userdata('editPegawai')=='berhasil') {
			$this->load->view('adm/modal_input/sweet-alert-edit');
			$this->session->unset_userdata('editPegawai');
		}else {
		}

	}

	function jadwal(){
    // untuk menyesuaikan waktu zona indonesia
		date_default_timezone_set('Asia/Jakarta');
// ----------------------------------------------------------------------
    // meng generate tanggal sekarang sampai tanggal akhir bulan
		// mencari hari
		$dayList = array(
			'Sun' => 'Minggu',
			'Mon' => 'Senin',
			'Tue' => 'Selasa',
			'Wed' => 'Rabu',
			'Thu' => 'Kamis',
			'Fri' => 'Jumat',
			'Sat' => 'Sabtu'
		);
		$tgl_hari_ini=Date("j");
		$tgl_terakhir=Date("t");
		$tgl=0;
		$hr=1;
		for ($i=$tgl_hari_ini; $i<=$tgl_terakhir ; $i++) {
		$tanggal[$tgl++]=$i	;
    // menentukan jumlah hari pada tgl sekarang sampai tanggal terakhir
		$jml_hri=$hr++;
		}
		$jum_tabl_tgl=$jml_hri;
		if ($jum_tabl_tgl>7) {
			$jum_tabl_tgl=7;
		}elseif ($jum_tabl_tgl<7) {
			$jum_tabl_tgl=$jml_hri;
		}elseif (empty($jum_tabl_tgl)) {
			$jum_tabl_tgl=1;
		}

    // untuk mencari nama hari di tampung di data_hari
		for($i=0;$i<$jml_hri;$i++){
			$time[$i] = mktime(0, 0, 0, date("m"), date("d")+$i,  date("Y"));
 		 $hari[$i]=date("D", $time[$i]);
		 $data_hari[$i]=$dayList[$hari[$i]];
		}
// --------------------------------------------------------------------------
    // mencari kode tanggal pada tabel waktu
		$tahun= Date("Y");
		$bulan= Date("n");
		$bulanList=array(
			"1"=>"januari",
			"2"=>"Februari",
			"3"=>"Maret",
			"4"=>"April",
			"5"=>"Mei",
			"6"=>"Juni",
			"7"=>"Juli",
			"8"=>"Agustus",
			"9"=>"September",
			"10"=>"Oktober",
			"11"=>"November",
			"12"=>"Desember",
		);
		$kod=0;
		$jum_jad=0;

		  // mencari kode tanggal pada tabel waktu
	// 		$kde_tgl=array();
	// 	for ($i=0; $i<7 ; $i++) {
	// 	$kode_tgl=($this->crud_j->cari_tanggal_kode($tanggal[$i],$bulanList[$bulan],$tahun)->result());
	// 	foreach ($kode_tgl as $kd_tgl) {
	// 		$kde_tgl[$i]=$kd_tgl->kd_waktu;
	// 		if(empty($kde_tgl[$i])){
	// 		$jum_jad=0;
	// 	}elseif (count($kde_tgl[$i])>7) {
	// 		$jum_jad=7;
	// 	}else {
	// 		$jum_jad=count($kde_tgl);
	// 	}
	// 	}
	// }
	// print_r($kde_tgl);
    // untuk membatasi jumlah jadwal yang tampil kekiri


  // ----------------------------------------------------------
		// mencari kode karyawan di tabel jadwal
		$kar=0;
		$kd_kary=array();
		$kd_karya=$this->crud_j->cari_kode_kar()->result();
		foreach ($kd_karya as $karyawan) {
			$kd_kary[$kar++]=$karyawan->kd_kar;
		}
    // mencari jumlah kode karyawan di tabel jadwal untuk di tampilkan di looping
		$jml_kar=$this->crud_j->cari_jml_kd_kary()->result();
		foreach ($jml_kar as $jml) {
			$jum_kd_kar=$jml->jml_kar;
		}
// ---------------------------------------------------------
		//menacri nama karyawan berdasarkan kode karyawan yang ada di tabel jadwal di arrayy
		$nam=0;
		$nam_karya=array();
		$kd_karyaa=array();
		for ($i=0; $i<$jum_kd_kar ; $i++) {
			$nam_kary=$this->crud_j->cari_nama_karyawan($kd_kary[$i])->result();
			foreach ($nam_kary as $nama ) {
				$nam_karya[$i]=$nama->nam_kar;
				$kd_karyaa[$i]=$nama->kd_kar;
				if (empty($nam_karya[$i])||empty($kd_karyaa[$i])) {
					$nam_karya[$i]="-";
					$kd_karyaa[$i]="-";
				}
			}
		}

    // mencari jadwal karyawan
		$jum_tgl=0;
		$jml_tgl=$this->crud_j->cari_jml_tanggal($bulanList[$bulan],$tahun)->result();
		foreach ($jml_tgl as $jml) {
			$jum_tanggal=$jml->jml_tanggal;
		}
		$juml_tgl=$jum_tanggal;
		if ($jum_tgl>7) {
			$jum_tgl=7;
		}elseif (empty($jum_tgl)) {
			$jum_tgl=1;
		}elseif ($jum_tgl<7) {
			$jum_tgl=$jum_tanggal;
		}

		for ($i=0; $i <$jum_kd_kar ; $i++) {
			for ($j=0; $j <$jum_tabl_tgl ; $j++) {
				$jadwal=$this->crud_j->cari_jadwal_kar($kd_kary[$i],$tanggal[$j],$bulanList[$bulan],$tahun)->result();
				foreach ($jadwal as $jadwl_pgw) {
					$jadwal_pgw[$i][$j]=$jadwl_pgw->jadwal;

				}
			}
		}
		if (empty($jadwal_pgw)) {
			$jadwal_pgw="-";
		}
		//  print_r($jadwal_pgw);
		//  for ($i=0; $i <$jum_kd_kar ; $i++) {
 		// 	for ($j=0; $j <$jum_tanggal ; $j++) {
		// 		if (empty($jadwal_pgw[$i][$j])) {
    //
		// 		}else {
		// 			echo "</br>";
		// 			echo $jadwal_pgw[$i][$j];
		// 			echo "</br>";
		// 		}
    //
 		// 	}
 		// }
		// 	echo "</br>";
		// 	print_r($kd_kary);

		// for ($i=0; $i <3 ; $i++) {
		// 	echo $kde_tgl[$i];
		// 	echo "</br>";
		// 	echo $kd_kary[$i];
		// 	echo "</br>";
		// }





		  //echo $jum_jad;
		 //  echo "</br>";
			// echo $jum_jad;
		// print_r($kde_tgl);

    // --------------------------------kusus CRUD--------------------


		// ceksession panah menu
		$this->cek_session->cek_session_jadwal();

    // pengiriman data tampilan
		$data['tanggal']=$tanggal;

		$data['jum_kar']=$jum_kd_kar;
		$data['nama_hari']=$data_hari;
		$data['jum_jad']=$jum_tgl;
		$data['jadwal']=$jadwal_pgw;
		$data['bulan']=$bulanList[$bulan];
		$data['tahun']=$tahun;
		$data['jum_row_tgl']=$jum_tabl_tgl;
    // -------------pengiriman data crud----------------

		$data['kd_unik_jd']=$this->crud_j->cari_kode_jadwal();
		$data['nama_kary']=$nam_karya;
		$data['nama_pgw']=$this->crud_m->tampil_data_pegawai()->result();//untuk form input
		$data['kd_karya']=$kd_karyaa;
		$data['tgl_awl']=$tgl_hari_ini;
		$data{'tgl_akhr'}=$tgl_terakhir;
		$data['bln_skrg']=$bulanList[$bulan];
		$data['thn_skrg']=$tahun;
		$data['cari_tahun']=$this->crud_j->cari_tahun()->result();

		//$data['cari_bulan']=$this->crud_j->cari_bulan()->result();
		//$data['kd_kar']=$this->db->crud_j->cari_kd_kar2($nama)->result();
		// untuk menampilkan halaman\
    $this->load->view('adm/nav_content/header');
   	$this->load->view('adm/content/data_jadwal',$data);
		$this->load->view('adm/nav_content/footer');
		$this->load->view('adm/modal_input/input_jadwal',$data);
		$this->load->view('adm/modal_input/edit_jadwal',$data);
		$this->load->view('adm/modal_input/hapus_jadwal',$data);
		$this->load->view('adm/modal_input/modal_info_jdwl');
		$this->load->view('adm/modal_input/input_cetak_jadwal',$data);


		// untuk mengecek pesan konfirmasi edit pegawai
				if ($this->session->userdata('tgl_jdwl')=='gagal') {
					$this->load->view('adm/modal_input/sweet-alert-tgl-ggl');
					$this->session->unset_userdata('tgl_jdwl');
				}
				if ($this->session->userdata('cekWaktu')=='gagal') {
					$this->load->view('adm/modal_input/sweet-alert-cekWaktu');
					$this->session->unset_userdata('cekWaktu');
				}elseif($this->session->userdata('cekWaktu')=='berhasil') {
					$this->load->view('adm/modal_input/sweet-alert-input');
					$this->session->unset_userdata('cekWaktu');
				}
				if ($this->session->userdata('edit_jadwal')=='gagal') {
					$this->load->view('adm/modal_input/sweet-alert-gagal');
					$this->session->unset_userdata('edit_jadwal');
				}elseif($this->session->userdata('edit_jadwal')=='berhasil') {
					$this->load->view('adm/modal_input/sweet-alert-edit');
					$this->session->unset_userdata('edit_jadwal');
				}
				if ($this->session->userdata('hapus_jadwal')=='gagal') {
					$this->load->view('adm/modal_input/sweet-alert-gagal');
					$this->session->unset_userdata('hapus_jadwal');
				}elseif($this->session->userdata('hapus_jadwal')=='berhasil') {
					$this->load->view('adm/modal_input/sweet-alert-hapus');
					$this->session->unset_userdata('hapus_jadwal');
				}

	}



	function setting(){

		$data['jml_kar']=$this->crud_s->cari_jumlah_kar()->result();
		$data['super_usr']=$this->crud_s->tampil_data_super_user()->result();
		// ceksession panah menu
		$this->cek_session->cek_session_setting();
    // untuk menampilkan halaman
		$this->load->view('adm/nav_content/header');
		$this->load->view('adm/content/setting',$data);
		$this->load->view('adm/nav_content/footer');
		$this->load->view('adm/modal_input/modal_info_jdwl');

		// untuk mengecek pesan konfirmasi edit pegawai
				if ($this->session->userdata('editSuper')=='berhasil') {
					$this->load->view('adm/modal_input/sweet-alert-edit');
					$this->session->unset_userdata('editSuper');
				}elseif($this->session->userdata('editSuper')=='gagal') {
					$this->load->view('adm/modal_input/sweet-alert-gagal');
					$this->session->unset_userdata('editSuper');
				}

	}

	function export_excel(){
		date_default_timezone_set('Asia/Jakarta');
	// ----------------------------------------------------------------------
		// meng generate tanggal sekarang sampai tanggal akhir bulan
		// mencari hari
		$dayList = array(
			'Sun' => 'Minggu',
			'Mon' => 'Senin',
			'Tue' => 'Selasa',
			'Wed' => 'Rabu',
			'Thu' => 'Kamis',
			'Fri' => 'Jumat',
			'Sat' => 'Sabtu'
		);
		$tgl_hari_ini=Date("j");
		$tgl_terakhir=Date("t");
		$tgl=0;
		$hr=1;
		for ($i=$tgl_hari_ini; $i<=$tgl_terakhir ; $i++) {
		$tanggal[$tgl++]=$i	;
		// menentukan jumlah hari pada tgl sekarang sampai tanggal terakhir
		$jml_hri=$hr++;
		}
		$jum_tabl_tgl=$jml_hri;
		if ($jum_tabl_tgl>7) {
			$jum_tabl_tgl=7;
		}elseif ($jum_tabl_tgl<7) {
			$jum_tabl_tgl=$jml_hri;
		}elseif (empty($jum_tabl_tgl)) {
			$jum_tabl_tgl=1;
		}

		// untuk mencari nama hari di tampung di data_hari
		for($i=0;$i<$jml_hri;$i++){
			$time[$i] = mktime(0, 0, 0, date("m"), date("d")+$i,  date("Y"));
		 $hari[$i]=date("D", $time[$i]);
		 $data_hari[$i]=$dayList[$hari[$i]];
		}
	// --------------------------------------------------------------------------
		// mencari kode tanggal pada tabel waktu
		$tahun= Date("Y");
		$bulan= Date("n");
		$bulanList=array(
			"1"=>"januari",
			"2"=>"Februari",
			"3"=>"Maret",
			"4"=>"April",
			"5"=>"Mei",
			"6"=>"Juni",
			"7"=>"Juli",
			"8"=>"Agustus",
			"9"=>"September",
			"10"=>"Oktober",
			"11"=>"November",
			"12"=>"Desember",
		);
		$kod=0;
		$jum_jad=0;

			// mencari kode tanggal pada tabel waktu
	// 		$kde_tgl=array();
	// 	for ($i=0; $i<7 ; $i++) {
	// 	$kode_tgl=($this->crud_j->cari_tanggal_kode($tanggal[$i],$bulanList[$bulan],$tahun)->result());
	// 	foreach ($kode_tgl as $kd_tgl) {
	// 		$kde_tgl[$i]=$kd_tgl->kd_waktu;
	// 		if(empty($kde_tgl[$i])){
	// 		$jum_jad=0;
	// 	}elseif (count($kde_tgl[$i])>7) {
	// 		$jum_jad=7;
	// 	}else {
	// 		$jum_jad=count($kde_tgl);
	// 	}
	// 	}
	// }
	// print_r($kde_tgl);
		// untuk membatasi jumlah jadwal yang tampil kekiri


	// ----------------------------------------------------------
		// mencari kode karyawan di tabel jadwal
		$kar=0;
		$kd_kary=array();
		$kd_karya=$this->crud_j->cari_kode_kar()->result();
		foreach ($kd_karya as $karyawan) {
			$kd_kary[$kar++]=$karyawan->kd_kar;
		}
		// mencari jumlah kode karyawan di tabel jadwal untuk di tampilkan di looping
		$jml_kar=$this->crud_j->cari_jml_kd_kary()->result();
		foreach ($jml_kar as $jml) {
			$jum_kd_kar=$jml->jml_kar;
		}
	// ---------------------------------------------------------
		//menacri nama karyawan berdasarkan kode karyawan yang ada di tabel jadwal di arrayy
		$nam=0;
		$nam_karya=array();
		$kd_karyaa=array();
		for ($i=0; $i<$jum_kd_kar ; $i++) {
			$nam_kary=$this->crud_j->cari_nama_karyawan($kd_kary[$i])->result();
			foreach ($nam_kary as $nama ) {
				$nam_karya[$i]=$nama->nam_kar;
				$kd_karyaa[$i]=$nama->kd_kar;
				if (empty($nam_karya[$i])||empty($kd_karyaa[$i])) {
					$nam_karya[$i]="-";
					$kd_karyaa[$i]="-";
				}
			}
		}


		$jum_tgl=0;
		$jml_tgl=$this->crud_j->cari_jml_tanggal($bulanList[$bulan],$tahun)->result();
		foreach ($jml_tgl as $jml) {
			$jum_tanggal=$jml->jml_tanggal;
		}
		$juml_tgl=$jum_tanggal;
		if ($jum_tgl<7) {
			$jum_tgl=7;
		}elseif (empty($jum_tgl)) {
			$jum_tgl=1;
		}
		for ($i=0; $i <$jum_kd_kar ; $i++) {
			for ($j=0; $j <$jum_tanggal ; $j++) {
				$jadwal=$this->crud_j->cari_jadwal_kar($kd_kary[$i],$tanggal[$j],$bulanList[$bulan],$tahun)->result();
				foreach ($jadwal as $jadwl_pgw) {
					$jadwal_pgw[$i][$j]=$jadwl_pgw->jadwal;

				}
			}
		}
		if (empty($jadwal_pgw)) {
			$jadwal_pgw="-";
		}
		//  print_r($jadwal_pgw);
		//  for ($i=0; $i <$jum_kd_kar ; $i++) {
		// 	for ($j=0; $j <$jum_tanggal ; $j++) {
		// 		if (empty($jadwal_pgw[$i][$j])) {
		//
		// 		}else {
		// 			echo "</br>";
		// 			echo $jadwal_pgw[$i][$j];
		// 			echo "</br>";
		// 		}
		//
		// 	}
		// }
		// 	echo "</br>";
		// 	print_r($kd_kary);

		// for ($i=0; $i <3 ; $i++) {
		// 	echo $kde_tgl[$i];
		// 	echo "</br>";
		// 	echo $kd_kary[$i];
		// 	echo "</br>";
		// }





			//echo $jum_jad;
		 //  echo "</br>";
			// echo $jum_jad;
		// print_r($kde_tgl);

		// --------------------------------kusus CRUD--------------------


		// ceksession panah menu


		// pengiriman data tampilan
		$data['tanggal']=$tanggal;

		$data['jum_kar']=$jum_kd_kar;
		$data['nama_hari']=$data_hari;
		$data['jum_jad']=$jum_tgl;
		$data['jadwal']=$jadwal_pgw;
		$data['bulan']=$bulanList[$bulan];
		$data['tahun']=$tahun;
		// -------------pengiriman data crud----------------

		// $data['kd_unik_jd']=$this->crud_j->cari_kode_jadwal();
		 $data['nama_kary']=$nam_karya;
		// $data['nama_pgw']=$this->crud_m->tampil_data_pegawai()->result();//untuk form input
		// $data['kd_karya']=$kd_karyaa;
		// $data['tgl_awl']=$tgl_hari_ini;
		// $data{'tgl_akhr'}=$tgl_terakhir;
		// $data['bln_skrg']=$bulanList[$bulan];
		// $data['thn_skrg']=$tahun;
		// $data['cari_tahun']=$this->crud_j->cari_tahun()->result();

		//$data['cari_bulan']=$this->crud_j->cari_bulan()->result();
		//$data['kd_kar']=$this->db->crud_j->cari_kd_kar2($nama)->result();
		// untuk menampilkan halaman\
		$this->load->view('adm/laporan/vw_ex_excel',$data);
	}



	}

 ?>
