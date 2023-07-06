<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Historiabsen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') != 1) {
            redirect('auth');
        }
        $this->load->model('mod_history');
    }
    public function index()
    {
        $data['judul']        = 'History Absen';
        $this->absen->admin('admin/history/index', $data);
    }
    function ajax_list()
    {
        $list     = $this->mod_history->get_datatables();
        $no     = $_POST['start'];
        $data     = array();
        foreach ($list as $x) {
            $no++;
            $row     = array();
            $row[]    = $no;
            $row[]    = $x->nama_user;
            $row[]    = $x->nama_mapel;
            $row[]    = $x->timestamps;
            $row[]    = $x->keterangan;
            $data[]    = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->mod_history->count_all(),
            "recordsFiltered" => $this->mod_history->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
}
