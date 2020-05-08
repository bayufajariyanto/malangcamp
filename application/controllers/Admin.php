<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role_id') == 2) {
            redirect('member');
        } else if ($this->session->userdata('role_id') == null) {
            redirect('auth');
        }
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $this->member();
    }

    public function profile()
    {
        $data['title'] = 'Profile';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/profile', $data);
        $this->load->view('templates/footer');
    }

    public function member()
    {
        $data['title'] = 'Member';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['member'] = $this->db->get_where('user', ['role_id' => 2])->result_array();
        $username = strtolower($this->input->post('username'));
        $password = $this->input->post('password1');
        $nama = ucwords($this->input->post('nama'));
        $no_kitas = $this->input->post('nokitas');
        $jenis_kitas = $this->input->post('kitas');
        $alamat = ucfirst($this->input->post('alamat'));
        $telp = $this->input->post('telp');

        if ($this->form_validation->run('member') == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/member');
            $this->load->view('templates/footer');
        } else {
            $data = [
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'nama' => $nama,
                'no_kitas' => $no_kitas,
                'jenis_kitas' => $jenis_kitas,
                'alamat' => $alamat,
                'telp' => $telp,
                'date_created' => time(),
                'role_id' => 2,
            ];
            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Member baru berhasil ditambahkan!</div>');
            redirect('admin/member');
        }
    }

    public function member_detail($id)
    {
        $data['title'] = 'Detail Member';

        $data['user'] = $this->db->get_where('user', ['id' => $id])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/member_detail');
        $this->load->view('templates/footer');
    }

    public function member_edit($id)
    {
        $data['title'] = 'Edit Member';

        $data['user'] = $this->db->get_where('user', ['id' => $id])->row_array();

        $username = strtolower($this->input->post('username'));
        $password = $this->input->post('password1');
        $nama = ucwords($this->input->post('nama'));
        $no_kitas = $this->input->post('nokitas');
        $jenis_kitas = $this->input->post('kitas');
        $alamat = ucfirst($this->input->post('alamat'));
        $telp = $this->input->post('telp');

        if ($username != $data['user']['username']) {
            $unikuser = '|is_unique[user.username]';
        } else {
            $unikuser = '';
        }
        if ($telp != $data['user']['telp']) {
            $uniktelp = 'is_unique[user.telp]';
        } else {
            $uniktelp = '';
        }

        $this->form_validation->set_rules(
            'username',
            'Username',
            'trim|required|min_length[4]|max_length[25]|alpha_dash' . $unikuser,
            [
                'required' => '%s harus diisi',
                'min_length' => '%s tidak kurang dari 4 karakter',
                'max_length' => '%s tidak lebih dari 25 karakter',
                'is_unique' => '%s telah dipakai, silakan gunakan yang lain',
                'alpha_dash' => '%s hanya menggunakan huruf, underscore, atau angka'
            ]
        );
        $this->form_validation->set_rules(
            'telp',
            'Nomor Telepon',
            'trim|required|min_length[3]|max_length[12]|integer' . $uniktelp,
            [
                'required' => '%s harus diisi',
                'min_length' => '%s tidak kurang dari 3 angka',
                'max_length' => '%s tidak lebih dari 12 angka',
                'integer' => '%s harus angka',
                'is_unique' => '%s sudah ada silakan gunakan yang lain'
            ]
        );
        if ($this->form_validation->run('member_edit') == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/member_edit');
            $this->load->view('templates/footer');
        } else {

            $data = [
                'username' => $username,
                // 'password' => password_hash($password, PASSWORD_DEFAULT),
                'nama' => $nama,
                'no_kitas' => $no_kitas,
                'jenis_kitas' => $jenis_kitas,
                'alamat' => $alamat,
                'telp' => $telp
            ];
            $this->db->update('user', $data, ['id' => $id]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Member
            ' . $data['user']['username'] . ' berhasil diubah!</div>');
            redirect('admin/member');
        }
    }

    public function member_hapus($id)
    {
        $data['user'] = $this->db->get_where('user', ['id' => $id])->row_array();
        $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Member ' . $data['user']['username'] . ' berhasil dihapus!</div>');
        $this->db->delete('user', array('id' => $id));
        redirect('admin/member');
    }

    // Barang
    public function barang()
    {
        $data['title'] = 'Barang';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['barang'] = $this->db->get('barang')->result_array();
        $data['kategori'] = $this->db->get('kategori')->result_array();
        
        $nama = ucwords($this->input->post('nama'));
        $kategori = $this->input->post('kategori');
        $stok = $this->input->post('stok');
        $harga = $this->input->post('harga');

        if ($this->form_validation->run('barang') == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/barang');
            $this->load->view('templates/footer');
        } else {
            $data = [
                'nama' => $nama,
                'kategori' => $kategori,
                'stok' => $stok,
                'harga' => $harga
            ];
            $this->db->insert('barang', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Barang baru berhasil ditambahkan!</div>');
            redirect('admin/barang');
        }
    }

    public function barang_edit($id)
    {
        $data['title'] = 'Edit Barang';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['barang'] = $this->db->get_where('barang', ['id' => $id])->row_array();

        $nama = $this->input->post('nama');
        $kategori = $this->input->post('kategori');
        $stok = $this->input->post('stok');
        $harga = $this->input->post('harga');
        if ($this->form_validation->run('barang_edit') == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/barang_edit');
            $this->load->view('templates/footer');
        } else {
            $data = [
                'nama' => $nama,
                'kategori' => $kategori,
                'harga' => $harga,
                'stok' => $stok
            ];
            $this->db->update('barang', $data, ['id' => $id]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Barang ' . $nama . ' berhasil diubah!</div>');
            redirect('admin/barang');
        }
    }

    public function barang_hapus($id)
    {
        $data['barang'] = $this->db->get_where('barang', ['id' => $id])->row_array();
        $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Barang ' . $data['barang']['nama'] . ' berhasil dihapus!</div>');
        $this->db->delete('barang', ['id' => $id]);
        redirect('admin/barang');
    }

    public function pesanan()
    {
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
        $username = $this->input->post('username');
        $id_barang = $this->input->post('barang');
        $jumlah = $this->input->post('jumlah');
        $status = $this->input->post('status');
        $hari = $this->input->post('hari');
        $tsewa = $this->input->post('sewa');
        $barang = $this->db->get_where('barang', ['id' => $id_barang])->row_array();
        $tbayar = 0;
        
        // hapus pesanan ketika sudah melewati 1 jam
        $sejam = 60*60;
        foreach($pesanan as $p):
            $order = $p['tanggal_order'] + $sejam;
            if($order<time()){
                $url = base_url('admin/pesanan_batal/'.$p['id']);
                redirect($url);
            }
        endforeach;
        // var_dump($data['pesanan']);die;

        if ($this->form_validation->run('pesanan') == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/pesanan');
            $this->load->view('templates/footer');
        } else {
            $harga = $barang['harga'] * $jumlah;
            $sewa = explode(":",$tsewa);
            $jam = (int) $sewa[0];
            $menit = (int) $sewa[1];
            // Pembuatan Kode Transaksi
            $kategori = strtoupper(substr($barang['kategori'], 0, 3));
            $tanggal = date('Ymd', time());
            $angka = 1;
            if($status == 1){
                $tbayar = time();
            }else{
                $tbayar = 0;
            }

            if ($angka < 10) {
                $kode = $kategori . '-' . $tanggal . "000" . $angka;
            } else if ($angka < 1000) {
                $kode = $kategori . '-' . $tanggal . "00" . $angka;
            } else if ($angka < 1000) {
                $kode = $kategori . '-' . $tanggal . "0" . $angka;
            } else {
                $kode = $kategori . '-' . $tanggal . $angka;
            }
            foreach ($data['pesanan'] as $p) :
                $b = 'masuk';
                if ($kode == $p['kode_transaksi']) {
                    $a = 'benar';
                    $angka++;
                    if ($angka < 10) {
                        $kode = $kategori . '-' . $tanggal . "000" . $angka;
                    } else if ($angka < 100) {
                        $kode = $kategori . '-' . $tanggal . "00" . $angka;
                    } else if ($angka < 1000) {
                        $kode = $kategori . '-' . $tanggal . "0" . $angka;
                    } else {
                        $kode = $kategori . '-' . $tanggal . $angka;
                    }
                } else {
                    // $a = 'salah';
                    break;
                }
            endforeach;
            // var_dump($barang['stok']);die;
            // Akhir kode transaksi
            $jam_sewa = mktime($jam,$menit,(int)date('s'),(int)date('m'),(int)date('d'),(int)date('Y'));
            $jam_kembali = $jam_sewa+(60*60*24*$hari);
            $total = $barang['harga'];
            if($id_barang == null){
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Pilih barang yang mau disewa!</div>');
                redirect('admin/pesanan');
            }else
            if ($barang['stok'] < $jumlah) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Jumlah melebihi batas, stok hanya ' . $barang['stok'] . ' </div>');
                redirect('admin/pesanan');
            } else {
                $stok = $barang['stok'] - $jumlah;
                $data = [
                    'stok' => $stok
                ];
                $pesanan = [
                    'kode_transaksi' => $kode,
                    'username' => $username,
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
            redirect('admin/pesanan');
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
        redirect('admin/pesanan');
    }
    public function pesanan_konfirmasi($id)
    {
        $data = [
            'tanggal_bayar' => time(),
            'status' => 1,
            'konfirmasi' => 1
        ];
        $this->db->update('pesanan', $data, ['id' => $id]);
        redirect('admin/pesanan');
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
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/pesanan_detail');
        $this->load->view('templates/footer');
    }

    public function peminjaman()
    {
        $data['title'] = 'Peminjaman';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['peminjaman'] = $this->db->get_where('pesanan', ['konfirmasi' => 1, 'selesai' => 0])->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/peminjaman');
        $this->load->view('templates/footer');
    }

    public function peminjaman_detail($id)
    {
        $data['title'] = 'Peminjaman';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['peminjaman'] = $this->db->get_where('pesanan', ['id' => $id])->row_array();
        $username = $data['peminjaman']['username'];
        $data['nama'] = $this->db->get_where('user', ['username' => $username])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/peminjaman_detail');
        $this->load->view('templates/footer');
    }

    public function peminjaman_selesai($id)
    {
        $peminjaman = $this->db->get_where('pesanan', ['id' => $id])->row_array();
        $sehari = 60*60*24;
        if($peminjaman['batas_kembali']< time()){
            $hariTerlambat = (int)ceil((time()-$peminjaman['batas_kembali'])/$sehari);
            $batas = '<strong class="text-danger">(Terlambat '.$hariTerlambat.' hari)</strong>';
            $denda = ($peminjaman['total']*$hariTerlambat);
            // $total = $denda+$peminjaman['total'];
            // var_dump();die;
          }else{
            $batas = '(Belum Terlambat)';
            $denda = 0;
          }
        // var_dump($denda);die;
        $data = [
            'denda' => $denda,
            'tanggal_kembali' => time(),
            'selesai' => 1
        ];
        $this->db->update('pesanan', $data, ['id' => $id]);
        redirect('admin/peminjaman');
    }

    public function transaksi()
    {
        $data['title'] = 'Transaksi';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['transaksi'] = $this->db->get_where('pesanan', ['konfirmasi' => 1, 'selesai' => 1])->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/transaksi');
        $this->load->view('templates/footer');
    }

    public function transaksi_detail($id){
        $data['title'] = 'Transaksi Detail';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['transaksi'] = $this->db->get_where('pesanan', ['id' => $id])->row_array();
        $username = $data['transaksi']['username'];
        $data['nama'] = $this->db->get_where('user', ['username' => $username])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/transaksi_detail');
        $this->load->view('templates/footer');
    }

    public function kode_transaksi(){
        $data['pesanan']=$this->db->get('pesanan')->result_array();
        $kategori = $this->input->post('kategori');
        $this->form_validation->set_rules('kategori', 'Kategori','required');
        if($this->form_validation->run() == false){
            
            $this->load->view('kode',$data);
        }else{
            $kode = $kategori."-".date("Ymd");
            $dt = [
                'kode' => $kode
            ];
            $this->db->insert('kode_transaksi', $dt);
            $urut = (int)substr($kode, -4,4);
            if($urut<10){
                echo "urut kurang dari 10";
            }else if($urut<100){
                echo "urut kurang dari 100";
                
            }else if($urut<1000){
                echo "urut kurang dari 1000";
                
            }else if($urut<10000){
                echo "urut kurang dari 10000";

            }

            var_dump($dt);
            $this->load->view('kode',$data);

            // redirect('admin/kode_transaksi');
        }
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
