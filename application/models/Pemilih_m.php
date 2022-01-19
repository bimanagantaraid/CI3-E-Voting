<?php

class Pemilih_m extends CI_Model
{
    public function get($pemilih_id = NULL)
    {
        $this->db->from('pemilih');
        if ($pemilih_id) {
            $this->db->where('pemilih_id', $pemilih_id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function lastrecord()
    {
        return $this->db->select()->order_by('pemilih_id', 'DESC')->limit(1)->get('pemilih')->row();
    }

    public function insert($data)
    {
        $this->db->insert('pemilih', $data);
        return ($this->db->affected_rows() != 1) ? FALSE : TRUE;
    }

    public function hapus($pemilih_id)
    {
        $this->db->where('pemilih_id', $pemilih_id);
        $this->db->delete('pemilih');
        return ($this->db->affected_rows() != 1) ? FALSE : TRUE;
    }

    public function edit($pemilih_id, $data)
    {
        $this->db->update('pemilih', $data, $pemilih_id);
        return ($this->db->affected_rows() != 1) ? FALSE : TRUE;
    }

    public function getCount()
    {
        return $this->db->from('pemilih')->count_all_results();
    }

    var $column_order = array('no_identitas_resmi', 'username', 'password', 'nama', 'date_created', 'alamat', 'jenis_kelamin');
    var $column_search = array('no_identitas_resmi', 'username', 'password', 'nama', 'date_created', 'alamat', 'jenis_kelamin');
    var $order = array('pemilih_id' => 'asc');

    private function _get_datatables_query()
    {
        $this->db->from('pemilih');
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
}
