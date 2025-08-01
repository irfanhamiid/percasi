<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminlogin extends CI_Controller {

    public $data;

    function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['ID_ADMIN']))
        {
            $_SESSION['ID_ADMIN']=0;
            $_SESSION['NM_ADMIN']='';
            $_SESSION['TP_ADMIN']=0;
        }
        $h=$this->db->query("SELECT * FROM instansi WHERE id=1");
        $this->data['INSTANSI']=$h->row_array();
        if($_SESSION['ID_ADMIN'] != 0){
            return redirect('admin');
        }
    }
	public function index()
	{
        $e=0;
        if (isset($_POST['username']))
        {
            $p=array($_POST['username'], md5($_POST['passwd']));
            $h=$this->db->query("SELECT * FROM admin WHERE user_name=? AND passwd=? LIMIT 0,1", $p);
            if ($h->num_rows()>0)
            {
                $dt=$h->row_array();
                $_SESSION['ID_ADMIN']=$dt['id_admin'];
                $_SESSION['FOTO'] = $dt['foto'];
                $_SESSION['NM_ADMIN']=$dt['nama_admin'];
                $_SESSION['TP_ADMIN']=$dt['tipe_admin'];
                redirect('admin');
            }
            else
            {
                $e=1;
            }
        }
        $this->data['Gagal']=$e;
		$this->load->view('adm_login', $this->data);
	}
}
