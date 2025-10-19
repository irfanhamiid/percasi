<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Opr extends CI_Controller
{

	public $data;

	function __construct()
	{
		parent::__construct();
		if ((!isset($_SESSION['ID_OPR'])) || ($_SESSION['ID_OPR'] == 0)) {
			redirect('oprlogin');
		}
		date_default_timezone_set('Asia/Jakarta');
		$h = $this->db->query("SELECT * FROM instansi WHERE id=1");
		$this->data['INSTANSI'] = $h->row_array();
		$this->data['STATUS_AKTIF'] = array('Tidak Aktif', 'Aktif');
		$this->data['STATUS_AKTIF_CLR'] = array('danger', 'success');
		if (!isset($_SESSION['POPUP_MSG'])) {
			$_SESSION['POPUP_MSG'] = '';
			$_SESSION['POPUP_CLR'] = 'info';
		}
		//Gelar pendaftaran
		$g = array(
			'Reguler',
			'Grand Master/Woman Grand Master',
			'International Master/Woman International Master',
			'Fide Master/Woman Fide Master',
			'Candidate Master/Woman Candidate Master',
			'Wild Card 1',
			'Wild Card 2'
		);
		$this->data['GELAR'] = $g;
		$this->data['TimeLine'] = 0;
	}
	public function index()
	{
		$this->data['MnuAktif'] = 'Beranda';
		$this->data['SubMnuAktif'] = '';
		$this->load->view('opr_home', $this->data);
	}

	public function logout()
	{
		$_SESSION['ID_OPR'] = 0;
		$_SESSION['NM_OPR'] = '';
		$_SESSION['IDPROV_OPR'] = 0;
		$_SESSION['NMPROV_OPR'] = '';
		redirect('oprlogin');
	}

	// HIUTUNG ULANG */
	public function hitung_iuran_ev($idev = false)
	{
		if ($idev === false) {
		} else {
			$h = $this->db->query("SELECT * FROM events WHERE id_ev=? LIMIT 0,1", $idev);
			if ($h->num_rows() == 0) {
				$_SESSION['POPUP_MSG'] = 'Data events tidak tersedia...';
				$_SESSION['POPUP_CLR'] = 'error';
				redirect('opr/event/0');
			}
			$dtevent = $h->row_array();
			$this->load->model('Mymodel');
			//kategori
			$h = $this->db->query("SELECT * FROM kategoriev WHERE id_ev=?", $idev);
			$jmlktg = $h->num_rows();
			if ($jmlktg > 0) {
				//peserta per ktg
				$dtktg = $h->result();
				foreach ($dtktg as $dk) {
					$p = array($dk->id_ktg_ev, $idev);
					$cek = $this->db->query("SELECT COUNT(id_pst_ev) as jml FROM pesertaev WHERE id_ktg_ev=? AND id_ev=?", $p);
					$dcek = $cek->row_array();
					if ($dcek['jml'] == null) {
						$dcek['jml'] = 0;
					}
					$p = array($dcek['jml'], $dk->id_ktg_ev);
					$this->db->query("UPDATE kategoriev SET jml_peserta=? WHERE id_ktg_ev=?", $p);
				}
				unset($dtktg);
			}

			$h = $this->db->query("SELECT * FROM provinsi WHERE id_prov>0 ORDER BY id_prov ASC");
			if ($h->num_rows() > 0) {
				$dtprov = $h->result();
				foreach ($dtprov as $dt) {
					//jumlah bayar iuran per provinsi
					$p = array($idev, $dt->id_prov);
					$cek = $this->db->query("SELECT SUM(jml_bayar) AS jml FROM iuranev_byr WHERE id_ev=? AND id_prov=? AND 
					jenis_byr=1 AND status_verifikasi=1", $p);
					$dcek = $cek->row_array();
					if ($dcek['jml'] == null) {
						$dcek['jml'] = 0;
					}
					$cek2 = $this->db->query("SELECT * FROM iuranev WHERE id_ev=? AND id_prov=? LIMIT 0,1", $p);
					if ($cek2->num_rows() == 0) {
						$idiuran = 'EI' . $this->Mymodel->urut('EIDIURAN', 9999);
						$p = array($idiuran, $idev, $dt->id_prov, $dtevent['iuran_wjb'],  $dcek['jml'], 0, 0, 0, 0);
						$this->db->query("INSERT INTO iuranev (id_iuran_ev, id_ev, id_prov, jml_wajib, byr_wajib, 
							jml_registrasi, byr_registrasi, jml_akomodasi, byr_akomodasi) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)", $p);
					} else {
						$dcek2 = $cek2->row_array();
						$p = array($dtevent['iuran_wjb'], $dcek['jml'], $dcek2['id_iuran_ev']);
						$this->db->query("UPDATE iuranev SET jml_wajib=?, byr_wajib=? WHERE id_iuran_ev=?", $p);
					}

					//jumlah iuran registrasi per provinsi
					$p = array($idev, $dt->id_prov);
					$cek = $this->db->query("SELECT a.id_pst_ev, a.id_ktg_ev, a.id_gelar_ev, a.id_ev, a.id_prov, b.biaya_reg FROM 
						pesertaev AS a, gelarev AS b WHERE a.id_ev=? AND a.id_prov=? AND a.id_gelar_ev=b.id_gelar_ev", $p);
					if ($cek->num_rows() > 0) {
						$dcek = $cek->result();
						$jml = 0;
						foreach ($dcek as $dt) {
							$jml += $dt->biaya_reg;
						}
						$cek2 = $this->db->query("SELECT * FROM iuranev WHERE id_ev=? AND id_prov=? LIMIT 0,1", $p);
						if ($cek2->num_rows() == 0) {
							$idiuran = 'EI' . $this->Mymodel->urut('EIDIURAN', 9999);
							$p = array($idiuran, $idev, $dt->id_prov, $dtevent['iuran_wjb'], 0, $jml, 0);
							$this->db->query("INSERT INTO iuranev (id_iuran_ev, id_ev, id_prov, jml_wajib, byr_wajib, 
								jml_registrasi, byr_registrasi) VALUES (?, ?, ?, ?, ?, ?, ?)", $p);
						} else {
							$dcek2 = $cek2->row_array();
							$p = array($dtevent['iuran_wjb'], $jml,  $dcek2['id_iuran_ev']);
							$this->db->query("UPDATE iuranev SET  jml_wajib=?, jml_registrasi=? WHERE id_iuran_ev=?", $p);
						}
					}

					//jumlah akomodasi per provinsi
					$p = array($idev, $dt->id_prov);
					$cek = $this->db->query("SELECT a.id_pst_ev, a.id_ktg_ev, a.id_gelar_ev, a.id_ev, a.id_prov, b.biaya FROM 
						pesertaev AS a, akomodasiev AS b WHERE a.id_ev=? AND a.id_prov=? AND a.id_akomodasi_ev=b.id_akomodasi_ev", $p);
					if ($cek->num_rows() > 0) {
						$dcek = $cek->result();
						$jml = 0;
						foreach ($dcek as $dt) {
							$jml += $dt->biaya;
						}
						$cek2 = $this->db->query("SELECT * FROM iuranev WHERE id_ev=? AND id_prov=? LIMIT 0,1", $p);
						if ($cek2->num_rows() == 0) {
							$idiuran = 'EI' . $this->Mymodel->urut('EIDIURAN', 9999);
							$p = array($idiuran, $idev, $dt->id_prov, $dtevent['iuran_wjb'], 0, 0, 0, $jml, 0);
							$this->db->query("INSERT INTO iuranev (id_iuran_ev, id_ev, id_prov, jml_wajib, byr_wajib, 
								jml_registrasi, byr_registrasi,jml_akomodasi,byr_akomodasi) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)", $p);
						} else {
							$dcek2 = $cek2->row_array();
							$p = array($dtevent['iuran_wjb'], $jml,  $dcek2['id_iuran_ev']);
							$this->db->query("UPDATE iuranev SET  jml_wajib=?, jml_akomodasi=? WHERE id_iuran_ev=?", $p);
						}
					}

					//iuran registrasi sudah dibayar
					$p = array($idev, $dt->id_prov);
					$cek = $this->db->query("SELECT SUM(jml_bayar) AS jml FROM iuranev_byr WHERE id_ev=? AND id_prov=? AND 
					jenis_byr=2 AND status_verifikasi=1", $p);
					$dcek = $cek->row_array();
					if ($dcek['jml'] == null) {
						$dcek['jml'] = 0;
					}
					$cek2 = $this->db->query("SELECT * FROM iuranev WHERE id_ev=? AND id_prov=? LIMIT 0,1", $p);
					if ($cek2->num_rows() == 0) {
						$idiuran = 'EI' . $this->Mymodel->urut('EIDIURAN', 9999);
						$p = array($idiuran, $idev, $dt->id_prov, $dtevent['iuran_wjb'], 0, 0, $dcek['jml'], 0, 0);
						$this->db->query("INSERT INTO iuranev (id_iuran_ev, id_ev, id_prov, jml_wajib, byr_wajib, 
							jml_registrasi, byr_registrasi, jml_akomodasi, byr_akomodasi) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)", $p);
					} else {
						$dcek2 = $cek2->row_array();
						$p = array($dtevent['iuran_wjb'], $dcek['jml'], $dcek2['id_iuran_ev']);
						$this->db->query("UPDATE iuranev SET jml_wajib=?, byr_registrasi=? WHERE id_iuran_ev=?", $p);
					}

					//akomodasi sudah dibayar
					$p = array($idev, $dt->id_prov);
					$cek = $this->db->query("SELECT SUM(jml_bayar) AS jml FROM iuranev_byr WHERE id_ev=? AND id_prov=? AND 
					jenis_byr=3 AND status_verifikasi=1", $p);
					$dcek = $cek->row_array();
					if ($dcek['jml'] == null) {
						$dcek['jml'] = 0;
					}
					$cek2 = $this->db->query("SELECT * FROM iuranev WHERE id_ev=? AND id_prov=? LIMIT 0,1", $p);
					if ($cek2->num_rows() == 0) {
						$idiuran = 'EI' . $this->Mymodel->urut('EIDIURAN', 9999);
						$p = array($idiuran, $idev, $dt->id_prov, $dtevent['iuran_wjb'], 0, 0, 0, 0, $dcek['jml']);
						$this->db->query("INSERT INTO iuranev (id_iuran_ev, id_ev, id_prov, jml_wajib, byr_wajib, 
							jml_registrasi, byr_registrasi, jml_akomodasi, byr_akomodasi) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)", $p);
					} else {
						$dcek2 = $cek2->row_array();
						$p = array($dtevent['iuran_wjb'], $dcek['jml'], $dcek2['id_iuran_ev']);
						$this->db->query("UPDATE iuranev SET jml_wajib=?, byr_akomodasi=? WHERE id_iuran_ev=?", $p);
					}
				}
			}
		}
		return;
	}

	/* EVENTS */
	public function event($st = 0)
	{
		if ($st < 0) {
			$st = 0;
		}
		if ($st > 2) {
			$st = 2;
		}
		$p = array($st, $_SESSION['IDPROV_OPR']);
		$h = $this->db->query("SELECT a.*, b.nama_admin FROM events AS a, admin AS b WHERE 
			a.status_ev=? AND  a.id_admin=b.id_admin ORDER BY
			a.id_ev DESC", $st);
		$this->data['DtEvent'] = $h->result();
		$this->data['JmlEvent'] = $h->num_rows();
		$this->data['MnuAktif'] = 'Event';
		$this->data['SubMnuAktif'] = 'Event' . $st;
		$this->load->view('opr_event_' . $st, $this->data);
	}

	public function event_detail($idev = false)
	{
		if ($idev === false) {
		} else {
			$h = $this->db->query("SELECT * FROM events WHERE id_ev=? LIMIT 0,1", $idev);
			$j = $h->num_rows();
			if ($j == 0) {
				$_SESSION['POPUP_MSG'] = 'Data kejurnas tidak ada...';
				$_SESSION['POPUP_CLR'] = 'info';
				redirect('opr/event/0');
			} else {
				$this->data['DtEvent'] = $h->row_array();
				$stev = $this->data['DtEvent']['status_ev'];
				$h = $this->db->query("SELECT * FROM kategoriev WHERE id_ev=? ORDER BY kategori ASC", $idev);
				$j = $h->num_rows();
				$this->data['DtKtg'] = $h->result();
				$this->data['JmlKtg'] = $j;
				$h = $this->db->query("SELECT * FROM gelarev WHERE id_ev=? ORDER BY gelar ASC", $idev);
				$j = $h->num_rows();
				$this->data['DtGelar'] = $h->result();
				$this->data['JmlGelar'] = $j;
				$this->data['MnuAktif'] = 'Event';
				$this->data['SubMnuAktif'] = 'Event' . $stev;
				$this->load->view('opr_event_detail_' . $stev, $this->data);
			}
		}
	}

	//Event Peserta
	public function event_peserta($idev = false, $tg = 'scr')
	{
		if ($idev === false) {
		} else {
			$h = $this->db->query("SELECT * FROM events WHERE id_ev=? LIMIT 0,1", $idev);
			if ($h->num_rows() == 0) {
				$_SESSION['POPUP_MSG'] = 'Data events tidak tersedia...';
				$_SESSION['POPUP_CLR'] = 'error';
				redirect('opr/event/0');
			} else {
				$this->data['DtEvent'] = $h->row_array();
				$stev = $this->data['DtEvent']['status_ev'];
				$h = $this->db->query(
					"SELECT a.*, d.kategori, b.gelar, b.biaya_reg,c.biaya FROM pesertaev AS a, 
							 gelarev AS b,  kategoriev AS d,akomodasiev c WHERE a.id_ev=? AND a.id_prov=? AND
							a.id_gelar_ev=b.id_gelar_ev AND a.id_ktg_ev=d.id_ktg_ev AND a.id_akomodasi_ev=c.id_akomodasi_ev
							ORDER BY a.nama_pst ASC",
					array($idev, $_SESSION['IDPROV_OPR'])
				);

				$this->data['JmlPst'] = $h->num_rows();
				$this->data['DtPst'] = $h->result();


				$this->data['MnuAktif'] = 'Event';
				$this->data['SubMnuAktif'] = 'Event' . $stev;
				//echo json_encode($hasil); die();
				if ($tg == 'scr') {
					$this->load->view('opr_event_peserta_' . $stev, $this->data);
				} else {
					$this->load->view('opr_event_peserta_ctk', $this->data);
				}
			}
		}
	}


	public function event_peserta_new($idev = false)
	{
		if (isset($_POST['nik'])) {
			$this->load->model('Mymodel');
			$idpst = 'EP' . $this->Mymodel->urut('EIDPST', 9999);
			$p = array(
				$idpst,
				$_POST['idnasional'],
				$_POST['ktg'],
				$_POST['glr'],
				$_POST['akomodasi'],
				$_POST['idev'],
				$_SESSION['IDPROV_OPR'],
				$_POST['namapst'],
				$_POST['jk'],
				$_POST['tgllahir'],
				$_POST['umur'],
				$_POST['nik'],
				$_POST['telepon'],
				$_SESSION['ID_OPR']
			);
			$this->db->query("INSERT INTO pesertaev (id_pst_ev,id_nasional, id_ktg_ev, id_gelar_ev,id_akomodasi_ev, id_ev, id_prov, nama_pst, jk_pst, 
				tgl_lahir, umur, nik, telepon, juara, id_operator, id_admin) VALUES (?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?, 0, ?, 1)", $p);
			//updt jml pst
			$this->db->query("UPDATE kategoriev SET jml_peserta=jml_peserta+1 WHERE id_ktg_ev=?", $_POST['ktg']);

			$this->hitung_iuran_ev($_POST['idev']);


			redirect('opr/event_peserta/' . $_POST['idev']);
		}
		if ($idev === false) {
		} else {
			$h = $this->db->query("SELECT * FROM events WHERE id_ev=? AND status_ev=0 LIMIT 0,1", $idev);
			$j = $h->num_rows();
			if ($j == 0) {
				$_SESSION['POPUP_MSG'] = 'Data kejurnas tidak ada atau anda tidak berhak mengakses...';
				$_SESSION['POPUP_CLR'] = 'error';
				redirect('opr/event/0');
			} else {
				$this->data['DtEvent'] = $h->row_array();
				$stev = $this->data['DtEvent']['status_ev'];

				$h = $this->db->query("SELECT * FROM kategoriev WHERE id_ev=? ORDER BY kategori ASC", $idev);
				$j = $h->num_rows();
				$this->data['DtKtg'] = $h->result();
				$this->data['JmlKtg'] = $j;
				$h = $this->db->query("SELECT * FROM gelarev WHERE id_ev=? ORDER BY gelar ASC", $idev);
				$j = $h->num_rows();
				$this->data['DtGelar'] = $h->result();
				$this->data['JmlGelar'] = $j;
				$h = $this->db->query("SELECT * FROM akomodasiev ORDER BY id_akomodasi_ev ASC");
				$this->data['DtAkomodasi'] = $h->result();

				$this->data['MnuAktif'] = 'Event';
				$this->data['SubMnuAktif'] = 'Event' . $stev;
				$this->load->view('opr_event_peserta_new', $this->data);
			}
		}
	}

	//Edit peserta
	public function event_peserta_edit($idpst = false)
	{
		if (isset($_POST['nik'])) {
			$holdpst = $this->db->query("SELECT * FROM pesertaev WHERE id_pst_ev=? LIMIT 0,1", $_POST['idpst']);
			$dtold = $holdpst->row_array();
			$p = array(
				$_POST['idnasional'],
				$_POST['ktg'],
				$_POST['glr'],
				$_POST['akomodasi'],
				$_POST['namapst'],
				$_POST['jk'],
				$_POST['tgllahir'],
				$_POST['umur'],
				$_POST['nik'],
				$_POST['telepon'],
				$_SESSION['ID_OPR'],
				$_POST['idpst']
			);
			$this->db->query("UPDATE pesertaev SET id_nasional=?,id_ktg_ev=?, id_gelar_ev=?,id_akomodasi_ev=?, nama_pst=?, jk_pst=?, tgl_lahir=?, umur=?,
				nik=?, telepon=?, id_operator=? WHERE id_pst_ev=?", $p);
			//updt jml pst
			if ($dtold['id_ktg_ev'] != $_POST['ktg']) {
				$this->db->query("UPDATE kategoriev SET jml_peserta=jml_peserta-1 WHERE id_ktg_ev=?", $dtold['id_ktg_kj']);
				$this->db->query("UPDATE kategoriev SET jml_peserta=jml_peserta+1 WHERE id_ktg_ev=?", $_POST['ktg']);
			}
			$this->hitung_iuran_ev($_POST['idev']);


			redirect('opr/event_peserta/' . $_POST['idev']);
		}
		if ($idpst === false) {
		} else {
			$hpst = $this->db->query("SELECT * FROM pesertaev WHERE id_pst_ev=? LIMIT 0,1", $idpst);
			$e = 0;
			$psn = '';
			if ($hpst->num_rows() == 0) {
				$_SESSION['POPUP_MSG'] = '<p>Data peserta tidak ditemukan...</p>';
				$_SESSION['POPUP_CLR'] = 'error';
				redirect('opr/event/0');
			}
			$this->data['DtPst'] = $hpst->row_array();

			$hkj = $this->db->query("SELECT * FROM events WHERE id_ev=? AND status_ev=0 LIMIT 0,1", $this->data['DtPst']['id_ev']);
			$j = $hkj->num_rows();
			if ($j == 0) {
				$e = 1;
				$psn .= '<p>Data event tidak ditemukan...</p>';
			}
			if ($e == 1) {
				$_SESSION['POPUP_MSG'] = $psn;
				$_SESSION['POPUP_CLR'] = 'info';
				redirect('opr/event/0');
			} else {
				$this->data['DtEvent'] = $hkj->row_array();
				$stev = $this->data['DtEvent']['status_ev'];

				$h = $this->db->query("SELECT * FROM kategoriev WHERE id_ev=? ORDER BY kategori ASC", $this->data['DtEvent']['id_ev']);
				$j = $h->num_rows();
				$this->data['DtKtg'] = $h->result();
				$this->data['JmlKtg'] = $j;
				$h = $this->db->query("SELECT * FROM gelarev WHERE id_ev=? ORDER BY gelar ASC", $this->data['DtEvent']['id_ev']);
				$j = $h->num_rows();
				$this->data['DtGelar'] = $h->result();
				$this->data['JmlGelar'] = $j;
				$h = $this->db->query("SELECT * FROM akomodasiev ORDER BY id_akomodasi_ev ASC");
				$this->data['DtAkomodasi'] = $h->result();

				$this->data['MnuAktif'] = 'Event';
				$this->data['SubMnuAktif'] = 'Event' . $stev;
				$this->load->view('opr_event_peserta_edit', $this->data);
			}
		}
	}

	// PESERTA PENATARAN
	public function event_peserta_penataran($idev = false, $tg = 'scr')
	{
		if ($idev === false) {
		} else {
			$h = $this->db->query("SELECT * FROM events WHERE id_ev=? LIMIT 0,1", $idev);
			if ($h->num_rows() == 0) {
				$_SESSION['POPUP_MSG'] = 'Data events tidak tersedia...';
				$_SESSION['POPUP_CLR'] = 'error';
				redirect('opr/event/0');
			} else {
				$this->data['DtEvent'] = $h->row_array();
				$stev = $this->data['DtEvent']['status_ev'];
				$h = $this->db->query(
					"SELECT a.*,b.nama_penataran,b.biaya FROM penataran_peserta a,penataran b WHERE a.id_event=? AND a.id_provinsi=?",
					array($idev, $_SESSION['IDPROV_OPR'])
				);

				$this->data['JmlPst'] = $h->num_rows();
				$this->data['DtPst'] = $h->result();


				$this->data['MnuAktif'] = 'Event';
				$this->data['SubMnuAktif'] = 'Event' . $stev;
				//echo json_encode($hasil); die();
				if ($tg == 'scr') {
					$this->load->view('opr_event_peserta_penataran_' . $stev, $this->data);
				} else {
					$this->load->view('opr_event_peserta_penataran_ctk', $this->data);
				}
			}
		}
	}


	public function event_peserta_penataran_new($idev = false)
	{
		// Jika form dikirim (submit)
		if (isset($_POST['idev'])) {
			$this->load->model('Mymodel');

			// === Upload KTP ===
			$fn1 = $_FILES['file_ktp']['tmp_name'];
			$fz1 = $_FILES['file_ktp']['size'];
			$fext1 = pathinfo($_FILES['file_ktp']['name'], PATHINFO_EXTENSION);
			$file_ktp = 'KTP' . $this->Mymodel->urut('EIDKTP', 9999);

			// === Upload Rekomendasi ===
			$fn2 = $_FILES['file_rekom']['tmp_name'];
			$fz2 = $_FILES['file_rekom']['size'];
			$fext2 = pathinfo($_FILES['file_rekom']['name'], PATHINFO_EXTENSION);
			$file_rekom = 'RKM' . $this->Mymodel->urut('EIDRKM', 9999);

			// === Upload Foto ===
			$fn3 = $_FILES['file_foto']['tmp_name'];
			$fz3 = $_FILES['file_foto']['size'];
			$fext3 = pathinfo($_FILES['file_foto']['name'], PATHINFO_EXTENSION);
			$file_foto = 'PFT' . $this->Mymodel->urut('EIDPFT', 9999);

			// === ID Peserta ===
			$idpst = 'EPP' . $this->Mymodel->urut('EIDPP', 9999);

			// === Data Peserta ===
			$p = [
				$idpst,
				$_SESSION['IDPROV_OPR'],
				$_POST['id_penataran'],
				$_POST['idev'],
				$_POST['tempat_lahir'],
				$_POST['tanggal_lahir'],
				$_POST['nama_peserta'],
				$_POST['jenis_kelamin'],
				$file_ktp . '.' . $fext1,
				$file_rekom . '.' . $fext2,
				$file_foto . '.' . $fext3,
			];

			// === Simpan ke Database ===
			$this->db->query("INSERT INTO penataran_peserta (id_peserta, id_provinsi, id_penataran, id_event, tempat_lahir, tanggal_lahir, nama_peserta, jenis_kelamin, file_ktp, file_rekom, file_foto) VALUES (?,?,?,?,?,?,?,?,?,?,?)", $p);

			// === Pindahkan File ===
			if ($fz1 > 0) move_uploaded_file($fn1, 'img/ktp/' . $file_ktp . '.' . $fext1);
			if ($fz2 > 0) move_uploaded_file($fn2, 'img/rekomendasi/' . $file_rekom . '.' . $fext2);
			if ($fz3 > 0) move_uploaded_file($fn3, 'img/pas_foto/' . $file_foto . '.' . $fext3);

			redirect('opr/event_peserta/' . $_POST['idev']);
			return;
		}

		// === Kalau parameter idev tidak dikirim ===
		if ($idev === false) {
			return;
		}

		// === Validasi Event ===
		$h = $this->db->query("SELECT * FROM events WHERE id_ev=? AND status_ev=0 LIMIT 1", $idev);
		if ($h->num_rows() == 0) {
			$_SESSION['POPUP_MSG'] = 'Data kejurnas tidak ada atau anda tidak berhak mengakses...';
			$_SESSION['POPUP_CLR'] = 'error';
			redirect('opr/event/0');
			return;
		}

		// === Load Data Event ===
		$this->data['DtEvent'] = $h->row_array();
		$stev = $this->data['DtEvent']['status_ev'];

		// === Load Data Tambahan ===
		$this->data['DtAkomodasi'] = $this->db->query("SELECT * FROM akomodasiev ORDER BY id_akomodasi_ev ASC")->result();
		$this->data['DtPenataran'] = $this->db->query("SELECT * FROM penataran WHERE id_event=? ORDER BY id_penataran ASC", $idev)->result();

		// === Render View ===
		$this->data['MnuAktif'] = 'Event';
		$this->data['SubMnuAktif'] = 'Event' . $stev;

		$this->load->view('opr_event_peserta_penataran_new', $this->data);
	}


	//Edit peserta
	public function event_peserta_penataran_edit($idpst = false)
	{
		if (isset($_POST['idpst'])) {

			$this->load->model('Mymodel');
			$holdpst = $this->db->query("SELECT * FROM penataran_peserta WHERE id_peserta=? LIMIT 1", $_POST['idpst']);
			$dtold = $holdpst->row_array();

			if (!$dtold) {
				$_SESSION['POPUP_MSG'] = '<p>Data peserta tidak ditemukan...</p>';
				$_SESSION['POPUP_CLR'] = 'error';
				redirect('opr/event/0');
			}

			// === Handle file upload ===
			// fungsi bantu
			function handle_upload($input_name, $prefix, $folder, $old_file, $mymodel)
			{
				if (!empty($_FILES[$input_name]['name'])) {
					$tmp = $_FILES[$input_name]['tmp_name'];
					$ext = pathinfo($_FILES[$input_name]['name'], PATHINFO_EXTENSION);
					$new_name = $prefix . $mymodel->urut('EID' . strtoupper($prefix), 9999) . '.' . $ext;
					$target = $folder . $new_name;

					// hapus file lama
					if (!empty($old_file) && file_exists($folder . $old_file)) {
						unlink($folder . $old_file);
					}

					move_uploaded_file($tmp, $target);
					return $new_name;
				} else {
					return $old_file; // kalau gak upload baru, pake lama
				}
			}

			$file_ktp   = handle_upload('file_ktp',   'KTP', 'img/ktp/', $dtold['file_ktp'], $this->Mymodel);
			$file_rekom = handle_upload('file_rekom', 'RKM', 'img/rekomendasi/', $dtold['file_rekom'], $this->Mymodel);
			$file_foto  = handle_upload('file_foto',  'PFT', 'img/pas_foto/', $dtold['file_foto'], $this->Mymodel);

			// === Update database ===
			$data = [
				'id_penataran'   => $_POST['id_penataran'],
				'tempat_lahir'   => $_POST['tempat_lahir'],
				'tanggal_lahir'  => $_POST['tanggal_lahir'],
				'nama_peserta'   => $_POST['nama_peserta'],
				'jenis_kelamin'  => $_POST['jenis_kelamin'],
				'file_ktp'       => $file_ktp,
				'file_rekom'     => $file_rekom,
				'file_foto'      => $file_foto
			];

			$this->db->where('id_peserta', $_POST['idpst']);
			$this->db->update('penataran_peserta', $data);

			redirect('opr/event_peserta_penataran/' . $_POST['idev']);
		}

		// === Kalau belum submit (tampilan form edit) ===
		if ($idpst === false) return;

		$hpst = $this->db->query("SELECT * FROM penataran_peserta WHERE id_peserta=? LIMIT 1", $idpst);
		if ($hpst->num_rows() == 0) {
			$_SESSION['POPUP_MSG'] = '<p>Data peserta tidak ditemukan...</p>';
			$_SESSION['POPUP_CLR'] = 'error';
			redirect('opr/event/0');
		}

		$this->data['DtPst'] = $hpst->row_array();
		$hkj = $this->db->query("SELECT * FROM events WHERE id_ev=? AND status_ev=0 LIMIT 1", $this->data['DtPst']['id_event']);
		if ($hkj->num_rows() == 0) {
			$_SESSION['POPUP_MSG'] = '<p>Data event tidak ditemukan...</p>';
			$_SESSION['POPUP_CLR'] = 'info';
			redirect('opr/event/0');
		}

		$this->data['DtEvent'] = $hkj->row_array();
		$stev = $this->data['DtEvent']['status_ev'];
		$this->data['MnuAktif'] = 'Event';
		$this->data['SubMnuAktif'] = 'Event' . $stev;

		$h = $this->db->query("SELECT * FROM penataran WHERE id_event=? ORDER BY id_penataran ASC", $this->data['DtPst']['id_event']);
		$this->data['DtPenataran'] = $h->result();
		$this->load->view('opr_event_peserta_penataran_edit', $this->data);
	}


	//Hapus peserta
	public function xkejurnas_peserta_del($idpst = false)
	{
		if ($idpst === false) {
		} else {
			$p = array($idpst, $_SESSION['IDPROV_OPR']);
			$hpst = $this->db->query("SELECT * FROM pesertakj WHERE id_pst_kj=? AND id_prov=? LIMIT 0,1", $p);
			if ($hpst->num_rows() == 0) {
				$_SESSION['POPUP_MSG'] = 'Data peserta tidak ada atau anda tidak berhak mengakses...';
				$_SESSION['POPUP_CLR'] = 'info';
				redirect('opr/kejurnas');
			}
			$dtpst = $hpst->row_array();
			$this->db->query("DELETE FROM pesertakj WHERE id_pst_kj=?", $idpst);
			//updt jml pst
			$this->db->query("UPDATE kategorikj SET jml_peserta=jml_peserta-1 WHERE id_ktg_kj=?", $dtpst['id_ktg_kj']);

			$p = array($dtpst['id_kj'], $_SESSION['IDPROV_OPR']);
			$hpstby = $this->db->query("SELECT a.*, b.biaya_reg FROM pesertakj AS a, gelarkj AS b WHERE a.id_kj=? AND a.id_prov=? AND a.id_gelar_kj=b.id_gelar_kj", $p);
			$dtpstby = $hpstby->result();
			$jmlpstby = $hpstby->num_rows();
			$jmlbayar = 0;
			if ($jmlpstby > 0) {
				foreach ($dtpstby as $p) {
					$jmlbayar += $p->biaya_reg;
				}
			}

			//baca iuran wajib
			$hwjb = $this->db->query("SELECT iuran_wjb FROM kejurnas WHERE id_kj=? LIMIT 0,1", $dtpst['id_kj']);
			$dtwjb = $hwjb->row_array();
			//update iuran kj

			$p = array($dtpst['id_kj'], $_SESSION['IDPROV_OPR']);
			$cekiuran = $this->db->query("SELECT * FROM iurankj WHERE id_kj=? AND id_prov=? LIMIT 0,1", $p);
			if ($cekiuran->num_rows() == 0) {
				$this->load->model('Mymodel');
				$idiuran = 'IK' . $this->Mymodel->urut('IDIURANKJ', 9999);
				$p = array($idiuran, $dtpst['id_kj'], $_SESSION['IDPROV_OPR'], $dtwjb['iuran_wjb'], $jmlbayar);
				$this->db->query("INSERT INTO iurankj (id_iuran_kj, id_kj, id_prov, jml_wajib, byr_wajib, jml_registrasi, 
					byr_registrasi) VALUES (?, ?, ?, ?, 0, ?, 0)", $p);
			} else {
				$dtiuran = $cekiuran->row_array();
				$p = array($jmlbayar, $dtiuran['id_iuran_kj']);
				$this->db->query("UPDATE iurankj SET jml_registrasi=? WHERE id_iuran_kj=?", $p);
			}
			redirect('opr/kejurnas_peserta/' . $dtpst['id_kj']);
		}
	}

	/* IURAN */

	public function event_iuran($idev = false, $tg = 'scr')
	{
		if ($idev === false) {
		} else {
			$h = $this->db->query("SELECT * FROM events WHERE id_ev=? LIMIT 0,1", $idev);
			$j = $h->num_rows();
			if ($j == 0) {
				$_SESSION['POPUP_MSG'] = 'Data events tidak ada atau anda tidak berhak mengakses...';
				$_SESSION['POPUP_CLR'] = 'error';
				redirect('opr/event/0');
			} else {
				$this->data['DtEvent'] = $h->row_array();
				$stev = $this->data['DtEvent']['status_ev'];
				$p = array($idev, $_SESSION['IDPROV_OPR']);
				$h = $this->db->query("SELECT * FROM iuranev WHERE id_ev=? AND id_prov=? LIMIT 0,1", $p);
				$j = $h->num_rows();
				$dtiuran = $h->row_array();
				$this->data['DtIuran'] = $dtiuran;
				$this->data['JmlIuran'] = $j;
				$id_provinsi = $_SESSION['IDPROV_OPR'];
				$this->data['penataran'] = $this->db->query("SELECT 
    t.id_event,
    SUM(t.jumlah_peserta * t.biaya) AS total_tagihan,
    IFNULL(pb.total_bayar, 0) AS total_bayar,
    (SUM(t.jumlah_peserta * t.biaya) - IFNULL(pb.total_bayar, 0)) AS sisa_tagihan
FROM (
    SELECT 
        pn.id_event,
        pn.id_penataran,
        pn.biaya,
        COUNT(pp.id_peserta) AS jumlah_peserta
    FROM penataran_peserta pp
    JOIN penataran pn ON pn.id_penataran = pp.id_penataran
    WHERE pp.id_provinsi = '$id_provinsi'
      AND pn.id_event = '$idev'
    GROUP BY pn.id_penataran, pn.id_event, pn.biaya
) AS t
LEFT JOIN (
    SELECT 
        id_event,
        id_provinsi,
        SUM(jumlah_bayar) AS total_bayar
    FROM penataran_bayar
    WHERE id_provinsi = '$id_provinsi'
      AND id_event = '$idev'
	  AND status_verifikasi = '1'
    GROUP BY id_event, id_provinsi
) AS pb 
ON pb.id_event = t.id_event
GROUP BY t.id_event;
")->row_array();
				//bayar
				if ($dtiuran != null) {
					$p = array($dtiuran['id_iuran_ev'], $_SESSION['IDPROV_OPR']);
				}
				$h = $this->db->query("SELECT a.*, b.nama_admin FROM iuranev_byr AS a, admin AS b WHERE a.id_iuran_ev=? AND a.id_prov=? AND a.jenis_byr=1 
					AND a.id_admin=b.id_admin ORDER BY a.id_byr ASC", $p);
				$this->data['DtByrWjb'] = $h->result();
				$this->data['JmlByrWjb'] = $h->num_rows();
				$h = $this->db->query("SELECT a.*, b.nama_admin FROM iuranev_byr AS a, admin AS b WHERE a.id_iuran_ev=? AND a.id_prov=? AND a.jenis_byr=2 
					AND a.id_admin=b.id_admin ORDER BY a.id_byr ASC", $p);
				$this->data['DtByrReg'] = $h->result();
				$this->data['JmlByrReg'] = $h->num_rows();
				$h = $this->db->query("SELECT a.*, b.nama_admin FROM iuranev_byr AS a, admin AS b WHERE a.id_iuran_ev=? AND a.id_prov=? AND a.jenis_byr=3 
					AND a.id_admin=b.id_admin ORDER BY a.id_byr ASC", $p);
				$this->data['DtByrAkomodasi'] = $h->result();
				$this->data['JmlByrAkomodasi'] = $h->num_rows();
				$h = $this->db->query("SELECT * FROM penataran_bayar WHERE id_event = '$idev' AND id_provinsi = $id_provinsi");
				$this->data['BayarPenataran'] = $h->num_rows();
				$this->data['BuktiBayarPenataran'] = $h->result();
				$this->data['MnuAktif'] = 'Event';
				$this->data['SubMnuAktif'] = 'Event' . $stev;
				if ($tg == 'scr') {
					$this->load->view('opr_event_iuran_' . $stev, $this->data);
				} else {
					$this->load->view('opr_event_iuran_ctk', $this->data);
				}
			}
		}
	}

	public function event_iuran_byr_new($idev = false)
	{
		if (isset($_POST['jenisbyr'])) {
			$fn = $_FILES['bukti']['tmp_name'];
			$fz = $_FILES['bukti']['size'];
			$fext = pathinfo($_FILES['bukti']['name'], PATHINFO_EXTENSION);

			$p = array($_POST['idev'], $_SESSION['IDPROV_OPR']);
			$hiuranev = $this->db->query("SELECT * FROM iuranev WHERE id_ev=? AND id_prov=? LIMIT 0, 1", $p);
			$dtiuran = $hiuranev->row_array();
			$this->load->model('Mymodel');
			$idbyr = 'BE' . $this->Mymodel->urut('EIDBYREV', 9999);
			$p = array(
				$idbyr,
				$_POST['idev'],
				$dtiuran['id_iuran_ev'],
				$_SESSION['IDPROV_OPR'],
				$_SESSION['ID_OPR'],
				1,
				$_POST['tglbayar'],
				$_POST['jmlbayar'],
				$_POST['jenisbyr'],
				$_POST['carabyr'],
				$_POST['namapembayar'],
				addslashes($_POST['catatan']),
				$_POST['daribank'],
				$_POST['darirek'],
				$_POST['namapenerima'],
				'',
				$_POST['kebank'],
				$_POST['kerek'],
				$idbyr . '.' . $fext,
				'',
				0
			);
			$h = $this->db->query("INSERT INTO iuranev_byr (id_byr, id_ev, id_iuran_ev, id_prov, id_operator, id_admin, tgl_bayar,
				jml_bayar, jenis_byr, cara_byr, nama_pembayar, note_pembayar, dari_bank, dari_rek, nama_penerima, note_penerima,
				ke_bank, ke_rek,bukti , tgl_verifikasi, status_verifikasi) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)", $p);

			if ($fz > 0) {
				move_uploaded_file($fn, 'img/bayar/' . $idbyr . '.' . $fext);
			}
			redirect('opr/event_iuran/' . $_POST['idev']);
		}
		if ($idev === false) {
		} else {
			$h = $this->db->query("SELECT * FROM events WHERE id_ev=? LIMIT 0,1", $idev);
			$j = $h->num_rows();
			if ($j == 0) {
				$_SESSION['POPUP_MSG'] = 'Data events tidak ada atau anda tidak berhak mengakses...';
				$_SESSION['POPUP_CLR'] = 'error';
				redirect('opr/event/0');
			} else {
				$this->data['DtEvent'] = $h->row_array();
				$stev = $this->data['DtEvent']['status_ev'];

				$this->data['MnuAktif'] = 'Event';
				$this->data['SubMnuAktif'] = 'Event' . $stev;
				$this->load->view('opr_event_iuran_byr_new', $this->data);
			}
		}
	}

	public function event_iuran_byr_edit($idbyr = false)
	{
		if (isset($_POST['idbyr'])) {
			$fn = $_FILES['bukti']['tmp_name'];
			$fz = $_FILES['bukti']['size'];
			$fext = pathinfo($_FILES['bukti']['name'], PATHINFO_EXTENSION);
			if ($fz > 0) {
				$p = array(
					$_SESSION['ID_OPR'],
					$_POST['tglbayar'],
					$_POST['jmlbayar'],
					$_POST['jenisbyr'],
					$_POST['carabyr'],
					$_POST['namapembayar'],
					$_POST['catatan'],
					$_POST['daribank'],
					$_POST['darirek'],
					$_POST['kebank'],
					$_POST['kerek'],
					$_POST['namapenerima'],
					$_POST['idbyr'] . '.' . $fext,
					$_POST['idbyr']
				);
				$this->db->query("UPDATE iuranev_byr SET id_operator=?, tgl_bayar=?, jml_bayar=?, jenis_byr=?, cara_byr=?, 
				nama_pembayar=?, note_pembayar=?, dari_bank=?, dari_rek=?, ke_bank=?, ke_rek=?, nama_penerima=?,bukti=?  WHERE id_byr=?", $p);
				move_uploaded_file($fn, 'img/bayar/' . $_POST['idbyr'] . '.' . $fext);
			} else {
				$p = array(
					$_SESSION['ID_OPR'],
					$_POST['tglbayar'],
					$_POST['jmlbayar'],
					$_POST['jenisbyr'],
					$_POST['carabyr'],
					$_POST['namapembayar'],
					$_POST['catatan'],
					$_POST['daribank'],
					$_POST['darirek'],
					$_POST['kebank'],
					$_POST['kerek'],
					$_POST['namapenerima'],
					$_POST['idbyr']
				);
				$this->db->query("UPDATE iuranev_byr SET id_operator=?, tgl_bayar=?, jml_bayar=?, jenis_byr=?, cara_byr=?, 
				nama_pembayar=?, note_pembayar=?, dari_bank=?, dari_rek=?, ke_bank=?, ke_rek=?, nama_penerima=?  WHERE id_byr=?", $p);
			}
			redirect('opr/event_iuran/' . $_POST['idev']);
		}
		if ($idbyr === false) {
		} else {
			$e = 0;
			$psn = '';
			$cek = $this->db->query("SELECT * FROM iuranev_byr WHERE id_byr=? LIMIT 0,1", $idbyr);
			if ($cek->num_rows() == 0) {
				$e = 1;
				$psn .= '<p>Data tidak ditemukan !</p>';
			}
			$dbyr = $cek->row_array();
			if ($dbyr['status_verifikasi'] > 0) {
				$e = 1;
				$psn .= '<p>Pembayaran sudah diverisikai, tidak bisa diubah !</p>';
			}

			if ($e == 1) {
				$_SESSION['POPUP_MSG'] = $psn;
				$_SESSION['POPUP_CLR'] = 'error';
				redirect('opr/event_iuran/', $dbyr['id_ev']);
			}
			$this->data['DtBayar'] = $dbyr;
			$h = $this->db->query("SELECT * FROM events WHERE id_ev=? LIMIT 0,1", $dbyr['id_ev']);
			$j = $h->num_rows();
			if ($j == 0) {
				$_SESSION['POPUP_MSG'] = 'Data event tidak ada atau anda tidak berhak mengakses...';
				$_SESSION['POPUP_CLR'] = 'info';
				redirect('opr/event/0');
			} else {
				$test = $this->db->query("SELECT * FROM iuranev_byr WHERE id_byr='$idbyr'")->row();
				$this->data['DtEvent'] = $h->row_array();
				$stev = $this->data['DtEvent']['status_ev'];

				$this->data['MnuAktif'] = 'Event';
				$this->data['SubMnuAktif'] = 'Event' . $stev;
				$gb = '/img/bayar/' . $test->bukti;
				if (file_exists('.' . $gb)) {
					$this->data['Bukti'] = base_url() . $gb;
				} else {
					$this->data['Bukti'] = base_url() . 'img/noimage.jpg';
				}
				$this->load->view('opr_event_iuran_byr_edit', $this->data);
			}
		}
	}

	public function event_iuran_byr_del($idbyr = false)
	{
		if ($idbyr === false) {
		} else {
			$e = 0;
			$psn = '';
			$cek = $this->db->query("SELECT * FROM iuranev_byr WHERE id_byr=? LIMIT 0,1", $idbyr);
			if ($cek->num_rows() == 0) {
				$e = 1;
				$psn .= '<p>Data tidak ditemukan !</p>';
			}
			$dbyr = $cek->row_array();
			if ($dbyr['status_verifikasi'] > 0) {
				$e = 1;
				$psn .= '<p>Pembayaran sudah diverisikai, tidak bisa diubah !</p>';
			}

			if ($e == 1) {
				$_SESSION['POPUP_MSG'] = $psn;
				$_SESSION['POPUP_CLR'] = 'error';
				redirect('opr/event_iuran/', $dbyr['id_ev']);
			}

			//hapus
			$this->db->query("DELETE FROM iuranev_byr WHERE id_byr=?", $idbyr);

			$f = './img/bayar/' . $dbyr['id_byr'] . '.jpg';
			if (file_exists($f)) {
				unlink($f);
			}
			redirect('opr/event_iuran/' . $dbyr['id_ev']);
		}
	}

	public function event_penataran_bayar_new($idev = false)
	{
		if (isset($_POST['jumlah_bayar'])) {
			$fn = $_FILES['bukti']['tmp_name'];
			$fz = $_FILES['bukti']['size'];
			$fext = pathinfo($_FILES['bukti']['name'], PATHINFO_EXTENSION);

			$p = array($_POST['idev'], $_SESSION['IDPROV_OPR']);

			$this->load->model('Mymodel');
			$idbyr = 'BP' . $this->Mymodel->urut('EIDBYRPT', 9999);
			$p = array(
				$idbyr,
				$_SESSION['IDPROV_OPR'],
				$_POST['idev'],
				$_POST['jumlah_bayar'],
				$_POST['tanggal_bayar'],
				$_POST['cara_bayar'],
				$_POST['namapembayar'],
				$_POST['daribank'],
				$_POST['darirek'],
				$_POST['namapenerima'],
				$_POST['kebank'],
				$_POST['kerek'],
				$idbyr . '.' . $fext,
				0
			);
			$h = $this->db->query("INSERT INTO penataran_bayar (id_pembayaran, id_provinsi, id_event, jumlah_bayar, tanggal_bayar, cara_bayar, nama_pembayar,
				dari_bank, dari_rek, nama_penerima, ke_bank, ke_rek, bukti, status_verifikasi) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)", $p);

			if ($fz > 0) {
				move_uploaded_file($fn, 'img/bayar/' . $idbyr . '.' . $fext);
			}
			redirect('opr/event_iuran/' . $_POST['idev']);
		}
		if ($idev === false) {
		} else {
			$h = $this->db->query("SELECT * FROM events WHERE id_ev=? LIMIT 0,1", $idev);
			$j = $h->num_rows();
			if ($j == 0) {
				$_SESSION['POPUP_MSG'] = 'Data events tidak ada atau anda tidak berhak mengakses...';
				$_SESSION['POPUP_CLR'] = 'error';
				redirect('opr/event/0');
			} else {
				$this->data['DtEvent'] = $h->row_array();
				$stev = $this->data['DtEvent']['status_ev'];

				$this->data['MnuAktif'] = 'Event';
				$this->data['SubMnuAktif'] = 'Event' . $stev;
				$this->load->view('opr_penataran_bayar_new', $this->data);
			}
		}
	}

	public function event_penataran_bayar_edit($idbyr = false)
	{
		if (isset($_POST['idbyr'])) {
			$fn = $_FILES['bukti']['tmp_name'];
			$fz = $_FILES['bukti']['size'];
			$fext = pathinfo($_FILES['bukti']['name'], PATHINFO_EXTENSION);
			$this->load->model('Mymodel');
			$idbyr = 'BP' . $this->Mymodel->urut('EIDBYRPT', 9999);
			if ($fz > 0) {
				$p = array(
					$_POST['jumlah_bayar'],
					$_POST['tanggal_bayar'],
					$_POST['cara_bayar'],
					$_POST['namapembayar'],
					$_POST['daribank'],
					$_POST['darirek'],
					$_POST['namapenerima'],
					$_POST['kebank'],
					$_POST['kerek'],
					$_POST['idbyr'] . '.' . $fext,
					$_POST['idbyr']
				);
				$this->db->query("UPDATE penataran_bayar SET jumlah_bayar=?, tanggal_bayar=?, cara_bayar=?, nama_pembayar=?, dari_bank=?, 
				dari_rek=?, nama_penerima=?, ke_bank=?, ke_rek=?, bukti=? WHERE id_pembayaran=?", $p);
				move_uploaded_file($fn, 'img/bayar/' . $_POST['idbyr'] . '.' . $fext);
			} else {
				$p = array(
					$_POST['jumlah_bayar'],
					$_POST['tanggal_bayar'],
					$_POST['cara_bayar'],
					$_POST['namapembayar'],
					$_POST['daribank'],
					$_POST['darirek'],
					$_POST['namapenerima'],
					$_POST['kebank'],
					$_POST['kerek'],
					$_POST['idbyr']
				);
				$this->db->query("UPDATE penataran_bayar SET jumlah_bayar=?, tanggal_bayar=?, cara_bayar=?, nama_pembayar=?, dari_bank=?, 
				dari_rek=?, nama_penerima=?, ke_bank=?, ke_rek=? WHERE id_pembayaran=?", $p);
			}
			redirect('opr/event_iuran/' . $_POST['idev']);
		}
		if ($idbyr === false) {
		} else {
			$e = 0;
			$psn = '';
			$cek = $this->db->query("SELECT * FROM penataran_bayar WHERE id_pembayaran=? LIMIT 0,1", $idbyr);
			if ($cek->num_rows() == 0) {
				$e = 1;
				$psn .= '<p>Data tidak ditemukan !</p>';
			}
			$dbyr = $cek->row_array();
			if ($dbyr['status_verifikasi'] > 0) {
				$e = 1;
				$psn .= '<p>Pembayaran sudah diverisikai, tidak bisa diubah !</p>';
			}

			if ($e == 1) {
				$_SESSION['POPUP_MSG'] = $psn;
				$_SESSION['POPUP_CLR'] = 'error';
				redirect('opr/event_iuran/', $dbyr['id_ev']);
			}
			$this->data['DtBayar'] = $dbyr;
			$h = $this->db->query("SELECT * FROM events WHERE id_ev=? LIMIT 0,1", $dbyr['id_event']);
			$j = $h->num_rows();
			if ($j == 0) {
				$_SESSION['POPUP_MSG'] = 'Data event tidak ada atau anda tidak berhak mengakses...';
				$_SESSION['POPUP_CLR'] = 'info';
				redirect('opr/event/0');
			} else {
				$test = $this->db->query("SELECT * FROM penataran_bayar WHERE id_pembayaran='$idbyr'")->row();
				$this->data['DtEvent'] = $h->row_array();
				$stev = $this->data['DtEvent']['status_ev'];

				$this->data['MnuAktif'] = 'Event';
				$this->data['SubMnuAktif'] = 'Event' . $stev;
				$gb = '/img/bayar/' . $test->bukti;
				if (file_exists('.' . $gb)) {
					$this->data['Bukti'] = base_url() . $gb;
				} else {
					$this->data['Bukti'] = base_url() . 'img/noimage.jpg';
				}
				$this->load->view('opr_penataran_bayar_edit', $this->data);
			}
		}
	}

	public function event_penataran_bayar_del($idbyr = false)
	{
		if ($idbyr === false) {
		} else {
			$e = 0;
			$psn = '';
			$cek = $this->db->query("SELECT * FROM penataran_bayar WHERE id_pembayaran=? LIMIT 0,1", $idbyr);
			if ($cek->num_rows() == 0) {
				$e = 1;
				$psn .= '<p>Data tidak ditemukan !</p>';
			}
			$dbyr = $cek->row_array();
			if ($dbyr['status_verifikasi'] > 0) {
				$e = 1;
				$psn .= '<p>Pembayaran sudah diverisikai, tidak bisa diubah !</p>';
			}

			if ($e == 1) {
				$_SESSION['POPUP_MSG'] = $psn;
				$_SESSION['POPUP_CLR'] = 'error';
				redirect('opr/event_iuran/', $dbyr['id_event']);
			}

			//hapus
			$this->db->query("DELETE FROM penataran_bayar WHERE id_pembayaran=?", $idbyr);

			$f = './img/bayar/' . $dbyr['bukti'];
			if (file_exists($f)) {
				unlink($f);
			}
			redirect('opr/event_iuran/' . $dbyr['id_event']);
		}
	}

	//Event TimeLine
	public function event_time($idev = false)
	{
		if ($idev === false) {
		} else {
			$h = $this->db->query("SELECT a.*, b.nama_admin FROM events AS a, admin AS b WHERE 
				a.id_ev=? AND a.id_admin=b.id_admin LIMIT 0,1", $idev);
			if ($h->num_rows() == 0) {
				$_SESSION['POPUP_MSG'] = 'Data events tidak tersedia...';
				$_SESSION['POPUP_CLR'] = 'error';
				redirect('opr/event_new');
			} else {
				$this->data['DtEvent'] = $h->row_array();
				$stev = $this->data['DtEvent']['status_ev'];
				$h = $this->db->query("SELECT a.*, b.nama_admin FROM timelineev AS a, admin AS b WHERE a.publik=1 AND 
					a.id_ev=? AND a.id_admin=b.id_admin ORDER BY a.tanggal ASC", $idev);
				$this->data['DtTime'] = $h->result();
				$this->data['JmlTime'] = $h->num_rows();

				$this->data['MnuAktif'] = 'Event';
				$this->data['SubMnuAktif'] = 'Event' . $stev;
				$this->data['TimeLine'] = 1;
				$this->load->view('opr_event_time', $this->data);
			}
		}
	}

	public function profil()
	{
		$this->data['MnuAktif'] = 'MnuWebs';
		$this->data['SubMnuAktif'] = 'Tentangs';
		$id_operator = $_SESSION['ID_OPR'];
		$this->data['operator'] = $this->db->query("SELECT * FROM operator WHERE id_operator='$id_operator'")->row();
		$this->load->view('opr_profil', $this->data);
	}

	public function profil_update()
	{
		if (isset($_POST['id_operator'])) {
			$id = $_POST['id_operator'];
			$fn = $_FILES['foto']['tmp_name'];
			$fz = $_FILES['foto']['size'];
			$fext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);


			if ($fz > 0) {
				move_uploaded_file($fn, 'img/opr/' . $_POST['username'] . '.' . $fext);
				if ($_POST['passwd'] != null) {
					$p = [$_POST['nama_operator'], $_POST['username'], md5($_POST['passwd']), $_POST['username'] . '.' . $fext, $_POST['id_operator']];
					$this->db->query('UPDATE operator SET nama_operator=?, user_name=?, passwd=?, foto=? WHERE id_operator=?', $p);
				} else {
					$p = [$_POST['nama_operator'], $_POST['username'], $_POST['username'] . '.' . $fext, $_POST['id_operator']];
					$this->db->query('UPDATE operator SET nama_operator=?, user_name=?, foto=? WHERE id_operator=?', $p);
				}
			} else {
				if ($_POST['passwd'] != null) {
					$p = [$_POST['nama_operator'], $_POST['username'], md5($_POST['passwd']), $_POST['id_operator']];
					$this->db->query('UPDATE operator SET nama_operator=?, user_name=?, passwd=? WHERE id_operator=?', $p);
				} else {
					$p = [$_POST['nama_operator'], $_POST['username'], $_POST['id_operator']];
					$this->db->query('UPDATE operator SET nama_operator=?, user_name=? WHERE id_operator=?', $p);
				}
			}
			redirect('opr');
		}
	}
}
