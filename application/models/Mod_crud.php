<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_crud extends CI_Model
{

    function ambil($table, $id = null, $limit = null)
    {
        if ($id !== null) {
            if ($limit != null) {
                $this->db->limit($limit);
            }
            return $this->db->get_where($table, $id);
        } else {
            return $this->db->get($table);
        }
    }
    function simpan($table, $data)
    {
        $this->db->insert($table, $data);
        return array('status' => 'berhasil');
    }
    function hapus($table, $data)
    {
        $this->db->where($data);
        $this->db->delete($table);
        return array('status' => 'berhasil');
    }
    function ubah($table, $data, $id)
    {
        $this->db->where($id);
        $this->db->update($table, $data);
        return array('status' => 'berhasil');
    }
    function grup($table, $grup)
    {
        $this->db->group_by($grup);
        return $this->db->get($table);
    }
    function terbaru($table, $new)
    {
        $this->db->where($new);
        return $this->db->get($table);
    }
    function sumRat($table, $id)
    {
        $this->db->select('SUM(rating) as rating');
        $this->db->where($id);
        return $this->db->get($table);
    }

    function numcari($table, $kw)
    {
        $this->db->like('nameproduct', $kw);
        return $this->db->get($table);
    }

    public function cekjadwal($uuid)
    {
        $this->db->where('uuid', $uuid);
        $this->db->where('id_user', $this->session->userdata('id'));
        $q = $this->db->get('user_mapel')->row_array();
        return $q;
    }
    public function cekAbsen($uuid)
    {
        $q = $this->cekjadwal($uuid);
        if ($q) {
            $this->db->where('id_jadwal', $q['id_umpel']);
            $this->db->where('id_user', $q['id_user']);
            $this->db->where('DATE(timestamps)', date('Y-m-d'));
            return $this->db->get('histori_absen')->num_rows();
        } else {
            return 0;
        }
    }
}

/* End of file Mod_crud.php */
/* Location: ./application/models/Mod_crud.php */