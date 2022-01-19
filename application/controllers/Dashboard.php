<?php

class Dashboard extends CI_Controller
{
    public function index()
    {
        check_not_login();
        check_level_login();
    }
}
