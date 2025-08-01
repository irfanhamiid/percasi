<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public $data;

    function __construct()
    {
        parent::__construct();
        if ((!isset($_SESSION['ID_ADMIN'])) || ($_SESSION['ID_ADMIN']==0) )
        {
            redirect('adminlogin');
        }
        $h=$this->db->query("SELECT * FROM instansi WHERE id=1");
        $this->data['INSTANSI']=$h->row_array();
        $this->data['TIPE_ADMIN']=array('1'=>'Pimpinan', '2'=>'Admin', '3'=>'Super Admin');
        $this->data['TIPE_ADMIN_CLR']=array('1'=>'primary', '2'=>'info', '3'=>'danger');
        $this->data['STATUS_AKTIF']=array('Tidak Aktif', 'Aktif');
        $this->data['STATUS_AKTIF_CLR']=array('danger', 'success');
		if (!isset($_SESSION['POPUP_MSG']))
		{
			$_SESSION['POPUP_MSG']='';
			$_SESSION['POPUP_CLR']='info';
		}
		//Gelar pendaftaran
		$g=array('Reguler', 'Grand Master/Woman Grand Master', 
			'International Master/Woman International Master', 'Fide Master/Woman Fide Master', 
			'Candidate Master/Woman Candidate Master', 'Wild Card 1', 'Wild Card 2');
		$this->data['GELAR']=$g;
		$this->data['TimeLine']=0;
    }
	public function index()
	{
        $this->data['MnuAktif']='Beranda';
        $this->data['SubMnuAktif']='';
		$this->load->view('adm_home', $this->data);
	}

    public function logout()
	{
		$_SESSION['ID_ADMIN']=0;
        $_SESSION['NM_ADMIN']='';
        $_SESSION['TP_ADMIN']=0;
        redirect('adminlogin');
	}

	/* PENGATURAN */
	public function pengaturan()
	{
		if (isset($_POST['iuran']))
		{
			$p=array($_POST['alamat'], $_POST['telepon'], $_POST['telepon_wa'], $_POST['email'], $_POST['iuran']);
			$this->db->query("UPDATE instansi SET alamat=?, telepon=?, telepon_wa=?, email=?, 
				jml_iuran=? WHERE id=1", $p);
			$_SESSION['POPUP_MSG']='Data telah disimpan.';
			$_SESSION['POPUP_CLR']='info';
		}
		$h=$this->db->query("SELECT * FROM instansi WHERE id=1");
        $this->data['INSTANSI']=$h->row_array();
		$this->data['MnuAktif']='SuperAdmin';
		$this->data['SubMnuAktif']='Pengaturan';
		$this->load->view('adm_pengaturan', $this->data);
	}
	/* DATA ADMIN  */
    public function admin()
    {
        $h=$this->db->query("SELECT * FROM admin WHERE id_admin>1 ORDER BY nama_admin ASC");
        $this->data['DtAdmin']=$h->result();
        $this->data['JmlAdmin']=$h->num_rows();
        $this->data['MnuAktif']='SuperAdmin';
        $this->data['SubMnuAktif']='DataAdmin';
        $this->load->view('adm_admin', $this->data);
    }

    public function admin_new()
    {
        if (isset($_POST['username']))
		{
			$p=array($_POST['namaadmin'], $_POST['username'], md5($_POST['passwd']), 1, $_POST['aktif']);
			$this->db->query("INSERT INTO admin (nama_admin, user_name, passwd, tipe_admin, aktif) VALUES 
				(?, ?, ?, ?, ?)", $p);
			$id=$this->db->insert_id();
			$fn=$_FILES['foto']['tmp_name'];
			$fz=$_FILES['foto']['size'];
			if ($fz>0)
			{
				move_uploaded_file($fn, 'img/A'.$id.'.jpg');
			}
			$_SESSION['POPUP_MSG']='Data telah ditambahkan.';
			$_SESSION['POPUP_CLR']='info';
			redirect('admin/admin');
		}	
        $this->data['MnuAktif']='SuperAdmin';
        $this->data['SubMnuAktif']='DataAdmin';
        $this->load->view('adm_admin_new', $this->data);
    }
	
	public function admin_edit($id=false)
    {
        if (isset($_POST['id']))
		{
			$p=array($_POST['namaadmin'], $_POST['username'], md5($_POST['passwd']), $_POST['aktif'], $_POST['id']);
			$this->db->query("UPDATE admin SET nama_admin=?, user_name=?, passwd=?, aktif=? WHERE id_admin=?", $p);
			$id=$_POST['id'];
			$fn=$_FILES['foto']['tmp_name'];
			$fz=$_FILES['foto']['size'];
			if ($fz>0)
			{
				move_uploaded_file($fn, 'img/A'.$id.'.jpg');
			}
			redirect('admin/admin');
		}
		IF ($id===false) { } else
		{
			$h=$this->db->query("SELECT * FROM admin WHERE id_admin=? LIMIT 0,1", $id);
			if ($h->num_rows()==0)
			{
				$_SESSION['POPUP_MSG']='Data tidak ditemukan.';
				$_SESSION['POPUP_CLR']='error';
				redirect('admin/admin');
			}
			else
			{
				$this->data['DtAdmin']=$h->row_array();
				$this->data['MnuAktif']='SuperAdmin';
				$this->data['SubMnuAktif']='DataAdmin';
				$this->load->view('adm_admin_edit', $this->data);
			}
		}
    }

	/* DATA PROVINSI  */
    public function provinsi()
    {
        $h=$this->db->query("SELECT * FROM provinsi ORDER BY provinsi ASC");
        $this->data['DtProv']=$h->result();
        $this->data['JmlProv']=$h->num_rows();
        $this->data['MnuAktif']='SuperAdmin';
        $this->data['SubMnuAktif']='DataProv';
        $this->load->view('adm_provinsi', $this->data);
    }
	
	public function provinsi_new()
    {
        if (isset($_POST['provinsi']))
		{
			$this->db->query("INSERT INTO provinsi (provinsi) VALUES (?)", $_POST['provinsi']);
			redirect('admin/provinsi');
		}	
        $this->data['MnuAktif']='SuperAdmin';
        $this->data['SubMnuAktif']='DataProv';
        $this->load->view('adm_provinsi_new', $this->data);
    }
	
	public function provinsi_edit($id=false)
    {
        if (isset($_POST['id']))
		{
			$p=array($_POST['provinsi'], $_POST['id']);
			$this->db->query("UPDATE provinsi SET provinsi=? WHERE id_prov=?", $p);
			redirect('admin/provinsi');
		}
		IF ($id===false) { } else
		{
			$h=$this->db->query("SELECT * FROM provinsi WHERE id_prov=? LIMIT 0,1", $id);
			if ($h->num_rows()==0)
			{
				$_SESSION['POPUP_MSG']='Data tidak ditemukan.';
				$_SESSION['POPUP_CLR']='error';
				redirect('admin/provinsi');
			}
			else
			{
				$this->data['DtProv']=$h->row_array();
				$this->data['MnuAktif']='SuperAdmin';
				$this->data['SubMnuAktif']='DataProv';
				$this->load->view('adm_provinsi_edit', $this->data);
			}
		}
    }


	/* DATA OPERATOR  */
    public function operator()
    {
        $h=$this->db->query("SELECT a.*, b.provinsi FROM operator AS a, provinsi AS b WHERE a.id_prov=b.id_prov ORDER BY b.provinsi ASC,
			a.nama_operator ASC");
        $this->data['DtOpr']=$h->result();
        $this->data['JmlOpr']=$h->num_rows();
        $this->data['MnuAktif']='SuperAdmin';
        $this->data['SubMnuAktif']='DataOperator';
        $this->load->view('adm_operator', $this->data);
    }

	public function operator_new()
    {
        if (isset($_POST['idprov']))
		{
			$p=array($_POST['namaopr'], $_POST['username'], md5($_POST['passwd']), $_POST['aktif'], $_POST['telepon'], 
				$_POST['email'], $_POST['idprov']);
			$this->db->query("INSERT INTO operator (nama_operator, user_name, passwd, aktif, telepon, email, id_prov) VALUES 
				(?, ?, ?, ?, ?, ?, ?)", $p);
			$id=$this->db->insert_id();
			$fn=$_FILES['foto']['tmp_name'];
			$fz=$_FILES['foto']['size'];
			if ($fz>0)
			{
				move_uploaded_file($fn, 'img/opr/OP'.$id.'.jpg');
			}
			redirect('admin/operator');
		}	
		$h=$this->db->query("SELECT * FROM provinsi ORDER BY provinsi ASC");
        $this->data['DtProv']=$h->result();
        $this->data['MnuAktif']='SuperAdmin';
        $this->data['SubMnuAktif']='DataOperator';
        $this->load->view('adm_operator_new', $this->data);
    }
	
	public function operator_edit($id=false)
    {
        if (isset($_POST['idopr']))
		{
			if ($_POST['passwd']=='')
			{
				$p=array($_POST['namaopr'], $_POST['username'], $_POST['aktif'], $_POST['telepon'], 
					$_POST['email'], $_POST['idprov'], $_POST['idopr']);
				$this->db->query("UPDATE operator SET nama_operator=?, user_name=?, aktif=?, telepon=?, email=?, id_prov=? WHERE 
						id_operator=?", $p);
			}
			else
			{
				$p=array($_POST['namaopr'], $_POST['username'], md5($_POST['passwd']), $_POST['aktif'], $_POST['telepon'], 
					$_POST['email'], $_POST['idprov'], $_POST['idopr']);
				$this->db->query("UPDATE operator SET nama_operator=?, user_name=?, passwd=?, aktif=?, telepon=?, email=?, id_prov=? WHERE 
						id_operator=?", $p);
			}
			$id=$_POST['idopr'];
			$fn=$_FILES['foto']['tmp_name'];
			$fz=$_FILES['foto']['size'];
			if ($fz>0)
			{
				move_uploaded_file($fn, 'img/opr/OP'.$id.'.jpg');
			}
			redirect('admin/operator');
		}
		IF ($id===false) { } else
		{
			$h=$this->db->query("SELECT * FROM operator WHERE id_operator=? LIMIT 0,1", $id);
			if ($h->num_rows()==0)
			{
				$_SESSION['POPUP_MSG']='Data tidak ditemukan.';
				$_SESSION['POPUP_CLR']='error';
				redirect('admin/provinsi');
			}
			else
			{
				$this->data['DtOpr']=$h->row_array();
				$hp=$this->db->query("SELECT * FROM provinsi ORDER BY provinsi ASC");
				$this->data['DtProv']=$hp->result();
				$f='img/opr/OP'.$id.'.jpg';
				if (file_exists($f))
				{
					$this->data['Foto']=$f;
				}
				else
				{
					$this->data['Foto']='img/noimage.jpg';
				}
				$this->data['MnuAktif']='SuperAdmin';
				$this->data['SubMnuAktif']='DataOperator';
				$this->load->view('adm_operator_edit', $this->data);
			}
		}
    }
	
	// EVENTS
	public function event_new()
	{
		if (isset($_POST['namaevent']))
		{
			$this->load->model('Mymodel');
			//E20230312345
			$idev='E'.$this->Mymodel->urut('IDEVENT', 99999);
			$p=array($idev, $_POST['namaevent'], $_POST['tglevnt'], $_POST['jamevnt'], $_POST['deskripsi'], $_SESSION['ID_ADMIN']);
			$this->db->query("INSERT INTO events (id_ev, nama_ev, tgl_ev, jam_ev, deskripsi, id_admin, status_ev) VALUES
			(?, ?, ?, ?, ?, ?, 0)", $p);
			
			redirect('admin/event_detail/'.$idev);
		}
		$this->data['MnuAktif']='Event';
		$this->data['SubMnuAktif']='EventBaru';
		$this->load->view('adm_event_new', $this->data);
	}
	
	public function event_detail($idev=false)
	{
		if ($idev===false) { } else
		{
			$h=$this->db->query("SELECT a.*, b.nama_admin FROM events AS a, admin AS b WHERE a.id_ev=? AND a.id_admin=b.id_admin
				LIMIT 0,1", $idev);
			if ($h->num_rows()==0)
			{
				$_SESSION['POPUP_MSG']='Data tidak tersedia...';
				$_SESSION['POPUP_CLR']='error';
				redirect('admin/event_new');
			}
			else
			{
				$this->data['DtEvent']=$h->row_array();
				$h=$this->db->query("SELECT * FROM lokasi WHERE id_ev=? ORDER BY lokasi ASC", $idev);
				$this->data['JmlLokasi']=$h->num_rows();
				$this->data['DtLokasi']=$h->result();
				$h=$this->db->query("SELECT * FROM kategori WHERE id_ev=? ORDER BY kategori ASC", $idev);
				$this->data['JmlKtg']=$h->num_rows();
				$this->data['DtKtg']=$h->result();
				$back=array('Next', 'Run', 'Done');
				$this->data['MnuAktif']='Event';
				$this->data['SubMnuAktif']='Event'.$back[$this->data['DtEvent']['status_ev']];
				$this->load->view('adm_event_detail', $this->data);
			}
		}
	}
	
	public function event_next()
	{
		$h=$this->db->query("SELECT a.*, b.nama_admin FROM events AS a, admin AS b WHERE a.status_ev=0 AND a.id_admin=b.id_admin
				ORDER BY a.id_ev ASC");
		$this->data['DtEvent']=$h->result();
		$this->data['JmlEvent']=$h->num_rows();
		$this->data['MnuAktif']='Event';
		$this->data['SubMnuAktif']='EventNext';
		$this->load->view('adm_event_next', $this->data);
	}

	public function event_edit($idev=false)
	{
		if (isset($_POST['idev']))
		{
			$p=array($_POST['namaevent'], $_POST['tglevnt'], $_POST['jamevnt'], $_POST['deskripsi'], $_SESSION['ID_ADMIN'],
			$_SESSION['stevnt'], $_POST['idev']);
			$this->db->query("UPDATE events SET nama_ev=?, tgl_ev=?, jam_ev=?, deskripsi=?, id_admin=?, status_ev=? WHERE id_ev=?", $p);
			redirect('admin/event_detail/'.$_POST['idev']);
		}
		if ($idev===false) { } else
		{
			$h=$this->db->query("SELECT * FROM events WHERE id_ev=? LIMIT 0,1", $idev);
			$this->data['DtEvent']=$h->row_array();
			$this->data['JmlEvent']=$h->num_rows();
			$back=array('Next', 'Run', 'Done');
			$this->data['MnuAktif']='Event';
			$this->data['SubMnuAktif']='Event'.$back[$this->data['DtEvent']['status_ev']];
			$this->load->view('adm_event_edit', $this->data);
		}
	}
	
	/* KEJURNAS */
	public function kejurnas()
    {
		$h=$this->db->query("SELECT a.*, b.nama_admin FROM kejurnas AS a, admin AS b WHERE a.id_admin=b.id_admin ORDER BY
			a.tgl_mulai DESC");
		$this->data['DtKj']=$h->result();	
		$this->data['JmlKj']=$h->num_rows();
		$this->data['MnuAktif']='Kejurnas';
        $this->data['SubMnuAktif']='Kejurnas';
        $this->load->view('adm_kejurnas', $this->data);		
	}
	
	public function kejurnas_new()
    {
        if (isset($_POST['namakj']))
		{
			$this->load->model('Mymodel');
			//KJ20231234
			$id='KJ'.$this->Mymodel->urut('IDKEJURNAS', 9999);
			
			if ($_POST['tgla']>$_POST['tglb'])
			{
				$x=$_POST['tgla']; $_POST['tgla']=$_POST['tglb']; $_POST['tglb']=$x;
			}
			$p=array($id, $_POST['namakj'], $_POST['tgla'], $_POST['tglb'],  $_POST['tglmax'],
				$_SESSION['ID_ADMIN'], $_POST['status'], $_POST['iuranwjb'], $_POST['kasawal'],
				0, 0, $_POST['kasawal']);
			$this->db->query("INSERT INTO kejurnas (id_kj, nama_kj, tgl_mulai, tgl_selesai, tgl_max_daftar, id_admin,
				status_kj, iuran_wjb, kas_awal, kas_masuk, kas_keluar, kas_akhir) VALUES 
				(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", $p);
			$fn=$_FILES['poster']['tmp_name'];
			$fz=$_FILES['poster']['size'];
			if ($fz>0)
			{
				$ft='img/poster/'.$id.'.jpg';
				move_uploaded_file($fn,$ft);
				$config['image_library'] = 'gd2';
				$config['source_image'] = $ft;
				$config['create_thumb'] = true;
				$config['maintain_ratio'] = true;
				$config['width']     = 400;
				$config['height']   = 600;
				$this->load->library('image_lib', $config); 
				$this->image_lib->resize();
			}
			$fn=$_FILES['proposal']['tmp_name'];
			$fz=$_FILES['proposal']['size'];
			if ($fz>0)
			{
				move_uploaded_file($fn, 'pdf/kejurnas/'.$id.'.pdf');
			}
			$_SESSION['POPUP_MSG']='Data disimpan...';
			$_SESSION['POPUP_CLR']='info';
		}	
        $this->data['MnuAktif']='Kejurnas';
        $this->data['SubMnuAktif']='KejurnasNew';
        $this->load->view('adm_kejurnas_new', $this->data);
    }

	public function kejurnas_edit($idk=false)
    {
        if (isset($_POST['idkj']))
		{
			if ($_POST['tgla']>$_POST['tglb'])
			{
				$x=$_POST['tgla']; $_POST['tgla']=$_POST['tglb']; $_POST['tglb']=$x;
			}
			$p=array($_POST['namakj'], $_POST['tgla'], $_POST['tglb'],  $_POST['tglmax'],
				$_SESSION['ID_ADMIN'], $_POST['status'],  $_POST['iuranwjb'],
				 $_POST['kasawal'], $_POST['idkj']);
			$this->db->query("UPDATE kejurnas SET nama_kj=?, tgl_mulai=?, tgl_selesai=?, tgl_max_daftar=?, id_admin=?,
				status_kj=?, iuran_wjb=?, kas_awal=? WHERE id_kj=?", $p);
			$_SESSION['POPUP_MSG']='Data disimpan...';
			$_SESSION['POPUP_CLR']='info';
			redirect('admin/kejurnas');
		}	
		if ($idk===false) { } else
		{
			$h=$this->db->query("SELECT * FROM kejurnas WHERE id_kj=? LIMIT 0,1", $idk);
			$j=$h->num_rows();
			if ($j==0)
			{
				$_SESSION['POPUP_MSG']='Data kejurnas tidak ada...';	
				$_SESSION['POPUP_CLR']='info';
				redirect('admin/kejurnas');
			}
			else
			{
				$this->data['DtKj']=$h->row_array();
				$this->data['MnuAktif']='Kejurnas';
				$this->data['SubMnuAktif']='Kejurnas';
				$this->load->view('adm_kejurnas_edit', $this->data);
			}
			
		}
    }
	
	public function kejurnas_detail($idk=false)
	{
		if ($idk===false) { } else
		{
			$h=$this->db->query("SELECT * FROM kejurnas WHERE id_kj=? LIMIT 0,1", $idk);
			$j=$h->num_rows();
			if ($j==0)
			{
				$_SESSION['POPUP_MSG']='Data kejurnas tidak ada...';	
				$_SESSION['POPUP_CLR']='info';
				redirect('admin/kejurnas');
			}
			else
			{
				$this->data['DtKj']=$h->row_array();
				$stkj=$this->data['DtKj']['status_kj'];
				$h=$this->db->query("SELECT * FROM kategorikj WHERE id_kj=? ORDER BY kategori ASC", $idk);
				$j=$h->num_rows();
				$this->data['DtKtg']=$h->result();
				$this->data['JmlKtg']=$j;
				
				$h=$this->db->query("SELECT * FROM gelarkj WHERE id_kj=? ORDER BY gelar ASC", $idk);
				$j=$h->num_rows();
				$this->data['DtGelar']=$h->result();
				$this->data['JmlGelar']=$j;
				$this->data['MnuAktif']='Kejurnas';
				$this->data['SubMnuAktif']='Kejurnas';
				$this->load->view('adm_kejurnas_detail_'.$stkj, $this->data);
			}
			
		}
	}

	public function cek(){
		if (isset($_POST['idkj']))
		{
			$this->load->model('Mymodel');
			$id=$_POST['idkj'].$this->Mymodel->urut_saja('IDKJKTG', 99);
			$p=array($id, $_POST['idkj'], $_POST['ktg']);
			$this->db->query("INSERT INTO kategorikj (id_ktg_kj, id_kj, kategori)
				VALUES (?, ?, ?)",$p);
			redirect('admin/kejurnas_detail/'.$_POST['idkj']);
		}
		if ($idkj===false) {  } else
		{
			$h=$this->db->query("SELECT id_kj, nama_kj FROM kejurnas WHERE id_kj=? LIMIT 0,1", $idkj);
			$this->data['DtKj']=$h->row_array();
			$this->data['MnuAktif']='Kejurnas';
			$this->data['SubMnuAktif']='Kejurnas';
			$this->load->view('adm_kejurnas_ktg_new', $this->data);
		}
	}
	
	// public function kejurnas_ktg_new($idkj=false)
	
	
	public function kejurnas_ktg_edit($idktg=false)
	{
		if (isset($_POST['idktgkj']))
		{
			$p=array($_POST['ktg'], $_POST['idktgkj']);
			$this->db->query("UPDATE kategorikj SET kategori=? WHERE 
				id_ktg_kj=?",$p);
			redirect('admin/kejurnas_detail/'.$_POST['idkj']);
		}
		if ($idktg===false) {  } else
		{
			$h=$this->db->query("SELECT * FROM kategorikj WHERE id_ktg_kj=? LIMIT 0,1", $idktg);
			$d=$h->row_array();
			$this->data['DtKtg']=$d;
			$h=$this->db->query("SELECT id_kj, nama_kj FROM kejurnas WHERE id_kj=? LIMIT 0,1", $d['id_kj']);
			$this->data['DtKj']=$h->row_array();
			$this->data['MnuAktif']='Kejurnas';
			$this->data['SubMnuAktif']='Kejurnas';
			$this->load->view('adm_kejurnas_ktg_edit', $this->data);
		}
	}

	public function kejurnas_ktg_del($idktg=false)
	{
		
		if ($idktg===false) {  } else
		{
			$hktg=$this->db->query("SELECT * FROM kategorikj WHERE id_ktg_kj=? LIMIT 0,1", $idktg);
			if ($hktg->num_rows()==0)
			{
				$_SESSION['POPUP_MSG']='Data tidak ditemukan...';
				$_SESSION['POPUP_CLR']='error';
				redirect('admin/kejurnas');
			}
			$dtktg=$hktg->row_array();
			
			$cekpst=$this->db->query("SELECT * FROM pesertakj WHERE id_ktg_kj=? LIMIT 0,1", $idktg);
			if ($cekpst->num_rows()>0)
			{
				$_SESSION['POPUP_MSG']='Kategori masih ada pesertanya, tidak boleh dihapus...';
				$_SESSION['POPUP_CLR']='error';
			}
			else
			{
				$this->db->query("DELETE FROM kategorikj WHERE id_ktg_kj=?", $idktg);
				$_SESSION['POPUP_MSG']='Data sudah dihapus...';
				$_SESSION['POPUP_CLR']='info';
			}
			redirect('admin/kejurnas_detail/'.$dtktg['id_kj']);
		}
	}

	// GELAR
	public function kejurnas_glr_new($idkj=false)
	{
		if (isset($_POST['idkj']))
		{
			$this->load->model('Mymodel');
			$id=$_POST['idkj'].$this->Mymodel->urut_saja('IDKJGLR', 99);
			$p=array($id, $_POST['idkj'], $_POST['gelar'], $_POST['byy']);
			$this->db->query("INSERT INTO gelarkj (id_gelar_kj, id_kj, gelar, biaya_reg)
				VALUES (?, ?, ?, ?)",$p);
			redirect('admin/kejurnas_detail/'.$_POST['idkj']);
		}
		if ($idkj===false) {  } else
		{
			$h=$this->db->query("SELECT id_kj, nama_kj FROM kejurnas WHERE id_kj=? LIMIT 0,1", $idkj);
			$this->data['DtKj']=$h->row_array();
			$this->data['MnuAktif']='Kejurnas';
			$this->data['SubMnuAktif']='Kejurnas';
			$this->load->view('adm_kejurnas_glr_new', $this->data);
		}
	}
	
	public function kejurnas_glr_edit($idglr=false)
	{
		if (isset($_POST['idgelar']))
		{
			$p=array( $_POST['gelar'], $_POST['byy'], $_POST['idgelar']);
			$this->db->query("UPDATE gelarkj SET gelar=?, biaya_reg=? WHERE id_gelar_kj=?", $p);
			redirect('admin/kejurnas_detail/'.$_POST['idkj']);
		}
		if ($idglr===false) {  } else
		{
			
			$h=$this->db->query("SELECT * FROM gelarkj WHERE id_gelar_kj=? LIMIT 0,1", $idglr);
			$this->data['DtGelar']=$h->row_array();
			
			$h=$this->db->query("SELECT id_kj, nama_kj FROM kejurnas WHERE id_kj=? LIMIT 0,1", $this->data['DtGelar']['id_kj']);
			$this->data['DtKj']=$h->row_array();
			$this->data['MnuAktif']='Kejurnas';
			$this->data['SubMnuAktif']='Kejurnas';
			$this->load->view('adm_kejurnas_glr_edit', $this->data);
		}
	}
	
	
	public function kejurnas_glr_del($idglr=false)
	{
		
		if ($idglr===false) {  } else
		{
			$h=$this->db->query("SELECT * FROM gelarkj WHERE id_gelar_kj=? LIMIT 0,1", $idglr);
			if ($h->num_rows()==0)
			{
				$_SESSION['POPUP_MSG']='Data tidak ditemukan...';
				$_SESSION['POPUP_CLR']='error';
				redirect('admin/kejurnas');
			}
			$dtglr=$h->row_array();
			
			$cekpst=$this->db->query("SELECT * FROM pesertakj WHERE id_gelar_kj=? LIMIT 0,1", $idglr);
			if ($cekpst->num_rows()>0)
			{
				$_SESSION['POPUP_MSG']='Kategori masih ada pesertanya, tidak boleh dihapus...';
				$_SESSION['POPUP_CLR']='error';
			}
			else
			{
				$this->db->query("DELETE FROM gelarkj WHERE id_gelar_kj=?", $idglr);
				$_SESSION['POPUP_MSG']='Data sudah dihapus...';
				$_SESSION['POPUP_CLR']='info';
			}
			redirect('admin/kejurnas_detail/'.$dtglr['id_kj']);
		}
	}
	
	// Iuran
	public function kejurnas_iuran($idk=false, $tg='scr')
	{

		if ($idk===false) { } else
		{
			$h=$this->db->query("SELECT * FROM kejurnas WHERE id_kj=? LIMIT 0,1", $idk);
			$j=$h->num_rows();
			if ($j==0)
			{
				$_SESSION['POPUP_MSG']='Data kejurnas tidak ada...';	
				$_SESSION['POPUP_CLR']='info';
				redirect('admin/kejurnas');
			}
			else
			{
				$this->data['DtKj']=$h->row_array();
				$stkj=$this->data['DtKj']['status_kj'];
				$h=$this->db->query("SELECT a.*, b.provinsi FROM iurankj AS a, provinsi AS b WHERE a.id_kj=? 
						AND a.id_prov=b.id_prov ORDER BY b.provinsi ASC", $idk);	
				$j=$h->num_rows();
				$this->data['DtIuran']=$h->result();
				$this->data['JmlIuran']=$j;
				$h=$this->db->query("SELECT a.*, b.nama_admin FROM penerimaankj AS a, admin AS b WHERE a.id_kj=? 
						AND a.id_admin=b.id_admin ORDER BY a.tgl_terima ASC", $idk);	
				$j=$h->num_rows();
				$this->data['DtTerima']=$h->result();
				$this->data['JmlTerima']=$j;
				
				$cek=$this->db->query("SELECT * FROM provinsi ORDER BY provinsi");
				$this->data['DtProv']=$cek->result();		
					
				$this->data['MnuAktif']='Kejurnas';
				$this->data['SubMnuAktif']='Kejurnas';
				$this->data['Status_KJ']=$stkj;
				$this->load->view('adm_kejurnas_iuran_'.$stkj, $this->data);
			}
			
		}
	}
	
	//IURAN DETAIL
	public function kejurnas_iuran_detail($idikj=false, $tg='scr')
	{
		if ($idikj===false) { } else
		{
			$hi=$this->db->query("SELECT a.*, b.provinsi FROM iurankj AS a, provinsi AS b WHERE a.id_iuran_kj=? AND
				a.id_prov=b.id_prov LIMIT 0,1", $idikj);
			$j=$hi->num_rows();
			if ($j==0)
			{
				$_SESSION['POPUP_MSG']='Data iuran tidak ada...';	
				$_SESSION['POPUP_CLR']='info';
				redirect('admin/kejurnas');
			}
			$this->data['DtIuran']=$hi->row_array();
			$this->data['JmlIuran']=$j;
			$h=$this->db->query("SELECT * FROM kejurnas WHERE id_kj=? LIMIT 0,1", $this->data['DtIuran']['id_kj']);
			$this->data['DtKj']=$h->row_array();
			$stkj=$this->data['DtKj']['status_kj'];
			
			$h=$this->db->query("SELECT a.*, b.nama_operator, c.nama_admin FROM iurankj_byr AS a, operator AS b,
				admin AS c WHERE a.id_iuran_kj=? AND jenis_byr=1 AND a.id_operator=b.id_operator AND a.id_admin=c.id_admin 
				ORDER BY a.jenis_byr ASC, a.id_byr ASC", $idikj);
			$this->data['DtWajibByr']=$h->result();		
			$this->data['JmlWajibByr']=$h->num_rows();
			$h=$this->db->query("SELECT a.*, b.nama_operator, c.nama_admin FROM iurankj_byr AS a, operator AS b,
				admin AS c WHERE a.id_iuran_kj=? AND jenis_byr=2 AND a.id_operator=b.id_operator AND a.id_admin=c.id_admin 
				ORDER BY a.jenis_byr ASC, a.id_byr ASC", $idikj);
			$this->data['DtRegistrasiByr']=$h->result();		
			$this->data['JmlRegistrasiByr']=$h->num_rows();
			
			$this->data['MnuAktif']='Kejurnas';
			$this->data['SubMnuAktif']='Kejurnas';
			$this->data['Status_KJ']=$stkj;
			if ($tg=='scr')
			{
				$this->load->view('adm_kejurnas_iuran_detail', $this->data);
			}
			else
			{
				$this->load->view('adm_kejurnas_iuran_detail_ctk', $this->data);
			}
		}		
	}
	
	//update data iuran
	public function kejurnas_iuran_hitung($idkj=false)
	{
		if ($idkj===false) { } else
		{
			$hkj=$this->db->query("SELECT * FROM kejurnas WHERE id_kj=? LIMIT 0,1", $idkj);
			if ($hkj->num_rows()==0)
			{
				$_SESSION['POPUP_MSG']='Data kejurnas tidak ada...';	
				$_SESSION['POPUP_CLR']='info';
				redirect('admin/kejurnas');
			}
			$dtkj=$hkj->row_array();
			$hprov=$hkj=$this->db->query("SELECT * FROM provinsi ORDER BY id_prov");
			$j=$hprov->num_rows();
			if ($j>0)
			{
				$dtprov=$hprov->result();
				foreach($dtprov as $prov)
				{
					$p=array($prov->id_prov, $idkj);
					$hpst=$this->db->query("SELECT a.id_pst_kj, a.id_ktg_kj, a.id_gelar_kj, a.id_kj, a.id_prov,
						b.biaya_reg FROM pesertakj AS a, gelarkj AS b
						WHERE a.id_prov=? AND a.id_kj=? AND a.id_gelar_kj=b.id_gelar_kj ORDER BY id_ktg_kj ASC", $p);
					$jmlpst=$hpst->num_rows();
					$jmlbyreg=0;
					if ($jmlpst>0)
					{
						$dtpst=$hpst->result();
						foreach($dtpst as $pstreg)
						{
							$jmlbyreg+=$pstreg->biaya_reg;
						}						
					}
					//update taghan
					$p=array($dtkj['iuran_wjb'], $jmlbyreg, $idkj, $prov->id_prov);
					$this->db->query("UPDATE iurankj SET jml_wajib=?, jml_registrasi=? WHERE id_kj=? AND id_prov=?", $p);
					
					//bayar
					$p=array($prov->id_prov, $idkj);
					$hpst=$this->db->query("SELECT id_kj, id_prov, jml_bayar, jenis_byr FROM iurankj_byr WHERE  id_prov=? AND id_kj=? AND status_verifikasi=1", $p);
					$jmlpst=$hpst->num_rows();
					$jmlbywjb=0; $jmlbyreg=0;
					if ($jmlpst>0)
					{
						$dtpst=$hpst->result();
						foreach($dtpst as $pstreg)
						{
							if ($pstreg->jenis_byr==1)
							{
								$jmlbywjb+=$pstreg->jml_bayar;
							}
							else
							{
								$jmlbyreg+=$pstreg->jml_bayar;
							}
						}						
					}
					//update dibayar
					$p=array($jmlbywjb, $jmlbyreg, $idkj, $prov->id_prov);
					$this->db->query("UPDATE iurankj SET byr_wajib=?, byr_registrasi=? WHERE id_kj=? AND id_prov=?", $p);
				}					
			}
			else
			{
				$this->db->query("UPDATE iurankj SET jml_wajib=0, byr_wajib=0, jml_registrasi=0, byr_registrasi=0
					  WHERE id_kj=?", $idkj);
			}
			//hitung total semua penerimaan uang
			$h=$this->db->query("SELECT SUM(byr_wajib) AS jmlwjb, SUM(byr_registrasi) AS jmlreg FROM iurankj WHERE id_kj=?", $idkj);
			$dtiuran=$h->row_array();
			
			$h=$this->db->query("SELECT SUM(jumlah) AS jmllain FROM penerimaankj WHERE id_kj=?", $idkj);
			$dtterima=$h->row_array();
			$h=$this->db->query("SELECT SUM(jumlah) AS jmlkeluar FROM kaskeluarkj WHERE id_kj=?", $idkj);
			$dtkeluar=$h->row_array();
			$kasmasuk=$dtiuran['jmlwjb']+$dtiuran['jmlreg']+$dtterima['jmllain'];
			$saldoakhir=$kasmasuk-$dtkeluar['jmlkeluar'];
			$p=array($kasmasuk, $dtkeluar['jmlkeluar'], $saldoakhir, $idkj);
			$this->db->query("UPDATE kejurnas SET kas_masuk=?, kas_keluar=?, kas_akhir=? WHERE id_kj=?", $p);
		}
		return;	
	}
	
	//update data iuran
	public function kejurnas_iuran_upd($idkj=false)
	{
		if (idkj===false) { } else
		{
			$this->kejurnas_iuran_hitung($idkj);
		}
		redirect('admin/kejurnas_iuran/'.$idkj);
	}
	
	public function kejurnas_iuran_byr_new($idikj=false)
	{
		if (isset($_POST['jenisbyr']))
		{
			
			$hiurankj=$this->db->query("SELECT * FROM iurankj WHERE id_iuran_kj=? LIMIT 0, 1", $_POST['idikj']);
			$dtiuran=$hiurankj->row_array();
			$this->load->model('Mymodel');
			$idbyr='BK'.$this->Mymodel->urut('IDBYRKJ',9999);
			$p=array($idbyr, $_POST['idkj'], $dtiuran['id_iuran_kj'], $dtiuran['id_prov'],  0, 1, 
				$_POST['tglbayar'], $_POST['jmlbayar'], $_POST['jenisbyr'], $_POST['carabyr'], $_POST['namapembayar'], '',
				$_POST['daribank'], $_POST['darirek'], $_POST['namapenerima'], $_POST['catatan'], $_POST['kebank'], 
				$_POST['kerek'],'', 0);
			$h=$this->db->query("INSERT INTO iurankj_byr (id_byr, id_kj, id_iuran_kj, id_prov, id_operator, id_admin, tgl_bayar,
				jml_bayar, jenis_byr, cara_byr, nama_pembayar, note_pembayar, dari_bank, dari_rek, nama_penerima, note_penerima,
				ke_bank, ke_rek, tgl_verifikasi, status_verifikasi) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",$p);
			$fn=$_FILES['bukti']['tmp_name'];
			$fz=$_FILES['bukti']['size'];
			if ($fz>0)
			{
				move_uploaded_file($fn, 'img/byrkj/'.$idbyr.'.jpg');
			}
			
			redirect('admin/kejurnas_iuran_detail/'.$_POST['idikj']);
		}
		
		if ($idikj===false) { } else
		{
			$hi=$this->db->query("SELECT a.*, b.provinsi FROM iurankj AS a, provinsi AS b WHERE a.id_iuran_kj=? AND
				a.id_prov=b.id_prov LIMIT 0,1", $idikj);
			if ($hi->num_rows()==0)
			{
				$_SESSION['POPUP_MSG']='Data iuran  tidak ada...';	
				$_SESSION['POPUP_CLR']='info';
				redirect('admin/kejurnas');
			}
			
			$this->data['DtIuran']=$hi->row_array();
			unset($hi);
			$h=$this->db->query("SELECT * FROM kejurnas WHERE id_kj=? LIMIT 0,1", $this->data['DtIuran']['id_kj']);
			$this->data['DtKj']=$h->row_array();	
			$stkj=$this->data['DtKj']['status_kj'];
			unset($h);
			$this->data['MnuAktif']='Kejurnas';
			$this->data['SubMnuAktif']='Kejurnas';
			$this->data['Status_KJ']=$stkj;
			$this->load->view('adm_kejurnas_iuran_byr_new', $this->data);
		}
	}
		
	public function kejurnas_iuran_byr_edit($idikj=false)
	{
		if (isset($_POST['idbyr']))
		{
			//**************** DINISI 
			$p=array($_POST['tglbayar'], $_POST['jmlbayar'], $_POST['jenisbyr'], $_POST['carabyr'],
				$_POST['namapembayar'], $_POST['catatan'], $_POST['daribank'], $_POST['darirek'],
				 $_POST['idbyr']);
			$this->db->query("UPDATE iurankj_byr SET tgl_bayar=?, jml_bayar=?, jenis_byr=?, cara_byr=?, 
				nama_pembayar=?, note_pembayar=?, dari_bank=?, dari_rek=?  WHERE id_byr=?", $p);
				
			$fn=$_FILES['bukti']['tmp_name'];
			$fz=$_FILES['bukti']['size'];
			if ($fz>0)
			{
				move_uploaded_file($fn, 'img/byrkj/'.$_POST['idbyr'].'.jpg');
			}
			redirect('admin/kejurnas_iuran_detail/'.$_POST['idkj']);
		}
		
		if ($idikj===false) { } else
		{
			$h=$this->db->query("SELECT a.*, b.provinsi FROM iurankj_byr AS a, provinsi AS b WHERE a.id_byr=? AND
				a.id_prov=b.id_prov LIMIT 0,1", $idikj);
			if ($h->num_rows()==0)
			{
				$_SESSION['POPUP_MSG']='Data iuran  tidak ada...';	
				$_SESSION['POPUP_CLR']='info';
				redirect('admin/kejurnas');
			}
			$this->data['DtBayar']=$h->row_array();
			$h=$this->db->query("SELECT * FROM kejurnas WHERE id_kj=? LIMIT 0,1", $this->data['DtBayar']['id_kj']);
			$this->data['DtKj']=$h->row_array();	
			$stkj=$this->data['DtKj']['status_kj'];
			$this->data['MnuAktif']='Kejurnas';
			$this->data['SubMnuAktif']='Kejurnas';
			$this->data['Status_KJ']=$stkj;
			$this->load->view('adm_kejurnas_iuran_byr_edit', $this->data);
		}
	}
	
	
	//verfikasi pembayarn
	public function kejurnas_iuran_byr_verdo($idbyr=false)
	{
		if ($idbyr===false) { } else
		{
			$h=$this->db->query("SELECT * FROM iurankj_byr WHERE id_byr=? LIMIT 0,1", $idbyr);
			if ($h->num_rows()==0)
			{
				$_SESSION['POPUP_MSG']='Data iuran  tidak ada...';	
				$_SESSION['POPUP_CLR']='info';
				redirect('admin/kejurnas');
			}
			$dtbyr=$h->row_array();
			$p=array(date('Y-m-d'), $idbyr);
			$this->db->query("UPDATE iurankj_byr SET status_verifikasi=1, tgl_verifikasi=? WHERE id_byr=?", $p);
			$this->kejurnas_iuran_hitung($dtbyr['id_kj']);
			
			redirect('admin/kejurnas_iuran_detail/'.$dtbyr['id_iuran_kj']);
		}		
	}
	
	//Batalkan verfikasi
	public function kejurnas_iuran_byr_unver($idbyr=false)
	{
		if ($idbyr===false) { } else
		{
			$h=$this->db->query("SELECT * FROM iurankj_byr WHERE id_byr=? LIMIT 0,1", $idbyr);
			if ($h->num_rows()==0)
			{
				$_SESSION['POPUP_MSG']='Data iuran  tidak ada...';	
				$_SESSION['POPUP_CLR']='info';
				redirect('admin/kejurnas');
			}
			$dtbyr=$h->row_array();
			$this->db->query("UPDATE iurankj_byr SET status_verifikasi=0, tgl_verifikasi='' WHERE id_byr=?", $idbyr);
			$this->kejurnas_iuran_hitung($dtbyr['id_kj']);
			
			redirect('admin/kejurnas_iuran_detail/'.$dtbyr['id_iuran_kj']);
		}
	}
	
	//Hapus pembayaran
	public function kejurnas_iuran_byr_del($idbyr=false)
	{
		if (idbyr===false) { } else
		{
			$h=$this->db->query("SELECT * FROM iurankj_byr WHERE id_byr=? LIMIT 0,1", $idbyr);
			if ($h->num_rows()==0)
			{
				$_SESSION['POPUP_MSG']='Data iuran  tidak ada...';	
				$_SESSION['POPUP_CLR']='info';
				redirect('admin/kejurnas');
			}
			$dtbyr=$h->row_array();
			if ($dtbyr['status_verifikasi']==1)
			{
				$_SESSION['POPUP_MSG']='Pembayaran sudah diverifikasi, tidak bisa dihapus...';	
				$_SESSION['POPUP_CLR']='info';
				redirect('admin/kejurnas_iuran_detail/'.$dtbyr['id_iuran_kj']);
			}
			$this->db->query("DELETE FROM iurankj_byr WHERE id_byr=?", $idbyr);
			redirect('admin/kejurnas_iuran_detail/'.$dtbyr['id_iuran_kj']);
		}
	}
	
	
	public function kejurnas_iuran_byr_detail($idbyr=false, $tg='scr')
	{
		if ($idbyr===false) { } else
		{
			$h=$this->db->query("SELECT a.*, b.provinsi, c.nama_admin FROM iurankj_byr AS a, provinsi AS b, admin AS c WHERE 
				a.id_byr=? AND a.id_prov=b.id_prov AND a.id_admin=c.id_admin LIMIT 0,1", $idbyr);
			if ($h->num_rows()==0)
			{
				$_SESSION['POPUP_MSG']='Data iuran  tidak ada...';	
				$_SESSION['POPUP_CLR']='info';
				redirect('admin/kejurnas');
			}
			$this->data['DtBayar']=$h->row_array();
			$h=$this->db->query("SELECT * FROM kejurnas WHERE id_kj=? LIMIT 0,1", $this->data['DtBayar']['id_kj']);
			$this->data['DtKj']=$h->row_array();	
			$stkj=$this->data['DtKj']['status_kj'];
			$this->data['MnuAktif']='Kejurnas';
			$this->data['SubMnuAktif']='Kejurnas';
			$this->data['Status_KJ']=$stkj;
			if ($tg=='scr')
			{
				$this->load->view('adm_kejurnas_iuran_byr_detail', $this->data);
			}
			else
			{
				$this->load->view('adm_kejurnas_iuran_byr_detail_ctk', $this->data);
			}
		}
	}
	
	
	//penerimaan lain
	public function kejurnas_penlain_new($idkj=false)
	{
		if (isset($_POST['idkj']))
		{
			
			$hiurankj=$this->db->query("SELECT * FROM iurankj WHERE id_iuran_kj=? LIMIT 0, 1", $_POST['idkj']);
			$dtiuran=$hiurankj->row_array();
			$this->load->model('Mymodel');
			$id='PL'.$this->Mymodel->urut('IDPENKJ',9999);
			$p=array($id, $_POST['idkj'], $_POST['tglbayar'], $_POST['nobukti'], $_POST['jmlbayar'], 
				addslashes($_POST['keterangan']), $_SESSION['ID_ADMIN']);
			$h=$this->db->query("INSERT INTO penerimaankj (id_penerimaan, id_kj, tgl_terima, no_bukti, jumlah, keterangan, id_admin) VALUES (?, ?, ?, ?, ?, ?, ?)",$p);
			$this->kejurnas_iuran_hitung($_POST['idkj']);
			$fn=$_FILES['bukti']['tmp_name'];
			$fz=$_FILES['bukti']['size'];
			if ($fz>0)
			{
				move_uploaded_file($fn, 'img/byrkj/'.$id.'.jpg');
			}
			
			redirect('admin/kejurnas_iuran_detail/'.$_POST['idkj']);
		}
		
		if ($idkj===false) { } else
		{
			$hi=$this->db->query("SELECT * FROM kejurnas WHERE id_kj=? LIMIT 0,1", $idkj);
			if ($hi->num_rows()==0)
			{
				$_SESSION['POPUP_MSG']='Data kejurnnas  tidak ada...';	
				$_SESSION['POPUP_CLR']='info';
				redirect('admin/kejurnas');
			}
			
			$this->data['DtKj']=$hi->row_array();	
			$stkj=$this->data['DtKj']['status_kj'];
			
			$this->data['MnuAktif']='Kejurnas';
			$this->data['SubMnuAktif']='Kejurnas';
			$this->data['Status_KJ']=$stkj;
			$this->load->view('adm_kejurnas_penlain_new', $this->data);
		}
	}
	
	//peserta
	public function kejurnas_peserta($idk=false, $idprov=0, $tg='scr')
	{
		if (isset($_POST['idprov']))
		{
			$idk=$_POST['idkj']; $idprov=$_POST['idprov'];
		}
		if ($idk===false) { } else
		{
			$h=$this->db->query("SELECT * FROM kejurnas WHERE id_kj=? LIMIT 0,1", $idk);
			$j=$h->num_rows();
			if ($j==0)
			{
				$_SESSION['POPUP_MSG']='Data kejurnas tidak ada...';	
				$_SESSION['POPUP_CLR']='info';
				redirect('admin/kejurnas');
			}
			else
			{
				$this->data['DtKj']=$h->row_array();
				$stkj=$this->data['DtKj']['status_kj'];
				if ($idprov==0)
				{
					$h=$this->db->query("SELECT a.*, b.kategori, c.gelar, c.biaya_reg, d.provinsi FROM pesertakj  AS a, kategorikj AS b, gelarkj AS c, provinsi AS d WHERE a.id_kj=? AND a.id_ktg_kj=b.id_ktg_kj AND a.id_gelar_kj=c.id_gelar_kj AND a.id_prov=d.id_prov ORDER BY a.id_ktg_kj ASC, a.id_gelar_kj ASC, a.nama_pst ASC", $idk);
					$this->data['IdProv']=0;
					$this->data['NamaProv']="Semua";
					
				}
				else
				{
					$p=array($idk, $idprov);
					$h=$this->db->query("SELECT a.*, b.kategori, c.gelar, c.biaya_reg, d.provinsi FROM pesertakj  AS a, kategorikj AS b, gelarkj AS c, provinsi AS d WHERE a.id_kj=? AND a.id_prov=? AND a.id_ktg_kj=b.id_ktg_kj AND a.id_gelar_kj=c.id_gelar_kj AND a.id_prov=d.id_prov ORDER BY a.id_ktg_kj ASC, a.id_gelar_kj ASC, a.nama_pst ASC", $p);
					$this->data['IdProv']=$idprov;
					$hp=$this->db->query("SELECT * FROM provinsi WHERE id_prov=? LIMIT 0,1", $idprov);
					$dtp=$hp->row_array();
					$this->data['IdProv']=$dtp["id_prov"];
					$this->data['NamaProv']=$dtp["provinsi"];
				}
				$j=$h->num_rows();
				$this->data['DtPst']=$h->result();
				$this->data['JmlPst']=$j;
				$h=$this->db->query("SELECT * FROM provinsi ORDER BY provinsi ASC");
				$this->data['DtProv']=$h->result();
				$this->data['MnuAktif']='Kejurnas';
				$st_e=array('KJBelumJalan', 'KJBerjalan', 'KJSelesai');
				$this->data['SubMnuAktif']=$st_e[$stkj];
				$this->data['Status_KJ']=$stkj;
				if ($tg=='scr')
				{
					$this->load->view('adm_kejurnas_peserta_'.$stkj, $this->data);
				}
				else
				{
					$this->load->view('adm_kejurnas_peserta_ctk', $this->data);
				}	
			}
			
		}
	}
	
	public function kejurnas_peserta_new($idkj=false, $idprov=false)
	{
		if (isset($_POST['nik']))
		{
			
			$this->load->model('Mymodel');
			$idpst='PK'.$this->Mymodel->urut('IDPSTKJ',9999);
			$p=array($idpst, $_POST['ktg'], $_POST['glr'], $_POST['idkj'], $_POST['idprov'], $_POST['namapst'], 
				$_POST['jk'], $_POST['tgllahir'], $_POST['umur'], $_POST['nik'], $_POST['telepon']);
			$this->db->query("INSERT INTO pesertakj (id_pst_kj, id_ktg_kj, id_gelar_kj, id_kj, id_prov, nama_pst, jk_pst, tgl_lahir, umur, nik, telepon, juara) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0)", $p);
			//updt jml pst
			$this->db->query("UPDATE kategorikj SET jml_peserta=jml_peserta+1 WHERE id_ktg_kj=?", $_POST['ktg']);
			//hitung biaya registrasi provinsi
			$p=array($_POST['idkj'], $_POST['idprov']);
			$hpst=$this->db->query("SELECT a.*, b.biaya_reg FROM pesertakj AS a, gelarkj AS b WHERE a.id_kj=? AND a.id_prov=? AND a.id_gelar_kj=b.id_gelar_kj", $p); 
			$dtpst=$hpst->result();
			$jmlpst=$hpst->num_rows();
			$jmlbayar=0;
			if ($jmlpst>0)
			{
				foreach($dtpst as $p)
				{
					$jmlbayar+=$p->biaya_reg;
				}
			}
			//baca iuran wajib
			$hwjb=$this->db->query("SELECT iuran_wjb FROM kejurnas WHERE id_kj=? LIMIT 0,1", $_POST['idkj']);
			$dtwjb=$hwjb->row_array();
			//update iuran kj
	
			$p=array($_POST['idkj'], $_POST['idprov']);
			$cekiuran=$this->db->query("SELECT * FROM iurankj WHERE id_kj=? AND id_prov=? LIMIT 0,1", $p);
			if ($cekiuran->num_rows()==0)
			{
				$idiuran='IK'.$this->Mymodel->urut('IDIURANKJ',9999);
				$p=array($idiuran, $_POST['idkj'], $_POST['idprov'], $dtwjb['iuran_wjb'], $jmlbayar );
				$this->db->query("INSERT INTO iurankj (id_iuran_kj, id_kj, id_prov, jml_wajib, byr_wajib, jml_registrasi, 
					byr_registrasi) VALUES (?, ?, ?, ?, 0, ?, 0)", $p);
			}
			else
			{
				$dtiuran=$cekiuran->row_array();
				$p=array($jmlbayar,$dtiuran['id_iuran_kj']);
				$this->db->query("UPDATE iurankj SET jml_registrasi=? WHERE id_iuran_kj=?", $p);
			}
					
			redirect('admin/kejurnas_peserta/'.$_POST['idkj'].'/'.$_POST['idprov'].'/scr');
			
		}
		
		if ( ($idkj===false) || ($idprov===false) ) { } else
		{
			$h=$this->db->query("SELECT * FROM kejurnas WHERE id_kj=? LIMIT 0,1", $idkj);
			$j=$h->num_rows();
			if ($j==0)
			{
				$_SESSION['POPUP_MSG']='Data kejurnas tidak ada...';	
				$_SESSION['POPUP_CLR']='info';
				redirect('admin/kejurnas');
			}
			else
			{
				$this->data['DtKj']=$h->row_array();
				$stkj=$this->data['DtKj']['status_kj'];
				$h=$this->db->query("SELECT * FROM provinsi WHERE id_prov=? LIMIT 0,1", $idprov);
				$this->data['DtProv']=$h->row_array();
				$h=$this->db->query("SELECT * FROM kategorikj WHERE id_kj=? ORDER BY kategori ASC", $idkj);
				$this->data['DtKtg']=$h->result();
				$h=$this->db->query("SELECT * FROM gelarkj WHERE id_kj=? ORDER BY gelar ASC", $idkj);
				$this->data['DtGelar']=$h->result();
				$this->data['MnuAktif']='Kejurnas';
				$st_e=array('KJBelumJalan', 'KJBerjalan', 'KJSelesai');
				$this->data['SubMnuAktif']=$st_e[$stkj];
				$this->data['Status_KJ']=$stkj;
				$this->load->view('adm_kejurnas_peserta_new', $this->data);
			}
		}
	}
	
	
	//Edit peserta
	public function kejurnas_peserta_edit($idpst=false)
	{
		if (isset($_POST['nik']))
		{
			$holdpst=$this->db->query("SELECT * FROM pesertakj WHERE id_pst_kj=? LIMIT 0,1", $_POST['idpst']);
			$dtold=$holdpst->row_array();
			$p=array($_POST['ktg'], $_POST['glr'], $_POST['namapst'], 
				$_POST['jk'], $_POST['tgllahir'], $_POST['umur'], $_POST['nik'], $_POST['telepon'], $_POST['idpst'] );
			$this->db->query("UPDATE pesertakj SET id_ktg_kj=?, id_gelar_kj=?,  nama_pst=?, jk_pst=?, tgl_lahir=?, umur=?,
				nik=?, telepon=? WHERE id_pst_kj=?", $p);
			//updt jml pst
			$this->db->query("UPDATE kategorikj SET jml_peserta=jml_peserta-1 WHERE id_ktg_kj=?", $dtold['id_ktg_kj']);
			$this->db->query("UPDATE kategorikj SET jml_peserta=jml_peserta+1 WHERE id_ktg_kj=?", $_POST['ktg']);
			
			//hitung biaya registrasi provinsi
			$p=array($_POST['idkj'], $dtold['idprov']);
			$hpst=$this->db->query("SELECT a.*, b.biaya_reg FROM pesertakj AS a, gelarkj AS b WHERE a.id_kj=? AND a.id_prov=? AND a.id_gelar_kj=b.id_gelar_kj", $p); 
			$dtpst=$hpst->result();
			$jmlpst=$hpst->num_rows();
			$jmlbayar=0;
			if ($jmlpst>0)
			{
				foreach($dtpst as $p)
				{
					$jmlbayar+=$p->biaya_reg;
				}
			}
			//baca iuran wajib
			$hwjb=$this->db->query("SELECT iuran_wjb FROM kejurnas WHERE id_kj=? LIMIT 0,1", $_POST['idkj']);
			$dtwjb=$hwjb->row_array();
			//update iuran kj
	
			$p=array($_POST['idkj'], $dtold['id_prov']);
			$cekiuran=$this->db->query("SELECT * FROM iurankj WHERE id_kj=? AND id_prov=? LIMIT 0,1", $p);
			if ($cekiuran->num_rows()==0)
			{
				$idiuran='IK'.$this->Mymodel->urut('IDIURANKJ',9999);
				$p=array($idiuran, $_POST['idkj'], $dtold['idprov'], $dtwjb['iuran_wjb'], $jmlbayar );
				$this->db->query("INSERT INTO iurankj (id_iuran_kj, id_kj, id_prov, jml_wajib, byr_wajib, jml_registrasi, 
					byr_registrasi) VALUES (?, ?, ?, ?, 0, ?, 0)", $p);
			}
			else
			{
				$dtiuran=$cekiuran->row_array();
				$p=array($jmlbayar,$dtiuran['id_iuran_kj']);
				$this->db->query("UPDATE iurankj SET jml_registrasi=? WHERE id_iuran_kj=?", $p);
			}
					
					
			redirect('admin/kejurnas_peserta/'.$_POST['idkj'].'/'.$dtold['id_prov'].'/scr');
			
		}
		if ($idpst===false) { } else
		{
			$hpst=$this->db->query("SELECT * FROM pesertakj WHERE id_pst_kj=? LIMIT 0,1", $idpst);
			$e=0; $psn='';
			if ($hpst->num_rows()==0)
			{
				$_SESSION['POPUP_MSG']='<p>Data peserta tidak ditemukan...</p>';
				$_SESSION['POPUP_CLR']='error';
				
			}
			$this->data['DtPst']=$hpst->row_array();
			
			$hkj=$this->db->query("SELECT * FROM kejurnas WHERE id_kj=? AND status_kj=0 LIMIT 0,1", $this->data['DtPst']['id_kj']);
			$j=$hkj->num_rows();
			if ($j==0)
			{
				$e=1; $psn.='<p>Data kejurnas tidak ditemukan...</p>';
			}
			if ($e==1)
			{
				$_SESSION['POPUP_MSG']=$psn;	
				$_SESSION['POPUP_CLR']='info';
				redirect('admin/kejurnas');
			}
			else
			{
				$this->data['DtKj']=$hkj->row_array();
				$stkj=$this->data['DtKj']['status_kj'];
				
				$h=$this->db->query("SELECT * FROM kategorikj WHERE id_kj=? ORDER BY kategori ASC", $this->data['DtKj']['id_kj']);
				$j=$h->num_rows();
				$this->data['DtKtg']=$h->result();
				$this->data['JmlKtg']=$j;
				$h=$this->db->query("SELECT * FROM gelarkj WHERE id_kj=? ORDER BY gelar ASC", $this->data['DtKj']['id_kj']);
				$j=$h->num_rows();
				$this->data['DtGelar']=$h->result();
				$this->data['JmlGelar']=$j;
				$h=$this->db->query("SELECT * FROM provinsi WHERE id_prov=? LIMIT 0,1", $this->data['DtPst']['id_prov']);
				$this->data['DtProv']=$h->row_array();
				$this->data['MnuAktif']='Kejurnas';
				$st_e=array('KJBelumJalan', 'KJBerjalan', 'KJSelesai');
				$this->data['SubMnuAktif']=$st_e[$stkj];
				$this->data['Status_KJ']=$stkj;
				$this->load->view('adm_kejurnas_peserta_edit', $this->data);
			}
			
		}
	}
	
	//Hapus peserta
	public function kejurnas_peserta_del($idpst=false)
	{
		if ($idpst===false) { } else
		{
			$p=array($idpst);
			$hpst=$this->db->query("SELECT * FROM pesertakj WHERE id_pst_kj=? LIMIT 0,1", $p);
			if ($hpst->num_rows()==0)
			{
				$_SESSION['POPUP_MSG']='Data peserta tidak ada atau anda tidak berhak mengakses...';	
				$_SESSION['POPUP_CLR']='info';
				redirect('admin/kejurnas');
			}
			$dtpst=$hpst->row_array();
			$this->db->query("DELETE FROM pesertakj WHERE id_pst_kj=?", $idpst);
			//updt jml pst
			$this->db->query("UPDATE kategorikj SET jml_peserta=jml_peserta-1 WHERE id_ktg_kj=?", $dtpst['id_ktg_kj']);
			
			$p=array($dtpst['id_kj'],$dtpst['id_prov']);
			$hpstby=$this->db->query("SELECT a.*, b.biaya_reg FROM pesertakj AS a, gelarkj AS b WHERE a.id_kj=? AND a.id_prov=? AND a.id_gelar_kj=b.id_gelar_kj", $p); 
			$dtpstby=$hpstby->result();
			$jmlpstby=$hpstby->num_rows();
			$jmlbayar=0;
			if ($jmlpstby>0)
			{
				foreach($dtpstby as $p)
				{
					$jmlbayar+=$p->biaya_reg;
				}
			}
			
			//baca iuran wajib
			$hwjb=$this->db->query("SELECT iuran_wjb FROM kejurnas WHERE id_kj=? LIMIT 0,1", $dtpst['id_kj']);
			$dtwjb=$hwjb->row_array();
			//update iuran kj
	
			$p=array($dtpst['id_kj'], $dtpst['id_prov']);
			$cekiuran=$this->db->query("SELECT * FROM iurankj WHERE id_kj=? AND id_prov=? LIMIT 0,1", $p);
			if ($cekiuran->num_rows()==0)
			{
				$this->load->model('Mymodel');
				$idiuran='IK'.$this->Mymodel->urut('IDIURANKJ',9999);
				$p=array($idiuran, $dtpst['id_kj'], $dtpst['id_prov'], $dtwjb['iuran_wjb'], $jmlbayar );
				$this->db->query("INSERT INTO iurankj (id_iuran_kj, id_kj, id_prov, jml_wajib, byr_wajib, jml_registrasi, 
					byr_registrasi) VALUES (?, ?, ?, ?, 0, ?, 0)", $p);
			}
			else
			{
				$dtiuran=$cekiuran->row_array();
				$p=array($jmlbayar,$dtiuran['id_iuran_kj']);
				$this->db->query("UPDATE iurankj SET jml_registrasi=? WHERE id_iuran_kj=?", $p);
			}
			redirect('admin/kejurnas_peserta/'.$dtpst['id_kj'].'/'.$dtpst['id_prov'].'/scr');
		}
	}
	
	
	// TIME LINE
	public function kejurnas_time($idkj=false)
	{
		if ($idkj===false) { } else
		{
			$h=$this->db->query("SELECT * FROM kejurnas WHERE id_kj=? LIMIT 0,1", $idkj);
			$j=$h->num_rows();
			if ($j==0)
			{
				$_SESSION['POPUP_MSG']='Data kejurnas tidak ada...';	
				$_SESSION['POPUP_CLR']='info';
				redirect('admin/kejurnas');
			}
			else
			{
				$this->data['DtKj']=$h->row_array();
				$stkj=$this->data['DtKj']['status_kj'];
				$h=$this->db->query("SELECT a.*, b.nama_admin FROM timelinekj AS a, admin AS b WHERE a.id_kj=? AND a.id_admin=b.id_admin ORDER BY a.tanggal ASC", $idkj);
				$this->data['DtTime']=$h->result();
				$this->data['JmlTime']=$h->num_rows();
				$this->data['MnuAktif']='Kejurnas';
				$this->data['SubMnuAktif']='Kejurnas';
				$this->data['Status_KJ']=$stkj;
				$this->load->view('adm_kejurnas_time_'.$stkj, $this->data);
				
			}
		}
	}
	
	public function kejurnas_time_new($idkj=false)
	{
		if (isset($_POST['kegiatan']))
		{
			$this->load->model('Mymodel');
			$id='IT'.$this->Mymodel->urut('IDTIME', 999999);
			$p=array($id, $_POST['idkj'], $_POST['tgl'], $_POST['kegiatan'], $_POST['status'],
				 addslashes($_POST['catatan']), $_SESSION['ID_ADMIN']);
			$this->db->query("INSERT INTO timelinekj (id_timeline, id_kj, tanggal, kegiatan, status_kegiatan, catatan, id_admin) VALUES (?, ?, ?, ?, ?, ?, ?)", $p);
			redirect('admin/kejurnas_time/'.$_POST['idkj']);
		}
		if ($idkj===false) { } else
		{
			$h=$this->db->query("SELECT * FROM kejurnas WHERE id_kj=? LIMIT 0,1", $idkj);
			$j=$h->num_rows();
			if ($j==0)
			{
				$_SESSION['POPUP_MSG']='Data kejurnas tidak ada...';	
				$_SESSION['POPUP_CLR']='info';
				redirect('admin/kejurnas');
			}
			else
			{
				$this->data['DtKj']=$h->row_array();
				$stkj=$this->data['DtKj']['status_kj'];
				$this->data['MnuAktif']='Kejurnas';
				$this->data['SubMnuAktif']='Kejurnas';
				$this->data['Status_KJ']=$stkj;
				$this->data['TimeLine']=1;
				$this->load->view('adm_kejurnas_time_new', $this->data);
				
			}
		}
	}
	
	public function kejurnas_time_edit($idt=false)
	{
		if (isset($_POST['kegiatan']))
		{
			$p=array($_POST['tgl'], $_POST['kegiatan'], $_POST['status'],
				addslashes($_POST['catatan']), $_SESSION['ID_ADMIN'], $_POST['idtime']);
			$this->db->query("UPDATE timelinekj SET tanggal=?, kegiatan=?, status_kegiatan=?, catatan=?, id_admin=? 
				WHERE id_timeline=?", $p);
			redirect('admin/kejurnas_time/'.$_POST['idkj']);
		}
		
		if ($idt===false) { } else
		{
			$h=$this->db->query("SELECT * FROM timelinekj WHERE id_timeline=? LIMIT 0,1", $idt);
			$j=$h->num_rows();
			if ($j==0)
			{
				$_SESSION['POPUP_MSG']='Data Timeline tidak ada...';	
				$_SESSION['POPUP_CLR']='info';
				redirect('admin/kejurnas');
			}
			else
			{
				$this->data['DtTime']=$h->row_array();
				$h=$this->db->query("SELECT * FROM kejurnas WHERE id_kj=? LIMIT 0,1", $this->data['DtTime']['id_kj']);
				$this->data['DtKj']=$h->row_array();
				$stkj=$this->data['DtKj']['status_kj'];
				$this->data['MnuAktif']='Kejurnas';
				$this->data['SubMnuAktif']='Kejurnas';
				$this->data['Status_KJ']=$stkj;
				$this->load->view('adm_kejurnas_time_edit', $this->data);
				
			}
		}
	}
	
	public function kejurnas_time_del($idt=false)
	{
		if ($idt===false) { } else
		{
			$h=$this->db->query("SELECT * FROM timelinekj WHERE id_timeline=? LIMIT 0,1", $idt);
			$j=$h->num_rows();
			if ($j==0)
			{
				$_SESSION['POPUP_MSG']='Data Timeline tidak ada...';	
				$_SESSION['POPUP_CLR']='info';
				redirect('admin/kejurnas');
			}
			else
			{
				$dttime=$h->row_array();
				$h=$this->db->query("SELECT * FROM kejurnas WHERE id_kj=? LIMIT 0,1", $dttime['id_kj']);
				$dtkj=$h->row_array();
				$this->db->query("DELETE FROM timelinekj WHERE id_timeline=?", $idt);
				redirect('admin/kejurnas_time/'.$dtkj['id_kj']);
				
			}
		}
	}
	
	
	// pengeluaran kas
	public function kejurnas_kaskeluar($idkj=false)
	{
		if ($idkj===false) { } else
		{
			$h=$this->db->query("SELECT * FROM kejurnas WHERE id_kj=? LIMIT 0,1", $idkj);
			$j=$h->num_rows();
			if ($j==0)
			{
				$_SESSION['POPUP_MSG']='Data kejurnas tidak ada...';	
				$_SESSION['POPUP_CLR']='info';
				redirect('admin/kejurnas');
			}
			else
			{
				$this->data['DtKj']=$h->row_array();
				$stkj=$this->data['DtKj']['status_kj'];
				$h=$this->db->query("SELECT a.*, b.nama_admin FROM kaskeluarkj AS a, admin AS b WHERE a.id_kj=? AND a.id_admin=b.id_admin ORDER BY a.tgl_keluar ASC", $idkj);
				$this->data['DtKas']=$h->result();
				$this->data['JmlKas']=$h->num_rows();
				$this->data['MnuAktif']='Kejurnas';
				$this->data['SubMnuAktif']='Kejurnas';
				$this->data['Status_KJ']=$stkj;
				$this->load->view('adm_kejurnas_kaskeluar_'.$stkj, $this->data);
				
			}
		}
	}
	
	public function kejurnas_kaskeluar_new($idkj=false)
	{
		if (isset($_POST['jumlah']))
		{
			$this->load->model('Mymodel');
			$id='KL'.$this->Mymodel->urut('IDKASOUT', 9999);
			$p=array($id, $_POST['idkj'], $_POST['tgl'], $_POST['bukti'], $_POST['jumlah'],
				 addslashes($_POST['keterangan']), $_SESSION['ID_ADMIN']);
			$this->db->query("INSERT INTO kaskeluarkj (id_kaskeluar, id_kj, tgl_keluar, no_bukti, jumlah, keterangan, id_admin) VALUES (?, ?, ?, ?, ?, ?, ?)", $p);
			//hitung jmlah
			$h=$this->db->query("SELECT SUM(jumlah) AS jml FROM kaskeluarkj WHERE id_kj=?", $_POST['idkj']);
			$dt=$h->row_array();
			$p=array($dt['jml'], $_POST['idkj']);
			$this->db->query("UPDATE kejurnas SET kas_keluar=?, kas_akhir=kas_masuk-kas_keluar WHERE id_kj=?", $p);
			redirect('admin/kejurnas_kaskeluar/'.$_POST['idkj']);
		}
		if ($idkj===false) { } else
		{
			$h=$this->db->query("SELECT * FROM kejurnas WHERE id_kj=? LIMIT 0,1", $idkj);
			$j=$h->num_rows();
			if ($j==0)
			{
				$_SESSION['POPUP_MSG']='Data kejurnas tidak ada...';	
				$_SESSION['POPUP_CLR']='info';
				redirect('admin/kejurnas');
			}
			else
			{
				$this->data['DtKj']=$h->row_array();
				$stkj=$this->data['DtKj']['status_kj'];
				$this->data['MnuAktif']='Kejurnas';
				$this->data['SubMnuAktif']='Kejurnas';
				$this->data['Status_KJ']=$stkj;
				$this->data['TimeLine']=1;
				$this->load->view('adm_kejurnas_kaskeluar_new', $this->data);
				
			}
		}
	}
	
	public function kejurnas_kaskeluar_edit($idkas=false)
	{
		if (isset($_POST['keterangan']))
		{
			$p=array($_POST['tgl'], $_POST['bukti'], $_POST['jumlah'],
				addslashes($_POST['keterangan']), $_SESSION['ID_ADMIN'], $_POST['idkas']);
			$this->db->query("UPDATE kaskeluarkj SET tgl_keluar=?, no_bukti=?, jumlah=?, keterangan=?, id_admin=?
				WHERE id_kaskeluar=?", $p);
			//hitung jmlah
			$h=$this->db->query("SELECT SUM(jumlah) AS jml FROM kaskeluarkj WHERE id_kj=?", $_POST['idkj']);
			$dt=$h->row_array();
			$p=array($dt['jml'], $_POST['idkj']);
			$this->db->query("UPDATE kejurnas SET kas_keluar=?, kas_akhir=kas_masuk-kas_keluar WHERE id_kj=?", $p);
			redirect('admin/kejurnas_kaskeluar/'.$_POST['idkj']);
		}
		
		if ($idkas===false) { } else
		{
			$h=$this->db->query("SELECT * FROM kaskeluarkj WHERE id_kaskeluar=? LIMIT 0,1", $idkas);
			$j=$h->num_rows();
			if ($j==0)
			{
				$_SESSION['POPUP_MSG']='Data kas keluar tidak ada...';	
				$_SESSION['POPUP_CLR']='info';
				redirect('admin/kejurnas');
			}
			else
			{
				$this->data['DtKas']=$h->row_array();
				$h=$this->db->query("SELECT * FROM kejurnas WHERE id_kj=? LIMIT 0,1", $this->data['DtKas']['id_kj']);
				$this->data['DtKj']=$h->row_array();
				$stkj=$this->data['DtKj']['status_kj'];
				$this->data['MnuAktif']='Kejurnas';
				$this->data['SubMnuAktif']='Kejurnas';
				$this->data['Status_KJ']=$stkj;
				$this->load->view('adm_kejurnas_kaskeluar_edit', $this->data);
				
			}
		}
	}
	
	public function kejurnas_kaskeluar_del($idkas=false)
	{
		if ($idkas===false) { } else
		{
			$h=$this->db->query("SELECT * FROM kaskeluarkj WHERE id_kaskeluar=? LIMIT 0,1", $idkas);
			$j=$h->num_rows();
			if ($j==0)
			{
				$_SESSION['POPUP_MSG']='Data kas keluar tidak ada...';	
				$_SESSION['POPUP_CLR']='info';
				redirect('admin/kejurnas');
			}
			else
			{
				$dtkas=$h->row_array();
				$this->db->query("DELETE FROM kaskeluarkj WHERE id_kaskeluar=?", $idkas);
				//hitung jmlah
				$h=$this->db->query("SELECT SUM(jumlah) AS jml FROM kaskeluarkj WHERE id_kj=?", $dtkas['id_kj']);
				$dt=$h->row_array();
				$p=array($dt['jml'], $dtkas['id_kj']);
				$this->db->query("UPDATE kejurnas SET kas_keluar=?, kas_akhir=kas_masuk-kas_keluar WHERE id_kj=?", $p);
				redirect('admin/kejurnas_kaskeluar/'.$dtkas['id_kj']);
			}
		}
	}
	//============================
	/// HAPUS data
	public function hapusdata($do=false)
	{
		if ($do===false) { } else
		{	
			$this->db->query("TRUNCATE TABLE gelarkj");
			$this->db->query("TRUNCATE TABLE kategorikj");
			$this->db->query("TRUNCATE TABLE iurankj"); 
			$this->db->query("TRUNCATE TABLE iurankj_byr");
			$this->db->query("TRUNCATE TABLE kejurnas");
			$this->db->query("TRUNCATE TABLE pesertakj");
			$this->db->query("TRUNCATE TABLE events");
			$this->db->query("TRUNCATE TABLE urut");
		}
		$this->data['MnuAktif']='SuperAdmin';
		$this->data['SubMnuAktif']='HapusData';
		$this->load->view('adm_hapus_data', $this->data);
	}
}
?>
