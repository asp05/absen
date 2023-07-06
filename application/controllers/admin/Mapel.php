<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mapel extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') != 1) {
            redirect('auth');
        }
        $this->load->model('mod_mapel');
    }
    public function index()
    {
        $data['judul']        = 'Mata Pelajaran';
        $this->absen->admin('admin/mapel/index', $data);
    }
    function ajax_list()
    {
        $list     = $this->mod_mapel->get_datatables();
        $no     = $_POST['start'];
        $data     = array();
        foreach ($list as $x) {
            $no++;
            $row     = array();
            $row[]    = $no;
            $row[]    = $x->nama_mapel;
            $row[]    = $x->keterangan ? $x->keterangan : '-';
            $row[]    = $this->button($x);
            $data[]    = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->mod_mapel->count_all(),
            "recordsFiltered" => $this->mod_mapel->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
    private function button($x)
    {
        $button = '<div class="dropdown">';
        $button .= '<button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
        $button .= 'Aksi';
        $button .= '</button>';
        $button .= '<div class="dropdown-menu float-right" aria-labelledby="dropdownMenuButton">';
        $button     .= '<a href="' . base_url('admin/mapel/edit/' . base64_encode($x->id_mapel)) . '" class="dropdown-item" title="">Edit</a>';
        $button     .= '<a href="' . base_url('admin/mapel/delete/' . base64_encode($x->id_mapel)) . '" class="dropdown-item hapus" title="">Hapus</a>';
        $button .= '</div>';
        $button .= '</div>';
        $button .= "<script>
				$('.hapus').on('click',function(e) {
				    e.preventDefault();
				    const href = $(this).attr('href')
				    Swal.fire({
				      title : 'Apakah anda yakin hapus?',
				      type  : 'warning',
				      showCancelButton : true,
				      confirmButtonColor: '#3085d6',
				      cancelButtonColor: '#d33',
				      confirmButtonText: 'Hapus',
				      cancelButtonText: 'Batal'
				    }).then((result) => {
				      if (result.value) {
				        document.location.href = href;
				      }
				    })
			  	})
		</script>";
        return $button;
    }
    public function delete($id)
    {
        $id = base64_decode($id);
        $q = $this->mc->hapus('mapel', ['id_mapel' => $id]);
        if ($q['status'] == 'berhasil') {
            $this->session->set_flashdata('berhasil', 'berhasil disimpan');
            redirect('admin/mapel', 'refresh');
        } else {
            $this->session->set_flashdata('eror', 'gagal disimpan');
            redirect('admin/mapel', 'refresh');
        }
    }
    public function tambah()
    {
        $this->form_validation->set_rules('nama_mapel', 'nama mata pelajaran', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['judul']        = 'Tambah Mapel';
            $this->absen->admin('admin/mapel/tambah', $data);
        } else {
            $data = array(
                'nama_mapel' => $this->input->post('nama_mapel'),
                'keterangan'    => $this->input->post('keterangan'),
            );

            $q = $this->mc->simpan('mapel', $data);
            if ($q['status'] == 'berhasil') {
                $this->session->set_flashdata('berhasil', 'berhasil disimpan');
                redirect('admin/mapel', 'refresh');
            } else {
                $this->session->set_flashdata('eror', 'gagal disimpan');
                redirect('admin/mapel', 'refresh');
            }
        }
    }
    public function edit($id)
    {
        $this->form_validation->set_rules('nama_mapel', 'nama mata pelajaran', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['judul']        = 'Edit Mapel';
            $data['mapel']        = $this->mc->ambil('mapel', ['id_mapel' => base64_decode($id)])->row_array();
            $this->absen->admin('admin/mapel/edit', $data);
        } else {
            $data = array(
                'nama_mapel' => $this->input->post('nama_mapel'),
                'keterangan'    => $this->input->post('keterangan'),
            );

            $q = $this->mc->ubah('mapel', $data, ['id_mapel' => base64_decode($id)]);
            if ($q['status'] == 'berhasil') {
                $this->session->set_flashdata('berhasil', 'berhasil disimpan');
                redirect('admin/mapel', 'refresh');
            } else {
                $this->session->set_flashdata('eror', 'gagal disimpan');
                redirect('admin/mapel', 'refresh');
            }
        }
    }
}
