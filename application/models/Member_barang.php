<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member_barang extends CI_Model
{
    public function getBarangMember(){
        $username = $this->session->userdata('username');
        $query = "SELECT b.*,k.username FROM barang b LEFT JOIN keranjang k ON b.id = k.id_barang WHERE b.stok>= 1 AND NOT k.username = '$username' OR k.username IS NULL";
        return $this->db->query($query)->result_array();
    }

    public function getBarangId($id){
        $query = "SELECT * FROM barang WHERE `id` = $id";
        return $this->db->query($query)->row_array();
    }
    
    public function getBarangKategori($kategori){
        $username = $this->session->userdata('username');
        $query = "SELECT b.*,k.username FROM barang b LEFT JOIN keranjang k ON b.id = k.id_barang WHERE b.stok >= 1 AND b.kategori = '$kategori'";
        return $this->db->query($query)->result_array();
    }
}