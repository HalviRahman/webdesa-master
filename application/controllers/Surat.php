<?php
class Surat extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') == 0) {
			redirect(base_url("akun/profil"));
		} elseif (!$this->session->userdata('nik')) {
			$allowed = array("none");
			$method = $this->router->fetch_method();
			if (!in_array($method, $allowed)) {
				redirect(base_url("akun/masuk"));
			}
		}
		$this->load->model('m_crud');
	}

	function index()
	{
		$title['judul'] = 'Pengurusan Surat';
		$data = null;
		$this->load->view('includes/v_header', $title);
		$this->load->view('surat/v_surat', $data);
		$this->load->view('includes/v_footer');
	}

	function nikah()
	{

		$this->form_validation->set_rules('anak', 'Nama Anak', 'required');
		$this->form_validation->set_rules('tgllahir', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('tempatlahir', 'Tempat Lahir', 'required');
		$this->form_validation->set_rules('ayah', 'Nama Ayah', 'required');
		$this->form_validation->set_rules('ibu', 'Nama Ibu', 'required');


		$title['judul'] = 'Surat Persyaratan Nikah';
		$this->load->view('includes/v_header', $title);
		$this->load->view('surat/v_surat_nikah');
		$this->load->view('includes/v_footer');
		// }
	}
	function pindahnikah()
	{

		$this->form_validation->set_rules('anak', 'Nama Anak', 'required');
		$this->form_validation->set_rules('tgllahir', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('tempatlahir', 'Tempat Lahir', 'required');
		$this->form_validation->set_rules('ayah', 'Nama Ayah', 'required');
		$this->form_validation->set_rules('ibu', 'Nama Ibu', 'required');


		$title['judul'] = 'Surat Persyaratan Pindah Nikah';
		$this->load->view('includes/v_header', $title);
		$this->load->view('surat/v_surat_pindahnikah');
		$this->load->view('includes/v_footer');
		// }
	}

	function kematian()
	{

		$title['judul'] = 'Surat Akta Kematian';
		$this->load->view('includes/v_header', $title);
		$this->load->view('surat/v_surat_kematian');
		$this->load->view('includes/v_footer');
	}
	function santunankematian()
	{

		$title['judul'] = 'Syarat Santunan Kematian';
		$this->load->view('includes/v_header', $title);
		$this->load->view('surat/v_surat_santunankematian');
		$this->load->view('includes/v_footer');
	}

	function ketUsaha()
	{
		$title['judul'] = 'Persyaratan Keterangan Usaha';
		$this->load->view('includes/v_header', $title);
		$this->load->view('surat/v_surat_ketUsaha');
		$this->load->view('includes/v_footer');
	}
	function pindahdatang()
	{
		$title['judul'] = 'Persyaratan Pindah Datang';
		$this->load->view('includes/v_header', $title);
		$this->load->view('surat/v_surat_pindahdatang');
		$this->load->view('includes/v_footer');
	}
	function pindahkeluar()
	{
		$title['judul'] = 'Persyaratan Pindah Keluar';
		$this->load->view('includes/v_header', $title);
		$this->load->view('surat/v_surat_pindahkeluar');
		$this->load->view('includes/v_footer');
	}
	function skck()
	{
		$title['judul'] = 'Persyaratan SKCK';
		$this->load->view('includes/v_header', $title);
		$this->load->view('surat/v_surat_skck');
		$this->load->view('includes/v_footer');
	}
	function pengalihanbpjs()
	{
		$title['judul'] = 'Pengalihan BPJS Mandiri';
		$this->load->view('includes/v_header', $title);
		$this->load->view('surat/v_surat_pengalihanbpjs');
		$this->load->view('includes/v_footer');
	}


	function tidak_mampu()
	{
		$nik = $_SESSION['nik'];
		if (isset($_POST['tdkmampu'])) {
			$tdkmampu['nik'] = $nik;

			$tdkmampu['jenis'] = $_POST['jenis'];
			$tdkmampu['nama_terkait'] = $_POST['nama_terkait'];
			$tdkmampu['tujuan'] = $_POST['tujuan'];
			$tdkmampu['pekerjaan'] = $_POST['pekerjaan'];
			$tdkmampu['alamat'] = $_POST['alamat'];

			$status = true;
			$config['allowed_types'] = 'jpg|png|jpeg|pdf';
			$config['max_size']      = 2048;

			// Upload Pengantar
			$post = 'pengantar_file';
			if ($_FILES[$post]["name"] != "") {
				$filename = $_FILES[$post]['name'];
				$config['upload_path']   = "./assets/img/surat/tidak_mampu";

				$name = $this->m_crud->upload_file($nik, $filename, $post, $config);
				if ($name == false) {
					$status = false;
				} else {
					$tdkmampu[$post] = $config['upload_path'] . '/' . $name;
				}
			}

			// Upload Pernyataan
			$post = 'pernyataan_file';
			if ($_FILES[$post]["name"] != "") {
				$filename = $_FILES[$post]['name'];
				$config['upload_path']   = "./assets/img/surat/tidak_mampu";

				$name = $this->m_crud->upload_file($nik, $filename, $post, $config);
				if ($name == false) {
					$status = false;
				} else {
					$tdkmampu[$post] = $config['upload_path'] . '/' . $name;
				}
			}

			// Upload KK
			$post = 'kk_file';
			if ($_FILES[$post]["name"] != "") {
				$filename = $_FILES[$post]['name'];
				$config['upload_path']   = "./assets/img/surat/tidak_mampu";

				$name = $this->m_crud->upload_file($nik, $filename, $post, $config);
				if ($name == false) {
					$status = false;
				} else {
					$tdkmampu[$post] = $config['upload_path'] . '/' . $name;
				}
			}

			// Upload KTP
			$post = 'ktp_file';
			if ($_FILES[$post]["name"] != "") {
				$filename = $_FILES[$post]['name'];
				$config['upload_path']   = "./assets/img/surat/tidak_mampu";

				$name = $this->m_crud->upload_file($nik, $filename, $post, $config);
				if ($name == false) {
					$status = false;
				} else {
					$tdkmampu[$post] = $config['upload_path'] . '/' . $name;
				}
			}

			$date = date("Y");
			$jumlah = $this->m_crud->readBy('tbl_tdk_mampu', array("year(tgl_buat)" => $date, "status !=" => surat_ditolak));
			$id = count($jumlah) + 1;
			$tdkmampu['id_tdk_mampu'] = "401/$id/438.7.9.14/$date";

			if ($status) {
				$pesan = $this->m_crud->save('tbl_tdk_mampu', $tdkmampu);
				if ($pesan) {
					redirect(base_url("surat/riwayat"));
					die();
				}
			}
		}

		$data['pekerjaan'] = PEKERJAAN;

		$title['judul'] = 'Surat Tidak Mampu';
		$this->load->view('includes/v_header', $title);
		$this->load->view('surat/v_surat_tdkmampu', $data);
		$this->load->view('includes/v_footer');
	}

	function biodata()
	{
		$nik = $_SESSION['nik'];
		if (isset($_POST['biodata'])) {
			$biodata['nik'] = $nik;

			$biodata['nama_kepala'] = $_POST['nama_kepala'];
			$biodata['alamat'] = $_POST['alamat'];

			$anggota = array();
			for ($i = 0; $i < count($_POST['nama']); $i++) {
				$nama = $_POST['nama'][$i];
				$nik = $_POST['nik'][$i];
				$jk = $_POST['jk'][$i];
				$tempat = $_POST['tempat'][$i];
				$tgl = $_POST['tgl'][$i];
				$jk = $_POST['jk'][$i];
				$hubungan = $_POST['hubungan'][$i];
				$pendidikan = $_POST['pendidikan'][$i];
				$goldar = $_POST['goldar'][$i];
				$kawin = $_POST['kawin'][$i];
				$agama = $_POST['agama'][$i];
				$pekerjaan = $_POST['pekerjaan'][$i];
				$ayah = $_POST['ayah'][$i];
				$ibu = $_POST['ibu'][$i];

				array_push($anggota, array('nama' => $nama, 'nik' => $nik, 'jk' => $jk, 'tempat' => $tempat, 'tgl' => $tgl, 'jk' => $jk, 'hubungan' => $hubungan, 'pendidikan' => $pendidikan, 'goldar' => $goldar, 'kawin' => $kawin, 'agama' => $agama, 'pekerjaan' => $pekerjaan, 'ayah' => $ayah, 'ibu' => $ibu));
			}
			$biodata['anggota'] = json_encode($anggota);

			$status = true;
			$config['allowed_types'] = 'jpg|png|jpeg|pdf';
			$config['max_size']      = 2048;

			// Upload Pengantar
			// $post = 'pengantar_file';
			// if ($_FILES[$post]["name"]!="") {
			// 	$filename = $_FILES[$post]['name'];
			// 	$config['upload_path']   = "./assets/img/surat/biodata";
			//
			// 	$name = $this->m_crud->upload_file($nik, $filename, $post, $config);
			// 	if ($name==false) {
			// 		$status = false;
			// 	} else {
			// 		$biodata[$post] = $config['upload_path'].'/'.$name;
			// 	}
			// }

			// Upload Akta Lahir
			$post = 'akta_lahir_file';
			if ($_FILES[$post]["name"] != "") {
				$filename = $_FILES[$post]['name'];
				$config['upload_path']   = "./assets/img/surat/biodata";

				$name = $this->m_crud->upload_file($nik, $filename, $post, $config);
				if ($name == false) {
					$status = false;
				} else {
					$biodata[$post] = $config['upload_path'] . '/' . $name;
				}
			}

			// Upload Akta Kawin
			$post = 'akta_kawin_file';
			if ($_FILES[$post]["name"] != "") {
				$filename = $_FILES[$post]['name'];
				$config['upload_path']   = "./assets/img/surat/biodata";

				$name = $this->m_crud->upload_file($nik, $filename, $post, $config);
				if ($name == false) {
					$status = false;
				} else {
					$biodata[$post] = $config['upload_path'] . '/' . $name;
				}
			}

			// Upload Ijazah
			$post = 'ijazah_file';
			if ($_FILES[$post]["name"] != "") {
				$filename = $_FILES[$post]['name'];
				$config['upload_path']   = "./assets/img/surat/biodata";

				$name = $this->m_crud->upload_file($nik, $filename, $post, $config);
				if ($name == false) {
					$status = false;
				} else {
					$biodata[$post] = $config['upload_path'] . '/' . $name;
				}
			}

			// Upload KK
			$post = 'kk_file';
			if ($_FILES[$post]["name"] != "") {
				$filename = $_FILES[$post]['name'];
				$config['upload_path']   = "./assets/img/surat/biodata";

				$name = $this->m_crud->upload_file($nik, $filename, $post, $config);
				if ($name == false) {
					$status = false;
				} else {
					$biodata[$post] = $config['upload_path'] . '/' . $name;
				}
			}

			// Upload KTP
			$post = 'ktp_file';
			if ($_FILES[$post]["name"] != "") {
				$filename = $_FILES[$post]['name'];
				$config['upload_path']   = "./assets/img/surat/biodata";

				$name = $this->m_crud->upload_file($nik, $filename, $post, $config);
				if ($name == false) {
					$status = false;
				} else {
					$biodata[$post] = $config['upload_path'] . '/' . $name;
				}
			}

			$date = date("Y");
			$jumlah = $this->m_crud->readBy('tbl_biodata', array("year(tgl_buat)" => $date, "status !=" => surat_ditolak));
			$id = count($jumlah) + 1;
			$biodata['id_biodata'] = "471.11/$id/438.7.9.14/$date";

			if ($status) {
				$pesan = $this->m_crud->save('tbl_biodata', $biodata);
				if ($pesan) {
					redirect(base_url("surat/riwayat"));
					die();
				}
			}
		}

		$data['pendidikan'] = PENDIDIKAN;
		$data['perkawinan'] = PERKAWINAN;
		$data['goldar'] = GOLDAR;
		$data['agama'] = AGAMA;
		$data['pekerjaan'] = PEKERJAAN;

		$title['judul'] = 'Surat Biodata Penduduk';
		$this->load->view('includes/v_header', $title);
		$this->load->view('surat/v_surat_biodata', $data);
		$this->load->view('includes/v_footer');
	}

	function umum()
	{
		$nik = $_SESSION['nik'];
		if (isset($_POST['umum'])) {
			$umum['nik'] = $nik;

			$umum['tujuan'] = $_POST['tujuan'];

			$config['upload_path']   = "./assets/img/surat/umum";
			$config['allowed_types'] = 'jpg|png|jpeg|pdf';
			$config['allowed_size'] = 2048;
			$status = true;

			$lampiran = array("kk_file", "ktp_file");
			foreach ($lampiran as $kl => $vl) {
				$post = $vl;
				$filename = $_FILES[$post]['name'];
				$config['upload_path']   = "./assets/img/surat/umum";

				$name = $this->m_crud->upload_file($nik, $filename, $post, $config);
				$umum[$post] = $config['upload_path'] . '/' . $name;
			}
			// // Upload Pengantar
			// $post = 'pengantar_file';
			// if ($_FILES[$post]["name"]!="") {
			// 	$filename = $_FILES[$post]['name'];
			//
			// 	$name = $this->m_crud->upload_file($nik, $filename, $post, $config);
			// 	// if ($name==false) {
			// 	// 	$status = false;
			// 	// } else {
			// 	// }
			// 	$umum[$post] = $config['upload_path'].'/'.$name;
			// }
			//
			// // Upload KK
			// $post = 'kk_file';
			// if ($_FILES[$post]["name"]!="") {
			// 	$filename = $_FILES[$post]['name'];
			//
			// 	$name = $this->m_crud->upload_file($nik, $filename, $post, $config);
			// 	if ($name==false) {
			// 		$status = false;
			// 	} else {
			// 		$umum[$post] = $config['upload_path'].'/'.$name;
			// 	}
			// }
			//
			// // Upload KTP
			// $post = 'ktp_file';
			// if ($_FILES[$post]["name"]!="") {
			// 	$filename = $_FILES[$post]['name'];
			//
			// 	$name = $this->m_crud->upload_file($nik, $filename, $post, $config);
			// 	if ($name==false) {
			// 		$status = false;
			// 	} else {
			// 		$umum[$post] = $config['upload_path'].'/'.$name;
			// 	}
			// }

			$date = date("Y");
			$jumlah = $this->m_crud->readBy('tbl_umum', array("year(tgl_buat)" => $date, "status !=" => surat_ditolak));
			$id = count($jumlah) + 1;
			$umum['id_umum'] = "&ensp;&ensp;&ensp;/$id/438.7.9.14/$date";

			if ($status) {
				$pesan = $this->m_crud->save('tbl_umum', $umum);
				if ($pesan) {
					redirect(base_url("surat/riwayat"));
					die();
				}
			}
		}

		$title['judul'] = 'Surat Umum';
		$this->load->view('includes/v_header', $title);
		$this->load->view('surat/v_surat_umum');
		$this->load->view('includes/v_footer');
	}

	function domisili()
	{
		$nik = $_SESSION['nik'];
		if (isset($_POST['domisili'])) {
			$domisili['nik'] = $nik;

			$domisili['jenis'] = $_POST['jenis'];
			$domisili['nama_usaha'] = $_POST['nama_usaha'];
			$domisili['alamat'] = $_POST['alamat'];

			$config['upload_path']   = "./assets/img/surat/domisili";
			$config['allowed_types'] = 'jpg|png|jpeg|pdf';
			$status = true;

			// Upload Pengantar
			// $post = 'pengantar_file';
			// if ($_FILES[$post]["name"]!="") {
			// 	$filename = $_FILES[$post]['name'];
			//
			// 	$name = $this->m_crud->upload_file($nik, $filename, $post, $config);
			// 	if ($name==false) {
			// 		$status = false;
			// 	} else {
			// 		$domisili[$post] = $config['upload_path'].'/'.$name;
			// 	}
			// }

			// Upload KK
			$post = 'kk_file';
			if ($_FILES[$post]["name"] != "") {
				$filename = $_FILES[$post]['name'];

				$name = $this->m_crud->upload_file($nik, $filename, $post, $config);
				if ($name == false) {
					$status = false;
				} else {
					$domisili[$post] = $config['upload_path'] . '/' . $name;
				}
			}

			// Upload KTP
			$post = 'ktp_file';
			if ($_FILES[$post]["name"] != "") {
				$filename = $_FILES[$post]['name'];

				$name = $this->m_crud->upload_file($nik, $filename, $post, $config);
				if ($name == false) {
					$status = false;
				} else {
					$domisili[$post] = $config['upload_path'] . '/' . $name;
				}
			}

			// Upload Akta Usaha
			$post = 'akta_usaha_file';
			if ($_FILES[$post]["name"] != "") {
				$filename = $_FILES[$post]['name'];

				$name = $this->m_crud->upload_file($nik, $filename, $post, $config);
				if ($name == false) {
					$status = false;
				} else {
					$domisili[$post] = $config['upload_path'] . '/' . $name;
				}
			}

			// Upload Pernyataan
			$post = 'pernyataan_file';
			if ($_FILES[$post]["name"] != "") {
				$filename = $_FILES[$post]['name'];

				$name = $this->m_crud->upload_file($nik, $filename, $post, $config);
				if ($name == false) {
					$status = false;
				} else {
					$domisili[$post] = $config['upload_path'] . '/' . $name;
				}
			}

			// Upload Perjanjian
			$post = 'perjanjian_file';
			if ($_FILES[$post]["name"] != "") {
				$filename = $_FILES[$post]['name'];

				$name = $this->m_crud->upload_file($nik, $filename, $post, $config);
				if ($name == false) {
					$status = false;
				} else {
					$domisili[$post] = $config['upload_path'] . '/' . $name;
				}
			}

			// Upload Kepemilikan
			$post = 'kepemilikan_file';
			if ($_FILES[$post]["name"] != "") {
				$filename = $_FILES[$post]['name'];

				$name = $this->m_crud->upload_file($nik, $filename, $post, $config);
				if ($name == false) {
					$status = false;
				} else {
					$domisili[$post] = $config['upload_path'] . '/' . $name;
				}
			}

			$date = date("Y");
			$jumlah = $this->m_crud->readBy('tbl_domisili', array("year(tgl_buat)" => $date, "status !=" => surat_ditolak));
			$id = count($jumlah) + 1;
			$domisili['id_domisili'] = "470/$id/438.7.9.14/$date";

			if ($status) {
				$pesan = $this->m_crud->save('tbl_domisili', $domisili);
				if ($pesan) {
					redirect(base_url("surat/riwayat"));
					die();
				}
			}
		}

		$title['judul'] = 'Surat Domisili';
		$this->load->view('includes/v_header', $title);
		$this->load->view('surat/v_surat_domisili');
		$this->load->view('includes/v_footer');
	}

	function riwayat()
	{
		$nik = $_SESSION['nik'];
		$data['kelahiran'] = $this->m_crud->readBy('tbl_kelahiran', array('nik' => $nik));
		$data['kematian'] = $this->m_crud->readBy('tbl_kematian', array('nik' => $nik));
		$data['tdk_mampu'] = $this->m_crud->readBy('tbl_tdk_mampu', array('nik' => $nik));
		$data['umum'] = $this->m_crud->readBy('tbl_umum', array('nik' => $nik));
		$data['domisili'] = $this->m_crud->readBy('tbl_domisili', array('nik' => $nik));
		$data['biodata'] = $this->m_crud->readBy('tbl_biodata', array('nik' => $nik));
		$data['surat'] = $this;

		$title['judul'] = 'Riwayat Surat';
		$this->load->view('includes/v_header', $title);
		$this->load->view('surat/v_surat_riwayat', $data);
		$this->load->view('includes/v_footer');
	}

	function cek_status($id)
	{
		switch ($id) {
			case 0:
				echo "Tahap Validasi";
				break;
			case 1:
				echo "Tahap Proses";
				break;
			case 2:
				echo "Selesai";
				break;
			case 3:
				echo "Selesai";
				break;
			default:
				echo "Surat Ditolak";
		}
	}
	function cetak($surat, $nik, $id)
	{
		$view = array('kelahiran' => 'tbl_kelahiran', 'kematian' => 'tbl_kematian', 'tdkmampu' => 'tbl_tdk_mampu', 'biodata' => 'tbl_biodata', 'umum' => 'tbl_umum', 'domisili' => 'tbl_domisili');
		$hasil = $this->m_crud->readBy($view[$surat], array('id' => $id, 'nik' => $nik))[0];
		$warga = $this->m_crud->readBy('tbl_warga', array('nik' => $nik))[0];

		$data['element'] = "<div style='padding-bottom:20px; margin-right:13%; width:400px;' class='pull-right'>";
		$data['element'] .= "<h4 class='text-center'><strong>PEMERINTAH KOTA BATU</strong></h4>";
		$data['element'] .= "<h4 style='margin-top:-8px;' class='text-center'><strong>KECAMATAN BATU</strong></h4>";
		$data['element'] .= "<h4 style='font-size:20px; margin-top:-8px; font-weight:bold;' class='text-center'>KANTOR DESA SIDOMULYO</h4>";
		$data['element'] .= "<h5 style='margin-top:-8px;' class='text-center'>Jl. Bukit Berbunga No.74 - Telp. 0341-592291</h5>";
		$data['element'] .= "<h5 style='margin-top:-8px;' class='text-center'>KOTA BATU - 65317</h5>";
		$data['element'] .= "</div>";
		$data['element'] .= "<div style='padding-bottom:20px; width:3cm; margin-right:20px;' class='pull-right'>";
		$data['element'] .= "<img src='" . base_url("assets/img/favicon.png") . "' style='width:3cm;'>";
		$data['element'] .= "</div><br/><br/>";
		$data['element'] .= "<br/><br/>";
		$data['element'] .= "<br/><br/>";
		$data['element'] .= "<div class='col-md-12 text-center' style='border-top:3px solid black; padding-top:50px;'>";
		$judul = ($surat == 'tdkmampu') ? 'TIDAK MAMPU' : $surat;
		$data['element'] .= "<h5 style='text-transform:uppercase;'><strong>SURAT KETERANGAN " . $judul . "</strong></h5>";
		if ($surat == 'kelahiran') {
			$data['element'] .= "<h5 style='letter-spacing:1.5px;'><strong>Nomor: " . $hasil->id_kelahiran . "</strong></h5>";
		} elseif ($surat == 'kematian') {
			$data['element'] .= "<h5 style='letter-spacing:1.5px;'><strong>Nomor: " . $hasil->id_kematian . "</strong></h5>";
		} elseif ($surat == 'tdkmampu') {
			$data['element'] .= "<h5 style='letter-spacing:1.5px;'><strong>Nomor: " . $hasil->id_tdk_mampu . "</strong></h5>";
		} elseif ($surat == 'biodata') {
			$data['element'] .= "<h5 style='letter-spacing:1.5px;'><strong>Nomor: " . $hasil->id_biodata . "</strong></h5>";
		} elseif ($surat == 'umum') {
			$data['element'] .= "<h5 style='letter-spacing:1.5px;'><strong>Nomor: " . $hasil->id_umum . "</strong></h5>";
		} elseif ($surat == 'domisili') {
			$data['element'] .= "<h5 style='letter-spacing:1.5px;'><strong>Nomor: " . $hasil->id_domisili . "</strong></h5>";
		}

		$data['element'] .= "</div>";
		$data['element'] .= "<div class='col-md-12' style='margin-top:30px;'>";
		$data['element'] .= "<p>Saya yang bertanda di bawah ini selaku Kepala Desa Sidomulyo, dengan ini menerangkan bahwa:</p>";

		if ($surat == 'kelahiran') {
			$data['judul'] = 'Cetak Kelahiran';
			$data['element'] .= '<table class="table table-borderless">';
			$data['element'] .= '<tbody>';
			$data['element'] .= '<tr>';
			$data['element'] .= '<th style="width:20px;border:none;">Tanggal</th>';
			$data['element'] .= '<td style="border:none;">: ' . date("D, d M Y", strtotime($hasil->tgl_lahir)) . '</td>';
			$data['element'] .= '</tr>';
			$data['element'] .= '<tr>';
			$data['element'] .= '<th style="width:20px;border:none;">Tempat</th>';
			$data['element'] .= '<td style="border:none;">: ' . $hasil->tempat_lahir . '</td>';
			$data['element'] .= '</tr>';
			$data['element'] .= '</tbody>';
			$data['element'] .= '</table>';

			$data['element'] .= '<table class="table table-borderless">';
			$data['element'] .= '<tbody>';
			$data['element'] .= '<tr>';
			$data['element'] .= '<th style="width:200px;border:none;">Telah Lahir Seorang Anak</th>';
			$data['element'] .= '<td style="border:none;">: ' . ($hasil->jk == 'L' ? 'Laki-laki' : 'Perempuan') . '</td>';
			$data['element'] .= '</tr>';
			$data['element'] .= '<tr>';
			$data['element'] .= '<th style="width:20px;border:none;">Yang bernama</th>';
			$data['element'] .= '<td style="border:none;">: ' . $hasil->anak . '</td>';
			$data['element'] .= '</tr>';
			$data['element'] .= '<tr>';
			$data['element'] .= '<th style="width:20px;border:none;">Dari seorang Ibu</th>';
			$data['element'] .= '<td style="border:none;">: ' . $hasil->ibu . '</td>';
			$data['element'] .= '</tr>';
			$data['element'] .= '<tr>';
			$data['element'] .= '<th style="width:20px;border:none;">Istri dari</th>';
			$data['element'] .= '<td style="border:none;">: ' . $hasil->ayah . '</td>';
			$data['element'] .= '</tr>';
			$data['element'] .= '<tr>';
			$data['element'] .= '<th style="width:20px;border:none;">Alamat</th>';
			$data['element'] .= '<td style="border:none;">: Desa Sidomulyo, RW ' . $hasil->rw . ', RT ' . $hasil->rt . '</td>';
			$data['element'] .= '</tr>';
			$data['element'] .= '</tbody>';
			$data['element'] .= '</table>';
		} elseif ($surat == 'kematian') {
			$data['judul'] = 'Cetak Kematian';

			$data['element'] .= '<table class="table table-borderless">';
			$data['element'] .= '<tbody>';
			$data['element'] .= '<tr>';
			$data['element'] .= '<th style="width:120px;border:none;">Nama</th>';
			$data['element'] .= '<td style="border:none; text-transform:capitalize;">: ' . $hasil->nama . '</td>';
			$data['element'] .= '</tr>';
			$data['element'] .= '<tr>';
			$data['element'] .= '<tr>';
			$data['element'] .= '<th style="width:120px;border:none;">NIK</th>';
			$data['element'] .= '<td style="border:none; text-transform:capitalize;">: ' . $hasil->nik_alm . '</td>';
			$data['element'] .= '</tr>';
			$data['element'] .= '<tr>';
			$data['element'] .= '<th style="width:120px;border:none;">Jenis Kelamin</th>';
			$data['element'] .= '<td style="border:none;">: ' . ($hasil->jk == 'L' ? 'Laki-laki' : 'Perempuan') . '</td>';
			$data['element'] .= '</tr>';
			$data['element'] .= '<tr>';
			$data['element'] .= '<th style="width:120px;border:none;">Tanggal Lahir</th>';
			$data['element'] .= '<td style="border:none; text-transform:capitalize;">: ' . $hasil->tgl_lahir . '</td>';
			$data['element'] .= '</tr>';
			$data['element'] .= '<tr>';
			$data['element'] .= '<th style="width:120px;border:none;">Agama</th>';
			$data['element'] .= '<td style="border:none; text-transform:capitalize;">: ' . $hasil->agama . '</td>';
			$data['element'] .= '</tr>';
			$data['element'] .= '<tr>';
			$data['element'] .= '<th style="width:120px;border:none;">Pekerjaan</th>';
			$data['element'] .= '<td style="border:none; text-transform:capitalize;">: ' . $hasil->pekerjaan . '</td>';
			$data['element'] .= '</tr>';
			$data['element'] .= '<tr>';
			$data['element'] .= '<th style="width:120px;border:none;">Kewarganegaraan</th>';
			$data['element'] .= '<td style="border:none; text-transform:uppercase;">: ' . $hasil->kwn . '</td>';
			$data['element'] .= '</tr>';
			$data['element'] .= '<tr>';
			$data['element'] .= '<th style="width:120px;border:none;">Alamat</th>';
			$data['element'] .= '<td style="border:none;">: ' . $hasil->alamat . '</td>';
			$data['element'] .= '</tr>';
			$data['element'] .= '</tbody>';
			$data['element'] .= '</table>';
			$data['element'] .= "<p>Telah meninggal pada:</p>";
			$data['element'] .= '<table class="table table-borderless">';
			$data['element'] .= '<tbody>';
			$data['element'] .= '<tr>';
			$data['element'] .= '<th style="width:120px;border:none;">Tanggal</th>';
			$data['element'] .= '<td style="border:none;">: ' . date("D, d M Y", strtotime($hasil->tgl_meninggal)) . '</td>';
			$data['element'] .= '</tr>';
			$data['element'] .= '<tr>';
			$data['element'] .= '<th style="width:120px;border:none;">Tempat</th>';
			$data['element'] .= '<td style="border:none;">: ' . $hasil->tempat_meninggal . '</td>';
			$data['element'] .= '</tr>';
			$data['element'] .= '<tr>';
			$data['element'] .= '<th style="width:120px;border:none;">Penyebab</th>';
			$data['element'] .= '<td style="border:none;">: ' . $hasil->penyebab . '</td>';
			$data['element'] .= '</tr>';
			$data['element'] .= '<tr>';
			$data['element'] .= '<th style="width:120px;border:none;">Penentu</th>';
			$data['element'] .= '<td style="border:none;">: ' . $hasil->penentu . '</td>';
			$data['element'] .= '</tr>';
			$data['element'] .= '</tbody>';
			$data['element'] .= '</table>';
		} elseif ($surat == "tdkmampu") {
			$data['judul'] = 'Cetak Tidak Mampu';

			$data['element'] .= '<table class="table table-borderless">';
			$data['element'] .= '<tbody>';
			$data['element'] .= '<tr>';
			$data['element'] .= '<th style="width:120px;border:none;">Nama</th>';
			$data['element'] .= '<td style="border:none;">: ' . $hasil->nama_terkait . '</td>';
			$data['element'] .= '</tr>';
			$data['element'] .= '<tr>';
			$data['element'] .= '<th style="width:120px;border:none;">Pekerjaan</th>';
			$data['element'] .= '<td style="border:none;">: ' . $hasil->pekerjaan . '</td>';
			$data['element'] .= '</tr>';
			$data['element'] .= '<tr>';
			$data['element'] .= '<th style="width:120px;border:none;">Alamat</th>';
			$data['element'] .= '<td style="border:none;">: ' . $hasil->alamat . '</td>';
			$data['element'] .= '</tr>';
			// $data['element'] .= '<tr>';
			// $data['element'] .= '<th style="width:120px;border:none;">Tujuan</th>';
			// $data['element'] .= '<td style="border:none;">: '.$hasil->tujuan.'</td>';
			// $data['element'] .= '</tr>';
			$data['element'] .= '</tbody>';
			$data['element'] .= '</table>';
			$data['element'] .= "<p>Yang bersangkutan benar-benar warga Desa Sidomulyo yang tidak mampu untuk melakukan pembayaran $hasil->tujuan.</p><br/>";
		} elseif ($surat == 'biodata') {
			$data['judul'] = 'Cetak Biodata';

			$data['element'] .= '<table class="table table-borderless">';
			$data['element'] .= '<tbody>';
			$data['element'] .= '<tr>';
			$data['element'] .= '<th style="width:150px;border:none;">Kepala Keluarga</th>';
			$data['element'] .= '<td style="border:none;">: ' . $hasil->nama_kepala . '</td>';
			$data['element'] .= '</tr>';
			$data['element'] .= '<tr>';
			$data['element'] .= '<th style="width:150px;border:none;">Alamat</th>';
			$data['element'] .= '<td style="border:none;">: ' . $hasil->alamat . '</td>';
			$data['element'] .= '</tr>';
			$data['element'] .= '</tbody>';
			$data['element'] .= '</table>';
			$data['element'] .= "<p>Yang bersangkutan benar-benar warga Desa Sidomulyo yang memiliki anggota keluarga sebagai berikut:.</p><br/>";
			$data['element'] .= '<table class="table table-borderless">';
			$data['element'] .= '<tbody>';
			$data['element'] .= "
			<tr>
			<th>Nama</th>
			<th>NIK</th>
			<th>JK</th>
			<th>TTL</th>
			<th>Hubungan</th>
			<th>Pendidikan</th>
			<th>Status Kawin</th>
			<th>Pekerjaan</th>
			</tr>
			";

			$anggota = json_decode($hasil->anggota);
			foreach ($anggota as $key => $value) {
				$data['element'] .= "<tr>
				<td style='text-transform:capitalize;'>$value->nama</td>
				<td style='text-transform:capitalize;'>$value->nik</td>
				<td style='text-transform:capitalize;'>" . ($value->jk == 'L' ? 'Laki-laki' : 'Perempuan') . "</td>
				<td style='text-transform:capitalize;'>$value->tempat, $value->tgl</td>
				<td style='text-transform:capitalize;'>$value->hubungan</td>
				<td style='text-transform:capitalize;'>$value->pendidikan</td>
				<td style='text-transform:capitalize;'>$value->kawin</td>
				<td style='text-transform:capitalize;'>$value->pekerjaan</td>
				</tr>";
			}

			$data['element'] .= '</tbody>';
			$data['element'] .= '</table>';
		} elseif ($surat == "umum") {
			$data['judul'] = 'Cetak Tidak Mampu';

			$data['element'] .= '<table class="table table-borderless">';
			$data['element'] .= '<tbody>';
			$data['element'] .= '<tr>';
			$data['element'] .= '<th style="width:120px;border:none;">Nama</th>';
			$data['element'] .= '<td style="border:none;">: ' . $warga->nama . '</td>';
			$data['element'] .= '</tr>';
			$data['element'] .= '<tr>';
			$data['element'] .= '<th style="width:120px;border:none;">NIK</th>';
			$data['element'] .= '<td style="border:none;">: ' . $hasil->nik . '</td>';
			$data['element'] .= '</tr>';
			$data['element'] .= '<tr>';
			$data['element'] .= '<th style="width:120px;border:none;">Alamat</th>';
			$data['element'] .= '<td style="border:none;">: Dusun ' . DUSUN[$warga->rw] . ' RW' . $warga->rw . '/RT' . $warga->rt . '</td>';
			$data['element'] .= '</tr>';
			// $data['element'] .= '<tr>';
			// $data['element'] .= '<th style="width:120px;border:none;">Tujuan</th>';
			// $data['element'] .= '<td style="border:none;">: '.$hasil->tujuan.'</td>';
			// $data['element'] .= '</tr>';
			$data['element'] .= '</tbody>';
			$data['element'] .= '</table>';
			$data['element'] .= "<p>Yang bersangkutan benar-benar warga Desa Sidomulyo sedang $hasil->tujuan.</p><br/>";
		} elseif ($surat == "domisili") {
			$data['judul'] = 'Cetak Domisili';

			$data['element'] .= '<table class="table table-borderless">';
			$data['element'] .= '<tbody>';
			$data['element'] .= '<tr>';
			$data['element'] .= '<th style="width:120px;border:none;">Nama</th>';
			$data['element'] .= '<td style="border:none;">: ' . $warga->nama . '</td>';
			$data['element'] .= '</tr>';
			$data['element'] .= '<tr>';
			$data['element'] .= '<th style="width:120px;border:none;">Alamat</th>';
			$data['element'] .= '<td style="border:none;">: ' . DUSUN[$warga->rw] . ', RT' . $warga->rt . ' RW ' . $warga->rw . '</td>';
			$data['element'] .= '</tr>';

			if ($hasil->jenis == "usaha") {
				$data['element'] .= '</tbody>';
				$data['element'] .= '</table>';
				$data['element'] .= "<p>Yang bersangkutan benar-benar warga Desa Sidomulyo yang memiliki usaha bernama $hasil->nama_usaha, yang beralamat di $hasil->alamat.</p><br/>";
			} else {
				$data['element'] .= '<tr>';
				$data['element'] .= '<th style="width:120px;border:none;">TTL</th>';
				$data['element'] .= '<td style="border:none; text-transform:capitalize;">: ' . $warga->tempat_lahir . ',' . $warga->tgl_lahir . '</td>';
				$data['element'] .= '</tr>';
				$data['element'] .= '<tr>';
				$data['element'] .= '<th style="width:120px;border:none;">Pekerjaan</th>';
				$data['element'] .= '<td style="border:none; text-transform:capitalize;">: ' . $warga->pekerjaan . '</td>';
				$data['element'] .= '</tr>';
				$data['element'] .= '<tr>';
				$data['element'] .= '<th style="width:120px;border:none;">Agama</th>';
				$data['element'] .= '<td style="border:none; text-transform:capitalize;">: ' . $warga->agama . '</td>';
				$data['element'] .= '</tr>';
				$data['element'] .= '<tr>';
				$data['element'] .= '<th style="width:120px;border:none;">Kawin</th>';
				$data['element'] .= '<td style="border:none; text-transform:capitalize;">: ' . PERKAWINAN[$warga->kawin] . '</td>';
				$data['element'] .= '</tr>';
				$data['element'] .= '</tbody>';
				$data['element'] .= '</table>';
				$data['element'] .= "<p>Yang bersangkutan benar-benar warga yang berdomisili di Desa Sidomulyo.</p><br/>";
			}
		}

		// $data['element'] .= "<p style='margin-top:-15px;'>Surat ini dibuat atas dasar yang sebenar-benarnya berdasarkan permohonan saudara/i $warga->nama ($hasil->nik)</p>";
		$data['element'] .= "<p style='margin-top:-15px;'>Demikian surat keterangan $judul ini dibuat untuk dapat digunakan sebagaimana semestinya.</p>";
		$data['element'] .= "</div>";
		$data['element'] .= '<div class="pull-right text-center" style="width: 250px; margin-top:20px; margin-right:50px; border-bottom:1px solid black;">';
		$data['element'] .= '<h5 for="">Desa Sidomulyo, ' . date("d M Y") . '</h5>';
		$data['element'] .= '<h5 for="">Kepala Desa</h5>';
		$data['element'] .= "<div style='width:7cm; display:inline-block;'>";
		if ($hasil->qrcode_file != "") {
			$data['element'] .= "<img src='" . base_url($hasil->qrcode_file) . "' style='width:2cm; float:left;'>";
		}
		if ($hasil->ttd_file != "") {
			$data['element'] .= "<img src='" . base_url($hasil->ttd_file) . "' style='width:5cm; float:right;'>";
		}
		$data['element'] .= "</div>";
		$data['element'] .= '<h5><strong>Drs. Suharto</strong></h5>';
		$data['element'] .= '</div>';
		$this->load->view('v_cetak', $data);
	}
}