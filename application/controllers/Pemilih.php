<?php

class Pemilih extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        set_timezone();
        is_loggedin();
    }

    public function index()
    {
        $data['title'] = "PEMILIH";
        $data['titlepage'] = "Pemilih";
        $data['user'] = get_user_loggedin();
        $data['pemilih'] = $this->pemilih_m->get()->result_array();
        $this->template->load('template', 'pemilih/index', $data);
    }

    public function getPemilih()
    {
        $pemilih = $this->pemilih_m->getServer();
        $data = array();
        $no = @$_POST['start'];
        foreach ($pemilih as $p) {
            $no++;
            $row = array();
            $row[] = $p->no_identitas_resmi;
            $row[] = $p->username;
            $row[] = $p->password;
            $row[] = $p->nama;
            $row[] = $p->jenis_kelamin;
            $row[] = $p->alamat;
            $row[] = '<a href="' . base_url('pemilih/edit/') . $p->pemilih_id . '" class="btn btn-xs btn-info"><i class="fas fa-edit"></i></a><button onclick="hapus(this)" pemilih_id="' . $p->pemilih_id . '" class="btn btn-xs btn-danger"><i class="fas fa-trash-alt"></i></button>';
            $data[] = $row;
        }

        $output = array(
            'draw'              => @$_POST['draw'],
            'recordsTotal'      => $this->pemilih_m->count_all(),
            'recordsFiltered'   => $this->pemilih_m->count_all_filtered(),
            'data'              => $data
        );
        echo json_encode($output);
    }

    private function _tambahValidation()
    {
        $this->form_validation->set_rules(
            'no_identitas_resmi',
            'No identitas',
            'required|is_unique[pemilih.no_identitas_resmi]',
            array(
                'required'  => "%s wajib ada!",
                'is_uniq'   => "%s sudah terdaftar!"
            )
        );
        $this->form_validation->set_rules(
            'pemilih_id',
            'Id',
            'required|is_unique[pemilih.pemilih_id]',
            array(
                'required'  => "%s wajib ada!",
                'is_uniq'   => "%s sudah terdaftar!"
            )
        );
        $this->form_validation->set_rules(
            'username',
            'Username',
            'required|is_unique[pemilih.username]',
            array(
                'required'  => "%s wajib ada!",
                'is_uniq'   => "%s sudah terdaftar!"
            )
        );
        $this->form_validation->set_rules('password', 'Password', 'required', array('required' => '%s wajib ada!'));
        $this->form_validation->set_rules('nama', 'Nama', 'required', array('required' => '%s wajib ada!'));
    }

    public function tambah()
    {
        $data['title'] = "Tambah pemilih";
        $data['titlepage'] = "Data pemilih";
        $data['user'] = get_user_loggedin();
        $data['pemilih'] = $this->pemilih_m->lastrecord();
        $this->_tambahValidation();
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('template', 'pemilih/tambah', $data);
        } else {
            $data = array(
                'pemilih_id'            => $this->input->post('pemilih_id'),
                'no_identitas_resmi'    => $this->input->post('no_identitas_resmi'),
                'nama'                  => $this->input->post('nama'),
                'username'              => htmlspecialchars($this->input->post('username'), TRUE),
                'password'              => $this->input->post('password'),
                'jenis_kelamin'         => $this->input->post('jenis_kelamin'),
                'alamat'                => $this->input->post('alamat'),
                'date_created'          => date("Y-m-d H:i:s"),
                'voting_id'             => 1
            );
            $response = $this->pemilih_m->insert($data);
            if ($response == TRUE) {
                $this->session->set_flashdata('message', array('icon' => 'success', 'message' => 'Data berhasil disimpan!'));
                redirect('pemilih');
            } else {
                $this->session->set_flashdata('message', array('icon' => 'warning', 'message' => 'Data gagal disimpan!'));
                redirect('pemilih');
            }
        }
    }

    function hapus()
    {
        $pemilih_id = $_POST['pemilih_id'];
        $response = $this->pemilih_m->hapus($pemilih_id);
        if ($response == TRUE) {
            $this->session->set_flashdata('message', array('icon' => 'error', 'message' => 'Data berhasil dihapus!'));
            echo json_encode($response);
        } else {
            $this->session->set_flashdata('message', array('icon' => 'warning', 'message' => 'Data gagal dihapus!'));
            echo json_encode($response);
        }
    }

    private function _editValidation()
    {
        $this->form_validation->set_rules(
            'no_identitas_resmi',
            'No identitas',
            'required',
            array(
                'required'  => "%s wajib ada!"
            )
        );
        $this->form_validation->set_rules(
            'username',
            'Username',
            'required',
            array(
                'required'  => "%s wajib ada!"
            )
        );
        $this->form_validation->set_rules('password', 'Password', 'required', array('required' => '%s wajib ada!'));
        $this->form_validation->set_rules('nama', 'Nama', 'required', array('required' => '%s wajib ada!'));
    }

    public function edit($pemilih_id)
    {
        $data['title'] = "Edit pemilih";
        $data['titlepage'] = "Data pemilih";
        $data['user'] = get_user_loggedin();
        $data['pemilih'] = $this->pemilih_m->get($pemilih_id)->row_array();
        $this->_editValidation();
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('template', 'pemilih/edit', $data);
        } else {
            $pemilih_id = array(
                'pemilih_id'    => $this->input->post('pemilih_id')
            );
            $data = array(
                'no_identitas_resmi'    => $this->input->post('no_identitas_resmi'),
                'nama'                  => $this->input->post('nama'),
                'username'              => $this->input->post('username'),
                'password'              => $this->input->post('password'),
                'jenis_kelamin'         => $this->input->post('jenis_kelamin'),
                'alamat'                => $this->input->post('alamat')
            );
            $response = $this->pemilih_m->edit($pemilih_id, $data);
            if ($response == TRUE) {
                $this->session->set_flashdata('message', array('icon' => 'success', 'message' => 'Data berhasil diedt!'));
                redirect('pemilih');
            } else {
                $this->session->set_flashdata('message', array('icon' => 'warning', 'message' => 'Data gagal diedt!'));
                redirect('pemilih');
            }
        }
    }
}
