<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan_model extends CI_Model
{
    public function getBarangStok(){
        $query = "SELECT * FROM barang WHERE `stok`>= 1";
        return $this->db->query($query)->result_array();
    }

    public function getBarangById($id){
        $query = "SELECT * FROM barang WHERE `id` = $id";
        return $this->db->query($query)->row_array();
    }

    public function getBarangByKeyword($keyword){
        $query = "SELECT * FROM barang WHERE
        nama LIKE '%$keyword%' OR
        kategori LIKE '%$keyword%'";
        return $this->db->query($query)->result_array();
    }
    public function getKategoriByKeyword($keyword){
        $query = "SELECT * FROM kategori WHERE
        nama LIKE '%$keyword%'";
        return $this->db->query($query)->result_array();
    }

    public function getBarangByCategory($kategori){
        $query = "SELECT * FROM barang WHERE `kategori` = '$kategori' AND `stok` >=1 ";
        return $this->db->query($query)->result_array();
    }
    
    public function ajax($input){
        $query = "SELECT * FROM barang WHERE `nama` LIKE '%$input%' OR `kategori` LIKE '%$input%' ";
        return $this->db->query($query)->row_array();
    }
}
