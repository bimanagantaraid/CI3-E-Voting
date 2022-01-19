<?php

class Voting extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_loggedin();
    }

    public function index()
    {
        $data['title'] = "VOTING";
        $data['titlepage'] = "Data";
        $data['user'] = get_user_loggedin();
        $data['voting'] = $this->voting_m->get()->row_array();
        $this->template->load('template', 'voting/index', $data);
    }

    public function tambah()
    {
        $data['title'] = "Tambah voting";
        $data['titlepage'] = "Tambah voting";
        $data['user'] = get_user_loggedin();
        $this->form_validation->set_rules('nama', 'nama', 'required', array('nama' => '%s Wajib diisi!'));
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('template', 'voting/tambah', $data);
        } else {
            $data = array(
                'voting_id'     => '',
                'nama'          => $this->input->post('nama'),
                'deskripsi'     => $this->input->post('deskripsi'),
                'is_active'     => ($this->input->post('is_active') == 'on') ? 1 : 0
            );
            $response = $this->voting_m->insert($data);
            if ($response == TRUE) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Data berhasil disimpan!</div>');
                redirect('voting');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
                Data gagal disimpan!</div>');
                $this->template->load('template', 'voting/tambah', $data);
            }
        }
    }

    public function edit()
    {
        $data['title'] = "Edit voting";
        $data['titlepage'] = "Edit voting";
        $data['user'] = get_user_loggedin();
        $data['voting'] = $this->voting_m->get()->row_array();
        $this->form_validation->set_rules('nama', 'nama', 'required', array('required' => '%s Wajib diisi!'));
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('template', 'voting/index', $data);
        } else {
            $voting_id = array('voting_id' => $this->input->post('voting_id'));
            $data = array(
                'nama'          => $this->input->post('nama'),
                'deskripsi'     => $this->input->post('deskripsi'),
                'is_active'     => ($this->input->post('is_active') == 'on') ? 1 : 0
            );
            $response = $this->voting_m->update($voting_id, $data);
            var_dump($response);
            if ($response == TRUE) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Data berhasil diedit!</div>');
                redirect('voting');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
                Data gagal diedit!</div>');
                redirect('voting');
            }
        }
    }

    public function hapus($voting_id)
    {
        $response = $this->voting_m->hapus($voting_id);
        if ($response == TRUE) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Data berhasil dihapus!</div>');
            redirect('voting');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Data gagal dihapus!</div>');
            $this->template->load('template', 'voting');
        }
    }

    // get json voting
    public function get()
    {
        $voting_id = $_POST['voting_id'];
        $voting = $this->voting_m->get($voting_id);
        echo json_encode($voting->row_array());
    }

    //Upload image summernote
    function upload_image()
    {
        if (isset($_FILES["file"]["name"])) {
            $config['upload_path'] = './assets/image/voting/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('file')) {
                $this->upload->display_errors();
                return FALSE;
            } else {
                $data = $this->upload->data();
                //Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/image/voting/' . $data['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['quality'] = '60%';
                $config['width'] = 800;
                $config['height'] = 800;
                $config['new_image'] = './assets/image/voting/' . $data['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                echo base_url() . 'assets/image/voting/' . $data['file_name'];
            }
        } else {
            echo $message = 'Ooops!  Your upload triggered the following error:  ' . $_FILES['file']['error'];
        }
    }

    //Delete image summernote
    function delete_image()
    {
        $src = $this->input->post('src');
        $file_name = str_replace(base_url(), '', $src);
        if (unlink($file_name)) {
            echo 'File Delete Successfully';
        }
        echo $file_name;
    }

    public function rekapitulasi()
    {
        $data['title'] = "REKAPITULASI";
        $data['titlepage'] = "Rekapitulasi Voting";
        $data['user'] = get_user_loggedin();
        $data['vote'] = $this->voting_m->rekapitulasi()->result_array();
        $this->template->load('template', 'voting/rekapitulasi', $data);
    }

    public function getSuaraJson()
    {
        $suara = $this->voting_m->getServer();
        $no = @$_POST['start'];
        $data = array();
        foreach ($suara as $s) {
            $no++;
            $row = array();
            $row[] = $s->username;
            $row[] = $s->nama;
            $row[] = $s->paslon_id;
            $row[] = $s->nama_paslon;
            $row[] = $s->date_vote;
            $data[] = $row;
        }

        $output = array(
            'draw'              => @$_POST['draw'],
            'resultsAll'        => $this->voting_m->count_all(),
            'resultsFiltered'   => $this->voting_m->count_all_filtered(),
            'data'              => $data
        );
        echo json_encode($output);
    }
}
