<?php 

class Home extends CI_Controller
{
    public function index()
    {
        $pemilih_id = $this->session->userdata('pemilih_id');
        $data['title'] = "Vote sekarang";
        $data['pemilih'] = $this->pemilih_m->get($pemilih_id)->row_array();
        $data['pemilihstatus'] = $this->voting_m->vote($pemilih_id);
        $data['voting'] = $this->voting_m->get()->result_array();
        $this->load->view('index',$data);
    }
}