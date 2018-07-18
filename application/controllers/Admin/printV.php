<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class printV extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('session');

		$this->load->model('crud_m');
		$this->load->model('crud_s');
		$this->load->model('crud_j');
		$this->load->model('cetak_jadwal');
		if ($this->session->userdata('level')!='admin') {
			redirect('auth/index');
		}
	}
	function printPreview(){


		$kategori_jdwl=$this->input->post('jns_jdwl');
		$bulan=$this->input->post('bulan');
		$tahun=$this->input->post('tahun');
		$tgl_awl=$this->input->post('tgl_awl');
		$tgl_akhr=$this->input->post('tgl_akhr');

		if($tgl_awl>$tgl_akhr){
			$this->session->set_userdata('tgl_jdwl','gagal');
			redirect('nex_page/jadwal');
		}
		if (empty($bulan)||empty($tahun)||empty($tgl_awl)||empty($tgl_akhr)) {
			$this->session->set_userdata('empty_jadwal','gagal');
			redirect('nex_page/jadwal');
		}else {
		// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya

		// ----------------------------------------------------------
		$jad_jum=1;
		for ($i=$tgl_awl; $i <=$tgl_akhr ; $i++) {
		$jum_semua_jad=$jad_jum++;
		}
		if($jum_semua_jad>7){
			// floor pembulatan nilai kebawah
			$jadwl_jum=floor($jum_semua_jad/7);
			$sisa_jum_jadwl=$jum_semua_jad%7;
			if ($sisa_jum_jadwl>0) {
				$jadwl_jum=$jadwl_jum+1;
			}
		}


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

	 $jum=1;
	 $tgl=0;
	 for ($i=$tgl_awl; $i <=$tgl_akhr ; $i++) {
		 $jum_jadwl=$jum++;
		 $tanggal[$tgl++]=$i;
	 }

		$jum_row=$jum_jadwl;
		if($jum_row>7){
			$jum_row=7;
		}elseif ($jum_row<7) {
			$jum_row=$jum_jadwl;
		}
		// untuk mencari nama hari di tampung di data_hari
		$dayList = array(
			'Sun' => 'Minggu',
			'Mon' => 'Senin',
			'Tue' => 'Selasa',
			'Wed' => 'Rabu',
			'Thu' => 'Kamis',
			'Fri' => 'Jumat',
			'Sat' => 'Sabtu'
		);
		$bulanList=array(
			"januari"=>"1",
			"Februari"=>"2",
			"Maret"=>"3",
			"April"=>"4",
			"Mei"=>"5",
			"Juni"=>"6",
			"Juli"=>"7",
			"Agustus"=>"8",
			"September"=>"9",
			"Oktober"=>"10",
			"November"=>"11",
			"Desember"=>"112",
		);


		for($i=0;$i<$jum_jadwl;$i++){
			$time[$i] = date('D',mktime(0,0,0,$bulanList[$bulan],$tanggal[$i],$tahun));
		 // $hari[$i]=date("D", $time[$i]);
		 $data_hari[$i]=$dayList[$time[$i]];
	 }

	 for ($i=0; $i <$jum_kd_kar ; $i++) {
		 for ($j=0; $j <$jum_jadwl ; $j++) {
			 $jadwal=$this->crud_j->cari_jadwal_kar($kd_kary[$i],$tanggal[$j],$bulan,$tahun)->result();
			 foreach ($jadwal as $jadwl_kd) {
				 $kd_jadwal_pgw[$i][$j]=$jadwl_kd->kd_waktu;

				}
				$jadwal_wkt=$this->crud_j->cari_jadwal_jam($kd_jadwal_pgw[$i][$j])->result();
				foreach ($jadwal_wkt as $jadwl_pgw) {
					$jadwal_pgw[$i][$j]=$jadwl_pgw->jadwal;
					$jam_jadwal[$i][$j]=$jadwl_pgw->jam;
				 if (empty($jadwal_pgw[$i][$j])) {
					$jadwal_pgw="-";
				}
			 }
		 }
	 }




	$data['jum_row']=$jum_row;
	$data['jadwl_jum']=$jadwl_jum;
	$data['jadwal_jam']=$jam_jadwal;
	$data['tanggal']=$tanggal;
	$data['data_hari']=$data_hari;
	$data['jum_kd_kar']=$jum_kd_kar;
	$data['jum_tabl_tgl']=$jum_tabl_tgl;
	$data['jadwal_pgw']=$jadwal_pgw;
	$data['nam_karya']=$nam_karya;
	$data['bulan']=$bulan;
	$data['tahun']=$tahun;



	$this->load->view('adm/laporan/print_preview',$data);
	// $this->session->set_userdata('empty_jadwal','berhasil');
	// redirect('nex_page/jadwal');
	}



}
}
