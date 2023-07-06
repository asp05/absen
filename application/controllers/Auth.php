<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function index()
    {
        if ($this->session->userdata('role') == 1) {
            redirect('homeadmin');
        } elseif ($this->session->userdata('role') == 2) {
            redirect('guru/scanner');
        }
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data['judul']    = 'Login';
            $this->load->view('auth/login', $data);
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $user = $this->mc->ambil('user', ['email' => $email])->row_array();

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'id'    => $user['id_user'],
                        'nama'  => $user['nama_user'],
                        'role'  => $user['role']
                    ];
                    if ($user['role'] == 1) {
                        $this->session->set_userdata($data);
                        redirect('homeadmin', 'refresh');
                    } elseif ($user['role'] == 2) {
                        $this->session->set_userdata($data);
                        redirect('guru/scanner', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('login', 'username/password salah');
                    redirect('auth', 'refresh');
                }
            } else {
                $this->session->set_flashdata('login', 'username/password salah');
                redirect('auth', 'refresh');
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth', 'refresh');
        die();
    }
}
