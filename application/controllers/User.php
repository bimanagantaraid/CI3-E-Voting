<?php

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('my_form_validation');
        is_loggedin();
        set_timezone();
    }
    public function index()
    {
        $data['title'] = "User";
        $data['titlepage'] = "User list";
        $data['user'] = get_user_loggedin();
        $data['users'] = $this->user_m->get()->result_array();
        $this->template->load('template', 'user/index', $data);
    }

    public function getDetail()
    {
        $user_id = $_POST['user_id'];
        $response = $this->user_m->get($user_id)->row_array();
        echo json_encode($response);
    }

    private function _tambahValidation()
    {
        $this->form_validation->set_rules(
            'name',
            'Nama',
            'required',
            array(
                'required'      => '%s wajib diisi!'
            )
        );
        $this->form_validation->set_rules(
            'username',
            'Username',
            'required|is_unique[user.username]|min_length[8]',
            array(
                'required'      => '%s wajib diisi!',
                'is_unique'     => '%s sudah terdaftar!',
                'min_length'    => '%s minimal 8 karakter'
            )
        );
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|is_unique[user.email]',
            array(
                'required'      => '%s wajib diisi!',
                'is_unique'     => '%s sudah terdaftar!'
            )
        );
        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|min_length[8]',
            array(
                'required'      => '%s wajib diisi!',
                'min_length'    => '%s minimal 8 karakter'
            )
        );
        $this->form_validation->set_rules(
            'role_id',
            'Role',
            'required',
            array(
                'required'      => '%s wajib diisi!',
            )
        );
        $this->form_validation->set_rules(
            'is_active',
            'Status',
            'required',
            array(
                'required' => '%s wajib diisi!'
            )
        );
    }

    public function tambah()
    {
        $data['title'] = "USER";
        $data['titlepage'] = "TAMBAH USER";
        $data['user'] = get_user_loggedin();
        $user = $data['user'];
        $data['role'] = $this->user_m->getRole()->result_array();
        if ($user['role_id'] != 1) {
            redirect('auth/blocked');
        }
        $this->_tambahValidation();
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('template', 'user/tambah', $data);
        } else {
            $data = array(
                'user_id'       => '',
                'name'          => $this->input->post('name'),
                'image'         => 'default.jpg',
                'email'         => $this->input->post('email'),
                'username'      => $this->input->post('username'),
                'password'      => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role_id'       => $this->input->post('role_id'),
                'is_active'     => ($this->input->post('is_active') == 'on') ? 1 : 0,
                'date_created'  => date('Y-m-d H:i:s')
            );
            if ($user['role_id'] != 1) {
                redirect('auth/blocked');
            } else {
                $response = $this->user_m->insert($data);
                if ($response == TRUE) {
                    $this->session->set_flashdata('message', array('icon' => 'success', 'message' => 'Data berhasil ditambahkan!'));
                    redirect('user');
                } else {
                    $this->session->set_flashdata('message', array('icon' => 'warning', 'message' => 'Data gagal ditambahkan!'));
                    redirect('user');
                }
            }
        }
    }

    private function _editValidate($user_id)
    {
        $this->form_validation->set_rules(
            'name',
            'Nama',
            'required',
            array(
                'required'      => '%s wajib diisi!'
            )
        );
        $this->form_validation->set_rules(
            'username',
            'username',
            'required|edit_unique[user.username.' . $this->input->post('user_id') . ']|min_length[8]',
            array(
                'required'      => '%s wajib diisi!',
                'edit_unique'     => '%s sudah terdaftar!',
                'min_length'    => '%s minimal 8 karakter'
            )
        );
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required',
            array(
                'required'      => '%s wajib diisi!',
            )
        );

        $this->form_validation->set_rules(
            'role_id',
            'Role',
            'required',
            array(
                'required'      => '%s wajib diisi!',
            )
        );
    }

    public function edit($user_id)
    {
        $data['title'] = "Edit user";
        $data['titlepage'] = "Data edit";
        $data['user'] = get_user_loggedin();
        $data['useredit'] = $this->user_m->get($user_id)->row_array();
        $data['role'] = $this->user_m->getRole()->result_array();
        $useredit = $data['useredit'];
        $this->_editValidate($useredit['user_id']);
        if ($data['user']['role_id'] != 1) {
            redirect('auth/blocked');
        }
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('template', 'user/edit', $data);
        } else {
            $user_id = array(
                'user_id'       => $this->input->post('user_id')
            );
            $data = array(
                'name'          => $this->input->post('name'),
                'email'         => $this->input->post('email'),
                'username'      => $this->input->post('username'),
                'password'      => ($this->input->post('password') != '') ? $this->input->post('password') : $useredit['password'],
                'role_id'       => $this->input->post('role_id'),
                'is_active'     => ($this->input->post('is_active') == 'on') ? 1 : 0
            );
            $response = $this->user_m->edit($user_id, $data);
            if ($response == TRUE) {
                $this->session->set_flashdata('message', array('icon' => 'success', 'message' => 'Data berhasil diedit!'));
                redirect('user');
            } else {
                $this->session->set_flashdata('message', array('icon' => 'warning', 'message' => 'Data gagal diedit!'));
                redirect('user');
            }
        }
    }

    public function hapus()
    {
        $user_id = $_POST['user_id'];
        $response = $this->user_m->hapus($user_id);
        if ($response == TRUE) {
            $this->session->set_flashdata('message', array('icon' => 'danger', 'message' => 'Data berhasil dihapus!'));
            redirect('user');
        } else {
            $this->session->set_flashdata('message', array('icon' => 'warning', 'message' => 'Data gagal dihapus!'));
            redirect('user');
        }
    }

    public function profile()
    {
        profile();
    }

    private function _editProfileValidate($user_id)
    {
        $this->form_validation->set_rules(
            'name',
            'Nama',
            'required',
            array(
                'required'      => '%s wajib diisi!'
            )
        );
        $this->form_validation->set_rules(
            'username',
            'username',
            'required|edit_unique[user.username.' . $this->input->post('user_id') . ']|min_length[8]',
            array(
                'required'      => '%s wajib diisi!',
                'edit_unique'     => '%s sudah terdaftar!',
                'min_length'    => '%s minimal 8 karakter'
            )
        );
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|edit_unique[user.email.' . $this->input->post('user_id') . ']',
            array(
                'required'      => '%s wajib diisi!',
                'edit_unique'     => '%s sudah terdaftar!'
            )
        );
    }

    public function editprofile()
    {
        $data['title'] = "Edit user";
        $data['titlepage'] = "Data edit";
        $data['user'] = get_user_loggedin();
        $useredit = $data['user'];
        $data['useredit'] = $this->user_m->get($useredit['user_id'])->row_array();
        $data['role'] = $this->user_m->getRole()->result_array();
        $this->_editProfileValidate($useredit['user_id']);
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('template', 'user/profile', $data);
        } else {
            $name = $useredit['user_id'] . uniqid();
            $responseImage = $this->do_upload($name);
            $user_id = array(
                'user_id'       => $this->input->post('user_id')
            );
            $data = array(
                'name'          => $this->input->post('name'),
                'email'         => $this->input->post('email'),
                'image'         => ($responseImage == FALSE) ? $useredit['image'] : $responseImage['file_name'],
                'username'      => $this->input->post('username')
            );
            $response = $this->user_m->editProfile($user_id, $data);
            if ($response == TRUE) {
                $this->session->set_flashdata('message', array('icon' => 'success', 'message' => 'Data berhasil diedit!'));
                redirect('user/profile');
            } else {
                $this->session->set_flashdata('message', array('icon' => 'warning', 'message' => 'Data gagal diedit!'));
                redirect('user/profile');
            }
        }
    }

    function do_upload($name)
    {
        $config['upload_path']          = FCPATH . 'assets/image/users/';
        $ext = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
        $config['file_name']             = $name . '.' . $ext;
        $config['allowed_types']        = 'gif|jpg|png';
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('image')) {
            $error = array('error' => $this->upload->display_errors());

            return FALSE;
        } else {
            $data = array('upload_data' => $this->upload->data());
            return $data['upload_data'];
        }
    }

    function do_delete($name)
    {
        $path_to_file = './assets/image/calonpasangan/' . $name;
        if (unlink($path_to_file)) {
            return true;
        } else {
            return false;
        }
    }

    public function gantipassword()
    {
        $user = get_user_loggedin();
        $this->_passwordValidate();
        if ($this->form_validation->run() == FALSE) {
            gantipassword();
            $this->template->load('template', 'user/gantipassword');
        } else {
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $response = $this->user_m->gantipassword($user['user_id'], $password);
            if ($response == TRUE) {
                $this->session->set_flashdata('message', array('icon' => 'success', 'message' => 'Password berhasil diganti!'));
                redirect('user/gantipassword');
            } else {
                $this->session->set_flashdata('message', array('icon' => 'warning', 'message' => 'Password gagal diganti!'));
                redirect('user/gantipassword');
            }
        }
    }

    private function _passwordValidate()
    {
        $this->form_validation->set_rules(
            'passwordnow',
            'Password sekarang',
            'required|min_length[8]|edit_unique[user.password.' . $this->input->post('user_id') . ']',
            array(
                'required'      => '%s wajib diisi!',
                'edit_unique'     => '%s tidak sama!',
                'min_length'    => '%s minimal 8 karakter'
            )
        );
        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|min_length[8]',
            array(
                'required'      => '%s wajib diisi!',
                'min_length'    => '%s minimal 8 karakter'
            )
        );
        $this->form_validation->set_rules(
            'confpassword',
            'Konfirmasi password',
            'required|min_length[8]|matches[password]',
            array(
                'required'      => '%s wajib diisi!',
                'min_length'    => '%s minimal 8 karakter',
                'matches'       => '%s tidak sama',
            )
        );
    }
}
