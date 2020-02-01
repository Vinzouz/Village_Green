<?php

class adminrubriques extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_adminrubriques');
        $this->load->model('Model_espaceclient');
    }

    public function index()
    {

        $data['dataC'] = $this->Model_espaceclient->getClient();
        if ($this->session->userdata('role') == 1) {

            $this->load->view('admin/partials/header');

            $this->load->view('admin/partials/navbar', $data);

            $this->load->view('admin/adminproducts/rubriques/addrubrique');

            $this->load->view('admin/partials/footer');
        }
    }

    public function addRubrique()
    {

        //print_r($_POST);

        $this->form_validation->set_rules('rubrique_nom', 'Nom rubrique', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('rubrique_desc', 'Description rubrique', 'trim|required|min_length[3]');

        if ($this->form_validation->run() == FALSE) {
            $data = array('errors' => validation_errors());
            $this->session->set_flashdata($data);
            redirect('adminrubriques/index');
        } else {
            $data = array(
                'rubrique_nom' => $this->input->post('rubrique_nom'),
                'rubrique_desc' => $this->input->post('rubrique_desc')

            );
            $this->Model_adminrubriques->addRubrique($data);

            redirect('adminrubriques/getRubriques');
        }
    }


    public function getRubriques()
    {

        $data['rubriques'] = $this->Model_adminrubriques->getRubriques();
        $data['dataC'] = $this->Model_espaceclient->getClient();
        if ($this->session->userdata('role') == 1) {

            $this->load->view('admin/partials/header');

            $this->load->view('admin/partials/navbar', $data);

            $this->load->view('admin/adminproducts/rubriques/index', $data);

            $this->load->view('admin/partials/footer');
        }
    }
}
