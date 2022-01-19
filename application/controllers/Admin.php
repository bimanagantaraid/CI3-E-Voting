<?php

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_m');
        is_loggedin();
    }

    public function index()
    {
        $data['calonpasangan'] = $this->paslon_m->getCount();
        $data['pemilih'] = $this->pemilih_m->getCount();
        $data['suara'] = $this->voting_m->getCount();
        $data['users'] = $this->user_m->getCount();
        $data['suaramasuk'] = $this->paslon_m->getSuara();
        $data['title'] = "DASHBOARD";
        $data['titlepage'] = "DASHBOARD";
        $data['user'] = $this->user_m->get($this->session->userdata('user_id'))->row_array();
        $this->template->load('template', 'admin/index', $data);
    }
}
