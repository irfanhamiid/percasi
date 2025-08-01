<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {

    public $data;

    function __construct()
    {
        parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
        $h=$this->db->query("SELECT * FROM instansi WHERE id=1");
        $this->data['INSTANSI']=$h->row_array();
    }
	public function index()
	{
		//baca data berita 6 post
		$h=$this->db->query("SELECT a.id_berita,a.foto, a.tgl_post, a.id_admin, a.judul, a.ringkasan, b.nama_admin FROM berita AS a,
			admin AS b WHERE a.aktif=1 AND a.id_admin=b.id_admin ORDER BY a.id_berita DESC LIMIT 0,6");
		$this->data['DtBerita']=$h->result();	
		$this->data['JmlBerita']=$h->num_rows();
		//baca event 6 event
		$h=$this->db->query("SELECT * FROM events ORDER BY status_ev ASC LIMIT 0,6");
		$this->data['DtEvent']=$h->result();	
		$this->data['JmlEvent']=$h->num_rows();
		
		$this->load->view('web_home', $this->data);
	}
	
	
	// BERITA
	public function berita($hal=1)
	{
		$maxdata=8;
		$awal=($hal-1)*$maxdata;
		$p=array($awal, $maxdata);
		$h=$this->db->query("SELECT a.id_berita, a.tgl_post, a.id_admin, a.judul,a.foto, a.ringkasan, b.nama_admin FROM berita AS a,
			admin AS b WHERE a.aktif=1 AND a.id_admin=b.id_admin ORDER BY a.id_berita DESC LIMIT ?,?", $p);
		$this->data['DtBerita']=$h->result();	
		$this->data['JmlBerita']=$h->num_rows();	
		
		$h=$this->db->query("SELECT COUNT(id_berita) AS jml FROM berita WHERE aktif=1");
		$dt=$h->row_array();
		$jmlhal=ceil($dt['jml']/$maxdata);
		$link=base_url().'/berita/';
		$this->load->model('Mymodel');
		$this->data['Paging']=$this->Mymodel->paging($link, $hal, 5, $jmlhal);
		$this->load->view('web_berita', $this->data);
	}

	public function berita_detail($idb=false)
	{
		if ($idb===false) { } else
		{
			$h=$this->db->query("SELECT a.id_berita,a.foto, a.tgl_post, a.id_admin, a.judul, a.detail, b.nama_admin FROM berita AS a,
			admin AS b WHERE a.id_berita=? AND a.aktif=1 AND a.id_admin=b.id_admin LIMIT 0,1", $idb);
			$this->data['DtBerita']=$h->row_array();

			// berita lain 5 buah
			$h=$this->db->query("SELECT a.id_berita,a.foto, a.tgl_post, a.id_admin, a.judul, a.ringkasan, b.nama_admin FROM berita AS a,
			admin AS b WHERE a.id_berita<>? AND a.aktif=1 AND a.id_admin=b.id_admin ORDER BY a.id_berita DESC LIMIT 0,5", $idb);
			$this->data['DtBeritaLain']=$h->result();	
			$this->data['JmlBeritaLain']=$h->num_rows();	
			$this->load->view('web_berita_detail', $this->data);
		}
	}
	
	// EVENT
	public function event($hal=1)
	{
		$maxdata=8;
		$awal=($hal-1)*$maxdata;
		$p=array($awal, $maxdata);
		$h=$this->db->query("SELECT * FROM events ORDER BY status_ev ASC LIMIT ?,?", $p);
		$this->data['DtEvent']=$h->result();	
		$this->data['JmlEvent']=$h->num_rows();	
		
		$h=$this->db->query("SELECT COUNT(id_ev) AS jml FROM events");
		$dt=$h->row_array();
		$jmlhal=ceil($dt['jml']/$maxdata);
		$link=base_url().'/event/';
		$this->load->model('Mymodel');
		$this->data['Paging']=$this->Mymodel->paging($link, $hal, 5, $jmlhal);
		$this->load->view('web_event', $this->data);
	}
	
	public function event_detail($ide=false)
	{
		if ($ide===false) { } else
		{
			$h=$this->db->query("SELECT * FROM events WHERE id_ev=? LIMIT 0,1", $ide);
			$this->data['DtEvent']=$h->row_array();
			if ($this->data['DtEvent']['status_ev']==2)
			{
				$hj=$this->db->query("SELECT a.*, b.nama_pst FROM juaraev AS a, pesertaev AS b WHERE a.id_pst_ev=
				b.id_pst_ev");
				$this->data['Juara']=$hj->result();
			}
			//Peserta
			$h=$this->db->query("SELECT a.id_pst_ev, a.id_ev, a.id_ktg_ev, a.id_gelar_ev, a.id_prov, a.nama_pst,
			 b.kategori, c.gelar, d.provinsi FROM pesertaev AS a, kategoriev AS b, gelarev AS c, 
				provinsi AS d
				WHERE a.id_ev=? AND a.id_ktg_ev=b.id_ktg_ev AND a.id_gelar_ev=c.id_gelar_ev AND a.id_prov=d.id_prov", $ide);
			$this->data['DtPeserta']=$h->result();	
			$this->data['JmlPeserta']=$h->num_rows();
			

			// berita lain 5 buah
			$h=$this->db->query("SELECT * FROM events WHERE id_ev<>? ORDER BY status_ev ASC LIMIT 0,5", $ide);
			$this->data['DtEventLain']=$h->result();	
			$this->data['JmlEventLain']=$h->num_rows();	
			$this->load->view('web_event_detail', $this->data);
		}
	}
	
	public function tentang()
	{
		$h=$this->db->query("SELECT * FROM tentang WHERE aktif=1 ORDER BY id_ttg ASC");
		$this->data['DtTtg']=$h->result();
		$this->data['JmlTtg']=$h->num_rows();
		$this->load->view('web_tentang', $this->data);
	}
}

?>