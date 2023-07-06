<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_mapel extends CI_Model
{

    var $table = 'mapel';
    var $column_order = array('nama_mapel', null);
    var $column_search = array('nama_mapel');

    private function _get_datatables_query()
    {
        // var_dump($_POST);die();
        // if ($this->input->post('outlet') != '' || $this->input->post('outlet') != null) {
        //     $this->db->where('outlet.id_outlet', $this->input->post('outlet'));
        // }
        // if ($this->input->post('nama') != '' || $this->input->post('nama') != null) {
        //     $this->db->like('nama_user', $this->input->post('nama'));
        // }
        // if ($this->input->post('role') != '' || $this->input->post('role') != null) {
        //     $this->db->where('role', $this->input->post('role'));
        // }
        $this->db->from($this->table);

        $i = 0;

        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } elseif (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
}

/* End of file Mod_user.php */
/* Location: ./application/models/Mod_user.php */