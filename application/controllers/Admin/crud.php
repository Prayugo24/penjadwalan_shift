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

      // untuk memasukan ke tabel database
      $data=array(
        'kd_kar'=>$kode_karyawan,
      'nam_kar'=>$nama_karyawan,
    'jns_kel'=>$jenis_kelamin,
  'no_hp'=>$no_hp,
'status'=>$status);

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



		//untuk memasukan ke tabel database
		$data=array(
		'nam_kar'=>$nama_karyawan,
		'jns_kel'=>$jenis_kelamin,
		'no_hp'=>$no_hp,
		'status'=>$status);
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

		$kd_karyawan=$this->input->post('kd_kar');

		$kategori_jdwl=$this->input->post('jns_jdwl');
		$bulan=$this->input->post('bulan');
		$tahun=$this->input->post('tahun');
		$tgl_awl=$this->input->post('tgl_awl');
		$tgl_akhir=$this->input->post('tgl_akhr');


		if($tgl_awl>$tgl_akhir){
			$this->session->set_userdata('tgl_jdwl','gagal');
			redirect('nex_page/jadwal');
		}else{
			$jum=1;
			$tgl=0;
			for ($i=$tgl_awl; $i <=$tgl_akhir ; $i++) {
				$jum_jadwl=$jum++;
				$tanggal[$tgl++]=$i;
			}

			if($kategori_jdwl=="jdwl-1"){
				$ktgri_jdwl=array("Pagi","Lembur","Siang","Pagi","Libur","Pagi","Siang","Siang");
			}elseif ($kategori_jdwl=="jdwl-2") {
				$ktgri_jdwl=array("Lembur","Siang","Pagi","Libur","Pagi","Siang","Siang","Pagi");
			}elseif ($kategori_jdwl=="jdwl-3") {
				$ktgri_jdwl=array("Siang","Pagi","Libur","Pagi","Siang","Siang","Pagi","Lembur");
			}elseif ($kategori_jdwl=="jdwl-4") {
				$ktgri_jdwl=array("Pagi","Libur","Pagi","Siang","Siang","Pagi","Lembur","Siang");
			}elseif ($kategori_jdwl=="jdwl-5") {
				$ktgri_jdwl=array("Libur","Pagi","Siang","Siang","Pagi","Lembur","Siang","Pagi");
			}elseif ($kategori_jdwl=="jdwl-6") {
				$ktgri_jdwl=array("Pagi","Siang","Siang","Pagi","Lembur","Siang","Pagi","Libur");
			}elseif ($kategori_jdwl=="jdwl-7") {
				$ktgri_jdwl=array("Siang","Siang","Pagi","Lembur","Siang","Pagi","Libur","Pagi");
			}elseif ($kategori_jdwl=="jdwl-8") {
				$ktgri_jdwl=array("Siang","Pagi","Lembur","Siang","Pagi","Libur","Pagi","Siang");
			}


			$h=0;
			$j=0;
			for ($t=0; $t <$jum_jadwl ; $t++) {
        // untuk mengecek data yang di masukan sdh ada atau belum
				$cek_waktu[$t]=$this->crud_j->cekWaktu($tanggal[$t],$bulan,$tahun,$kd_karyawan);
			}
			for ($i=0; $i <$jum_jadwl ; $i++) {
				// jika sudah ada maka akan kembali ke page jadwal dan gagal
				if ($cek_waktu[$i]) {
					 $this->session->set_userdata('cekWaktu','gagal');
					 redirect('nex_page/jadwal');

				}
		        // jika belum ada maka akan di eksekusi dan berhasil
				else {
            // untuk mencari kode jadwal dan kde waktu
					$kd_jadwal=$this->crud_j->cari_kode_jadwal();
					//$kd_waktu=$this->crud_j->cari_kode_waktu();
					$j=$h++;
          // jika isi ktgri array jadwal bernilai lbh dri 7 maka akan kembali ke 0
					if ($j>7) {
						$j=0;
						$h=0;
					}
					// $data_waktu[$i]=array(
		      //   		'kd_waktu'=>$kd_waktu,
		      // 			'tanggal'=>$tanggal[$i],
		    	// 			'bulan'=>$bulan,
		  		// 			'tahun'=>$tahun,
					// 			'kd_kar'=>$kd_karyawan
					// 			);

					$data_jadwal[$i]=array(
			       		'kd_jdwl'=>$kd_jadwal,
			     			'kd_kar'=>$kd_karyawan,
			  				'jadwal'=>$ktgri_jdwl[$j],
								'tanggal'=>$tanggal[$i],
		    				'bulan'=>$bulan,
		  					'tahun'=>$tahun

								);
								//  $this->crud_j->input_data($data_waktu[$i],'tb_waktuu');
								  $this->crud_j->input_data($data_jadwal[$i],'tv_jadwal');
								}
			}
			 $this->session->set_userdata('cekWaktu','berhasil');
			 redirect('nex_page/jadwal');


		}
	}
  // untuk mengedit data jadwal
	function edit_jadwal(){
		$kd_kar=$this->input->post('kd_karyawan');
		$tanggal=$this->input->post('tanggal');
		$bulan=$this->input->post('bulan');
		$tahun=$this->input->post('tahun');
		$waktu=$this->input->post('waktu');
		$cek_kd_jdwl=$this->crud_j->cari_jadwal_kar($kd_kar,$tanggal,$bulan,$tahun)->result();
		if (empty($kd_kar)||empty($tanggal)||empty($bulan)||empty($tahun)) {
			$this->session->set_userdata('edit_jadwal','gagal');
			redirect('nex_page/jadwal');
		}
		if($cek_kd_jdwl>0){
			 $kode_jadwl='';
			foreach ($cek_kd_jdwl as $kd_jdwl) {
				$kode_jadwl=$kd_jdwl->kd_jdwl;
			}

			$data=array(
			'kd_kar'=>$kd_kar,
			'jadwal'=>$waktu,
			'tanggal'=>$tanggal,
			'bulan'=>$bulan,
			'tahun'=>$tahun);

			$where=array(
				'kd_jdwl'=>$kode_jadwl
			);

			$this->crud_j->edit_jadwal($where,$data);
			$this->session->set_userdata('edit_jadwal','berhasil');
			redirect('nex_page/jadwal');
		}else {
			$this->session->set_userdata('edit_jadwal','gagal');
			redirect('nex_page/jadwal');
		}
	}
