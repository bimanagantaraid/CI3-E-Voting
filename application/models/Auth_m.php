<?php

class Auth_m extends CI_Model
{
    public function login(){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('username', $_POST['usernameemail']);
        $this->db->or_where('email', $_POST['usernameemail']);
        $query = $this->db->get()->row();
        return $query;
    }

    public function loginpemilih()
    {
        $this->db->select('pemilih_id, nama, no_identitas_resmi, password');
        $this->db->from('pemilih');
        $this->db->where('username', $_POST['usernameemail']);
        $query = $this->db->get()->row();
        return $query;
    }
}
