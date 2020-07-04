<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required', [
            'required' => 'Username harus diisi!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required', [
            'required' => 'Password harus diisi!'
        ]);
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login', $data);
            $this->load->view('templates/auth_footer');
            $this->load->view('templates/footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $username = strtolower($this->input->post('username'));
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['username' => $username])->row_array();

        if ($user) {
            if ($password == $user['password'] && $username == 'admin') {
                $data = [
                    'username' => $user['username'],
                    'nama' => $user['nama'],
                    'role_id' => $user['role_id']
                ];
                $this->session->set_userdata($data);
                redirect('admin');
            } else {

                if (password_verify($password, $user['password'])) {
                    $data = [
                        'username' => $user['username'],
                        'nama' => $user['nama'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    redirect('member');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!.</div>');
                    redirect('auth');
                }
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username tidak terdaftar! Silakan daftar ke admin.</div>');
            redirect('auth');
        }
    }
    
    public function logout(){
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Kamu telah logout!</div>');
        redirect('auth');
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}
