<?php

    function is_logged_in()
    {
        // tidak bisa menggunakan $this karena helper tidak termasuk mvc CI maka panggil get_instance()
        $ci = get_instance();
        if (!$ci->session->userdata('username')) {
            redirect('auth');
        } else {
            $role_id = $ci->session->userdata('role_id');
            $menu = $ci->uri->segment(1);
            $queryMenu = $ci->db->get_where('role', ['id' => $role_id])->row_array();
            
            if(!$role_id && $menu == 'auth'){
                redirect(strtolower($queryMenu['nama']));
            }else
            if($role_id == 1 && $menu != 'admin'){
                redirect('auth/blocked', $data);
            }else
            if($role_id == 2 && $menu == 'admin'){
                redirect('auth/blocked', $data);
            }
        }
    }