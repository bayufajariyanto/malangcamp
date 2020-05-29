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
            // $menu_id = $queryMenu['id'];
            
            if(!$role_id && $menu == 'auth'){
                // redirect('auth');
                redirect(strtolower($queryMenu['nama']));
            }else
            if($role_id == 1 && $menu != 'admin'){
                // var_dump('salah');die;
                // var_dump(strtolower($queryMenu['nama']));die;
                redirect('auth/blocked', $data);
            }else
            if($role_id == 2 && $menu == 'admin'){
                redirect('auth/blocked', $data);
                // var_dump('salah juga');die;
            }
            // $userAccess = $ci->db->get_where('user_access_menu', [
            //     'role_id' => $role_id, 'menu_id' => $menu_id
            // ]);

            // if ($queryMenu->num_rows() < 1) {
            // }
        }
    }

    function check_access($role_id, $menu_id)
    {
        $ci = get_instance();

        // bisa juga menggunakan query ini
        // $ci->db->get_where('user_access_menu', [
        //     'role_id' => $role_id,
        //     'menu_id' => $menu_id
        // ]);
        $ci->db->where('role_id', $role_id);
        $ci->db->where('menu_id', $menu_id);
        $result = $ci->db->get('user_access_menu');

        if ($result->num_rows() > 0) {
            return "checked='checked'";
        }
    }