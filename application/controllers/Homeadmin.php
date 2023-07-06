<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Homeadmin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') != 1) {
            redirect('auth');
        }
        $this->load->model('mod_gaji');
    }

    public function index()
    {
        $data['judul']        = 'Dashboard';
        $this->absen->admin('admin/index', $data);
    }
    function ajax_list()
    {
        $list     = $this->mod_gaji->get_datatables();
        $no     = $_POST['start'];
        $data     = array();
        foreach ($list as $x) {
            $no++;
            $row     = array();
            $row[]    = $no;
            $row[]    = $x->nip;
            $row[]    = $x->nama_user;
            $row[]    = date('t') . ' hari';
            $row[]    = $this->_pertemuan($x) . 'kali';
            $row[]    = $this->_kehadiran($x) . ' kali';
            $row[]    = 'Rp.' . number_format($this->_gaji($x));
            $row[]    = 'Rp.' . number_format($x->gaji);
            $data[]    = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->mod_gaji->count_all(),
            "recordsFiltered" => $this->mod_gaji->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
    public function _pertemuan($x)
    {
        $q = $this->mc->ambil('user_mapel', ['id_user' => $x->id_user])->num_rows();
        return 4 * $q;
    }
    public function _kehadiran($x)
    {
        $q = $this->mc->ambil('histori_absen', ['id_user' => $x->id_user])->num_rows();
        return $q;
    }
    public function _gaji($x)
    {
        $q = $this->_kehadiran($x) / $this->_pertemuan($x) * 100;
        if ($q) {
            $d = $q * $x->gaji / 100;
            return $d;
        } else {
            return 0;
        }
    }
}
