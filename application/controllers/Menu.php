<?php

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_loggedin();
    }

    public function index()
    {
        $data['title'] = "MENU MENAGEMENT";
        $data['titlepage'] = "MENU MENAGEMENT";
        $data['user'] = get_user_loggedin();
        $data['menu'] = $this->menu_m->getMenu()->result_array();
        $this->form_validation->set_rules('nama', 'Nama', 'required', array('required'=>'%s wajib diiisi!'));
        if($this->form_validation->run() == false){
            $this->template->load('template', 'menu/index', $data);
        }else{
            $response = $this->menu_m->insertmenu($this->input->post('nama'))->row_array();
            $this->session->set_flashdata('message', 'Menu '.$response->nama.' berhasil ditambahkan!');
            redirect('menu');
        }
    }

    public function submenu(){
        $data['title'] = "SUBMENU MENAGEMENT";
        $data['titlepage'] = "SUBMENU MENAGEMENT";
        $data['user'] = get_user_loggedin();
        $data['menu'] = $this->menu_m->getMenu()->result_array();
        $data['submenu'] = $this->menu_m->getSubMenu()->result_array();
        if($this->form_validation->run() == false){
            $this->template->load('template', 'menu/submenu', $data);
        }
    }

    
}
