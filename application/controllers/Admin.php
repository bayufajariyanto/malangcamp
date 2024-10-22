<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['select'] = $this->uri->segment(2);
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['member'] = $this->db->get_where('user', ['role_id' => 2])->result_array();
        $data['disewa'] = $this->db->get_where('pesanan', ['konfirmasi' => 1, 'selesai' => 0])->result_array();
        $this->db->order_by('tanggal_bayar', 'DESC');
        $data['pesanan'] = $this->db->get_where('pesanan', ['konfirmasi' => 1])->result_array();

        $data['hari_ini'] = $this->_hariIni();
        $data['bulan_ini'] = $this->_bulanIni(date('m'));
        $data['januari'] = $this->_bulanIni(1);
        $data['februari'] = $this->_bulanIni(2);
        $data['maret'] = $this->_bulanIni(3);
        $data['april'] = $this->_bulanIni(4);
        $data['mei'] = $this->_bulanIni(5);
        $data['juni'] = $this->_bulanIni(6);
        $data['juli'] = $this->_bulanIni(7);
        $data['agustus'] = $this->_bulanIni(8);
        $data['september'] = $this->_bulanIni(9);
        $data['oktober'] = $this->_bulanIni(10);
        $data['november'] = $this->_bulanIni(11);
        $data['desember'] = $this->_bulanIni(12);

        $data['sewa'] = $this->_sewa();
        $data['denda'] = $this->_denda();
        $data['todaydenda'] = $this->_todayDenda();


        // Pengeluaran
        $data['gaji'] = $this->_gaji();
        $data['perawatan'] = $this->_perawatan();
        $data['lainnya'] = $this->_lainnya();
        // var_dump($data['perawatan']);die;
        $this->load->model('Index_model', 'index');
        $this->db->order_by('tanggal', 'DESC');
        $data['pengeluaran'] = $this->db->get('pengeluaran')->result_array();
        $data['pengeluaran_hari_ini'] = $this->_pengeluaranHariIni();
        $data['pengeluaran_bulan_ini'] = $this->_pengeluaranBulanIni(date('m'));
        $data['pengeluaran_januari'] = $this->_pengeluaranBulanIni(1);
        $data['pengeluaran_februari'] = $this->_pengeluaranBulanIni(2);
        $data['pengeluaran_maret'] = $this->_pengeluaranBulanIni(3);
        $data['pengeluaran_april'] = $this->_pengeluaranBulanIni(4);
        $data['pengeluaran_mei'] = $this->_pengeluaranBulanIni(5);
        $data['pengeluaran_juni'] = $this->_pengeluaranBulanIni(6);
        $data['pengeluaran_juli'] = $this->_pengeluaranBulanIni(7);
        $data['pengeluaran_agustus'] = $this->_pengeluaranBulanIni(8);
        $data['pengeluaran_september'] = $this->_pengeluaranBulanIni(9);
        $data['pengeluaran_oktober'] = $this->_pengeluaranBulanIni(10);
        $data['pengeluaran_november'] = $this->_pengeluaranBulanIni(11);
        $data['pengeluaran_desember'] = $this->_pengeluaranBulanIni(12);
        // var_dump($data['pengeluaran_mei']);die;
        $data['karyawan'] = $this->_pengeluaranByKategori('Gaji');
        // $data['perawatan'] = $this->_pengeluaranByKategori('Perawatan');
        $data['kategori_pengeluaran'] = [
            [
                'nama' => 'Gaji'
            ],
            [
                'nama' => 'Perawatan'
            ],
            [
                'nama' => 'Lainnya'
            ]

        ];

        $nama = ucwords($this->input->post('nama'));
        $kategori = $this->input->post('kategori');
        $nominal = $this->input->post('nominal');


        if ($this->form_validation->run('pengeluaran') == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/pendapatan', $data);
            $this->load->view('admin/pengeluaran', $data);
            $this->load->view('templates/footer');
            $this->load->view('other/pendapatan');
            $this->load->view('other/pengeluaran');
            $this->load->view('other/chart-area');
            $this->load->view('other/chart-area-pengeluaran', $data);
            $this->load->view('other/chart-pie');
            $this->load->view('other/chart-pie-pengeluaran');
        } else {
            $data = [
                'nama' => $nama,
                'tanggal' => time(),
                'kategori' => $kategori,
                'nominal' => $nominal
            ];
            $this->db->insert('pengeluaran', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data pengeluaran baru berhasil ditambahkan!</div>');
            redirect('admin');
        }
    }

    public function pengeluaran()
    {
        $this->load->model('Index_model', 'index');
        $data['pengeluaran'] = $this->db->get('pengeluaran')->result_array();
        // $data['pengeluaran_hari_ini'] = $this->_pengeluaranHariIni();
        // $data['pengeluaran_bulan_ini'] = $this->_pengeluaranBulanIni(date('m'));

        $data['kategori_pengeluaran'] = [
            [
                'nama' => 'Gaji'
            ],
            [
                'nama' => 'Perawatan'
            ],
            [
                'nama' => 'Lainnya'
            ]

        ];

        $nama = ucwords($this->input->post('nama'));
        $kategori = $this->input->post('kategori');
        $nominal = $this->input->post('nominal');

        if ($this->form_validation->run('pengeluaran') == false) {
            $this->load->view('admin/pengeluaran', $data);
        } else {
            $data = [
                'nama' => $nama,
                'tanggal' => time(),
                'kategori' => $kategori,
                'nominal' => $nominal
            ];
            $this->db->insert('pengeluaran', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data pengeluaran baru berhasil ditambahkan!</div>');
            redirect('admin');
        }
    }

    private function _pengeluaranByKategori($kategori)
    {
        $this->load->model('Index_model', 'index');
        $kategori = $this->index->getPengeluaranByKategori($kategori);
        $total = 0;
        foreach ($kategori as $k) {
            $total = $total + $k['nominal'];
        }
        return $total;
    }

    private function _pengeluaranHariIni()
    {
        $this->load->model('Index_model', 'index');
        $awalHari = mktime(0, 0, 0, (int) date('m'), (int) date('d'), (int) date('Y'));
        $akhirHari = mktime(23, 59, 59, (int) date('m'), (int) date('d'), (int) date('Y'));
        $hariIni = $this->index->getPengeluaranToday($awalHari, $akhirHari);
        $total = 0;
        foreach ($hariIni as $hi) {
            $total = $total + $hi['nominal'];
        }
        return $total;
    }

    private function _pengeluaranBulanIni($bulan)
    {
        $this->load->model('Index_model', 'index');
        $awalBulan = mktime(0, 0, 0, (int) $bulan, 1, (int) date('Y'));
        $akhirBulan = mktime(23, 59, 59, (int) $bulan, (int) $this->_lastOfMonth((int) date('Y'), (int) $bulan), (int) date('Y'));
        $bulanIni = $this->index->getPengeluaranThisMonth($awalBulan, $akhirBulan);
        $total = 0;
        foreach ($bulanIni as $bi) {
            $total = $total + $bi['nominal'];
        }
        if ($bulan > (int) date('m')) {
            $total = null;
        }
        return $total;
    }

    private function _sewa()
    {
        $this->load->model('Index_model', 'index');
        $awalTahun = mktime(0, 0, 0, 1, 1, (int) date('Y'));
        $akhirTahun = mktime(23, 59, 59, 12, 31, (int) date('Y'));
        $sewa = $this->index->getThisMonth($awalTahun, $akhirTahun);
        $total = 0;
        foreach ($sewa as $s) :
            $total = $total + $s['total'];
        endforeach;
        return $total;
    }

    private function _todayDenda()
    {
        $this->load->model('Index_model', 'index');
        $awalTahun = mktime(0, 0, 0, (int) date('m'), (int) date('d'), (int) date('Y'));
        $akhirTahun = mktime(23, 59, 59, (int) date('m'), (int) date('d'), (int) date('Y'));
        $denda = $this->index->getTodayDenda($awalTahun, $akhirTahun);
        $total = 0;
        foreach ($denda as $d) :
            $total = $total + $d['denda'];
        endforeach;
        return $total;
    }

    private function _denda()
    {
        $this->load->model('Index_model', 'index');
        $awalTahun = mktime(0, 0, 0, 1, 1, (int) date('Y'));
        $akhirTahun = mktime(23, 59, 59, 12, 31, (int) date('Y'));
        $denda = $this->index->getThisMonth($awalTahun, $akhirTahun);
        $total = 0;
        foreach ($denda as $d) :
            $total = $total + $d['denda'];
        endforeach;
        return $total;
    }

    private function _gaji()
    {
        $this->load->model('Index_model', 'index');
        $awalTahun = mktime(0, 0, 0, (int) date('m'), 1, (int) date('Y'));
        $akhirTahun = mktime(23, 59, 59, (int) date('m'), (int) date('t'), (int) date('Y'));
        $gaji = $this->index->getPengeluaranByKategoriThisMonth('Gaji', $awalTahun, $akhirTahun);
        $total = 0;
        foreach ($gaji as $g) :
            $total = $total + $g['nominal'];
        endforeach;
        return $total;
    }

    private function _perawatan()
    {
        $this->load->model('Index_model', 'index');
        $awalTahun = mktime(0, 0, 0, (int) date('m'), 1, (int) date('Y'));
        $akhirTahun = mktime(23, 59, 59, (int) date('m'), (int) date('t'), (int) date('Y'));
        $perawatan = $this->index->getPengeluaranByKategoriThisMonth('Perawatan', $awalTahun, $akhirTahun);
        $total = 0;
        foreach ($perawatan as $g) :
            $total = $total + $g['nominal'];
        endforeach;
        return $total;
    }

    private function _lainnya()
    {
        $this->load->model('Index_model', 'index');
        $awalTahun = mktime(0, 0, 0, 1, 1, (int) date('Y'));
        $akhirTahun = mktime(23, 59, 59, 12, 31, (int) date('Y'));
        $lainnya = $this->index->getPengeluaranByKategoriThisMonth('Lainnya', $awalTahun, $akhirTahun);
        $total = 0;
        foreach ($lainnya as $g) :
            $total = $total + $g['nominal'];
        endforeach;
        return $total;
    }

    private function _hariIni()
    {
        $this->load->model('Index_model', 'index');
        $awalHari = mktime(0, 0, 0, (int) date('m'), (int) date('d'), (int) date('Y'));
        $akhirHari = mktime(23, 59, 59, (int) date('m'), (int) date('d'), (int) date('Y'));
        $hariIni = $this->index->getToday($awalHari, $akhirHari);
        $dendaHariIni = $this->index->getTodayDenda($awalHari, $akhirHari);
        $total = 0;
        $totaldhi = 0;
        foreach ($hariIni as $hi) {
            $total = $total + $hi['total'];
        }
        foreach ($dendaHariIni as $dhi) {
            $totaldhi = $totaldhi + $dhi['total'];
        }
        $total = $total + $totaldhi;
        return $total;
    }

    private function _lastOfMonth($year, $month)
    {
        return date("d", strtotime('-1 second', strtotime('+1 month', strtotime($month . '/01/' . $year . ' 00:00:00'))));
    }

    private function _bulanIni($bulan)
    {
        $this->load->model('Index_model', 'index');
        $awalBulan = mktime(0, 0, 0, (int) $bulan, 1, (int) date('Y'));
        $akhirBulan = mktime(23, 59, 59, (int) $bulan, (int) $this->_lastOfMonth((int) date('Y'), (int) $bulan), (int) date('Y'));
        $bulanIni = $this->index->getThisMonth($awalBulan, $akhirBulan);
        $dendaBulanIni = $this->index->getThisMonthDenda($awalBulan, $akhirBulan);
        $total = 0;
        $totaldbi = 0;
        foreach ($bulanIni as $bi) {
            $total = $total + $bi['total'];
        }
        foreach ($dendaBulanIni as $dbi) {
            $totaldbi = $totaldbi + $dbi['denda'];
        }

        $total = $total + $totaldbi;
        if ($bulan > (int) date('m')) {
            $total = null;
        }
        return $total;
    }

    private function _annual()
    {
        $this->load->model('Index_model', 'index');
        $awalJanuari = mktime(0, 0, 0, 1, 1, (int) date('Y'));
        $akhirJanuari = mktime(23, 59, 59, 1, (int) date('t'), (int) date('Y'));
        $bulanJanuari = $this->index->getThisMonth($awalJanuari, $akhirJanuari);
        $dendaBulanJanuari = $this->index->getThisMonthDenda($awalJanuari, $akhirJanuari);
        $total = 0;
        $totaldbi = 0;
        foreach ($bulanJanuari as $bi) {
            $total = $total + $bi['total'];
        }
        foreach ($dendaBulanJanuari as $dbi) {
            $totaldbi = $totaldbi + $dbi['denda'];
        }
        $januari = $total + $totaldbi;

        $awalFebruari = mktime(0, 0, 0, 2, 1, (int) date('Y'));
        $akhirFebruari = mktime(23, 59, 59, 2, (int) date('t'), (int) date('Y'));
        $bulanFebruari = $this->index->getThisMonth($awalFebruari, $akhirFebruari);
        $dendaBulanFebruari = $this->index->getThisMonthDenda($awalFebruari, $akhirFebruari);
        $total = 0;
        $totaldbi = 0;
        foreach ($bulanFebruari as $bi) {
            $total = $total + $bi['total'];
        }
        foreach ($dendaBulanFebruari as $dbi) {
            $totaldbi = $totaldbi + $dbi['denda'];
        }
        $februari = $total + $totaldbi;

        $awalMaret = mktime(0, 0, 0, 3, 1, (int) date('Y'));
        $akhirMaret = mktime(23, 59, 59, 3, (int) date('t'), (int) date('Y'));
        $bulanMaret = $this->index->getThisMonth($awalMaret, $akhirMaret);
        $dendaBulanMaret = $this->index->getThisMonthDenda($awalMaret, $akhirMaret);
        $total = 0;
        $totaldbi = 0;
        foreach ($bulanMaret as $bi) {
            $total = $total + $bi['total'];
        }
        foreach ($dendaBulanMaret as $dbi) {
            $totaldbi = $totaldbi + $dbi['denda'];
        }
        $maret = $total + $totaldbi;

        $awalApril = mktime(0, 0, 0, 4, 1, (int) date('Y'));
        $akhirApril = mktime(23, 59, 59, 4, (int) date('t'), (int) date('Y'));
        $bulanApril = $this->index->getThisMonth($awalApril, $akhirApril);
        $dendaBulanApril = $this->index->getThisMonthDenda($awalApril, $akhirApril);
        $total = 0;
        $totaldbi = 0;
        foreach ($bulanApril as $bi) {
            $total = $total + $bi['total'];
        }
        foreach ($dendaBulanApril as $dbi) {
            $totaldbi = $totaldbi + $dbi['denda'];
        }
        $april = $total + $totaldbi;

        $awalMei = mktime(0, 0, 0, 5, 1, (int) date('Y'));
        $akhirMei = mktime(23, 59, 59, 5, (int) date('t'), (int) date('Y'));
        $bulanMei = $this->index->getThisMonth($awalMei, $akhirMei);
        $dendaBulanMei = $this->index->getThisMonthDenda($awalMei, $akhirMei);
        $total = 0;
        $totaldbi = 0;
        foreach ($bulanMei as $bi) {
            $total = $total + $bi['total'];
        }
        foreach ($dendaBulanMei as $dbi) {
            $totaldbi = $totaldbi + $dbi['denda'];
        }
        $mei = $total + $totaldbi;

        $awalJuni = mktime(0, 0, 0, 6, 1, (int) date('Y'));
        $akhirJuni = mktime(23, 59, 59, 6, (int) date('t'), (int) date('Y'));
        $bulanJuni = $this->index->getThisMonth($awalJuni, $akhirJuni);
        $dendaBulanJuni = $this->index->getThisMonthDenda($awalJuni, $akhirJuni);
        $total = 0;
        $totaldbi = 0;
        foreach ($bulanJuni as $bi) {
            $total = $total + $bi['total'];
        }
        foreach ($dendaBulanJuni as $dbi) {
            $totaldbi = $totaldbi + $dbi['denda'];
        }
        $juni = $total + $totaldbi;

        $awalJuli = mktime(0, 0, 0, 6, 1, (int) date('Y'));
        $akhirJuli = mktime(23, 59, 59, 6, (int) date('t'), (int) date('Y'));
        $bulanJuli = $this->index->getThisMonth($awalJuli, $akhirJuli);
        $dendaBulanJuli = $this->index->getThisMonthDenda($awalJuli, $akhirJuli);
        $total = 0;
        $totaldbi = 0;
        foreach ($bulanJuli as $bi) {
            $total = $total + $bi['total'];
        }
        foreach ($dendaBulanJuli as $dbi) {
            $totaldbi = $totaldbi + $dbi['denda'];
        }
        $juli = $total + $totaldbi;

        $awalAgustus = mktime(0, 0, 0, 8, 1, (int) date('Y'));
        $akhirAgustus = mktime(23, 59, 59, 8, (int) date('t'), (int) date('Y'));
        $bulanAgustus = $this->index->getThisMonth($awalAgustus, $akhirAgustus);
        $dendaBulanAgustus = $this->index->getThisMonthDenda($awalAgustus, $akhirAgustus);
        $total = 0;
        $totaldbi = 0;
        foreach ($bulanAgustus as $bi) {
            $total = $total + $bi['total'];
        }
        foreach ($dendaBulanAgustus as $dbi) {
            $totaldbi = $totaldbi + $dbi['denda'];
        }
        $agustus = $total + $totaldbi;

        $awalSeptember = mktime(0, 0, 0, 9, 1, (int) date('Y'));
        $akhirSeptember = mktime(23, 59, 59, 9, (int) date('t'), (int) date('Y'));
        $bulanSeptember = $this->index->getThisMonth($awalSeptember, $akhirSeptember);
        $dendaBulanSeptember = $this->index->getThisMonthDenda($awalSeptember, $akhirSeptember);
        $total = 0;
        $totaldbi = 0;
        foreach ($bulanSeptember as $bi) {
            $total = $total + $bi['total'];
        }
        foreach ($dendaBulanSeptember as $dbi) {
            $totaldbi = $totaldbi + $dbi['denda'];
        }
        $september = $total + $totaldbi;

        $awalOktober = mktime(0, 0, 0, 10, 1, (int) date('Y'));
        $akhirOktober = mktime(23, 59, 59, 10, (int) date('t'), (int) date('Y'));
        $bulanOktober = $this->index->getThisMonth($awalOktober, $akhirOktober);
        $dendaBulanOktober = $this->index->getThisMonthDenda($awalOktober, $akhirOktober);
        $total = 0;
        $totaldbi = 0;
        foreach ($bulanOktober as $bi) {
            $total = $total + $bi['total'];
        }
        foreach ($dendaBulanOktober as $dbi) {
            $totaldbi = $totaldbi + $dbi['denda'];
        }
        $oktober = $total + $totaldbi;

        $awalNovember = mktime(0, 0, 0, 11, 1, (int) date('Y'));
        $akhirNovember = mktime(23, 59, 59, 11, (int) date('t'), (int) date('Y'));
        $bulanNovember = $this->index->getThisMonth($awalNovember, $akhirNovember);
        $dendaBulanNovember = $this->index->getThisMonthDenda($awalNovember, $akhirNovember);
        $total = 0;
        $totaldbi = 0;
        foreach ($bulanNovember as $bi) {
            $total = $total + $bi['total'];
        }
        foreach ($dendaBulanNovember as $dbi) {
            $totaldbi = $totaldbi + $dbi['denda'];
        }
        $november = $total + $totaldbi;

        $awalDesember = mktime(0, 0, 0, 12, 1, (int) date('Y'));
        $akhirDesember = mktime(23, 59, 59, 12, (int) date('t'), (int) date('Y'));
        $bulanDesember = $this->index->getThisMonth($awalDesember, $akhirDesember);
        $dendaBulanDesember = $this->index->getThisMonthDenda($awalDesember, $akhirDesember);
        $total = 0;
        $totaldbi = 0;
        foreach ($bulanDesember as $bi) {
            $total = $total + $bi['total'];
        }
        foreach ($dendaBulanDesember as $dbi) {
            $totaldbi = $totaldbi + $dbi['denda'];
        }
        $desember = $total + $totaldbi;

        return $total = $januari + $februari + $maret + $april + $mei + $juni + $juli + $agustus + $september + $oktober + $november + $desember;
    }

    public function profile()
    {
        $data['select'] = $this->uri->segment(2);
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
        $data['select'] = $this->uri->segment(2);
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
        $data['select'] = 'member';
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
        $data['select'] = $this->uri->segment(2);
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
            $user = $this->db->get_where('user', ['id' => $id])->row_array();
            $datapesanan = [
                'username' => $username
            ];
            $data = [
                'username' => $username,
                // 'password' => password_hash($password, PASSWORD_DEFAULT),
                'nama' => $nama,
                'no_kitas' => $no_kitas,
                'jenis_kitas' => $jenis_kitas,
                'alamat' => $alamat,
                'telp' => $telp
            ];
            $this->db->update('pesanan', $datapesanan, ['username' => $user['username']]);
            $this->db->update('user', $data, ['id' => $id]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Member
            ' . $data['user']['username'] . ' berhasil diubah!</div>');
            redirect('admin/member');
        }
    }

    public function member_hapus($id)
    {
        $data['select'] = $this->uri->segment(2);
        $data['user'] = $this->db->get_where('user', ['id' => $id])->row_array();
        $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Member ' . $data['user']['username'] . ' berhasil dihapus!</div>');
        $this->db->delete('user', array('id' => $id));
        redirect('admin/member');
    }

    // Barang
    public function barang()
    {
        $data['select'] = $this->uri->segment(2);
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
        $data['select'] = $this->uri->segment(2);
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
        $data['select'] = $this->uri->segment(2);
        $data['barang'] = $this->db->get_where('barang', ['id' => $id])->row_array();
        $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Barang ' . $data['barang']['nama'] . ' berhasil dihapus!</div>');
        $this->db->delete('barang', ['id' => $id]);
        redirect('admin/barang');
    }

    public function pesanan()
    {
        $data['select'] = $this->uri->segment(2);
        $data['title'] = 'Pesanan';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['username'] = $this->db->get_where('user', ['role_id' => 2])->result_array();
        $this->db->distinct();
        $this->db->group_by('kode_transaksi');
        $data['pesanan'] = $this->db->get_where('pesanan', ['konfirmasi' => 0])->result_array();
        $data['kategori'] = $this->db->get('kategori')->result_array();
        $this->db->join('barang', 'pesanan.id_barang = barang.id', 'INNER');
        $pesanan = $this->db->get_where('pesanan', ['konfirmasi' => 0])->result_array();
        $this->db->distinct();
        $this->db->select('username');
        $username = $this->db->get_where('pesanan', ['konfirmasi' => 0])->result_array();
        $total = 0;
        $tmpusername = null;
        foreach ($pesanan as $p) :
            foreach ($username as $u) :
                if ($p['username'] == $u['username']) {
                    if ($p['username'] != $tmpusername && $tmpusername != null) {
                        $total = 0;
                    }
                    $tmpusername = $p['username'];
                    $total = $total + ($p['total']);
                    $data['total'][$tmpusername] = $total;
                }
            endforeach;
        endforeach;

        // load model
        $this->load->model('Pesanan_model', 'barang');
        $data['barang'] = $this->barang->getBarangStok();
        $data['sejam'] = 60 * 60;
        $username = $this->input->post('username');
        $id_barang = $this->input->post('barang');
        $jumlah = $this->input->post('jumlah');
        $status = $this->input->post('status');
        $hari = $this->input->post('hari');
        // $tsewa = $this->input->post('sewa');
        $barang = $this->db->get_where('barang', ['id' => $id_barang])->row_array();
        $tbayar = 0;
        $id_user = $this->db->get_where('user', ['username' => $username])->row_array();

        if ($this->form_validation->run('pesanan') == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/pesanandua');
            $this->load->view('templates/footer');
        } else {
            $harga = $barang['harga'] * $jumlah * $hari;
            // $sewa = explode(":",$tsewa);
            // $jam = (int) $sewa[0];
            // $menit = (int) $sewa[1];
            // Pembuatan Kode Transaksi
            $kategori = strtoupper(substr($barang['kategori'], 0, 3));
            $tanggal = date('ymdHis');
            if ($status == 1) {
                $tbayar = time();
            } else {
                $tbayar = 0;
            }

            $kode = $kategori . '-' . $tanggal . $id_user['id'];
            // Akhir kode transaksi
            // $jam_sewa = mktime($jam,$menit,(int)date('s'),(int)date('m'),(int)date('d'),(int)date('Y'));
            $jam_kembali = time() + (60 * 60 * 24 * $hari);
            $total = $barang['harga'];
            if ($id_barang == null) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Pilih barang yang mau disewa!</div>');
                redirect('admin/pesanan');
            } else
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
                    // 'tanggal_sewa' => $jam_sewa,
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

    public function pesanan_batal($kode_transaksi)
    {
        $data['select'] = $this->uri->segment(2);
        $pesanan = $this->db->get_where('pesanan', ['kode_transaksi' => $kode_transaksi])->result_array();
        for ($i = 0; $i < count($pesanan); $i++) {
            $id = $pesanan[$i]['id_barang'];
            $barang = $this->db->get_where('barang', ['id' => $pesanan[$i]['id_barang']])->row_array();
            $jumlah = (int) $barang['stok'] + (int) $pesanan[$i]['jumlah_barang'];
            $data = [
                'stok' => $jumlah
            ];
            $this->db->update('barang', $data, ['id' => $pesanan[$i]['id_barang']]);
        }
        $this->db->delete('pesanan', ['kode_transaksi' => $kode_transaksi]);
        redirect('admin/pesanan');
    }

    public function pesanan_konfirmasi($kode_transaksi)
    {
        $data['select'] = $this->uri->segment(2);
        $pesanan = $this->db->get_where('pesanan', ['kode_transaksi' => $kode_transaksi])->result_array();
        $sehari = 60 * 60 * 24;
        $hari = (int) date('d', $pesanan['batas_kembali']) - (int) date('d', $pesanan['tanggal_order']);
        $durasi = (int) date('d', $pesanan['tanggal_sewa']) + ($hari * $sehari);
        $data = [
            'tanggal_sewa' => time(),
            'tanggal_bayar' => time(),
            'status' => 1,
            'konfirmasi' => 1,
            'kondisi_barang' => 1
        ];
        $this->db->update('pesanan', $data, ['kode_transaksi' => $kode_transaksi]);
        redirect('admin/pesanan');
    }

    public function pesanan_detail($kode_transaksi)
    {
        $data['select'] = 'pesanan';
        $data['title'] = 'Detail Pesanan';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        // $data['username'] = $this->db->get_where('user', ['role_id' => 2])->row_array();
        $this->load->model('Pesanan_model', 'barang');
        $data['baris'] = $this->db->get_where('pesanan', ['kode_transaksi' => $kode_transaksi])->row_array();
        $data['member'] = $this->db->get_where('user', ['username' => $data['baris']['username']])->row_array();
        $this->db->join('barang', 'pesanan.id_barang = barang.id', 'INNER');
        $data['pesanan'] = $this->db->get_where('pesanan', ['kode_transaksi' => $kode_transaksi])->result_array();
        $total = 0;
        $data['durasi'] = (((int) $data['baris']['batas_kembali'] - (int) $data['baris']['tanggal_order']) / (60 * 60 * 24));
        // var_dump(($data['baris']['batas_kembali']-$data['baris']['tanggal_order'])/(60*60*24));die;
        foreach ($data['pesanan'] as $p) {

            $total = $total + ($p['harga'] * $p['jumlah_barang']);
        }
        $data['total'] = $total * $data['durasi'];
        // $idBarang = $data['pesanan']['id_barang'];
        // $usernama = $data['pesanan']['username'];
        // $data['barang'] = $this->barang->getBarangById($idBarang);
        // $data['nama'] = $this->db->get_where('user', ['username' => $username])->row_array();
        if ($data['baris']['status'] == 1 && $data['baris']['selesai'] == 1) {
            $data['status'] = 'Lunas';
            $data['selesai'] = 'Selesai';
        } else {
            $data['status'] = 'Belum Lunas';
            $data['selesai'] = 'Belum Selesai';
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/pesanan_detail');
        $this->load->view('templates/footer');
    }

    public function peminjaman()
    {
        $data['select'] = $this->uri->segment(2);
        $data['title'] = 'Peminjaman';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        // $data['peminjaman'] = $this->db->get_where('pesanan', ['konfirmasi' => 1, 'selesai' => 0])->result_array();
        $this->db->distinct();
        $this->db->group_by('kode_transaksi');
        $data['peminjaman'] = $this->db->get_where('pesanan', ['konfirmasi' => 1, 'selesai' => 0])->result_array();
        // $total = $this->db->get_where('pesanan', ['konfirmasi' => 0])->result_array();
        $this->db->join('barang', 'pesanan.id_barang = barang.id', 'INNER');
        $peminjaman = $this->db->get_where('pesanan', ['konfirmasi' => 1, 'selesai' => 0])->result_array();
        $data['baris'] = $this->db->get_where('pesanan', ['konfirmasi' => 1, 'selesai' => 0])->row_array();
        $this->db->distinct();
        $this->db->select('kode_transaksi');
        $kode_transaksi = $this->db->get_where('pesanan', ['konfirmasi' => 1, 'selesai' => 0])->result_array();
        $total = 0;
        $totalDenda = 0;
        $tmp = null;
        // var_dump($peminjaman);die;

        if ($peminjaman != null) {
            foreach ($peminjaman as $p) :
                if ($p['batas_kembali'] < time()) {
                    $hariTerlambat = (int) ceil((time() - $p['batas_kembali']) / (60 * 60 * 24));
                    // $data['denda'] = $p['total']*$hariTerlambat;
                    $data['batas'][$p['kode_transaksi']] = '<strong class="text-danger">Terlambat ' . $hariTerlambat . ' hari</strong>';
                    // $total = $denda+$p['total'];
                    foreach ($peminjaman as $p) :
                        $totalDenda = $totalDenda + ($p['harga'] * $p['jumlah_barang']);
                    endforeach;
                    $data['denda'][$p['kode_transaksi']] = $totalDenda * $hariTerlambat;
                    // var_dump();die;
                } else {
                    $data['batas'][$p['kode_transaksi']] = 'Belum Terlambat';
                    $data['denda'] = 0;
                }
                if ($p['konfirmasi'] == 1 && $data['denda'] == 0) {
                    $data['konfirmasi'] = 'Lunas';
                } else {
                    $data['konfirmasi'] = 'Belum dibayar';
                }
                foreach ($kode_transaksi as $k) :
                    if ($p['kode_transaksi'] == $k['kode_transaksi']) {
                        if ($p['kode_transaksi'] != $tmp && $tmp != null) {
                            $total = 0;
                        }
                        $tmp = $p['kode_transaksi'];
                        $total = $total + ($p['total']);
                        $data['total'][$tmp] = $total;
                    }
                endforeach;
            endforeach;
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/peminjaman');
        $this->load->view('templates/footer');
    }

    public function peminjaman_detail($kode_transaksi)
    {
        $data['select'] = 'peminjaman';
        $data['title'] = 'Peminjaman';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->db->join('barang', 'pesanan.id_barang = barang.id', 'INNER');
        $data['peminjaman'] = $this->db->get_where('pesanan', ['konfirmasi' => 1, 'selesai' => 0, 'kode_transaksi' => $kode_transaksi])->result_array();
        $this->db->join('barang', 'pesanan.id_barang = barang.id', 'INNER');
        // $this->db->join('user', 'pesanan.username = user.username', 'INNER');
        $data['baris'] = $this->db->get_where('pesanan', ['konfirmasi' => 1, 'selesai' => 0, 'kode_transaksi' => $kode_transaksi])->row_array();
        $data['member'] = $this->db->get_where('user', ['username' => $data['baris']['username']])->row_array();
        $data['durasi'] = (((int) $data['baris']['batas_kembali'] - (int) $data['baris']['tanggal_order']) / (60 * 60 * 24));
        $total = 0;
        $totalDenda = 0;
        // var_dump($data['baris']['tanggal_order']);die;
        if ($data['peminjaman'] != null) {
            if ($data['baris']['batas_kembali'] < time()) {
                $hariTerlambat = (int) ceil((time() - $data['baris']['batas_kembali']) / (60 * 60 * 24));
                $data['batas'] = '<strong class="text-danger">(Terlambat ' . $hariTerlambat . ' hari)</strong>';
                // $data['denda'] = ($data['baris']['total']*$hariTerlambat);
                // $total = $denda+$data['baris']['total'];
                // var_dump();die;
                foreach ($data['peminjaman'] as $p) :
                    $totalDenda = $totalDenda + ($p['harga'] * $p['jumlah_barang']);
                endforeach;
                $data['denda'] = $totalDenda * $hariTerlambat;
            } else {
                $data['batas'] = '(Belum Terlambat)';
                $data['denda'] = 0;
            }
            if ($data['baris']['konfirmasi'] == 1 && $data['denda'] == 0) {
                $data['konfirmasi'] = 'Lunas';
            } else {
                $data['konfirmasi'] = 'Belum dibayar';
            }
        }
        foreach ($data['peminjaman'] as $p) :
            $total = $total + ($p['harga'] * $p['jumlah_barang']);
        endforeach;
        $data['total'] = $total * $data['durasi'] + $data['denda'];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/peminjaman_detail');
        $this->load->view('templates/footer');
    }

    public function peminjaman_selesai($kode_transaksi)
    {
        $kondisi = $this->input->post('kondisi');
        $dendaTambahan = $this->input->post('denda');

        $data['select'] = $this->uri->segment(2);
        $peminjaman = $this->db->get_where('pesanan', ['kode_transaksi' => $kode_transaksi])->result_array();
        $i = 0;
        foreach ($peminjaman as $p) :
            $barang[$i] = $this->db->get_where('barang', ['id' => $p['id_barang']])->row_array();
            $i++;
        endforeach;
        $sehari = 60 * 60 * 24;
        if ($peminjaman['batas_kembali'] < time()) {
            $hariTerlambat = (int) ceil((time() - $peminjaman[0]['batas_kembali']) / $sehari);
            $batas = '<strong class="text-danger">(Terlambat ' . $hariTerlambat . ' hari)</strong>';
            $i = 0;
            foreach ($peminjaman as $p) :
                $denda[$i] = ($barang[$i]['harga'] * $hariTerlambat);
                $i++;
            endforeach;
        } else {
            $batas = '(Belum Terlambat)';
            $denda = 0;
        }
        $i = 0;
        foreach ($peminjaman as $p) :
            $stok = $barang[$i]['stok'] + $p['jumlah_barang'];
            $dataBarang = [
                'stok' => $stok,
                'kondisi' => $kondisi[$i]
            ];
            $data = [
                'denda' => $denda[$i] + $dendaTambahan[$i],
                'kondisi_barang' => $kondisi[$i]
            ];
            $this->db->update('barang', $dataBarang, ['id' => $p['id_barang']]);
            $this->db->update('pesanan', $data, ['id' => $p['id']]);
            $i++;
        endforeach;

        $i = 0;
        foreach ($peminjaman as $p) :
            $data = [
                'tanggal_kembali' => time(),
                'selesai' => 1
            ];
            $this->db->update('pesanan', $data, ['kode_transaksi' => $kode_transaksi]);
            $i++;
        endforeach;
        redirect('admin/peminjaman');
    }

    public function transaksi()
    {
        $data['select'] = $this->uri->segment(2);
        $data['title'] = 'Transaksi';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $awalHari = mktime(0, 0, 0, (int) date('m'), (int) date('d'), (int) date('Y'));
        $akhirHari = mktime(23, 59, 59, (int) date('m'), (int) date('d'), (int) date('Y'));
        $this->db->distinct();
        $this->db->group_by('kode_transaksi');
        $data['transaksi'] = $this->db->get_where('pesanan', ['konfirmasi' => 1, 'selesai' => 1, 'tanggal_kembali>' => $awalHari, 'tanggal_kembali<' => $akhirHari])->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/transaksi');
        $this->load->view('templates/footer');
    }

    public function search($int)
    {   
        $sehari = 60*60*24;
        switch ($int) {
            case 1: // hari ini
                $awalHari = mktime(0, 0, 0, (int) date('m'), (int) date('d'), (int) date('Y'));
                $akhirHari = mktime(23, 59, 59, (int) date('m'), (int) date('d'), (int) date('Y'));
                $this->db->distinct();
                $this->db->group_by('kode_transaksi');
                $data['transaksi'] = $this->db->get_where('pesanan', ['konfirmasi' => 1, 'selesai' => 1, 'tanggal_kembali>' => $awalHari, 'tanggal_kembali<' => $akhirHari])->result_array();
                $this->load->view('ajax/transaksi', $data);
                break;
            case 2: // 3 hari terakhir
                $awalHari = time() - ($sehari * 3);
                $akhirHari = mktime(23, 59, 59, (int) date('m'), (int) date('d'), (int) date('Y'));
                $this->db->distinct();
                $this->db->group_by('kode_transaksi');
                $data['transaksi'] = $this->db->get_where('pesanan', ['konfirmasi' => 1, 'selesai' => 1, 'tanggal_kembali>' => $awalHari, 'tanggal_kembali<' => $akhirHari])->result_array();
                $this->load->view('ajax/transaksi', $data);
            break;
            case 3: // 7 hari terakhir
                $awalHari = time() - ($sehari * 7);
                $akhirHari = mktime(23, 59, 59, (int) date('m'), (int) date('d'), (int) date('Y'));
                $this->db->distinct();
                $this->db->group_by('kode_transaksi');
                $data['transaksi'] = $this->db->get_where('pesanan', ['konfirmasi' => 1, 'selesai' => 1, 'tanggal_kembali>' => $awalHari, 'tanggal_kembali<' => $akhirHari])->result_array();
                $this->load->view('ajax/transaksi', $data);
            break;
            case 4: // 1 bulan terakhir
                $awalHari = time() - ($sehari * 30);
                $akhirHari = mktime(23, 59, 59, (int) date('m'), (int) date('d'), (int) date('Y'));
                $this->db->distinct();
                $this->db->group_by('kode_transaksi');
                $data['transaksi'] = $this->db->get_where('pesanan', ['konfirmasi' => 1, 'selesai' => 1, 'tanggal_kembali>' => $awalHari, 'tanggal_kembali<' => $akhirHari])->result_array();
                $this->load->view('ajax/transaksi', $data);
            break;
            case 5: // Semua transaksi
                $this->db->distinct();
                $this->db->group_by('kode_transaksi');
                $data['transaksi'] = $this->db->get_where('pesanan', ['konfirmasi' => 1, 'selesai' => 1])->result_array();
                $this->load->view('ajax/transaksi', $data);
            break;
            default:
                break;
        }
    }

    public function transaksi_detail($kode_transaksi)
    {
        $data['select'] = 'transaksi';
        $data['title'] = 'Detail Transaksi';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->db->join('barang', 'pesanan.id_barang = barang.id', 'INNER');
        $data['transaksi'] = $this->db->get_where('pesanan', ['konfirmasi' => 1, 'selesai' => 1, 'kode_transaksi' => $kode_transaksi])->result_array();
        $this->db->join('barang', 'pesanan.id_barang = barang.id', 'INNER');
        $data['baris'] = $this->db->get_where('pesanan', ['konfirmasi' => 1, 'selesai' => 1, 'kode_transaksi' => $kode_transaksi])->row_array();
        $data['member'] = $this->db->get_where('user', ['username' => $data['baris']['username']])->row_array();
        $data['durasi'] = (((int) $data['baris']['batas_kembali'] - (int) $data['baris']['tanggal_order']) / (60 * 60 * 24));
        $total = 0;
        $totalDenda = 0;
        // die;
        foreach ($data['transaksi'] as $t) :
            $totalDenda = $totalDenda + $t['denda'];
        endforeach;
        if ($data['transaksi'] != null) {
            if ($data['baris']['batas_kembali'] < $data['baris']['tanggal_kembali']) {
                $hariTerlambat = (int) ceil(($data['baris']['tanggal_kembali'] - $data['baris']['batas_kembali']) / (60 * 60 * 24));
                $data['batas'] = '<strong class="text-danger">(Terlambat ' . $hariTerlambat . ' hari)</strong>';
                // foreach($data['transaksi'] as $t):
                //     $totalDenda = $totalDenda+($t['harga']*$t['jumlah_barang']);
                // endforeach;
                $data['denda'] = $totalDenda * $hariTerlambat;
            } else {
                $data['batas'] = '(Belum Terlambat)';
                $data['denda'] = 0 + $totalDenda;
            }
            if ($data['baris']['selesai'] == 1) {
                $data['konfirmasi'] = 'Lunas';
            } else {
                $data['konfirmasi'] = 'Belum dibayar';
            }
        }
        foreach ($data['transaksi'] as $t) :
            $total = $total + ($t['harga'] * $t['jumlah_barang']);
        endforeach;
        $data['total'] = $total * $data['durasi'] + $data['denda'];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/transaksi_detail');
        $this->load->view('templates/footer');
    }

    public function ajax($keyword)
    {
        // var_dump($keyword);die;
        $data['keyword'] = $keyword;
        $this->load->model('Pesanan_model', 'barang');
        $data['barang'] = $this->barang->getBarangByKeyword($keyword);
        $data['kategori'] = $this->barang->getKategoriByKeyword($keyword);
        $this->load->view('ajax/index', $data);
    }
}
