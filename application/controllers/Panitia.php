<?php

class Panitia extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_loggedin();
    }

    public function index()
    {
        $data['calonpasangan'] = $this->paslon_m->getCount();
        $data['pemilih'] = $this->pemilih_m->getCount();
        $data['suara'] = $this->voting_m->getCount();
        $data['suaramasuk'] = $this->paslon_m->getSuara();
        $data['title'] = "Dashboard panitia";
        $data['titlepage'] = "Dashboard panitia";
        $data['user'] = get_user_loggedin();
        $this->template->load('template', 'panitia/index', $data);
    }
}
