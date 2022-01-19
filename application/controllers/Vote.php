<?php

class Vote extends CI_Controller
{
    public function index()
    {
        $pemilih_id = $this->session->userdata('pemilih_id');
        $data['pemilih'] = $this->pemilih_m->get($pemilih_id)->row_array();
        $data['pemilihstatus'] = $this->voting_m->vote($pemilih_id);
        $data['votingstatus'] = $this->voting_m->votingstatus()->row_array();
        $data['paslon'] = $this->paslon_m->get()->result_array();
        $data['voting'] = $this->voting_m->get()->result_array();
        if ($data['pemilihstatus']) {
            $this->load->view('vote', $data);
        } else {
            $this->load->view('vote', $data);
        }
    }

    public function getPaslon()
    {
        $paslon_id = $_GET['paslon_id'];
        $query = $this->db->get_where('calon_pasangan', array('paslon_id' => $paslon_id));
        $data = array(
            'data'      => $query->row_array()
        );
        echo json_encode($data);
    }

    public function insert()
    {
        set_timezone();
        if ($_POST['paslon_id'] && $_POST['pemilih_id']) {
            $data = array(
                'vote_id'       => '',
                'paslon_id'     => $_POST['paslon_id'],
                'pemilih_id'    => $_POST['pemilih_id'],
                'status'        => 'valid',
                'date_vote'     => date('Y-m-d H:i:s')
            );
            $this->db->insert('vote', $data);
            $response = array();
            if ($this->db->affected_rows() == 1) {
                $response['status'] = 'valid';
            } else {
                $response['status'] = 'failed';
            }
        } else {
            $response['status'] = 'notlogin';
        }
        echo json_encode($response);
    }

    public function quickcount()
    {
        $pemilih_id = $this->session->userdata('pemilih_id');
        $data['title'] = "Vote sekarang";
        $data['pemilih'] = $this->pemilih_m->get($pemilih_id)->row_array();
        $data['pemilihstatus'] = $this->voting_m->vote($pemilih_id);
        $data['suara'] = $this->paslon_m->getSuara();
        $this->load->view('quickcount', $data);
    }
}
