<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') != 1) {
            redirect('auth');
        }
        $this->load->model('mod_user');
    }
    public function index()
    {
        $data['judul']        = 'Pengguna';
        $this->absen->admin('admin/user/index', $data);
    }
    function ajax_list()
    {
        $list     = $this->mod_user->get_datatables();
        $no     = $_POST['start'];
        $data     = array();
        foreach ($list as $x) {
            $no++;
            $row     = array();
            $row[]    = $no;
            $row[]    = '<img src="' . base_url('assets/admin/dist/img/' . $x->gambar) . '" class="img img-fluid" style="width:75px;border-radius:75px" alt="' . $x->gambar . '" >';
            $row[]    = $x->nip;
            $row[]    = $x->nama_user;
            $row[]    = $x->email;
            $row[]    = $x->tanggal_lahir;
            $row[]    = 'Rp.' . number_format($x->gaji);
            if ($x->role == 1) {
                $row[]    = 'Admin';
            } else {
                $row[]    = 'Guru';
            }
            $row[]    = $this->button($x);
            $data[]    = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->mod_user->count_all(),
            "recordsFiltered" => $this->mod_user->count_filtered(),
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
        $button     .= '<a href="' . base_url('admin/user/edit/' . base64_encode($x->id_user)) . '" class="dropdown-item" title="">Edit</a>';
        $button     .= '<a href="' . base_url('admin/user/delete/' . base64_encode($x->id_user)) . '" class="dropdown-item hapus" title="">Hapus</a>';
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
        $q = $this->mc->hapus('user', ['id_user' => $id]);
        if ($q['status'] == 'berhasil') {
            $this->session->set_flashdata('berhasil', 'berhasil disimpan');
            redirect('admin/user', 'refresh');
        } else {
            $this->session->set_flashdata('eror', 'gagal disimpan');
            redirect('admin/user', 'refresh');
        }
    }
    public function tambah()
    {
        $this->form_validation->set_rules('nama_user', 'nama user', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('nip', 'nip', 'trim|required|is_unique[user.nip]');
        $this->form_validation->set_rules('tanggal_lahir', 'tanggal lahir', 'trim|required');
        $this->form_validation->set_rules('role', 'jenis pengguna', 'trim|required');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['judul']        = 'Tambah Pengguna';
            $this->absen->admin('admin/user/tambah', $data);
        } else {
            $this->upload();
            if (!$this->upload->do_upload('gambar')) {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('eror', $error);
                redirect('admin/user/tambah', 'refresh');
                return false;
            } else {
                $foto = $this->upload->data();
            }
            $data = array(
                'nama_user' => $this->input->post('nama_user'),
                'email'    => $this->input->post('email'),
                'nip'    => $this->input->post('nip'),
                'role'        => $this->input->post('role'),
                'tanggal_lahir'        => $this->input->post('tanggal_lahir'),
                'alamat'        => $this->input->post('alamat'),
                'jenis_kelamin'        => $this->input->post('jenis_kelamin'),
                'gaji'        => $this->input->post('gaji'),
                'password'        => password_hash($this->input->post('email'), PASSWORD_DEFAULT),
                'gambar'        => $foto['file_name']
            );

            $q = $this->mc->simpan('user', $data);
            if ($q['status'] == 'berhasil') {
                $this->session->set_flashdata('berhasil', 'berhasil disimpan');
                redirect('admin/user', 'refresh');
            } else {
                $this->session->set_flashdata('eror', 'gagal disimpan');
                redirect('admin/user', 'refresh');
            }
        }
    }
    public function edit($id)
    {
        $this->form_validation->set_rules('nama_user', 'nama user', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
        $this->form_validation->set_rules('nip', 'nip', 'trim|required');
        $this->form_validation->set_rules('tanggal_lahir', 'tanggal lahir', 'trim|required');
        $this->form_validation->set_rules('role', 'jenis pengguna', 'trim|required');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['judul']        = 'Edit Pengguna';
            $data['user']        = $this->mc->ambil('user', ['id_user' => base64_decode($id)])->row_array();
            $this->absen->admin('admin/user/edit', $data);
        } else {
            $id = base64_decode($id);
            $data = array(
                'nama_user' => $this->input->post('nama_user'),
                'email'    => $this->input->post('email'),
                'nip'    => $this->input->post('nip'),
                'role'        => $this->input->post('role'),
                'tanggal_lahir'        => $this->input->post('tanggal_lahir'),
                'gaji'        => $this->input->post('gaji'),
                'alamat'        => $this->input->post('alamat'),
                'jenis_kelamin'        => $this->input->post('jenis_kelamin'),
                'password'        => password_hash($this->input->post('email'), PASSWORD_DEFAULT),
            );
            if ($_FILES['gambar']['name'] != null) {
                $this->upload();
                if (!$this->upload->do_upload('gambar')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('eror', $error);
                    redirect('admin/user/edit/' . $id, 'refresh');
                    return false;
                } else {
                    $foto = $this->upload->data();
                }
                $data['gambar']        = $foto['file_name'];
            } else {
                $data['gambar'] = $this->input->post('gambarlama');
            }
            $q = $this->mc->ubah('user', $data, ['id_user' => $id]);
            if ($q['status'] == 'berhasil') {
                $this->session->set_flashdata('berhasil', 'berhasil disimpan');
                redirect('admin/user', 'refresh');
            } else {
                $this->session->set_flashdata('eror', 'gagal disimpan');
                redirect('admin/user', 'refresh');
            }
        }
    }
    private function upload()
    {
        $config['upload_path']         = './assets/admin/dist/img/';
        $config['allowed_types']     = 'jpeg|jpg|png|JPEG|JPG|PNG';
        $config['max_size']          = '5000';
        $config['file_name']         = 'usr' . time();
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
    }
}
