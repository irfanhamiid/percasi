<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Oprlogin extends CI_Controller {

    public $data;

    function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['ID_OPR']))
        {
            $_SESSION['ID_OPR']=0;
            $_SESSION['NM_OPR']='';
            $_SESSION['IDPROV_OPR']=0;
            $_SESSION['NMPROV_OPR']='';
        }
        $h=$this->db->query("SELECT * FROM instansi WHERE id=1");
        $this->data['INSTANSI']=$h->row_array();
        if($_SESSION['ID_OPR'] != 0)
        {
            return redirect('opr');
        }
    }
	public function index()
	{
        $e=0;
        if (isset($_POST['username']))
        {
            $p=array($_POST['username'], md5($_POST['passwd']));
            $h=$this->db->query("SELECT a.*, b.provinsi FROM operator AS a, provinsi AS b WHERE 
				a.user_name=? AND a.passwd=? AND a.aktif=1  AND a.id_prov=b.id_prov LIMIT 0,1", $p);
            if ($h->num_rows()>0)
            {
                $dt=$h->row_array();
                $_SESSION['ID_OPR']=$dt['id_operator'];
				$_SESSION['NM_OPR']=$dt['nama_operator'];
				$_SESSION['IDPROV_OPR']=$dt['id_prov'];
				$_SESSION['NMPROV_OPR']=$dt['provinsi'];
                $_SESSION['FOTO']=$dt['foto'];
                $_SESSION['IURAN']=$dt['iuran'];
                redirect('opr');
            }
            else
            {
                $e=1;
            }
        }
        $this->data['Gagal']=$e;
		$this->load->view('opr_login', $this->data);
	}
}
