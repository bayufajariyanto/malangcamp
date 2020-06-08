<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        date_default_timezone_set('Asia/Jakarta');
    }
    public function index()
    {
        // $data['title'] = 'Dashboard';
        // $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        // $this->load->view('templates/header', $data);
        // $this->load->view('member/sidebar');
        // $this->load->view('templates/topbar', $data);
        // $this->load->view('member/index');
        // $this->load->view('templates/footer');
        $this->barang();
    }

    public function profile(){
        $data['title'] = 'Profile';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('templates/header', $data);
        // $this->load->view('templates/member/sidebar');
        $this->load->view('templates/member/topbar', $data);
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
        // $this->load->view('templates/member/sidebar');
        $this->load->view('templates/member/topbar', $data);
        $this->load->view('member/barang');
        $this->load->view('templates/footer');
    }
    
    public function barangId($id){
        $data['title'] = 'Rincian Barang';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->model('Member_barang', 'barang');
        $data['rincian'] = $this->barang->getBarangId($id);
        $this->load->view('templates/header', $data);
        // $this->load->view('templates/member/sidebar');
        $this->load->view('templates/member/topbar', $data);
        $this->load->view('member/barang_detail');
        $this->load->view('templates/footer');
    }

    public function tambahkeranjang($id){
        $jumlah = $this->input->post('jumlah');
        $data = [
            'username' => $this->session->userdata('username'),
            'id_barang' => $id,
            'jumlah' => $jumlah
        ];
        $this->db->insert('keranjang', $data);
        redirect('index');
    }
    
    public function pesanan(){
        $data['title'] = 'Pesanan';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['username'] = $this->db->get_where('user', ['role_id' => 2])->result_array();
        $data['pesanan'] = $this->db->get_where('pesanan', ['konfirmasi' => 0])->result_array();
        $data['kategori'] = $this->db->get('kategori')->result_array();
        $pesanan = $data['pesanan'];

        // load model
        $this->load->model('Pesanan_model', 'barang');
        $data['barang'] = $this->barang->getBarangStok();
        $data['sejam'] = 60*60;
        $id_barang = $this->input->post('barang');
        $jumlah = $this->input->post('jumlah');
        $status = $this->input->post('status');
        $hari = $this->input->post('hari');
        $tsewa = $this->input->post('sewa');
        $barang = $this->db->get_where('barang', ['id' => $id_barang])->row_array();
        $tbayar = 0;
        $id_user = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();        
        // hapus pesanan ketika sudah melewati 1 jam
        $sejam = 60*60;
        foreach($pesanan as $p):
            $order = $p['tanggal_order'] + $sejam;
            if($order<time()){
                $url = base_url('member/pesanan_batal/'.$p['id']);
                redirect($url);
            }
        endforeach;
        // var_dump($data['pesanan']);die;

        if ($this->form_validation->run('member_pesanan') == false) {
            $this->load->view('templates/header', $data);
            // $this->load->view('templates/member/sidebar');
            $this->load->view('templates/member/topbar', $data);
            $this->load->view('member/pesanandua');
            $this->load->view('templates/footer');
            // var_dump('berhasil');die;
        } else {
            $harga = $barang['harga'] * $jumlah;
            $sewa = explode(":",$tsewa);
            $jam = (int) $sewa[0];
            $menit = (int) $sewa[1];
            // Pembuatan Kode Transaksi
            $kategori = strtoupper(substr($barang['kategori'], 0, 3));
            $tanggal = date('ymdHis');
            if($status == 1){
                $tbayar = time();
            }else{
                $tbayar = 0;
            }
            // var_dump($barang['stok']);die;
            $kode = $kategori.'-'.$tanggal.$id_user['id'];
            // Akhir kode transaksi
            $jam_sewa = mktime($jam,$menit,(int)date('s'),(int)date('m'),(int)date('d'),(int)date('Y'));
            $jam_kembali = $jam_sewa+(60*60*24*$hari);
            $total = $barang['harga'];
            if($id_barang == null){
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Pilih barang yang mau disewa!</div>');
                redirect('member/pesanan');
            }else
            if ($barang['stok'] < $jumlah) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Jumlah melebihi batas, stok hanya ' . $barang['stok'] . ' </div>');
                redirect('member/pesanan');
            } else {
                $stok = $barang['stok'] - $jumlah;
                $data = [
                    'stok' => $stok
                ];
                $pesanan = [
                    'kode_transaksi' => $kode,
                    'username' => $this->session->userdata('username'),
                    'id_barang' => $id_barang,
                    'tanggal_order' => time(),
                    'tanggal_sewa' => $jam_sewa,
                    'batas_kembali' => $jam_kembali,
                    'tanggal_bayar' => $tbayar,
                    'jumlah_barang' => $jumlah,
                    'total' => $harga,
                    'status' => $status,
                ];
                $this->db->update('barang', $data, ['id' => $id_barang]);
                $this->db->insert('pesanan', $pesanan);
            }
            // var_dump($angka);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Transaksi ' . $kode . ' berhasil ditambahkan!</div>');
            redirect('member/pesanan');
        }
    }

    public function pesanan_batal($id)
    {
        $pesanan = $this->db->get_where('pesanan', ['id' => $id])->row_array();
        $jumlah = $pesanan['jumlah_barang'];
        $barang = $this->db->get_where('barang', ['id' => $pesanan['id_barang']])->row_array();
        $jumlah = $barang['stok']+$jumlah;
        $data = [
            'stok' => $jumlah
        ];
        $this->db->update('barang', $data, ['id' => $pesanan['id_barang']]);
        $this->db->delete('pesanan', ['id' => $id]);
        redirect('member/pesanan');
    }

    public function pesanan_detail($id)
    {
        $data['title'] = 'Detail Pesanan';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['username'] = $this->db->get_where('user', ['role_id' => 2])->row_array();
        $this->load->model('Pesanan_model', 'barang');
        $data['pesanan'] = $this->db->get_where('pesanan', ['id' => $id])->row_array();
        $idBarang = $data['pesanan']['id_barang'];
        $usernama = $data['pesanan']['username'];
        $data['barang'] = $this->barang->getBarangById($idBarang);
        $data['nama'] = $this->db->get_where('user', ['username' => $usernama])->row_array();
        if ($data['pesanan']['status'] == 1) {
            $data['lunas'] = 'Lunas';
        } else {
            $data['lunas'] = 'Belum Lunas';
        }
        $this->load->view('templates/header', $data);
        // $this->load->view('templates/member/sidebar');
        $this->load->view('templates/member/topbar', $data);
        $this->load->view('member/pesanan_detail');
        $this->load->view('templates/footer');
    }

    public function peminjaman()
    {
        $data['title'] = 'Peminjaman';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['peminjaman'] = $this->db->get_where('pesanan', ['konfirmasi' => 1, 'selesai' => 0, 'username' => $this->session->userdata('username')])->result_array();

        $this->load->view('templates/header', $data);
        // $this->load->view('templates/member/sidebar');
        $this->load->view('templates/member/topbar', $data);
        $this->load->view('member/peminjaman');
        $this->load->view('templates/footer');
    }

    public function peminjaman_detail($id)
    {
        $data['title'] = 'Peminjaman';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['peminjaman'] = $this->db->get_where('pesanan', ['id' => $id])->row_array();
        $username = $data['peminjaman']['username'];
        $data['nama'] = $this->db->get_where('user', ['username' => $username])->row_array();
        $data['barang'] = $this->db->get_where('barang', ['id' => $data['peminjaman']['id_barang']])->row_array();
        $this->load->view('templates/header', $data);
        // $this->load->view('templates/member/sidebar');
        $this->load->view('templates/member/topbar', $data);
        $this->load->view('member/peminjaman_detail');
        $this->load->view('templates/footer');
    }

    public function transaksi()
    {
        $data['title'] = 'Riwayat Transaksi';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['transaksi'] = $this->db->get_where('pesanan', ['konfirmasi' => 1, 'selesai' => 1, 'username' => $this->session->userdata('username')])->result_array();
        $this->load->view('templates/header', $data);
        // $this->load->view('templates/member/sidebar');
        $this->load->view('templates/member/topbar', $data);
        $this->load->view('member/transaksi');
        $this->load->view('templates/footer');
    }

    public function transaksi_detail($id){
        $data['title'] = 'Transaksi Detail';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['transaksi'] = $this->db->get_where('pesanan', ['id' => $id])->row_array();
        $username = $data['transaksi']['username'];
        $data['barang'] = $this->db->get_where('barang', ['id' => $data['transaksi']['id_barang']])->row_array();
        $data['nama'] = $this->db->get_where('user', ['username' => $username])->row_array();
        $this->load->view('templates/header', $data);
        // $this->load->view('templates/member/sidebar');
        $this->load->view('templates/member/topbar', $data);
        $this->load->view('member/transaksi_detail');
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

    public function ajaxBarang($kategori){
        // var_dump($keyword);die;
        $data['kategori'] = $kategori;
        $this->load->model('Member_barang', 'barang');
        $data['barang'] = $this->barang->getBarangKategori($kategori);
        $data['kategori'] = $this->barang->getKategorikategori($kategori);
        $this->load->view('ajax/kategori',$data);
    }
}