// untuk menghapus jadwal
	function hapus_jadwal(){
		$kd_kar=$this->input->post('kd_kary');
		$tanggal=$this->input->post('tanggal');
		$bulan=$this->input->post('bulan');
		$tahun=$this->input->post('tahun');
		$waktu=$this->input->post('waktu');
		$cek_kd_jdwl=$this->crud_j->cari_jadwal_kar($kd_kar,$tanggal,$bulan,$tahun)->result();
		if (empty($kd_kar)||empty($tanggal)||empty($bulan)||empty($tahun)) {
			$this->session->set_userdata('edit_jadwal','gagal');
			redirect('nex_page/jadwal');
		}
		if($cek_kd_jdwl>0){
			 $kode_jadwl='';
			foreach ($cek_kd_jdwl as $kd_jdwl) {
				$kode_jadwl=$kd_jdwl->kd_jdwl;
			}

			$where=array(
				'kd_jdwl'=>$kode_jadwl
			);

			$this->crud_j->hapus_data_jadwal($where,'tv_jadwal');
			$this->session->set_userdata('hapus_jadwal','berhasil');
			redirect('nex_page/jadwal');
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
		$kd_kary=$this->input->post('kd_kar');
		$bulan=$this->input->post('bulan');
		 $tahun=$this->input->post('tahun');

		 $tanggl=$this->crud_j->tanggal_cari($kd_kary,$bulan,$tahun);
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
		$kd_kary=$this->input->post('kd_kar');
		$bulan=$this->input->post('bulan');
		 $tahun=$this->input->post('tahun');
		 $tanggal=$this->input->post('tanggal');
		 $jadwal=$this->crud_j->cari_jadwal_kar($kd_kary,$tanggal,$bulan,$tahun)->result();
		if (count($jadwal)>0) {
			$select_box='';
			foreach ($jadwal as $jdwl) {
				$select_box .='<option value="'.$jdwl->jadwal.'">'.$jdwl->jadwal.'</option>';

			}
			$select_box .='<option value="Pagi">Pagi</option>';
			$select_box .='<option value="Siang">Siang</option>';
			$select_box .='<option value="Lembur">Lembur</option>';
			$select_box .='<option value="Libur">Libur</option>';
			echo json_encode($select_box);
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
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "Periode"); // Set kolom A1 dengan tulisan "DATA SISWA"
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

    // Buat header tabel nya pada baris ke 3
    $excel->setActiveSheetIndex(0)->setCellValue('A4', "NO"); // Set kolom A3 dengan tulisan "NO"
		$excel->getActiveSheet()->mergeCells('A4:A5'); // Set Merge Cell pada kolom A1 sampai E1
    $excel->setActiveSheetIndex(0)->setCellValue('B4', "Nama"); // Set kolom B3 dengan tulisan "NIS"
		$excel->getActiveSheet()->mergeCells('B4:B5'); // Set Merge Cell pada kolom A1 sampai E1

		$excel->getActiveSheet()->getColumnDimension('B')->setWidth('30');
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
		$numrow = 6; // Set baris pertama untuk isi tabel adalah baris ke 4
		$excel->getActiveSheet()->getStyle('A4:A5'.($numrow-1))->applyFromArray(
			array(
				'borders'=>array(
					'outline'
				)
			)
		);
    // Apply style header yang telah kita buat tadi ke masing-masing kolom header
    $excel->getActiveSheet()->getStyle('A4')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('B4')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('C4')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('D4')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('E4')->applyFromArray($style_col);
    // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya

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
	 $jum_tabl_tgl=$jum_jadwl;
 	if ($jum_tabl_tgl>7) {
 		$jum_tabl_tgl=7;
 	}elseif ($jum_tabl_tgl<7) {
 		$jum_tabl_tgl=$jum_jadwl;
 	}elseif (empty($jum_tabl_tgl)) {
 		$jum_tabl_tgl=1;
 	}




    // untuk tanggal menampilkan tanggal
		$row_tgl=4;
		$row_hri=5;
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
		for($i=0;$i<$jum_row;$i++){
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
		 for ($j=0; $j <$jum_tabl_tgl ; $j++) {
			 $jadwal=$this->crud_j->cari_jadwal_kar($kd_kary[$i],$tanggal[$j],$bulan,$tahun)->result();
			 foreach ($jadwal as $jadwl_pgw) {
				 $jadwal_pgw[$i][$j]=$jadwl_pgw->jadwal;
				 if (empty($jadwal_pgw[$i][$j])) {
					$jadwal_pgw="-";
				}
			 }
		 }
	 }


	 // untuk menampilkan nama karyawan
	 $no=1;
	 for ($i=0; $i <$jum_kd_kar ; $i++) {
		 $cell=$numrow++;
		 $excel->setActiveSheetIndex(0)->setCellValue('A'.$cell, $no++);
		 $excel->setActiveSheetIndex(0)->setCellValue('B'.$cell, $nam_karya[$i]);

		 // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
		 $excel->getActiveSheet()->getStyle('A'.$cell)->applyFromArray($style_row);
		 $excel->getActiveSheet()->getStyle('B'.$cell)->applyFromArray($style_row);
	 }
// untuk menampilkan tanggal
		for ($i=0; $i <$jum_row ; $i++) {
			$rowCelltgl=$rowCellList[$i].$row_tgl;
			$rowCellhri=$rowCellList[$i].$row_hri;
			$excel->setActiveSheetIndex(0)->setCellValue($rowCelltgl, $tanggal[$i]);
			$excel->getActiveSheet()->getStyle($rowCelltgl)->applyFromArray($style_row);

			$excel->setActiveSheetIndex(0)->setCellValue($rowCellhri, $data_hari[$i]);
			$excel->getActiveSheet()->getStyle($rowCellhri)->applyFromArray($style_row);
		}
		$row_jdwl=6;
		$row_karwn=1;
		$satu=0;
		for ($i=0; $i <$jum_kd_kar ; $i++) {
			$satu=$row_jdwl++;
			for ($j=0; $j <$jum_tabl_tgl ; $j++) {
				$rowCelljdwl=$rowCellList[$j].$satu;
				$jadwall=$jadwal_pgw[$i][$j];
				if (empty($jadwall)) {
					$jadwall= '';
				}
				$excel->setActiveSheetIndex(0)->setCellValue($rowCelljdwl,$jadwall );
				$excel->getActiveSheet()->getStyle($rowCelljdwl)->applyFromArray($style_row);

			}
		}

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
    $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
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
