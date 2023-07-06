<?php
defined('BASEPATH') or exit('No direct script access allowed');

class jadwal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') != 1) {
            redirect('auth');
        }
        $this->load->model('mod_jadwal');
    }
    public function index()
    {
        $data['judul']        = 'Jadwal Pelajaran';
        $this->absen->admin('admin/jadwal/index', $data);
    }
    function ajax_list()
    {
        $list     = $this->mod_jadwal->get_datatables();
        $no     = $_POST['start'];
        $data     = array();
        foreach ($list as $x) {
            $no++;
            $row     = array();
            $row[]    = $no;
            $row[]    = '<a href="javascript::void(0)" data-toggle="modal" data-target="#exampleModal" data-waktu="' . $x->waktu . '" data-jam="' . $x->jam . '" data-hari="' . $x->hari . '" data-mapel="' . $x->nama_mapel . '" data-nama="' . $x->nama_user . '" data-gambar="' . $x->qrcode  . '"><img src="' . base_url('assets/admin/dist/img/' . $x->qrcode) . '"  class="img img-fluid" style="width:75px;" alt="' . $x->qrcode . '"></a>';
            $row[]    = $x->nama_user;
            $row[]    = $x->nama_mapel;
            $row[]    = ucwords($x->hari);
            $row[]    = $x->jam;
            $row[]    = $x->waktu . ' menit';
            $row[]    = $this->button($x);
            $data[]    = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->mod_jadwal->count_all(),
            "recordsFiltered" => $this->mod_jadwal->count_filtered(),
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
        $button     .= '<a href="' . base_url('admin/jadwal/edit/' . base64_encode($x->id_umpel)) . '" class="dropdown-item" title="">Edit</a>';
        $button     .= '<a href="' . base_url('admin/jadwal/delete/' . base64_encode($x->id_umpel)) . '" class="dropdown-item hapus" title="">Hapus</a>';
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
        $q = $this->mc->hapus('user_mapel', ['id_umpel' => $id]);
        if ($q['status'] == 'berhasil') {
            $this->session->set_flashdata('berhasil', 'berhasil disimpan');
            redirect('admin/jadwal', 'refresh');
        } else {
            $this->session->set_flashdata('eror', 'gagal disimpan');
            redirect('admin/jadwal', 'refresh');
        }
    }
    public function tambah()
    {
        $this->form_validation->set_rules('id_user', 'nama mata pelajaran', 'trim|required');
        $this->form_validation->set_rules('id_mapel', 'nama mata pelajaran', 'trim|required');
        $this->form_validation->set_rules('hari', 'nama mata pelajaran', 'trim|required');
        $this->form_validation->set_rules('jam', 'nama mata pelajaran', 'trim|required');
        $this->form_validation->set_rules('waktu', 'nama mata pelajaran', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['judul']        = 'Tambah jadwal';
            $data['guru']        = $this->mc->ambil('user', ['role' => 2])->result();
            $data['mapel']        = $this->mc->ambil('mapel')->result();
            $this->absen->admin('admin/jadwal/tambah', $data);
        } else {

            $uuid = uniqid();
            $this->load->library('ciqrcode'); //pemanggilan library QR CODE

            $config['cacheable']    = true; //boolean, the default is true
            $config['cachedir']     = './assets/'; //string, the default is application/cache/
            $config['errorlog']     = './assets/'; //string, the default is application/logs/
            $config['imagedir']     = './assets/admin/dist/img/'; //direktori penyimpanan qr code
            $config['quality']      = true; //boolean, the default is true
            $config['size']         = '1024'; //interger, the default is 1024
            $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
            $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
            $this->ciqrcode->initialize($config);

            $image_name = time() . '.png'; //buat name dari qr code sesuai dengan nip

            $params['data'] = $uuid; //data yang akan di jadikan QR CODE
            $params['level'] = 'H'; //H=High
            $params['size'] = 10;
            $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
            $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

            $data = array(
                'id_user' => $this->input->post('id_user'),
                'id_mapel' => $this->input->post('id_mapel'),
                'hari' => $this->input->post('hari'),
                'jam' => $this->input->post('jam'),
                'waktu'    => $this->input->post('waktu'),
                'qrcode'    => $image_name,
                'uuid'      => $uuid
            );

            $q = $this->mc->simpan('user_mapel', $data);
            if ($q['status'] == 'berhasil') {
                $this->session->set_flashdata('berhasil', 'berhasil disimpan');
                redirect('admin/jadwal', 'refresh');
            } else {
                $this->session->set_flashdata('eror', 'gagal disimpan');
                redirect('admin/jadwal', 'refresh');
            }
        }
    }
    public function edit($id)
    {
        $this->form_validation->set_rules('hari', 'nama mata pelajaran', 'trim|required');
        $this->form_validation->set_rules('jam', 'nama mata pelajaran', 'trim|required');
        $this->form_validation->set_rules('waktu', 'nama mata pelajaran', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['judul']        = 'Edit jadwal';
            $data['guru']        = $this->mc->ambil('user', ['role' => 2])->result();
            $data['mapel']        = $this->mc->ambil('mapel')->result();
            $data['jadwal']        = $this->mc->ambil('user_mapel', ['id_umpel' => base64_decode($id)])->row();
            $this->absen->admin('admin/jadwal/edit', $data);
        } else {

            $data = array(
                'hari' => $this->input->post('hari'),
                'jam' => $this->input->post('jam'),
                'waktu'    => $this->input->post('waktu')
            );

            $q = $this->mc->ubah('user_mapel', $data, ['id_umpel' => base64_decode($id)]);
            if ($q['status'] == 'berhasil') {
                $this->session->set_flashdata('berhasil', 'berhasil disimpan');
                redirect('admin/jadwal', 'refresh');
            } else {
                $this->session->set_flashdata('eror', 'gagal disimpan');
                redirect('admin/jadwal', 'refresh');
            }
        }
    }
}
