<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public $data;

    function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['ID_ADMIN']) || $_SESSION['ID_ADMIN'] == 0) {
            redirect('adminlogin');
        }
        date_default_timezone_set('Asia/Jakarta');
        $h = $this->db->query('SELECT * FROM instansi WHERE id=1');
        $this->data['INSTANSI'] = $h->row_array();
        $this->data['TIPE_ADMIN'] = ['1' => 'Pimpinan', '2' => 'Admin', '3' => 'Admin 1'];
        $this->data['TIPE_ADMIN_CLR'] = ['1' => 'primary', '2' => 'info', '3' => 'danger'];
        $this->data['STATUS_AKTIF'] = ['Tidak Aktif', 'Aktif'];
        $this->data['STATUS_AKTIF_CLR'] = ['danger', 'success'];
        if (!isset($_SESSION['POPUP_MSG'])) {
            $_SESSION['POPUP_MSG'] = '';
            $_SESSION['POPUP_CLR'] = 'info';
        }
        //Gelar pendaftaran
        $g = ['Reguler', 'Grand Master/Woman Grand Master', 'International Master/Woman International Master', 'Fide Master/Woman Fide Master', 'Candidate Master/Woman Candidate Master', 'Wild Card 1', 'Wild Card 2'];
        $this->data['GELAR'] = $g;
        $this->data['TimeLine'] = 0;
    }
    public function index()
    {
        $this->data['MnuAktif'] = 'Beranda';
        $this->data['SubMnuAktif'] = '';
        $this->load->view('adm_home', $this->data);
    }

    public function logout()
    {
        $_SESSION['ID_ADMIN'] = 0;
        $_SESSION['NM_ADMIN'] = '';
        $_SESSION['TP_ADMIN'] = 0;
        redirect('adminlogin');
    }

    /* PENGATURAN */
    public function pengaturan()
    {
        if (isset($_POST['alamat'])) {
            $p = [$_POST['alamat'], $_POST['telepon'], $_POST['telepon_wa'], $_POST['email']];
            $this->db->query('UPDATE instansi SET alamat=?, telepon=?, telepon_wa=?, email=? WHERE id=1', $p);
            $_SESSION['POPUP_MSG'] = 'Data telah disimpan.';
            $_SESSION['POPUP_CLR'] = 'info';
        }
        $h = $this->db->query('SELECT * FROM instansi WHERE id=1');
        $this->data['INSTANSI'] = $h->row_array();
        $this->data['MnuAktif'] = 'SuperAdmin';
        $this->data['SubMnuAktif'] = 'Pengaturan';
        $this->load->view('adm_pengaturan', $this->data);
    }
    /* DATA ADMIN  */
    public function admin()
    {
        $h = $this->db->query('SELECT * FROM admin WHERE id_admin>1 ORDER BY nama_admin ASC');
        $this->data['DtAdmin'] = $h->result();
        $this->data['JmlAdmin'] = $h->num_rows();
        $this->data['MnuAktif'] = 'SuperAdmin';
        $this->data['SubMnuAktif'] = 'DataAdmin';
        $this->load->view('adm_admin', $this->data);
    }

    public function admin_new()
    {
        if (isset($_POST['username'])) {
            $id = $this->db->insert_id();
            $fn = $_FILES['foto']['tmp_name'];
            $fz = $_FILES['foto']['size'];
            $fext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            $p = [$_POST['namaadmin'], $_POST['username'], md5($_POST['passwd']), $_POST['username'] . '.' . $fext, 2, $_POST['aktif']];
            $this->db->query(
                "INSERT INTO admin (nama_admin, user_name, passwd,foto, tipe_admin, aktif) VALUES 
        				(?, ?, ?, ?, ?, ?)",
                $p,
            );

            if ($fz > 0) {
                move_uploaded_file($fn, 'img/' . $_POST['username'] . '.' . $fext);
            }
            $_SESSION['POPUP_MSG'] = 'Data telah ditambahkan.';
            $_SESSION['POPUP_CLR'] = 'info';
            redirect('admin/admin');
        }
        $this->data['MnuAktif'] = 'SuperAdmin';
        $this->data['SubMnuAktif'] = 'DataAdmin';
        $this->load->view('adm_admin_new', $this->data);
    }

    public function admin_edit($id = false)
    {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $fn = $_FILES['foto']['tmp_name'];
            $fz = $_FILES['foto']['size'];
            $fext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);


            if ($fz > 0) {
                move_uploaded_file($fn, 'img/' . $_POST['username'] . '.' . $fext);
                if ($_POST['passwd'] != null) {
                    $p = [$_POST['namaadmin'], $_POST['username'], md5($_POST['passwd']), $_POST['username'] . '.' . $fext, $_POST['aktif'], $_POST['id']];
                    $this->db->query('UPDATE admin SET nama_admin=?, user_name=?, passwd=?,foto=?, aktif=? WHERE id_admin=?', $p);
                } else {
                    $p = [$_POST['namaadmin'], $_POST['username'], $_POST['username'] . '.' . $fext, $_POST['aktif'], $_POST['id']];
                    $this->db->query('UPDATE admin SET nama_admin=?, user_name=?,foto=?, aktif=? WHERE id_admin=?', $p);
                }
            } else {
                if ($_POST['passwd'] != null) {
                    $p = [$_POST['namaadmin'], $_POST['username'], md5($_POST['passwd']), $_POST['aktif'], $_POST['id']];
                    $this->db->query('UPDATE admin SET nama_admin=?, user_name=?, passwd=?, aktif=? WHERE id_admin=?', $p);
                } else {
                    $p = [$_POST['namaadmin'], $_POST['username'], $_POST['aktif'], $_POST['id']];
                    $this->db->query('UPDATE admin SET nama_admin=?, user_name=?, aktif=? WHERE id_admin=?', $p);
                }
            }
            redirect('admin/admin');
        }
        if ($id === false) {
        } else {
            $h = $this->db->query('SELECT * FROM admin WHERE id_admin=? LIMIT 0,1', $id);
            if ($h->num_rows() == 0) {
                $_SESSION['POPUP_MSG'] = 'Data tidak ditemukan.';
                $_SESSION['POPUP_CLR'] = 'error';
                redirect('admin/admin');
            } else {
                $this->data['DtAdmin'] = $h->row_array();
                $this->data['MnuAktif'] = 'SuperAdmin';
                $this->data['SubMnuAktif'] = 'DataAdmin';
                $this->load->view('adm_admin_edit', $this->data);
            }
        }
    }

    public function admin_del($id)
    {
        $this->db->where('id_admin', $id);
        $this->db->delete('admin');
        redirect('admin/admin');
    }

    /* DATA PROVINSI  */
    public function provinsi()
    {
        $h = $this->db->query('SELECT * FROM provinsi WHERE id_prov> 1 ORDER BY id_prov ASC');
        $this->data['DtProv'] = $h->result();
        $this->data['JmlProv'] = $h->num_rows();
        $this->data['MnuAktif'] = 'SuperAdmin';
        $this->data['SubMnuAktif'] = 'DataProv';
        $this->load->view('adm_provinsi', $this->data);
    }

    public function provinsi_new()
    {
        if (isset($_POST['provinsi'])) {
            $this->db->query('INSERT INTO provinsi (provinsi) VALUES (?)', $_POST['provinsi']);
            redirect('admin/provinsi');
        }
        $this->data['MnuAktif'] = 'SuperAdmin';
        $this->data['SubMnuAktif'] = 'DataProv';
        $this->load->view('adm_provinsi_new', $this->data);
    }

    public function provinsi_edit($id = false)
    {
        if (isset($_POST['id'])) {
            $p = [$_POST['provinsi'], $_POST['id']];
            $this->db->query('UPDATE provinsi SET provinsi=? WHERE id_prov=?', $p);
            redirect('admin/provinsi');
        }
        if ($id === false) {
        } else {
            $h = $this->db->query('SELECT * FROM provinsi WHERE id_prov=? LIMIT 0,1', $id);
            if ($h->num_rows() == 0) {
                $_SESSION['POPUP_MSG'] = 'Data tidak ditemukan.';
                $_SESSION['POPUP_CLR'] = 'error';
                redirect('admin/provinsi');
            } else {
                $this->data['DtProv'] = $h->row_array();
                $this->data['MnuAktif'] = 'SuperAdmin';
                $this->data['SubMnuAktif'] = 'DataProv';
                $this->load->view('adm_provinsi_edit', $this->data);
            }
        }
    }

    public function provinsidel($id)
    {
        $this->db->where('id_prov', $id);
        $this->db->delete('provinsi');
        redirect('admin/provinsi');
    }

    /* DATA OPERATOR  */
    public function operator()
    {
        $h = $this->db->query("SELECT a.*, b.provinsi FROM operator AS a, provinsi AS b WHERE a.id_prov>1 AND a.id_prov=b.id_prov ORDER BY b.provinsi ASC,
        			a.nama_operator ASC");
        $this->data['DtOpr'] = $h->result();
        $this->data['JmlOpr'] = $h->num_rows();
        $this->data['MnuAktif'] = 'SuperAdmin';
        $this->data['SubMnuAktif'] = 'DataOperator';
        $this->load->view('adm_operator', $this->data);
    }

    public function operator_new()
    {
        if (isset($_POST['idprov'])) {
            $id = $this->db->insert_id();
            $fn = $_FILES['foto']['tmp_name'];
            $fz = $_FILES['foto']['size'];
            $fext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            $p = [$_POST['namaopr'], $_POST['username'], md5($_POST['passwd']), $_POST['username'] . '.' . $fext, $_POST['aktif'], $_POST['telepon'], $_POST['email'], $_POST['idprov']];
            $this->db->query(
                "INSERT INTO operator (nama_operator, user_name, passwd,foto, aktif, telepon, email, id_prov) VALUES 
        				(?, ?, ?, ?, ?, ?,?, ?)",
                $p,
            );

            if ($fz > 0) {
                move_uploaded_file($fn, 'img/opr/' . $_POST['username'] . '.' . $fext);
            }
            redirect('admin/operator');
        }
        $h = $this->db->query('SELECT * FROM provinsi ORDER BY provinsi ASC');
        $this->data['DtProv'] = $h->result();
        $this->data['MnuAktif'] = 'SuperAdmin';
        $this->data['SubMnuAktif'] = 'DataOperator';
        $this->load->view('adm_operator_new', $this->data);
    }

    public function operator_edit($id = false)
    {
        if (isset($_POST['idopr'])) {

            $id = $_POST['idopr'];
            $fn = $_FILES['foto']['tmp_name'];
            $fz = $_FILES['foto']['size'];
            $fext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            if ($fz > 0) {
                move_uploaded_file($fn, 'img/opr/' . $_POST['username'] . '.' . $fext);
                if ($_POST['passwd'] == '') {
                    $p = [$_POST['namaopr'], $_POST['username'], $_POST['username'] . '.' . $fext, $_POST['aktif'], $_POST['telepon'], $_POST['email'], $_POST['idprov'], $_POST['iuran'], $_POST['idopr']];
                    $this->db->query(
                        "UPDATE operator SET nama_operator=?, user_name=?,foto=?, aktif=?, telepon=?, email=?, id_prov=?, iuran=? WHERE 
                                    id_operator=?",
                        $p,
                    );
                } else {
                    $p = [$_POST['namaopr'], $_POST['username'], md5($_POST['passwd']), $_POST['username'] . '.' . $fext, $_POST['aktif'], $_POST['telepon'], $_POST['email'], $_POST['idprov'], $_POST['iuran'], $_POST['idopr']];
                    $this->db->query(
                        "UPDATE operator SET nama_operator=?, user_name=?, passwd=?,foto=?, aktif=?, telepon=?, email=?, id_prov=?, iuran=? WHERE 
                                    id_operator=?",
                        $p,
                    );
                }
            } else {
                if ($_POST['passwd'] == '') {
                    $p = [$_POST['namaopr'], $_POST['username'], $_POST['aktif'], $_POST['telepon'], $_POST['email'], $_POST['idprov'], $_POST['iuran'], $_POST['idopr']];
                    $this->db->query(
                        "UPDATE operator SET nama_operator=?, user_name=?, aktif=?, telepon=?, email=?, id_prov=?, iuran=? WHERE 
                                    id_operator=?",
                        $p,
                    );
                } else {
                    $p = [$_POST['namaopr'], $_POST['username'], md5($_POST['passwd']), $_POST['aktif'], $_POST['telepon'], $_POST['email'], $_POST['idprov'], $_POST['iuran'], $_POST['idopr']];
                    $this->db->query(
                        "UPDATE operator SET nama_operator=?, user_name=?, passwd=?, aktif=?, telepon=?, email=?, id_prov=?, iuran=? WHERE 
                                    id_operator=?",
                        $p,
                    );
                }
            }
            redirect('admin/operator');
        }
        if ($id === false) {
        } else {
            $h = $this->db->query('SELECT * FROM operator WHERE id_operator=? LIMIT 0,1', $id);
            if ($h->num_rows() == 0) {
                $_SESSION['POPUP_MSG'] = 'Data tidak ditemukan.';
                $_SESSION['POPUP_CLR'] = 'error';
                redirect('admin/provinsi');
            } else {
                $this->data['DtOpr'] = $h->row_array();
                $hp = $this->db->query('SELECT * FROM provinsi ORDER BY provinsi ASC');
                $this->data['DtProv'] = $hp->result();
                $f = 'img/opr/' . $h->row()->foto;
                if (file_exists($f)) {
                    $this->data['Foto'] = $f;
                } else {
                    $this->data['Foto'] = 'img/noimage.jpg';
                }
                $this->data['MnuAktif'] = 'SuperAdmin';
                $this->data['SubMnuAktif'] = 'DataOperator';
                $this->load->view('adm_operator_edit', $this->data);
            }
        }
    }

    public function operator_del($id)
    {
        $this->db->where('id_operator', $id);
        $this->db->delete('operator');
        redirect('admin/operator');
    }

    //EVENTS
    public function event($status = 0)
    {
        $h = $this->db->query('SELECT * FROM events WHERE status_ev=? ORDER BY id_ev ASC', $status);
        $this->data['JmlEv'] = $h->num_rows();
        $this->data['DtEv'] = $h->result();
        $this->data['MnuAktif'] = 'Event';
        $this->data['SubMnuAktif'] = 'Event' . $status;
        $this->load->view('adm_event_' . $status, $this->data);
    }

    //tambah event baru
    public function event_new()
    {
        if (isset($_POST['namaevent'])) {
            $this->load->model('Mymodel');
            //E20230312345
            $fn = $_FILES['poster']['tmp_name'];
            $fz = $_FILES['poster']['size'];
            $fext = pathinfo($_FILES['poster']['name'], PATHINFO_EXTENSION);

            $idev = 'EV' . $this->Mymodel->urut('EIDEVENT', 9999);
            $p = [$idev, $_POST['namaevent'], $idev . '.' . $fext, $_POST['tglevnta'], $_POST['tglevntb'], $_POST['tglevntend'], $_SESSION['ID_ADMIN'], 0, $_POST['iuranwjb']];
            $this->db->query(
                "INSERT INTO events (id_ev, nama_ev,poster, tgl_mulai_ev, tgl_selesai_ev, tgl_bts_daftar, id_admin,
        				status_ev, iuran_wjb) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)",
                $p,
            );

            if ($fz > 0) {
                $ft = 'img/poster/' . $idev . '.' . $fext;
                move_uploaded_file($fn, $ft);
                $config['image_library'] = 'gd2';
                $config['source_image'] = $ft;
                $config['create_thumb'] = true;
                $config['maintain_ratio'] = true;
                $config['width'] = 400;
                $config['height'] = 600;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
            }
            $fn = $_FILES['proposal']['tmp_name'];
            $fz = $_FILES['proposal']['size'];
            if ($fz > 0) {
                move_uploaded_file($fn, './pdf/' . $idev . '.pdf');
            }
            redirect('admin/event_detail/' . $idev);
        }
        $this->data['MnuAktif'] = 'Event';
        $this->data['SubMnuAktif'] = 'EventBaru';
        $this->load->view('adm_event_new', $this->data);
    }

    public function event_edit($idev = false)
    {
        if (isset($_POST['namaevent'])) {

            $fn = $_FILES['poster']['tmp_name'];
            $fz = $_FILES['poster']['size'];
            $fext = pathinfo($_FILES['poster']['name'], PATHINFO_EXTENSION);
            if ($fz > 0) {
                $p = [$_POST['namaevent'], $_POST['idev'] . '.' . $fext, $_POST['tglevnta'], $_POST['tglevntb'], $_POST['tglevntend'], $_SESSION['ID_ADMIN'], $_POST['status'], $_POST['iuranwjb'], $_POST['idev']];
                $this->db->query(
                    "UPDATE events SET nama_ev=?,poster=?, tgl_mulai_ev=?, tgl_selesai_ev=?, tgl_bts_daftar=?, id_admin=?,
                            status_ev=?, iuran_wjb=? WHERE id_ev=?",
                    $p,
                );
                $ft = 'img/poster/' . $_POST['idev'] . '.' . $fext;
                move_uploaded_file($fn, $ft);
                $config['image_library'] = 'gd2';
                $config['source_image'] = $ft;
                $config['create_thumb'] = true;
                $config['maintain_ratio'] = true;
                $config['width'] = 400;
                $config['height'] = 600;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
            } else {
                $p = [$_POST['namaevent'], $_POST['tglevnta'], $_POST['tglevntb'], $_POST['tglevntend'], $_SESSION['ID_ADMIN'], $_POST['status'], $_POST['iuranwjb'], $_POST['idev']];
                $this->db->query(
                    "UPDATE events SET nama_ev=?, tgl_mulai_ev=?, tgl_selesai_ev=?, tgl_bts_daftar=?, id_admin=?,
                            status_ev=?, iuran_wjb=? WHERE id_ev=?",
                    $p,
                );
            }
            $fn = $_FILES['proposal']['tmp_name'];
            $fz = $_FILES['proposal']['size'];
            if ($fz > 0) {
                move_uploaded_file($fn, './pdf/' . $_POST['idev'] . '.pdf');
            }
            $this->hitung_iuran_ev($_POST['idev']);
            redirect('admin/event_detail/' . $_POST['idev']);
        }

        if ($idev === false) {
        } else {
            $h = $this->db->query(
                "SELECT a.*, b.nama_admin FROM events AS a, admin AS b WHERE a.id_ev=? AND a.id_admin=b.id_admin
        				LIMIT 0,1",
                $idev,
            );
            if ($h->num_rows() == 0) {
                $_SESSION['POPUP_MSG'] = 'Data events tidak tersedia...';
                $_SESSION['POPUP_CLR'] = 'error';
                redirect('admin/event_new');
            } else {
                $this->data['DtEvent'] = $h->row_array();
                $stev = $this->data['DtEvent']['status_ev'];
                $h = $this->db->query('SELECT * FROM kategoriev WHERE id_ev=? ORDER BY kategori ASC', $idev);
                $this->data['JmlKtg'] = $h->num_rows();
                $this->data['DtKtg'] = $h->result();
                $h = $this->db->query('SELECT * FROM gelarev WHERE id_ev=? ORDER BY gelar ASC', $idev);
                $this->data['JmlGelar'] = $h->num_rows();
                $this->data['DtGelar'] = $h->result();

                $this->data['MnuAktif'] = 'Event';
                $this->data['SubMnuAktif'] = 'Event' . $stev;
                $this->load->view('adm_event_edit', $this->data);
            }
        }
    }

    public function event_del($idev = false)
    {
        if ($idev === false) {
        } else {
            $h = $this->db->query(
                "SELECT a.*, b.nama_admin FROM events AS a, admin AS b WHERE a.id_ev=? AND a.id_admin=b.id_admin
        				LIMIT 0,1",
                $idev,
            );
            if ($h->num_rows() == 0) {
                $_SESSION['POPUP_MSG'] = 'Data events tidak tersedia...';
                $_SESSION['POPUP_CLR'] = 'error';
                redirect('admin/event_new');
            } else {
                $this->data['DtEvent'] = $h->row_array();
                $stev = $this->data['DtEvent']['status_ev'];
                if ($stev == 2) {
                    $_SESSION['POPUP_MSG'] = 'Events sudah selesai tidak bisa dihapus ...';
                    $_SESSION['POPUP_CLR'] = 'error';
                    redirect('admin/event_detail/' . $idev);
                }
                //Hapus event
                $this->db->query('DELETE FROM events WHERE id_ev=?', $idev);
                $fn = './img/poster/' . $idev . '.jpg';
                if (file_exists($fn)) {
                    unlink($fn);
                }
                //iuran
                $this->db->query('DELETE FROM iuranev WHERE id_ev=?', $idev);
                $h = $this->db->query('SELECT id_byr FROM iuranev_byr WHERE id_ev=?', $idev);
                if ($h->num_rows() > 0) {
                    $dt = $h->result();
                    foreach ($dt as $d) {
                        $fn = './img/bayar/' . $d->id_byr . '.jpg';
                        if (file_exists($fn)) {
                            unlink($fn);
                        }
                    }
                }
                $this->db->query('DELETE FROM iuranev_byr WHERE id_ev=?', $idev);
                //kas keluar
                $h = $this->db->query('SELECT id_kaskeluar FROM kaskeluarev WHERE id_ev=?', $idev);
                if ($h->num_rows() > 0) {
                    $dt = $h->result();
                    foreach ($dt as $d) {
                        $fn = './img/bayar/' . $d->id_kaskeluar . '.jpg';
                        if (file_exists($fn)) {
                            unlink($fn);
                        }
                    }
                }
                $this->db->query('DELETE FROM kaskeluarev WHERE id_ev=?', $idev);
                //kategori
                $this->db->query('DELETE FROM kategoriev WHERE id_ev=?', $idev);
                //gelar
                $this->db->query('DELETE FROM gelarev WHERE id_ev=?', $idev);
                //penerimaan lain
                $h = $this->db->query('SELECT id_penerimaan FROM penerimaanev WHERE id_ev=?', $idev);
                if ($h->num_rows() > 0) {
                    $dt = $h->result();
                    foreach ($dt as $d) {
                        $fn = './img/bayar/' . $d->id_penerimaan . '.jpg';
                        if (file_exists($fn)) {
                            unlink($fn);
                        }
                    }
                }
                $this->db->query('DELETE FROM penerimaanev WHERE id_ev=?', $idev);
                //peserta
                $this->db->query('DELETE FROM pesertaev WHERE id_ev=?', $idev);
                //TimeLine
                $this->db->query('DELETE FROM timelineev WHERE id_ev=?', $idev);
                $_SESSION['POPUP_MSG'] = 'Data events sudah dihapus...';
                $_SESSION['POPUP_CLR'] = 'info';
                redirect('admin/event/' . $stev);
            }
        }
    }

    public function event_ubah_status($idev = false)
    {
        if (isset($_POST['idev'])) {
            $p = [$_POST['status'], $_POST['idev']];
            $this->db->query('UPDATE events SET status_ev=? WHERE id_ev=?', $p);
            redirect('admin/event_detail/' . $_POST['idev']);
        }

        if ($idev === false) {
        } else {
            $h = $this->db->query(
                "SELECT a.*, b.nama_admin FROM events AS a, admin AS b WHERE a.id_ev=? AND a.id_admin=b.id_admin
        				LIMIT 0,1",
                $idev,
            );
            if ($h->num_rows() == 0) {
                $_SESSION['POPUP_MSG'] = 'Data events tidak tersedia...';
                $_SESSION['POPUP_CLR'] = 'error';
                redirect('admin/event_new');
            } else {
                $this->data['DtEvent'] = $h->row_array();
                $stev = $this->data['DtEvent']['status_ev'];

                $this->data['MnuAktif'] = 'Event';
                $this->data['SubMnuAktif'] = 'Event' . $stev;
                $this->load->view('adm_event_ubah_status', $this->data);
            }
        }
    }
    //detail event
    public function event_detail($idev = false, $tg = 'scr')
    {
        if ($idev === false) {
        } else {
            $h = $this->db->query(
                "SELECT a.*, b.nama_admin FROM events AS a, admin AS b WHERE a.id_ev=? AND a.id_admin=b.id_admin
        				LIMIT 0,1",
                $idev,
            );
            if ($h->num_rows() == 0) {
                $_SESSION['POPUP_MSG'] = 'Data events tidak tersedia...';
                $_SESSION['POPUP_CLR'] = 'error';
                redirect('admin/event_new');
            } else {
                $this->data['DtEvent'] = $h->row_array();
                $stev = $this->data['DtEvent']['status_ev'];
                $h = $this->db->query('SELECT * FROM kategoriev WHERE id_ev=? ORDER BY id_ev ASC', $idev);
                $this->data['JmlKtg'] = $h->num_rows();
                $this->data['DtKtg'] = $h->result();
                $h = $this->db->query('SELECT * FROM gelarev WHERE id_ev=? ORDER BY gelar ASC', $idev);
                $this->data['JmlGelar'] = $h->num_rows();
                $this->data['DtGelar'] = $h->result();

                $this->data['MnuAktif'] = 'Event';
                $this->data['SubMnuAktif'] = 'Event' . $stev;
                if ($tg == 'scr') {
                    $this->load->view('adm_event_detail_' . $stev, $this->data);
                } else {
                    $this->load->view('adm_event_detail_ctk', $this->data);
                }
            }
        }
    }

    //Event kategori
    public function event_ktg_new($idev = false)
    {
        if (isset($_POST['idev'])) {
            $this->load->model('Mymodel');
            $id = $_POST['idev'] . $this->Mymodel->urut_saja('EIDKTG', 99);
            $p = [$id, $_POST['idev'], $_POST['ktg']];
            $this->db->query(
                "INSERT INTO kategoriev (id_ktg_ev, id_ev, kategori)
        				VALUES (?, ?, ?)",
                $p,
            );
            redirect('admin/event_detail/' . $_POST['idev']);
        }
        if ($idev === false) {
        } else {
            $h = $this->db->query(
                "SELECT a.*, b.nama_admin FROM events AS a, admin AS b WHERE a.id_ev=? AND a.id_admin=b.id_admin
        				LIMIT 0,1",
                $idev,
            );
            if ($h->num_rows() == 0) {
                $_SESSION['POPUP_MSG'] = 'Data events tidak tersedia...';
                $_SESSION['POPUP_CLR'] = 'error';
                redirect('admin/event_new');
            } else {
                $this->data['DtEvent'] = $h->row_array();
                $this->data['MnuAktif'] = 'Event';
                $this->data['SubMnuAktif'] = 'Event' . $this->data['DtEvent']['status_ev'];
                $this->load->view('adm_event_ktg_new', $this->data);
            }
        }
    }

    public function event_ktg_edit($idktg = false)
    {
        if (isset($_POST['idktgev'])) {
            $p = [$_POST['ktg'], $_POST['idktgev']];
            $this->db->query(
                "UPDATE kategoriev SET kategori=? WHERE 
        				id_ktg_ev=?",
                $p,
            );
            redirect('admin/event_detail/' . $_POST['idev']);
        }
        if ($idktg === false) {
        } else {
            $h = $this->db->query('SELECT * FROM kategoriev WHERE id_ktg_ev=? LIMIT 0,1', $idktg);
            $d = $h->row_array();
            $this->data['DtKtg'] = $d;
            $h = $this->db->query(
                "SELECT a.*, b.nama_admin FROM events AS a, admin AS b WHERE a.id_ev=? AND a.id_admin=b.id_admin
        				LIMIT 0,1",
                $d['id_ev'],
            );
            $this->data['DtEvent'] = $h->row_array();
            $this->data['MnuAktif'] = 'Event';
            $this->data['SubMnuAktif'] = 'Event' . $this->data['DtEvent']['status_ev'];
            $this->load->view('adm_event_ktg_edit', $this->data);
        }
    }

    public function event_ktg_del($idktg = false)
    {
        if ($idktg === false) {
        } else {
            $h = $this->db->query('SELECT * FROM kategoriev WHERE id_ktg_ev=? LIMIT 0,1', $idktg);
            $d = $h->row_array();
            //hapus kategori
            $h = $this->db->query('DELETE FROM kategoriev WHERE id_ktg_ev=?', $idktg);
            //hapus peserta
            $h = $this->db->query('DELETE FROM pesertaev WHERE id_ktg_ev=?', $idktg);

            $this->hitung_iuran_ev($d['id_ev']);

            redirect('admin/event_detail/' . $d['id_ev']);
        }
    }

    //Event Gelar
    public function event_gelar_new($idev = false)
    {
        if (isset($_POST['idev'])) {
            $this->load->model('Mymodel');
            $id = $_POST['idev'] . $this->Mymodel->urut_saja('EIDGELAR', 99);
            $p = [$id, $_POST['idev'], $_POST['gelar'], $_POST['biaya']];
            $this->db->query(
                "INSERT INTO gelarev (id_gelar_ev, id_ev, gelar, biaya_reg)
        				VALUES (?, ?, ?, ?)",
                $p,
            );
            redirect('admin/event_detail/' . $_POST['idev']);
        }
        if ($idev === false) {
        } else {
            $h = $this->db->query(
                "SELECT a.*, b.nama_admin FROM events AS a, admin AS b WHERE a.id_ev=? AND a.id_admin=b.id_admin
        				LIMIT 0,1",
                $idev,
            );
            if ($h->num_rows() == 0) {
                $_SESSION['POPUP_MSG'] = 'Data events tidak tersedia...';
                $_SESSION['POPUP_CLR'] = 'error';
                redirect('admin/event_new');
            } else {
                $this->data['DtEvent'] = $h->row_array();
                $this->data['MnuAktif'] = 'Event';
                $this->data['SubMnuAktif'] = 'Event' . $this->data['DtEvent']['status_ev'];
                $this->load->view('adm_event_gelar_new', $this->data);
            }
        }
    }

    public function event_gelar_edit($idglr = false)
    {
        if (isset($_POST['idglr'])) {
            $p = [$_POST['gelar'], $_POST['biaya'], $_POST['idglr']];
            $this->db->query('UPDATE gelarev SET gelar=?, biaya_reg=? WHERE id_gelar_ev=?', $p);
            redirect('admin/event_detail/' . $_POST['idev']);
        }
        if ($idglr === false) {
        } else {
            $h = $this->db->query('SELECT * FROM gelarev WHERE id_gelar_ev=? LIMIT 0,1', $idglr);
            $d = $h->row_array();
            $this->data['DtGelar'] = $d;
            $h = $this->db->query(
                "SELECT a.*, b.nama_admin FROM events AS a, admin AS b WHERE a.id_ev=? AND a.id_admin=b.id_admin
        				LIMIT 0,1",
                $d['id_ev'],
            );
            $this->data['DtEvent'] = $h->row_array();
            $this->data['MnuAktif'] = 'Event';
            $this->data['SubMnuAktif'] = 'Event' . $this->data['DtEvent']['status_ev'];
            $this->load->view('adm_event_gelar_edit', $this->data);
        }
    }

    public function event_gelar_del($idglr = false)
    {
        if ($idglr === false) {
        } else {
            $h = $this->db->query('SELECT * FROM gelarev WHERE id_gelar_ev=? LIMIT 0,1', $idglr);
            $d = $h->row_array();
            //hapus kategori
            $h = $this->db->query('DELETE FROM gelarev WHERE id_gelar_ev=?', $idglr);
            //hapus peserta
            $h = $this->db->query('DELETE FROM pesertaev WHERE id_gelar_ev=?', $idglr);

            $this->hitung_iuran_ev($d['id_ev']);

            redirect('admin/event_detail/' . $d['id_ev']);
        }
    }

    //Event Peserta
    public function event_peserta($idev = false, $idprov = 0, $tg = 'scr')
    {
        if (isset($_POST['idprov'])) {
            $idev = $_POST['idev'];
            $idprov = $_POST['idprov'];
        }
        if ($idev === false) {
        } else {
            $h = $this->db->query(
                "SELECT a.*, b.nama_admin FROM events AS a, admin AS b WHERE a.id_ev=? AND a.id_admin=b.id_admin
        				LIMIT 0,1",
                $idev,
            );
            if ($h->num_rows() == 0) {
                $_SESSION['POPUP_MSG'] = 'Data events tidak tersedia...';
                $_SESSION['POPUP_CLR'] = 'error';
                redirect('admin/event/0');
            } else {
                $this->data['DtEvent'] = $h->row_array();
                $stev = $this->data['DtEvent']['status_ev'];

                if ($idprov == 0) {
                    $h = $this->db->query(
                        "SELECT a.*, d.kategori, b.gelar, b.biaya_reg, c.provinsi FROM pesertaev AS a, 
        							 gelarev AS b, provinsi AS c, kategoriev AS d WHERE a.id_ev=? AND
        							a.id_gelar_ev=b.id_gelar_ev AND a.id_ktg_ev=d.id_ktg_ev AND a.id_prov=c.id_prov 
        							ORDER BY a.nama_pst ASC",
                        $idev,
                    );
                } else {
                    $p = [$idev, $idprov];
                    $h = $this->db->query(
                        "SELECT a.*, d.kategori, b.gelar, b.biaya_reg, c.provinsi FROM pesertaev AS a, 
        							 gelarev AS b, provinsi AS c, kategoriev AS d WHERE a.id_ev=? AND a.id_prov=? AND
        							a.id_gelar_ev=b.id_gelar_ev AND a.id_ktg_ev=d.id_ktg_ev AND a.id_prov=c.id_prov 
        							ORDER BY a.nama_pst ASC",
                        $p,
                    );
                }

                //echo json_encode($hasil); die();

                $this->data['JmlPst'] = $h->num_rows();
                $this->data['DtPst'] = $h->result();

                $h = $this->db->query('SELECT * FROM provinsi WHERE id_prov>1 ORDER BY provinsi ASC');
                $this->data['DtProv'] = $h->result();
                if ($idprov == 0) {
                    $this->data['NamaProv'] = 'Semua';
                } else {
                    $h = $this->db->query('SELECT * FROM provinsi WHERE id_prov=?LIMIT 0,1', $idprov);
                    $d = $h->row_array();
                    $this->data['NamaProv'] = $d['provinsi'];
                }

                $this->data['IdProvNya'] = $idprov;
                $this->data['MnuAktif'] = 'Event';
                $this->data['SubMnuAktif'] = 'Event' . $stev;
                if ($tg == 'scr') {
                    $this->load->view('adm_event_peserta_' . $stev, $this->data);
                } else {
                    $this->load->view('adm_event_peserta_ctk', $this->data);
                }
            }
        }
    }

    public function event_peserta_kategori($idev = false, $idktg = false, $idprov = 0, $tg = 'scr')
    {
        if (isset($_POST['idprov'])) {
            $idev = $_POST['idev'];
            $idprov = $_POST['idprov'];
            $idktg = $_POST['idktg'];
        }
        if ($idev === false) {
        } else {
            $h = $this->db->query(
                "SELECT a.*, b.nama_admin FROM events AS a, admin AS b WHERE a.id_ev=? AND a.id_admin=b.id_admin
        				LIMIT 0,1",
                $idev,
            );
            if ($h->num_rows() == 0) {
                $_SESSION['POPUP_MSG'] = 'Data events tidak tersedia...';
                $_SESSION['POPUP_CLR'] = 'error';
                redirect('admin/event/0');
            } else {
                $this->data['DtEvent'] = $h->row_array();
                $stev = $this->data['DtEvent']['status_ev'];

                if ($idprov == 0) {
                    $p = [$idev, $idktg];
                    $h = $this->db->query(
                        "SELECT a.*, d.kategori, b.gelar, b.biaya_reg, c.provinsi FROM pesertaev AS a, 
        							 gelarev AS b, provinsi AS c, kategoriev AS d WHERE a.id_ev=? AND
        							a.id_gelar_ev=b.id_gelar_ev AND a.id_ktg_ev=d.id_ktg_ev AND a.id_prov=c.id_prov AND a.id_ktg_ev=?
        							ORDER BY a.nama_pst ASC",
                        $p,
                    );
                } else {
                    $p = [$idev, $idprov, $idktg];
                    $h = $this->db->query(
                        "SELECT a.*, d.kategori, b.gelar, b.biaya_reg, c.provinsi FROM pesertaev AS a, 
        							 gelarev AS b, provinsi AS c, kategoriev AS d WHERE a.id_ev=? AND a.id_prov=? AND
        							a.id_gelar_ev=b.id_gelar_ev AND a.id_ktg_ev=d.id_ktg_ev AND a.id_prov=c.id_prov AND a.id_ktg_ev=?
        							ORDER BY a.nama_pst ASC",
                        $p,
                    );
                }

                //echo json_encode($hasil); die();

                $this->data['JmlPst'] = $h->num_rows();
                $this->data['DtPst'] = $h->result();

                $h = $this->db->query('SELECT * FROM provinsi WHERE id_prov>1 ORDER BY provinsi ASC');
                $this->data['DtProv'] = $h->result();
                if ($idprov == 0) {
                    $this->data['NamaProv'] = 'Semua';
                } else {
                    $h = $this->db->query('SELECT * FROM provinsi WHERE id_prov=?LIMIT 0,1', $idprov);
                    $d = $h->row_array();
                    $this->data['NamaProv'] = $d['provinsi'];
                }

                $this->data['IdProvNya'] = $idprov;
                $this->data['MnuAktif'] = 'Event';
                $this->data['SubMnuAktif'] = 'Event' . $stev;
                $this->data['idktg'] = $idktg;
                if ($tg == 'scr') {
                    $this->load->view('adm_event_peserta_kategori_' . $stev, $this->data);
                } else {
                    $this->load->view('adm_event_peserta_kategori_ctk', $this->data);
                }
            }
        }
    }

    public function event_peserta_gelar($idev = false, $idglr = false, $idprov = 0, $tg = 'scr')
    {
        if (isset($_POST['idprov'])) {
            $idev = $_POST['idev'];
            $idprov = $_POST['idprov'];
            $idglr = $_POST['idglr'];
        }
        if ($idev === false) {
        } else {
            $h = $this->db->query(
                "SELECT a.*, b.nama_admin FROM events AS a, admin AS b WHERE a.id_ev=? AND a.id_admin=b.id_admin
        				LIMIT 0,1",
                $idev,
            );
            if ($h->num_rows() == 0) {
                $_SESSION['POPUP_MSG'] = 'Data events tidak tersedia...';
                $_SESSION['POPUP_CLR'] = 'error';
                redirect('admin/event/0');
            } else {
                $this->data['DtEvent'] = $h->row_array();
                $stev = $this->data['DtEvent']['status_ev'];

                if ($idprov == 0) {
                    $p = [$idev, $idglr];
                    $h = $this->db->query(
                        "SELECT a.*, d.kategori, b.gelar, b.biaya_reg, c.provinsi FROM pesertaev AS a, 
        							 gelarev AS b, provinsi AS c, kategoriev AS d WHERE a.id_ev=? AND
        							a.id_gelar_ev=b.id_gelar_ev AND a.id_ktg_ev=d.id_ktg_ev AND a.id_prov=c.id_prov AND a.id_gelar_ev=?
        							ORDER BY a.nama_pst ASC",
                        $p,
                    );
                } else {
                    $p = [$idev, $idprov, $idglr];
                    $h = $this->db->query(
                        "SELECT a.*, d.kategori, b.gelar, b.biaya_reg, c.provinsi FROM pesertaev AS a, 
        							 gelarev AS b, provinsi AS c, kategoriev AS d WHERE a.id_ev=? AND a.id_prov=? AND
        							a.id_gelar_ev=b.id_gelar_ev AND a.id_ktg_ev=d.id_ktg_ev AND a.id_prov=c.id_prov AND a.id_gelar_ev=?
        							ORDER BY a.nama_pst ASC",
                        $p,
                    );
                }

                //echo json_encode($hasil); die();

                $this->data['JmlPst'] = $h->num_rows();
                $this->data['DtPst'] = $h->result();

                $h = $this->db->query('SELECT * FROM provinsi WHERE id_prov>1 ORDER BY provinsi ASC');
                $this->data['DtProv'] = $h->result();
                if ($idprov == 0) {
                    $this->data['NamaProv'] = 'Semua';
                } else {
                    $h = $this->db->query('SELECT * FROM provinsi WHERE id_prov=?LIMIT 0,1', $idprov);
                    $d = $h->row_array();
                    $this->data['NamaProv'] = $d['provinsi'];
                }

                $this->data['IdProvNya'] = $idprov;
                $this->data['MnuAktif'] = 'Event';
                $this->data['SubMnuAktif'] = 'Event' . $stev;
                $this->data['idglr'] = $idglr;
                if ($tg == 'scr') {
                    $this->load->view('adm_event_peserta_gelar_' . $stev, $this->data);
                } else {
                    $this->load->view('adm_event_peserta_gelar_ctk', $this->data);
                }
            }
        }
    }

    public function event_peserta_ctk($idev = false, $idprov = 0)
    {
        if (isset($_POST['idprov'])) {
            $idev = $_POST['idev'];
            $idprov = $_POST['idprov'];
        }
        if ($idev === false) {
        } else {
            $h = $this->db->query(
                "SELECT a.*, b.nama_admin FROM events AS a, admin AS b WHERE a.id_ev=? AND a.id_admin=b.id_admin
        				LIMIT 0,1",
                $idev,
            );
            if ($h->num_rows() == 0) {
                $_SESSION['POPUP_MSG'] = 'Data events tidak tersedia...';
                $_SESSION['POPUP_CLR'] = 'error';
                redirect('admin/event/0');
            } else {
                $this->data['DtEvent'] = $h->row_array();
                $stev = $this->data['DtEvent']['status_ev'];
                $hktg = $this->db->query('SELECT * FROM kategoriev WHERE id_ev=? ORDER BY kategori ASC', $idev);
                $this->data['DtKtg'] = $hktg->result();
                $this->data['JmlKtg'] = $hktg->num_rows();
                $hasil = [];
                $totalpst = 0;
                $nall = 0;
                if ($this->data['JmlKtg'] > 0) {
                    if ($idprov == 0) {
                        //Semua provinsi
                        foreach ($this->data['DtKtg'] as $dktg) {
                            //pria
                            $p = [$idev, $dktg->id_ktg_ev];
                            $h = $this->db->query(
                                "SELECT a.*, b.gelar, b.biaya_reg, c.provinsi FROM pesertaev AS a, 
        								 gelarev AS b, provinsi AS c WHERE a.id_ev=? AND a.id_ktg_ev=? AND
        								a.jk_pst='P' AND a.id_gelar_ev=b.id_gelar_ev AND a.id_prov=c.id_prov ORDER BY a.nama_pst ASC",
                                $p,
                            );
                            $j = $h->num_rows();
                            if ($j == 0) {
                                $hasil[$nall] = [
                                    'idktg' => $dktg->id_ktg_ev,
                                    'kategori' => $dktg->kategori,
                                    'jk' => [],
                                ];
                                $hasil[$nall]['jk']['P'] = [
                                    'jknya' => 'P',
                                    'jmlpst' => $j,
                                    'pstnya' => [],
                                ];
                            } else {
                                $hasil[$nall] = [
                                    'idktg' => $dktg->id_ktg_ev,
                                    'kategori' => $dktg->kategori,
                                    'jk' => [],
                                ];
                                $hasil[$nall]['jk']['P'] = [
                                    'jknya' => 'P',
                                    'jmlpst' => $j,
                                    'pstnya' => [],
                                ];

                                $dtpst = $h->result();
                                $n = 0;
                                foreach ($dtpst as $pst) {
                                    $hasil[$nall]['jk']['P']['pstnya'][$n] = [
                                        'idpst' => $pst->id_pst_ev,
                                        'namapst' => $pst->nama_pst,
                                        'umur' => $pst->umur,
                                        'gelar' => $pst->gelar,
                                        'byreg' => $pst->biaya_reg,
                                        'provinsi' => $pst->provinsi,
                                    ];
                                    $n++;
                                    $totalpst++;
                                }
                            }
                            $nall++;
                            //wanita
                            $p = [$idev, $dktg->id_ktg_ev];
                            $h = $this->db->query(
                                "SELECT a.*, c.gelar, c.biaya_reg, d.provinsi FROM pesertaev AS a, 
        								 gelarev AS c, provinsi AS d WHERE a.id_ev=? AND a.id_ktg_ev=? AND
        								a.jk_pst='W' AND a.id_gelar_ev=c.id_gelar_ev AND a.id_prov=d.id_prov ORDER BY a.nama_pst ASC",
                                $p,
                            );
                            $j = $h->num_rows();
                            if ($j == 0) {
                                $hasil[$nall] = [
                                    'idktg' => $dktg->id_ktg_ev,
                                    'kategori' => $dktg->kategori,
                                    'jk' => [],
                                ];
                                $hasil[$nall]['jk']['W'] = [
                                    'jknya' => 'W',
                                    'jmlpst' => $j,
                                    'pstnya' => [],
                                ];
                            } else {
                                $hasil[$nall] = [
                                    'idktg' => $dktg->id_ktg_ev,
                                    'kategori' => $dktg->kategori,
                                    'jk' => [],
                                ];
                                $hasil[$nall]['jk']['W'] = [
                                    'jknya' => 'W',
                                    'jmlpst' => $j,
                                    'pstnya' => [],
                                ];
                                $dtpst = $h->result();
                                $n = 0;
                                foreach ($dtpst as $pst) {
                                    $hasil[$nall]['jk']['W']['pstnya'][$n] = [
                                        'idpst' => $pst->id_pst_ev,
                                        'namapst' => $pst->nama_pst,
                                        'umur' => $pst->umur,
                                        'gelar' => $pst->gelar,
                                        'byreg' => $pst->biaya_reg,
                                        'provinsi' => $pst->provinsi,
                                    ];
                                    $n++;
                                    $totalpst++;
                                }
                            }
                            $nall++;
                        }
                    } else {
                        //provinsi dipilih
                        foreach ($this->data['DtKtg'] as $dktg) {
                            //pria
                            $p = [$idev, $dktg->id_ktg_ev, $idprov];
                            $h = $this->db->query(
                                "SELECT a.*, c.gelar, c.biaya_reg, d.provinsi FROM pesertaev AS a, 
        								 gelarev AS c, provinsi AS d WHERE a.id_ev=? AND a.id_ktg_ev=? AND
        								a.id_prov=? AND a.jk_pst='P' AND a.id_gelar_ev=c.id_gelar_ev AND a.id_prov=d.id_prov ORDER BY a.nama_pst ASC",
                                $p,
                            );
                            $j = $h->num_rows();
                            if ($j == 0) {
                                $hasil[$nall] = [
                                    'idktg' => $dktg->id_ktg_ev,
                                    'kategori' => $dktg->kategori,
                                    'jk' => [],
                                ];
                                $hasil[$nall]['jk'][0] = [
                                    'jknya' => 'P',
                                    'jmlpst' => $j,
                                    'pstnya' => [],
                                ];
                            } else {
                                $hasil[$nall] = [
                                    'idktg' => $dktg->id_ktg_ev,
                                    'kategori' => $dktg->kategori,
                                    'jk' => [],
                                ];
                                $hasil[$nall]['jk']['P'] = [
                                    'jknya' => 'P',
                                    'jmlpst' => $j,
                                    'pstnya' => [],
                                ];
                                $dtpst = $h->result();
                                $n = 0;
                                foreach ($dtpst as $pst) {
                                    $hasil[$nall]['jk']['P']['pstnya'][$n] = [
                                        'idpst' => $pst->id_pst_ev,
                                        'namapst' => $pst->nama_pst,
                                        'umur' => $pst->umur,
                                        'gelar' => $pst->gelar,
                                        'byreg' => $pst->biaya_reg,
                                        'provinsi' => $pst->provinsi,
                                    ];
                                    $n++;
                                    $totalpst++;
                                }
                            }
                            $nall++;
                            //wanita
                            $p = [$idev, $dktg->id_ktg_ev, $idprov];
                            $h = $this->db->query(
                                "SELECT a.*, c.gelar, c.biaya_reg, d.provinsi FROM pesertaev AS a, 
        								 gelarev AS c, provinsi AS d WHERE a.id_ev=? AND a.id_ktg_ev=? AND
        								a.id_prov=? AND a.jk_pst='W' AND a.id_gelar_ev=c.id_gelar_ev AND a.id_prov=d.id_prov ORDER BY a.nama_pst ASC",
                                $p,
                            );
                            $j = $h->num_rows();
                            if ($j == 0) {
                                $hasil[$nall] = [
                                    'idktg' => $dktg->id_ktg_ev,
                                    'kategori' => $dktg->kategori,
                                    'jk' => [],
                                ];
                                $hasil[$nall]['jk']['W'] = [
                                    'jknya' => 'W',
                                    'jmlpst' => 0,
                                    'pstnya' => [],
                                ];
                            } else {
                                $hasil[$nall] = [
                                    'idktg' => $dktg->id_ktg_ev,
                                    'kategori' => $dktg->kategori,
                                    'jk' => [],
                                ];
                                $hasil[$nall]['jk']['W'] = [
                                    'jknya' => 'W',
                                    'jmlpst' => $j,
                                    'pstnya' => [],
                                ];
                                $dtpst = $h->result();
                                $n = 0;
                                foreach ($dtpst as $pst) {
                                    $hasil[$nall]['jk']['W']['pstnya'][$n] = [
                                        'idpst' => $pst->id_pst_ev,
                                        'namapst' => $pst->nama_pst,
                                        'umur' => $pst->umur,
                                        'gelar' => $pst->gelar,
                                        'byreg' => $pst->biaya_reg,
                                        'provinsi' => $pst->provinsi,
                                    ];
                                    $n++;
                                    $totalpst++;
                                }
                            }
                            $nall++;
                        }
                    }
                }
                //echo json_encode($hasil); die();
                $this->data['JmlPst'] = $totalpst;
                $this->data['DtPst'] = $hasil;

                $h = $this->db->query('SELECT * FROM provinsi WHERE id_prov>0 ORDER BY provinsi ASC');
                $this->data['DtProv'] = $h->result();
                if ($idprov == 0) {
                    $this->data['NamaProv'] = 'Semua';
                } else {
                    $h = $this->db->query('SELECT * FROM provinsi WHERE id_prov=?LIMIT 0,1', $idprov);
                    $d = $h->row_array();
                    $this->data['NamaProv'] = $d['provinsi'];
                }

                $this->data['IdProvNya'] = $idprov;

                $this->load->view('adm_event_peserta_ctk', $this->data);
            }
        }
    }

    public function event_peserta_new($idev = false, $idprov = false)
    {
        if (isset($_POST['idev'])) {
            $this->load->model('Mymodel');
            $id = 'EP' . $this->Mymodel->urut('EIDPST', 9999);
            $p = [$id, $_POST['idnasional'], $_POST['ktg'], $_POST['gelar'], $_POST['akomodasi'], $_POST['idev'], $_POST['idprov'], $_POST['namapst'], $_POST['jk'], $_POST['tgllahir'], $_POST['umur'], $_POST['nik'], $_POST['telepon'], 0];
            $this->db->query(
                "INSERT INTO pesertaev (id_pst_ev,id_nasional, id_ktg_ev, id_gelar_ev,id_akomodasi_ev, id_ev, id_prov, nama_pst, jk_pst,
        				tgl_lahir, umur, nik, telepon, juara) VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
                $p,
            );
            //update jml peserta
            $this->db->query('UPDATE kategoriev SET jml_peserta=jml_peserta+1 WHERE id_ktg_ev=?', $_POST['ktg']);
            $this->hitung_iuran_ev($_POST['idev']);
            redirect('admin/event_peserta/' . $_POST['idev'] . '/' . $_POST['idprov'] . '/scr');
        }
        if ($idev === false || $idprov === false) {
        } else {
            $h = $this->db->query(
                "SELECT a.*, b.nama_admin FROM events AS a, admin AS b WHERE a.id_ev=? AND a.id_admin=b.id_admin
        				LIMIT 0,1",
                $idev,
            );
            if ($h->num_rows() == 0) {
                $_SESSION['POPUP_MSG'] = 'Data events tidak tersedia...';
                $_SESSION['POPUP_CLR'] = 'error';
                redirect('admin/event_new');
            } else {
                $this->data['DtEvent'] = $h->row_array();
                $e = 0;
                $psn = '';
                $h = $this->db->query('SELECT * FROM kategoriev WHERE id_ev=? ORDER BY kategori ASC', $idev);
                if ($h->num_rows() == 0) {
                    $e = 1;
                    $psn .= '<li>Kategori masih kosong.</li>';
                }
                $this->data['DtKtg'] = $h->result();
                $h = $this->db->query('SELECT * FROM akomodasiev ORDER BY id_akomodasi_ev ASC');
                $this->data['DtAkomodasi'] = $h->result();
                $h = $this->db->query('SELECT * FROM gelarev WHERE id_ev=? ORDER BY gelar ASC', $idev);
                $this->data['DtGelar'] = $h->result();
                if ($h->num_rows() == 0) {
                    $e = 1;
                    $psn .= '<li>Gelar masih kosong.</li>';
                }
                if ($e == 1) {
                    $_SESSION['POPUP_MSG'] = '<ol>' . $psn . '<ol>';
                    $_SESSION['POPUP_CLR'] = 'error';
                    redirect('admin/event_detail/' . $this->data['DtEvent']['id_ev']);
                } else {
                    $h = $this->db->query('SELECT * FROM provinsi WHERE id_prov=? LIMIT 0,1', $idprov);
                    $this->data['DtProv'] = $h->row_array();

                    $this->data['MnuAktif'] = 'Event';
                    $this->data['SubMnuAktif'] = 'Event' . $this->data['DtEvent']['status_ev'];
                    $this->load->view('adm_event_peserta_new', $this->data);
                }
            }
        }
    }

    public function event_peserta_edit($idpst = false)
    {
        if (isset($_POST['idpst'])) {
            $p = [$_POST['idnasional'], $_POST['ktg'], $_POST['gelar'], $_POST['akomodasi'], $_POST['namapst'], $_POST['jk'], $_POST['tgllahir'], $_POST['umur'], $_POST['nik'], $_POST['telepon'], $_POST['idpst']];
            $this->db->query(
                "UPDATE pesertaev SET id_nasional=?, id_ktg_ev=?, id_gelar_ev=?,id_akomodasi_ev=?, nama_pst=?, jk_pst=?,
        				tgl_lahir=?, umur=?, nik=?, telepon=? WHERE id_pst_ev=?",
                $p,
            );
            //update jml peserta
            if ($_POST['oldktg'] != $_POST['ktg']) {
                $this->db->query('UPDATE kategoriev SET jml_peserta=jml_peserta+1 WHERE id_ktg_ev=?', $_POST['ktg']);
                $this->db->query('UPDATE kategoriev SET jml_peserta=jml_peserta-1 WHERE id_ktg_ev=?', $_POST['oldktg']);
            }
            $this->hitung_iuran_ev($_POST['idev']);
            redirect('admin/event_peserta/' . $_POST['idev'] . '/' . $_POST['idprov'] . '/scr');
        }
        if ($idpst === false) {
        } else {
            $h = $this->db->query(
                "SELECT a.*, b.provinsi FROM pesertaev AS a, provinsi AS b WHERE a.id_pst_ev=? 
        				AND a.id_prov=b.id_prov LIMIT 0,1",
                $idpst,
            );
            if ($h->num_rows() == 0) {
                $_SESSION['POPUP_MSG'] = 'Data peserta tidak tersedia...';
                $_SESSION['POPUP_CLR'] = 'error';
                redirect('admin/event/0');
            } else {
                $this->data['DtPst'] = $h->row_array();
                $h = $this->db->query(
                    "SELECT a.*, b.nama_admin FROM events AS a, admin AS b WHERE a.id_ev=? AND
        					a.id_admin=b.id_admin LIMIT 0,1",
                    $this->data['DtPst']['id_ev'],
                );

                $this->data['DtEvent'] = $h->row_array();
                $h = $this->db->query('SELECT * FROM kategoriev WHERE id_ev=? ORDER BY kategori ASC', $this->data['DtEvent']['id_ev']);
                $this->data['DtKtg'] = $h->result();
                $h = $this->db->query('SELECT * FROM gelarev WHERE id_ev=? ORDER BY gelar ASC', $this->data['DtEvent']['id_ev']);
                $this->data['DtGelar'] = $h->result();
                $h = $this->db->query('SELECT * FROM akomodasiev ORDER BY id_akomodasi_ev ASC');
                $this->data['DtAkomodasi'] = $h->result();

                $this->data['MnuAktif'] = 'Event';
                $this->data['SubMnuAktif'] = 'Event' . $this->data['DtEvent']['status_ev'];
                $this->load->view('adm_event_peserta_edit', $this->data);
            }
        }
    }

    public function event_peserta_del($idpst = false)
    {
        if ($idpst === false) {
        } else {
            $h = $this->db->query('SELECT * FROM pesertaev WHERE id_pst_ev=? LIMIT 0,1', $idpst);
            if ($h->num_rows() == 0) {
                $_SESSION['POPUP_MSG'] = 'Data peserta tidak tersedia...';
                $_SESSION['POPUP_CLR'] = 'error';
                redirect('admin/event/0');
            } else {
                $dt = $h->row_array();
                $this->db->query('DELETE FROM pesertaev WHERE id_pst_ev=?', $idpst);
                $this->db->query('UPDATE kategoriev SET jml_peserta=jml_peserta-1 WHERE id_ktg_ev=?', $dt['id_ktg_ev']);
                $this->hitung_iuran_ev($dt['id_ev']);
                redirect('admin/event_peserta/' . $dt['id_ev'] . '/' . $dt['id_prov'] . '/scr');
            }
        }
    }

    public function event_peserta_upload_stf()
    {
        if (isset($_POST['idpst'])) {
            $fn = $_FILES['sertifikat']['tmp_name'];
            $fz = $_FILES['sertifikat']['size'];
            if ($fz > 0) {
                $ft = './pdf/sertifikat/' . $_POST['idpst'] . '.pdf';
                move_uploaded_file($fn, $ft);
                $_SESSION['POPUP_MSG'] = 'Data tersimpan...';
                $_SESSION['POPUP_CLR'] = 'info';
            }
            redirect('admin/event_peserta/' . $_POST['ideve'] . '/' . $_POST['idprov']);
        }
    }

    public function event_peserta_sertifikat_del($idpst = alse, $idev = false)
    {
        if ($idpst === false || $idev === false) {
        } else {
            $f = './pdf/sertifikat/' . $idpst . '.pdf';
            if (file_exists($f)) {
                unlink($f);
                $_SESSION['POPUP_MSG'] = 'Sertifikat dihapus...';
                $_SESSION['POPUP_CLR'] = 'info';
            }
            redirect('admin/event_peserta/' . $idev);
        }
    }

    public function event_winner($idev = false, $tg = 'scr')
    {
        if ($idev === false) {
        } else {
            $h = $this->db->query(
                "SELECT a.*, b.nama_admin FROM events AS a, admin AS b WHERE a.id_ev=? AND a.id_admin=b.id_admin
        				LIMIT 0,1",
                $idev,
            );
            if ($h->num_rows() == 0) {
                $_SESSION['POPUP_MSG'] = 'Data events tidak tersedia...';
                $_SESSION['POPUP_CLR'] = 'error';
                redirect('admin/event/2');
            } else {
                $this->data['DtEvent'] = $h->row_array();
                $stev = $this->data['DtEvent']['status_ev'];

                $h = $this->db->query(
                    "SELECT a.*, b.nama_pst, b.id_prov, c.provinsi FROM juaraev AS a,
        					pesertaev AS b, provinsi AS c WHERE a.id_ev=? AND a.id_pst_ev=b.id_pst_ev AND 
        					b.id_prov=c.id_prov ORDER BY a.peringkat ASC",
                    $idev,
                );
                $this->data['DtWinner'] = $h->result();
                $this->data['JmlWinner'] = $h->num_rows();
                $this->data['MnuAktif'] = 'Event';
                $this->data['SubMnuAktif'] = 'Event' . $stev;
                if ($tg == 'scr') {
                    $this->load->view('adm_event_winner', $this->data);
                } else {
                    $this->load->view('adm_event_winner_ctk', $this->data);
                }
            }
        }
    }

    public function event_winner_set($idpst = false, $idev = false)
    {
        if (isset($_POST['idpst'])) {
            $this->load->model('Mymodel');
            $idj = $this->Mymodel->urut('IDJUARA', 9999);
            $p = [$idj, $_POST['ideve'], $_POST['idpst'], $_POST['peringkat'], $_POST['keterangan']];
            $this->db->query(
                "INSERT INTO juaraev (idjuara, id_ev, id_pst_ev, peringkat, keterangan)
        				VALUES (?, ?, ?, ?, ?)",
                $p,
            );
            $this->db->query('UPDATE pesertaev SET juara=1 WHERE id_pst_ev=?', $_POST['idpst']);
            $_SESSION['POPUP_MSG'] = 'Data disimpan...';
            $_SESSION['POPUP_CLR'] = 'info';
            redirect('admin/event_peserta/' . $_POST['ideve']);
        }
        if ($idpst === false || $idev === false) {
            $_SESSION['POPUP_MSG'] = 'Invalid parameter...';
            $_SESSION['POPUP_CLR'] = 'error';
            redirect('admin/event/2');
        } else {
            $h = $this->db->query('SELECT * FROM pesertaev WHERE id_pst_ev=? LIMIT 0,1', $idpst);
            if ($h->num_rows() == 0) {
                $_SESSION['POPUP_MSG'] = 'Data tidak ditemukan...';
                $_SESSION['POPUP_CLR'] = 'error';
                redirect('admin/event/2');
            } else {
                $dtpst = $h->row_array();
                $cek = $this->db->query('SELECT * FROM juaraev WHERE id_pst_ev=? LIMIT 0,1', $idpst);
                if ($cek->num_rows() > 0) {
                    $_SESSION['POPUP_MSG'] = 'Peserta ini sudah jadi pemenang...';
                    $_SESSION['POPUP_CLR'] = 'info';
                    redirect('admin/event_peserta/' . $idev);
                } else {
                    $this->data['DtPst'] = $dtpst;
                    $h = $this->db->query(
                        "SELECT a.*, b.nama_admin FROM events AS a, admin AS b WHERE a.id_ev=? AND a.id_admin=b.id_admin
        					LIMIT 0,1",
                        $idev,
                    );
                    $this->data['DtEvent'] = $h->row_array();
                    $stev = $this->data['DtEvent']['status_ev'];
                    $this->data['MnuAktif'] = 'Event';
                    $this->data['SubMnuAktif'] = 'Event' . $stev;
                    $this->load->view('adm_event_winner_set', $this->data);
                }
            }
        }
    }

    public function event_winner_del($idjuara = false, $idev = false)
    {
        if ($idjuara === false || $idev === false) {
        } else {
            $cek = $this->db->query('SELECT * FROM juaraev WHERE idjuara=?', $idjuara);
            if ($cek->num_rows() == 0) {
                $_SESSION['POPUP_MSG'] = 'Data tidak ditemukan...';
                $_SESSION['POPUP_CLR'] = 'error';
            } else {
                $dtjuara = $cek->row_array();
                $this->db->query('DELETE FROM juaraev WHERE idjuara=?', $idjuara);
                $this->db->query('UPDATE pesertaev SET juara=0 WHERE id_pst_ev=?', $dtjuara['id_pst_ev']);
                $_SESSION['POPUP_MSG'] = 'Data dihapus...';
                $_SESSION['POPUP_CLR'] = 'info';
            }
            redirect('admin/event_winner/' . $idev);
        }
    }

    public function event_winner_upload()
    {
        if (isset($_POST['idj'])) {
            $fn = $_FILES['piagam']['tmp_name'];
            $fz = $_FILES['piagam']['size'];
            if ($fz > 0) {
                $ft = './pdf/piagam/' . $_POST['idj'] . '.pdf';
                move_uploaded_file($fn, $ft);
                $_SESSION['POPUP_MSG'] = 'Data tersimpan...';
                $_SESSION['POPUP_CLR'] = 'info';
            }
            redirect('admin/event_winner/' . $_POST['ideve']);
        }
    }

    public function event_winner_piagam_del($idjuara = false, $idev = false)
    {
        if ($idjuara === false || $idev === false) {
        } else {
            $f = './pdf/piagam/' . $idjuara . '.pdf';
            if (file_exists($f)) {
                unlink($f);
                $_SESSION['POPUP_MSG'] = 'Piagam dihapus...';
                $_SESSION['POPUP_CLR'] = 'info';
            }
            redirect('admin/event_winner/' . $idev);
        }
    }

    //HITUNG JML iuran

    public function event_iuran_upd($idev = false)
    {
        if ($idev === false) {
        } else {
            $h = $this->db->query('SELECT * FROM events WHERE id_ev=? LIMIT 0,1', $idev);
            if ($h->num_rows() == 0) {
                $_SESSION['POPUP_MSG'] = 'Data events tidak tersedia...';
                $_SESSION['POPUP_CLR'] = 'error';
                redirect('admin/event/0');
            }
            $x = $this->hitung_iuran_ev($idev);
        }
        $_SESSION['POPUP_MSG'] = 'Data iuran sudah dihitung ulang...';
        $_SESSION['POPUP_CLR'] = 'info';
        redirect('admin/event_iuran/' . $idev . '/scr');
    }

    public function hitung_iuran_ev($idev = false)
    {
        if ($idev === false) {
        } else {
            $h = $this->db->query('SELECT * FROM events WHERE id_ev=? LIMIT 0,1', $idev);
            if ($h->num_rows() == 0) {
                $_SESSION['POPUP_MSG'] = 'Data events tidak tersedia...';
                $_SESSION['POPUP_CLR'] = 'error';
                redirect('admin/event/0');
            }
            $dtevent = $h->row_array();
            $this->load->model('Mymodel');
            //kategori
            $h = $this->db->query('SELECT * FROM kategoriev WHERE id_ev=?', $idev);
            $jmlktg = $h->num_rows();
            if ($jmlktg > 0) {
                //peserta per ktg
                $dtktg = $h->result();
                foreach ($dtktg as $dk) {
                    $p = [$dk->id_ktg_ev, $idev];
                    $cek = $this->db->query('SELECT COUNT(id_pst_ev) as jml FROM pesertaev WHERE id_ktg_ev=? AND id_ev=?', $p);
                    $dcek = $cek->row_array();
                    if ($dcek['jml'] == null) {
                        $dcek['jml'] = 0;
                    }
                    $p = [$dcek['jml'], $dk->id_ktg_ev];
                    $this->db->query('UPDATE kategoriev SET jml_peserta=? WHERE id_ktg_ev=?', $p);
                }
                unset($dtktg);
            }

            $h = $this->db->query('SELECT * FROM provinsi WHERE id_prov>0 ORDER BY id_prov ASC');
            if ($h->num_rows() > 0) {
                $dtprov = $h->result();
                foreach ($dtprov as $dt) {
                    //jumlah bayar iuran per provinsi
                    $p = [$idev, $dt->id_prov];
                    $cek = $this->db->query(
                        "SELECT SUM(jml_bayar) AS jml FROM iuranev_byr WHERE id_ev=? AND id_prov=? AND 
        					jenis_byr=1 AND status_verifikasi=1",
                        $p,
                    );
                    $dcek = $cek->row_array();
                    if ($dcek['jml'] == null) {
                        $dcek['jml'] = 0;
                    }
                    $cek2 = $this->db->query('SELECT * FROM iuranev WHERE id_ev=? AND id_prov=? LIMIT 0,1', $p);
                    if ($cek2->num_rows() == 0) {
                        $idiuran = 'EI' . $this->Mymodel->urut('EIDIURAN', 9999);
                        $p = [$idiuran, $idev, $dt->id_prov, $dtevent['iuran_wjb'], $dcek['jml'], 0, 0];
                        $this->db->query(
                            "INSERT INTO iuranev (id_iuran_ev, id_ev, id_prov, jml_wajib, byr_wajib, 
        							jml_registrasi, byr_registrasi) VALUES (?, ?, ?, ?, ?, ?, ?)",
                            $p,
                        );
                    } else {
                        $dcek2 = $cek2->row_array();
                        $p = [$dtevent['iuran_wjb'], $dcek['jml'], $dcek2['id_iuran_ev']];
                        $this->db->query('UPDATE iuranev SET jml_wajib=?, byr_wajib=? WHERE id_iuran_ev=?', $p);
                    }

                    //jumlah iuran registrasi per provinsi
                    $p = [$idev, $dt->id_prov];
                    $cek = $this->db->query(
                        "SELECT a.id_pst_ev, a.id_ktg_ev, a.id_gelar_ev, a.id_ev, a.id_prov, b.biaya_reg FROM 
        						pesertaev AS a, gelarev AS b WHERE a.id_ev=? AND a.id_prov=? AND a.id_gelar_ev=b.id_gelar_ev",
                        $p,
                    );
                    if ($cek->num_rows() > 0) {
                        $dcek = $cek->result();
                        $jml = 0;
                        foreach ($dcek as $dt) {
                            $jml += $dt->biaya_reg;
                        }
                        $cek2 = $this->db->query('SELECT * FROM iuranev WHERE id_ev=? AND id_prov=? LIMIT 0,1', $p);
                        if ($cek2->num_rows() == 0) {
                            $idiuran = 'EI' . $this->Mymodel->urut('EIDIURAN', 9999);
                            $p = [$idiuran, $idev, $dt->id_prov, $dtevent['iuran_wjb'], 0, $jml, 0];
                            $this->db->query(
                                "INSERT INTO iuranev (id_iuran_ev, id_ev, id_prov, jml_wajib, byr_wajib, 
        								jml_registrasi, byr_registrasi) VALUES (?, ?, ?, ?, ?, ?, ?)",
                                $p,
                            );
                        } else {
                            $dcek2 = $cek2->row_array();
                            $p = [$dtevent['iuran_wjb'], $jml, $dcek2['id_iuran_ev']];
                            $this->db->query('UPDATE iuranev SET  jml_wajib=?, jml_registrasi=? WHERE id_iuran_ev=?', $p);
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
                    $p = [$idev, $dt->id_prov];
                    $cek = $this->db->query(
                        "SELECT SUM(jml_bayar) AS jml FROM iuranev_byr WHERE id_ev=? AND id_prov=? AND 
        					jenis_byr=2 AND status_verifikasi=1",
                        $p,
                    );
                    $dcek = $cek->row_array();
                    if ($dcek['jml'] == null) {
                        $dcek['jml'] = 0;
                    }
                    $cek2 = $this->db->query('SELECT * FROM iuranev WHERE id_ev=? AND id_prov=? LIMIT 0,1', $p);
                    if ($cek2->num_rows() == 0) {
                        $idiuran = 'EI' . $this->Mymodel->urut('EIDIURAN', 9999);
                        $p = [$idiuran, $idev, $dt->id_prov, $dtevent['iuran_wjb'], 0, 0, $dcek['jml'], 0, 0];
                        $this->db->query(
                            "INSERT INTO iuranev (id_iuran_ev, id_ev, id_prov, jml_wajib, byr_wajib, 
        							jml_registrasi, byr_registrasi,jml_akomodasi,byr_akomodasi) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)",
                            $p,
                        );
                    } else {
                        $dcek2 = $cek2->row_array();
                        $p = [$dtevent['iuran_wjb'], $dcek['jml'], $dcek2['id_iuran_ev']];
                        $this->db->query('UPDATE iuranev SET jml_wajib=?, byr_registrasi=? WHERE id_iuran_ev=?', $p);
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

    //Event TimeLine
    public function event_time($idev = false, $tg = 'scr')
    {
        if ($idev === false) {
        } else {
            $h = $this->db->query(
                "SELECT a.*, b.nama_admin FROM events AS a, admin AS b WHERE a.id_ev=? AND a.id_admin=b.id_admin
        				LIMIT 0,1",
                $idev,
            );
            if ($h->num_rows() == 0) {
                $_SESSION['POPUP_MSG'] = 'Data events tidak tersedia...';
                $_SESSION['POPUP_CLR'] = 'error';
                redirect('admin/event_new');
            } else {
                $this->data['DtEvent'] = $h->row_array();
                $stev = $this->data['DtEvent']['status_ev'];
                $h = $this->db->query('SELECT a.*, b.nama_admin FROM timelineev AS a, admin AS b WHERE a.id_ev=? AND a.id_admin=b.id_admin ORDER BY a.tanggal ASC', $idev);
                $this->data['DtTime'] = $h->result();
                $this->data['JmlTime'] = $h->num_rows();

                $this->data['MnuAktif'] = 'Event';
                $this->data['SubMnuAktif'] = 'Event' . $stev;
                $this->data['TimeLine'] = 1;
                if ($tg == 'scr') {
                    $this->load->view('adm_event_time_' . $stev, $this->data);
                } else {
                    $this->load->view('adm_event_time_ctk', $this->data);
                }
            }
        }
    }

    public function event_time_new($idev = false)
    {
        if (isset($_POST['kegiatan'])) {
            $this->load->model('Mymodel');
            $id = 'IT' . $this->Mymodel->urut('EIDTIME', 999999);
            $p = [$id, $_POST['idev'], $_POST['tgl'], $_POST['kegiatan'], $_POST['publik'], addslashes($_POST['catatan']), $_SESSION['ID_ADMIN']];
            $this->db->query('INSERT INTO timelineev (id_timeline, id_ev, tanggal, kegiatan, publik, catatan, id_admin) VALUES (?, ?, ?, ?, ?, ?, ?)', $p);
            redirect('admin/event_time/' . $_POST['idev']);
        }
        if ($idev === false) {
        } else {
            $h = $this->db->query('SELECT a.*, b.nama_admin FROM events AS a, admin AS b WHERE a.id_ev=? AND a.id_admin=b.id_admin LIMIT 0,1', $idev);
            $j = $h->num_rows();
            if ($j == 0) {
                $_SESSION['POPUP_MSG'] = 'Data event tidak ada...';
                $_SESSION['POPUP_CLR'] = 'info';
                redirect('admin/event/0');
            } else {
                $this->data['DtEvent'] = $h->row_array();
                $stev = $this->data['DtEvent']['status_ev'];
                $this->data['MnuAktif'] = 'Event';
                $this->data['SubMnuAktif'] = 'Event' . $stev;
                $this->data['Status_Ev'] = $stev;
                $this->load->view('adm_event_time_new', $this->data);
            }
        }
    }

    public function event_time_edit($idt = false)
    {
        if (isset($_POST['kegiatan'])) {
            $p = [$_POST['tgl'], $_POST['kegiatan'], $_POST['publik'], addslashes($_POST['catatan']), $_SESSION['ID_ADMIN'], $_POST['idtime']];
            $this->db->query(
                "UPDATE timelineev SET tanggal=?, kegiatan=?, publik=?, catatan=?, id_admin=? 
        				WHERE id_timeline=?",
                $p,
            );
            redirect('admin/event_time/' . $_POST['idev']);
        }

        if ($idt === false) {
        } else {
            $h = $this->db->query('SELECT * FROM timelineev WHERE id_timeline=? LIMIT 0,1', $idt);
            $j = $h->num_rows();
            if ($j == 0) {
                $_SESSION['POPUP_MSG'] = 'Data Timeline tidak ada...';
                $_SESSION['POPUP_CLR'] = 'info';
                redirect('admin/event/0');
            } else {
                $this->data['DtTime'] = $h->row_array();
                $h = $this->db->query(
                    "SELECT a.*, b.nama_admin FROM events AS a, admin AS b WHERE a.id_ev=? 
        					AND a.id_admin=b.id_admin LIMIT 0,1",
                    $this->data['DtTime']['id_ev'],
                );
                $this->data['DtEvent'] = $h->row_array();
                $stev = $this->data['DtEvent']['status_ev'];
                $this->data['MnuAktif'] = 'Event';
                $this->data['SubMnuAktif'] = 'Event' . $stev;
                $this->load->view('adm_event_time_edit', $this->data);
            }
        }
    }

    public function event_time_del($idt = false)
    {
        if ($idt === false) {
        } else {
            $h = $this->db->query('SELECT * FROM timelineev WHERE id_timeline=? LIMIT 0,1', $idt);
            $j = $h->num_rows();
            if ($j == 0) {
                $_SESSION['POPUP_MSG'] = 'Data Timeline tidak ada...';
                $_SESSION['POPUP_CLR'] = 'info';
                redirect('admin/event/0');
            } else {
                $dttime = $h->row_array();
                $h = $this->db->query('SELECT * FROM events WHERE id_ev=? LIMIT 0,1', $dttime['id_ev']);
                $dtev = $h->row_array();
                $this->db->query('DELETE FROM timelineev WHERE id_timeline=?', $idt);
                redirect('admin/event_time/' . $dtev['id_ev']);
            }
        }
    }

    // Iuran
    public function event_iuran($idev = false, $tg = 'scr')
    {
        if ($idev === false) {
        } else {
            $h = $this->db->query(
                "SELECT a.*, b.nama_admin FROM events AS a, admin AS b WHERE a.id_ev=? 
        				AND a.id_admin=b.id_admin LIMIT 0,1",
                $idev,
            );
            $j = $h->num_rows();
            if ($j == 0) {
                $_SESSION['POPUP_MSG'] = 'Data event tidak ada...';
                $_SESSION['POPUP_CLR'] = 'info';
                redirect('admin/event/0');
            } else {
                $this->data['DtEvent'] = $h->row_array();
                $stev = $this->data['DtEvent']['status_ev'];
                $h = $this->db->query(
                    "SELECT a.*, b.provinsi FROM iuranev AS a, provinsi AS b WHERE a.id_ev=? 
        						AND a.id_prov=b.id_prov ORDER BY b.provinsi ASC",
                    $idev,
                );
                $j = $h->num_rows();
                $this->data['DtIuran'] = $h->result();
                $this->data['JmlIuran'] = $j;
                $h = $this->db->query(
                    "SELECT a.*, b.nama_admin FROM penerimaanev AS a, admin AS b WHERE a.id_ev=? 
        						AND a.id_admin=b.id_admin ORDER BY a.tgl_terima ASC",
                    $idev,
                );
                $j = $h->num_rows();
                $this->data['DtTerima'] = $h->result();
                $this->data['JmlTerima'] = $j;

                $cek = $this->db->query('SELECT * FROM provinsi ORDER BY provinsi');
                $this->data['DtProv'] = $cek->result();

                $this->data['MnuAktif'] = 'Event';
                $this->data['SubMnuAktif'] = 'Event' . $stev;
                if ($tg == 'scr') {
                    $this->load->view('adm_event_iuran_' . $stev, $this->data);
                } else {
                    $this->load->view('adm_event_iuran_ctk', $this->data);
                }
            }
        }
    }

    //IURAN DETAIL
    public function event_iuran_detail($idiuran = false, $tg = 'scr')
    {
        if ($idiuran === false) {
        } else {
            $hi = $this->db->query(
                "SELECT a.*, b.provinsi FROM iuranev AS a, provinsi AS b WHERE a.id_iuran_ev=? AND
        				a.id_prov=b.id_prov LIMIT 0,1",
                $idiuran,
            );
            $j = $hi->num_rows();
            if ($j == 0) {
                $_SESSION['POPUP_MSG'] = 'Data iuran tidak ada...';
                $_SESSION['POPUP_CLR'] = 'info';
                redirect('admin/event/0');
            }
            $this->data['DtIuran'] = $hi->row_array();
            $this->data['JmlIuran'] = $j;
            $h = $this->db->query(
                "SELECT a.*, b.nama_admin FROM events AS a, admin AS b WHERE a.id_ev=? AND 
        				a.id_admin=b.id_admin LIMIT 0,1",
                $this->data['DtIuran']['id_ev'],
            );
            $this->data['DtEvent'] = $h->row_array();
            $stev = $this->data['DtEvent']['status_ev'];

            $h = $this->db->query(
                "SELECT a.*, b.nama_operator, c.nama_admin 
         FROM iuranev_byr AS a
         JOIN operator AS b ON a.id_operator = b.id_operator
         LEFT JOIN admin AS c ON a.id_admin = c.id_admin
         WHERE a.id_iuran_ev = ? AND a.jenis_byr = 1
         ORDER BY a.jenis_byr ASC, a.id_byr ASC",
                [$idiuran]
            );
            $this->data['DtWajibByr'] = $h->result();
            $this->data['JmlWajibByr'] = $h->num_rows();
            $h = $this->db->query(
                "SELECT a.*, b.nama_operator, c.nama_admin FROM iuranev_byr AS a, operator AS b,
        				admin AS c WHERE a.id_iuran_ev=? AND jenis_byr=2 AND a.id_operator=b.id_operator AND a.id_admin=c.id_admin 
        				ORDER BY a.jenis_byr ASC, a.id_byr ASC",
                $idiuran,
            );
            $this->data['DtRegistrasiByr'] = $h->result();
            $this->data['JmlRegistrasiByr'] = $h->num_rows();

            $h = $this->db->query(
                "SELECT a.*, b.nama_operator, c.nama_admin FROM iuranev_byr AS a, operator AS b,
        				admin AS c WHERE a.id_iuran_ev=? AND jenis_byr=3 AND a.id_operator=b.id_operator AND a.id_admin=c.id_admin 
        				ORDER BY a.jenis_byr ASC, a.id_byr ASC",
                $idiuran,
            );
            $this->data['DtAkomodasiByr'] = $h->result();
            $this->data['JmlAkomodasiByr'] = $h->num_rows();

            $this->data['MnuAktif'] = 'Event';
            $this->data['SubMnuAktif'] = 'Event' . $stev;
            if ($tg == 'scr') {
                $this->load->view('adm_event_iuran_detail', $this->data);
            } else {
                $this->load->view('adm_event_iuran_detail_ctk', $this->data);
            }
        }
    }

    public function event_iuran_detail_tagihan($idiuran = false, $tg = 'scr') 
    {
        $data = $this->db->query("SELECT * FROM iuranev WHERE id_iuran_ev=?",$idiuran)->row_array();
        $idev = $data['id_ev'];
        $idprov = $data['id_prov'];
        if ($idev===false) { } else
		{
			$h=$this->db->query("SELECT a.*,b.nama_admin FROM events a,admin b WHERE a.id_ev=? AND a.id_admin=b.id_admin LIMIT 0,1", $idev);
			if ($h->num_rows()==0)
			{
				$_SESSION['POPUP_MSG']='Data events tidak tersedia...';
				$_SESSION['POPUP_CLR']='error';
				redirect('opr/event/0');
			}
			else
			{
				$this->data['DtEvent']=$h->row_array();
				$stev=$this->data['DtEvent']['status_ev'];
				$h=$this->db->query("SELECT a.*, d.kategori, b.gelar, b.biaya_reg,c.biaya FROM pesertaev AS a, 
							 gelarev AS b,  kategoriev AS d,akomodasiev c WHERE a.id_ev=? AND a.id_prov=? AND
							a.id_gelar_ev=b.id_gelar_ev AND a.id_ktg_ev=d.id_ktg_ev AND a.id_akomodasi_ev=c.id_akomodasi_ev
							ORDER BY a.nama_pst ASC", 
							array($idev, $idprov));
				
				$this->data['JmlPst']=$h->num_rows();
				$this->data['DtPst']=$h->result();
				$this->data['DtProvinsi'] = $this->db->query("SELECT * FROM provinsi WHERE id_prov=?",$idprov)->row_array();
				
				$this->data['MnuAktif']='Event';
				$this->data['SubMnuAktif']='Event'.$stev;
				//echo json_encode($hasil); die();
				if ($tg=='scr')
				{
					$this->load->view('admin_event_iuran_detail_tagihan', $this->data);
				}
				else
				{
					$this->load->view('admin_event_iuran_detail_tagihan_ctk', $this->data);
				}
			}
		}
    }

    //IURAN BAYAR
    public function event_iuran_byr_detail($idbyr = false, $tg = 'scr')
    {
        if ($idbyr === false) {
        } else {
            $h = $this->db->query(
                "SELECT a.*, b.provinsi, c.nama_admin, d.nama_operator FROM iuranev_byr AS a, provinsi AS b, 
        			admin AS c, operator AS d WHERE a.id_byr=? AND a.id_prov=b.id_prov AND a.id_admin=c.id_admin AND 
        			a.id_operator=d.id_operator LIMIT 0,1",
                $idbyr,
            );
            if ($h->num_rows() == 0) {
                $_SESSION['POPUP_MSG'] = 'Data iuran  tidak ada...';
                $_SESSION['POPUP_CLR'] = 'info';
                redirect('admin/event/0');
            }
            $this->data['DtBayar'] = $h->row_array();
            $h = $this->db->query(
                "SELECT a.*, b.nama_admin FROM events AS a, admin AS b WHERE a.id_ev=? 
        				AND a.id_admin=b.id_admin LIMIT 0,1",
                $this->data['DtBayar']['id_ev'],
            );
            $this->data['DtEvent'] = $h->row_array();
            $stev = $this->data['DtEvent']['status_ev'];
            $this->data['MnuAktif'] = 'Event';
            $this->data['SubMnuAktif'] = 'Event' . $stev;
            if ($tg == 'scr') {
                $this->load->view('adm_event_iuran_byr_detail', $this->data);
            } else {
                $this->load->view('adm_event_iuran_byr_detail_ctk', $this->data);
            }
        }
    }

    public function event_iuran_byr_new($idiuran = false)
    {
        if (isset($_POST['jenisbyr'])) {
            $fn = $_FILES['bukti']['tmp_name'];
            $fz = $_FILES['bukti']['size'];
            $fext = pathinfo($_FILES['bukti']['name'], PATHINFO_EXTENSION);
            $hiuranev = $this->db->query('SELECT * FROM iuranev WHERE id_iuran_ev=? LIMIT 0, 1', $_POST['idiuran']);
            $dtiuran = $hiuranev->row_array();
            $this->load->model('Mymodel');
            $idbyr = 'BE' . $this->Mymodel->urut('EIDBYREV', 9999);
            $p = [$idbyr, $_POST['idev'], $dtiuran['id_iuran_ev'], $dtiuran['id_prov'], 1, 1, $_POST['tglbayar'], $_POST['jmlbayar'], $_POST['jenisbyr'], $_POST['carabyr'], $_POST['namapembayar'], '', $_POST['daribank'], $_POST['darirek'], $_POST['namapenerima'], $_POST['catatan'], $_POST['kebank'], $_POST['kerek'], $idbyr . '.' . $fext, '', 0];
            $h = $this->db->query(
                "INSERT INTO iuranev_byr (id_byr, id_ev, id_iuran_ev, id_prov, id_operator, id_admin, tgl_bayar,
        				jml_bayar, jenis_byr, cara_byr, nama_pembayar, note_pembayar, dari_bank, dari_rek, nama_penerima, note_penerima,
        				ke_bank, ke_rek,bukti, tgl_verifikasi, status_verifikasi) VALUES (?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
                $p,
            );

            if ($fz > 0) {
                move_uploaded_file($fn, 'img/bayar/' . $idbyr . '.' . $fext);
            }
            $this->hitung_iuran_ev($_POST['idev']);
            redirect('admin/event_iuran_detail/' . $_POST['idiuran']);
        }

        if ($idiuran === false) {
        } else {
            $hi = $this->db->query(
                "SELECT a.*, b.provinsi FROM iuranev AS a, provinsi AS b WHERE a.id_iuran_ev=? AND
        				a.id_prov=b.id_prov LIMIT 0,1",
                $idiuran,
            );
            if ($hi->num_rows() == 0) {
                $_SESSION['POPUP_MSG'] = 'Data iuran  tidak ada...';
                $_SESSION['POPUP_CLR'] = 'info';
                redirect('admin/event/0');
            }

            $this->data['DtIuran'] = $hi->row_array();
            unset($hi);
            $h = $this->db->query(
                "SELECT a.*, b.nama_admin FROM events AS a, admin AS b WHERE a.id_ev=? AND 
        				a.id_admin=b.id_admin LIMIT 0,1",
                $this->data['DtIuran']['id_ev'],
            );
            $this->data['DtEvent'] = $h->row_array();
            $stev = $this->data['DtEvent']['status_ev'];
            unset($h);
            $this->data['MnuAktif'] = 'Event';
            $this->data['SubMnuAktif'] = 'Event' . $stev;
            $this->load->view('adm_event_iuran_byr_new', $this->data);
        }
    }

    public function event_iuran_byr_edit($idiuran = false)
    {
        if (isset($_POST['idbyr'])) {
            //**************** DINISI
            $fn = $_FILES['bukti']['tmp_name'];
            $fz = $_FILES['bukti']['size'];
            $fext = pathinfo($_FILES['bukti']['name'], PATHINFO_EXTENSION);


            if ($fz > 0) {
                $p = [$_POST['tglbayar'], $_POST['jmlbayar'], $_POST['jenisbyr'], $_POST['carabyr'], $_POST['namapembayar'], $_POST['catatan'], $_POST['daribank'], $_POST['darirek'], $_POST['idbyr'] . '.' . $fext, $_POST['idbyr']];
                $this->db->query(
                    "UPDATE iuranev_byr SET tgl_bayar=?, jml_bayar=?, jenis_byr=?, cara_byr=?, 
        				nama_pembayar=?, note_pembayar=?, dari_bank=?, dari_rek=?,bukti=?  WHERE id_byr=?",
                    $p,
                );
                move_uploaded_file($fn, 'img/bayar/' . $_POST['idbyr'] . '.' . $fext);
            } else {
                $p = [$_POST['tglbayar'], $_POST['jmlbayar'], $_POST['jenisbyr'], $_POST['carabyr'], $_POST['namapembayar'], $_POST['catatan'], $_POST['daribank'], $_POST['darirek'], $_POST['idbyr']];
                $this->db->query(
                    "UPDATE iuranev_byr SET tgl_bayar=?, jml_bayar=?, jenis_byr=?, cara_byr=?, 
        				nama_pembayar=?, note_pembayar=?, dari_bank=?, dari_rek=?  WHERE id_byr=?",
                    $p,
                );
            }
            $this->hitung_iuran_ev($_POST['idev']);
            redirect('admin/event_iuran_detail/' . $_POST['idiuran']);
        }

        if ($idiuran === false) {
        } else {
            $h = $this->db->query(
                "SELECT a.*, b.provinsi FROM iuranev_byr AS a, provinsi AS b WHERE a.id_byr=? AND
        				a.id_prov=b.id_prov LIMIT 0,1",
                $idiuran,
            );
            if ($h->num_rows() == 0) {
                $_SESSION['POPUP_MSG'] = 'Data iuran  tidak ada...';
                $_SESSION['POPUP_CLR'] = 'info';
                redirect('admin/event/0');
            }
            $this->data['DtIuran'] = $h->row_array();
            $h = $this->db->query(
                "SELECT a.*, b.nama_admin FROM events AS a, admin AS b WHERE a.id_ev=? AND 
        				a.id_admin=b.id_admin LIMIT 0,1",
                $this->data['DtIuran']['id_ev'],
            );
            $this->data['DtEvent'] = $h->row_array();
            $stev = $this->data['DtEvent']['status_ev'];

            $stev = $this->data['DtEvent']['status_ev'];
            $this->data['MnuAktif'] = 'Event';
            $this->data['SubMnuAktif'] = 'Event' . $stev;
            $this->load->view('adm_event_iuran_byr_edit', $this->data);
        }
    }

    //verfikasi pembayarn
    public function event_iuran_byr_verdo($idbyr = false)
    {
        if ($idbyr === false) {
        } else {
            $h = $this->db->query('SELECT * FROM iuranev_byr WHERE id_byr=? LIMIT 0,1', $idbyr);
            if ($h->num_rows() == 0) {
                $_SESSION['POPUP_MSG'] = 'Data iuran  tidak ada...';
                $_SESSION['POPUP_CLR'] = 'info';
                redirect('admin/event/0');
            }
            $dtbyr = $h->row_array();
            $p = [$_SESSION['ID_ADMIN'], date('Y-m-d'), $idbyr];
            $this->db->query('UPDATE iuranev_byr SET id_admin=?, status_verifikasi=1, tgl_verifikasi=? WHERE id_byr=?', $p);
            $this->hitung_iuran_ev($dtbyr['id_ev'], $dtbyr['id_prov']);

            redirect('admin/event_iuran_detail/' . $dtbyr['id_iuran_ev']);
        }
    }

    //Batalkan verfikasi
    public function event_iuran_byr_unver($idbyr = false)
    {
        if ($idbyr === false) {
        } else {
            $h = $this->db->query('SELECT * FROM iuranev_byr WHERE id_byr=? LIMIT 0,1', $idbyr);
            if ($h->num_rows() == 0) {
                $_SESSION['POPUP_MSG'] = 'Data iuran  tidak ada...';
                $_SESSION['POPUP_CLR'] = 'info';
                redirect('admin/event/0');
            }
            $dtbyr = $h->row_array();
            $this->db->query("UPDATE iuranev_byr SET id_admin=0, status_verifikasi=0, tgl_verifikasi='' WHERE id_byr=?", $idbyr);
            $this->hitung_iuran_ev($dtbyr['id_ev']);

            redirect('admin/event_iuran_detail/' . $dtbyr['id_iuran_ev']);
        }
    }

    //Hapus pembayaran
    public function event_iuran_byr_del($idbyr = false)
    {
        if (idbyr === false) {
        } else {
            $h = $this->db->query('SELECT * FROM iuranev_byr WHERE id_byr=? LIMIT 0,1', $idbyr);
            if ($h->num_rows() == 0) {
                $_SESSION['POPUP_MSG'] = 'Data iuran  tidak ada...';
                $_SESSION['POPUP_CLR'] = 'info';
                redirect('admin/event/0');
            }
            $dtbyr = $h->row_array();
            if ($dtbyr['status_verifikasi'] == 1) {
                $_SESSION['POPUP_MSG'] = 'Pembayaran sudah diverifikasi, tidak bisa dihapus...';
                $_SESSION['POPUP_CLR'] = 'info';
                redirect('admin/event_iuran_detail/' . $dtbyr['id_iuran_ev']);
            }
            $this->db->query('DELETE FROM iuranev_byr WHERE id_byr=?', $idbyr);
            $fn = './img/bayar/' . $idbyr . '.jpg';
            if (file_exists($fn)) {
                unlink($fn);
            }
            $this->hitung_iuran_ev($dtbyr['id_ev']);

            redirect('admin/event_iuran_detail/' . $dtbyr['id_iuran_ev']);
        }
    }

    //PENERIMAAN LAIN
    public function event_penlain($idev = false, $tg = 'scr')
    {
        if ($idev === false) {
        } else {
            $h = $this->db->query(
                "SELECT a.*, b.nama_admin FROM events AS a, admin AS b WHERE a.id_ev=? 
        				AND a.id_admin=b.id_admin LIMIT 0,1",
                $idev,
            );
            $j = $h->num_rows();
            if ($j == 0) {
                $_SESSION['POPUP_MSG'] = 'Data event tidak ada...';
                $_SESSION['POPUP_CLR'] = 'info';
                redirect('admin/event/0');
            } else {
                $this->data['DtEvent'] = $h->row_array();
                $stev = $this->data['DtEvent']['status_ev'];
                $h = $this->db->query(
                    "SELECT a.*, b.nama_admin FROM penerimaanev AS a, admin AS b WHERE a.id_ev=?
        					AND a.id_admin=b.id_admin ORDER BY a.id_penerimaan ASC",
                    $idev,
                );
                $this->data['DtPen'] = $h->result();
                $this->data['JmlPen'] = $h->num_rows();
                $this->data['MnuAktif'] = 'Event';
                $this->data['SubMnuAktif'] = 'Event' . $stev;
                if ($tg == 'scr') {
                    $this->load->view('adm_event_penlain_' . $stev, $this->data);
                } else {
                    $this->load->view('adm_event_penlain_ctk', $this->data);
                }
            }
        }
    }

    public function event_penlain_new($idev = false)
    {
        if (isset($_POST['idev'])) {
            $fn = $_FILES['bukti']['tmp_name'];
            $fz = $_FILES['bukti']['size'];
            $fext = pathinfo($_FILES['bukti']['name'], PATHINFO_EXTENSION);
            $this->load->model('Mymodel');
            $id = 'PL' . $this->Mymodel->urut('EIDPEN', 9999);
            $p = [$id, $_POST['idev'], $_POST['tglbayar'], $_POST['nobukti'], $id . '.' . $fext, $_POST['jmlterima'], addslashes($_POST['keterangan']), $_SESSION['ID_ADMIN']];
            $this->db->query(
                "INSERT INTO penerimaanev (id_penerimaan, id_ev, tgl_terima, no_bukti,bukti, jumlah, keterangan, 
        			id_admin) VALUES (?, ?, ?, ?, ?, ?, ?, ?)",
                $p,
            );
            if ($fz > 0) {
                move_uploaded_file($fn, './img/bayar/' . $id . '.' . $fext);
            }
            redirect('admin/event_penlain/' . $_POST['idev']);
        }
        if ($idev === false) {
        } else {
            $h = $this->db->query(
                "SELECT a.*, b.nama_admin FROM events AS a, admin AS b WHERE a.id_ev=? 
        				AND a.id_admin=b.id_admin LIMIT 0,1",
                $idev,
            );
            $j = $h->num_rows();
            if ($j == 0) {
                $_SESSION['POPUP_MSG'] = 'Data event tidak ada...';
                $_SESSION['POPUP_CLR'] = 'info';
                redirect('admin/event/0');
            } else {
                $this->data['DtEvent'] = $h->row_array();
                $stev = $this->data['DtEvent']['status_ev'];

                $this->data['MnuAktif'] = 'Event';
                $this->data['SubMnuAktif'] = 'Event' . $stev;
                $this->load->view('adm_event_penlain_new', $this->data);
            }
        }
    }

    public function event_penlain_edit($idpen = false)
    {
        if (isset($_POST['idev'])) {
            $fn = $_FILES['bukti']['tmp_name'];
            $fz = $_FILES['bukti']['size'];
            $fext = pathinfo($_FILES['bukti']['name'], PATHINFO_EXTENSION);
            if ($fz > 0) {

                $p = [$_POST['tglbayar'], $_POST['nobukti'], $_POST['idpen'] . $fext, $_POST['jmlterima'], addslashes($_POST['keterangan']), $_SESSION['ID_ADMIN'], $_POST['idpen']];
                $this->db->query(
                    "UPDATE penerimaanev SET tgl_terima=?, no_bukti=?,bukti=?, jumlah=?, keterangan=?, 
                        id_admin=? WHERE id_penerimaan=?",
                    $p,
                );

                move_uploaded_file($fn, './img/bayar/' . $_POST['idpen'] . $fext);
            } else {
                $p = [$_POST['tglbayar'], $_POST['nobukti'], $_POST['jmlterima'], addslashes($_POST['keterangan']), $_SESSION['ID_ADMIN'], $_POST['idpen']];
                $this->db->query(
                    "UPDATE penerimaanev SET tgl_terima=?, no_bukti=?, jumlah=?, keterangan=?, 
        			id_admin=? WHERE id_penerimaan=?",
                    $p,
                );
            }
            redirect('admin/event_penlain/' . $_POST['idev']);
        }
        if ($idpen === false) {
        } else {
            $h = $this->db->query(
                "SELECT a.*, b.nama_admin FROM penerimaanev AS a, admin AS b WHERE a.id_penerimaan=?
        					AND a.id_admin=b.id_admin LIMIT 0,1",
                $idpen,
            );
            if ($h->num_rows() == 0) {
                $_SESSION['POPUP_MSG'] = 'Data penerimaan tidak ada...';
                $_SESSION['POPUP_CLR'] = 'info';
                redirect('admin/event/0');
            } else {
                $this->data['DtPen'] = $h->row_array();

                $h = $this->db->query(
                    "SELECT a.*, b.nama_admin FROM events AS a, admin AS b WHERE a.id_ev=? 
        					AND a.id_admin=b.id_admin LIMIT 0,1",
                    $this->data['DtPen']['id_ev'],
                );
                $this->data['DtEvent'] = $h->row_array();
                $stev = $this->data['DtEvent']['status_ev'];

                $this->data['MnuAktif'] = 'Event';
                $this->data['SubMnuAktif'] = 'Event' . $stev;
                $this->load->view('adm_event_penlain_edit', $this->data);
            }
        }
    }

    public function event_penlain_del($idpen = false)
    {
        if ($idpen === false) {
        } else {
            $h = $this->db->query(
                "SELECT a.*, b.nama_admin FROM penerimaanev AS a, admin AS b WHERE a.id_penerimaan=?
        					AND a.id_admin=b.id_admin LIMIT 0,1",
                $idpen,
            );
            if ($h->num_rows() == 0) {
                $_SESSION['POPUP_MSG'] = 'Data penerimaan tidak ada...';
                $_SESSION['POPUP_CLR'] = 'info';
                redirect('admin/event/0');
            } else {
                $DtPen = $h->row_array();
                $this->db->query('DELETE FROM penerimaanev WHERE id_penerimaan=?', $idpen);
                $fn = './img/bayar/' . $idpen . '.jpg';
                if (file_exists($fn)) {
                    unlink($fn);
                }
                redirect('admin/event_penlain/' . $DtPen['id_ev']);
            }
        }
    }

    public function event_penlain_detail($idpen = false)
    {
        if ($idpen === false) {
        } else {
            $h = $this->db->query(
                "SELECT a.*, b.nama_admin FROM penerimaanev AS a, admin AS b WHERE a.id_penerimaan=?
        					AND a.id_admin=b.id_admin LIMIT 0,1",
                $idpen,
            );
            if ($h->num_rows() == 0) {
                $_SESSION['POPUP_MSG'] = 'Data penerimaan tidak ada...';
                $_SESSION['POPUP_CLR'] = 'info';
                redirect('admin/event/0');
            } else {
                $this->data['DtPen'] = $h->row_array();

                $h = $this->db->query(
                    "SELECT a.*, b.nama_admin FROM events AS a, admin AS b WHERE a.id_ev=? 
        					AND a.id_admin=b.id_admin LIMIT 0,1",
                    $this->data['DtPen']['id_ev'],
                );
                $this->data['DtEvent'] = $h->row_array();
                $stev = $this->data['DtEvent']['status_ev'];

                $this->data['MnuAktif'] = 'Event';
                $this->data['SubMnuAktif'] = 'Event' . $stev;
                $this->load->view('adm_event_penlain_detail', $this->data);
            }
        }
    }

    //PENGELUARAN KAS
    public function event_kaskeluar($idev = false, $tg = 'scr')
    {
        if ($idev === false) {
        } else {
            $h = $this->db->query(
                "SELECT a.*, b.nama_admin FROM events AS a, admin AS b WHERE a.id_ev=? 
        				AND a.id_admin=b.id_admin LIMIT 0,1",
                $idev,
            );
            $j = $h->num_rows();
            if ($j == 0) {
                $_SESSION['POPUP_MSG'] = 'Data event tidak ada...';
                $_SESSION['POPUP_CLR'] = 'info';
                redirect('admin/event/0');
            } else {
                $this->data['DtEvent'] = $h->row_array();
                $stev = $this->data['DtEvent']['status_ev'];
                $h = $this->db->query(
                    "SELECT a.*, b.nama_admin FROM kaskeluarev AS a, admin AS b WHERE a.id_ev=?
        					AND a.id_admin=b.id_admin ORDER BY a.id_kaskeluar ASC",
                    $idev,
                );
                $this->data['DtPen'] = $h->result();
                $this->data['JmlPen'] = $h->num_rows();
                $this->data['MnuAktif'] = 'Event';
                $this->data['SubMnuAktif'] = 'Event' . $stev;
                if ($tg == 'scr') {
                    $this->load->view('adm_event_kaskeluar_' . $stev, $this->data);
                } else {
                    $this->load->view('adm_event_kaskeluar_ctk', $this->data);
                }
            }
        }
    }

    public function event_kaskeluar_new($idev = false)
    {
        if (isset($_POST['idev'])) {
            $fn = $_FILES['bukti']['tmp_name'];
            $fz = $_FILES['bukti']['size'];
            $fext = pathinfo($_FILES['bukti']['name'], PATHINFO_EXTENSION);
            $this->load->model('Mymodel');
            $id = 'KL' . $this->Mymodel->urut('EIDKASKEL', 9999);
            $p = [$id, $_POST['idev'], $_POST['tglkeluar'], $_POST['nobukti'], $id . '.' . $fext, $_POST['jmlkeluar'], addslashes($_POST['keterangan']), $_SESSION['ID_ADMIN']];
            $this->db->query(
                "INSERT INTO kaskeluarev (id_kaskeluar, id_ev, tgl_keluar, no_bukti, bukti, jumlah, keterangan, 
        			id_admin) VALUES (?, ?, ?, ?, ?, ?, ?, ?)",
                $p,
            );

            if ($fz > 0) {
                move_uploaded_file($fn, './img/bayar/' . $id . '.' . $fext);
            }
            redirect('admin/event_kaskeluar/' . $_POST['idev']);
        }
        if ($idev === false) {
        } else {
            $h = $this->db->query(
                "SELECT a.*, b.nama_admin FROM events AS a, admin AS b WHERE a.id_ev=? 
        				AND a.id_admin=b.id_admin LIMIT 0,1",
                $idev,
            );
            $j = $h->num_rows();
            if ($j == 0) {
                $_SESSION['POPUP_MSG'] = 'Data event tidak ada...';
                $_SESSION['POPUP_CLR'] = 'info';
                redirect('admin/event/0');
            } else {
                $this->data['DtEvent'] = $h->row_array();
                $stev = $this->data['DtEvent']['status_ev'];

                $this->data['MnuAktif'] = 'Event';
                $this->data['SubMnuAktif'] = 'Event' . $stev;
                $this->load->view('adm_event_kaskeluar_new', $this->data);
            }
        }
    }

    public function event_kaskeluar_edit($idkas = false)
    {
        if (isset($_POST['idev'])) {

            $fn = $_FILES['bukti']['tmp_name'];
            $fz = $_FILES['bukti']['size'];
            $fext = pathinfo($_FILES['bukti']['name'], PATHINFO_EXTENSION);
            if ($fz > 0) {
                $p = [$_POST['tglkeluar'], $_POST['nobukti'], $_POST['idkas'] . '.' . $fext, $_POST['jmlkeluar'], addslashes($_POST['keterangan']), $_SESSION['ID_ADMIN'], $_POST['idkas']];
                $this->db->query(
                    "UPDATE kaskeluarev SET tgl_keluar=?, no_bukti=?,bukti=?, jumlah=?, keterangan=?, 
        			id_admin=? WHERE id_kaskeluar=?",
                    $p,
                );
                move_uploaded_file($fn, './img/bayar/' . $_POST['idkas'] . '.' . $fext);
            } else {
                $p = [$_POST['tglkeluar'], $_POST['nobukti'], $_POST['jmlkeluar'], addslashes($_POST['keterangan']), $_SESSION['ID_ADMIN'], $_POST['idkas']];
                $this->db->query(
                    "UPDATE kaskeluarev SET tgl_keluar=?, no_bukti=?, jumlah=?, keterangan=?, 
        			id_admin=? WHERE id_kaskeluar=?",
                    $p,
                );
            }
            redirect('admin/event_kaskeluar/' . $_POST['idev']);
        }
        if ($idkas === false) {
        } else {
            $h = $this->db->query(
                "SELECT a.*, b.nama_admin FROM kaskeluarev AS a, admin AS b WHERE a.id_kaskeluar=?
        					AND a.id_admin=b.id_admin LIMIT 0,1",
                $idkas,
            );
            if ($h->num_rows() == 0) {
                $_SESSION['POPUP_MSG'] = 'Data penerimaan tidak ada...';
                $_SESSION['POPUP_CLR'] = 'info';
                redirect('admin/event/0');
            } else {
                $this->data['DtPen'] = $h->row_array();

                $h = $this->db->query(
                    "SELECT a.*, b.nama_admin FROM events AS a, admin AS b WHERE a.id_ev=? 
        					AND a.id_admin=b.id_admin LIMIT 0,1",
                    $this->data['DtPen']['id_ev'],
                );
                $this->data['DtEvent'] = $h->row_array();
                $stev = $this->data['DtEvent']['status_ev'];

                $this->data['MnuAktif'] = 'Event';
                $this->data['SubMnuAktif'] = 'Event' . $stev;
                $this->load->view('adm_event_kaskeluar_edit', $this->data);
            }
        }
    }

    public function event_kaskeluar_del($idkas = false)
    {
        if ($idkas === false) {
        } else {
            $h = $this->db->query(
                "SELECT a.*, b.nama_admin FROM kaskeluarev AS a, admin AS b WHERE a.id_kaskeluar=?
        					AND a.id_admin=b.id_admin LIMIT 0,1",
                $idkas,
            );
            if ($h->num_rows() == 0) {
                $_SESSION['POPUP_MSG'] = 'Data pengeluaran kas tidak ada...';
                $_SESSION['POPUP_CLR'] = 'info';
                redirect('admin/event/0');
            } else {
                $DtPen = $h->row_array();
                $this->db->query('DELETE FROM kaskeluarev WHERE id_kaskeluar=?', $idkas);
                $fn = './img/bayar/' . $idkas . '.jpg';
                if (file_exists($fn)) {
                    unlink($fn);
                }
                redirect('admin/event_kaskeluar/' . $DtPen['id_ev']);
            }
        }
    }

    public function event_kaskeluar_detail($idkas = false)
    {
        if ($idkas === false) {
        } else {
            $h = $this->db->query(
                "SELECT a.*, b.nama_admin FROM kaskeluarev AS a, admin AS b WHERE a.id_kaskeluar=?
        					AND a.id_admin=b.id_admin LIMIT 0,1",
                $idkas,
            );
            if ($h->num_rows() == 0) {
                $_SESSION['POPUP_MSG'] = 'Data pengeluaran kas tidak ada...';
                $_SESSION['POPUP_CLR'] = 'info';
                redirect('admin/event/0');
            } else {
                $this->data['DtPen'] = $h->row_array();

                $h = $this->db->query(
                    "SELECT a.*, b.nama_admin FROM events AS a, admin AS b WHERE a.id_ev=? 
        					AND a.id_admin=b.id_admin LIMIT 0,1",
                    $this->data['DtPen']['id_ev'],
                );
                $this->data['DtEvent'] = $h->row_array();
                $stev = $this->data['DtEvent']['status_ev'];

                $this->data['MnuAktif'] = 'Event';
                $this->data['SubMnuAktif'] = 'Event' . $stev;
                $this->load->view('adm_event_kaskeluar_detail', $this->data);
            }
        }
    }

    //KEUANGAN
    public function event_keuangan($idev = false, $tg = 'scr')
    {
        if ($idev === false) {
        } else {
            $h = $this->db->query(
                "SELECT a.*, b.nama_admin FROM events AS a, admin AS b WHERE a.id_ev=? 
        				AND a.id_admin=b.id_admin LIMIT 0,1",
                $idev,
            );
            $j = $h->num_rows();
            if ($j == 0) {
                $_SESSION['POPUP_MSG'] = 'Data event tidak ada...';
                $_SESSION['POPUP_CLR'] = 'info';
                redirect('admin/event/0');
            } else {
                $this->data['DtEvent'] = $h->row_array();
                $stev = $this->data['DtEvent']['status_ev'];

                //penerimaan Iuran
                $h = $this->db->query(
                    "SELECT SUM(byr_wajib) AS jmlwajib, SUM(byr_registrasi) AS jmlregistrasi,SUM(byr_akomodasi) AS jmlakomodasi FROM 
        					iuranev WHERE id_ev=?",
                    $idev,
                );
                $d = $h->row_array();
                if ($d['jmlwajib'] == null) {
                    $d['jmlwajib'] = 0;
                }
                if ($d['jmlregistrasi'] == null) {
                    $d['jmlregistrasi'] = 0;
                }
                $this->data['JmlIuranWjb'] = $d['jmlwajib'];
                $this->data['JmlIuranReg'] = $d['jmlregistrasi'];
                $this->data['JmlAkomodasi'] = $d['jmlakomodasi'];
                //penerimaan lain
                $h = $this->db->query('SELECT SUM(jumlah) AS jmlpenlain FROM penerimaanev WHERE id_ev=?', $idev);
                $d = $h->row_array();
                if ($d['jmlpenlain'] == null) {
                    $d['jmlpenlain'] = 0;
                }
                $this->data['JmlPenLain'] = $d['jmlpenlain'];
                //pengeluaran kas
                $h = $this->db->query('SELECT SUM(jumlah) AS jmlkaskeluar FROM kaskeluarev WHERE id_ev=?', $idev);
                $d = $h->row_array();
                if ($d['jmlkaskeluar'] == null) {
                    $d['jmlkaskeluar'] = 0;
                }
                $this->data['JmlKasKeluar'] = $d['jmlkaskeluar'];

                $this->data['JmlPenerimaan'] = $this->data['JmlIuranWjb'] + $this->data['JmlIuranReg'] + $this->data['JmlPenLain'] + $this->data['JmlAkomodasi'];
                $saldokas = $this->data['JmlIuranWjb'] + $this->data['JmlIuranReg'] + $this->data['JmlPenLain'] + $this->data['JmlAkomodasi'] - $this->data['JmlKasKeluar'];

                $this->data['SaldoKas'] = $saldokas;
                $this->data['MnuAktif'] = 'Event';
                $this->data['SubMnuAktif'] = 'Event' . $stev;
                if ($tg == 'scr') {
                    $this->load->view('adm_event_keuangan_' . $stev, $this->data);
                } else {
                    $this->load->view('adm_event_keuangan_ctk', $this->data);
                }
            }
        }
    }

    /* ---- WEB ----- */
    // Data Berita
    public function berita()
    {
        $h = $this->db->query("SELECT a.id_berita, a.tgl_post, a.id_admin, a.judul, a.aktif, b.nama_admin FROM berita AS a, admin AS b 
        			WHERE a.id_admin=b.id_admin ORDER BY a.id_berita DESC");
        $this->data['DtBerita'] = $h->result();
        $this->data['JmlBerita'] = $h->num_rows();
        $this->data['MnuAktif'] = 'MnuWeb';
        $this->data['SubMnuAktif'] = 'Berita';
        $this->load->view('adm_berita', $this->data);
    }

    //Tam bah Berita
    public function berita_new()
    {
        if (isset($_POST['judul'])) {
            $this->load->model('Mymodel');
            $id = 'BR' . $this->Mymodel->urut('IDBERITA', 9999);
            $fn = $_FILES['foto']['tmp_name'];
            $fz = $_FILES['foto']['size'];
            $fext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            $p = [$id, date('Y-m-d H:i:s'), $_SESSION['ID_ADMIN'], $_POST['judul'], $_POST['ringkasan'], addslashes($_POST['detail']), $id . '.' . $fext, $_POST['aktif']];
            $this->db->query('INSERT INTO berita (id_berita, tgl_post, id_admin, judul, ringkasan, detail,foto, aktif) VALUES (?, ?, ?, ?, ?, ?,?, ?)', $p);

            if ($fz > 0) {
                $ft = 'img/berita/' . $id . '.' . $fext;
                move_uploaded_file($fn, $ft);
                $config['image_library'] = 'gd2';
                $config['source_image'] = $ft;
                $config['create_thumb'] = true;
                $config['maintain_ratio'] = true;
                $config['width'] = 400;
                $config['height'] = 600;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
            }
            redirect('admin/berita');
        }
        $this->data['MnuAktif'] = 'MnuWeb';
        $this->data['SubMnuAktif'] = 'Berita';
        $this->load->view('adm_berita_new', $this->data);
    }

    public function berita_edit($id = false)
    {
        if (isset($_POST['judul'])) {
            $fn = $_FILES['foto']['tmp_name'];
            $fz = $_FILES['foto']['size'];
            $fext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);


            if ($fz > 0) {
                $p = [$_SESSION['ID_ADMIN'], $_POST['judul'], $_POST['ringkasan'], $_POST['idb'] . '.' . $fext, addslashes($_POST['detail']), $_POST['aktif'], $_POST['idb']];
                $this->db->query('UPDATE berita SET id_admin=?, judul=?, ringkasan=?,foto=?, detail=?, aktif=? WHERE id_berita=?', $p);
                $ft = 'img/berita/' . $_POST['idb'] . '.' . $fext;
                move_uploaded_file($fn, $ft);
                $config['image_library'] = 'gd2';
                $config['source_image'] = $ft;
                $config['create_thumb'] = true;
                $config['maintain_ratio'] = true;
                $config['width'] = 400;
                $config['height'] = 600;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
            } else {
                $p = [$_SESSION['ID_ADMIN'], $_POST['judul'], $_POST['ringkasan'], addslashes($_POST['detail']), $_POST['aktif'], $_POST['idb']];
                $this->db->query('UPDATE berita SET id_admin=?, judul=?, ringkasan=?, detail=?, aktif=? WHERE id_berita=?', $p);
            }
            redirect('admin/berita');
        }

        if ($id === false) {
        } else {
            $h = $this->db->query('SELECT * FROM berita WHERE id_berita=? LIMIT 0,1', $id);
            $this->data['DtBerita'] = $h->row_array();
            $f = '/img/berita/' . $h->row()->foto;
            if (file_exists('.' . $f)) {
                $this->data['Foto'] = base_url() . $f;
            } else {
                $this->data['Foto'] = base_url() . '/img/noimage.jpg';
            }
            $this->data['MnuAktif'] = 'MnuWeb';
            $this->data['SubMnuAktif'] = 'Berita';
            $this->load->view('adm_berita_edit', $this->data);
        }
    }

    public function berita_del($id = false)
    {
        if ($id === false) {
        } else {
            $this->db->query('DELETE FROM berita WHERE id_berita=?', $id);
            $g = './img/berita/' . $id . '.jpg';
            if (file_exists($g)) {
                unlink($g);
            }
            $g = './img/berita/' . $id . '_thumb.jpg';
            if (file_exists($g)) {
                unlink($g);
            }
            $_SESSION['POPUP_MSG'] = 'Data berita sudah dihapus...';
            $_SESSION['POPUP_CLR'] = 'info';
            redirect('admin/berita');
        }
    }

    //tentang kami
    public function tentang()
    {
        $h = $this->db->query('SELECT * FROM tentang ORDER BY id_ttg');
        $this->data['DtTentang'] = $h->result();
        $this->data['JmlTentang'] = $h->num_rows();
        $this->data['MnuAktif'] = 'MnuWeb';
        $this->data['SubMnuAktif'] = 'Tentang';
        $this->load->view('adm_tentang', $this->data);
    }

    public function tentang_new()
    {
        if (isset($_POST['judul'])) {
            $id = $this->db->insert_id();
            $fn = $_FILES['foto']['tmp_name'];
            $fz = $_FILES['foto']['size'];
            $fext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            $p = [$_POST['judul'], addslashes($_POST['deskripsi']), $_POST['aktif'], $_POST['judul'] . '.' . $fext];
            $this->db->query('INSERT INTO tentang (judul, deskripsi, aktif,foto) VALUES (?, ?, ?,?)', $p);

            if ($fz > 0) {
                move_uploaded_file($fn, 'img/' . $_POST['judul'] . '.' . $fext);
            }
            redirect('admin/tentang');
        }

        $this->data['MnuAktif'] = 'MnuWeb';
        $this->data['SubMnuAktif'] = 'Tentang';
        $this->load->view('adm_tentang_new', $this->data);
    }

    public function tentang_edit($id = false)
    {
        if (isset($_POST['id'])) {

            $id = $_POST['id'];
            $fn = $_FILES['foto']['tmp_name'];
            $fz = $_FILES['foto']['size'];
            $fext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            if ($fz > 0) {
                $p = [$_POST['judul'], addslashes($_POST['deskripsi']), $_POST['judul'] . '.' . $fext, $_POST['aktif'], $_POST['id']];
                $this->db->query('UPDATE tentang SET judul=?, deskripsi=?,foto=?, aktif=? WHERE id_ttg=?', $p);
                move_uploaded_file($fn, 'img/' . $_POST['judul'] . '.' . $fext);
            } else {
                $p = [$_POST['judul'], addslashes($_POST['deskripsi']), $_POST['aktif'], $_POST['id']];
                $this->db->query('UPDATE tentang SET judul=?, deskripsi=?, aktif=? WHERE id_ttg=?', $p);
            }
            redirect('admin/tentang');
        }
        if ($id === false) {
        } else {
            $h = $this->db->query('SELECT * FROM tentang WHERE id_ttg=?', $id);
            $this->data['DtTentang'] = $h->row_array();
            $this->data['MnuAktif'] = 'MnuWeb';
            $this->data['SubMnuAktif'] = 'Tentang';
            $this->load->view('adm_tentang_edit', $this->data);
        }
    }

    public function tentang_del($id = false)
    {
        if ($id === false) {
        } else {
            $this->db->query('DELETE FROM tentang WHERE id_ttg=?', $id);
            $g = './img/ttg_' . $id . '.jpg';
            if (file_exists($g)) {
                unlink($g);
            }
            $_SESSION['POPUP_MSG'] = 'Data tentang sudah dihapus...';
            $_SESSION['POPUP_CLR'] = 'info';
            redirect('admin/tentang');
        }
    }

    public function tentang_delgbr($id = false)
    {
        if ($id === false) {
        } else {
            $g = './img/ttg_' . $id . '.jpg';
            if (file_exists($g)) {
                unlink($g);
            }
            redirect('admin/tentang_edit/' . $id);
        }
    }

    //Slide
    public function slide()
    {
        $this->data['MnuAktif'] = 'MnuWeb';
        $this->data['SubMnuAktif'] = 'slide';
        $this->load->view('adm_slide', $this->data);
    }

    public function slide_edit()
    {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $fn = $_FILES['foto']['tmp_name'];
            $fz = $_FILES['foto']['size'];
            if ($fz > 0) {
                move_uploaded_file($fn, 'img/slide_' . $id . '.jpg');
            }
        }
        redirect('admin/slide');
    }

    public function hapusdata()
    {
        $this->db->query('TRUNCATE TABLE events');
        $this->db->query('TRUNCATE TABLE gelarev');
        $this->db->query('TRUNCATE TABLE iuranev');
        $this->db->query('TRUNCATE TABLE iuranev_byr');
        $this->db->query('TRUNCATE TABLE juaraev');
        $this->db->query('TRUNCATE TABLE kaskeluarev');
        $this->db->query('TRUNCATE TABLE kategoriev');
        $this->db->query('TRUNCATE TABLE penerimaanev');
        $this->db->query('TRUNCATE TABLE pesertaev');
        $this->db->query('TRUNCATE TABLE timelineev');
        $_SESSION['POPUP_MSG'] = 'Data sudah kosong';
        $_SESSION['POPUP_CLR'] = 'info';
        redirect('admin');
    }

    public function profil()
    {
        $this->data['MnuAktif'] = 'MnuWebs';
        $this->data['SubMnuAktif'] = 'Tentangs';
        $id_admin = $_SESSION['ID_ADMIN'];
        $this->data['admin'] = $this->db->query("SELECT * FROM admin WHERE id_admin='$id_admin'")->row();
        $this->load->view('adm_profil', $this->data);
    }

    public function profil_update()
    {
        if (isset($_POST['id_admin'])) {
            $id = $_POST['id_admin'];
            $fn = $_FILES['foto']['tmp_name'];
            $fz = $_FILES['foto']['size'];
            $fext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);


            if ($fz > 0) {
                move_uploaded_file($fn, 'img/' . $_POST['username'] . '.' . $fext);
                if ($_POST['passwd'] != null) {
                    $p = [$_POST['namaadmin'], $_POST['username'], md5($_POST['passwd']), $_POST['username'] . '.' . $fext, $_POST['id_admin']];
                    $this->db->query('UPDATE admin SET nama_admin=?, user_name=?, passwd=?, foto=? WHERE id_admin=?', $p);
                } else {
                    $p = [$_POST['namaadmin'], $_POST['username'], $_POST['username'] . '.' . $fext, $_POST['id_admin']];
                    $this->db->query('UPDATE admin SET nama_admin=?, user_name=?, foto=? WHERE id_admin=?', $p);
                }
            } else {
                if ($_POST['passwd'] != null) {
                    $p = [$_POST['namaadmin'], $_POST['username'], md5($_POST['passwd']), $_POST['id_admin']];
                    $this->db->query('UPDATE admin SET nama_admin=?, user_name=?, passwd=? WHERE id_admin=?', $p);
                } else {
                    $p = [$_POST['namaadmin'], $_POST['username'], $_POST['id_admin']];
                    $this->db->query('UPDATE admin SET nama_admin=?, user_name=? WHERE id_admin=?', $p);
                }
            }
            redirect('admin');
        }
    }

    public function iuran_tahunan()
    {
        $h = $this->db->query('SELECT * FROM provinsi WHERE id_prov> 1 ORDER BY id_prov ASC');
        $this->data['DtProv'] = $h->result();
        $this->data['MnuAktif'] = 'Iuran Tahunan';
        $this->data['JmlProv'] = $h->num_rows();
        $this->data['SubMnuAktif'] = '';
        $this->load->view('adm_iuran_tahunan', $this->data);
    }

    public function bayar_iuran_tahunan($id)
    {
        $this->data['id'] = $id;
        $this->data['MnuAktif'] = 'Iuran Tahunan';
        $this->data['SubMnuAktif'] = '';
        $h = $this->db->query("SELECT * FROM provinsi WHERE id_prov=$id ORDER BY id_prov ASC");
        $this->data['DtProv'] = $h->row();
        $this->load->view('adm_iuran_tahunan_byr', $this->data);
    }

    public function iuran_tahunan_byr()
    {
        $fn = $_FILES['bukti']['tmp_name'];
        $fz = $_FILES['bukti']['size'];
        $fext = pathinfo($_FILES['bukti']['name'], PATHINFO_EXTENSION);
        $this->load->model('Mymodel');
        $idbyr = 'BI' . $this->Mymodel->urut('IUTH', 9999);
        $p = [$idbyr, $_POST['id_prov'], $_POST['tanggal_bayar'], $_POST['tahun'], $_POST['jumlah'], $_POST['nama_pembayar'], $_POST['nama_penerima'], $idbyr . '.' . $fext, $_POST['catatan']];
        $h = $this->db->query(
            "INSERT INTO iurantahunan (id, id_prov, tanggal_bayar, tahun, jumlah, nama_pembayar, nama_penerima, bukti, catatan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)",
            $p,
        );

        if ($fz > 0) {
            move_uploaded_file($fn, 'img/bayar/' . $idbyr . '.' . $fext);
        }
        redirect('admin/iuran_tahunan');
    }

    public function iuran_tahunan_detail($id)
    {
        $this->data['MnuAktif'] = 'Iuran Tahunan';
        $this->data['SubMnuAktif'] = '';
        $this->data['DtBayar'] = $this->db->query("SELECT a.*,b.provinsi FROM iurantahunan a,provinsi b WHERE a.id=? AND a.id_prov=b.id_prov", [$id])->row_array();
        $this->load->view('adm_iuran_tahunan_detail', $this->data);
    }

    public function iuran_tahunan_hapus($id)
    {
        $data = $this->db->query("SELECT * FROM iurantahunan WHERE id=?", [$id])->row();

        if ($data && $data->bukti) {
            $g = FCPATH . 'img/bayar/' . $data->bukti;
            if (file_exists($g)) {
                unlink($g);
            }
        }

        $this->db->query('DELETE FROM iurantahunan WHERE id=?', $id);
        $_SESSION['POPUP_MSG'] = 'Data iuran sudah dihapus...';
        $_SESSION['POPUP_CLR'] = 'info';
        redirect('admin/iuran_tahunan');
    }
}
