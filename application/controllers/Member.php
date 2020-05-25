<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('role_id') == 1){
            redirect('admin');
        }else if($this->session->userdata('role_id') == null){
            redirect('auth');
        }
        date_default_timezone_set('Asia/Jakarta');
    }
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('member/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('member/index');
        $this->load->view('templates/footer');
    }

    public function profile(){
        $data['title'] = 'Profile';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('member/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/profile', $data);
        $this->load->view('templates/footer');
    }

    public function barang(){
        $data['title'] = 'Barang Tersedia';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['kategori'] = $this->db->get('kategori')->result_array();
        $this->load->model('Member_barang', 'barang');
        $data['barang'] = $this->barang->getBarangStok();
        $this->load->view('templates/header', $data);
        $this->load->view('member/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('member/barang');
        $this->load->view('templates/footer');
    }
    
    public function pesanan(){
        $data['title'] = 'Pesanan';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['kategori'] = $this->db->get('kategori')->result_array();
        $data['barang'] = $this->db->get('barang')->result_array();
        $data['pesanan'] = $this->db->get_where('pesanan', ['username' => $this->session->userdata('username'), 'konfirmasi' => 0])->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('member/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('member/pesanan2');
        $this->load->view('templates/footer');

    }

    public function ajax($keyword){
        // var_dump($keyword);die;
        $data['keyword'] = $keyword;
        $this->load->model('Pesanan_model', 'barang');
        $data['barang'] = $this->barang->getBarangByKeyword($keyword);
        $data['kategori'] = $this->barang->getKategoriByKeyword($keyword);
        $this->load->view('ajax/index',$data);
    }
}
