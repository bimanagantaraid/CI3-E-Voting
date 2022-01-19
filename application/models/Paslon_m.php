<?php 

class Paslon_m extends CI_Model
{
    public function get($paslon_id = NULL)
    {
        $this->db->select('calon_pasangan.*, voting.nama as namaVoting');
        $this->db->from('calon_pasangan');
        $this->db->join('voting', 'voting.voting_id=calon_pasangan.voting_id');
        if($paslon_id){
            $this->db->where('calon_pasangan.paslon_id', $paslon_id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function insert($data){
        $this->db->insert('calon_pasangan', $data);
        return ($this->db->affected_rows() != 1) ? FALSE : TRUE;
    }

    public function hapus($paslon_id)
    {
        $this->db->where('paslon_id', $paslon_id);
        $this->db->delete('calon_pasangan');
        return ($this->db->affected_rows() != 1) ? FALSE:TRUE;
    }

    public function update($data, $paslon_id)
    {
        $this->db->update('calon_pasangan', $data, $paslon_id);
        return ($this->db->affected_rows() != 1) ? FALSE:TRUE;
    }

    public function getSuara()
    {
        $paslon = $this->get()->result_array();
        $data = array();
        foreach($paslon as $row){
            $paslon_suara = array();
            $paslon_suara['nama_paslon'] = $row['nama_paslon'];
            $paslon_suara['no_paslon'] = $row['no_paslon'];
            $paslon_suara['image'] = $row['image'];
            $paslon_suara['suara'] = $this->db->where('paslon_id', $row['paslon_id'])->get('vote')->num_rows();
            $data[] = $paslon_suara;
        }
        return $data;        
    }

    public function getCount()
    {
        return $this->db->from('calon_pasangan')->count_all_results();
    }
}