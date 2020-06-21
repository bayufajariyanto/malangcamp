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
        $data['selecttopbar'] = $this->uri->segment(2);
        $this->db->join('barang', 'keranjang.id_barang = barang.id', 'INNER');
        $data['topkeranjang'] = $this->db->get_where('keranjang', ['username' => $this->session->userdata('username')])->result_array();
        $data['title'] = 'Profile';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('templates/header', $data);
        // $this->load->view('templates/member/sidebar');
        $this->load->view('templates/member/topbar', $data);
        $this->load->view('templates/profile', $data);
        $this->load->view('templates/footer');
    }

    public function barang(){
        $data['selecttopbar'] = $this->uri->segment(2);
        $this->db->join('barang', 'keranjang.id_barang = barang.id', 'INNER');
        $data['topkeranjang'] = $this->db->get_where('keranjang', ['username' => $this->session->userdata('username')])->result_array();
        $data['title'] = 'Barang Tersedia';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['kategori'] = $this->db->get('kategori')->result_array();
        $this->load->model('Member_barang', 'barang');
        for($i=0;$i<count($data['topkeranjang']);$i++){
            $this->db->where('id !=', $data['topkeranjang'][$i]['id_barang']);
        }
        $data['barang'] = $this->db->get('barang')->result_array();
        
        $this->load->view('templates/header', $data);
        // $this->load->view('templates/member/sidebar');
        $this->load->view('templates/member/topbar', $data);
        $this->load->view('member/barang');
        $this->load->view('templates/footer');
    }
    
    public function barangId($id){
        $data['selecttopbar'] = $this->uri->segment(2);
        $this->db->join('barang', 'keranjang.id_barang = barang.id', 'INNER');
        $data['topkeranjang'] = $this->db->get_where('keranjang', ['username' => $this->session->userdata('username')])->result_array();
        $data['title'] = 'Rincian Barang';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->model('Member_barang', 'barang');
        $data['rincian'] = $this->barang->getBarangId($id);
        $data['kategori'] = $this->db->get('kategori')->result_array();
        $data['select'] = $data['rincian']['kategori'];

        $this->load->view('templates/header', $data);
        // $this->load->view('templates/member/sidebar');
        $this->load->view('templates/member/topbar', $data);
        $this->load->view('member/barang_detail');
        $this->load->view('templates/footer');
    }

    public function kategori($kategori){
        $data['selecttopbar'] = $this->uri->segment(2);
        $kategori = rawurldecode($kategori);
        $this->db->join('barang', 'keranjang.id_barang = barang.id', 'INNER');
        $data['topkeranjang'] = $this->db->get_where('keranjang', ['username' => $this->session->userdata('username')])->result_array();
        $data['title'] = 'Barang Tersedia';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['kategori'] = $this->db->get('kategori')->result_array();
        $data['select'] = $kategori;
        // var_dump($kategori);die;
        $this->load->model('Member_barang', 'barang');
        for($i=0;$i<count($data['topkeranjang']);$i++){
            $this->db->where('id !=', $data['topkeranjang'][$i]['id_barang']);
        }
        $this->db->where('kategori', $kategori);
        $data['barang'] = $this->db->get('barang')->result_array();

        $this->load->view('templates/header', $data);
        // $this->load->view('templates/member/sidebar');
        $this->load->view('templates/member/topbar', $data);
        $this->load->view('member/barang_kategori');
        $this->load->view('templates/footer');
    }
    
    public function tambahkeranjang($id){
        $this->db->join('barang', 'keranjang.id_barang = barang.id', 'INNER');
        $data['topkeranjang'] = $this->db->get_where('keranjang', ['username' => $this->session->userdata('username')])->result_array();
        $barang = $this->db->get_where('barang', ['id' => $id])->row_array();
        $jumlah = $this->input->post('jumlah');
        $data = [
            'username' => $this->session->userdata('username'),
            'id_barang' => $barang['id'],
            'jumlah' => $jumlah
        ];
        $this->db->insert('keranjang', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menambahkan '.$barang['nama'].' ke keranjang</div>');
        redirect('member/index');
    }

    public function hapus_keranjang($id){
        $this->db->delete('keranjang', ['id' => $id]);
        redirect('member/keranjang');
    }

    public function pesanan(){
        $data['selecttopbar'] = $this->uri->segment(2);
        $this->db->join('barang', 'keranjang.id_barang = barang.id', 'INNER');
        $data['topkeranjang'] = $this->db->get_where('keranjang', ['username' => $this->session->userdata('username')])->result_array();
        $data['title'] = 'Pesanan';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->db->join('barang', 'pesanan.id_barang = barang.id', 'INNER');
        $data['pesanan'] = $this->db->get_where('pesanan', ['konfirmasi' => 0, 'username' => $this->session->userdata('username')])->result_array();
        // var_dump($data['pesanan']);die;
        $data['baris'] = $this->db->get_where('pesanan', ['konfirmasi' => 0, 'username' => $this->session->userdata('username')])->row_array();
        $total = 0;
        foreach($data['pesanan'] as $p):
            $total = $total+($p['harga']*$p['jumlah_barang']);
        endforeach;
        $data['total'] = $total;
        
        $this->load->view('templates/header', $data);
        // $this->load->view('templates/member/sidebar');
        $this->load->view('templates/member/topbar', $data);
        if($data['pesanan'] == null){
            $this->load->view('member/pesanan_kosong');
        }else{
            $this->load->view('member/pesanan', $data);
        }
        $this->load->view('templates/footer');
    }

    public function pesan($id){
        $data['jumlah'] = $this->input->post('jumlah');
        // var_dump($data['jml']);die;
        $data['selecttopbar'] = $this->uri->segment(2);
        $this->db->join('barang', 'keranjang.id_barang = barang.id', 'INNER');
        $data['topkeranjang'] = $this->db->get_where('keranjang', ['username' => $this->session->userdata('username')])->result_array();
        $data['title'] = 'Pesan';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['pesanan'] = $this->db->get_where('pesanan', ['selesai' => 0, 'username' => $this->session->userdata('username')])->result_array();
        $data['pesan'] = $this->db->get_where('barang', ['id' => $id])->row_array();
        // var_dump(count($data['pesanan']));die;
        // var_dump(count($data['pesanan']));die;
        if(count($data['pesanan'])>0){
            if($data['pesanan'][0]['status'] == 0){
                $this->pesananditolak(1);
                // redirect('pesananditolak/'.$data['pesanan'][0]['id']);
            }else if($data['pesanan'][0]['selesai'] == 0){
                $this->pesananditolak(2);
            }
        }
        $this->load->view('templates/header', $data);
        // $this->load->view('templates/member/sidebar');
        $this->load->view('templates/member/topbar', $data);
        $this->load->view('member/pesan', $data);
        $this->load->view('templates/footer');
    }

    public function pesananditolak($status){
        if($status == 1){
            // var_dump('satu');die;
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Selesaikan pembayaran pesanan anda sebelumnya!</div>');
        }else if($status == 2){
            // var_dump('dua');die;
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal tambah pesanan! Silakan kembalikan barang terlebih dahulu!</div>');
        }
        redirect('member');
    }


    public function tambahpesan($id){
        $jml = $this->input->post('jumlah');
        $hari = $this->input->post('hari');

        $barang = $this->db->get_where('barang', ['id' => $id])->row_array();
        $user = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $tanggal_order = time();
        $tanggal = date('ymdHis', $tanggal_order);
        $harga = $barang['harga'] * $jml * $hari;
        $username = strtoupper(substr($this->session->userdata('username'), 0, 3));
        $kode = $username.'-'.$tanggal.$user['id'];
        $stok = $barang['stok'] - $jml;
        $hari = 60*60*24*$hari;
        
        $datastok = [
            'stok' => $stok
        ];
        $data = [
            'kode_transaksi' => $kode,
            'username' => $this->session->userdata('username'),
            'id_barang' => $id,
            'tanggal_order' => $tanggal_order,
            // 'tanggal_sewa' => 0,
            'batas_kembali' => time()+$hari,
            'jumlah_barang' => $jml,
            'total' => $harga,
            'status' => 0
        ];
        $this->db->update('barang', $datastok, ['id' => $id]);
        $this->db->insert('pesanan', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Kamu berhasil pesan! Segera lakukan pembayaran dalam 1 jam!</div>');
        redirect('member');
    }

    public function tambahpesanan(){
        $data['pesanan'] = $this->db->get_where('pesanan', ['selesai' => 0, 'username' => $this->session->userdata('username')])->result_array();
        if(count($data['pesanan'])>0){
            if($data['pesanan'][0]['status'] == 0){
                $this->pesananditolak(1);
                // redirect('pesananditolak/'.$data['pesanan'][0]['id']);
            }else if($data['pesanan'][0]['selesai'] == 0){
                $this->pesananditolak(2);
            }
        }
        $id = $this->input->post('id');
        $jml = $this->input->post('jumlah');
        $hari = $this->input->post('hari');

        $user = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $keranjang = $this->db->get_where('keranjang', ['username' => $this->session->userdata('username')])->result_array();
        $query = "SELECT b.*,k.username FROM barang b RIGHT JOIN keranjang k ON b.id = k.id_barang WHERE k.username = '".$this->session->userdata('username')."'";
        $query = $this->db->query($query)->result_array();
        $index = 0;
        $id[] = null;
        $jumlah[] = null;
        $harga[] = null;
        $tanggal_order = time();
        $tanggal = date('ymdHis', $tanggal_order);
        foreach($query as $k) :
            $id[$index] = $k['id'];
            $kategori[$index] = strtoupper(substr($this->session->userdata('username'), 0, 3));
            $kode[$index] = $kategori[$index].'-'.$tanggal.$user['id'];
            $jumlah[$index] = $jml[$index];
            $harga = $k['harga'] * $jml[$index] * $hari;
            $stok[$index] = $k['stok'] - $jumlah[$index];
            $index++;
        endforeach;
        
        $hari = 60*60*24*$hari;
        for($i=0;$i<count($query);$i++){
            $datastok = [
                'stok' => $stok[$i]
            ];
            $data = [
                'kode_transaksi' => $kode[$i],
                'username' => $this->session->userdata('username'),
                'id_barang' => $id[$i],
                'tanggal_order' => $tanggal_order,
                // 'tanggal_sewa' => 0,
                'batas_kembali' => time()+$hari,
                'jumlah_barang' => $jumlah[$i],
                'total' => $harga,
                'status' => 0
            ];
            $this->db->update('barang', $datastok, ['id' => $id[$i]]);
            $this->db->insert('pesanan', $data);
        }
        $this->db->delete('keranjang', ['username' => $this->session->userdata('username')]);
        $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Kamu berhasil pesan! Segera lakukan pembayaran dalam 1 jam!</div>');
        redirect('member/keranjang');
    }
    
    public function keranjang(){
        $data['selecttopbar'] = $this->uri->segment(2);
        $this->db->join('barang', 'keranjang.id_barang = barang.id', 'INNER');
        $data['topkeranjang'] = $this->db->get_where('keranjang', ['username' => $this->session->userdata('username')])->result_array();
        $data['title'] = 'Keranjang';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->db->select('keranjang.*,barang.nama,barang.kategori,barang.harga,barang.stok');
        $this->db->join('barang', 'keranjang.id_barang = barang.id', 'LEFT');
        $data['keranjang'] = $this->db->get_where('keranjang', ['username' => $this->session->userdata('username')])->result_array();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/member/topbar', $data);
        if($data['keranjang'] == null){
            $this->load->view('member/keranjang_kosong');
        }else{
            $this->load->view('member/keranjang');
        }
        $this->load->view('templates/footer');
    }
    
    public function pesanandua(){
        $data['selecttopbar'] = $this->uri->segment(2);
        $this->db->join('barang', 'keranjang.id_barang = barang.id', 'INNER');
        $data['topkeranjang'] = $this->db->get_where('keranjang', ['username' => $this->session->userdata('username')])->result_array();
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
        $this->db->join('barang', 'keranjang.id_barang = barang.id', 'INNER');
        $data['topkeranjang'] = $this->db->get_where('keranjang', ['username' => $this->session->userdata('username')])->result_array();
        $pesanan = $this->db->get_where('pesanan', ['id' => $id])->row_array();
        $jumlah = $pesanan['jumlah_barang'];
        $barang = $this->db->get_where('barang', ['id' => $pesanan['id_barang']])->row_array();
        $jumlah = $barang['stok']+$jumlah;
        $data = [
            'stok' => $jumlah
        ];
        $this->db->update('barang', $data, ['id' => $pesanan['id_barang']]);
        $this->db->delete('pesanan', ['id' => $id]);
        redirect('member');
    }

    public function pesanan_detail($id)
    {
        $data['selecttopbar'] = $this->uri->segment(2);
        $this->db->join('barang', 'keranjang.id_barang = barang.id', 'INNER');
        $data['topkeranjang'] = $this->db->get_where('keranjang', ['username' => $this->session->userdata('username')])->result_array();
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
        $data['selecttopbar'] = $this->uri->segment(2);
        $this->db->join('barang', 'keranjang.id_barang = barang.id', 'INNER');
        $data['topkeranjang'] = $this->db->get_where('keranjang', ['username' => $this->session->userdata('username')])->result_array();
        $data['title'] = 'Sedang Disewa';
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
        $data['selecttopbar'] = $this->uri->segment(2);
        $this->db->join('barang', 'keranjang.id_barang = barang.id', 'INNER');
        $data['topkeranjang'] = $this->db->get_where('keranjang', ['username' => $this->session->userdata('username')])->result_array();
        $data['title'] = 'Sedang Disewa';
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
        $data['selecttopbar'] = $this->uri->segment(2);
        $this->db->join('barang', 'keranjang.id_barang = barang.id', 'INNER');
        $data['topkeranjang'] = $this->db->get_where('keranjang', ['username' => $this->session->userdata('username')])->result_array();
        $data['title'] = 'Transaksi';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['transaksi'] = $this->db->get_where('pesanan', ['konfirmasi' => 1, 'selesai' => 1, 'username' => $this->session->userdata('username')])->result_array();
        $this->load->view('templates/header', $data);
        // $this->load->view('templates/member/sidebar');
        $this->load->view('templates/member/topbar', $data);
        $this->load->view('member/transaksi');
        $this->load->view('templates/footer');
    }

    public function transaksi_detail($id){
        $data['selecttopbar'] = $this->uri->segment(2);
        $this->db->join('barang', 'keranjang.id_barang = barang.id', 'INNER');
        $data['topkeranjang'] = $this->db->get_where('keranjang', ['username' => $this->session->userdata('username')])->result_array();
        $data['title'] = 'Detail Transaksi';
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
        $this->db->join('barang', 'keranjang.id_barang = barang.id', 'INNER');
        $data['topkeranjang'] = $this->db->get_where('keranjang', ['username' => $this->session->userdata('username')])->result_array();
        $data['keyword'] = $keyword;
        $this->load->model('Pesanan_model', 'barang');
        $data['barang'] = $this->barang->getBarangByKeyword($keyword);
        $data['kategori'] = $this->barang->getKategoriByKeyword($keyword);
        $this->load->view('ajax/index',$data);
    }
}
