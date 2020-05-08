<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index_model extends CI_Model
{
    public function getToday($awalHari, $akhirHari){
        $query = "SELECT * FROM pesanan WHERE `tanggal_sewa`>= $awalHari AND `tanggal_sewa` <= $akhirHari";
        return $this->db->query($query)->result_array();
    }

    public function getTodayDenda($awalHari, $akhirHari){
        $query = "SELECT * FROM pesanan WHERE `tanggal_kembali`>= $awalHari AND `tanggal_kembali` <= $akhirHari AND `denda` > 0";
        return $this->db->query($query)->result_array();
    }
}