<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Scanner extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') != 2) {
            redirect('auth');
        }
        date_default_timezone_set("Asia/Jakarta");
    }

    public function index()
    {
        $data['judul']        = 'Absen Qr Code';
        $this->load->view('guru/scanner', $data);
    }

    public function Absen($uuid)
    {
        $q = $this->mc->cekjadwal($uuid);
        $ca = $this->mc->cekAbsen($uuid);

        if ($ca > 0) {
            $data = 'anda sudah absen di sesi ini';
        } else {
            if ($q) {
                if ($this->longdate_indo(date('Y-m-d')) ==  $q['hari']) {
                    $jamawal = date('H:i:s', strtotime('-15 minutes', strtotime($q['jam'])));
                    $jamakhir = date('H:i:s', strtotime('+' . $q['waktu'] . ' minutes', strtotime($q['jam'])));
                    if (date('H:i:s') < $jamawal) {
                        $data = 'Absen hanya bisa dilakukan 15 menit sebelum jam pelajaran dimulai';
                    } else if (date('H:i:s') > $jamakhir) {
                        $data = 'Anda telat masuk Absen';
                    } else {
                        $d = $this->_absen($q);
                        $data = 'Anda ' . $d . ' melakukan absensi';
                    }
                } else {
                    $data = 'Anda tidak ada mata pelajaran di hari ini';
                }
            } else {
                $data = 'pastikan qr code sesuaikan dengan jadwal anda';
            }
        }
        echo json_encode($data);
    }

    private function _absen($x)
    {
        $data = [
            'id_user'       => $this->session->userdata('id'),
            'id_jadwal'     => $x['id_umpel'],
            'keterangan'    => 'hadir',
            'timestamps'    => date('Y-m-d H:i:s')
        ];
        $q = $this->mc->simpan('histori_absen', $data);
        return $q['status'];
    }

    function longdate_indo($tanggal)
    {
        $ubah = gmdate($tanggal, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah);
        $tgl = $pecah[2];
        $bln = $pecah[1];
        $thn = $pecah[0];

        $nama = date("l", mktime(0, 0, 0, $bln, $tgl, $thn));
        $nama_hari = "";
        if ($nama == "Sunday") {
            $nama_hari = "minggu";
        } else if ($nama == "Monday") {
            $nama_hari = "senin";
        } else if ($nama == "Tuesday") {
            $nama_hari = "selasa";
        } else if ($nama == "Wednesday") {
            $nama_hari = "rabu";
        } else if ($nama == "Thursday") {
            $nama_hari = "kamis";
        } else if ($nama == "Friday") {
            $nama_hari = "jumat";
        } else if ($nama == "Saturday") {
            $nama_hari = "sabtu";
        }
        return $nama_hari;
    }
}
