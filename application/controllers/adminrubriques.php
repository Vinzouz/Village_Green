<?php

class adminrubriques extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_adminrubriques');
    }

    public function index()
    {

        $data['main'] = 'admin/adminproducts/rubriques/addrubrique';

        $this->load->view('admin/index', $data);
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


    public function getRubriques(){

        $data['rubriques'] = $this->Model_adminrubriques->getRubriques();
        $data['main'] = 'admin/adminproducts/rubriques/index';

        $this->load->view('admin/index', $data);

    }

}
