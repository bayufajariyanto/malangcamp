<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index_model extends CI_Model
{
    public function getToday($awalHari, $akhirHari){
        $query = "SELECT * FROM pesanan WHERE `status` = 1 AND `tanggal_sewa`>= $awalHari AND `tanggal_sewa` <= $akhirHari";
        return $this->db->query($query)->result_array();
    }

    public function getTodayDenda($awalHari, $akhirHari){
        $query = "SELECT * FROM pesanan WHERE `tanggal_kembali`>= $awalHari AND `tanggal_kembali` <= $akhirHari AND `denda` > 0";
        return $this->db->query($query)->result_array();
    }

    public function getThisMonth($awalBulan, $akhirBulan){
        $query = "SELECT * FROM pesanan WHERE `status` = 1 AND `tanggal_sewa`>= $awalBulan AND `tanggal_sewa` <= $akhirBulan";
        return $this->db->query($query)->result_array();
    }

    public function getThisMonthDenda($awalBulan, $akhirBulan){
        $query = "SELECT * FROM pesanan WHERE `tanggal_kembali`>= $awalBulan AND `tanggal_kembali` <= $akhirBulan AND `denda` > 0";
        return $this->db->query($query)->result_array();
    }
    
    public function getAllDenda(){
        $query = "SELECT * FROM pesanan WHERE `denda` > 0";
        return $this->db->query($query)->result_array();
    }

    // Pengeluaran
    public function getPengeluaranToday($awalHari, $akhirHari){
        $query = "SELECT * FROM pengeluaran WHERE `tanggal`>= $awalHari AND `tanggal` <= $akhirHari";
        return $this->db->query($query)->result_array();
    }

    public function getPengeluaranThisMonth($awalHari, $akhirHari){
        $query = "SELECT * FROM pengeluaran WHERE `tanggal`>= $awalHari AND `tanggal` <= $akhirHari";
        return $this->db->query($query)->result_array();
    }

    public function getPengeluaranByKategori($kategori){
        $query = "SELECT * FROM pengeluaran WHERE 'kategori' LIKE '$kategori'";
        return $this->db->query($query)->result_array();
    }
}