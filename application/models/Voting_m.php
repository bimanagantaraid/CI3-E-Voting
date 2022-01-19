<?php

class Voting_m extends CI_Model
{
    public function get($voting_id = null)
    {
        $this->db->from('voting');
        if ($voting_id) {
            $this->db->where('voting_id', $voting_id);
        }
        $this->db->limit(1);
        $query = $this->db->get();
        return $query;
    }

    public function insert($data)
    {
        $this->db->insert('voting', $data);
        return ($this->db->affected_rows() != 1) ? FALSE : TRUE;
    }

    public function update($voting_id, $data)
    {
        $this->db->update('voting', $data, $voting_id);
        return ($this->db->affected_rows() != 1) ? FALSE : TRUE;
    }

    public function hapus($voting_id)
    {
        $this->db->delete('voting', array('voting_id' => $voting_id));
        return ($this->db->affected_rows() != 1) ? FALSE : TRUE;
    }

    public function vote($pemilih_id)
    {
        $this->db->get_where('vote', array('pemilih_id' => $pemilih_id));
        return ($this->db->affected_rows() != 1) ? FALSE : TRUE;
    }

    public function rekapitulasi()
    {
        $this->db->from('vote');
        $this->db->join('pemilih', 'vote.pemilih_id=pemilih.pemilih_id');
        $this->db->join('calon_pasangan', 'vote.paslon_id=calon_pasangan.paslon_id');
        return $this->db->get();
    }

    public function getCount()
    {
        return $this->db->where('status', 'valid')->from('vote')->count_all_results();
    }

    var $column_order = array('pemilih.username', 'pemilih.nama', 'vote.paslon_id', 'calon_pasangan.nama_paslon', 'date_vote');
    var $column_search = array('pemilih.username', 'pemilih.nama', 'vote.paslon_id', 'calon_pasangan.nama_paslon', 'date_vote');
    var $order = array('username' => 'asc');

    private function _get_datatables_query()
    {
        $this->db->select('vote.*, calon_pasangan.nama_paslon, pemilih.username, pemilih.nama');
        $this->db->from('vote');
        $this->db->join('pemilih', 'vote.pemilih_id=pemilih.pemilih_id');
        $this->db->join('calon_pasangan', 'vote.paslon_id=calon_pasangan.paslon_id');
        $i = 0;
        foreach ($this->column_search as $item) {
            if (@$_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
        if (@$_POST['filterDate'] != null) {
            $tanggalMentah = $_POST['filterDate'];
            $dateFilter = explode(',', $tanggalMentah);
            $this->db->where('vote.date_vote BETWEEN "' . $dateFilter[0] . ' 00:00:00" AND "' . $dateFilter[1] . ' 23:59:59"');
        }
    }

    public function getServer()
    {
        $this->_get_datatables_query();
        if (@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_all()
    {
        $this->db->from('pemilih');
        return $this->db->count_all_results();
    }

    public function count_all_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function votingstatus()
    {
        return $this->db->get('voting');
    }
}
