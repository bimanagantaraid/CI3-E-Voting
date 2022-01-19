<?php

class Menu_m extends CI_Model
{
    public function getMenu($nav_menu_id = null)
    {
        $this->db->from('nav_menu');
        if ($nav_menu_id) {
            $this->db->where('nav_menu_id', $nav_menu_id);
        }
        return $this->db->get();
    }

    public function insertMenu($nama_menu)
    {
        $this->db->insert('nav_menu', ['nama' => $nama_menu]);
        return $this->getMenu($this->db->insert_id());
    }

    public function getSubMenu($sub_menu_id = null)
    {
        $this->db->select('nav_sub_menu.*, nav_menu.nama as nama_menu');
        $this->db->from('nav_sub_menu'); 
        $this->db->join('nav_menu', 'nav_menu.nav_menu_id=nav_sub_menu.nav_menu_id');
        if ($sub_menu_id) {
            $this->db->where('sub_menu_id', $sub_menu_id);
        }
        return $this->db->get();
    }
}
