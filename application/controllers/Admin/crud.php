<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class crud extends CI_Controller {

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

// -------------untuk pegawai------------------
// untuk menambah data pegawai
  function tambah_pegawai(){
    // untuk mengirim pesan konfirmasi penambahan data ke fungsi pegawai di dashboard
		$this->session->set_userdata('inputPegawai','berhasil');

    // mengambil kodeunik karyawan dari modal crud m
    $kode_karyawan=$this->crud_m->cari_kode_pegawai();
    // untuk menampung data post yang dikirim
    $nama_karyawan=$this->input->post('nama');
      $jenis_kelamin=$this->input->post('jns');
      $no_hp=$this->input->post('no_hp');
      $status=$this->input->post('status');
			$stts_prkwn=$this->input->post('stts_prkwnan');
			$alamat=$this->input->post('alamat');
			$tgl_lhr=$this->input->post('tgl_lhr');
			$stts_kerja=$this->input->post('stts_kerja');
      // untuk memasukan ke tabel database
      $data=array(
      'kd_kar'=>$kode_karyawan,
      'nam_kar'=>$nama_karyawan,
    	'jns_kel'=>$jenis_kelamin,
  		'no_hp'=>$no_hp,
			'status'=>$status,
			'alamat'=>$alamat,
			'status_kerja'=>$stts_kerja,
			'tgl_lahir'=>$tgl_lhr,
			'status_perkawinan'=>$stts_prkwn);

// untuk mengirim data ke dalam database agar bisa disimpan
$this->crud_m->input_data($data,'tb_karyawan');

//kembali ke halaman pegawai
redirect('nex_page/pegawai');
  }

// mengenali edit kode pegawai
	function kd_edit_pegawai(){
    // menampung data post id kemudian mengirimkan ke modal edit

		$kd_kar=$this->input->post('kd_karya');
		$where=array('kd_kar'=>$kd_kar);
		$data['pegawai']=$this->crud_m->tampil_data_pegawai2($where,'tb_karyawan')->result();
		$this->load->view('adm/modal_input/edit_pegawai',$data);
	}

function edit_pegawai(){
	// untuk mengirim pesan konfirmasi pengubahan data ke fungsi pegawai di dashboard
	$this->session->set_userdata('editPegawai','berhasil');
	// untuk menampung data post yang dikirim
	$kode_karyawan=$this->input->post('kd_pegawai');
	$nama_karyawan=$this->input->post('nama');
		$jenis_kelamin=$this->input->post('jns');
		$no_hp=$this->input->post('no_hp');
		$status=$this->input->post('status');
		$stts_prkwn=$this->input->post('stts_prkwnan');
		$alamat=$this->input->post('alamat');
		$tgl_lhr=$this->input->post('tgl_lhr');
		$stts_kerja=$this->input->post('stts_kerja');


		//untuk memasukan ke tabel database
		$data=array(
		'nam_kar'=>$nama_karyawan,
		'jns_kel'=>$jenis_kelamin,
		'no_hp'=>$no_hp,
		'status'=>$status,
		'alamat'=>$alamat,
		'status_kerja'=>$stts_kerja,
		'tgl_lahir'=>$tgl_lhr,
		'status_perkawinan'=>$stts_prkwn);
		//menampung kd kaaryawan
		$where=array(
			'kd_kar'=>$kode_karyawan
		);
    // untuk mengubah data dan mengirim data ke database
		$this->crud_m->edit_data_pegawai($where,$data,'tb_karyawan');
		redirect('nex_page/pegawai');
	}

	function hapus_pegawai(){
		$kode_karyawan=$this->input->post('kd_kary');
		$where=array('kd_kar'=>$kode_karyawan);
		$this->crud_m->hapus_data_pegawai($where,'tb_karyawan');
		// redirect('nex_page/pegawai');
	}

// ----------------------untuk setting ---------------
	function edit_super_usr(){
		$pass_lama=$this->input->post('pasword_lama');
		$cekPassword=$this->crud_s->cari_password_lama($pass_lama);

		if($cekPassword){
			// untuk mengirim pesan konfirmasi pengubahan data ke fungsi pegawai di dashboard
			$this->session->set_userdata('editSuper','berhasil');
			// untuk menampung data post yang dikirim
			$kode_super='SU_001';
			$nama_su=$this->input->post('nama_su');
			$username=$this->input->post('username');
			$password=$this->input->post('Password_baru');
			$data=array(
			'nama'=>$nama_su,
			'username'=>$username,
			'password'=>$password);
			//menampung kd ksuper_user
			$where=array(
				'super_id'=>$kode_super
			);
			$this->crud_s->edit_data_super_usr($where,$data);
			redirect('nex_page/setting');
		}else {
			$this->session->set_userdata('editSuper','gagal');
			redirect('nex_page/setting');
		}

	}

  // --------------------------------untuk penjadwalan--------------
	function tambah_jadwal(){
		$bulan=$this->input->post('bulan');
		$tahun=$this->input->post('tahun');
		$tgl_awl=$this->input->post('tgl_awl');
		$tgl_akhir=$this->input->post('tgl_akhr');
		$total_kary=$this->crud_s->cari_jumlah_kar()->result();

		if($tgl_awl>$tgl_akhir){
			$this->session->set_userdata('tgl_jdwl','gagal');
			redirect('nex_page/jadwal');
		}else {

		$cek_inptan=0;
		foreach ($total_kary as $total) {
			$jum_tot_kary=$total->total;
		}
		$jum=1;
		$tgl=0;
		$cek=0;


		$jdwl_name=0;
		for ($i=$tgl_awl; $i <=$tgl_akhir ; $i++) {
			$jum_jadwl=$jum++;
			$tanggal[$tgl++]=$i;
		}

		for ($i=0; $i <$jum_tot_kary ; $i++) {

			$kd_karyawan[$i]=$this->input->post('nama_karya-'.$i);

		}
		// untuk memfilter data array yang kosong kemudian dicek unique data yang kembar akan di hilangkan
				$filter=array_filter($kd_karyawan);
			if(count(array_unique($filter))<count($filter)){
				$this->session->set_userdata('cekWaktu','gagal');
				redirect('nex_page/jadwal');
			}
		else {

			for ($i=0; $i <$jum_tot_kary ; $i++) {
			if(!empty($kd_karyawan[$i])){
				$jdwl_row=0;
			for ($j=0; $j <$jum_jadwl ; $j++) {
				$jdwl_name=$jdwl_row++;
				if ($jdwl_name>6) {
					$jdwl_row=0;
						$jdwl_name=0;
				}
				$jadwal_karyawan[$i][$j]=$this->input->post("jadwl-A-".$i."-".$jdwl_name);
					// untuk mencari kode jadwal dan kde waktu
					if($jadwal_karyawan[$i][$j]=="Pagi"){
						$jam_jdwl="06:00-16:00";
					}elseif($jadwal_karyawan[$i][$j]=="Lembur"){
						$jam_jdwl="16:00-06:00";
					}elseif($jadwal_karyawan[$i][$j]=="Siang"){
						$jam_jdwl="14:00-24:00";
					}elseif($jadwal_karyawan[$i][$j]=="Libur"){
						$jam_jdwl="--:--";
					}
				$kd_jadwal=$this->crud_j->cari_kode_jadwal();
				$kd_waktu=$this->crud_j->cari_kode_waktu();
				for ($t=0; $t <$jum_jadwl ; $t++) {
					// untuk mengecek data yang di masukan sdh ada atau belum
					$cek_waktu[$t]=$this->crud_j->cekWaktu($tanggal[$t],$bulan,$tahun,$kd_karyawan[$i]);
				}
				if ($cek_waktu[$j]) {
					 $this->session->set_userdata('cekWaktu','gagal');
					 redirect('nex_page/jadwal');

				}else {
					$data_jadwal[$j]=array(
			       		'kd_jdwl'=>$kd_jadwal,
			     			'kd_kar'=>$kd_karyawan[$i],
								'tanggal'=>$tanggal[$j],
		    				'bulan'=>$bulan,
		  					'tahun'=>$tahun,
								'kd_waktu'=>$kd_waktu
								);
								$data_jam[$j]=array(
									'kd_waktu'=>$kd_waktu,
								'jadwal'=>$jadwal_karyawan[$i][$j],
								'jam'=>$jam_jdwl
							);
								//  $this->crud_j->input_data($data_waktu[$i],'tb_waktuu');
								$this->crud_j->input_data($data_jam[$j],'tb_waktu');
								  $this->crud_j->input_data($data_jadwal[$j],'tv_jadwal');
									$cek_inptan=1;

				}
			}
		}
		}
		}

		if ($cek_inptan==0) {
			$this->session->set_userdata('cekWaktu','gagal');
			redirect('nex_page/jadwal');
		}else {
			echo count(array_unique($kd_karyawan));
			 $this->session->set_userdata('cekWaktu','berhasil');
			 redirect('nex_page/jadwal');
		}


		}


	}
	function edit_all_jadwal(){
		$bulan=$this->input->post('bulan');
		$tahun=$this->input->post('tahun');
		$tgl_awl=$this->input->post('tgl_awl');
		$tgl_akhir=$this->input->post('tgl_akhr');
		$total_kary=$this->crud_j->cari_jumlah_kar()->result();

		if(empty($bulan)||empty($tahun)||empty($tgl_awl)||empty($tgl_akhir)){
			$this->session->set_userdata('tgl_jdwl','gagal');
			redirect('nex_page/jadwal');
		}elseif($tgl_awl>$tgl_akhir){
			$this->session->set_userdata('tgl_jdwl','gagal');
			redirect('nex_page/jadwal');
		}else {

		$cek_inptan=0;
		foreach ($total_kary as $total) {
			$jum_tot_kary=$total->total;
		}
		$jum=1;
		$tgl=0;
		$cek=0;


		$jdwl_name=0;
		for ($i=$tgl_awl; $i <=$tgl_akhir ; $i++) {
			$jum_jadwl=$jum++;
			$tanggal[$tgl++]=$i;
		}

		for ($i=0; $i <$jum_tot_kary ; $i++) {

			$kd_karyawan[$i]=$this->input->post('nama_karya3-'.$i);

		}
		// untuk memfilter data array yang kosong kemudian dicek unique data yang kembar akan di hilangkan
				$filter=array_filter($kd_karyawan);
			if(count(array_unique($filter))<count($filter)){
				$this->session->set_userdata('cekWaktu','gagal');
				redirect('nex_page/jadwal');
			}
		else {

			for ($i=0; $i <$jum_tot_kary ; $i++) {
			if(!empty($kd_karyawan[$i])){
				$jdwl_row=1;
			for ($j=1; $j <=$jum_jadwl ; $j++) {
				$jdwl_name=$jdwl_row++;
				if ($jdwl_name>7) {
					$jdwl_row=1;
						$jdwl_name=1;
				}
				$jadwal_karyawan[$i][$j]=$this->input->post("jadwl-A-".$i."-".$jdwl_name);
					// untuk mencari kode jadwal dan kde waktu
					if($jadwal_karyawan[$i][$j]=="Pagi"){
						$jam_jdwl="06:00-16:00";
					}elseif($jadwal_karyawan[$i][$j]=="Lembur"){
						$jam_jdwl="16:00-06:00";
					}elseif($jadwal_karyawan[$i][$j]=="Siang"){
						$jam_jdwl="14:00-24:00";
					}elseif($jadwal_karyawan[$i][$j]=="Libur"){
						$jam_jdwl="--:--";
					}
				//$kd_jadwal=$this->crud_j->cari_kode_jadwal();
				 // $kd_kar[$i]=$this->input->post('nama_karya-'.$i);
				 $kd=implode(" ",$kd_karyawan);
					$cek_kd_jdwll=$this->crud_j->cari_jadwal_kar($kd_karyawan[$i],$tanggal[$j],$bulan,$tahun)->result();
					if($cek_kd_jdwll>0){
						 $kode_waktu='-';
					foreach ($cek_kd_jdwll as $kd_jdwl) {
						$kode_waktu=$kd_jdwl->kd_waktu;
					}

					$data_tbWaktu=array(
						'jadwal'=>$jadwal_karyawan[$i][$j],
						'jam'=>$jam_jdwl
					);

					$id_waktu=array(
						'kd_waktu'=>$kode_waktu
					);
								//  $this->crud_j->input_data($data_waktu[$i],'tb_waktuu');
							$this->crud_j->edit_jadwal($id_waktu,$data_tbWaktu);
							$cek_inptan=1;



			} else {

			}
		}
		}
	}

	}
	print_r($jadwal_karyawan);
	echo "</br>";
	print_r ($kd_karyawan);
	echo "</br>";
	print_r($tanggal);
	echo "</br>";
	echo $bulan;
	echo "</br>";
	echo $tahun;
	echo "</br>";
	echo $jam_jdwl;
	echo "</br>";
	print_r ($kode_waktu);
	if ($cek_inptan==0) {
		$this->session->set_userdata('cekWaktu','gagal');
		redirect('nex_page/jadwal');
	}else {
		// echo count(array_unique($kd_karyawan));
		//  $this->session->set_userdata('cekWaktu','berhasil');
		//  redirect('nex_page/jadwal');
	}
}
}
  // untuk mengedit data jadwal
	function edit_jadwal(){

		$tanggal=$this->input->post('tanggal');
		$bulan=$this->input->post('bulan');
		$tahun=$this->input->post('tahun');
		$jml_edit=$this->input->post('jml_edit');


		if (empty($jml_edit)||empty($tanggal)||empty($bulan)||empty($tahun)) {
			$this->session->set_userdata('edit_jadwal','gagal');
			redirect('nex_page/jadwal');
		}else{
			for ($i=0; $i <$jml_edit ; $i++) {
				$kd_kar[$i]=$this->input->post('nama_karya2-'.$i);
				$jadwal_kar[$i]=$this->input->post('jadwll-A-'.$i.'-0');
				$cek_kd_jdwl=$this->crud_j->cari_jadwal_kar($kd_kar[$i],$tanggal,$bulan,$tahun)->result();

				if($cek_kd_jdwl>0){
					 $kode_waktu='';

					foreach ($cek_kd_jdwl as $kd_jdwl) {
						$kode_waktu=$kd_jdwl->kd_waktu;
					}


					$jam='';
					if($jadwal_kar[$i]=="Pagi"){
						$jam="06:00-16:00";
					}elseif ($jadwal_kar[$i]=="Siang") {
						$jam="16:00-06:00";
					}elseif ($jadwal_kar[$i]=="Lembur") {
						$jam="16:00-06:00";
					}elseif ($jadwal_kar[$i]=="Libur") {
						$jam="--:--";
					}

					$data_tbWaktu=array(
						'jadwal'=>$jadwal_kar[$i],
						'jam'=>$jam
					);

					$id_waktu=array(
						'kd_waktu'=>$kode_waktu
					);
					$this->crud_j->edit_jadwal($id_waktu,$data_tbWaktu);
				//	$this->crud_j->edit_jadwal($id_jadwal,$data_tbjadwal);

				}else {
					// $this->session->set_userdata('edit_jadwal','gagal');
					// redirect('nex_page/jadwal');
				}
			}
			$this->session->set_userdata('edit_jadwal','berhasil');
			redirect('nex_page/jadwal');
		}
		print_r($jadwal_kar);
		echo "<br>";
		print_r($kd_kar);

	}
// untuk menghapus jadwal
	function hapus_jadwal(){
		$kd_kar=$this->input->post('kd_kary');

		if (!empty($kd_kar)) {

			$this->crud_j->hapus_semua_jadwal();
			// $this->session->set_userdata('hapus_jadwal','berhasil');
			// redirect('nex_page/jadwal');
		}else {
			$this->session->set_userdata('hapus_jadwal','gagal');
			redirect('nex_page/jadwal');
		}
	}
	// untuk menghapus jadwal
		function hapus_jadwal_2(){
			$kd_kar=$this->input->post('kd_kary');

			if (!empty($kd_kar)) {
				$where=array(
					'kd_kar'=>$kd_kar
				);
				$this->crud_j->hapus_data_jadwal($where,'tv_jadwal');
			//	$this->session->set_userdata('hapus_jadwal','berhasil');
			//	redirect('nex_page/jadwal');
			}else {
				$this->session->set_userdata('hapus_jadwal','gagal');
				redirect('nex_page/jadwal');
			}
		}
// untuk mencari bulan pada modal edit dan hapus
	function edit_bulan(){
		$tahun=$this->input->post('tahun');
		$bulan_tahun=$this->crud_j->cari_bulan($tahun)->result();
		if (count($bulan_tahun)>0) {
			$select_box='';
			$select_box .='<option value="">---Pilih Bulan---</option>';
			foreach ($bulan_tahun as $bulan) {
				$select_box .='<option value="'.$bulan->bulan.'">'.$bulan->bulan.'</option>';
			}
			echo json_encode($select_box);
		}

	}
// untuk mencari tanggal pada modal edit dan hapus
	function edit_tanggal(){
		// $kd_kary=$this->input->post('kd_kar');
		$bulan=$this->input->post('bulan');
		 $tahun=$this->input->post('tahun');

		 $tanggl=$this->crud_j->tanggal_cari2($bulan,$tahun);
		if (count($tanggl)>0) {
			$select_box='';
			$select_box .='<option value="">---Pilih Tanggal---</option>';
			foreach ($tanggl as $tgl) {
				$select_box .='<option value="'.$tgl->tanggal.'">'.$tgl->tanggal.'</option>';
			}
			echo json_encode($select_box);

		}

	}
// untuk mencari jadwal pada modal edit dan hapus
	function edit_waktu(){

		$bulan=$this->input->post('bulan');
		 $tahun=$this->input->post('tahun');
		 $tanggal=$this->input->post('tanggal');
		 $jadwal=$this->crud_j->cari_jadwal_kar2($tanggal,$bulan,$tahun)->result();
		if (count($jadwal)>0) {
			$select_box.="";
			$i=0;
			$j=0;
			$DataWaktu=array();
			$kd_waktu=array();
			foreach ($jadwal as $jdwl) {
				$kd_waktu[$j++]=$jdwl->kd_waktu;
				$kd_kar[$i++]=$jdwl->kd_kar;

			}
			for ($i=0; $i <$j ; $i++) {
			$DataWaktu[$i][0]=$this->crud_j->cari_tbWaktu($kd_waktu[$i])->result();
			$DataWaktu[$i][1]=$this->crud_j->cari_nama_karyawan($kd_kar[$i])->result();
			// foreach ($DataWaktu as $waktu) {
			// 	$select_box .='<option value="'.$waktu->jadwal.'">'.$waktu->jadwal.'</option>';
			// 	$select_box .='<option value="Siang">Siang</option>';
			// 	$select_box.='<option value="Lembur">Lembur</option>';
			// 	$select_box .='<option value="Libur">Libur</option>';
			//
			// }


			}

			echo json_encode($DataWaktu);
		}

	}
  // -----------------------untuk cetak jadwal-----------------------
  //untuk mencari tanggal pada modal cetak jajdwal
	function cari_waktu_tanggal(){

		$bulan=$this->input->post('bulan');
		 $tahun=$this->input->post('tahun');
		 $jadwal=$this->cetak_jadwal->cari_waktu_tanggal($bulan,$tahun)->result();
		if (count($jadwal)>0) {
			$select_box='';
			$select_box .='<option value="">---Pilih Tanggal---</option>';
			foreach ($jadwal as $jdwl) {
				$select_box .='<option value="'.$jdwl->tanggal.'">'.$jdwl->tanggal.'</option>';

			}

			echo json_encode($select_box);
		}

	}

	function downloadExcel(){
		$this->load->library('Excel');
		// membua objeck phpExcell
		// $objPHPExcel=new PHPExcel();
    // // set sheet yang akan diolah
		// $objPHPExcel->setActiveSheetIndex(0)
    // // menghasilkan value pada tiap-tiap cell ,A1 itualamat cellnya
    // // hello merupakan isinya
		// ->setCellValue('A1','Hello')
		// ->setCellValue('B2','ini')
		// ->setCellValue('C1','Excel')
		// ->setCellValue('D2','pertama');
    //
    // // set title pada sheet (me rename nama sheet)
		// $objPHPExcel->getActiveSheet()->setTitle('Excel pertama');
    //
    // // mulai menyimpan excell format xlsc, kalu ingin xls ganti xls2007 menjadi excel5
		// $objPHPExcel=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
    //
    // // sesuaikan headnya
		// header("Last-Modified: ".gmdate("D, d M Y H:i:s")."GMT");
		// header("Cache-Control: no-store, no-cache, must-revalidate");
		// header("cache-Control: post-check=0, pre-check=0",false);
		// header("Pragma:no-cache");
		// header("Content-Type:application/vnd.openxmlformats-officedocument.spreadsheet.sheet");
    // // ubah nama file saat di unduh
		// header('Content-Disposition:attachment;filename="hasilExcel.xlsx"');
    // // unduh file
		// $objPHPExcel->save("php://output");

    // mulai dari create object PHPExcell itu ada dokumentasi lengkap di phpExcell
		// folder dokumentasi dan exampleInputEmail1
    // untuk belajar lebih jauh silahkan buka disitu
		$bulan=$this->input->post('bulan');
		 $tahun=$this->input->post('tahun');
		 $tgl_awl=$this->input->post('tgl_awl');
		 $tgl_akhr=$this->input->post('tgl_akhr');
		 $ekspor_data=$this->input->post('export_data');
		 if (empty($bulan)||empty($tahun)||empty($tgl_awl)||empty($tgl_akhr)) {

		 }else {


		$excel = new PHPExcel();
    // Settingan awal fil excel
    $excel->getProperties()->setCreator('My Notes Code')
                 ->setLastModifiedBy('My Notes Code')
                 ->setTitle("Data Jadwal Karyawan")
                 ->setSubject("Karyawan")
                 ->setDescription("Laporan Jadwal Karyawan")
                 ->setKeywords("Data Jadwal Karyawan");
    // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
    $style_col = array(
      'font' => array('bold' => true), // Set font nya jadi bold
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ),
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
      )
    );
    // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
    $style_row = array(
      'alignment' => array(
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ),
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
      )
    );
		$rowCellList=array(
			'0'=>'C',
			'1'=>'D',
			'2'=>'E',
			'3'=>'F',
			'4'=>'G',
			'5'=>'H',
			'6'=>'I',
		);
    $excel->setActiveSheetIndex(0)->setCellValue('A1', "JADWAL DRIVER OPERSiONAL"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->setActiveSheetIndex(0)->setCellValue('A2', "CV. JOGJATRANSPORT REST CAR"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "Periode ".$bulan." ".$tahun); // Set kolom A1 dengan tulisan "DATA SISWA"
    $excel->getActiveSheet()->mergeCells('A1:I1'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->mergeCells('A2:I2'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->mergeCells('A3:I3'); // Set Merge Cell pada kolom A1 sampai E1
    $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(TRUE); // Set bold kolom A1
    $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
    $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
		$excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
		$excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1


		//styling
		// $excel->getActiveSheet()->getStyle('B4')->applyFromArray(
		// 	array(
		// 		'font'=>array(
		// 			'size'=>24,
		// 		))
		// 	);
		$excel->getActiveSheet()->getStyle('A1:I1')->applyFromArray(
			array(
				'font'=> array(
					'bold'=>true
				),
				'borders'=> array(
					'allborders'=> array(
						'style'=>PHPExcel_Style_Border::BORDER_THIN
					)
				)
			)
		);
    // borders

		$excel->getActiveSheet()->getStyle('A4:A5'.(5))->applyFromArray(
			array(
				'borders'=>array(
					'outline'
				)
			)
		);

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





    // untuk tanggal menampilkan tanggal

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

		//$tahun= Date("Y");
		//$bulan= Date("n");
		for($i=0;$i<$jum_jadwl;$i++){
			$time[$i] = date('D',mktime(0,0,0,$bulanList[$bulan],$tanggal[$i],$tahun));
		 // $hari[$i]=date("D", $time[$i]);
		 $data_hari[$i]=$dayList[$time[$i]];
	 }
	 // mencari jadwal karyawan
	 // $jum_tgl=0;
	 // $jml_tgl=$this->crud_j->cari_jml_tanggal($bulanList[$bulan],$tahun)->result();
	 // foreach ($jml_tgl as $jml) {
		//  $jum_tanggal=$jml->jml_tanggal;
	 // }
	 // $juml_tgl=$jum_tanggal;
	 // if ($jum_tgl>7) {
		//  $jum_tgl=7;
	 // }elseif (empty($jum_tgl)) {
		//  $jum_tgl=1;
	 // }elseif ($jum_tgl<7) {
		//  $jum_tgl=$jum_tanggal;
	 // }
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


 $numrow = 6; // Set baris pertama untuk isi tabel adalah baris ke 4

 $numb=4;
 $numb2=5;
 $cell=0;

 $yy=0;
 $ll=0;
 $nm=0;



 // Buat header tabel nya pada baris ke 3
 // $excel->setActiveSheetIndex(0)->setCellValue('A'.$b, "NO"); // Set kolom A3 dengan tulisan "NO"
 // $excel->getActiveSheet()->mergeCells('A'.$b.':A'.$a); // Set Merge Cell pada kolom A1 sampai E1
 // $excel->setActiveSheetIndex(0)->setCellValue('B'.$b, "Nama"); // Set kolom B3 dengan tulisan "NIS"
 // $excel->getActiveSheet()->mergeCells('B'.$b.':B'.$a); // Set Merge Cell pada kolom A1 sampai E1

 $excel->getActiveSheet()->getColumnDimension('B')->setWidth('30');

// $excel->getActiveSheet()->getColumnDimension('C7')->setHeight('30');
 // $jadwl_jum
	 for ($u=0; $u <$jadwl_jum; $u++) {


	 // untuk menampilkan nama karyawan
	 $dat=$cell;
	 if ($dat>0) {
	 	$numrow=$numrow+4;
		$numb=$numrow-2;
 	 $numb2=$numrow-1;
	 }
	 $no=1;
	 // untuk menampilkan tanggal
	 $row_tgl=4;
	 $row_hri=5;
	 $row_karwn=1;
	 $jum_tabl_tgl=$jum_tabl_tgl+7;



	 $excel->setActiveSheetIndex(0)->setCellValue('A'.$numb, "NO"); // Set kolom A3 dengan tulisan "NO"
	 $excel->getActiveSheet()->mergeCells('A'.$numb.':A'.$numb2); // Set Merge Cell pada kolom A1 sampai E1
	 $excel->setActiveSheetIndex(0)->setCellValue('B'.$numb, "NAMA"); // Set kolom B3 dengan tulisan "NIS"
	 $excel->getActiveSheet()->mergeCells('B'.$numb.':B'.$numb2); // Set Merge Cell pada kolom A1 sampai E1
	 // header// Apply style header yang telah kita buat tadi ke masing-masing kolom header
	 $excel->getActiveSheet()->getStyle('A'.$numb)->applyFromArray($style_col);
	 $excel->getActiveSheet()->getStyle('B'.$numb)->applyFromArray($style_col);
 	 $excel->getActiveSheet()->getStyle('C'.$numb)->applyFromArray($style_col);
 	 $excel->getActiveSheet()->getStyle('D'.$numb)->applyFromArray($style_col);
 	 $excel->getActiveSheet()->getStyle('E'.$numb)->applyFromArray($style_col);
 	 $excel->getActiveSheet()->getStyle('F'.$numb)->applyFromArray($style_col);
 	 $excel->getActiveSheet()->getStyle('G'.$numb)->applyFromArray($style_col);
 	 $excel->getActiveSheet()->getStyle('H'.$numb)->applyFromArray($style_col);
 	 $excel->getActiveSheet()->getStyle('I'.$numb)->applyFromArray($style_col);


// tanggal
	 for ($i=0; $i <$jum_row ; $i++) {

		 $rowCelltgl=$rowCellList[$i].$numb;
		 $rowCellhri=$rowCellList[$i].$numb2;
		 $excel->setActiveSheetIndex(0)->setCellValue($rowCelltgl, $tanggal[$yy++]);
		 $excel->getActiveSheet()->getStyle($rowCelltgl)->applyFromArray($style_row);

		 $excel->setActiveSheetIndex(0)->setCellValue($rowCellhri, $data_hari[$ll++]);
		 $excel->getActiveSheet()->getStyle($rowCellhri)->applyFromArray($style_row);
	 }

// mrnampilkan nama karyawan
	 for ($i=0; $i <$jum_kd_kar ; $i++) {
		 $cell=$numrow++;


		 $excel->setActiveSheetIndex(0)->setCellValue('A'.$cell, $no++);
		 $excel->setActiveSheetIndex(0)->setCellValue('B'.$cell, $nam_karya[$i]);

		 // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
		 $excel->getActiveSheet()->getStyle('A'.$cell)->applyFromArray($style_row);
		 $excel->getActiveSheet()->getStyle('B'.$cell)->applyFromArray($style_row);

		 // menampilkan jadwal
		 $row=0;
		 for ($j=$nm; $j <$jum_tabl_tgl ; $j++) {
			 $rowCelljdwl=$rowCellList[$row++].$cell;
			 $jadwall=$jadwal_pgw[$i][$j];
			 $jam_jadwall=	$jam_jadwal[$i][$j];
			 if (empty($jadwall)) {
				 $jadwall= '';
			 }elseif (empty($jam_jadwall)) {
			 	$jam_jadwall=" ";
			 }
			 $excel->setActiveSheetIndex(0)->setCellValue($rowCelljdwl,$jadwall);
			 $excel->getActiveSheet()->getStyle($rowCelljdwl)->applyFromArray($style_row);

		 }


	 }
	 $nm=$nm+7;

	 }
	 // contoh
	  //$excel->setActiveSheetIndex(0)->setCellValue('B'.'20', $cell);
		// $excel->setActiveSheetIndex(0)->setCellValue('B'.'21', $sisa_jum_jadwl);







		// foreach ($data_j as $data) {
    //
    // // Lakukan looping pada variabel siswa
    //
      // $excel->setActiveSheetIndex(0)->setCellValue('C'.$i, $data->jadwal);
      // $excel->setActiveSheetIndex(0)->setCellValue('D'.$i, $data->tanggal);
      // $excel->setActiveSheetIndex(0)->setCellValue('E'.$i, $data->bulan);
      //
      //
      //
      // $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
      // $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
      //
      // $no++; // Tambah 1 setiap kali looping
      // $numrow++; // Tambah 1 setiap kali looping
		// 	}
    // Set width kolom
    $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
    $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B


    // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
    $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight("20");
    // Set orientasi kertas jadi LANDSCAPE
    $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
    // Set judul file excel nya
    $excel->getActiveSheet(0)->setTitle("Laporan Data Jadwal Karyawan");
    $excel->setActiveSheetIndex(0);
    // Proses file excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Data Jadwal Karyawan.xlsx"'); // Set nama file excel nya
    header('Cache-Control: max-age=0');
    $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    $write->save('php://output');
  }

}



}
 ?>
