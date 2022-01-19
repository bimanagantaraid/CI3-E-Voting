<?php

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('user_m');
        set_timezone();
    }

    public function registration_validate()
    {
        $this->form_validation->set_rules(
            'name',
            'Nama',
            'required',
            array(
                'required' => '%s wajib diisi!'
            )
        );
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|is_unique[user.email]|valid_email',
            array(
                'required'      => '%s wajib diisi!',
                'is_unique'     => '%s sudah terdaftar!',
                'valid_email'   => '%s wajib valid!'
            )
        );
        $this->form_validation->set_rules(
            'username',
            'Username',
            'required|min_length[8]|is_unique[user.username]',
            array(
                'required'      => '%s wajib diisi!',
                'min_length'    => '%s minimal 8 karakter!',
                'is_unique'     => '%s sudah terdaftar'
            )
        );
        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|min_length[8]',
            array(
                'required' => '%s wajib diisi!',
                'min_length'    => '%s minimal 8 karakter!',
            )
        );
        $this->form_validation->set_rules(
            'confpassword',
            'Password',
            'required|matches[password]',
            array(
                'required'      => '%s wajib diisi!',
                'matches'       => '%s tidak sama!'
            )
        );
    }

    public function registration()
    {
        $this->registration_validate();
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/registration');
        } else {
            $data = array(
                'user_id'       => '',
                'name'          => $this->input->post('name'),
                'image'         => 'default.jpg',
                'email'         => htmlspecialchars($this->input->post('email', TRUE)),
                'username'      => htmlspecialchars($this->input->post('username', TRUE)),
                'password'      => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role_id'       => 2,
                'is_active'     => 0,
                'date_created'  => date('Y-m-d H:i:s')
            );

            $response = $this->user_m->insert($data);
            if ($response == TRUE) {
                $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">
                Berhasil mendaftar, silahkah login!</div>');
                redirect('auth/login', 'refersh');
            }
        }
    }

    private function _login_validate()
    {
        $this->form_validation->set_rules('usernameemail', 'Email/Username', 'trim|required', array('required'  => '%s wajib diisi!'));
        $this->form_validation->set_rules('password', 'password', 'required', array('required' => '%s wajib diisi!'));
    }

    public function login()
    {
        authValid();
        $this->_login_validate();
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/login');
        } else {
            $response = $this->auth_m->login();
            if ($response) {
                if ($response->is_active == 1) {
                    if (password_verify($this->input->post('password'), $response->password)) {
                        $data = array(
                            'user_id'   => $response->user_id,
                            'username'   => $response->username,
                            'role_id'   => $response->role_id,
                        );
                        $this->session->set_userdata($data);
                        if ($response->role_id == 1) {
                            redirect('admin');
                        } else if ($response->role_id == 2) {
                            redirect('panitia');
                        }
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
                        redirect('auth/login');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akun belum diaktivasi!</div>');
                    redirect('auth/login');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Username atau Email tidak terdaftar!</div>');
                redirect('auth/login');
            }
        }
    }

    private function __pemilihvalidate()
    {
        $this->form_validation->set_rules('usernameemail', 'Email/Username', 'trim|required', array('required'  => '%s wajib diisi!'));
        $this->form_validation->set_rules('password', 'password', 'required', array('required' => '%s wajib diisi!'));
    }

    public function loginpemilih()
    {
        $this->_login_validate();
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/pemilih');
        } else {
            $response = $this->auth_m->loginpemilih();
            if ($response) {
                if ($this->input->post('password') == $response->password) {
                    $data = array(
                        'pemilih_id'   => $response->pemilih_id,
                        'no_identitas_resmi'   => $response->no_identitas_resmi
                    );
                    $this->session->set_userdata($data);
                    redirect('vote');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
                    redirect('auth/loginpemilih');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Username tidak terdaftar, silahkan kontak panitia!</div>');
                redirect('auth/loginpemilih');
            }
        }
    }

    public function logout()
    {
        $data = array('user_id', 'username', 'role_id');
        $this->session->unset_userdata($data);
        redirect('home');
    }

    public function logoutpemilih()
    {
        $data = array('pemilih_id', 'no_identitas_resmi');
        $this->session->unset_userdata($data);
        redirect('home');
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}
