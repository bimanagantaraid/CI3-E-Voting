<?php

class Calonpasangan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_loggedin();
    }

    public function index()
    {
        $data['title'] = "CALON PASANGAN";
        $data['titlepage'] = "Calon Pasangan";
        $data['user'] = get_user_loggedin();
        $data['paslon'] = $this->paslon_m->get()->result_array();
        $this->template->load('template', 'calonpasangan/index', $data);
    }

    private function _tambahValidation()
    {
        $this->form_validation->set_rules('voting_id', 'Nama Voting', 'required', array('required' => '%s wajib dipilih, jika data voting belum ada silahkan buat terlebih dahulu!'));
        $this->form_validation->set_rules('no_paslon', 'Nomor Urut', 'required|is_unique[calon_pasangan.no_paslon]', array('required' => '%s wajib diisi!', 'is_unique' => '%s sudah ada!'));
        $this->form_validation->set_rules('nama_paslon', 'Nama Calon Pasangan', 'required', array('required' => '%s wajib diisi!'));
        $this->form_validation->set_rules('deskripsi', 'Visi dan Misi', 'required', array('required' => '%s wajib diisi!'));
    }

    public function tambah()
    {
        $this->_tambahValidation();
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Tambah Paslon";
            $data['titlepage'] = "Data calon pasangan";
            $data['user'] = get_user_loggedin();
            $data['voting'] =  $this->voting_m->get()->result_array();
            $this->template->load('template', 'calonpasangan/tambah', $data);
        } else {
            $filename = $this->input->post('voting_id') . '-' . $this->input->post('no_paslon') . '-' . generateRandomString(10);
            $responseUpload = $this->do_upload('assets\image\calonpasangan', $filename);
            if ($responseUpload) {
                $data = array(
                    'paslon_id'     => '',
                    'no_paslon'     => $this->input->post('no_paslon'),
                    'image'         => $responseUpload['file_name'],
                    'nama_paslon'   => $this->input->post('nama_paslon'),
                    'deskripsi'     => $this->input->post('deskripsi'),
                    'voting_id'     => $this->input->post('voting_id')
                );
                $response = $this->paslon_m->insert($data);
                if ($response == TRUE) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Data berhasil ditambahkan!</div>');
                    redirect('calonpasangan', 'refersh');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Data gagal ditambahkan!</div>');
                    redirect('calonpasangan/tambah', 'refersh');
                }
            } else {
                $this->session->set_flashdata('message', $responseUpload['error']);
                redirect('calonpasangan/tambah', 'refersh');
            }
        }
    }

    private function _editValidation()
    {
        $this->form_validation->set_rules('no_paslon', 'Nomor Urut', 'required', array('required' => '%s wajib diisi!'));
        $this->form_validation->set_rules('nama_paslon', 'Nama Calon Pasangan', 'required', array('required' => '%s wajib diisi!'));
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required', array('required' => '%s wajib diisi!'));
    }

    public function edit($paslon_id)
    {
        $this->_editValidation();
        $data['title'] = "Edit calon pasangan";
        $data['titlepage'] = "Data edit";
        $data['user'] = get_user_loggedin();
        $data['paslon'] = $this->paslon_m->get($paslon_id)->row_array();
        $data['voting'] =  $this->voting_m->get()->row_array();
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('template', 'calonpasangan/edit', $data);
        } else {
            $paslon_id = array(
                'paslon_id'     => $paslon_id
            );
            if ($_FILES['image']['error'] == 4) {
                $data = array(
                    'no_paslon'     => $this->input->post('no_paslon'),
                    'image'         => $this->input->post('hiddenImage'),
                    'nama_paslon'   => $this->input->post('nama_paslon'),
                    'deskripsi'     => $this->input->post('deskripsi'),
                    'voting_id'     => $this->input->post('voting_id')
                );
                $response = $this->paslon_m->update($data, $paslon_id);
                if ($response == TRUE) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Data berhasil dirubah!</div>');
                    redirect('calonpasangan', 'refersh');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Data gagal dirubah!</div>');
                    redirect('calonpasangan/edit/' . $paslon_id['paslon_id'], 'refersh');
                }
            } else {
                $filename = $this->input->post('voting_id') . '-' . $this->input->post('no_paslon') . '-' . generateRandomString(10);
                $responseUpload = $this->do_upload('assets\image\calonpasangan', $filename);
                $responseDelete = $this->do_delete($this->input->post('hiddenImage'));
                if ($responseUpload) {
                    $data = array(
                        'no_paslon'     => $this->input->post('no_paslon'),
                        'image'         => $responseUpload['file_name'],
                        'nama_paslon'   => $this->input->post('nama_paslon'),
                        'deskripsi'     => $this->input->post('deskripsi'),
                        'voting_id'     => $this->input->post('voting_id')
                    );
                    $response = $this->paslon_m->update($data, $paslon_id);
                    if ($response == TRUE) {
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                        Data berhasil dirubah!</div>');
                        redirect('calonpasangan', 'refersh');
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                        Data gagal dirubah!</div>');
                        redirect('calonpasangan/edit/' . $paslon_id['paslon_id'], 'refersh');
                    }
                } else {
                    $this->session->set_flashdata('message', $responseUpload['error']);
                    redirect('calonpasangan/edit/' . $paslon_id['paslon_id'], 'refersh');
                }
            }
        }
    }

    public function hapus($paslon_id)
    {
        $response = $this->paslon_m->hapus($paslon_id);
        if ($response == TRUE) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data berhasil dihapus!</div>');
            redirect('calonpasangan', 'refersh');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
            Data gagal dihapus!</div>!');
            redirect('calonpasangan', 'refersh');
        }
    }

    function do_upload($direktori, $name)
    {
        $config['upload_path']          = FCPATH . 'assets/image/calonpasangan/';
        $ext = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
        $config['file_name']             = $name . '.' . $ext;
        $config['allowed_types']        = 'gif|jpg|png';
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('image')) {
            $error = array('error' => $this->upload->display_errors());
            $gbr = $this->upload->data();
            //Compress Image
            $config['image_library'] = 'gd2';
            $config['source_image'] = './assets/images/calonpasangan' . $gbr['file_name'];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['quality'] = '50%';
            $config['width'] = 600;
            $config['height'] = 400;
            $config['new_image'] = './assets/images/calonpasangan' . $gbr['file_name'];
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
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
}
