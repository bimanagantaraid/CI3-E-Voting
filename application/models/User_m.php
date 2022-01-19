<?php

class User_m extends CI_Model
{
    public function get($user_id = null)
    {
        $this->db->from('user');
        if($user_id != null){
            $this->db->where('user_id', $user_id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function getRole()
    {
        return $this->db->get('user_role');
    
    }

    public function insert($data)
    {
        $this->db->insert('user', $data);
        return $this->db->affected_rows() > 0 ? TRUE:FALSE;
    }

    public function edit($user_id, $data)
    {
        $this->db->update('user', $data, $user_id);
        return ($this->db->affected_rows() != 1) ? FALSE:TRUE;
    }

    public function hapus($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->delete('user');
        return ($this->db->affected_rows() != 1) ? FALSE:TRUE;
    }

    public function editProfile($user_id, $data)
    {
        $this->db->update('user', $data, $user_id);
        return ($this->db->affected_rows() != 1) ? FALSE:TRUE;
    }

    public function gantipassword($user_id, $password)
    {
        $this->db->set('password', $password);
        $this->db->where('user_id', $user_id);
        $this->db->update('user');
        return ($this->db->affected_rows() != 1) ? FALSE:TRUE;
    }

    public function getCount()
    {
        return $this->db->from('user')->count_all_results();
    }
}
