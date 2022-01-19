<?php

function set_timezone()
{
    $ci = &get_instance();
    date_default_timezone_set("Asia/jakarta");
}

function get_user_loggedin()
{
    $ci = &get_instance();
    return $ci->user_m->get($ci->session->userdata('user_id'))->row_array();
}

function authValid()
{
    $ci = &get_instance();
    if ($ci->session->userdata('role_id') == 1) {
        redirect('admin');
    } else if ($ci->session->userdata('role_id') == 2) {
        redirect('panitia');
    }
}

function is_loggedin()
{
    $ci = &get_instance();
    $role_id = $ci->session->userdata('role_id');
    $menu = $ci->uri->segment(1);
    $navSubMenu = $ci->db->like('url', $menu);
    $navSubMenu = $ci->db->get('nav_sub_menu')->result_array();
    $accesMenu = $ci->db->where('role_id', $role_id);
    $accesMenu = $ci->db->group_start();
    foreach ($navSubMenu as $nsm) {
        $accesMenu = $ci->db->or_where('nav_menu_id', $nsm['nav_menu_id']);
    }
    $accesMenu = $ci->db->group_end();
    $accesMenu = $ci->db->get('user_acces_menu');
    if($accesMenu->num_rows() < 1){
        redirect('auth/blocked');
    }
}

function profile()
{
    $ci = &get_instance();
    $data['title']  = "PROFILE";
    $data['titlepage']  = "PROFILE";
    $data['user'] = $ci->user_m->get($ci->session->userdata('user_id'))->row_array();
    $ci->template->load('template', 'user/profile', $data);
}

function gantipassword()
{
    $ci = &get_instance();
    $data['title']  = "GANTI PASSWORD";
    $data['titlepage']  = "GANTI PASSWORD";
    $data['user'] = $ci->user_m->get($ci->session->userdata('user_id'))->row_array();
    $ci->template->load('template', 'user/gantipassword', $data);
}

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function deskripsipendek($string, $voting_id)
{
    $ci = &get_instance();
    $string = strip_tags($string);
    if (strlen($string) > 30) {

        // truncate string
        $stringCut = substr($string, 0, 30);
        $endPoint = strrpos($stringCut, ' ');

        //if the string doesn't contain any space then it will cut without word basis.
        $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
        $string .= '... <button type="button" class="btn btn-xs btn-warning float-right text-white" onclick="detail(this)" id="' . $voting_id . '" id="modal-Detail"><i class="fas fa-info-circle" style="color:white"></i>  Detail</button>';
    }
    return $string;
}

function checkVotingKonfigurasi()
{
    $ci =& get_instance();
    $query = $ci->db->get_where('voting', array('is_active', 1))->result_array();
}

function notif($response, $value){
    if($response == TRUE){
        return '<div class="alert alert-success" role="alert">'.$value.'</div>';
    }else if($response == FALSE){
        return '<div class="alert alert-danger" role="alert">'.$value.'</div>';
    }
}